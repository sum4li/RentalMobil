<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\TransactionDetail;
use App\Product;
use App\Customer;
use Barryvdh\DomPDF\Facade as PDF;
use App\Exports\TransactionExport;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{

    public function __construct()
    {
        $this->product = new Product();
        $this->customer = new Customer();
        $this->transaction = new Transaction();
        $this->transactionDetail = new TransactionDetail();
    }

    public function index()
    {
        return view('backend.transaction.index');
    }

    public function source(){
        $query= Transaction::query();
        $query->orderBy('date','desc');
        return DataTables::eloquent($query)
        ->filter(function ($query) {
            if (request()->has('search')) {
                $query->whereHas('customer',function ($q) {
                    $q->where('name', 'LIKE', '%' . request('search')['value'] . '%');
                });
            }
            })
            ->addColumn('invoice_no', function ($data) {
                return $data->invoice_no;
            })
            ->addColumn('date', function ($data) {
                return Carbon::parse($data->date)->format('d-m-Y');
            })
            ->addColumn('time', function ($data) {
                return Carbon::parse($data->date)->format('H:i:s');
            })
            ->addColumn('customer', function ($data) {
                return title_case($data->customer->name);
            })
            ->addColumn('amount', function ($data) {
                return number_format($data->amount,0,',','.');
            })
            ->addColumn('status', function ($data) {
                return $data->status == 'proses' ? '<span class="badge badge-danger">'.$data->status.'</span>':'<span class="badge badge-success">'.$data->status.'</span>';
            })
            ->addIndexColumn()
            ->addColumn('action', 'backend.transaction.index-action')
            ->rawColumns(['action','status'])
            ->toJson();
    }

    public function create()
    {
        return view('backend.transaction.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->merge(['slug'=>$request->name]);
            if($request->has('customer_id')){
                $customer_id = $request->customer_id;
            }else{
                $customer = $this->customer->create($request->all());
                $customer_id = $customer->id;
            }

            $data_transaction = [
                'invoice_no'=> $this->generateInvoice(date('Y-m-d')),
                'customer_id'=> $customer_id,
                'date'=> date('Y-m-d H:i:s'),
                'status'=> 'proses',
            ];

            $transaction = $this->transaction->create($data_transaction);

            for ($i=0; $i <count($request->product_id) ; $i++) {
                $price = $this->product->find($request->input('product_id.'.$i))->price;
                $this->transactionDetail->create([
                    'transaction_id'=> $transaction->id,
                    'product_id'=> $request->input('product_id.'.$i),
                    'qty'=> $request->input('qty.'.$i),
                    'price'=> $price,
                    'total' => $price * $request->input('qty.'.$i)
                ]);
            }

            $amount = $this->transactionDetail->where('transaction_id',$transaction->id)->get()->sum('total');
            $this->transaction->find($transaction->id)->update(['amount'=>$amount]);
            DB::commit();
            // return redirect()->route('transaction.index')->with('success-message','Data telah disimpan');
            return redirect()->route('transaction.print',$transaction->id);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error-message',$e->getMessage());
        }

    }

    public function show($id)
    {
        $data = $this->transaction->find($id);
        return $data;

    }

    public function edit($id)
    {
        $data = $this->transaction->find($id);
        return view('backend.transaction.edit',compact('data'));

    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request->merge(['slug'=>str_slug($request->name)]);
            $this->transaction->find($id)->update($request->all());
            DB::commit();
            return redirect()->route('transaction.index')->with('success-message','Data telah d irubah');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error-message',$e->getMessage());
        }

    }

    public function destroy($id)
    {
        $this->transaction->destroy($id);
        return redirect()->route('transaction.index')->with('success-message','Data telah dihapus');
    }

    public function print($id){
        $data = $this->transaction->find($id);
        // return view('backend.transaction.cetak',compact(['data']));
        $pdf = PDF::loadView('backend.transaction.cetak',compact(['data']));
        return $pdf->stream();
    }

    private function generateInvoice($date){
        $tanggal = substr($date,8,2);
        $bulan = substr($date,5,2);
        $tahun = substr($date,2,2);
        $transaction = $this->transaction->whereDate('date',$date)->get();
        $no = 'TRX-'.$tanggal.$bulan.$tahun.'-'.sprintf('%05s',$transaction->count()+1);
        return $no;
    }

    public function export(Request $request){
        $transaction = new TransactionExport();
        $transaction->setDate($request->from,$request->to);
        return Excel::download($transaction, 'laporan_trx_'.$request->from.'_'.$request->to.'.xlsx');
    }

}

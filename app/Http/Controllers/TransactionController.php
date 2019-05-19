<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Car;
use App\Customer;
use Barryvdh\DomPDF\Facade as PDF;
use App\Exports\TransactionExport;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{

    public function __construct()
    {
        $this->car = new Car();
        $this->customer = new Customer();
        $this->transaction = new Transaction();
    }

    public function index()
    {
        return view('backend.transaction.index');
    }

    public function history(){
        return view('backend.transaction.history');
    }

    public function source($status){
        $query= Transaction::query();
        $query->where('status',$status);
        $query->orderBy('created_at','desc');
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
            ->addColumn('rent_date', function ($data) {
                return Carbon::parse($data->rent_date)->format('d-m-Y');
            })
            ->addColumn('back_date', function ($data) {
                return Carbon::parse($data->back_date)->format('d-m-Y');
            })
            ->addColumn('customer', function ($data) {
                return title_case($data->customer->name);
            })
            ->addColumn('car', function ($data) {
                return title_case($data->car->name);
            })
            ->addColumn('status', function ($data) {
                return $data->status == 'proses' ? '<span class="badge badge-success">'.$data->status.'</span>':'<span class="badge badge-secondary">'.$data->status.'</span>';
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

            $car = $this->car->find($request->car_id);
            $data_transaction = [
                'invoice_no'=> $this->generateInvoice(date('Y-m-d')),
                'car_id'=> $car->id,
                'customer_id'=> $customer_id,
                'rent_date'=> $request->rent_date,
                'back_date'=> $request->back_date,
                'price'=> $car->price,
                'amount'=> Carbon::parse($request->rent_date)->diffInDays($request->back_date) * $car->price,
                'status'=> 'proses',
            ];

            $transaction = $this->transaction->create($data_transaction);
            $car->update(['status'=>'terpakai']);
            DB::commit();
            return redirect()->route('transaction.index')->with('success-message','Data telah disimpan');
            // return redirect()->route('transaction.print',$transaction->id);
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
        return $pdf->stream($data->invoice_no.'.pdf');
    }

    public function complete(Request $request,$id){
        $transaction = $this->transaction->find($id);
        $transaction->update([
            'return_date'=>$request->return_date,
            'status'=>'selesai',
            'penalty'=>Carbon::parse($transaction->back_date)->diffInDays($request->return_date) * $transaction->car->penalty,
            'amount'=>Carbon::parse($transaction->back_date)->diffInDays($request->return_date) * $transaction->car->penalty + $transaction->amount

        ]);
        $this->car->find($transaction->car_id)->update(['status'=>'tersedia']);
        return redirect()->route('transaction.index')->with('success-message','Data telah disimpan');
    }

    private function generateInvoice($date){
        $tanggal = substr($date,8,2);
        $bulan = substr($date,5,2);
        $tahun = substr($date,2,2);
        $transaction = $this->transaction->whereDate('created_at',$date)->get();
        $no = 'TRX-'.$tanggal.$bulan.$tahun.'-'.sprintf('%05s',$transaction->count()+1);
        return $no;
    }

    public function export(Request $request){
        $transaction = new TransactionExport();
        $transaction->setDate($request->from,$request->to);
        return Excel::download($transaction, 'laporan_trx_'.$request->from.'_'.$request->to.'.xlsx');
    }

}

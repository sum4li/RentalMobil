<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class CustomerController extends Controller
{

    public function __construct()
    {
        $this->customer = new Customer();
    }

    public function index()
    {
        return view('backend.customer.index');
    }

    public function source(){
        $query= Customer::query();
        return DataTables::eloquent($query)
        ->filter(function ($query) {
            if (request()->has('search')) {
                $query->where(function ($q) {
                    $q->where('name', 'LIKE', '%' . request('search')['value'] . '%');
                });
            }
            })
            ->addColumn('name', function ($data) {
                return title_case($data->name);
            })
            ->addColumn('email', function ($data) {
                return $data->email;
            })
            ->addColumn('phone_number', function ($data) {
                return title_case($data->phone_number);
            })
            ->addIndexColumn()
            ->addColumn('action', 'backend.customer.index-action')
            ->rawColumns(['action'])
            ->toJson();
    }

    public function create()
    {
        return view('backend.customer.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $requset = $request->merge(['slug'=>$request->name]);
            $this->customer->create($request->all());
            DB::commit();
            return redirect()->route('customer.index')->with('success-message','Data telah disimpan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error-message',$e->getMessage());
        }

    }

    public function show($id)
    {
        $data = $this->customer->find($id);
        return $data;

    }

    public function edit($id)
    {
        $data = $this->customer->find($id);
        return view('backend.customer.edit',compact('data'));

    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request = $request->merge(['slug'=>$request->name]);
            $this->customer->find($id)->update($request->all());
            DB::commit();
            return redirect()->route('customer.index')->with('success-message','Data telah d irubah');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error-message',$e->getMessage());
        }

    }

    public function destroy($id)
    {
        $this->customer->destroy($id);
        return redirect()->route('customer.index')->with('success-message','Data telah dihapus');
    }

    public function getCustomer(Request $request){
        if ($request->has('search')) {
            $cari = $request->search;
    		$data = $this->customer->where('name', 'LIKE', '%'.$cari.'%')->get();
            return response()->json($data);
    	}
    }

}

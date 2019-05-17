<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ProductController extends Controller
{

    public function __construct()
    {
        $this->product = new Product();
    }

    public function index()
    {
        return view('backend.product.index');

    }

    public function source(){
        $query= Product::query();
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
            ->addColumn('price', function ($data) {
                return number_format($data->price,0,',','.');
            })
            ->addIndexColumn()
            ->addColumn('action', 'backend.product.index-action')
            ->rawColumns(['action'])
            ->toJson();
    }

    public function create()
    {
        return view('backend.product.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->merge(['slug'=>str_slug($request->name)]);
            $this->product->create($request->all());
            DB::commit();
            return redirect()->route('product.index')->with('success-message','Data telah disimpan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error-message',$e->getMessage());
        }

    }

    public function show($id)
    {
        $data = $this->product->find($id);
        return $data;

    }

    public function edit($id)
    {
        $data = $this->product->find($id);
        return view('backend.product.edit',compact('data'));

    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request->merge(['slug'=>str_slug($request->name)]);
            $this->product->find($id)->update($request->all());
            DB::commit();
            return redirect()->route('product.index')->with('success-message','Data telah d irubah');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error-message',$e->getMessage());
        }

    }

    public function destroy($id)
    {
        $this->product->destroy($id);
        return redirect()->route('product.index')->with('success-message','Data telah dihapus');
    }

}

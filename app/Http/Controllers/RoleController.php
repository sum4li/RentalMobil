<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class RoleController extends Controller
{

    public function __construct()
    {
        $this->role = new Role();
    }

    public function index()
    {
        return view('backend.role.index');
    }

    public function source(){
        $query= Role::query();
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
            ->addIndexColumn()
            ->addColumn('action', 'backend.role.index-action')
            ->rawColumns(['action'])
            ->toJson();
    }

    public function create()
    {
        return view('backend.role.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $requset = $request->merge(['slug'=>$request->name]);
            $this->role->create($request->all());
            DB::commit();
            return redirect()->route('role.index')->with('success-message','Data telah disimpan');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error-message',$e->getMessage());
        }

    }

    public function show($id)
    {
        $data = $this->role->find($id);
        return $data;

    }

    public function edit($id)
    {
        $data = $this->role->find($id);
        return view('backend.role.edit',compact('data'));

    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $request = $request->merge(['slug'=>$request->name]);
            $this->role->find($id)->update($request->all());
            DB::commit();
            return redirect()->route('role.index')->with('success-message','Data telah d irubah');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error-message',$e->getMessage());
        }

    }

    public function destroy($id)
    {
        $this->role->destroy($id);
        return redirect()->route('role.index')->with('success-message','Data telah dihapus');
    }

    public function getRole(Request $request){
        if ($request->has('search')) {
            $cari = $request->search;
    		$data = $this->role->where('name', 'LIKE', '%'.$cari.'%')->get();
            return response()->json($data);
    	}
    }

}

<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class SettingController extends Controller
{

    public function __construct()
    {
        $this->setting = new Setting();
    }

    public function index()
    {
        $data = $this->setting->get();
        return view('backend.setting.index',compact(['data']));
    }

    public function change(Request $request){
        $description = $request->description;
        $id = $request->id;
        for ($i=0; $i < count($request->id) ; $i++) {
            $this->setting->find($id[$i])->update([
                'description'=>$description[$i]
            ]);
        }
        return redirect()->back()->with('success-message','Data Berhasil Dirubah');
    }

    public function source(){
        $query= Setting::query();
        return DataTables::eloquent($query)
        ->filter(function ($query) {
            if (request()->has('search')) {
                $query->where(function ($q) {
                    $q->where('name', 'LIKE', '%' . request('search')['value'] . '%');
                });
            }
            })
            ->addColumn('name', function ($data) {
                return ucwords($data->name);
            })
            ->addColumn('type', function ($data) {
                return ucwords($data->type);
            })
            ->addColumn('description', function ($data) {
                return ucwords($data->description);
            })
            ->addIndexColumn()
            ->addColumn('action', 'backend.setting.index-action')
            ->rawColumns(['action'])
            ->toJson();
    }

    public function create()
    {
        return view('backend.setting.create');
    }

    public function store(Request $request)
    {
        if($this->setting->where('slug',str_slug($request->name))->get()->count() > 0){
            return redirect()->route('setting.index')->with('error-message','Gagal Menyimpan. Data '.$request->name.' sudah ada, edit data yang ada');
        }else{
            $this->setting->create($request->all());
            return redirect()->route('setting.index')->with('success-message','Data telah disimpan');
        }
    }

    public function show($id)
    {
        $data = $this->setting->find($id);
        return $data;

    }

    public function edit($id)
    {
        $data = $this->setting->find($id);
        return view('backend.setting.edit',compact('data'));

    }

    public function update(Request $request, $id)
    {
        $name = $this->setting->find($id)->name;
        if($this->setting->where('name',$request->name)->get()->count() > 0){
            if($request->name == $name){
                $this->setting->find($id)->update($request->all());
                return redirect()->route('setting.index')->with('success-message','Data telah d irubah');
            }else{
                return redirect()->route('setting.index')->with('error-message','Gagal Meruba h. Data '.$request->name.' sudah ada,   edit data yang ada');
            }
        }else{
            $this->setting->find($id)->update($request->all());
            return redirect()->route('setting.index')->with('success-message','Data telah d irubah');
        }
    }

    public function destroy($id)
    {
         $this->setting->destroy($id);
         return redirect()->route('setting.index')->with('success-message','Data telah dihapus');

    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pages;
use App\Article;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use OpenGraph;
use SEOMeta;
use App\Setting;
use App\Menu;
use App\Promo;
use App\Portofolio;
use App\Service;
use App\Gallery;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->article = new Article();
        $this->portofolio = new Portofolio();
        $this->pages = new Pages();
        $this->setting = new Setting();
        $this->menu = new Menu();
        $this->promo = new Promo();
        $this->service = new Service();
        $this->gallery  = new Gallery();
    }

    public function index(){
        SEOMeta::setDescription($this->setting->where('slug','description')->get()->first()->description);
        OpenGraph::setDescription($this->setting->where('slug','description')->get()->first()->description);
        OpenGraph::setTitle('Digsa.id | Home');
        OpenGraph::addProperty('type', 'pages');
        OpenGraph::addImage(asset('frontend/img/brand/digsa-color.png'));
        return view('frontend.layouts');
    }

    public function menu($slug_menu,$slug_detail=null){
        $menu = $this->menu->where('slug',$slug_menu)->get();
        if($menu->count() > 0){
            if(!($slug_detail)){ // jika slug detail kosong
                $model = $menu->first()->menu_type->slug;
                $data =  $this->$model->where('menu_id',$menu->first()->id);
                if($data->get()->count() > 0){
                    if($model == 'pages'){
                        // SEO
                        SEOMeta::setDescription(strip_tags($data->get()->first()->description));
                        OpenGraph::setDescription(strip_tags($data->get()->first()->description));
                    }else{
                        SEOMeta::setDescription('Digsa.id | '.title_case($menu->first()->name));
                        OpenGraph::setDescription('Digsa.id | '.title_case($menu->first()->name));
                    }
                }else{
                    SEOMeta::setDescription('Digsa.id | '.title_case($menu->first()->name));
                    OpenGraph::setDescription('Digsa.id | '.title_case($menu->first()->name));
                }
                    OpenGraph::setTitle('Digsa.id | '.title_case($menu->first()->name));
                    OpenGraph::addProperty('type', 'pages');
                    OpenGraph::addImage(asset('frontend/img/brand/digsa-color.png'));

                return view('frontend.'.$model.'.index',compact(['data','menu']));
            }else{
                $model = $menu->first()->menu_type->slug;
                $data =  $this->$model->where('menu_id',$menu->first()->id)->where('slug',$slug_detail);
                if ($this->$model->where('menu_id',$menu->first()->id)->where('slug',$slug_detail)->get()->count() > 0){
                    // SEO
                    SEOMeta::setDescription(!($data->get()->first()->description) ? strip_tags($data->get()->first()->description):'Digsa.id| Halaman '.title_case($menu->first()->name));
                    OpenGraph::setDescription(!($data->get()->first()->description) ? strip_tags($data->get()->first()->description):'Digsa.id| Halaman '.title_case($menu->first()->name));
                    OpenGraph::setTitle('Digsa.id | '.title_case($data->get()->first()->name));
                    OpenGraph::addProperty('type', 'pages');
                    OpenGraph::addImage(asset('frontend/img/brand/digsa-color.png'));

                    return view('frontend.'.$model.'.show',compact(['data','menu']));
                }else{
                    return view('frontend.component.404');
                }
            }
        }else{
            return view('frontend.component.404');
        }
    }


}

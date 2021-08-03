<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class
HomeController extends Controller
{
    public function index() {
        $id_years = Menu::where('level', 22)->orderBy('id','desc')->get()->pluck('id');
        $articles = Article::whereIn('razid',$id_years)->orderBy('id','desc')->limit(4)->get();
//        dd($articles);
        return view('pages.home', compact('articles'));
    }


    public function getContacts(){
        $locale = \app()->getLocale();
        $cities = Menu::select("menus.name_$locale as name","menus.name_en as name_en","articles.id", "articles.head_ru as head","articles.name_$locale as article_name", "articles.tex_ru as text", "articles.description_$locale as desc")
            ->join('articles','menus.link', 'articles.raz')
            ->orderByRaw('name = "Алматы" desc')
            ->orderBy('name')
            ->where('menus.level',24)
            ->get();
//            ->toArray();

        $fillials = Article::select("name_$locale","tex_$locale","head_$locale")->where('razid',25)->get()->toArray();
//        dd($cities);
        return view('pages.contacts',compact('cities'));
    }
}

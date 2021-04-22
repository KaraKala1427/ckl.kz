<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Menu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $id_years = Menu::where('level', 22)->orderBy('id','desc')->get()->pluck('id');
        $articles = Article::whereIn('razid',$id_years)->orderBy('id','desc')->limit(4)->get();
//        dd($articles);
        return view('pages.home', compact('articles'));
    }
}

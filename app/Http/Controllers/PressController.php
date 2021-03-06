<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class PressController extends Controller
{
    public function press(){
        $years = Menu::where('level', 22)->orderBy('id')->get()->pluck('name_ru');
//        dd($years);
        $id_years = Menu::where('level', 22)->orderBy('id')->get()->pluck('id');
        $articles = Article::whereIn('razid',$id_years)->orderBy('id','desc')
            ->with('year')
            ->paginate(10);
//        dd($articles);
        return view('pages.press', compact('years','articles'));
    }



    public function press_detail( $year, $id, $alias ){
//        dd($language, $year, $id, $alias);
        $id_years = Menu::where('level', 22)->orderBy('id')->get()->pluck('id');
        $other_articles = Article::whereIn('razid',$id_years)
            ->where('id','<>',$id)
            ->orderBy('id','desc')
            ->with('year')
            ->limit(2)
            ->get();
//        dd($other_articles);
        $article =Article::find($id);
        return view('pages.press_detail',compact("article" , 'other_articles') );
    }

    public function press_by_year($year ){
//        dd($language, $year);
        $years = Menu::where('level', 22)->orderBy('id')->get()->pluck('name_ru');
        $id_years = Menu::where('level', 22)->where('name_ru',$year)->get()->pluck('id');
        $articles = Article::whereIn('razid',$id_years)
            ->orderBy('id','desc')
            ->with('year')
            ->paginate(12);
//        dd($other_articles);
        return view('pages.press_by_year',compact('years',"articles" ) );
    }

}

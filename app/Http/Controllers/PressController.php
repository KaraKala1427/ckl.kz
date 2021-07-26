<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class PressController extends Controller
{
//    public function press($page=1){
//        $years = Menu::where('level', 22)->orderBy('id')->get()->pluck('name_ru');
////        dd($years);
//        $id_years = Menu::where('level', 22)->orderBy('id')->get()->pluck('id');
//        $articles = Article::whereIn('razid',$id_years)->orderBy('id','desc')
//            ->with('year')
//            ->paginate(8,['*'], 'page', $page);
//
////        dd($articles);
//        return view('pages.press', compact('years','articles', ));
//    }

    public function press($page=1){
        $years = Menu::where('level', 22)->orderBy('id')->get()->pluck('name_ru');
        if($page >= 2019 and $page <= date("Y")){
            $year = $page;
            return self::press_by_year($year);

        }else{
            $id_years = Menu::where('level', 22)->orderBy('id')->get()->pluck('id');
            $articles = Article::whereIn('razid',$id_years)
                ->orderBy('id','desc')
                ->with('year')
                ->paginate(10,['*'], 'page', $page);
        }

        return view('pages.press', compact('years','articles', ));
    }


    public function press_detail( $year, $id, $alias ){
        $id_years = Menu::where('level', 22)->orderBy('id')->get()->pluck('id');
        $other_articles = Article::whereIn('razid',$id_years)
            ->where('id','<>',$id)
            ->orderBy('id','desc')
            ->with('year')
            ->limit(2)
            ->get();

        $article =Article::find($id);
        return view('pages.press_detail',compact("article" , 'other_articles') );
    }

    public function press_by_year($year ){
        $years = Menu::where('level', 22)->orderBy('id')->get()->pluck('name_ru');
        $id_years = Menu::where('level', 22)->where('name_ru',$year)->get()->pluck('id');
        $articles = Article::whereIn('razid',$id_years)
            ->orderBy('id','desc')
            ->with('year')
            ->paginate(10);

        return view('pages.press_by_year',compact('years',"articles" ) );
    }

}

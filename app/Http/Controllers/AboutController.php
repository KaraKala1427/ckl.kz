<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Menu;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use File;
use App\Http\Controllers\ProductController;

class AboutController extends Controller
{
    public function get_akcioneram(){
        $article = Article::where('razid','16')->first();
        $title = $article->{'name_'  .App::getLocale()};
        $text = $article->{'tex_'  .App::getLocale()};
        return view('pages.about_akcioneram', compact( 'title' , 'text', 'article') );
    }

    public function get_history(){
        $years = Menu::where('level',12)->orderBy('id')->get()->pluck('name_ru');
        $id_years = Menu::where('level',12)->orderBy('id')->get()->pluck('id');
        $articles = Article::whereIn('razid', $id_years)->get();
//        dd(Article::whereIn('razid', $id_years)->toSql());
        return view('pages.about_history', compact( 'years', 'articles') );
    }

    public function get_team(){
        $link = Menu::where('level',13)->orderBy('id')->get()->pluck('link');
        $articles = Article::whereIn('raz', $link)->orderBy('orderid','asc')->get();
        return view('pages.about_team', compact(  'articles') );
    }

    public function get_license(){
        $articles = Article::where('razid', '34')->orderBy('orderid','desc')->get();
        return view('pages.about_license', compact(  'articles') );
    }

    public function get_financial_statements(){
        $articles = Article::where('razid', '15')->orderBy('orderid','desc')->get();
        $articles = (new ProductController())->convertClassTinyMce($articles);
        return view('pages.about_financial_statements', compact(  'articles') );
    }

    public function get_corporate_events(){
        $articles = Article::where('razid', '17')->orderBy('orderid','desc')->get();
        $articles = (new ProductController())->convertClassTinyMce($articles);
        return view('pages.about_corporate_events', compact(  'articles') );
    }

    public function get_compliance_controller(){
        $articles = Article::where('razid', '18')->orderBy('orderid','desc')->get()->first();
        return view('pages.about_compliance_controller', compact(  'articles') );
    }
    public function get_informaciya_dlya_insayderov(){
        $articles = Article::where('razid', '19')->orderBy('orderid','desc')->get()->first();
        return view('pages.about_compliance_controller', compact(  'articles') );
    }

    public function get_tarify(){
        $articles = Article::where('razid', '20')->orderBy('orderid','desc')->get();
        $articles = (new ProductController())->convertClassTinyMce($articles);
        return view('pages.about_tarify', compact(  'articles') );
    }
    public function get_agents(){
        $articles = Article::where('razid', '68')->orderBy('orderid','desc')->get();
        $articles = (new ProductController())->convertClassTinyMce($articles);
        return view('pages.about_agents', compact(  'articles') );
    }
    public function get_requisites(){
        $articles = Article::where('razid', '21')->orderBy('orderid','desc')->get();
        $articles = (new ProductController())->convertClassTinyMce($articles);
        return view('pages.about_requisites', compact(  'articles') );
    }


}

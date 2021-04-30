<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Menu;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct(){
        $this->middleware('admin');
    }

    public function index(){
        $menus = Menu::orderBy('orderid')->orderBy('level')->get();
        $articles = Article::where('raz',8)->get();

        return view('admin.index', compact('menus','articles'));

    }
    public function getLink($link){
        $menus = Menu::orderBy('orderid')->orderBy('level')->get();
        $articles = Article::where('raz',$link)->get();
        return view('admin.index', compact('articles','menus'));
    }

    public function getArticle($link, $id){
        $menus = Menu::orderBy('orderid')->orderBy('level')->get();
        $article = Article::where('id',$id)->get()->first();
        return view('admin.edit',compact('article','menus'));
    }

    public function update(Request $request, $id){
            $request->validate([
                'name_ru'=>'required',
                'pubdat'=>'required'
            ]);
            $article = Article::find($id);
            $article->name_ru = $request->get('name_ru');
            $article->pubdat = $request->get('pubdat');
            $article->description_ru = $request->get('description_ru');
            $article->head_ru = $request->get('head_ru');
            $article->tex_ru = $request->get('tex_ru');
            $article->save();
        return redirect()->route('admin.one.menu.edit', ["link"=>$article->raz,'id'=>$article->id])->with('success','Your data is updated');

    }



}

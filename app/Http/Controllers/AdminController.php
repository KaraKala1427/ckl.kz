<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Menu;
use Carbon\Carbon;
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
        $link1 = $link;
        return view('admin.index', compact('articles','menus','link1'));

    }

    public function getArticle($link, $id){


        $menus = Menu::orderBy('orderid')->orderBy('level')->get();
        $article = Article::where('id',$id)->get()->first();
        return view('admin.edit',compact('article','menus'));


    }

    public function update(Request $request, $id){

//        dd(Article::find(1)->pubdat);

            $request->validate([
                'name_ru'=>'required',
                'dat'=>'required'
            ]);

            $article = Article::find($id);
            $article->name_ru = $request->get('name_ru');
            $article->pubdat = $request->get('dat');
            $article->dat = $request->get('dat');
            $article->description_ru = $request->get('description_ru');
            $article->head_ru = $request->get('head_ru');
            $article->tex_ru = $request->get('tex_ru');
            $article->save();
        return redirect()->route('admin.one.menu.edit', ["link"=>$article->raz,'id'=>$article->id])->with('success','Успешно изменено');

    }

    public function getAdd($link){
        $menus = Menu::orderBy('orderid')->orderBy('level')->get();
        return view('admin.insert', compact('menus','link'));
    }

    public function store(Request $request){
        $request->validate([
            'name_ru'=>'required',
            'dat'=>'required'
        ]);
        $article = new Article();
        $article->name_ru = $request->input('name_ru');
        $article->dat = $request->input('dat');
        $article->description_ru = $request->input('description_ru');
        $article->head_ru = $request->input('head_ru');
        $article->tex_ru = $request->input('tex_ru');
        $article->raz = $request->input('link');

        $kink = $request->input('link');
        $menu = Menu::where('link',$kink)->first();
        $article->orderid = $menu->orderid;
        $article->razid = $menu->id;
        $article->save();

        return redirect()->route('admin.one.menu', ["link" => $article->raz])->with('success','Успешно создано');

    }

    public function destroy(Request $request,$link,$id){
        $article = Article::find($id);
        $article->delete($id);
        return redirect()->route('admin.one.menu',["link" => $article->raz])->with('success','Успешно удалено');
    }



}

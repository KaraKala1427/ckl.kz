<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{

    public function __construct(){
        $this->middleware('admin');
    }

    public function index(){
//        $menu = Menu::orderBy('orderid')->orderBy('level')->get();
        $menu = Menu::where('level',0)->get();
        $articles = Article::where('raz',8)->get();
        return view('admin.index', compact('menu','articles'));

    }
    public function getLink($link){
        $menu = Menu::where('level',0)->get();;
        $articles = Article::where('raz',$link)->get();
        $link1 = $link;
        return view('admin.index', compact('articles','menu','link1'));

    }
    public function getParentMenu($link){
        $menu = Menu::where('level',0)->get();
        $menus = Menu::where('link',$link)->with('children')->get()->first();
        $parentmenu = $menus->children;
        //dd($menu);
        $link1 = $link;
        return view('admin.menuParent', compact('parentmenu','menu','link1'));
    }

    public function getMenuAdd($link){
        $menu = Menu::where('level',0)->get();
        return view('admin.insertMenu', compact('menu','link'));
    }

    public function getArticle($link, $id){
        $menu = Menu::where('level',0)->get();
        $article = Article::where('id',$id)->get()->first();
        return view('admin.edit',compact('article','menu'));
    }

    public function update(Request $request, $id){

//        dd(Article::find(1)->pubdat);

            $request->validate([
                'name_ru'=>'required',
                'dat'=>'required'
            ]);

            $article = Article::find($id);
            $article->name_ru = $request->get('name_ru') ?? '';
            $article->name_kz = $request->get('name_kz') ?? '';
            $article->name_en = $request->get('name_en') ?? '';
            $article->pubdat = $request->get('dat');
            $article->dat = $request->get('dat');
            $article->description_ru = $request->get('description_ru');
            $article->description_kz = $request->get('description_kz');
            $article->description_en = $request->get('description_en');
            $article->head_ru = $request->get('head_ru');
            $article->head_kz = $request->get('head_kz');
            $article->head_en = $request->get('head_en');
            $article->tex_ru = $request->get('tex_ru');
            $article->tex_kz = $request->get('tex_kz');
            $article->tex_en = $request->get('tex_en');

            $article->save();
        return redirect()->route('admin.one.menu.edit', ["link"=>$article->raz,'id'=>$article->id])->with('success','Успешно изменено');

    }

    public function getAdd($link){
        $menu = Menu::where('level',0)->get();
        return view('admin.insert', compact('menu','link'));
    }
    public function getThumbAdd($link){
        $menu = Menu::where('level',0)->get();
        return view('admin.insertThumb', compact('menu','link'));
    }

    protected $dates = [
        'dat'
    ];

    public function store(Request $request){

        $request->validate([
            'name_ru'=>'required',
            'dat'=>'required'
        ]);
        $article = new Article();
        $article->name_ru = $request->input('name_ru');
        $article->name_kz = $request->input('name_kz')?? '';
        $article->name_en = $request->input('name_en')?? '';
        $article->dat = $request->input('dat');
        $article->pubdat = $request->input('dat');
        $article->description_ru = $request->input('description_ru');
        $article->description_kz = $request->input('description_kz');
        $article->description_en = $request->input('description_en');
        $article->head_ru = $request->input('head_ru');
        $article->head_kz = $request->input('head_kz');
        $article->head_en = $request->input('head_en');
        $article->tex_ru = $request->input('tex_ru');
        $article->tex_kz = $request->input('tex_kz');
        $article->tex_en = $request->input('tex_en');
        $article->raz = $request->input('link');

        $kink = $request->input('link');
        $menu = Menu::where('link',$kink)->first();
        $article->orderid = $menu->orderid;
        $article->razid = $menu->id;
        $article->save();

        return redirect()->route('admin.one.menu', ["link" => $article->raz])->with('success','Успешно создано');

    }
    public function postMenu(Request $request){
        $request->validate([
            'name_ru'=>'required',
        ]);
        $menu = new Menu();
        $menu->name_ru = $request->input('name_ru');
        $menu->name_kz = $request->get('name_kz') ?? '';
        $menu->name_en = $request->get('name_en') ?? '';
        $link = $request->input('link');
        $menuParent = Menu::where('link',$link)->first();
        $id = $menuParent->id;
        $menu->level = $id; // привязал сына к отцу
        $menu->link = '';
        $menu->save();
        $menu->update(['orderid' => $menu->id,'link' => "link$menu->id"]);
//            dd($menu);

        return redirect()->route('admin.menus', ["link" => $link])->with('success','Успешно создано');


    }

    public function postThumb(Request $request){
        $request->validate([
            'name_ru'=>'required',
            'img_ru'=>'required'
        ]);

        $image = $request->file('img_ru')->hashName();
//        $request->file('img_ru')->storeAs('./public/dir/', $image);
        $storage_path = public_path()."/storage/dir";

        if (!file_exists($storage_path)) {
            mkdir($storage_path);
        }

        $img_path = "$storage_path/$image";

        $img = Image::make($request->file('img_ru')->path());
        $img->resize(700, 700, function ($const) {
            $const->aspectRatio();
        })->save(public_path()."/storage/dir/$image");

        $article = new Article();
        $article->name_ru = $request->input('name_ru');
        $article->name_kz = $request->input('name_kz')?? '';
        $article->name_en = $request->input('name_en')?? '';
        $article->img_ru = $img_path;
        $article->dat = (new \Illuminate\Support\Carbon)->format('Y-m-d');
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

    public function deleteMenu(Request $request,$link,$id){
        Menu::find($id)->delete();
        return redirect()->route('admin.menus',["link" => $link])->with('success','Успешно удалено');
    }



}

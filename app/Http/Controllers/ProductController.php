<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Menu;
use App\Models\Article;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $articles = Article::where('razid', '61')->orderBy('id', 'desc')->get();
        $questions = Article::where('razid', '8')->orderBy('orderid')->get();
        return view('pages.product', compact('questions','articles'));

    }
    public function annuitet()
    {
        $articles = Article::where('razid', '62')->orderBy('id', 'desc')->get();
        $questions = Article::where('razid', '55')->orderBy('orderid')->get();
        return view('pages.annuitet', compact('questions','articles'));
    }

    public function live()
    {
        $articles = Article::where('razid', '63')->orderBy('id', 'desc')->get();
        $questions = Article::where('razid', '56')->orderBy('orderid')->get();
        return view('pages.live', compact('questions','articles'));
    }

    public function retirementinsurance()
    {
        $articles = Article::where('razid', '66')->orderBy('id', 'desc')->get();
        $questions = Article::where('razid', '65')->orderBy('orderid')->get();
        return view('pages.retirementinsurance', compact('questions','articles'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Menu;
use App\Models\Article;
use Illuminate\Http\Request;
use File;

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
        return view('pages.live');
    }
    public function live_gccj()
    {
        $articles = Article::where('razid', '97')->orderBy('id', 'desc')->get();
        $questions = Article::where('razid', '96')->orderBy('orderid')->get();
        return view('pages.live_detail', compact('questions','articles'));
    }
    public function live_zaemwik()
    {
        $articles = Article::where('razid', '100')->orderBy('id', 'desc')->get();
        $questions = Article::where('razid', '99')->orderBy('orderid')->get();
        return view('pages.live_detail', compact('questions','articles'));
    }
    public function live_nsj()
    {
        $articles = Article::where('razid', '63')->orderBy('id', 'desc')->get();
        $questions = Article::where('razid', '56')->orderBy('orderid')->get();
        return view('pages.live_detail', compact('questions','articles'));
    }
    public function live_ncj_rebenka()
    {
        $articles = Article::where('razid', '106')->orderBy('id', 'desc')->get();
        $questions = Article::where('razid', '105')->orderBy('orderid')->get();
        return view('pages.live_detail', compact('questions','articles'));
    }
    public function live_nsj_valutnyi()
    {
        $articles = Article::where('razid', '109')->orderBy('id', 'desc')->get();
        $questions = Article::where('razid', '108')->orderBy('orderid')->get();
        return view('pages.live_detail', compact('questions','articles'));
    }

    public function retirementinsurance()
    {
        $articles = Article::where('razid', '66')->orderBy('id', 'desc')->get();
        $questions = Article::where('razid', '65')->orderBy('orderid')->get();
        return view('pages.retirementinsurance', compact('questions','articles'));
    }

    function FBytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, intval($precision)) . ' ' . $units[$pow];
    }

    public function convertClassTinyMce($articles)
    {
        foreach ($articles as $article){
            if (preg_match_all('/<a[^>]*class="[^"]*file[^"]*"[^>]*>[^<]*<\/a>/', $article->tex_ru, $m)) {
                foreach ($m[0] as $k => $v) {
                    preg_match('/href="([^"]+)"/', $v, $links);
                    if (count($links) == 2) {
                        $linktex = strip_tags($v);
//                        echo $links[1]."\r\n";
                        $links[1] = substr($links[1],8);
                        $filesize = $this->FBytes(\File::size(public_path($links[1])),$links[1]);
//                        dd($filesize);
                        $namefull =explode(".", $links[1]);
                        $link = '<a href="' . $links[1] . '" download class="link link--download" ><span class="link__ext">'
                            . end($namefull) . '</span> ' . $linktex . ' <span class="link__size">[' . $filesize . ']</span></a>';
                        $article->tex_ru = str_replace($v, $link, $article->tex_ru);
                    }
                }

            }
            if (preg_match_all('/<a[^>]*class="[^"]*file[^"]*"[^>]*>[^<]*<\/a>/', $article->tex_kz, $m)) {
                foreach ($m[0] as $k => $v) {
                    preg_match('/href="([^"]+)"/', $v, $links);
                    if (count($links) == 2) {
                        $linktex = strip_tags($v);
//                        echo $links[1]."\r\n";
                        $links[1] = substr($links[1],8);
                        $filesize = $this->FBytes(\File::size(public_path($links[1])),$links[1]);
//                        dd($filesize);
                        $namefull =explode(".", $links[1]);
                        $link = '<a href="' . $links[1] . '" download class="link link--download" ><span class="link__ext">' . end($namefull) . '</span> ' . $linktex . ' <span class="link__size">[' . $filesize . ']</span></a>';
                        $article->tex_kz = str_replace($v, $link, $article->tex_kz);
                    }
                }

            }
        }

        return $articles;
    }
}

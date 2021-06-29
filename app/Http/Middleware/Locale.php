<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class Locale
{


    public static $mainLanguage = 'ru';

    public  static $languages = ['kz',];

    public static function getLocale(){

        $uri = request()->path();

        $segmentsURI = explode('/', $uri);

        if(!empty($segmentsURI[0]) && in_array($segmentsURI[0], self::$languages)){

            if ($segmentsURI[0] != self::$mainLanguage){
                return $segmentsURI[0];
            }

        }
        return null;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle(Request $request, Closure $next)
    {
        $locale = self::getLocale();
        if(!$locale){
            $locale = self::$mainLanguage;
        }
    app()->setLocale($locale);
    if(Cookie::get('lang') != $locale){
        return $next($request);
    }
        return $next($request);
    }
}


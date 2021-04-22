<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Article extends Model
{
    public function year(){
        return $this->belongsTo(Menu::class,'raz' , 'link');
    }

    public function route(){
        return route('press_detail', ['id'=>$this->id, "language" => App::getLocale() , "year" => $this->year->name_ru , "alias"=>str_slug($this->name_ru, '-' )]) ;
    }
    use HasFactory;
}

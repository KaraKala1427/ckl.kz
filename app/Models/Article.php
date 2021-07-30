<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Article extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
      'name_ru',
      'dat',
      'description_ru',
      'head_ru',
      'text_ru'
    ];

    protected $dates = [
        'dat',
        'pubdat'
    ];

    public function year(){
        return $this->belongsTo(Menu::class,'raz' , 'link');
    }

    public function route(){
        return route('press_detail', ['id'=>$this->id, "year" => $this->year->name_ru , "alias"=>str_slug($this->name_ru, '-' )]) ;
    }
    public function city(){
        return $this->belongsTo(Menu::class,'razid','link');
    }

    public static function boot()
    {
        parent::boot();
        Article::observe(new \App\Observers\AdminActionsObserver);
    }

}

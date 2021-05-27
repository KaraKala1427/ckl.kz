<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public $timestamps = false;
    protected $fillable = ['orderid','link'];

    public function children(){
        return $this->hasMany(Menu::class , 'level','id');
    }
    use HasFactory;
}

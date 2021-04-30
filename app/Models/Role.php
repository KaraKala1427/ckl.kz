<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    const SUPER_ADMIN = 1;
    const ADMIN = 2;
    protected $fillable = ['name'];


}

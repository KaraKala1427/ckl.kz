<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public const STATUS_ACCEPTED = 'signed';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_PENDING = 'pending';
    public const STATUS_IN_PROCESS = 'paid';
    public const STATUS_ERROR = 'error';
    public const STATUS_CALCULATED = 'calculated';



    use HasFactory;
    protected $fillable = [
        'iin',
        'Phone',
        'Email',
        'Calc_Sum',
        'First_Name',
        'Last_Name',
        'Patronymic_Name',
        'Born',
        'DOCUMENT_GIVED_DATE',
        'DOCUMENT_NUMBER'
    ];



}


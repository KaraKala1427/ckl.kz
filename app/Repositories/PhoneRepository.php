<?php


namespace App\Repositories;


use App\Models\Phone;
use Carbon\Carbon;

class PhoneRepository
{
    public function create($orderId, $phone,$code)
    {
        $data = [
            'order_id' => $orderId,
            'phone' => $phone,
            'verification_code' => $code
        ];
        return Phone::Create($data);
    }

    public function getByOrderId($orderId)
    {
        return Phone::where('order_id', $orderId)->orderBy('created_at', 'desc')->first();
    }

    public function getRecordsLast30minutes(Phone $model)
    {
        $start = Carbon::parse($model->created_at)->subMinutes(30);
        $a =  Phone::where('order_id',$model->order_id)->where('created_at','>=',$start)->count();
        return $a;
    }
    public function ifPast30minutes(Phone $model)
    {
        $start = Carbon::parse($model->created_at);
        $end = Carbon::now();
        $result = $end->diffInMinutes($start);
        if($result < 30) return 30-$result;
        return false;
    }

    public function getLast3Records($orderId)
    {
        return Phone::where('order_id', $orderId)->orderBy('created_at', 'desc')->limit(3)->get();
    }

    public function checkWrongAttemptsLimitReached(Phone $model)
    {
        if ($model->wrong_attempts > 2) return true;
        return false;
    }


}

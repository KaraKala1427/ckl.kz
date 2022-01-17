<?php


namespace App\Services\Products;


use App\Models\Order;
use App\Models\Phone;
use App\Repositories\PhoneRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CovidService
{
    protected $phoneRepository;

    public function __construct(PhoneRepository $phoneRepository)
    {
        $this->phoneRepository = $phoneRepository;
    }

    public function confirmCode($order_id, $code)
    {
        $model = $this->phoneRepository->getByOrderId($order_id);
        $limitReached = false;
        $timeLimitReached = false;
        if(!is_null($model)){
            if ($this->checkCode($model,$code)){
                return [
                    'success' => true
                ];
            }
            else{
                $this->wrongAttemptIncrement($model);
                $limitReached = $model->wrong_attempts == 3 ? true : $limitReached;
                if($limitReached) $timeLimitReached = $this->getTimeIfLimitReached($order_id);
                return [
                    'success' => false,
                    'limit_reached' => $limitReached,
                    'time_limit_reached' => $timeLimitReached
                ];
            }
        }
        return [
            'success' => false,
            'limit_reached' => false
        ];
    }


    public function checkCode(Phone $model, $code)
    {
        if ($model->verification_code == $code){
            $model->verified = true;
            $model->save();
            return true;
        }
        return false;
    }
    public function isVerified($order_id)
    {
        $model = $this->phoneRepository->getByOrderId($order_id);
        if(!is_null($model)){
            if($model->verified) return true;
            return false;
        }
        return false;
    }

    public function wrongAttemptIncrement(Phone $model)
    {
        $model->wrong_attempts +=1;
        $model->save();
    }

    public function getWrongAttempts($order_id)
    {
        $model = $this->phoneRepository->getByOrderId($order_id);
        if(!is_null($model)){
            return $model->wrong_attempts;
        }
        return 0;
    }

    public function IsAllowedDate(Order $order)
    {
        $dateBeg = Carbon::parse($this->getFieldOrderData($order, 'dateBeg'));
        $today = Carbon::parse(Carbon::now());
        $difference = $today->diffInDays($dateBeg);
        if ($difference >= 6)  return 'true';
        return 'false';
    }
    public function getFieldOrderData(Order $order, $param , $key = 0)
    {
        $data = json_decode($order->order_data, true)[$key];
        return $data[$param];
    }

    public function getFieldData($order_id, $param = null)
    {
        try {
            $order = Order::findOrFail($order_id);
            return $order->getAttributeValue($param);
        }
        catch (ModelNotFoundException $e)
        {
            return view('pages.covid');
        }
    }

    public function getLastTimeOfSms($order_id)
    {
        $model = $this->phoneRepository->getByOrderId($order_id);
        if(!is_null($model)){
            $a = Carbon::parse($model->created_at);
            $b = Carbon::parse(Carbon::now());
            return $b->diffInSeconds($a);
        }
        return null;
    }

    public function checkTimeLimit(Phone $model)
    {
        $count = $this->phoneRepository->getRecordsLast30minutes($model);
        if($count > 2) return true;
        return false;
    }

    public function getTimeIfLimitReached($order_id, $sendsms = false)
    {
        $last3records = $this->phoneRepository->getLast3Records($order_id);
        if (is_null($last3records)) return null;
        if(count($last3records) > 2) {
            $last = $last3records[2];
            $check3wrong = $this->phoneRepository->checkWrongAttemptsLimitReached($last3records[0]);
            if ($check3wrong){
                $remainMinutes = $this->phoneRepository->ifPast30minutes($last);
                if ($remainMinutes > 0){
                    return [
                        'number' => $remainMinutes,
                        'type'   => 'мин.'
                    ];
                }
                return null;
            }
            else
            {
                if($sendsms || !$check3wrong){
                    $remainMinutes = $this->phoneRepository->ifPast30minutes($last);
                    if ($remainMinutes > 0){
                        return [
                            'number' => $remainMinutes,
                            'type'   => 'мин.',
                            'showCodedivs' => 'true'
                        ];
                    }
                    return null;
                }
                else{
                    $remainSeconds = $this->getLastTimeOfSms($order_id);
                    if($remainSeconds < 60){
                        return [
                            'number' => $remainSeconds,
                            'type' => 'сек.',
                            'sendsms_function' => $sendsms

                        ];
                    }
                    return null;
                }
            }
        }
        else {
            $remainSeconds = $this->getLastTimeOfSms($order_id);
            if($remainSeconds < 60 && $remainSeconds != null){
                return [
                    'number' => $remainSeconds,
                    'type' => 'сек.'
                ];
            }
            return null;
        }
    }

}

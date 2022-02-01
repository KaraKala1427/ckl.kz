<?php


namespace App\Services\Products;


use App\Http\Controllers\MailController;
use App\Models\Article;
use App\Models\Order;
use App\Models\Phone;
use App\Repositories\PhoneRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Http;

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


    public function sendOrderEmail(Order $order)
    {
        $order_data = json_decode($order->order_data,true)[0];
        $email_array = [
            'order_id' => $order->id,
            'premium' => $order->premium_sum,
            'phone' => $order->phone,
            'email' => $order->email,
            'iin' => $order->iin,
            'first_name' => $order->first_name,
            'last_name' => $order->last_name,
            'agr_isn' => $order->agr_isn,
            'programISN' => $order_data['programISN'],
            'date_start' => $order_data['dateBeg'],
            'date_end' => $order_data['dateEnd']
        ];
        MailController::sendOrderToEmail($email_array);
        $order->email_calculation_sent = 'true';
        $order->save();
    }

    public function sendOrderPaidEmailSuccess(Order $order)
    {
        $order_data = json_decode($order->order_data,true)[0];
        $email_array = [
            'agr_id' => $order->policy_result,
            'order_id' => $order->id,
            'premium' => $order->premium_sum,
            'phone' => $order->phone,
            'email' => $order->email,
            'iin' => $order->iin,
            'first_name' => $order->first_name,
            'last_name' => $order->last_name,
            'agr_isn' => $order->agr_isn,
            'programISN' => $order_data['programISN'],
            'date_start' => $order_data['dateBeg'],
            'date_end' => $order_data['dateEnd']
        ];
        MailController::sendOrderPaidEmail($email_array);
    }

    public function sendOrderPaidEmailFail(Order $order, $message)
    {
        $order_data = json_decode($order->order_data,true)[0];
        $email_array = [
            'agr_id' => $order->policy_result,
            'order_id' => $order->id,
            'premium' => $order->premium_sum,
            'phone' => $order->phone,
            'email' => $order->email,
            'iin' => $order->iin,
            'first_name' => $order->first_name,
            'last_name' => $order->last_name,
            'agr_isn' => $order->agr_isn,
            'programISN' => $order_data['programISN'],
            'date_start' => $order_data['dateBeg'],
            'date_end' => $order_data['dateEnd'],
            'message1' => $message
        ];
        MailController::sendOrderPaidEmailFail($email_array);
    }


    public function saveAgrToEsbd($orderId)
    {
        $agrIsn = $this->getFieldData($orderId, 'agr_isn');

        $response = Http::withOptions(['verify' => false])->post('https://connect.cic.kz/centras/ckl/save-agr-to-esbd',[
            "token"     => "wesvk345sQWedva55sfsd*g",
            "agrISN"   => $agrIsn
        ])->json();

        return $response;
    }

    public function setAgrStatus($orderId)
    {
        $agrIsn = $this->getFieldData($orderId, 'agr_isn');

        $response = Http::withOptions(['verify' => false])->post('https://connect.cic.kz/centras/ckl/set-agr-status',[
            "token"    => "wesvk345sQWedva55sfsd*g",
            "agrISN"   => $agrIsn,
            "status"   => 'П'
        ])->json();

        $order = Order::findOrFail($orderId);
        $order->status = Order::STATUS_ACCEPTED;
        $order->save();

        return $response;
    }

    public function getAgrId($orderId)
    {
        $agrIsn = $this->getFieldData($orderId, 'agr_isn');
        $response = Http::withOptions(['verify' => false])->post('https://connect.cic.kz/centras/ckl/get-agr-id',[
            "token"    => "wesvk345sQWedva55sfsd*g",
            "agr_isn"   => $agrIsn
        ])->json();

        return $response;
    }

    public function savePostLink($id, $status, $response)
    {
        $order = Order::findOrFail($id);
        $order->status = Order::STATUS_IN_PROCESS;
        $order->postlink = $response.PHP_EOL."-----------".PHP_EOL.$status;
        $order->save();
    }

    public function savePolicyResult($id, $array)
    {
        try {
            $agrId = $array['agr_id'];
            $order = Order::findOrFail($id);
            $order->policy_result = $agrId;
            $order->save();
        }
        catch (\Exception $e)
        {
            return 'false';
        }
    }

    public function getById($id)
    {
        return Order::findOrFail($id);
    }

    public function sendSmsToPhone($phone, $code)
    {
        $text = "Вы заключаете договор страхования жизни на случай заболевания COVID-19. Ваш проверочный код $code";
        $response = Http::withOptions(['verify' => false])->get('https://www2.smsc.kz/sys/send.php',[
            "fmt"     => "3",
            "login"   => "CKL_KZ",
            "psw"     => "Uh46ss189",
            "phones"  => "+$phone",
            "mes"     =>  $text
        ])->json();
        return $response;
    }

    public function checkServerOnline()
    {
        $article = Article::where('raz', 'link111')->get()->first();
        if($article->show_image_in_text == 'on')
            return $article->show_thumb;
        return 'true';
    }



    public function sendSmsLinkToPhone($phone, $url)
    {
        $text = "Для оплаты вашего договора перейдите по ссылке url $url";
        $response = Http::withOptions(['verify' => false])->get('https://www2.smsc.kz/sys/send.php',[
            "fmt"     => "3",
            "login"   => "CKL_KZ",
            "psw"     => "Uh46ss189",
            "phones"  => "+$phone",
            "mes"     =>  $text
        ])->json();
        return $response;
    }



}

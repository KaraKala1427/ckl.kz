<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{
    public function basic_email()
    {
        $data = array('name' => "LaraCast");
        Mail::send(['text' => 'mail'], $data, function ($message) {
            $message->to('ernarerbol027@gmail.com', 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
                $message->from('ps.yii@gmail.com', 'LaraCast');
        });
        echo "Basic Email Sent. Check your inbox.";
    }

    public function html_email(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'phone' => 'required'
        ]);

        $array = ($request->request->all());
        $data = array('fullname' => $array['fullname'], 'phone' => $array['phone'],
            'call_date' => $array['call_date'], 'call_now' => $array['call_now']);
        $Mali = new Email();
        $Mali->fullname = $array['fullname'];
        $Mali->phone = $array['phone'];
        $Mali->call_date = $array['call_date'];
        $json_array = json_encode($data);
        $Mali->data = $json_array;
        $Mali->save();
        Mail::send('mail', $data, function ($message) {
            $message->to('ernarerbol027@gmail.com', 'Callback')->subject
            ('Centras Kommesk Life');
            $message->from('y.yerboluly@kommesk-omir.kz', 'Rustam from Kommesk Omir');
        });

//        echo "HTML Email Sent. Check your inbox.";
        echo 'true';
    }




    public function attachment_email()
    {
        $data = array('name' => "LaraCast");
        Mail::send('mail', $data, function ($message) {
            $message->to('ernarerbol027@gmail.com', 'Tutorials Point')->subject
            ('Laravel Testing Mail with Attachment');
            $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
            $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
            $message->from('y.yerboluly@kommesk-omir.kz', 'LaraCast');
        });
        echo "Email Sent with attachment. Check your inbox.";
    }



    public function basic_mail()
    {
        $data = array('name' => "Virat Gandhi");
        Mail::send(['text' => 'email'], $data, function ($message) {
            $message->to('ernarerbol027@gmail.com', 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
            $message->from('y.yerboluly@kommesk-omir.kz', 'LaraCast');
        });
        echo "Basic Email Sent. Check your inbox.";
    }


    public function html_mail(Request $request)
    {

//        dd($request->request->all());
        $array = ($request->request->all());
        $data = array('frompage' => $array['frompage'], 'fullname' => $array['fullname'], 'phone' => $array['phone'],
            'email' => $array['email'], 'qst' => $array['qst']);

        $writeToDataJson= array('frompage' => $array['frompage'],'email' => $array['email'], 'qst' => $array['qst']);

        $Mali = new Email();
        $Mali->fullname = $array['fullname'];
        $Mali->phone = $array['phone'];
        $Mali->call_date = date('Y-m-d H:i:s');
        $json_array = json_encode($writeToDataJson);
        $Mali->data = $json_array;
        $Mali->save();
//        dd($data);
        Mail::send('email', $data, function ($message) {
            $message->to('ernarerbol027@gmail.com', 'Callback')->subject
            ('Centras Kommesk Life');
            $message->from('y.yerboluly@kommesk-omir.kz', 'Rustam from Kommesk Omir');
        });

       echo 'true';
    }



    public function attachment_mail()
    {
        $data = array('name' => "LaraCast");
        Mail::send('email', $data, function ($message) {
            $message->to('ernarerbol027@gmail.com', 'Tutorials Point')->subject
            ('Laravel Testing Mail with Attachment');
            $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
            $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
            $message->from('y.yerboluly@kommesk-omir.kz', 'Laracast');
        });
        echo "Email Sent with attachment. Check your inbox.";
    }


}

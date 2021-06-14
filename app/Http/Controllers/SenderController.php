<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;
use App\Models\Sender;
use Redirect;
class SenderController extends Controller
{
    public function send($to, $message)
    {
        $username = "mhealthuser";
        $apiKey = "1f6943f6c8f0d5d6b0dd54cd940935bdec8f7454c4e7863672048dae496ae355";
        $AT       = new AfricasTalking($username, $apiKey);

        // Get one of the services
        $sms      = $AT->sms();
        // Use the service
        $send   = $sms->send([
                        'from' => '40146',
                        'to'      => $to,
                        'message' => $message
                    ]);


        if ($send) {
            $sent = new Sender;
            $sent->number = $to;
            $sent->message = $message;
            foreach ($send['data'] as $data) {
                $dts = $data->Recipients;
                foreach ($dts as $dt) {
                    date_default_timezone_set('UTC');
                    $date = date('Y-m-d H:i:s', time());

                    $sent->status = $dt->status;
                    $sent->statusCode = $dt->statusCode;
                    $sent->messageId = $dt->messageId;
                    $sent->cost = $dt->cost;
                    $sent->updated_at = $date;
                    $sent->created_at = $date;
                }
            }
            $sent->save();
            return Redirect::back()->with($send);
        }
        return Redirect::back();
    }
}

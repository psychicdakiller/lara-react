<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Twilio\Rest\Client;
// use App\OtpServices\Twilio;
use Illuminate\Support\Facades\Cache;

class TwiloController extends Controller
{
    public function sendOTP()
    {
        $otp = rand(000000, 999999); // Generates a 6-character OTP

        $sid = config('services.twilio.sid');
        $token = config('services.twilio.token');
        $twilio = new Client($sid, $token);

        $to = '+959123456789'; // Replace with the recipient's phone number
        $from = config('services.twilio.phone_number');
        $message = "Your OTP is: $otp";

        $twilio->messages->create($to, ['from' => $from, 'body' => $message]);

        Cache::put('test', $otp, now()->addMinutes(60));
        print($message);
    }

    public function twiloOTP()
    {
        // code...
    }
}

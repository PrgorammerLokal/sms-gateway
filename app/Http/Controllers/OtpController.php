<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OtpController extends Controller
{
    public function send(Request $request)
    {
        $otp = mt_rand(1000, 10000);
        $request->session()->put('otp', $otp);
        $basic  = new \Vonage\Client\Credentials\Basic("8e2ecf10", "KMMxNlp7rXRyL93F");
        $client = new \Vonage\Client($basic);
        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS($request->phone_number, 'Programmer Lokal', "Kode Otp " . $request->session()->get('otp') . " jangan kasih kode ini kepada siapapun ")
        );

        $message = $response->current();

        if ($message->getStatus() == 0) {
            return response()->json([
                'status' => true,
                'message' => 'The message was sent successfully',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => "The message failed with status: " . $message->getStatus() . "\n"
            ], 400);
        }
    }

    public function verify(Request $request)
    {
        if ($request->otp == $request->session()->get('otp')) {
            $request->session()->forget('otp');
            return response()->json([
                'status' => true,
                'message' => 'Verfikasi Berhasil'
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => 'Kode Otp tidak valid'
        ], 404);
    }
}

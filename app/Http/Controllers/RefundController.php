<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class RefundController extends Controller
{
    public function COPYandPay(Request $request)
    {
            $url = "https://test.oppwa.com/v1/payments/".$request->paymentId;
            $data = "entityId=8ac7a4ca759cd78501759dd759ad02df" .
                        "&paymentType=RV";
        
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                           'Authorization:Bearer OGFjN2E0Y2E3NTljZDc4NTAxNzU5ZGQ3NThhYjAyZGR8NTNybThiSmpxWQ=='));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $responseData = curl_exec($ch);
            if(curl_errno($ch)) {
                return curl_error($ch);
            }
            curl_close($ch);

            $returnedData = json_decode($responseData,true);   


            if($returnedData['result']['code'] == '000.100.110') {
            DB::table('payments')->where('paymentId', $returnedData['referencedId'])->delete();
            }

            return redirect()->route('dashboard')->with('resCode', $returnedData['result']['code'])->with('resDesc', $returnedData['result']['description']);

    }
}

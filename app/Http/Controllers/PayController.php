<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayController extends Controller
{
    public function COPYandPay(Request $request)
    {

        $url = "https://test.oppwa.com/v1/checkouts/".$request->id."/payment";
        $url .= "?entityId=8ac7a4ca759cd78501759dd759ad02df";
	    
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                   'Authorization:Bearer OGFjN2E0Y2E3NTljZDc4NTAxNzU5ZGQ3NThhYjAyZGR8NTNybThiSmpxWQ=='));
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$responseData = curl_exec($ch);
	if(curl_errno($ch)) {
		return curl_error($ch);
	}
	curl_close($ch);

    $returnedData = json_decode($responseData,true);

   $request->user()->payments()->create([
      'amount' => $returnedData['amount'],
      'paymentId' => $returnedData['id'],
      'merchantTransactionId'  => $returnedData['merchantTransactionId'],
      'billingAddress'  => json_encode($returnedData['billing'])
   ]);


    $request->session()->forget(['checkoutId','amount']);
	return redirect()->route('dashboard')->with('resCode', $returnedData['result']['code'])->with('resDesc', $returnedData['result']['description']);
    }

    


}

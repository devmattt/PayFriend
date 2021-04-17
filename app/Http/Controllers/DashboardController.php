<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); 
        $payments = Payment::where('user_id', $userId)->get();
        return view('dashboard.index', [
            'payments' => $payments
        ]);
    }

    public function COPYandPay(Request $request)
    {

        $this->validate($request, [
            'amount'=>'required|numeric',
            'merchantTransactionId'=>'required'
        ]);

        $url = "https://test.oppwa.com/v1/checkouts";
        $data = "entityId=8ac7a4ca759cd78501759dd759ad02df" .
                "&merchantTransactionId=".$request->merchantTransactionId.
                "&amount=".$request->amount.
                "&currency=EUR" .
                "&paymentType=DB";

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

        return redirect()->route('dashboard')->with('checkoutId', $returnedData['id'])->with('merchantTransactionId', $request->merchantTransactionId)->with('amount', $request->amount);
    }
    
}



<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Paystack;

class PaymentController extends Controller
{
    //
    public function redirectToGateway() {
        try {
            return Paystack::getAuthorizationUrl()->redirectNow();
        }
        catch(\Exception $e) {
            return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        }
    }


    public function handleGatewayCallback() {
        $paymentDetails = Paystack::getPaymentData();

        dd($paymentDetails);
    }
}

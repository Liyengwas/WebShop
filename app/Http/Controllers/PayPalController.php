<?php

namespace App\Http\Controllers;

use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalController extends Controller
{
    //handle payment
    public function getExpressCheckout(){

        $checkoutData = $this->checkoutData();

        $provider = new ExpressCheckout();

        $response = $provider->setExpressCheckout($checkoutData);

        // dd($response);

        return redirect($response['paypal_link']);

    }

    private function checkoutData(){
        $cart = \Cart::session(auth()->id());
        // dd($cart->getContent()->toarray());

            $cartItems = array_map(
                function($item){
                    return [
                        'name'=>$item['name'],
                        'price'=>$item['price'],
                        'qty'=>$item['quantity']
                    ];
                }, $cart->getContent()->toarray());

                // dd($cartItems);

        $checkoutData =[
            'items' => $cartItems,
            //redirect after successful payment
            'return_url' =>route('paypal.success'),
            //cancel url
            'cancel_url' =>route('paypal.cancel'),
            //generate invoice id
            'invoice_id'=>uniqid(),
            'invoice_description'=>"Order description",
            'total'=>$cart->getTotal()

        ];

        return $checkoutData;
    }

    //cancel url function
    public function cancalPage(){

        dd('payment failed');

    }

    //Successful checkout
     public function getExpressCheckoutSuccess(Request $request)
    {
        //get the token
        $token=$request->get('token');
        //get payerID
        $payerID=$request->get('PayerID');

        $provider = new ExpressCheckout();
        //import checkoutData
        $checkoutData = $this->checkoutData();

        $response = $provider->getExpressCheckoutDetails($token);

        //check if payment process went successfully
        if(in_array(strtoupper($response['ACK']),['SUCCESS','SUCCESSWITHWARNING']) ){
            //express checkout is done here
            //Perform the transaction on Paypal
            $payment_status = $provider->doExpressCheckoutPayment($checkoutData, $token, $payerID);
            $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];
        }

        dd('Payment Successful');

    }
}

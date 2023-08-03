<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;

class PayPalController extends Controller
{
    public function processPayment(Request $request){
        $this->validate($request, [
            'productId' => 'required',
            'qty' => 'required',
        ]);

        $product = Products::findorFail($request->productId);

        if(!isset($product) && empty($product)){
            $this->paymentCancel();
        }

        $totalPrice = $product->price * $request->qty;
    
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                config('services.paypal.client_id'),
                config('services.paypal.secret')
            )
        );

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setCurrency('USD');
        $amount->setTotal($totalPrice); 

        $transaction = new Transaction();
        $transaction->setAmount($amount);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('payment.success'))
            ->setCancelUrl(route('payment.cancel'));

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions([$transaction])
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($apiContext);
            return redirect($payment->getApprovalLink());
        } catch (\Exception $e) {
            return $e->getMessage();
        }        
    }

    public function paymentSuccess(Request $request){
        \Session::flash('success','Payment is done successfully!');
        return redirect()->route('home');
    }

    public function paymentCancel(Request $request){
        \Session::flash('error','Payment was canceled!');
        return redirect()->route('home');
    }
}

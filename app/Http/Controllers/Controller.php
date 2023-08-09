<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Orders;
use App\Models\OrderItems;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function image($photo, $path){
        $root = storage_path('app/public/uploads/'.$path);
        $name = Str::random(20).".".$photo->getClientOriginalExtension();
        if (!file_exists($root)) {
            mkdir($root, 0777, true);
        }
        $photo->move($root,$name);
        return 'uploads/'.$path."/".$name;
    }

    public function sendSuccessOrderEmail($order){
        if(isset($order) && !empty($order)){
            $data['orders'] = Orders::where('id',$order->id)->first();
            $data['orderItems'] = OrderItems::where('order_id', $order->id)->get();
            $totalPrice = OrderItems::where('order_id', $order->id)->sum('total');
            $data['totalPrice'] = isset($totalPrice) && !empty($totalPrice) ? number_format($totalPrice,2, '.', '') : 0.00;
            //Mail Send
<<<<<<< HEAD
<<<<<<< HEAD
            \Mail::send('mail_template.order_mail_template',$data, function($message) {
=======
            \Mail::send('order_mail_template',$data, function($message) {
>>>>>>> e2c6c8b172807c0486e37fd2385871c96cb984b9
=======
            \Mail::send('order_mail_template',$data, function($message) {
>>>>>>> e2c6c8b172807c0486e37fd2385871c96cb984b9
                $message->from('emmanuel.k.php@gmail.com');
                $message->to($order->customer_email);
                $message->subject("Order Placed");
            });

            return 1;
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cart;
use App\Models\ContactUs;
use App\Models\ProductImages;
use App\Models\Products;
use App\Models\Orders;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /*public function __construct(){
        $this->middleware('auth');
    }*/

    public function index()
    {
        $data['products'] = Products::with('ProductImages')->where('status', 'active')->get();

        $data['cart_products'] = [];
        if(Auth::check()){
            $user = Auth::user();
            $data['cart_products'] = Cart::with('Product','Product.ProductImages')->where('user_id',$user->id)->get();

            $data['user'] = $user;

            $data['cart_total'] = Cart::where('user_id', $user)->sum('sub_total');

        }

        return view('home',$data);
    }

    public function contact_us()
    {
        return view('contact_us');
    }

    public function storeContactInfo(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $input = $request->all();
        ContactUs::create($input);
        \Session::flash('success', 'Thank you for getting in touch! We will get back in touch with you soon!Have a great day!');
        return redirect()->back();
    }

    public function getProduct(Request $request){
        $product = Products::where('id',$request['id'])->first();
        $data = [];
        if(!empty($product)){
            $image = ProductImages::where('product_id',$product['id'])->first();
            if(!empty($image)){
                $product['image'] = url('storage/'.$image['image']);
            }
            $data['id'] = $product['id'];
            $data['name'] = $product['name'];
            $data['price'] = '<i class="fa-solid fa-peso-sign"></i>'.number_format($product['price'],2, '.', '');
            $data['image'] = $product['image'];
        }
        return $data;
    }

    public function addToCart(Request $request){
        if(Auth::check()){
            $user = Auth::user()->id;
            $product = Products::where('id',$request['pId'])->first();
            $input['product_id'] = $product['id'];
            $input['price'] = $product['price'];
            $input['quantity'] = $request['qty'];
            $input['sub_total'] = $product['price'] * $request['qty'];
            $existCart = Cart::where('user_id',$user)->where('product_id',$request['pId'])->first();
            if(!empty($existCart)){
                $existCart->update($input);
            }else{
                $input['user_id'] = $user;
                Cart::create($input);
            }
            return 1;
        }else{
            return 0;
        }
    }

    public function updateToCart(Request $request){
        if(Auth::check()){
            $user = Auth::user()->id;
            $product = Products::where('id',$request['pId'])->first();

            if($request['qty']==0){
                Cart::where('user_id',$user)->where('product_id',$request['pId'])->delete();
            } else {
                $input['product_id'] = $product['id'];
                $input['price'] = $product['price'];
                $input['quantity'] = $request['qty'];
                $input['sub_total'] = $product['price'] * $request['qty'];
                $existCart = Cart::where('user_id',$user)->where('product_id',$request['pId'])->first();
                if(!empty($existCart)){
                    $existCart->update($input);
                }
            }
            return 1;
        }else{
            return 0;
        }
    }

    public function getCartProducts(Request $request){
        if(Auth::check()){
            $user = Auth::user()->id;
            $data['cart_products'] = Cart::with('Product','Product.ProductImages')->where('user_id',$user)->get()->all();

            $data['cart_total'] = number_format(Cart::where('user_id', $user)->sum('sub_total'),2, '.', '');
            return view('cart',$data);
        }else{
            return 0;
        }
    }

    public function getCartTotal()
    {
        if(Auth::check()){
            $user = Auth::user()->id;
            $data['cart_products'] = Cart::with('Product','Product.ProductImages')->where('user_id',$user)->get();

            return number_format(Cart::where('user_id', $user)->sum('sub_total'),2, '.', '');

        } else {
            return 0;
        }
    }

    public function addOrder(Request $request){
        if(Auth::check()){
            $user = Auth::user()->id;

            $cart_products = Cart::with('Product','Product.ProductImages')->where('user_id',$user)->get()->all();

            if(!empty($cart_products)){

                if($request['payment_type']=='cod'){

                    $input = $request->all();

                    $userDetails = User::with('Orders')->where('id',$user)->first();
                    $totalOrder = count($userDetails['Orders']) > 0 ? count($userDetails['Orders']) + 1 : 1;
                    $input['unique_id'] = strtoupper(substr($userDetails['name'],0,3)).'0'.$totalOrder;

                    $input['customer_id'] = $user;
                    $input['order_total'] = number_format(Cart::where('user_id', $user)->sum('sub_total'),2, '.', '');
                    $input['status'] = 'pending';
                    $order = Orders::create($input);

                    $orderTotal = 0;
                    $orderItems = [];
                    foreach($cart_products as $key => $value){

                        $product = Products::where('id',$value['product_id'])->where('status','active')->first();

                        $orderItems['order_id'] = $order['id'];
                        $orderItems['product_id'] = $value['product_id'];
                        $orderItems['sku'] = $product['sku'];
                        $orderItems['name'] = $product['name'];
                        $orderItems['quantity'] = $value['quantity'];
                        $orderItems['price'] = $value['price'];
                        $orderItems['total'] = ($value['price']*$value['quantity']);

                        $orderTotal = ($orderTotal+($value['price']*$value['quantity']));

                        OrderItems::create($orderItems);
                    }

                    $order_total['order_total'] = $orderTotal;
                    Orders::updateOrCreate(['id' => $order['id']], $order_total);

                    Cart::where('user_id',$user)->delete();

                    return 2;

                }else{
                    return 3;
                }
            }else{
                return 1;
            }
            
        }else{
            return 0;
        }
    }
}

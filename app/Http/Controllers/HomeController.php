<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use App\Models\ProductImages;
use App\Models\Products;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /*public function __construct(){
        $this->middleware('auth');
    }*/

    public function index()
    {
        $data['products'] = Products::with('ProductImages')->where('status', 'active')->get()->all();

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
}

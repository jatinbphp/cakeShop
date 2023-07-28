<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /*public function __construct(){
        $this->middleware('auth');
    }*/

    public function index()
    {
        return view('home');
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

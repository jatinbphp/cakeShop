<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Products;
use App\Models\Orders;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $data['menu'] = 'Dashboard';
        $data['users'] = User::where('role', '!=', 'admin')->count();
        $data['categories'] = Category::count();
        $data['products'] = Products::count();
        $data['orders'] = Orders::count();
        return view('admin.dashboard',$data);
    }
}

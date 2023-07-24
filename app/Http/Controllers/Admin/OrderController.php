<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\User;
use App\Models\Orders;
use App\Models\OrderItems;
use DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['menu'] = "Orders";
        $data['search'] = $request['search'];

        if ($request->ajax()) {
            $data = Orders::select();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('created_at', function($row){
                    return $row['created_at']->format('d-m-Y h:i:s');
                })
                ->addColumn('customer_id', function($row){
                    return $row['User']['name'];
                })
                ->addColumn('order_total', function($row){
                    return '<i class="fa fa-ruble-sign pr-2"></i>'.number_format($row['order_total'], 2, '.', '');
                })
                ->addColumn('status', function($row){
                    $statusBtn = '';
                    if ($row->status == "paid") {
                        $statusBtn .= '<span class="btn btn-success" type="button" style="padding:0 12px">'.ucwords($row->status).'</span>';
                    } else if ($row->status == "pending") {
                        $statusBtn .= '<span class="btn btn-warning" type="button" style="padding:0 12px">'.ucwords($row->status).'</span>';
                    } else if ($row->status == "reject") {
                        $statusBtn .= '<span class="btn btn-danger" type="button" style="padding:0 12px">'.ucwords($row->status).'</span>';
                    }
                    return $statusBtn;
                })
                ->addColumn('action', function($row){
                    $btn = '<div class="btn-group btn-group-sm"><a href="'.route('orders.edit',['order'=>$row->id]).'"><button class="btn btn-sm btn-info tip" data-toggle="tooltip" title="Edit Stock" data-trigger="hover" type="submit" ><i class="fa fa-edit"></i></button></a></div>';
                    $btn .= '<span data-toggle="tooltip" title="Delete Stock" data-trigger="hover">
                                    <button class="btn btn-sm btn-danger deleteOrder" data-id="'.$row->id.'" type="button"><i class="fa fa-trash"></i></button>
                                </span>';
                    return $btn;
                })
                ->rawColumns(['user','order_total','status','action'])
                ->make(true);
        }

        return view('admin.orders.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['menu'] = "Orders";
        $data['products'] = Products::where('status','active')->pluck('name','id')->prepend('Please Select','');
        $data['users'] = User::where('status','active')->where('role','customer')->pluck('name','id')->prepend('Please Select','');
        return view("admin.orders.create",$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'customer_id' => 'required',
            'order_date' => 'required',
            'order_time' => 'required',
            'status' => 'required',
            'address' => 'required',
        ]);

        $input = $request->all();
        $userDetails = User::where('id',$input['customer_id'])->first();
        $input['customer_name'] = $userDetails['name'];
        $input['customer_email'] = $userDetails['email'];
        $input['customer_phone'] = $userDetails['phone']; 
        $input['payment_type'] = 'cod';
        $order = Orders::create($input);
            
        $orderTotal = 0;
        $orderItems = [];
        if(!empty($input['product_id'])){
            foreach($input['product_id'] as $key => $value){
                $product = Products::where('id',$value)->where('status','active')->first();

                $orderItems['order_id'] = $order['id'];
                $orderItems['product_id'] = $value;
                $orderItems['sku'] = $product['sku'];
                $orderItems['name'] = $product['name'];
                $orderItems['quantity'] = $input['quantity'][$key];
                $orderItems['price'] = $input['price'][$key];
                $orderItems['total'] = ($input['price'][$key]*$input['quantity'][$key]);

                $orderTotal = ($orderTotal+($input['price'][$key]*$input['quantity'][$key]));

                OrderItems::create($orderItems);
            }
        }

        $order_total['order_total'] = $orderTotal;
        Orders::updateOrCreate(['id' => $order['id']], $order_total);
        
        \Session::flash('success', 'Order has been inserted successfully!');
        return redirect()->route('orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['menu'] = "Orders";
        $data['order'] = Orders::with('OrderItems')->findorFail($id);
        $data['products'] = Products::where('status','active')->pluck('name','id')->prepend('Please Select','');
        $data['users'] = User::where('status','active')->where('role','customer')->pluck('name','id')->prepend('Please Select','');
        return view("admin.orders.edit",$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'customer_id' => 'required',
            'order_date' => 'required',
            'order_time' => 'required',
            'status' => 'required',
            'address' => 'required',
        ]);

        $input = $request->all();
        $userDetails = User::where('id',$input['customer_id'])->first();
        $input['customer_name'] = $userDetails['name'];
        $input['customer_email'] = $userDetails['email'];
        $input['customer_phone'] = $userDetails['phone']; 
        $input['payment_type'] = 'cod';
        $order = Orders::findorFail($id);
        $order->update($input);

        OrderItems::where('order_id', $id)->delete();

        $orderTotal = 0;
        $orderItems = [];
        if(!empty($input['product_id'])){
            foreach($input['product_id'] as $key => $value){
                $product = Products::where('id',$value)->where('status','active')->first();

                $orderItems['order_id'] = $order['id'];
                $orderItems['product_id'] = $value;
                $orderItems['sku'] = $product['sku'];
                $orderItems['name'] = $product['name'];
                $orderItems['quantity'] = $input['quantity'][$key];
                $orderItems['price'] = $input['price'][$key];
                $orderItems['total'] = ($input['price'][$key]*$input['quantity'][$key]);

                $orderTotal = ($orderTotal+($input['price'][$key]*$input['quantity'][$key]));

                OrderItems::create($orderItems);
            }
        }

        $order_total['order_total'] = $orderTotal;
        Orders::updateOrCreate(['id' => $order['id']], $order_total);

        \Session::flash('success', 'Order has been updated successfully!');
        return redirect()->route('orders.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Orders::findOrFail($id);
        if(!empty($order)){
            OrderItems::where('order_id', $id)->delete();
            $order->delete();
            return 1;
        }else{
            return 0;
        }
    }

    public function getProductPrice(Request $request){
        $product = Products::where('id',$request['product_id'])->where('status','active')->first();
        return number_format($product['price'], 2, '.', '');
    }
}

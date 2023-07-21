<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use DB;
use Auth;

class CustomerController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $data['menu']="Customers";
        $data['search'] = $request['search'];

        if ($request->ajax()) {
            $data = User::where('id', '!=', Auth::user()->id)->select();

            return Datatables::of($data)
                    ->addIndexColumn()
                ->addColumn('status', function($row){
                    $statusBtn = '';
                    if ($row->status == "active") {
                        $statusBtn .= '<div class="btn-group-horizontal" id="assign_remove_"'.$row->id.'">
                        <button class="btn btn-success unassign ladda-button" data-style="slide-left" id="remove" url="'.route('customers.unassign').'" ruid="'.$row->id.'"  type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Active</span> </button>
                                                </div>';
                        $statusBtn .= '<div class="btn-group-horizontal" id="assign_add_"'.$row->id.'"  style="display: none"  >
                                                    <button class="btn btn-danger assign ladda-button" data-style="slide-left" id="assign" uid="'.$row->id.'" url="'.route('customers.assign').'" type="button"  style="height:28px; padding:0 12px"><span class="ladda-label">In Active</span></button>
                                                </div>';
                    } else {
                        $statusBtn .= '<div class="btn-group-horizontal" id="assign_add_"'.$row->id.'">
                                                    <button class="btn btn-danger assign ladda-button" id="assign" data-style="slide-left" uid="'.$row->id.'" url="'.route('customers.assign').'"  type="button" style="height:28px; padding:0 12px"><span class="ladda-label">In Active</span></button>
                                                </div>';
                        $statusBtn .= '<div class="btn-group-horizontal" id="assign_remove_"'.$row->id.'" style="display: none" >
                                                    <button class="btn  btn-success unassign ladda-button" id="remove" ruid="'.$row->id.'" data-style="slide-left" url="'.route('customers.unassign').'" type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Active</span></button>
                                                </div>';
                    }
                    return $statusBtn;
                })
                    ->addColumn('action', function($row){
                        $btn = '<div class="btn-group btn-group-sm"><a href="'.url('admin/customers/'.$row->id.'/edit').'"><button class="btn btn-sm btn-info tip" data-toggle="tooltip" title="Edit User" data-trigger="hover" type="submit" ><i class="fa fa-edit"></i></button></a></div>';

                        $btn .= '<span data-toggle="tooltip" title="Delete User" data-trigger="hover">
                                    <button class="btn btn-sm btn-danger deleteUser" data-id="'.$row->id.'" type="button"><i class="fa fa-trash"></i></button>
                                </span>';
                        return $btn;
                    })
                    ->rawColumns(['status','action'])
                    ->make(true);
        }

        return view('admin.customers.index', $data);
    }


    public function create()
    {
        $data['menu'] = "Customers";
        return view("admin.customers.create",$data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'confirmed|min:6',
            'phone' =>'required|numeric|nullable',
            'status' => 'required',
        ]);

        $input = $request->all();
        $input['role'] =  'customer';
        $user = User::create($input);

        \Session::flash('success', 'Customer has been inserted successfully!');
        return redirect()->route('customers.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data['menu']="Customers";
        $data['customers'] = User::findorFail($id);
        return view('admin.customers.edit',$data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id.',id',
            'password' => 'confirmed|nullable|min:6',
            'phone' =>'required|numeric|nullable',
            'status' => 'required',
        ]);

        if(empty($request['password'])){
            unset($request['password']);
        }

        $input = $request->all();
        $user = User::findorFail($id);
        $user->update($input);

        \Session::flash('success','User has been updated successfully!');
        return redirect()->route('customers.index');
    }


    public function destroy($id)
    {
        $users = User::findOrFail($id);
        if(!empty($users)){
            $users->delete();
            return 1;
        }else{
            return 0;
        }
    }

    public function assign(Request $request){
        $customer = User::findorFail($request['id']);
        $customer['status'] = "active";
        $customer->update($request->all());
    }

    public function unassign(Request $request){
        $customer = User::findorFail($request['id']);
        $customer['status'] = "inactive";
        $customer->update($request->all());
    }
}

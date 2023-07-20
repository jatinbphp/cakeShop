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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['menu']="Customers";
        $data['search'] = $request['search'];

        if ($request->ajax()) {
            $data = User::where('id', '!=', Auth::user()->id)->select();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status', function($row){
                        if ($row->status == "active") {
                            $statusBtn = 'Active';
                        } else {
                            $statusBtn = 'Inactive';
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['menu'] = "Add Customer";
        return view("admin.customers.create",$data);
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
        $data['menu']="Edit Customer";
        $data['customers'] = User::findorFail($id);
        return view('admin.customers.edit',$data);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
}

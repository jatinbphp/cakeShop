<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use DB;

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
                        $btn = '<div class="btn-group btn-group-sm"><a href="'.url('users/'.$row->id.'/edit').'"><button class="btn btn-sm btn-info tip" data-toggle="tooltip" title="Edit User" data-trigger="hover" type="submit" ><i class="fa fa-edit"></i></button></a></div>';
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

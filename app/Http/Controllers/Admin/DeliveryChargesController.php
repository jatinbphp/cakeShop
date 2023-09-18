<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryCharges;
use Illuminate\Http\Request;
use DataTables;

class DeliveryChargesController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['menu'] = "Delivery Charges";
        $data['search'] = $request['search'];

        if ($request->ajax()) {
            $data = DeliveryCharges::select();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    $statusBtn = '';
                    if ($row->status == "active") {
                        $statusBtn .= '<div class="btn-group-horizontal" id="assign_remove_"'.$row->id.'">
                        <button class="btn btn-success unassign ladda-button" data-style="slide-left" id="remove" url="'.route('deliverycharges.unassign').'" ruid="'.$row->id.'"  type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Active</span> </button>
                                                </div>';
                        $statusBtn .= '<div class="btn-group-horizontal" id="assign_add_"'.$row->id.'"  style="display: none"  >
                                                    <button class="btn btn-danger assign ladda-button" data-style="slide-left" id="assign" uid="'.$row->id.'" url="'.route('deliverycharges.assign').'" type="button"  style="height:28px; padding:0 12px"><span class="ladda-label">In Active</span></button>
                                                </div>';
                        //$statusBtn = 'Active';
                    } else {
                        $statusBtn .= '<div class="btn-group-horizontal" id="assign_add_"'.$row->id.'">
                                                    <button class="btn btn-danger assign ladda-button" id="assign" data-style="slide-left" uid="'.$row->id.'" url="'.route('deliverycharges.assign').'"  type="button" style="height:28px; padding:0 12px"><span class="ladda-label">In Active</span></button>
                                                </div>';
                        $statusBtn .= '<div class="btn-group-horizontal" id="assign_remove_"'.$row->id.'" style="display: none" >
                                                    <button class="btn  btn-success unassign ladda-button" id="remove" ruid="'.$row->id.'" data-style="slide-left" url="'.route('deliverycharges.unassign').'" type="button" style="height:28px; padding:0 12px"><span class="ladda-label">Active</span></button>
                                                </div>';
                        //$statusBtn = 'Inactive';
                    }
                    return $statusBtn;
                })
                ->addColumn('charge', function($row){
                    return '₱'.number_format($row['charge'], 2, '.', '');
                })
                ->addColumn('action', function($row){
                    $btn = '<div class="btn-group btn-group-sm"><a href="'.route('deliverycharges.edit',['deliverycharge'=>$row->id]).'"><button class="btn btn-sm btn-info tip" data-toggle="tooltip" title="Edit Pickup Point" data-trigger="hover" type="submit" ><i class="fa fa-edit"></i></button></a></div>';
                    $btn .= '<span data-toggle="tooltip" title="Delete deliverycharges" data-trigger="hover">
                                    <button class="btn btn-sm btn-danger deleteDeliverycharge" data-id="'.$row->id.'" type="button"><i class="fa fa-trash"></i></button>
                                </span>';
                    return $btn;
                })
                ->rawColumns(['status','action'])
                ->make(true);
        }

        return view('admin.deliverycharges.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['menu'] = "Delivery Charges";
        return view("admin.deliverycharges.create",$data);
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
            'city' => 'required',
            'charge' => 'required',
            'status' => 'required',
        ]);

        $input = $request->all();
        DeliveryCharges::create($input);

        \Session::flash('success', 'Pickup Point has been inserted successfully!');
        return redirect()->route('deliverycharges.index');
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
    public function edit(string $id)
    {
        $data['menu'] = "Delivery Charges";
        $data['deliverycharge'] = DeliveryCharges::findorFail($id);
        return view('admin.deliverycharges.edit',$data);
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
            'city' => 'required',
            'charge' => 'required',
            'status' => 'required',
        ]);

        $input = $request->all();
        $stock = DeliveryCharges::findorFail($id);
        $stock->update($input);
        \Session::flash('success','Pickup Point has been updated successfully!');
        return redirect()->route('deliverycharges.index');
    }

    public function destroy($id)
    {
        $deliverycharge = DeliveryCharges::findOrFail($id);
        if(!empty($deliverycharge)){
            $deliverycharge->delete();
            return 1;
        }else{
            return 0;
        }
    }

    public function assign(Request $request)
    {
        $deliverycharge = DeliveryCharges::findorFail($request['id']);
        $deliverycharge['status'] = "active";
        $deliverycharge->update($request->all());
    }

    public function unassign(Request $request)
    {
        $deliverycharge = DeliveryCharges::findorFail($request['id']);
        $deliverycharge['status'] = "inactive";
        $deliverycharge->update($request->all());
    }
}

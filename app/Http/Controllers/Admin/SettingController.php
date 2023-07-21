<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DataTables;



class SettingController extends Controller{
    
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        $data['menu']="Settings";
        if ($request->ajax()) {
            $data = Setting::select();
            return Datatables::of($data)
                
                ->addColumn('action', function($row){
                    $btn = '<div class="btn-group btn-group-sm"><a href="'.route('settings.edit',['setting'=>$row->id]).'"><button class="btn btn-sm btn-info tip" data-toggle="tooltip" title="Edit Setting" data-trigger="hover" type="submit" ><i class="fa fa-edit"></i></button></a></div>';
                    // $btn .= '<span data-toggle="tooltip" title="Delete Stock" data-trigger="hover">
                    //                 <button class="btn btn-sm btn-danger deleteSetting" data-id="'.$row->id.'" type="button"><i class="fa fa-trash"></i></button>
                    //             </span>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.settings.index', $data);
    }

    
    public function create(){
        $data['menu']="Settings";
        return view("admin.settings.create", $data);
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,gif', 
        ]);

        $input = $request->all();
        $input['image'] = ($request->file('image')->isValid()) ? $this->storeImage($request->file('image'), 'logo') : null;
        $setting = Setting::select()->first();;
        if(isset($setting) && !empty($setting)){
            $data['name'] = $input['name'];
            $data['image'] = $input['image'];
            Setting::where('id', $setting->id)->update($data);
        }else{
            Setting::create($input);
        }

         \Session::flash('success', 'Setting has been inserted successfully!');
        return redirect()->route('settings.index');
    }

    public function show($id){
        //
    }

    public function edit($id){
        $data['menu']="Settings";
        $data['settings'] = Setting::findorFail($id);
        return view('admin.settings.edit',$data);
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'image' => 'required',
        ]);

        $input = $request->all();

        if ($request->hasFile('image') &&  $request->file('image')->isValid()) {
            $input['image'] = $this->storeImage($request->file('image'), 'logo');
        }

        $Setting = Setting::findorFail($id);
        $Setting->update($input);

        \Session::flash('success','Setting has been updated successfully!');
        return redirect()->route('settings.index');
    }

    public function destroy($id){
        $settings = Setting::findOrFail($id);
        if(!empty($settings)){
            $settings->delete();
            return 1;
        }else{
            return 0;
        }
    }
    private function storeImage($file, $folder){
        $root = public_path('uploads/'.$folder);
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        if (!file_exists($root)) {
            mkdir($root, 0777, true);
        }

        $filepath = $root . '/' . $filename;
        file_put_contents($filepath, file_get_contents($file->getRealPath()));
        return $filename;
    }

    public function deleteSettingsImage(Request $request){
        $filename = public_path('uploads/logo/'. $request->image);
        if (file_exists($filename)) {
            if (unlink($filename)) {
                Setting::where('id', $request->id)->update(['image' => null]);
                return response()->json(1);
            }
        }
        return response()->json(0);
    }
}

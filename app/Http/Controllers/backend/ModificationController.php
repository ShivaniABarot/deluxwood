<?php

namespace App\Http\Controllers\backend;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests\ModificationForm;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Modificationmaster;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use App\Models\User;




class ModificationController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function index()
    {

        $pagename='View Modification ';
        $modification=Modificationmaster::all();
        //dd($modification);
        return view('backend.modificationmaster.index',compact('pagename','modification'));

    }
    public function create()
    {
       
        $pagename = 'Create Customer';
     
        return view('backend.modificationmaster.create',compact('pagename'));

    }


    public function store( Request $request)
    {

        if($request->ajax()){
            return true;
        }
        $validator = Validator::make($request->all(),[

            'add_finish' => 'required',
           // 'choose_finish'  => 'required',
            'add_hinge'  =>'required',
            //'choose_hinge'  => 'required',
            'depth_cabinet'  => 'required',
            'depth_inch1'  => 'required',
        ]);
            
        if ($validator->fails()) {
            Toastr::warning('Fields cannot be repeated', 'Warning', 
                ["positionClass" => "toast-top-right"]);
                return redirect()->back()->withErrors($validator)->withInput();
        } 
        else
        {

        $modification = new Modificationmaster();//modle name
        $modification->add_finish = $request->add_finish;
        $choose_finish1 = $request->input('choose_finish', []);
        $modification->choose_finish = implode(', ', $choose_finish1);
        $modification->add_hinge = $request->add_hinge;
        $choose_hinge1 = $request->input('choose_hinge', []);
        $modification->choose_hinge = implode(', ', $choose_hinge1);
        $modification->depth_cabinet = $request->depth_cabinet;
        $modification->depth_inch1 = $request->depth_inch1;
        $modification->depth_inch2 = $request->depth_inch2;
        $modification->depth_inch3 = $request->depth_inch3;
        $modification->depth_inch4 = $request->depth_inch4;
        }
        if($modification->save())
        {
            //dd($modification);
            return redirect('/admin/modification/index')->with('success','Modification Added Successfully');
        }
               
    }

        public function destroy($id)
         {
        //     $modification = Modification::find($id);
        // $modification->active = 2;
        // $modification->user_modified= Auth::user()->id;
        // if($modification->save()){
        //     Toastr::success('Vendor Deleted Successfully', 'Success', ["positionClass" => "toast-top-right"]);
        //     return new JsonResponse(["status"=>true]);
        // }else{
        //     Toastr::error('Vendor cannot be deleted', 'Error', ["positionClass" => "toast-top-right"]);
        //     return new JsonResponse(["status"=>false]);
        // }
        $modification = Modificationmaster::find($id);   
       
            
         if($modification->delete()){
             $json = array('status' => 'success'); 
         }
         else
         {
             $json = array('status' => 'fail');   
         }
          echo json_encode($json);
        
           
        }
            
    

   
}





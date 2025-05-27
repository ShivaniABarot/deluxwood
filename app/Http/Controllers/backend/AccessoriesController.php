<?php

namespace App\Http\Controllers\backend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Accessories;
use Illuminate\Support\Facades\Auth;
use Hash;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\AccessoriesForm;
use Session;

class AccessoriesController extends BaseController {
   
    public function index() {
        $pagename = "Accessories Index";
        $accessories = Accessories::select('*')->latest()->get();
		return view('backend.accessories.index',compact('pagename','accessories'));
        // dd($accessories->accessories_id);

	}

    public function create()
    {
        $pagename = 'Create Accessories';
        return view('backend.accessories.create',compact('pagename',));
    }

    public function store(AccessoriesForm $request)
    {
        if($request->ajax()){
            return true;
        }

        $accessories = new Accessories();  

        $accessories->accessories_nm = $request->accessories_name;
        $accessories->quantity = $request->quantity;
        $accessories->accessories_desc = $request->accessories_description;
        if (Auth::check()) 
        {
            $id = Auth::user()->id;
            $accessories->created_by = $id;
        }   
      if($accessories->save())
      {
        return redirect('/admin/accessories/index')->with('success','Accessories Added Successfully');;
       }else{
        return redirect('/admin/accessories/index')->with('error', 'Error: Something went wrong. Please try again.');
       }
           
    }

    public function destroy($id)
     {
    
       $accessories = Accessories::find($id);   
    
        if($accessories->delete()){
             Session::flash('success', 'Accessories deleted successfully'); 
            return response()->json(['message' => 'Accessories deleted successfully']);
        }
        else
        {
            Session::flash('fail', 'Something went wrong. Please try again.'); 
            return response()->json(['message' => ' Something went wrong. Please try again.']);   
        }
         echo json_encode($json);
       
    }
    public function edit($id) {
        $pagename = "Accessories Edit";
        $addaccessories=Accessories::find($id);
      
		return view('backend.accessories.edit',compact('pagename','addaccessories'));
	}
	
    public function update(AccessoriesForm $request,$id)
    {

        // if($request->ajax())
        // {
        //     return true;
        // }

        $accessories=Accessories::find($id);
        //

        $accessories->accessories_nm = $request->accessories_name;
        $accessories->quantity = $request->quantity;
        $accessories->accessories_desc = $request->accessories_description;
       // dd( $accessories);
        if (Auth::check()) 
        {
            $accessories->updated_by = Auth::user()->id;
        } 
       if($accessories->save()){
        return redirect('/admin/accessories/index')->with('success','Accessories Updated Successfully');
       }else{
        return redirect('/admin/accessories/index')->with('error', 'Error: Something went wrong. Please try again.');
       }
          
          
   }
      
   
      
}

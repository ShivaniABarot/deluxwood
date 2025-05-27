<?php

namespace App\Http\Controllers\backend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Addmodification;
use App\Models\ModificationValue;
use Illuminate\Support\Facades\Auth;
use Hash;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\AddmodificationForm;
use Session;
use DB;


class AddmodificationController extends BaseController {
   
    public function index() {
        $pagename = "Addmodification Index";
        // $addmodification=Addmodification::all();
        $addmodification = Addmodification::select('*')->latest()->get();
		return view('backend.addmodification.index',compact('pagename','addmodification'));
        // dd($addmodification->modification_id);

	}

    public function create()
    {
        $pagename = 'Create Addmodification';
        return view('backend.addmodification.create',compact('pagename',));
    }

    public function store(AddmodificationForm $request)
    {
        if($request->ajax()){
            return true;
        }
        
        if(Auth::user() != ""){
            $created_by = Auth::user()->id;
        }else{
            $created_by =1; 
        }

        $add = new Addmodification();  

        $add->modification_nm = $request->modification_name;
        $add->modification_desc = $request->modification_desc;
        $add->modification_info = $request->modification_information;
        $add->info_type = $request->input('option');
        $add->created_by=$created_by;
        if($request->input('option') == "integer_value")
        {
            $add->integer_lable = $request->integer_label;
        } 
        else
        if($request->input('option') == "message")
        {
            $add->message_label = $request->message;

        
        } 
        else
        {
            $add->integer_lable = $request->integer_label;
            $add->message_label = $request->message;
        }
        
       if($add->save())
       {
        if($request->input('option') == "integer_value" || $request->input('option') == "both" )
       {
            $intger_value = array_column(json_decode($request->integer_inch[0]), 'value');
            foreach($intger_value as $intger_value)
            {
                $modification_value   = new ModificationValue(); 
                $modification_value->modification_id = $add->modification_id;
                $modification_value->value = $intger_value;
                $modification_value->created_by = Auth::user()->id;
                $modification_value->save();
           }
        }
        // else
        // if($request->input('option') == "both" )
        // {
        //     $intger_value = array_column(json_decode($request->integer_inch[0]), 'value');
        //     foreach($intger_value as $both_value)
        //     {
        //         $modification_value = new ModificationValue(); 
        //         $modification_value->modification_id=$add->modification_id;
        //         $modification_value->value=$both_value;
        //         $modification_value->created_by = Auth::user()->id;
        //         $modification_value->save();
        //    }
        // }
        // else
        // {       
        //         $modification_value = new ModificationValue(); 
        //         $modification_value->modification_id=$add->modification_id;
        //         $modification_value->value = $request->message;
        //         $modification_value->created_by = $created_by;
        //         $modification_value->save();
        // }    
       
        return redirect('/admin/addmodification/index')->with('success','Modification Added Successfully');
       
      }
       else
       {
        return redirect('/admin/addmodification/index')->with('error', 'Error: Something went wrong. Please try again.');
       }

      

    }
    public function destroy($id)
     {
       $add = Addmodification::find($id);   
       ModificationValue::where('modification_id',$id)->delete();
         
        if($add->delete()){
             Session::flash('success', 'Modification deleted successfully'); 
            return response()->json(['message' => 'Modification deleted successfully']);
        }
        else
        {
            Session::flash('fail', 'Something went wrong. Please try again.'); 
            return response()->json(['message' => ' Something went wrong. Please try again.']);  
        }
         echo json_encode($json);
       
    }
    public function edit($id) {
        $pagename = "Addmodification Edit";
        $addmodification = Addmodification::find($id);
        //dd($addmodification);
        $modification_value=ModificationValue::where('modification_id',$id)->pluck("value");
        $selectedOption = DB::table('modificationmaster')
        ->where('modification_id', $id)
        ->value('info_type');
        //dd($addmodification);

       
		return view('backend.addmodification.edit',compact('pagename','addmodification','modification_value','selectedOption'));
	}
	
 public function update(AddmodificationForm $request, $id)
{
    if ($request->ajax()) {
        return true;
    }

    $addmodification = Addmodification::find($id);

    $addmodification->modification_nm = $request->modification_name;
    $addmodification->modification_desc = $request->modification_desc;
    $addmodification->modification_info = $request->modification_information;
    $addmodification->info_type = $request->input('option');

    $existingModificationValues = ModificationValue::where('modification_id', $id)->get();
    $existingModification = Addmodification::where('modification_id',$id)->get();


    if ($request->modification_information == "Yes") {
        if ($request->input('option') == "integer_value") {
            $addmodification->integer_lable = $request->integer_label;
            ModificationValue::where('modification_id', $id)->delete();
            $integer_values = json_decode($request->integer_inch[0]);
            foreach ($integer_values as $value) {
                $modification_value = new ModificationValue();
                $modification_value->modification_id = $id;
                $modification_value->value = $value->value;
                $modification_value->updated_by = Auth::user()->id;
                $modification_value->save();
            }
             $addmodification->message_label = null;
        } elseif ($request->input('option') == "message") {
            $addmodification->message_label = $request->message;
             $addmodification->integer_lable = null;
            ModificationValue::where('modification_id', $id)->delete();
        } else { 
            $addmodification->integer_lable = $request->integer_label;
            $addmodification->message_label = $request->message;

        }
    } else {

        $addmodification->info_type = null;
        $addmodification->integer_lable = null;
        $addmodification->message_label = null;
    }

    $addmodification->save();

    return redirect('/admin/addmodification/index')->with('success', 'Modification Updated Successfully');
}

}

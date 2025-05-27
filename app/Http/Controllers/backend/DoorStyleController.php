<?php

namespace App\Http\Controllers\backend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Requests\DoorStyleForm;
use App\Models\DoorStyle;
use App\Models\CustomerDraft;
Use App\Models\CustomerDraftStyle;
Use App\Models\ProductDoorStyle;
use App\Models\DraftProduct;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;
class DoorStyleController extends BaseController {
   
    public function index() {
        $pagename = "Door Style Index";
        
        //$door_style = DoorStyle::select('*')->latest()->get();
        $door_style = DoorStyle::select('*')->where('removed','No')->latest()->get();
        // dd($door_style);
		return view('backend.door_style.index',compact('pagename','door_style'));
	}

    public function create()
    {
        $pagename = 'Create Door Style';
        return view('backend.door_style.create',compact('pagename'));
    }

    public function store(DoorStyleForm  $request){
        if($request->ajax()){
            return true;
        }
          
        $door_style = new DoorStyle();  
        if($request->hasfile('image'))
        {
           
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = rand().'.'.$extension;

            if (!in_array(strtolower($extension), ['jpg', 'jpeg', 'png'])) {
                return back()->withErrors(['image' => 'Only JPG and PNG files are allowed.']);
            }
        
            $file->move('public/img/door_style',$filename);
            $door_style->image=$filename;

        }
        $door_style->name = $request->name;
        $door_style->line = $request->line;
     
        $door_style->description = $request->description;
        $door_style->assemble_options=$request->assemble_options;

      if($door_style->save()){
        return redirect('/admin/door-style-list')->with('success','Door Style Added Successfully');
       }else{
        return redirect('/admin/door-style-list')->with('error', 'Error: Something went wrong. Please try again.');
       }
           
        }
      
    public function destroy($id)
     {
    
       $door_style = DoorStyle::find($id); 
       $door_style->removed = "Yes";
       $productDoorStyles = ProductDoorStyle::where('door_style_id', $id)->get();
       foreach ($productDoorStyles as $productDoorStyle) {
        $productDoorStyle->delete();
      }
      
       $customerDraftStyles = CustomerDraftStyle::where('door_style_Id',$id)->get(); 
       foreach ($customerDraftStyles as $customerDraftStyle) {
        $customerDraft = CustomerDraft::find($customerDraftStyle->customer_draft_Id); 
        if($customerDraft->draft_status == "Save" || $customerDraft->draft_status == "Pending" )
        {
            DraftProduct::where('draft_style_id',$customerDraftStyle->draft_style_id)->delete();
            $customerDraftStyle->delete();
        }
      }
        // if($door_style->delete()){
        //     Session::flash('success', 'Door Style deleted successfully'); 
        //     return response()->json(['message' => 'Door Style deleted successfully']);
        // }
        // else
        // {
        //     Session::flash('fail', 'Something went wrong. Please try again.'); 
        //     return response()->json(['message' => ' Something went wrong. Please try again.']); 
        // }
        if($door_style->save()){
                Session::flash('success', 'Door Style deleted successfully'); 
                return response()->json(['message' => 'Door Style deleted successfully']);
            }
            else
            {
                Session::flash('fail', 'Something went wrong. Please try again.'); 
                return response()->json(['message' => ' Something went wrong. Please try again.']); 
            }
         echo json_encode($json);
       
    }
    public function edit($id) {
        $pagename = "Door Style Edit";
        $door_style = DoorStyle::find($id);
       
		return view('backend.door_style.edit',compact('pagename','door_style'));
	}
	
    public function update(DoorStyleForm $request, $id)
{
    try {
        // Validate the request is AJAX if needed
        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        // Find the DoorStyle or throw 404
        $door_style = DoorStyle::findOrFail($id);

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = strtolower($file->getClientOriginalExtension());

            // Validate image extension
            if (!in_array($extension, ['jpg', 'jpeg', 'png'])) {
                return redirect()->back()->withErrors(['image' => 'Only JPG and PNG files are allowed.']);
            }

            // Generate unique filename
            $filename = time() . '_' . uniqid() . '.' . $extension;
            $file->move(public_path('img/door_style'), $filename);

            // Delete old image if it exists
            if ($door_style->image && file_exists(public_path('img/door_style/' . $door_style->image))) {
                unlink(public_path('img/door_style/' . $door_style->image));
            }

            $door_style->image = $filename;
        }

        // Update door style attributes
        $door_style->fill([
            'name' => $request->name,
            'line' => $request->line,
            'description' => $request->description,
            'assemble_options' => $request->assemble_options,
        ]);

        // Force mark assemble_options as dirty if it has changed
        if ($door_style->isDirty('assemble_options')) {
        } else {
            \Log::warning('assemble_options not marked as dirty', [
                'original' => $door_style->getOriginal('assemble_options'),
                'new' => $request->assemble_options,
            ]);
            $door_style->assemble_options = $request->assemble_options;
        }

        // dd(123 ,$request->assemble_options);

        // Save and redirect
        if ($door_style->save()) {
            return redirect('/admin/door-style-list')
                ->with('success', 'Door Style Updated Successfully');
        }

        return redirect('/admin/door-style-list')
            ->with('error', 'Error: Failed to update door style.');

    } catch (\Exception $e) {
        \Log::error('Error updating door style: ' . $e->getMessage());
        return redirect('/admin/door-style-list')
            ->with('error', 'Error: Something went wrong. Please try again.');
    }
}
      
}

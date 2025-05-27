<?php

namespace App\Http\Controllers\frontend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\AboutUs;
use Illuminate\Support\Facades\Auth;
use Hash;
use Brian2694\Toastr\Facades\Toastr;
use Session;

class AboutUsController extends BaseController {
   
    public function about_us()
    {
       $pagename = 'About Us';
       $aboutUs=AboutUs::select('content','about_id')->first();
       return view('frontend.about-us.view',compact('pagename','aboutUs'));
    }
	
    public function edit() {
        $pagename = "About Edit";
        $about=AboutUs::select('content','about_id')->first();
        //dd($about);
		return view('frontend.about-us.update',compact('pagename','about'));
	}
	
    public function update(Request $request,$id)
    {
        if($request->ajax())
        {
            return true;
        }
        $about=AboutUs::find($id);
        $about->content = $request->about_content;
        if (Auth::check()) 
        {
            $about->updated_by = Auth::user()->id;
        } 
        if ($about->save()) {
            return redirect('/about')->with('success', 'Content Updated Successfully');
        }
          
   }
      
   
      
}

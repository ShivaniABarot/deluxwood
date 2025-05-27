<?php

namespace App\Http\Controllers\backend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryForm;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;
class CategoryController extends BaseController {
   
    public function index() {
        $pagename = "Category Index";
        
        $category = ProductCategory::select('*')->latest()->get();
        // dd($category);
		return view('backend.category.index',compact('pagename','category'));
	}

    public function create()
    {
        $pagename = 'Create Category';
        return view('backend.category.create',compact('pagename',));
    }

    public function store(CategoryForm  $request){
        if($request->ajax()){
            return true;
        }

        $category = new ProductCategory();  

        $category->title = $request->title;
        $category->description = $request->description;

      if($category->save()){
        return redirect('/admin/categories-list')->with('success','Category Added Successfully');
       }else{
        return redirect('/admin/categories-list')->with('error', 'Error: Something went wrong. Please try again.');
       }
           
        }
      
    public function destroy($id)
     {
    
       $category = ProductCategory::find($id);   
    
        if($category->delete()){
                 Session::flash('success', 'Category deleted successfully'); 
            return response()->json(['message' => 'Category deleted successfully']);
        }
        else
        {
            Session::flash('fail', 'Something went wrong. Please try again.'); 
            return response()->json(['message' => ' Something went wrong. Please try again.']); 
        }
         echo json_encode($json);
       
    }
    public function edit($id) {
        $pagename = "Category Edit";
        $category = ProductCategory::find($id);
       
		return view('backend.category.edit',compact('pagename','category'));
	}
	
    public function update(CategoryForm  $request,$id){
        if($request->ajax()){
            return true;
        }
        $category = ProductCategory::find($id); 
      
        $category->title = $request->title;
        $category->description = $request->description;
       
       if($category->save()){
        return redirect('/admin/categories-list')->with('success','Category Updated  Successfully');
       }else{
        return redirect('/admin/categories-list')->with('error', 'Error: Something went wrong. Please try again.');
       }
           
        }
      
}

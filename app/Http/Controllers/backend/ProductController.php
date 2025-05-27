<?php

namespace App\Http\Controllers\backend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Requests\ProductForm;
use App\Models\ProductMaster;
use App\Models\ProductCategory;
use App\Models\DoorStyle;
use App\Models\ProductDoorStyle;
use Illuminate\Support\Facades\Auth;
use Hash;

class ProductController extends BaseController {
   
    public function index() {
        $pagename = "Product Index";
        $product = ProductMaster::select('product_master.*','product_category.title')
        ->leftjoin('product_category','product_category.category_id','product_master.product_category_id')->get();
		return view('backend.product.index',compact('pagename','product'));
	}

    public function create()
    {
        $pagename = 'Create Product';
        $doorStyle = DoorStyle::all();
        $productCategory = ProductCategory::all();
        return view('backend.product.create',compact('pagename','doorStyle','productCategory'));
    }

    public function store(ProductForm  $request){
        if($request->ajax()){
            return true;
        }
        if(Auth::user() != ""){
            $created_by = Auth::user()->id;
        }else{
            $created_by =1;
        }


        $product = new ProductMaster(); 
        $product->product_category_id = $request->product_category_id;
        $product->product_name = $request->product_name;
        $product->created_by = $created_by;
        $product->save();
        
        if($request->door_style_id != ""){
            foreach($request->door_style_id as $door_style_id){
                $ProductDoorStyle = new ProductDoorStyle(); 
                $ProductDoorStyle->product_id =  $product->product_id;
                $ProductDoorStyle->door_style_id = $door_style_id;
                $ProductDoorStyle->created_by = $created_by;
                $ProductDoorStyle->save();

            }
        }
        return redirect('/admin/product-list')->with('success','Customer Added Successfully');
    
           
        }
      
    public function destroy($id)
     {
    
       $product = ProductMaster::find($id);   
       ProductDoorStyle::where('product_id',$id)->delete();
       
        if($product->delete()){
            $json = array('status' => 'success'); 
        }
        else
        {
            $json = array('status' => 'fail');   
        }
         echo json_encode($json);
       
    }
    public function edit($id) {
        $pagename = "Customer Edit";
        $product = ProductMaster::find($id);
        $doorStyle = DoorStyle::all();
        $productCategory = ProductCategory::all();
        $door_style_ids = ProductDoorStyle::where('product_id', $id)
                        ->pluck('door_style_id')
                        ->toArray();   
		return view('backend.product.edit',compact('pagename','doorStyle','productCategory','door_style_ids','product'));
	}
	
    public function update(ProductForm  $request,$id){
        if($request->ajax()){
            return true;
        }
        if(Auth::user() != ""){
            $updated_by = Auth::user()->id;
        }else{
            $updated_by =1;
        }
        $product = ProductMaster::find($id); 
        $product->product_category_id = $request->product_category_id;
        $product->product_name = $request->product_name;
        $product->updated_by  = $updated_by;
        $product->save();
        
        if($request->door_style_id != ""){
            ProductDoorStyle::where('product_id',$id)->delete();
            foreach($request->door_style_id as $door_style_id){
                $ProductDoorStyle = new ProductDoorStyle(); 
                $ProductDoorStyle->product_id =  $product->product_id;
                $ProductDoorStyle->door_style_id = $door_style_id;
                $ProductDoorStyle->updated_by = $updated_by;
                $ProductDoorStyle->save();

            }
        }
    
        return redirect('/admin/product-list')->with('success','Customer Updated  Successfully');
    
           
        }
      
}

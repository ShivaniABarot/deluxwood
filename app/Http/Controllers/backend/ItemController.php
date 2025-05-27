<?php

namespace App\Http\Controllers\backend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Requests\ItemForm;
use App\Models\ProductMaster;
use App\Models\ProductItem;
use App\Models\ItemDimensions;
use App\Models\ProductItemFinishSide;
use App\Models\ProductItemHingeSide;
use App\Models\ItemCutDepth;
use App\Models\ItemModification;
use App\Models\ItemAccessories;
use App\Models\Addmodification;
use App\Models\Accessories;
use App\Models\ProductCategory;
use App\Models\DoorStyle;
use App\Models\ProductDoorStyle;
use App\Models\DraftProduct;
use App\Models\UnassembledDiscount;
use App\Http\Requests\UnassembledDiscountForm;
use Illuminate\Support\Facades\Auth;
use Hash;
use DB;
use Session;
class ItemController extends BaseController {
   
    public function index() {
        $pagename = "Product Index";
        $product = ProductMaster::select('product_master.*','product_category.title','product_item.product_item_sku','product_item.product_item_price')
        ->leftjoin('product_category','product_category.category_id','product_master.product_category_id')
        ->leftjoin('product_item','product_item.product_id','product_master.product_id')
        ->latest()
        ->get();
       
        // $items = ProductItem::where("product_id",$id)->get();
        
		return view('backend.item.index',compact('pagename','product'));
	}

    public function create()
    {
        $pagename = 'Create Item';
        $doorStyle = DoorStyle::all();
        $productCategory = ProductCategory::all();
        $modification = Addmodification::all();
        $accessories =Accessories::all();
        
        return view('backend.item.create',compact('pagename','doorStyle','productCategory','modification','accessories'));
    }

    public function store(ItemForm  $request){

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
        $product->availability = $request->availability;
        $product->inventory_quantity =  $request->quantity;
        $product->created_by = $created_by;
        $product->save();
        
        // if ($request->door_style_id != "") {
        //     foreach ($request->door_style_id as $door_style_id) {
        //         if ($door_style_id != "selectAll") {
        //             $ProductDoorStyle = new ProductDoorStyle();
        //             $ProductDoorStyle->product_id = $product->product_id;
        //             $ProductDoorStyle->door_style_id = $door_style_id;
        //             $ProductDoorStyle->created_by = $created_by;
        //             $ProductDoorStyle->save();
        //         }
        //     }
        // }

       

        $productItem = new ProductItem(); 
        $productItem->product_id = $product->product_id;
        $productItem->product_item_name = $request->product_item_name;
        $productItem->product_item_sku = $request->product_item_sku;
        $productItem->product_item_price = $request->product_item_price;
        $productItem->finish_side = $request->finish_side;
        $productItem->hinge_side = $request->hinge_side;
        $productItem->cut_depth = $request->cut_depth;
        $productItem->increase_depth = $request->increase_depth; 
        $productItem->cut_height = $request->cut_height; 
        $productItem->increase_height = $request->increase_height; 
        $productItem->description = $request->description;
        $productItem->created_by = $created_by;
        $productItem->save();

        $door_style_id=$request->door_style_id;
        $doorstyle_price=$request->doorstyle_price;

        if($doorstyle_price != "")
        {
          foreach($door_style_id as $index=>$door_style_id){
                  $ProductDoorStyle= new ProductDoorStyle();
                  $ProductDoorStyle->product_id = $product->product_id;
                  $ProductDoorStyle->product_item_id = $productItem->product_item_id;
                  $ProductDoorStyle->door_style_id =$door_style_id;
                  if($doorstyle_price[$index] == "")
                  {
                    $ProductDoorStyle->doorstyle_price = 0;
                  }
                  else
                  {
                    $ProductDoorStyle->doorstyle_price =$doorstyle_price[$index];
                  }
                  $ProductDoorStyle->created_by = $created_by;
                  $ProductDoorStyle->save();
          }
        }

         //Dimensions
        $item_length=$request->item_length;
        $item_breadth=$request->item_breadth;
        $item_height=$request->item_height;
        $item_weight=$request->item_weight;
        $item_price=$request->item_price;

        foreach($item_length as $index=>$item_length){
                $ItemDimensions= new ItemDimensions();
                $ItemDimensions->product_id = $product->product_id;
                $ItemDimensions->product_item_id = $productItem->product_item_id;
                $ItemDimensions->item_length =$item_length;
                $ItemDimensions->item_breadth =$item_breadth[$index];
                $ItemDimensions->item_height =$item_height[$index];
                $ItemDimensions->item_weight =$item_weight[$index];
                // $ItemDimensions->item_price =$item_price[$index];
                $ItemDimensions->created_by = $created_by;
                $ItemDimensions->save();
        }


        if($request->finish_side == "Yes"){
            $ProductItemFinishSide = new ProductItemFinishSide(); 
            $ProductItemFinishSide->product_id = $product->product_id;
            $ProductItemFinishSide->product_item_id = $productItem->product_item_id;
            $ProductItemFinishSide->right_finish_side_price = $request->right_finish_side_price;
            $ProductItemFinishSide->left_finish_side_price = $request->left_finish_side_price;
            $ProductItemFinishSide->both_finish_side_price = $request->both_finish_side_price;
            $ProductItemFinishSide->finish_side_none = $request->finish_side_none;
            $ProductItemFinishSide->created_by = $created_by;
            $ProductItemFinishSide->save();
        }

        if($request->hinge_side == "Yes"){
            $ProductItemHingeSide = new ProductItemHingeSide(); 
            $ProductItemHingeSide->product_id = $product->product_id;
            $ProductItemHingeSide->product_item_id = $productItem->product_item_id;
            $ProductItemHingeSide->right_hinge_side_price = $request->right_hinge_side_price;
            $ProductItemHingeSide->left_hinge_side_price = $request->left_hinge_side_price;
            // $ProductItemHingeSide->both_hinge_side_price = $request->both_hinge_side_price;
            $ProductItemHingeSide->hinge_side_none = $request->hinge_side_none;
            $ProductItemHingeSide->created_by = $created_by;
            $ProductItemHingeSide->save();
        }

          //ItemModification
          $modification_id=$request->modification_id;
          $modification_price=$request->modification_price;
        if($modification_price != "")
        {
          foreach($modification_id as $index=>$modification_id){
                  $ItemModification= new ItemModification();
                  $ItemModification->product_id = $product->product_id;
                  $ItemModification->product_item_id = $productItem->product_item_id;
                  $ItemModification->modification_id =$modification_id;
                  $ItemModification->modification_price =$modification_price[$index];
                  $ItemModification->created_by = $created_by;
                  $ItemModification->save();
          }
        }
          //ItemAccessories
          $accessories_id=$request->accessories_id;
          $accessories_price=$request->accessories_price;
        
          if($accessories_price != "")
        {
          foreach($accessories_id as $index=>$accessories_id){
                  $ItemAccessories= new ItemAccessories();
                  $ItemAccessories->product_id = $product->product_id;
                  $ItemAccessories->product_item_id = $productItem->product_item_id;
                  $ItemAccessories->accessories_id =$accessories_id;
                  $ItemAccessories->accessories_price =$accessories_price[$index];
                  $ItemAccessories->created_by = $created_by;
                  $ItemAccessories->save();
          }
        }
        
        if($request->cut_depth == "Yes"){
            $Item =ProductItem::find($productItem->product_item_id); 
            $Item->cut_depth_price = $request->cut_depth_price;
            $Item->save();
            if($request->depth_name_inch != ""){
            $depthNameInches = array_column(json_decode($request->depth_name_inch[0]), 'value');
            foreach($depthNameInches as $depth_name_inch){
                $ItemCutDepth = new ItemCutDepth(); 
                $ItemCutDepth->product_id = $product->product_id;
                $ItemCutDepth->product_item_id = $productItem->product_item_id;
                $ItemCutDepth->depth_name_inch = $depth_name_inch;
                $ItemCutDepth->created_by = $created_by;
                $ItemCutDepth->save();
    
            }
        }
           
            // if($request->depth_name_inch != ""){
            //     foreach($request->depth_name_inch as $depth_name_inch[0]){
            //         $ItemCutDepth = new ItemCutDepth(); 
            //         $ItemCutDepth->product_id = $product->product_id;
            //         $ItemCutDepth->product_item_id = $productItem->product_item_id;
            //         $ItemCutDepth->depth_name_inch = $depth_name_inch;
            //         $ItemCutDepth->created_by = $created_by;
            //         $ItemCutDepth->save();

            //     }
            // }
        }

        if ($request->hasfile('product_gallery')) {
            foreach ($request->file('product_gallery') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                $file->move('public/img/product', $name);
              
                $images['product_id'] = $product->product_id;
                $images['image_name'] = $name;
                $images['created_by'] = $created_by;
                DB::table('product_image')->insert($images);
                
            }
        }
        return redirect('/admin/item-list/')->with('success','Item Added Successfully');
        // return redirect('/admin/item-list/'.$id)->with('success','Item Add Successfully');
        
    
           
        }
      
    public function destroy($id)
     {
        $product = ProductMaster::find($id);   
        ProductDoorStyle::where('product_id',$id)->delete();
        ProductItem::where('product_id',$id)->delete();
        ItemDimensions::where('product_id',$id)->delete();
        ProductItemFinishSide::where('product_id',$id)->delete(); 
        ProductItemHingeSide::where('product_id',$id)->delete(); 
        ItemModification::where('product_id',$id)->delete();
        ItemAccessories::where('product_id',$id)->delete();
        ItemCutDepth::where('product_id',$id)->delete();
        DraftProduct::where('product_id',$id)->delete();

        if($product->delete()){
                Session::flash('success', 'Item deleted successfully'); 
            return response()->json(['message' => 'Item deleted successfully']);
        }
        else
        {
            Session::flash('fail', 'Something went wrong. Please try again.'); 
            return response()->json(['message' => ' Something went wrong. Please try again.']);     
        }
         echo json_encode($json);
       
    }
    public function edit($id) {
        $pagename = "Item Edit";
        $product = ProductMaster::find($id);
        $doorStyle = DoorStyle::all();
        $productCategory = ProductCategory::all();
        $door_style_ids = ProductDoorStyle::where('product_id', $id)->pluck('door_style_id')->toArray(); 
        $door_style_Price = ProductDoorStyle::where('product_id',$id)->pluck('doorstyle_price')->toArray();  
        // dd($door_style_Price);
        $item = ProductItem::where('product_id',$id)->first();
        $ItemDimensions = ItemDimensions::where('product_id',$id)->get();
        $ProductItemFinishSide = ProductItemFinishSide::where('product_id',$id)->first();
      
        $ProductItemHingeSide= ProductItemHingeSide::where('product_id',$id)->first(); 
        $ItemModification_ids= ItemModification::where('product_id', $id)->pluck('modification_id')->toArray();  
        $ItemModification_price= ItemModification::where('product_id', $id)->pluck('modification_price')->toArray();  
        $ItemAccessories_ids = ItemAccessories::where('product_id',$id)->pluck('accessories_id')->toArray();

        $ItemAccessories_price = ItemAccessories::where('product_id',$id)->pluck('accessories_price')->toArray();
        
        $ItemCutDepth = ItemCutDepth::where('product_id',$id)->pluck("depth_name_inch");

        $modification = Addmodification::all();
        $accessories =Accessories::all();

        $product_image = DB::table('product_image')->where('product_id',$id)->get();
      
		return view('backend.item.edit',compact('pagename','product','doorStyle','productCategory','door_style_ids','modification','accessories','item','ItemDimensions','ProductItemFinishSide','ProductItemHingeSide','ItemModification_ids','ItemModification_price','ItemAccessories_ids','ItemAccessories_price','ItemCutDepth','id','product_image','door_style_Price'));
	}
	
    public function update(ItemForm  $request,$id){
        if($request->ajax()){
            return true;
        }
        if(Auth::user() != ""){
            $updated_by = Auth::user()->id;
        }else{
            $updated_by = 1;
        }
        $draft_status =['Pending','Save'];
        $product = ProductMaster::find($id); 
        $product->product_category_id = $request->product_category_id;
        $product->product_name = $request->product_name;
        $product->availability = $request->availability;
        $product->inventory_quantity =  $request->quantity;

        $product->updated_by  = $updated_by;
        $product->save();
        $created_by = $product->created_by;

        // if($request->door_style_id != ""){
        //     ProductDoorStyle::where('product_id',$id)->delete();
        //     foreach($request->door_style_id as $door_style_id){
        //         $ProductDoorStyle = new ProductDoorStyle(); 
        //         $ProductDoorStyle->product_id =  $product->product_id;
        //         $ProductDoorStyle->door_style_id = $door_style_id;
        //         $ProductDoorStyle->created_by = $created_by;
        //         $ProductDoorStyle->updated_by = $updated_by;
        //         $ProductDoorStyle->save();

        //     }
        // }
      // if ($request->door_style_id != "") {
      //    ProductDoorStyle::where('product_id',$id)->delete();
      //       foreach ($request->door_style_id as $door_style_id) {
      //           if ($door_style_id != "selectAll") {
      //               $ProductDoorStyle = new ProductDoorStyle();
      //               $ProductDoorStyle->product_id =  $product->product_id;
      //               $ProductDoorStyle->door_style_id = $door_style_id;
      //               $ProductDoorStyle->created_by = $created_by;
      //               $ProductDoorStyle->updated_by = $updated_by;
      //               $ProductDoorStyle->save();
      //           }
      //       }
      //   }

        $productItem =ProductItem::where('product_id',$id)->first(); 
        $productItem->product_id = $product->product_id;
        $productItem->product_item_name = $request->product_item_name;
        $productItem->product_item_sku = $request->product_item_sku;
        $productItem->product_item_price = $request->product_item_price;
        $productItem->finish_side = $request->finish_side;
        $productItem->hinge_side = $request->hinge_side;
        $productItem->cut_depth = $request->cut_depth;
        $productItem->increase_depth = $request->increase_depth; 
        $productItem->cut_height = $request->cut_height; 
        $productItem->increase_height = $request->increase_height; 
        $productItem->description = $request->description;
        $productItem->updated_by = $updated_by;;
        $productItem->save();

        $door_style_id=$request->door_style_id;
        $doorstyle_price=$request->doorstyle_price;

        if($doorstyle_price != "")
        {
          ProductDoorStyle::where('product_id',$id)->delete();
          foreach($door_style_id as $index=>$door_style_id){
                  $ProductDoorStyle= new ProductDoorStyle();
                  $ProductDoorStyle->product_id = $product->product_id;
                  $ProductDoorStyle->product_item_id = $productItem->product_item_id;
                  $ProductDoorStyle->door_style_id =$door_style_id;
                  if($doorstyle_price[$index]=="null")
                  {
                    $ProductDoorStyle->doorstyle_price =0;
                  }
                  else
                  {
                    $ProductDoorStyle->doorstyle_price =$doorstyle_price[$index];
                  }
                  $ProductDoorStyle->created_by = $created_by;
                  $ProductDoorStyle->save();
          }
        }

         //Dimensions
        $item_length=$request->item_length;
        $item_breadth=$request->item_breadth;
        $item_height=$request->item_height;
        $item_weight=$request->item_weight;
        $item_price=$request->item_price;

        ItemDimensions::where('product_id',$id)->delete();
        foreach($item_length as $index=>$item_length){
                $ItemDimensions= new ItemDimensions();
                $ItemDimensions->product_id = $product->product_id;
                $ItemDimensions->product_item_id = $productItem->product_item_id;
                $ItemDimensions->item_length =$item_length;
                $ItemDimensions->item_breadth =$item_breadth[$index];
                $ItemDimensions->item_height =$item_height[$index];
                $ItemDimensions->item_weight =$item_weight[$index];
                // $ItemDimensions->item_price =$item_price[$index];
                $ItemDimensions->created_by = $created_by;
                $ItemDimensions->updated_by = $updated_by;;
                $ItemDimensions->save();
        }
        $draft_products =  DraftProduct::where('product_id',$id)->leftJoin('customer_draft', 'customer_draft.customer_draft_id', '=', 'draft_product.customer_draft_id')
        ->whereIn('draft_status',$draft_status)->get();


        if($request->finish_side == "Yes"){
            $finsh_side_count =ProductItemFinishSide::where('product_id',$id)->count();
            $ProductItemFinishSide = ProductItemFinishSide::where('product_id',$id)->first(); 
            if($finsh_side_count == 0)
            {
                $ProductItemFinishSide = new ProductItemFinishSide();
            }
            $ProductItemFinishSide->product_id = $product->product_id;
            $ProductItemFinishSide->product_item_id = $productItem->product_item_id;
            $ProductItemFinishSide->right_finish_side_price = $request->right_finish_side_price;
            $ProductItemFinishSide->left_finish_side_price = $request->left_finish_side_price;
            $ProductItemFinishSide->both_finish_side_price = $request->both_finish_side_price;
            $ProductItemFinishSide->finish_side_none = $request->finish_side_none;
            $ProductItemFinishSide->created_by = $created_by;
            $ProductItemFinishSide->updated_by = $updated_by;
            $ProductItemFinishSide->save();
        }else{
            ProductItemFinishSide::where('product_id',$id)->delete();
            
          
            foreach($draft_products as $draft_product){
                $draft_product->finish_side = "None";
                $draft_product->save();
                
            }  
                        

        }

        if($request->hinge_side == "Yes"){
            $hing_side_count =ProductItemHingeSide::where('product_id',$id)->count();
            $ProductItemHingeSide = ProductItemHingeSide::where('product_id',$id)->first(); 
            if($hing_side_count == 0)
            {
                $ProductItemHingeSide = new ProductItemHingeSide();
            }
            $ProductItemHingeSide->product_id = $product->product_id;
            $ProductItemHingeSide->product_item_id = $productItem->product_item_id;
            $ProductItemHingeSide->right_hinge_side_price = $request->right_hinge_side_price;
            $ProductItemHingeSide->left_hinge_side_price = $request->left_hinge_side_price;
            // $ProductItemHingeSide->both_hinge_side_price = $request->both_hinge_side_price;
            $ProductItemHingeSide->hinge_side_none = $request->hinge_side_none;
            $ProductItemHingeSide->created_by = $created_by;
            $ProductItemHingeSide->updated_by = $updated_by;;
            $ProductItemHingeSide->save();
        }else{
            ProductItemHingeSide::where('product_id',$id)->delete();
            foreach($draft_products as $draft_product){
                $draft_product->hinge_side = "None";
                $draft_product->save();
                
            }  
        }

          //ItemModification
          $modification_id=$request->modification_id;
          $modification_price=$request->modification_price;
        if($modification_price != "")
        {
            ItemModification::where('product_id',$id)->delete();
          foreach($modification_id as $index=>$modification_id){
                  $ItemModification= new ItemModification();
                  $ItemModification->product_id = $product->product_id;
                  $ItemModification->product_item_id = $productItem->product_item_id;
                  $ItemModification->modification_id =$modification_id;
                  $ItemModification->modification_price =$modification_price[$index];
                  $ItemModification->created_by = $created_by;
                  $ItemModification->updated_by = $updated_by;;
                  $ItemModification->save();
          }
        }else{
            ItemModification::where('product_id',$id)->delete();
        }
          //ItemAccessories
          $accessories_id=$request->accessories_id;
          $accessories_price=$request->accessories_price;
       
          
          if($accessories_price != "")
        {
         ItemAccessories::where('product_id',$id)->delete();
          foreach($accessories_id as $index=>$accessories_id){
            $ItemAccessories= new ItemAccessories();
                 
                  $ItemAccessories->product_id = $product->product_id;
                  $ItemAccessories->product_item_id = $productItem->product_item_id;
                  $ItemAccessories->accessories_id =$accessories_id;
                  $ItemAccessories->accessories_price =$accessories_price[$index];
                  $ItemAccessories->created_by = $created_by;
                  $ItemAccessories->updated_by = $updated_by;
                //   dd($ItemAccessories);
                $ItemAccessories->save();
                 
          }
        }else{
            ItemAccessories::where('product_id',$id)->delete();
        }
   
     
        
        
        if($request->cut_depth == "Yes"){

            ItemCutDepth::where('product_id',$id)->delete();
            $Item =ProductItem::where('product_id',$id)->first(); 
            $Item->cut_depth_price = $request->cut_depth_price;
            $Item->save();
            if($request->depth_name_inch != ""){
            $depthNameInches = array_column(json_decode($request->depth_name_inch[0]), 'value');
            foreach($depthNameInches as $depth_name_inch){
                $ItemCutDepth = new ItemCutDepth(); 
                $ItemCutDepth->product_id = $product->product_id;
                $ItemCutDepth->product_item_id = $productItem->product_item_id;
                $ItemCutDepth->depth_name_inch = $depth_name_inch;
                $ItemCutDepth->created_by = $created_by;
                $ItemCutDepth->updated_by = $updated_by;
                $ItemCutDepth->save();
             }
           }
        }else{
            ItemCutDepth::where('product_id',$id)->delete();
        }

        if ($request->hasfile('product_gallery')) {
            DB::table('product_image')->where('product_id', $id)->delete();
           

            foreach ($request->file('product_gallery') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                $file->move('public/img/product', $name);
              
                $images['product_id'] = $id;
                $images['image_name'] = $name;
                $images['created_by'] = $created_by;
                $images['updated_by'] = $updated_by;
               
                DB::table('product_image')->insert($images);
             
            }
        }
        return redirect('/admin/item-list/')->with('success','Item Updated Successfully');
    
           
        }
        public function duplicate($id) {
            $pagename = "Duplicate Item";
            $product = ProductMaster::find($id);
            $doorStyle = DoorStyle::all();
            $productCategory = ProductCategory::all();
            $door_style_ids = ProductDoorStyle::where('product_id', $id)->pluck('door_style_id')->toArray();   
            $item = ProductItem::where('product_id',$id)->first();
            $ItemDimensions = ItemDimensions::where('product_id',$id)->get();
            $ProductItemFinishSide = ProductItemFinishSide::where('product_id',$id)->first();
          
            $ProductItemHingeSide= ProductItemHingeSide::where('product_id',$id)->first(); 
            $ItemModification_ids= ItemModification::where('product_id', $id)->pluck('modification_id')->toArray();  
            $ItemModification_price= ItemModification::where('product_id', $id)->pluck('modification_price')->toArray();  
            $ItemAccessories_ids = ItemAccessories::where('product_id',$id)->pluck('accessories_id')->toArray();
            $ItemAccessories_price = ItemAccessories::where('product_id',$id)->pluck('accessories_price')->toArray();
            $ItemCutDepth = ItemCutDepth::where('product_id',$id)->pluck("depth_name_inch");
    
            $modification = Addmodification::all();
            $accessories =Accessories::all();
    
            $product_image = DB::table('product_image')->where('product_id',$id)->get();
          
            return view('backend.item.duplicate',compact('pagename','product','doorStyle','productCategory','door_style_ids','modification','accessories','item','ItemDimensions','ProductItemFinishSide','ProductItemHingeSide','ItemModification_ids','ItemModification_price','ItemAccessories_ids','ItemAccessories_price','ItemCutDepth','id','product_image'));
        }
        public function store_duplicate(ItemForm  $request,$id){
           
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
            $product->inventory_quantity =  $request->quantity;
            $product->availability = $request->availability;
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
           
    
            $productItem = new ProductItem(); 
            $productItem->product_id = $product->product_id;
            $productItem->product_item_name = $request->product_item_name;
            $productItem->product_item_sku = $request->product_item_sku;
            $productItem->product_item_price = $request->product_item_price;
            $productItem->finish_side = $request->finish_side;
            $productItem->hinge_side = $request->hinge_side;
            $productItem->cut_depth = $request->cut_depth;
            $productItem->description = $request->description;
            $productItem->created_by = $created_by;
            $productItem->save();
    
             //Dimensions
            $item_length=$request->item_length;
            $item_breadth=$request->item_breadth;
            $item_height=$request->item_height;
            $item_weight=$request->item_weight;
            $item_price=$request->item_price;
    
            foreach($item_length as $index=>$item_length){
                    $ItemDimensions= new ItemDimensions();
                    $ItemDimensions->product_id = $product->product_id;
                    $ItemDimensions->product_item_id = $productItem->product_item_id;
                    $ItemDimensions->item_length =$item_length;
                    $ItemDimensions->item_breadth =$item_breadth[$index];
                    $ItemDimensions->item_height =$item_height[$index];
                    $ItemDimensions->item_weight =$item_weight[$index];
                    // $ItemDimensions->item_price =$item_price[$index];
                    $ItemDimensions->created_by = $created_by;
                    $ItemDimensions->save();
            }
    
    
            if($request->finish_side == "Yes"){
                $ProductItemFinishSide = new ProductItemFinishSide(); 
                $ProductItemFinishSide->product_id = $product->product_id;
                $ProductItemFinishSide->product_item_id = $productItem->product_item_id;
                $ProductItemFinishSide->right_finish_side_price = $request->right_finish_side_price;
                $ProductItemFinishSide->left_finish_side_price = $request->left_finish_side_price;
                $ProductItemFinishSide->both_finish_side_price = $request->both_finish_side_price;
                $ProductItemFinishSide->finish_side_none = $request->finish_side_none;
                $ProductItemFinishSide->created_by = $created_by;
                $ProductItemFinishSide->save();
            }
    
            if($request->hinge_side == "Yes"){
                $ProductItemHingeSide = new ProductItemHingeSide(); 
                $ProductItemHingeSide->product_id = $product->product_id;
                $ProductItemHingeSide->product_item_id = $productItem->product_item_id;
                $ProductItemHingeSide->right_hinge_side_price = $request->right_hinge_side_price;
                $ProductItemHingeSide->left_hinge_side_price = $request->left_hinge_side_price;
                // $ProductItemHingeSide->both_hinge_side_price = $request->both_hinge_side_price;
                $ProductItemHingeSide->hinge_side_none = $request->hinge_side_none;
                $ProductItemHingeSide->created_by = $created_by;
                $ProductItemHingeSide->save();
            }
    
              //ItemModification
              $modification_id=$request->modification_id;
              $modification_price=$request->modification_price;
            if($modification_price != "")
            {
              foreach($modification_id as $index=>$modification_id){
                      $ItemModification= new ItemModification();
                      $ItemModification->product_id = $product->product_id;
                      $ItemModification->product_item_id = $productItem->product_item_id;
                      $ItemModification->modification_id =$modification_id;
                      $ItemModification->modification_price =$modification_price[$index];
                      $ItemModification->created_by = $created_by;
                      $ItemModification->save();
              }
            }
              //ItemAccessories
              $accessories_id=$request->accessories_id;
              $accessories_price=$request->accessories_price;
            
              if($accessories_price != "")
            {
              foreach($accessories_id as $index=>$accessories_id){
                      $ItemAccessories= new ItemAccessories();
                      $ItemAccessories->product_id = $product->product_id;
                      $ItemAccessories->product_item_id = $productItem->product_item_id;
                      $ItemAccessories->accessories_id =$accessories_id;
                      $ItemAccessories->accessories_price =$accessories_price[$index];
                      $ItemAccessories->created_by = $created_by;
                      $ItemAccessories->save();
              }
            }
            
            if($request->cut_depth == "Yes"){
                $Item =ProductItem::find($productItem->product_item_id); 
                $Item->cut_depth_price = $request->cut_depth_price;
                $Item->save();
                if($request->depth_name_inch != ""){
                $depthNameInches = array_column(json_decode($request->depth_name_inch[0]), 'value');
                foreach($depthNameInches as $depth_name_inch){
                    $ItemCutDepth = new ItemCutDepth(); 
                    $ItemCutDepth->product_id = $product->product_id;
                    $ItemCutDepth->product_item_id = $productItem->product_item_id;
                    $ItemCutDepth->depth_name_inch = $depth_name_inch;
                    $ItemCutDepth->created_by = $created_by;
                    $ItemCutDepth->save();
        
                }
            }
               
                // if($request->depth_name_inch != ""){
                //     foreach($request->depth_name_inch as $depth_name_inch[0]){
                //         $ItemCutDepth = new ItemCutDepth(); 
                //         $ItemCutDepth->product_id = $product->product_id;
                //         $ItemCutDepth->product_item_id = $productItem->product_item_id;
                //         $ItemCutDepth->depth_name_inch = $depth_name_inch;
                //         $ItemCutDepth->created_by = $created_by;
                //         $ItemCutDepth->save();
    
                //     }
                // }
            }
    
            if ($request->hasfile('product_gallery')) {
                foreach ($request->file('product_gallery') as $file) {
                    $name = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $file->move('public/img/product', $name);
                  
                    $images['product_id'] = $product->product_id;
                    $images['image_name'] = $name;
                    $images['created_by'] = $created_by;
                    DB::table('product_image')->insert($images);
                    
                }
            }else{
                $originalImages = DB::table('product_image')->where('product_id', $id)->get();
                // dd($originalImages);
                if($originalImages){
                    foreach ($originalImages as $originalImage) {
                    $images['product_id'] = $product->product_id;
                    $images['image_name'] = $originalImage->image_name;
                    $images['created_by'] = $created_by;
                    
                
                   $save= DB::table('product_image')->insert($images);
                 

                        
                        }
                    }
                }
            return redirect('/admin/item-list/')->with('success','Item Added Successfully');
            // return redirect('/admin/item-list/'.$id)->with('success','Item Add Successfully');
            
        
               
            }
      
        public function view($id) {
            $pagename = "Item View";
            $product = ProductMaster::find($id);
            $doorStyle = DoorStyle::all();
            $productCategory = ProductCategory::all();
            $door_style_ids = ProductDoorStyle::where('product_id', $id)->pluck('door_style_id')->toArray();   
            $door_style_Price = ProductDoorStyle::where('product_id',$id)->pluck('doorstyle_price')->toArray();
            $item = ProductItem::where('product_id',$id)->first();
            $ItemDimensions = ItemDimensions::where('product_id',$id)->get();
            $ProductItemFinishSide = ProductItemFinishSide::where('product_id',$id)->first();
          
            $ProductItemHingeSide= ProductItemHingeSide::where('product_id',$id)->first(); 
            $ItemModification_ids= ItemModification::where('product_id', $id)->pluck('modification_id')->toArray();  
            $ItemModification_price= ItemModification::where('product_id', $id)->pluck('modification_price')->toArray();  
            $ItemAccessories_ids = ItemAccessories::where('product_id',$id)->pluck('accessories_id')->toArray();
            $ItemAccessories_price = ItemAccessories::where('product_id',$id)->pluck('accessories_price')->toArray();
            $ItemCutDepth = ItemCutDepth::where('product_id',$id)->pluck("depth_name_inch");
    
            $modification = Addmodification::all();
            $accessories =Accessories::all();
    
            $product_image = DB::table('product_image')->where('product_id',$id)->get();
          
            return view('backend.item.view',compact('pagename','product','doorStyle','productCategory','door_style_ids','modification','accessories','item','ItemDimensions','ProductItemFinishSide','ProductItemHingeSide','ItemModification_ids','ItemModification_price','ItemAccessories_ids','ItemAccessories_price','ItemCutDepth','id','product_image','door_style_Price'));
        }
        public function edit_unassembled_discount(){
            $pagename = "Edit Unassembled Discount";
            $UnassembledDiscount=UnassembledDiscount::find(1);

            return view('backend.item.edit_unassembled_discount',compact('pagename','UnassembledDiscount'));
        }
        public function update_unassembled_discount(UnassembledDiscountForm $request){
            $UnassembledDiscount=UnassembledDiscount::find(1);
            $UnassembledDiscount->unassembled_discount = $request->unassembled_discount;
            $UnassembledDiscount->save();
            return redirect('/admin/item-list/')->with('success','Unassembled Discount Updated Successfully');
        }
       
}

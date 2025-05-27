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
use Illuminate\Support\Facades\Auth;
use Hash;
use DB;
use Session;
class DoorPriceController extends BaseController {

    public function create()
    {
        $pagename = 'Create Itemm';
        $doorStyle = DoorStyle::all();
        $productCategory = ProductCategory::all();
        $modification = Addmodification::all();
        $accessories =Accessories::all();
        
        return view('backend.item.door-price',compact('pagename','doorStyle','productCategory','modification','accessories'));
    }
    public function store(Request $request)
    {
     
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
        

        // $door_style_id=$request->door_style_id;
        // $doorstyle_price=$request->doorstyle_price;

        // if ($request->door_style_id != "") {
        //     foreach ($request->door_style_id as $door_style_id) {
        //         if ($door_style_id != "selectAll") {
        //             $ProductDoorStyle = new ProductDoorStyle();
        //             $ProductDoorStyle->product_id = $product->product_id;
        //             $ProductDoorStyle->product_item_id = $productItem->product_item_id;
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
        $productItem->description = $request->description;
        $productItem->created_by = $created_by;
        $productItem->save();

        $door_style_id=$request->door_style_id;
        $doorstyle_price=$request->doorstyle_price;

        if($doorstyle_price != "")
        {
          foreach($door_style_id as $index=>$door_style_id){
                  $ItemModification= new ProductDoorStyle();
                  $ItemModification->product_id = $product->product_id;
                  $ItemModification->product_item_id = $productItem->product_item_id;
                  $ItemModification->door_style_id =$door_style_id;
                  $ItemModification->doorstyle_price =$doorstyle_price[$index];
                  $ItemModification->created_by = $created_by;
                  $ItemModification->save();
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
}
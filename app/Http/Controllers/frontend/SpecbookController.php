<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SpecbookForm;
use App\Models\CustomerDraft;
use App\Models\DraftProduct;
use App\Models\ProductCategory;
use App\Models\ProductMaster;
use App\Models\SpecbookPdf;
use DB;
use Illuminate\Support\Facades\Auth;


class SpecbookController extends Controller
{
    public function index()
    {
        $pagename = "Specbook";
        $user_id=Auth::user()->id;
        $specbook_pdf = SpecbookPdf::select('pdf')->first();
     // $draft = DraftProduct::leftJoin('product_master', 'product_master.product_id', '=', 'draft_product.product_id')
        // ->leftJoin('customer', 'draft_product.customer_id', '=', 'customer.customer_id')
        // ->leftJoin('product_category', 'product_category.category_id', '=', 'product_master.product_category_id')
        // ->where('draft_product.customer_id', $user_id)
        // ->where('draft_product.product_id','!=',"Shipping cost")
        // ->select('product_name','draft_product_id')
        // ->get();
        
        $draft_product = DraftProduct::leftJoin('product_master', 'product_master.product_id', '=', 'draft_product.product_id')
        ->leftJoin('customer', 'draft_product.customer_id', '=', 'customer.customer_id')
        ->leftJoin('product_category', 'product_category.category_id', '=', 'product_master.product_category_id')
        ->where('draft_product.customer_id', $user_id)
        ->where('draft_product.product_id','!=',"Shipping cost")
        ->select('product_name','draft_product_id','draft_product.product_id')
        // ->groupBy('draft_product.product_id','product_name','draft_product.draft_product_id')
        // ->distinct('draft_product.product_id') 
        ->get();
        $draft = $draft_product->unique('product_id')
        ->map(function ($item) {
            return [
                'draft_product_id' => $item->draft_product_id,
                'product_name' => $item->product_name,
                'product_id' => $item->product_id,
            ];
        })
        ->values();
        $product1 =null;
        $product2 =null;
        //dd($product1);

        $category = ProductCategory::select('*')->get();

        if(($product1 ==null) &&($product2 ==null))
        {
            return view('frontend.specbook.create',compact('draft','product1','product2','category','pagename','specbook_pdf'));
        }
    
    } 
    // Get Category Vise Products

    public function getProducts(Request $request) {
        $pagename = "Specbook";

        $categoryId = $request->input('category_id');
        $user_id=Auth::user()->id;
        $ct_product_data = ProductMaster::select(
            'product_master.product_id',
            DB::raw('MAX(product_master.product_name) as product_name'),
            DB::raw('MAX(product_image.image_name) as image_name'),
            DB::raw('MAX(draft_product.hinge_side) as hinge_side'),
            DB::raw('MAX(draft_product.finish_side) as finish_side'),
            DB::raw('MAX(draft_product.total_price) as total_price'),
            DB::raw('MAX(item_dimensions.item_length) as item_length'),
            DB::raw('MAX(item_dimensions.item_breadth) as item_breadth'),
            DB::raw('MAX(item_dimensions.item_height) as item_height'),
            DB::raw('MAX(modificationmaster.modification_nm) as modification_nm'),
            DB::raw('MAX(accessoriesmaster.accessories_nm) as accessories_nm'),
            DB::raw('MAX(draft_product.total_price) as total_price')
            )
            ->leftJoin('draft_product', 'draft_product.product_id', '=', 'product_master.product_id')
            ->leftJoin('product_image', 'product_image.product_id', 'product_master.product_id')
            ->leftJoin('item_dimensions', 'item_dimensions.product_id', 'product_master.product_id')
            ->leftJoin('modificationmaster', 'modificationmaster.modification_id', '=', 'draft_product.modification_id')
            ->leftJoin('accessoriesmaster', 'accessoriesmaster.accessories_id', '=', 'draft_product.accessories_id')
            ->where('product_category_id', $categoryId)
            ->where('draft_product.customer_id', $user_id)
            ->groupBy('product_master.product_id')
            ->get();
            // dd(234567890,$ct_product_data);
        return view('frontend.specbook.get_products', ['ct_product_data' => $ct_product_data]);
}

    public function compare_draft(Request $request)
    {
        $pagename = "Specbook";
        $product1 =null;
        $product2 =null;
        $specbook_pdf = SpecbookPdf::select('pdf')->first();
        $user_id=Auth::user()->id;
        $draft = DraftProduct::leftJoin('product_master', 'product_master.product_id', '=', 'draft_product.product_id')
        ->leftJoin('customer', 'draft_product.customer_id', '=', 'customer.customer_id')
        ->where('draft_product.customer_id', $user_id)
        ->select('product_name','draft_product_id')
        ->get();

        $request->validate([
            'first_selected' => 'required',
            'second_selected' => 'required',
        ]);

        $first_draft=$request->first_selected;
        $second_draft=$request->second_selected;

        $selectedProduct_first = $request->input('first_selected_name');
        $selectedProduct_second = $request->input('second_selected_name');

        //dd( $first_draft,$second_draft);
        $product1 = DraftProduct::findOrFail($first_draft);
        $product2 = DraftProduct::findOrFail($second_draft);
        $comparisonData = [
            'product1' => $product1,
            'product2' => $product2,
            // Include any additional data you want to display
        ];
      //dd($comparisonData);
        return view('frontend.specbook.create',compact('draft','comparisonData','product1','product2','selectedProduct_first','selectedProduct_second','pagename','specbook_pdf'));

    }


 
}


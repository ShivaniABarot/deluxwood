<?php

namespace App\Http\Controllers\backend;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Requests\CouponForm;
use App\Models\Coupon;
use App\Models\User;
use App\Models\CouponMaster;
use Hash;
use Session;
class CouponController extends BaseController {
   
    public function index() {
        $pagename = "Coupon Index";
        
        $coupons = CouponMaster::all();
        // dd($coupon);
		return view('backend.coupon.index',compact('pagename','coupons'));
	}
    
    public function create()
    {
        $pagename = 'Create Coupon';
        return view('backend.coupon.create',compact('pagename'));
    }

    public function store( CouponForm $request){
        if($request->ajax()){
            return true;
        }
        
        
        $coupon = new CouponMaster();  
        $coupon->coupon_code = $request->coupon_code;
        $coupon->coupon_name =  $request->coupon_name;
        // $coupon_code=str()->random(6);
        // $coupone_count= CouponMaster::where('coupon_code',$coupon_code)->count();
        // if($coupone_count != 0 ){
        //     $coupon_code=str()->random(6);
        // }
        // $coupon->coupon_code = $coupon_code;
        $coupon->discount_type =  $request->discount_type;
        $coupon->discount =  $request->discount;
        $coupon->use_limit =  $request->use_limit;
        $coupon->time_limit =  $request->time_limit;
        
        // $coupon->min_price =  $request->min_price;
        $coupon->starting_date = $request->starting_date;
        $coupon->expiry_date = $request->expiry_date;
        
      if($coupon->save()){
        return redirect('/admin/coupon-list')->with('success','Coupon Added Successfully');
       }else{
        return redirect('/admin/coupon-list')->with('error', 'Error: Something went wrong. Please try again.');
       }
           
        }
      
    public function destroy($id)
     {
    
       $coupon = CouponMaster::find($id); 
        if($coupon->delete()){
            Session::flash('success', 'coupon deleted successfully'); 
            return response()->json(['message' => 'coupon deleted successfully']);
        }
        else
        {
            Session::flash('fail', 'Something went wrong. Please try again.'); 
            return response()->json(['message' => ' Something went wrong. Please try again.']); 
        }
         echo json_encode($json);
       
    }
    public function view($id) {
        $pagename = "Coupon View";
        $coupon = CouponMaster::find($id);
       
		return view('backend.coupon.view',compact('pagename','coupon'));
	}
    public function edit($id) {
        $pagename = "Coupon Edit";
        $coupon = CouponMaster::find($id);
       
		return view('backend.coupon.edit',compact('pagename','coupon'));
	}
 
	
    public function update(CouponForm  $request,$id){
        if($request->ajax()){
            return true;
        }
        $coupon = CouponMaster::find($id); 
    
        $coupon->coupon_code = $request->coupon_code;
        $coupon->coupon_name = $request->coupon_name;
        $coupon->discount_type =  $request->discount_type;
        $coupon->discount =  $request->discount;
        $coupon->use_limit =  $request->use_limit;
        $coupon->time_limit =  $request->time_limit;
        // $coupon->min_price =  $request->min_price;
        $coupon->starting_date = $request->starting_date;
        $coupon->expiry_date = $request->expiry_date;
       
       if($coupon->save()){
        return redirect('/admin/coupon-list')->with('success','Coupon Updated  Successfully');
       }else{
        return redirect('/admin/coupon-list')->with('error', 'Error: Something went wrong. Please try again.');
       }
           
        }
      
}

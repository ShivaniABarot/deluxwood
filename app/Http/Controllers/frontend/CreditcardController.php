<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreditcardForm;
use App\Models\CreditCard;
use DB;
use Illuminate\Support\Facades\Auth;


class CreditcardController extends Controller
{
   public function index(){
     $pagename = "Payment";
     $customer_id = Auth::user()->id;
     $creditcard = CreditCard::select('*')->where('customer_id',$customer_id)->get();

     return view('frontend.creditcard.index',compact('creditcard','pagename'));

   }   
   public function create()
   {
     $pagename = "Payment Create";
     return view('frontend.creditcard.create',compact('pagename'));

   }  
   public function store(CreditcardForm $request){
     if($request->ajax()){
         return true;
      }
     $customer_id = Auth::user()->id;

     $payment = new CreditCard();  
     $payment->customer_id = $customer_id;
     $payment->credit_card_number = $request->credit_card_number;
     $payment->credit_card_type = $request->credit_card_type;
     $payment->card_member_name = $request->card_member_name;
     $payment->expiration_date = $request->expiration_date;
     $payment->billing_address = $request->billing_address;
     $payment->phone = $request->phone;

     $payment->save();

      return redirect('payment')->with('success','Credit Card Add Successfully');
        
     }
   public function destroy($id)
     {
        $payment = CreditCard::find($id);
        if($payment->delete()){
            $json = array('status' => 'success'); 
        }
        else
        {
            $json = array('status' => 'fail');   
        }
        echo json_encode($json);
        
     }
      public function edit($id)
      {
        $pagename = "Payment Edit";
        $payment = CreditCard::find($id);
     
        return view('frontend.creditcard.edit',compact('payment','pagename'));

      }
   public function update(CreditcardForm $request,$id)
     { 
        if($request->ajax())
        {
             return true;
        }
 
           $payment = CreditCard::find($id);

           $payment->credit_card_number = $request->credit_card_number;
           $payment->credit_card_type = $request->credit_card_type;
           $payment->card_member_name = $request->card_member_name;
           $payment->expiration_date = $request->expiration_date;
           $payment->billing_address = $request->billing_address;
           $payment->phone = $request->phone;
    
           $payment->save();
 
          return redirect('payment')->with('success','Credit Card Update Successfully');
            
      }
 
}


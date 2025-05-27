<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class CouponForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
  
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()

    {
        if($this->method()=='PATCH'){
 
            $rules['coupon_name'] = 'required';
            $rules['coupon_code'] = 'required';
            $rules['discount_type'] = 'required';
            if($_REQUEST['discount_type'] == 'Percentage'){
                $rules['discount'] = 'required|numeric|min:1|max:100';
            }else{
                $rules['discount'] = 'required|numeric|gt:0';
            }
            // $rules['discount'] = 'required|numeric';
            $rules['use_limit'] = 'required|numeric|min:1|';
            $rules['time_limit'] = 'required|numeric|min:1|';
            // $rules['min_price'] = 'required|numeric';
            $rules['starting_date'] = 'required';
            // $rules['expiry_date'] = 'required|after:starting_date';
            $rules['expiry_date'] = 'required';

        }else{
                   
            $rules['coupon_name'] = 'required';
            $rules['coupon_code'] = 'required';
            $rules['discount_type'] = 'required';
            if($_REQUEST['discount_type'] == 'Percentage'){
                $rules['discount'] = 'required|numeric|min:1|max:100';
            }else{
                $rules['discount'] = 'required|numeric|gt:0';
            }
            // $rules['discount'] = 'required|numeric';
            $rules['use_limit'] = 'required|numeric|min:1|';
            $rules['time_limit'] = 'required|numeric|min:1|';
            // $rules['min_price'] = 'required|numeric';
            $rules['starting_date'] = 'required';
            // $rules['expiry_date'] = 'required|after:starting_date';
            $rules['expiry_date'] = 'required';
          
        }
        return $rules;
    }
   
    public function messages(){
        return[
            'coupon_code.required'=>'Please enter coupon code',
            'coupon_name.required'=>'Please enter coupon name',
            'discount_type.required'=>'Please enter discount type',
            'discount.required'=>'Please enter discount',
            'use_limit.required'=>'Please enter use limit',
            'time_limit.required'=>'Please enter time limit',
            // 'min_price.required'=>'Please enter minimum price',
            'starting_date.required'=>'Please enter starting date',
            'expiry_date.required'=>'Please enter expiry date',
            
            
        ];
    }
}

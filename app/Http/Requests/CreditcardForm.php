<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class CreditcardForm extends FormRequest
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
 
            $rules['credit_card_number'] = 'required|digits:12';
            $rules['credit_card_type'] = 'required';
            $rules['card_member_name'] = 'required';
            $rules['expiration_date'] = 'required';
            $rules['billing_address'] = 'required';
            $rules['phone'] = 'required|digits:10|regex:/^([0-9]*)$/';
        
          

        }else{
                   
            $rules['credit_card_number'] = 'required|digits:12';
            $rules['credit_card_type'] = 'required';
            $rules['card_member_name'] = 'required';
            $rules['expiration_date'] = 'required';
            $rules['billing_address'] = 'required';
            $rules['phone'] = 'required|digits:10|regex:/^([0-9]*)$/';
       
      
        }
        return $rules;
    }

    public function messages(){
        return[
            'credit_card_number.required'=>'Please enter Credit Card Number',
            'credit_card_type.required'=>'Please select Credit Card Type',
            'card_member_name.required'=>'Please enter Card Member Name',
            'expiration_date.required'=>'Please select Expiration Date',
            'billing_address.required'=>'Please enter Billing Address',
            'phone.required'=>'Please enter Phone Number',
    
        
        ];
    }
}

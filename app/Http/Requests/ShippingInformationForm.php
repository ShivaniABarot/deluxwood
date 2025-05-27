<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class ShippingInformationForm extends FormRequest
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
            $rules['ship_name'] = 'required';
            $rules['ship_email'] = 'required|email';
            $rules['ship_contact_no'] = 'required|digits:10|regex:/^([0-9]*)$/';
            $rules['ship_address'] = 'required';
            $rules['ship_state'] = 'required';
            $rules['ship_city'] = 'required';
            $rules['ship_zip_code'] = 'required';
          
        }else{
                   
            $rules['ship_name'] = 'required';
            $rules['ship_email'] = 'required|email';
            $rules['ship_contact_no'] = 'required|digits:10|regex:/^([0-9]*)$/';
            $rules['ship_address'] = 'required';
            $rules['ship_state'] = 'required';
            $rules['ship_city'] = 'required';
            $rules['ship_zip_code'] = 'required';
        }
        return $rules;
    }
   
    public function messages(){
        return[
            'ship_name.required'=>'Please enter name',
            'ship_email.required'=>'Please enter email ',
            'ship_contact_no.required'=>'Please enter contact no ',
            'ship_address.required'=>'Please enter address',
            'ship_state.required'=>'Please select state  ',
            'ship_city.required'=>'Please enter city ',
            'ship_zip_code.required'=>'Please enter zip code',

           
           ];
    }
}

<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class CustomerDraftForm extends FormRequest
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
   

        }else{
                   
            $rules['po_number'] = 'required';
            //$rules['order_tag'] = 'required';
            // $rules['showroom'] = 'required';
             $rules['designer'] = 'required';
            // // $rules['discount'] = 'required|numeric|between:1,100';
            // $rules['client_name'] = 'required';
            // $rules['client_email'] = 'required|email|regex:/^[\w-]+(?:\.[\w-]+)*@(?:[\w-]+\.)+[a-zA-Z]{2,7}$/';
            // $rules['address'] = 'required';
            // $rules['contact_no'] = 'required|digits:10|regex:/^([0-9]*)$/';
            // $rules['city'] = 'required';
            // $rules['state'] = 'required';
            // $rules['zip_code'] = 'required';
            $rules['ship_name'] = 'required';
            $rules['ship_email'] = 'required|email|regex:/^[\w-]+(?:\.[\w-]+)*@(?:[\w-]+\.)+[a-zA-Z]{2,7}$/';
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
            'po_number.required'=>'Please enter PO number',
            'order_tag.required'=>'Please enter order tag',
            // 'showroom.required'=>'Please enter showroom',
            // 'designer.required'=>'Please enter designer',
            // // 'discount.required'=>'Please enter discount',
            // 'client_name.required'=>'Please enter client name',
            // 'client_email.required'=>'Please enter client email',
            // 'address.required'=>'Please enter address',
            // 'contact_no.required'=>'Please enter contact no',
            // 'city.required'=>'Please enter city',
            // 'state.required'=>'Please select state',
            // 'zip_code.required'=>'Please enter zip code',
            // 'ship_name.required'=>'Pelase enter name',
            // 'ship_email.required'=>'Please enter email',
            // 'ship_contact_no.required'=>'Please enter contact no',
            // 'ship_address.required'=>'please enter address',
            // 'ship_state.required'=>'Please select state',
            // 'ship_city.required'=>'Please enter city',
            // 'ship_zip_code.required'=>'Please enter zip code',
            
    
        
        ];
    }
}

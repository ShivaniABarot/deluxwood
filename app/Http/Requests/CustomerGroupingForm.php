<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class CustomerGroupingForm extends FormRequest
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
 
            $rules['company_name'] = 'required';
            $rules['representative_name'] = 'required';
            $rules['contact_number'] = 'required';
            $rules['email'] = 'required';
            $rules['address'] = 'required';
            $rules['city'] = 'required';
            $rules['customer_group_id'] = 'required';
        
          

        }else{
                   
            $rules['company_name'] = 'required';
            $rules['representative_name'] = 'required';
            $rules['contact_number'] = 'required';
            $rules['email'] = 'required';
            $rules['address'] = 'required';
            $rules['city'] = 'required';
            $rules['customer_group_id'] = 'required';
       
      
        }
        return $rules;
    }

    public function messages(){
        return[
            'company_name.required'=>'Please enter company name',
            'representative_name.required'=>'Please enter representative name',
            'contact_number.required'=>'Please enter contact number',
            'email.required'=>'Please enter email',
            'address.required'=>'Please enter address',
            'city.required'=>'Please enter city',
            'customer_group_id.required'=>'Please select group type',
        ];
    }
}

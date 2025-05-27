<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class CustomerGroupForm extends FormRequest
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
 
            $rules['group_title'] = 'required';
            $rules['group_discount_percent'] = 'required|regex:/^\d+(\.\d{2,3})?$/|between:1,100';
            $rules['group_description'] = 'required';
        
          

        }else{
                   
            $rules['group_title'] = 'required|unique:customer_group,group_title';
            $rules['group_discount_percent'] = 'required|regex:/^\d+(\.\d{2,3})?$/|between:1,100';
            $rules['group_description'] = 'required';
       
      
        }
        return $rules;
    }

    public function messages(){
        return[
            'group_title.required'=>'Please enter group title',
            'group_discount_percent.required'=>'Please enter group discount',
            'group_description.required'=>'Please enter group description',
    
        
        ];
    }
}

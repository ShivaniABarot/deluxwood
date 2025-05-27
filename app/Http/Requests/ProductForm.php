<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class ProductForm extends FormRequest
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
 
            $rules['product_category_id'] = 'required';
            $rules['product_name'] = 'required';
            $rules['door_style_id'] = 'required';
        }else{
              
            $rules['product_category_id'] = 'required';
            $rules['product_name'] = 'required';
            $rules['door_style_id'] = 'required';   
        }
        return $rules;
    }
   
    public function messages(){
        return[
            'product_category_id.required'=>'Please Select Category',
            'product_name.required'=>'Please Enter Product Name',
            'door_style_id.required'=>'Please Select Door style',
           
           ];
    }
}

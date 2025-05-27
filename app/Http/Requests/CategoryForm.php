<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class CategoryForm extends FormRequest
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
 
            $rules['title'] = 'required';
            $rules['description'] = 'required';
        }else{
                   
            $rules['title'] = 'required|unique:product_category,title';  
            $rules['description'] = 'required';     
        }
        return $rules;
    }
   
    public function messages(){
        return[
            'title.required'=>'Please enter Title',
            'description.required'=>'Please enter Description '
           
           ];
    }
}

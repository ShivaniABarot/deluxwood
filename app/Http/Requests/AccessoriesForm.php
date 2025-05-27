<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class AccessoriesForm extends FormRequest
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
        if($this->method()=='PATCH')
        {
 
            $rules['accessories_name'] = 'required';
            $rules['quantity'] = 'required|numeric';
            $rules['accessories_description'] = 'required';
        }
        else
        {
                   
            $rules['accessories_name'] = 'required|unique:accessoriesmaster,accessories_nm';  
            $rules['quantity'] = 'required|numeric';
            $rules['accessories_description'] = 'required';     
        }
        return $rules;
    }
   
    public function messages(){
        return[
            'accessories_name.required'=>'Please enter Name ',
            'quantity.required'=>'Please enter Quantity ',
            'accessories_description.required'=>'Please enter Description '
           
           ];
    }
}

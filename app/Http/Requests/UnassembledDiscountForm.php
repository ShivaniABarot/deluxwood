<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class UnassembledDiscountForm extends FormRequest
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
 
            $rules['unassembled_discount'] = 'required';
          
        }else{
                   
            $rules['unassembled_discount'] = 'required';
          
        }
        return $rules;
    }

    public function messages(){
        return[
            'unassembled_discount.required'=>'Please enter discount percentage',
        
        ];
    }
}

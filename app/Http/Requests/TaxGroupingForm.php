<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class TaxGroupingForm extends FormRequest
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
 
            $rules['tax_group'] = 'required';


        }else{
                   
            $rules['tax_group'] = 'required';
      
        }
        return $rules;
    }

    public function messages(){
        return[
            'tax_group.required'=>'Please select tax group',
        
        ];
    }
}

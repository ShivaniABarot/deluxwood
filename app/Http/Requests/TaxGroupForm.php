<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class TaxGroupForm extends FormRequest
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
            if($_REQUEST['tax_group'] == 'With Tax'){
                $rules['tax_rate'] = 'required';
            }


        }else{
                   
            $rules['tax_group'] = 'required';
            if($_REQUEST['tax_group'] == 'With Tax'){
                $rules['tax_rate'] = 'required';
            }
            
      
      
        }
        return $rules;
    }

    public function messages(){
        return[
            'tax_group.required'=>'Please select tax group',
            'tax_rate.required'=>'Please enter tax rate',
        
        ];
    }
}

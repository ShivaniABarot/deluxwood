<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class SpecbookForm extends FormRequest
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
        $rules['first_selected'] = 'required|unique:accessoriesmaster,accessories_nm';  
        $rules['second_selected'] = 'required';     
        return $rules;
    }
   
    public function messages(){
        return[
            'first_selected.required'=>'Please first product ',
            'second_selected.required'=>'Please second product '
           
           ];
    }
}

<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class ModificationForm extends FormRequest
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

    {   //update
        if($this->method()=='PATCH')
        {
            $rules['modifiacation_nm'] = 'required|unique:modificationmaster,modifiacation_nm';
            $rules['modifiacation_desc'] = 'required';
        }
        else
        {
                       
            $rules['modifiacation_nm'] = 'required|unique:modificationmaster,modifiacation_nm';  
            $rules['modifiacation_desc'] = 'required';     
        }
        return $rules;
       
    }

    public function messages(){
        return[
            'modifiacation_nm.required'=>'Please enter name ',
            'modifiacation_desc.required'=>'Please enter description '
           
           ];
    }
}

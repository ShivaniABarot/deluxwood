<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class AddmodificationForm extends FormRequest
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
 
            $rules['modification_name'] = 'required';
            $rules['modification_desc'] = 'required';
            $rules['modification_information'] = 'required';
            
            if($_REQUEST['modification_information'] == 'Yes'){
                $rules['option'] = 'required';
               
            }
        }else{
                   
            $rules['modification_name'] = 'required|unique:modificationmaster,modification_nm';  
            $rules['modification_desc'] = 'required'; 
            $rules['modification_information'] = 'required';
            
            if($_REQUEST['modification_information'] == 'Yes'){
                $rules['option'] = 'required';
               
            }
        }
        return $rules;
    }
   
    public function messages(){
        return[
            'modification_name.required'=>'Please enter Name',
            'modification_desc.required'=>'Please enter Description ',
            'select_radio.required'=>'Please select ',
            'modification_information.required'=>'Please enter Modification Information',
           
           ];
    }
}

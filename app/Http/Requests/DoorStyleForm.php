<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class DoorStyleForm extends FormRequest
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
 
          
            $rules['name'] = 'required';
            $rules['line'] = 'required';
            $rules['description'] = 'required';
            $rules['assemble_options'] = 'required';   
        }else{
                   
            $rules['name'] = 'required|unique:door_style,name';  
            $rules['line'] = 'required';
            $rules['description'] = 'required';     
            $rules['assemble_options'] = 'required';    
        }
        return $rules;
    }
   
    public function messages(){
        return[
            'name.required'=>'Please enter Door Style Name ',
            'line.required'=>'Please select Line ',
            'description.required'=>'Please enter Description ',
             'assemble_options.required'=>'Please select Assemble Option '
           
           ];
    }
}

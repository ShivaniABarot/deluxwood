<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class ResetPasswordForm extends FormRequest
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
 
            $rules['old_password'] = 'required';
            $rules['new_password'] = 'required';
            $rules['con_password'] = 'required';

        }else{
                   
            $rules['old_password'] = 'required';
            $rules['new_password'] = 'required';
            $rules['con_password'] = 'required';
    
        }
        return $rules;
    }
   
    public function messages(){
        return[
          
            'old_password.required' => 'Please Current Password',
            'new_password.required' => 'Please New Password',
            'con_password.required' => 'Please Confirmation Password',

           ];
    }
}

<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
class CustomerEditProfileForm extends FormRequest
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
        $id = Auth::user()->id;
        if($this->method()=='PATCH'){
 
            $rules = [
                'company_name' => 'required',
                'contact_number' => 'required|digits:10|regex:/^([0-9]*)$/',
                'address' => 'required',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users', 'email')->ignore($id), // Ignore the current user's email
                    'regex:/^[\w-]+(?:\.[\w-]+)*@(?:[\w-]+\.)+[a-zA-Z]{2,7}$/',
                ],
                'representative_name' => 'required',
            ];

          
        }
        return $rules;
    }
   
    public function messages(){
        return[
            'company_name.required'=>'Please enter company name',
            'address.required'=>'Please enter Address',
            'contact_number.required'=>'Please enter contact number',
            'email.required'=>'Please enter email',
           'representative_name.required'=>'Please representative name',
     

      
        ];
    }
}

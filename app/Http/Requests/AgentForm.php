<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Agent;

class AgentForm extends FormRequest
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
 
            $agentId = request()->segment(3); 
            $agent = Agent::find($agentId);
            if ($agent) {
            $userId = $agent->user_id;
            $rules['email'] = [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($userId),
            ];
        }
            $rules['name'] = 'required';
            $rules['username'] = 'required';
           
           
           // $rules['email'] = 'required|email';
            // $rules['confirm_password'] = 'required|same:password';
            $rules['password'] = 'min:8';
            $rules['confirm_password'] = 'same:password';
        
          

        }else{
                   
            $rules['name'] = 'required';
            $rules['username'] = 'required';
          
            $rules['email'] = 'required|email|unique:users,email';
            $rules['password'] = 'required|min:8';
            $rules['confirm_password'] = 'required|same:password';
          
        }
        return $rules;
    }
   
    public function messages(){
        return[
            'name.required'=>'Please enter  Name',
            'email.required'=>'Please enter  Email',
            'username.required'=>'Please enter Username',
            'password.required'=>'Please enter Password',
            'password.min' => 'The Password must be at least 8 Characters',
            'confirm_password.required'=>'Please enter Confirm Password',
            'confirm_password.same' => 'The Confirm Password and Password must match',
           
        ];
    }
}

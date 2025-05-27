<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class ContactForm extends FormRequest
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
 
            $rules['contact_name'] = 'required';
            $rules['subject'] = 'required';
            $rules['contact_email'] = 'required|email|regex:/^[\w-]+(?:\.[\w-]+)*@(?:[\w-]+\.)+[a-zA-Z]{2,7}$/';
            $rules['contact_no'] = 'digits:10|regex:/^([0-9]*)$/';
        
          

        }else{
                   
            $rules['contact_name'] = 'required';
            $rules['subject'] = 'required';
            $rules['contact_email'] = 'required|email|regex:/^[\w-]+(?:\.[\w-]+)*@(?:[\w-]+\.)+[a-zA-Z]{2,7}$/';
            $rules['contact_no'] = 'required|digits:10|regex:/^([0-9]*)$/';
       
      
        }
        return $rules;
    }

    public function messages(){
        return[
            'contact_name.required'=>'Please enter name',
            'subject.required'=>'Please enter subject',
            'contact_no.required'=>'Please enter contact number',
            'contact_email.required'=>'Please enter contact email',
    
        
        ];
    }
}

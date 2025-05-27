<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class CompleteProfileForm extends FormRequest
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
 
            $rules['company_name'] = 'required';
            $rules['address'] = 'required';
            $rules['representative_name'] = 'required';
            $rules['showroom'] = 'required';
            $rules['contact_number'] = 'required|digits:10|regex:/^([0-9]*)$/';
            $rules['domenstic_lines'] = 'required';
            $rules['import_lines'] = 'required';
            $rules['fax'] = 'required|numeric|min:999999';
            $rules['date_business_started'] = 'required';
            $rules['showroom_sq'] = 'required|numeric';
            $rules['annual_cabinet_sales'] = 'required|numeric';
            $rules['city'] = 'required';
            $rules['state'] = 'required';
            $rules['owner_name'] = 'required';
            $rules['owner_address'] = 'required';
            $rules['owner_phone'] = 'required|digits:10|regex:/^([0-9]*)$/';
            $rules['owner_city'] = 'required';
            $rules['owner_state'] = 'required';
            $rules['owner_zip'] = 'required';
            $rules['owner_email'] = 'required|email';
            $rules['tex_exempt'] = 'required';
            if($_REQUEST['tex_exempt'] == 'Yes'){
                $rules['tex_id'] = 'required';
            }
           
            $rules['email'] = 'required|email';
            // $rules['confirm_password'] = 'required|same:password';
            if($_REQUEST['reference_contact_number'] != ''){
                $rules['reference_contact_number'] = 'digits:10|regex:/^([0-9]*)$/';
              
            }
            
          

        }else{ 
                   
            $rules['company_name'] = 'required';
            $rules['address'] = 'required';
            $rules['representative_name'] = 'required';
            // $rules['showroom'] = 'required';
            $rules['contact_number'] = 'required|digits:10|regex:/^([0-9]*)$/';
            // $rules['domenstic_lines'] = 'required';
            // $rules['import_lines'] = 'required';
            $rules['fax'] = 'required|numeric|min:999999';
            // $rules['date_business_started'] = 'required';
            // $rules['showroom_sq'] = 'required|numeric';
            // $rules['annual_cabinet_sales'] = 'required|numeric';
            $rules['city'] = 'required';
            $rules['state'] = 'required';
            $rules['owner_name'] = 'required';
            $rules['owner_address'] = 'required';
            $rules['owner_phone'] = 'required|digits:10|regex:/^([0-9]*)$/';
            $rules['owner_city'] = 'required';
            $rules['owner_state'] = 'required';
            $rules['owner_zip'] = 'required';
            $rules['owner_email'] = 'required|email';
            $rules['tex_exempt'] = 'required';
            $rules['email'] = 'required|email';
            // $rules['password'] = 'required|min:8';
            // $rules['confirm_password'] = 'required|same:password';
            if($_REQUEST['tex_exempt'] == 'Yes'){
                $rules['tex_id'] = 'required';
            }
            if($_REQUEST['reference_contact_number'] != ''){
                $rules['reference_contact_number'] = 'digits:10|regex:/^([0-9]*)$/';
              
            }
            

            
        }
        return $rules;
    }
   
    public function messages(){
        return[
            'company_name.required'=>'Please enter Company Name',
            'address.required'=>'Please enter Address',
            'representative_name.required'=>'Please enter Representative  Name',
            'showroom.required'=>'Please enter Showroom',
            'contact_number.required'=>'Please enter Contact Number',
            'domenstic_lines.required'=>'Please enter Domestic Lines',
            'email.required'=>'Please enter Email',
            'import_lines.required'=>'Please enter Import Lines',
            'fax.required'=>'Please enter Fax',
            'date_business_started.required'=>'Please enter Date Business Started',
            'showroom_sq.required'=>'Please enter Showroom SQ FT',
            'showroom_sq.numeric' => 'The Showroom SQ FT must be a number',
            'annual_cabinet_sales.required'=>'Please enter Annual Cabinet Sales',
            'city.required'=>'Please enter City',
            'state.required'=>'Please enter State',
            'owner_name.required'=>'Please enter  Name',
            'owner_address.required'=>'Please enter  Address',
            'owner_phone.required'=>'Please enter  Phone',
            'owner_city.required'=>'Please enter  City',
            'owner_state.required'=>'Please enter State',
            'owner_zip.required'=>'Please enter Zip',
            'owner_email.required'=>'Please enter Email',
            'owner_email.email'=>'The Owner Email must be a valid email address.',
            'tex_exempt.required'=>'Please Select Are you Tax Exempt',
            'tex_id.required'=>'Please enter Tax ID',
            // 'password.required'=>'Please enter Password',
            // 'password.min' => 'The Password must be at least 8 Characters',
            'confirm_password.required'=>'Please enter Confirm Password',
            'confirm_password.same' => 'The Confirm Password and Password must match',
            'fax.min'=>'The fax must  be greater than 6 digit'
           

        
        ];
    }
}

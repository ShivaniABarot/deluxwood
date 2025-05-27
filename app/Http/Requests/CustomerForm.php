<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class CustomerForm extends FormRequest
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
            // $rules['showroom'] = 'required';
            $rules['contact_number'] = 'required|digits:10|regex:/^([0-9]*)$/';
            // $rules['domenstic_lines'] = 'required';
            // $rules['import_lines'] = 'required';
            // $rules['fax'] = 'required|numeric|min:999999';
            // $rules['date_business_started'] = 'required';
            // $rules['showroom_sq'] = 'required|numeric';
            // $rules['annual_cabinet_sales'] = 'required|numeric';
            $rules['city'] = 'required';
            $rules['state'] = 'required';
            $rules['owner_name'] = 'required';
            // $rules['owner_address'] = 'required';
            $rules['owner_phone'] = 'required|digits:10|regex:/^([0-9]*)$/';
            // $rules['owner_city'] = 'required';
            // $rules['owner_state'] = 'required';
            // $rules['owner_zip'] = 'required';
            $rules['owner_email'] = 'required|email';
            $rules['tex_exempt'] = 'required';
            if($_REQUEST['tex_exempt'] == 'Yes'){
                $rules['tex_id'] = 'required';
            }
            // $rules['sales_form'] = 'required';
           
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
            // $rules['fax'] = 'required|numeric|min:999999';
            // $rules['date_business_started'] = 'required';
            // $rules['showroom_sq'] = 'required|numeric';
            // $rules['annual_cabinet_sales'] = 'required|numeric';
            $rules['city'] = 'required';
            $rules['state'] = 'required';
            $rules['owner_name'] = 'required';
            // $rules['owner_address'] = 'required';
            $rules['owner_phone'] = 'required|digits:10|regex:/^([0-9]*)$/';
            // $rules['owner_city'] = 'required';
            // $rules['owner_state'] = 'required';
            // $rules['owner_zip'] = 'required';
            $rules['owner_email'] = 'required|email';

                       // new 
                    //    $rules['dealer_com_name'] = 'required';
                    //    $rules['business_type'] = 'required';
                    //    $rules['business_address'] = 'required';
                    //    $rules['business_city'] = 'required';
                    //    $rules['business_state'] = 'required';
                    //    $rules['business_zip'] = 'required';
                    //    $rules['is_showroom'] = 'required';
                    //    if($_REQUEST['is_showroom'] == 'Yes'){
                    //        $rules['showroom_sq'] = 'required|numeric';
                    //        if($_REQUEST['same_sr_address'] == 'No'){
           
                    //        $rules['showroom_address'] = 'required';
                    //        $rules['showroom_city'] = 'required';
                    //        $rules['showroom_state'] = 'required';
                    //        $rules['showroom_zip'] = 'required';
                    //        }
                    //    }
                    //    $rules['main_contact_name'] = 'required';
                    //    $rules['main_contact_phone'] = 'required';
                    //    $rules['main_contact_email'] = 'required';
                    //    $rules['billing_name'] = 'required';
                    //    $rules['billing_phone'] = 'required';
                    //    $rules['billing_email'] = 'required';
                    //    if($_REQUEST['same_b_address'] == 'No'){
           
                    //        $rules['billing_address'] = 'required';
                    //        $rules['billing_city'] = 'required';
                    //        $rules['billing_state'] = 'required';
                    //        $rules['billing_zip'] = 'required';
                    //    }
                    //    $rules['how_did_you_hear'] = 'required';
                    //    if($_REQUEST['how_did_you_hear'] == 'Referral' || $_REQUEST['how_did_you_hear'] == 'Sales Rep' || $_REQUEST['how_did_you_hear'] == 'Other'){
           
                    //        $rules['note'] = 'required';
                    //    }
           
                       // new end
            $rules['tex_exempt'] = 'required';
            // $rules['sales_form'] = 'required';
            $rules['email'] = 'required|email|unique:users,email';
            $rules['password'] = 'required|min:8';
            $rules['confirm_password'] = 'required|same:password';
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
            // 'showroom.required'=>'Please enter Showroom',
            'contact_number.required'=>'Please enter Contact Number',
            // 'domenstic_lines.required'=>'Please enter Domestic Lines',
            'email.required'=>'Please enter Email',
            // 'import_lines.required'=>'Please enter Import Lines',
            // 'fax.required'=>'Please enter Fax',
            // 'date_business_started.required'=>'Please enter Date Business Started',
            // 'annual_cabinet_sales.required'=>'Please enter Annual Cabinet Sales',
            'city.required'=>'Please enter City',
            'state.required'=>'Please enter State',
            'owner_name.required'=>'Please enter  Name',
            // 'owner_address.required'=>'Please enter  Address',
            'owner_phone.required'=>'Please enter  Phone',
            // 'owner_city.required'=>'Please enter  City',
            // 'owner_state.required'=>'Please enter State',
            // 'owner_zip.required'=>'Please enter Zip',
            'owner_email.required'=>'Please enter Email',
            'owner_email.email'=>'The Owner Email must be a valid email address.',
            'tex_exempt.required'=>'Please Select Are you Tax Exempt',
            'tex_id.required'=>'Please enter Tax ID',
            // 'sales_form.required'=>'Please upload sales certificate.',
            'password.required'=>'Please enter Password',
            'password.min' => 'The Password must be at least 8 Characters',
            'confirm_password.required'=>'Please enter Confirm Password',
            'confirm_password.same' => 'The Confirm Password and Password must match',
            'fax.min'=>'The fax must  be greater than 6 digit',
            // 'showroom_sq.required'=>'Please enter Showroom SQ FT',
            // 'showroom_sq.numeric' => 'The Showroom SQ FT must be a number',
            // 'dealer_com_name.required'=>'Please enter Dealer Company Name',
            // 'business_type.required'=>'Please select Business Type',
            // 'business_address.required'=>'Please enter Business Address',
            // 'business_city.required'=>'Please enter Business City',
            // 'business_state.required'=>'Please select Business State',
            // 'business_zip.required'=>'Please enter Business Zip',
            // 'is_showroom.required'=>'Please select',
            // 'showroom_address.required'=>'Please enter Showroom Address',
            // 'showroom_city.required'=>'Please enter Showroom City',
            // 'showroom_state.required'=>'Please select Showroom State',
            // 'showroom_zip.required'=>'Please enter Showroom Zip',
            // 'main_contact_name.required'=>'Please enter Main Contact Name',
            // 'main_contact_phone.required'=>'Please enter Main Contact Phone',
            // 'main_contact_email.required'=>'Please enter Main Contact Email',
            // 'billing_name.required'=>'Please enter Main Billing Name',
            // 'billing_phone.required'=>'Please enter Main Billing Phone',
            // 'billing_email.required'=>'Please enter Main Billing Email',
            // 'billing_address.required'=>'Please enter Billing Address',
            // 'billing_city.required'=>'Please enter Billing City',
            // 'billing_state.required'=>'Please select Billing State',
            // 'billing_zip.required'=>'Please enter Billing Zip',
            // 'how_did_you_hear.required'=>'Please enter',
            // 'note.required'=>'Please enter Note',


        
        ];
    }
}

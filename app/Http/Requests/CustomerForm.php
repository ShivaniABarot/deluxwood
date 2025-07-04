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
        $rules = [];

        if ($this->method() == 'PATCH') {
            $rules = [
                'company_name' => 'required',
                'address' => 'required',
                'representative_name' => 'required',
                'contact_number' => 'required|digits:10|regex:/^([0-9]*)$/',
                'city' => 'required',
                'state' => 'required',
                'owner_name' => 'required',
                'owner_phone' => 'required|digits:10|regex:/^([0-9]*)$/',
                'owner_email' => 'required|email',
                'tex_exempt' => 'required',
                'email' => 'required|email|unique:customer,email',
            ];

            if ($this->input('tex_exempt') == 'Yes') {
                $rules['tex_id'] = 'required';
                $rules['sales_form'] = 'required|file|mimes:pdf,jpg,jpeg,png';
            }

            if ($this->input('reference_contact_number') != '') {
                $rules['reference_contact_number'] = 'digits:10|regex:/^([0-9]*)$/';
            }
        } else {
            $rules = [
                'company_name' => 'required',
                'address' => 'required',
                'representative_name' => 'required',
                'contact_number' => 'required|digits:10|regex:/^([0-9]*)$/',
                'city' => 'required',
                'state' => 'required',
                'owner_name' => 'required',
                'owner_phone' => 'required|digits:10|regex:/^([0-9]*)$/',
                'owner_email' => 'required|email',
                'tex_exempt' => 'required',
                'email' => 'required|email|unique:customer,email',
                'password' => 'required|min:8',
                'confirm_password' => 'required|same:password',
            ];

            if ($this->input('tex_exempt') == 'Yes') {
                $rules['tex_id'] = 'required';
                $rules['sales_form'] = 'required|file|mimes:pdf,jpg,jpeg,png';
            }

            if ($this->input('reference_contact_number') != '') {
                $rules['reference_contact_number'] = 'digits:10|regex:/^([0-9]*)$/';
            }
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'company_name.required' => 'Please enter Company Name',
            'address.required' => 'Please enter Address',
            'representative_name.required' => 'Please enter Representative  Name',
            // 'showroom.required'=>'Please enter Showroom',
            'contact_number.required' => 'Please enter Contact Number',
            // 'domenstic_lines.required'=>'Please enter Domestic Lines',
            'email.required' => 'Please enter Email',
            // 'import_lines.required'=>'Please enter Import Lines',
            // 'fax.required'=>'Please enter Fax',
            // 'date_business_started.required'=>'Please enter Date Business Started',
            // 'annual_cabinet_sales.required'=>'Please enter Annual Cabinet Sales',
            'city.required' => 'Please enter City',
            'state.required' => 'Please enter State',
            'owner_name.required' => 'Please enter  Name',
            // 'owner_address.required'=>'Please enter  Address',
            'owner_phone.required' => 'Please enter  Phone',
            'sales_form.required' => 'Please upload the sales certificate.',
            'sales_form.mimes' => 'The sales certificate must be a PDF, JPG, or PNG file.',
            // 'owner_city.required'=>'Please enter  City',
            // 'owner_state.required'=>'Please enter State',
            // 'owner_zip.required'=>'Please enter Zip',
            'owner_email.required' => 'Please enter Email',
            'owner_email.email' => 'The Owner Email must be a valid email address.',
            'tex_exempt.required' => 'Please Select Are you Tax Exempt',
            'tex_id.required' => 'Please enter Tax ID',
            // 'sales_form.required'=>'Please upload sales certificate.',
            'password.required' => 'Please enter Password',
            'password.min' => 'The Password must be at least 8 Characters',
            'confirm_password.required' => 'Please enter Confirm Password',
            'confirm_password.same' => 'The Confirm Password and Password must match',
            'fax.min' => 'The fax must  be greater than 6 digit',
            'email.unique' => 'This email is already used. Please use a different one.',
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

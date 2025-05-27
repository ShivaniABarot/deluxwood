<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class ItemForm extends FormRequest
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
            $rules['product_category_id'] = 'required';
            $rules['door_style_id'] = 'required';
            $rules['product_name'] = 'required';
            $rules['availability'] = 'required';
            // $rules['quantity'] = 'required|numeric| between:1,100';
            $rules['quantity'] = 'required|numeric|min:1';
            $rules['product_item_name'] = 'required';
            $rules['product_item_sku'] = 'required';
            // $rules['description'] = 'required';
            $rules['finish_side'] = 'required';
            
            if($_REQUEST['finish_side'] == 'Yes'){
                $rules['right_finish_side_price'] = 'required|numeric';
                $rules['left_finish_side_price'] = 'required|numeric';
                $rules['both_finish_side_price'] = 'required|numeric';
            }
            $rules['hinge_side'] = 'required';
            
            if($_REQUEST['hinge_side'] == 'Yes'){
                $rules['right_hinge_side_price'] = 'required|numeric';
                $rules['left_hinge_side_price'] = 'required|numeric';
                // $rules['both_hinge_side_price'] = 'required|numeric';
            }
            $rules['cut_depth'] = 'required';
            $rules['increase_depth'] = 'required';
            $rules['cut_height'] = 'required';
            $rules['increase_height'] = 'required';

            if($_REQUEST['cut_depth'] == 'Yes'){
                $rules['cut_depth_price'] = 'required|numeric';
                // $rules['depth_name_inch'] = 'required|numeric';
                
            }
            // $rules['modification_id'] = 'required';
            // $rules['accessories_id'] = 'required';
            $rules['product_item_price'] = 'required|numeric';
            

          

        }else{
            $rules['product_category_id'] = 'required';
            $rules['door_style_id'] = 'required';
            $rules['product_name'] = 'required';
            $rules['availability'] = 'required';
            $rules['quantity'] = 'required|numeric|min:1';
            // $rules['quantity'] = 'required|numeric| between:1,100';
            $rules['product_item_name'] = 'required';
            $rules['product_item_sku'] = 'required';
            // $rules['product_item_sku'] = 'required|unique:product_item,product_item_sku';
            // $rules['description'] = 'required';
            $rules['finish_side'] = 'required';
            
            if($_REQUEST['finish_side'] == 'Yes'){
                $rules['right_finish_side_price'] = 'required|numeric';
                $rules['left_finish_side_price'] = 'required|numeric';
                $rules['both_finish_side_price'] = 'required|numeric';
            }
            $rules['hinge_side'] = 'required';
            
            if($_REQUEST['hinge_side'] == 'Yes'){
                $rules['right_hinge_side_price'] = 'required|numeric';
                $rules['left_hinge_side_price'] = 'required|numeric';
                // $rules['both_hinge_side_price'] = 'required|numeric';
            }
            $rules['cut_depth'] = 'required';
            $rules['increase_depth'] = 'required';
            $rules['cut_height'] = 'required';
            $rules['increase_height'] = 'required';

            if($_REQUEST['cut_depth'] == 'Yes'){
                $rules['cut_depth_price'] = 'required|numeric';
                // $rules['depth_name_inch'] = 'required|numeric';
                
            }
            // $rules['modification_id'] = 'required';
            // $rules['accessories_id'] = 'required';
            $rules['product_item_price'] = 'required|numeric';
            

            

            
        }
        return $rules;
    }
   
    public function messages(){
        return[
            'product_category_id.required'=>'Please select Category',
            'door_style_id.required'=>'Please select Door Style',
            'product_name.required'=>'Please enter Product Name',
            'availability.required'=>'Please select the value',
            'quantity.required'=>'Please enter Quantity',
            'product_item_name.required'=>'Please enter Item Name',
            'product_item_sku.required'=>'Please enter SKU',
            // 'description.required'=>'Please enter Description ',
            'finish_side.required'=>'Please select the value',
            'right_finish_side_price.required'=>'Please enter right finish side price',
            'left_finish_side_price.required'=>'Please enter left finish side price',
            'both_finish_side_price.required'=>'Please enter both finish  side price',
            'hinge_side.required'=>'Please select the value',
            'right_finish_hinge_price.required'=>'Please enter right  finish hinge price',
            'left_finish_hinge_price.required'=>'Please enter left finish hinge price',
            'both_finish_hinge_price.required'=>'Please enter both finish hinge price',
            'cut_depth.required'=>'Please select the value',
            'cut_depth_price.required'=>'Please enter cut depth  price',
            'increase_depth.required'=>'Please select the value',
            'cut_height.required'=>'Please select the value',
            'increase_height.required'=>'Please select the value',
            // 'depth_name_inch.required'=>'Please Enter Depth inch',
            // 'depth_name_inch.numeric'=>'Depth inch must be a number',
            'modification_id.required'=>'Please select modification',
            'accessories_id.required'=>'Please Select accessories',
            'product_item_price.required'=>'Please enter Product Item Price',
           
           

        
        ];
    }
}

@extends(backendView('layouts.app'))

@section('title', 'Item Add')

@section('content')
<div class="container-xxl">
    <div class="row align-items-center">
        <div class="border-0 mb-4">
            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                <h3 class="fw-bold mb-0"> Add Item</h3>
                 <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/item-list')}}">Items</a></li>
                            <li class="breadcrumb-item active" aria-current="page" style="background: none; border: none;">Add Item</li>
                        </ol>
                    </nav>
            </div>
        </div>
    </div> <!-- Row end  -->
    <div class="row clearfix g-3">

        <div class="col-lg-12">
            <div class="card mb-3">
                <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                    <h6 class="m-0 fw-bold"></h6>
                </div>
                <div class="card-body">
                    <form action="{{url('admin/doorprice-store')}}" method="POST" id="customergroupForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3 align-items-center">
                            <div class="col-6">
                                <div class="mb-2">
                                    <label class="form-label">Product Category <span class="text-danger">*</span></label>
                                    <select class="form-control category" name="product_category_id">
                                        <option value="">Please Select</option>
                                        @foreach($productCategory as $productCategory )
                                        <option value="{{$productCategory->category_id}}">{{$productCategory->title}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger kt-form__help error product_category_id"></span>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="mb-2">
                                    <label class="form-label">Door Style <span class="text-danger">*</span></label>
                    
                                    <select id="door_style_id" class="form-control form-control-sm" name="door_style_id[]" multiple>
                                        <option value="">Please Select</option>
                                        @foreach($doorStyle as $doorStyle)
                                        <option value="{{$doorStyle->doorStyle_id}}">{{$doorStyle->name}}</option>
                                        @endforeach
                                    </select>

                                    <span class="text-danger kt-form__help error door_style_id"></span>
                                </div>
                            </div>
                            <div id="selectedDoorValuesContainer" style="display:none;margin-left:1px;background-color: #f1f1f1; border: 1px solid #ccc; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); " class="row"></div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label class="form-label">Product Name <span class="text-danger">*</span></label>
                                    <input type="text" name="product_name" class="form-control form-control-sm" placeholder="Enter Product Name">
                                    <span class="text-danger kt-form__help error product_name"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Item Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="product_item_name" placeholder="Please enter Item Name">
                                <span class="text-danger kt-form__help error product_item_name"></span>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">SKU <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="product_item_sku" placeholder="Please enter SKU">
                                <span class="text-danger kt-form__help error product_item_sku"></span>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label"> Description </label>
                                <textarea class="form-control" rows="3" name="description" placeholder="Please enter  Description" style="resize: none;"></textarea>
                                <span class="text-danger kt-form__help error description"></span>
                            </div>

                            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                <h6 class="m-0 fw-bold">Dimensions</h6>
                            </div>



                            <div class="row dimension">
                                <div class="col-2">
                                    <div class="mb-2">
                                        <label class="form-label">Length</label>
                                        <input type="text" name="item_length[]" class="form-control form-control-sm item_length" placeholder="Product Length" onclick="item_lengthClicked(this)">
                                        <span class="text-danger item_length_error"></span>
                                        <span class="text-danger kt-form__help error item_length"></span>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="mb-2">
                                        <label class="form-label">Depth</label>
                                        <input type="text" name="item_breadth[]" class="form-control form-control-sm item_breadth" placeholder="Product Depth" onclick="item_breadthClicked(this)">
                                        <span class="text-danger  item_breadth_error"></span>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="mb-2">
                                        <label class="form-label">Height</label>
                                        <input type="text" name="item_height[]" class="form-control form-control-sm item_height" placeholder="Product Height" onclick="item_heightClicked(this)">
                                        <span class="text-danger item_height_error"></span>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="mb-2">
                                        <label class="form-label">Weight</label>
                                        <input type="text" name="item_weight[]" class="form-control form-control-sm item_weight" placeholder="Product Weight" onclick="item_weightClicked(this)">
                                        <span class="text-danger  item_weight_error"></span>
                                    </div>
                                </div>
                                <!-- <div class="col-2">
                                    <div class="mb-2">
                                        <label class="form-label">Price</label>
                                        <input type="text" name="item_price[]" class="form-control form-control-sm item_price" placeholder="Product Price" onclick="item_priceClicked(this)">
                                        <span class="text-danger  item_price_error"></span>
                                    </div>
                                </div> -->

                                <div class="col-2">
                                    <div class="mb-2">
                                        <button type="button" class="btn btn-warning btn-circle btn-xl add_button"  title="Add field" style="margin-top:25px; margin-left:20px">+ </button>
                                    </div>
                                </div>
                                <div id="dimension_card"></div>
                            </div>
                            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                <h6 class="m-0 fw-bold">Customization </h6>
                            </div>
                            <div class="row">
                                <div class="row col-11">
                                    <div class="col-4">
                                        <div class="mb-2">
                                            <label class="form-label">Do you want to add Finish Side ? <span class="text-danger">*</span></label>
                                            <select class="form-control category" id="finish_side" name="finish_side">
                                                <option value="">Please Select</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            <span class="text-danger kt-form__help error finish_side"></span>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                            <div class="row" id="finish_side_div" style=" margin-top:30px">
                                <div class="row col-11">
                                    <div class="col-4">
                                        <div class="mb-2">
                                            <label class="form-label">Right Finish side Price</label>
                                            <input type="text" name="right_finish_side_price" class="form-control form-control-sm" placeholder="$">
                                            <span class="text-danger kt-form__help error right_finish_side_price"></span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-2">
                                            <label class="form-label">Left Finish Side Price</label>
                                            <input type="text" name="left_finish_side_price" class="form-control form-control-sm" placeholder="$">
                                            <span class="text-danger kt-form__help error left_finish_side_price"></span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-2">
                                            <label class="form-label">Both Finish Side Price</label>
                                            <input type="text" name="both_finish_side_price" class="form-control form-control-sm" placeholder="$">
                                            <span class="text-danger kt-form__help error both_finish_side_price"></span>
                                        </div>
                                    </div>
                               </div>
                                <div class="col-md-1" style="margin-top:20px;">
                                    <div class="mb-2">
                                        <div class="toggle-button-container service_type">
                                            <button type="button" class="toggle-button "  id="finish_side_button" onclick="toggleActive('finish_side_button')">None</button>
                                        </div>
                                        <input type="hidden" id="finish_side_input" name="finish_side_none"  value="No">
                                    </div>
                                </div>    
                            </div>
                            <div class="row" style=" margin-top:30px">
                                <div class="row col-11">
                                    <div class="col-4">
                                        <div class="mb-2">
                                            <label class="form-label">Do you want to add Hinge Side ? <span class="text-danger">*</span></label>
                                            <select class="form-control category" id="hinge_side" name="hinge_side">
                                                <option value="">Please Select</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            <span class="text-danger kt-form__help error hinge_side"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="hinge_side_div" style=" margin-top:30px">
                                <div class="row col-11">
                                    <div class="col-4">
                                        <div class="mb-2">
                                            <label class="form-label">Right Hinge side Price</label>
                                            <input type="text" name="right_hinge_side_price" class="form-control form-control-sm" placeholder="$">
                                            <span class="text-danger kt-form__help error right_hinge_side_price"></span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-2">
                                            <label class="form-label">Left Hinge Side Price</label>
                                            <input type="text" name="left_hinge_side_price" class="form-control form-control-sm" placeholder="$">
                                            <span class="text-danger kt-form__help error left_hinge_side_price"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="margin-top:20px;" >
                                        <div class="mb-2">
                                            <div class="toggle-button-container service_type">
                                                <button type="button" class="toggle-button "  id="hinge_side_button" onclick="toggleActive('hinge_side_button')">None</button>
                                            </div>
                                            <input type="hidden" id="hinge_side_input" name="hinge_side_none" value="No">
                                        </div>
                                    </div>  
                                </div> 
                                <!-- <div class="col-4">
                                    <div class="mb-2">
                                        <label class="form-label">Both Hinge Side Price</label>
                                        <input type="text" name="both_hinge_side_price" class="form-control form-control-sm" placeholder="$">
                                        <span class="text-danger kt-form__help error both_hinge_side_price"></span>
                                    </div>
                                </div> -->
                            </div>

                            <div class="row"  style=" margin-top:30px">
                                <div class="row col-11">
                                    <div class="col-4">
                                        <div class="mb-2">
                                            <label class="form-label">Do you want to add Cut Depth ? <span class="text-danger">*</span></label>
                                            <select class="form-control category" id="cut_depth" name="cut_depth">
                                                <option value="">Please Select</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            <span class="text-danger kt-form__help error cut_depth"></span>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                            <div class="row" id="cut_depth_div" style="margin-top: 30px;">
                                <div class="row col-11">
                                    <div class="col-4">
                                        <div class="mb-2">
                                            <label class="form-label">Cut Depth Price</label>
                                            <input type="text" name="cut_depth_price" class="form-control form-control-sm" placeholder="$">
                                            <span class="text-danger kt-form__help error cut_depth_price"></span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-2">
                                            <label class="form-label">Enter Depth (inch) </label>
                                           
                                            <input class="form-control form-control-sm tagify-input" id="depth_name_inch" name="depth_name_inch[]" >
                                           
                                            <span class="text-danger kt-form__help error depth_name_inch"></span>
                                            <span class="text-danger depth_name_inch_error"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-2">
                                    <label class="form-label">Modification  </label>
                                    <!-- <input type="text" name="representative_name"  class="form-control form-control-sm" placeholder="Enter Representative Name"> -->
                                    <select id="selectBox" class="form-control form-control-sm" name="modification_id[]" multiple>
                                        <option value="">Please Select</option>
                                        @foreach($modification as $modification )
                                        <option value="{{$modification->modification_id}}">{{$modification->modification_nm}}</option>
                                        @endforeach
                                    </select>

                                    <span class="text-danger kt-form__help error modification_id"></span>
                                </div>
                            </div>

                            <div id="selectedValuesContainer" style="display:none;margin-left:1px;background-color: #f1f1f1; border: 1px solid #ccc; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); " class="row"></div>

                            <div class="col-12">
                                <div class="mb-2">
                                    <label class="form-label">Accessories </label>
                                    <select id="accessories_id" class="form-control form-control-sm" name="accessories_id[]" multiple>
                                        <option value="">Please Select</option>
                                        @foreach($accessories as $accessories )
                                        <option value="{{$accessories->accessories_id}}">{{$accessories->accessories_nm}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger kt-form__help error accessories_id"></span>
                                </div>
                            </div>

                            <div id="accessoriesValuesContainer" style="display:none; margin-left:1px; background-color: #f1f1f1; border: 1px solid #ccc; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); " class="row"></div>


                            <div class="col-6">
                                <div class="mb-2">
                                    <label class="form-label" style="margin-top:8px">Product Images:</label>
                                    <input type="file" name="product_gallery[]" class="form-control"  id="file-input" onCLick="product_imageClicked(this)" multiple>
                                    <span class="text-danger" id="product_image_error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <label class="form-label">Quantity</label>
                                    <input type="number" name="quantity" class="form-control form-control-sm" placeholder="Enter Quantity">
                                    <span class="text-danger kt-form__help error quantity"></span>
                            </div>
                            <div class="col-lg-12">
                                <div id="preview" class="preview_img"></div>
                                <label style="display: none;">
                                    <p name="thumbnail" id="select-all">Select
                                </label>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label class="form-label">Availability <span class="text-danger">*</span></label>
                                    <select class="form-control " id="availability" name="availability">
                                        <option value="">Please Select</option>
                                        <option value="Listed">Listed</option>
                                        <option value="Unlisted">Unlisted</option>
                                    </select>
                                    <span class="text-danger kt-form__help error availability"></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <label class="form-label">Enter Price <span class="text-danger">*</span></label>
                                    <input type="text" name="product_item_price" class="form-control form-control-sm" placeholder="$">
                                    <span class="text-danger kt-form__help error product_item_price"></span>
                                </div>
                            </div>
      



                        </div>
                 
                        <button type="submit" class="btn btn-light mt-4 text-uppercase px-5">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- Row End -->
</div>
@endsection

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
@endpush

@push('custom_styles')
<style>
    /* Basic styles for the plus button */

   
    .toggle-button-container {
    display: flex;
    }

    .toggle-button {
    padding: 8px 16px;
    font-size: 14px;
    cursor: pointer;
    border: 1px solid gray;
    border-radius: 10px; /* Add rounded corners */
    margin-right: 10px; /* Add spacing between buttons */
    }

    .active {
    background-color: black;
    color: white;
    border: 1px solid black;
    }
    .plus-button {
        width: 40px;
        height: 40px;
        background-color: #007bff;
        /* Replace with your desired background color */
        color: #fff;
        /* Replace with your desired text color */
        border: none;
        font-size: 24px;
        font-weight: bold;
        border-radius: 50%;
        /* This makes the button circular */
        cursor: pointer;
        outline: none;
        /* Remove the default focus outline */
    }

    /* On hover, you can add some effects to make it more interactive */
    .plus-button:hover {
        background-color: #0056b3;
        /* Replace with your desired hover background color */
        /* Add other styles for hover effect if needed */
    }

</style>
@endpush

@push('scripts')
<script type="text/javascript" src="{{asset('public/validation/CustomerGroupValidation.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/jQuery.tagify.min.js"></script>
@endpush

@push('custom_scripts')
<script>
    $(document).ready(function() {
        $('#mySelect').select2();

        $('#mySelect').on('change', function (e) {
            if ($(this).val() && $(this).val().includes('selectAll')) {
                $(this).val($(this).find('option').not(':selected').map(function() {
                    return this.value;
                }).get());
                $(this).trigger('change');
            }
        });
    });
</script>



<script>

 function toggleActive(buttonId) {
    var button = document.getElementById(buttonId);
    console.log(button);
    button.classList.toggle('active');

    var finishInput = document.getElementById('finish_side_input');
    var hingeInput = document.getElementById('hinge_side_input');

    if (buttonId === 'finish_side_button') {
        finishInput.value = button.classList.contains('active') ? 'Yes' : 'No';
       
    } else if (buttonId === 'hinge_side_button') {
        hingeInput.value = button.classList.contains('active') ? 'Yes' : 'No';
       
    }
}
    // Function to update the text box content
    $(document).ready(function() {
        const inputValues = {}; // Define inputValues here
        function updateTextBox() {
            const selectBox = $('#selectBox');
         
            const selectedOptions = selectBox.val();

            

            const multiSelect = document.getElementById('selectBox');
            
            const count = multiSelect.selectedOptions.length;
            if (count == 0) {
                $('#selectedValuesContainer').hide();
                console.log("hide");
            } else {
                $('#selectedValuesContainer').show();
                console.log(count);
                console.log("show");
            }

            const selectedValuesContainer = $('#selectedValuesContainer');
            selectedValuesContainer.empty();

            selectedOptions.forEach((option) => {
            const label = selectBox.find(`option[value="${option}"]`).text()+"  Price";
            const inputValue = inputValues[label] || ''; // Retrieve stored value if available
            console.log(label);
             console.log(inputValue);
            const input_div = `
                <div class="col-3">
                    <div class="mb-2">
                    
                        <label class="form-label">${label}</label>
                        <input type="text" name="modification_price[]" class="form-control form-control-sm" placeholder="Price" value="${inputValue}">
                        <span class="text-danger modification_price_error"></span>
                    </div>
                </div>`;

            selectedValuesContainer.append(input_div);
        });


        }
        $('#selectBox').on('change', updateTextBox);
        
        $('#selectedValuesContainer').on('input', 'input[name="modification_price[]"]', function() {
    const optionValue = $(this).closest('.col-3').find('label.form-label').text();
    inputValues[optionValue] = $(this).val();
    console.log(inputValues); // Add this line for debugging
});


    // Initialize Select2
    $('#selectBox').select2();

    // Initial call to populate text boxes
    updateTextBox();
    });
  
</script>

<script>
     $(document).ready(function() {
        const inputValuesD = {}; // Define inputValuesA here
        function updateDoorBox() {
            const DoorStyleSelectBox = $('#door_style_id');
            const selectedDoorystyleOptions = DoorStyleSelectBox.val();

            const multiSelect = document.getElementById('door_style_id');
            const count = multiSelect.selectedOptions.length;
            if (count == 0) {
                $('#selectedDoorValuesContainer').hide();
                console.log("hide");
            } else {
                $('#selectedDoorValuesContainer').show();
                console.log(count);
                console.log("show");
            }

            const selectedDoorValuesContainer = $('#selectedDoorValuesContainer');
            selectedDoorValuesContainer.empty();

            selectedDoorystyleOptions.forEach((option) => {
                // Get the label for the selected accessory option
                const label = DoorStyleSelectBox.find(`option[value="${option}"]`).text()+"  Price";
                const inputValueD = inputValuesD[label] || ''; // Retrieve stored value if available
                console.log(label);
             console.log(inputValueD);
                const input_div = ` <div class="col-3">
                                <div class="mb-2">
                                    <label class="form-label">${label}</label>
                                    <input type="text" name="doorstyle_price[]" class="form-control form-control-sm" placeholder="Price"  value="${inputValueD}">
                                  <span class="text-danger doorstyle_price_error"></span>
                                </div>
					        </div>`


                selectedDoorValuesContainer.append(input_div);
            });
        }

        // Add event listener to the accessory select box to trigger the update when selection changes
        $('#door_style_id').on('change', updateDoorBox);
        $('#selectedDoorValuesContainer').on('input', 'input[name="doorstyle_price[]"]', function() {
            const optionValue = $(this).closest('.col-3').find('label.form-label').text();
            inputValuesD[optionValue] = $(this).val();
            console.log(inputValuesD); // Add this line for debugging
        });
        $('#door_style_id').select2();
        // Call the update function initially to show any pre-selected accessory values
        updateDoorBox();
    });
</script>
<script>
    $(document).ready(function() {
        $('#door_style_id').select2();
    });
</script>


<!-- <script>
    // Wait for the DOM to load
    document.addEventListener('DOMContentLoaded', function() {
        // Get the input element by its class name
        const input = document.querySelector('.tagify-input');

        // Initialize Tagify
        new Tagify(input);
    });
</script> -->

<script>
    $(document).ready(function() {
        // Remove the default "Please Select" option once a user selects an option
        $('#door_style_id').change(function() {
            $(this).find('option:disabled').remove();
        });
    });
</script>

<script>
    $(document).ready(function() {
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('#dimension_card'); //Input field wrapper

        var x = 1;
        var z = 1;
        var y = 2; //Initial field counter is 1
        var count = 1;

        //Once add button is clicked
        $('.add_button').click(function() {
             $('.item_breadth_error').html('');
             $('.item_length_error').html('');
             $('.item_height_error').html('');
             $('.item_weight_error').html('');
            z++;

            if (!validateDimension()) {
                return;
            }

            //  if(variation_name == "")
            //   {
            //     $('.variation_error').html("Please Enter variation Name");
            //     console.log("error");
            //   }else{
            var fieldHTML = `
                        <div class="row dimension ">
                        <div class="col-2">
                                <div class="mb-2">
                                    <label class="form-label">Length</label>
                                    <input type="text" name="item_length[]" class="form-control form-control-sm item_length" placeholder="Product length" onclick="item_lengthClicked(this)" >
                                  <span class="text-danger item_length_error"></span>
                                  <span class="text-danger kt-form__help error item_length"></span>
                                </div>
					        </div>
                            <div class="col-2">
                                <div class="mb-2">
                                    <label class="form-label">Depth</label>
                                    <input type="text" name="item_breadth[]" class="form-control form-control-sm item_breadth" placeholder="Product Depth" onclick="item_breadthClicked(this)" >
                                  <span class="text-danger  item_breadth_error"></span>
                                </div>
					        </div>
                            <div class="col-2">
                                <div class="mb-2">
                                    <label class="form-label">Height</label>
                                    <input type="text" name="item_height[]" class="form-control form-control-sm item_height" placeholder="Product Height" onclick="item_heightClicked(this)" >
                                  <span class="text-danger item_height_error"></span>
                                </div>
					        </div>
                            <div class="col-2">
                                <div class="mb-2">
                                    <label class="form-label">Weight</label>
                                    <input type="text" name="item_weight[]" class="form-control form-control-sm item_weight" placeholder="Product Weight" onclick="item_weightClicked(this)" >
                                  <span class="text-danger  item_weight_error"></span>
                                </div>
					        </div>
                            
                            <div class="col-2">
                                <div class="mb-2">
                                <a href="javascript:void(0);" style="margin-top:25px; margin-left:20px; color:white" class="btn btn-danger btn-circle btn-xl remove_button" class="btn btn-lg btn-block btn-danger lift text-uppercase remove_button" title="Remove field">- </a>
                                </div>
					        </div> 
                            </div>
                                   `;
//class="btn btn-lg btn-block btn-danger lift text-uppercase remove_button"


            count++;

            //Check maximum number of input fields
            if (x < maxField) {
                x++; //Increment field counter
                y++;
                $(wrapper).append(fieldHTML); //Add field html
            }
            // }
        });

        function validateModification_price() {
            var isValid = true;
            const numberRegex = /^-?\d+\.?\d*$/;

            $('#selectedValuesContainer input.form-control.form-control-sm').each(function() {
                let modification_price = $(this);
                let errorSpan = modification_price.siblings('.modification_price_error');
                errorSpan.empty(); // Clear the error message

                if (modification_price.val() == '') {
                    isValid = false;
                    errorSpan.html("Please Enter Price");
                } else if (!numberRegex.test(modification_price.val())) {
                    isValid = false;
                    errorSpan.html("Price must be a number");
                }
            });


            return isValid;
        }

        function validateAccessories_price() {
            var isValid = true;
            const numberRegex = /^-?\d+\.?\d*$/;

            $('#accessoriesValuesContainer input.form-control.form-control-sm').each(function() {
                let accessories_price = $(this);
                let errorSpan = accessories_price.siblings('.accessories_price_error');
                errorSpan.empty(); // Clear the error message

                if (accessories_price.val() == '') {
                    isValid = false;
                    errorSpan.html("Please Enter Price");
                } else if (!numberRegex.test(accessories_price.val())) {
                    isValid = false;
                    errorSpan.html("Price must be a number");
                }
            });

            return isValid;
        }

        var validateDepthInput ;
        //depth_name_inch_error
        $(document).ready(() => {
            
            // Get the input element by its class name
            const input = document.querySelector('.tagify-input');

            // Initialize Tagify
            var tagifyInstance = new Tagify(input);
            let inputField = $('#depth_name_inch');

            validateDepthInput = function() {
                const numberRegex = /^-?\d+\.?\d*$/;
                let isValid = true;

                let errorSpan = inputField.siblings('.depth_name_inch_error');
                errorSpan.empty(); // Clear the error message

                let depthTags = tagifyInstance.value.map(tag => tag.value); // Extract tag values

                if (depthTags.length === 0) {
                    isValid = false;
                    errorSpan.html("Please enter a value");
                } else {
                    for (const value of depthTags) {
                        if (!numberRegex.test(value)) {
                            isValid = false;
                            errorSpan.html("All tags must be numeric values");
                            break;
                        }
                    }
                }
               
                return isValid;
            }

            tagifyInstance.on('add', function(event) {
                validateDepthInput();
            });
        });


        function validateDimension() {
            var isValid = true;
            const numberRegex = /^-?\d+\.?\d*$/;
            $('.dimension').each(function() {
                let item_length = $(this).find('input.item_length');
                let item_breadth = $(this).find('input.item_breadth');
                let item_height = $(this).find('input.item_height');
                let item_weight = $(this).find('input.item_weight');
                let item_price = $(this).find('input.item_price');

                if (item_length.val() == '') {

                    isValid = false;
                    $(item_length).siblings('.item_length_error').html("Please enter Length");
                } else if (!numberRegex.test(item_length.val())) {
                    isValid = false;
                    item_length.siblings('.item_length_error').html("Length must be a number");
                }

                if (item_breadth.val() == '') {
                    isValid = false;
                    $(item_breadth).siblings('.item_breadth_error').html("Please enter Depth");
                } else if (!numberRegex.test(item_length.val())) {
                    isValid = false;
                    item_breadth.siblings('.item_breadth_error').html("Depth must be a number");
                }
                if (item_height.val() == '') {
                    isValid = false;
                    $(item_height).siblings('.item_height_error').html("Please enter Height");
                } else if (!numberRegex.test(item_height.val())) {
                    isValid = false;
                    item_height.siblings('.item_height_error').html("Height must be a number");
                }

                if (item_weight.val() == '') {
                    isValid = false;
                    $(item_weight).siblings('.item_weight_error').html("Please enter Weight");
                } else if (!numberRegex.test(item_weight.val())) {
                    isValid = false;
                    item_weight.siblings('.item_weight_error').html("Weight must be a number");
                }


            });

            return isValid;
        }

        function validateImage() {
            var isValid = true;
            var file_input = $('#file-input');

            if (file_input.val() == '') {
                isValid = false;
                $('#product_image_error').html("Please Select Image ");
            }


            return isValid;
        }

        function validateForm() {
            var DimensionValid = validateDimension();
            // var isImageValid = validateImage();
            var isModification_priceValid = validateModification_price();
            var isAccessories_priceValid = validateAccessories_price();
            var isDepthInputValid = validateDepthInput();

            // Combine the results of both validations
            if ($('#cut_depth').val() == "Yes") {
                var isValid = DimensionValid && isModification_priceValid && isAccessories_priceValid && isDepthInputValid;
            }else{
                var isValid = DimensionValid && isModification_priceValid && isAccessories_priceValid;
            }
             
           //var isValid = isDepthInputValid;
                console.log(isValid);
            return isValid;
        };
           function validateForm() {
        var isValid = true;
        var pro_kitchen_pdf = $('#file-input');
        
        // Optional validation: Check if a file is selected and validate its extension
        if (pro_kitchen_pdf.val() !== '') {
            // var allowedExtensions = ['pdf', 'xls', 'xlsx'];
            var allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            var fileExtension = pro_kitchen_pdf.val().split('.').pop().toLowerCase();
            if (!allowedExtensions.includes(fileExtension)) {
                isValid = false;
                $('#product_image_error').html("Invalid file format. Please upload a image file");
            }
        }

        return isValid;
    }
     
        function product_imageClicked() {
        $('#product_image_error').empty(); // Clear the error message
    }
    
        $('form').on('submit', validateForm);



        item_lengthClicked = function(self) {
            $(self).siblings('.item_length_error').html("");
        }
        $(document).on('focus', '.item_length', function() {
            $(this).siblings('.item_length_error').html("");
        });
        item_breadthClicked = function(self) {
            $(self).siblings('.item_breadth_error').html("");
        }
        $(document).on('focus', '.item_breadth', function() {
            $(this).siblings('.item_breadth_error').html("");
        });
        item_heightClicked = function(self) {
            $(self).siblings('.item_height_error').html("");
        }
        $(document).on('focus', '.item_height', function() {
            $(this).siblings('.item_height_error').html("");
        });
        item_weightClicked = function(self) {
            $(self).siblings('.item_weight_error').html("");
        }
        $(document).on('focus', '.item_weight', function() {
            $(this).siblings('.item_weight_error').html("");
        });
        item_priceClicked = function(self) {
            $(self).siblings('.item_price_error').html("");
        }
      

        $(wrapper).on('click', '.remove_button', function(e) {
            e.preventDefault();
            $(this).parent('div').parent('div').parent('div').remove(); //Remove field html
            y = 1;

            x--; //Decrement field counter
        });
    });
</script>
<script>
    function imageClicked() {
        $('#image_error').empty(); // Clear the error message
    }

    $(document).ready(() => {
        $('#image').change(function() {
            const file = this.files[0];
            console.log(file);
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    console.log(event.target.result);
                    $('#imgPreview').attr('src', event.target.result);
                    $("#imgPreview").css("width", "100").css("height", "100");
                }
                reader.readAsDataURL(file);
            }
        });
        if ($('#finish_side').val() == "Yes") {
            $('#finish_side_div').show();
            console.log(finish_side)
        } else {
            $('#finish_side_div').hide();
        }
        if ($('#hinge_side').val() == "Yes") {
            $('#hinge_side_div').show();
            console.log(hinge_side)
        } else {
            $('#hinge_side_div').hide();
           
        }

        if ($('#cut_depth').val() == "Yes") {
            $('#cut_depth_div').show();
            console.log("cut_depth show ")
        } else {
            $('#cut_depth_div').hide();
            console.log("cut_depth hide")
        }
        $('#finish_side').change(function() {
            let finish_side = $(this).val();

            if (finish_side == "Yes") {
                $('#finish_side_div').show();
                console.log(finish_side)
            } else {
                $('#finish_side_div').hide();
            }
        })

        $('#hinge_side').change(function() {
            let hinge_side = $(this).val();

            if (hinge_side == "Yes") {
                $('#hinge_side_div').show();
                console.log(hinge_side)
            } else {
                $('#hinge_side_div').hide();
            }
        })

        $('#cut_depth').change(function() {
            let cut_depth = $(this).val();

            if (cut_depth == "Yes") {
                $('#cut_depth_div').show();
                console.log(cut_depth)
            } else {
                $('#cut_depth_div').hide();
            }
        })
    });
</script>

<script>
    // Function to update the accessory text box content
    $(document).ready(function() {
        const inputValuesA = {}; // Define inputValuesA here
        function updateAccessoryTextBox() {
            const accessorySelectBox = $('#accessories_id');
            const selectedAccessoryOptions = accessorySelectBox.val();

            const multiSelect = document.getElementById('accessories_id');
            const count = multiSelect.selectedOptions.length;
            if (count == 0) {
                $('#accessoriesValuesContainer').hide();
                console.log("hide");
            } else {
                $('#accessoriesValuesContainer').show();
                console.log(count);
                console.log("show");
            }

            const accessoriesValuesContainer = $('#accessoriesValuesContainer');
            accessoriesValuesContainer.empty();

            selectedAccessoryOptions.forEach((option) => {
                // Get the label for the selected accessory option
                const label = accessorySelectBox.find(`option[value="${option}"]`).text()+"  Price";
                const inputValueA = inputValuesA[label] || ''; // Retrieve stored value if available
                console.log(label);
             console.log(inputValueA);
                const input_div = ` <div class="col-3">
                                <div class="mb-2">
                                    <label class="form-label">${label}</label>
                                    <input type="text" name="accessories_price[]" class="form-control form-control-sm" placeholder="Price"  value="${inputValueA}">
                                  <span class="text-danger accessories_price_error"></span>
                                </div>
					        </div>`


                accessoriesValuesContainer.append(input_div);
            });
        }

        // Add event listener to the accessory select box to trigger the update when selection changes
        $('#accessories_id').on('change', updateAccessoryTextBox);
        $('#accessoriesValuesContainer').on('input', 'input[name="accessories_price[]"]', function() {
            const optionValue = $(this).closest('.col-3').find('label.form-label').text();
            inputValuesA[optionValue] = $(this).val();
            console.log(inputValuesA); // Add this line for debugging
        });
        $('#accessories_id').select2();
        // Call the update function initially to show any pre-selected accessory values
        updateAccessoryTextBox();
    });
    // Initialize Select2 for the accessory select box
    // $(document).ready(function() {
    //     $('#accessories_id').select2();
    // });
</script>



@endpush

@push('modals')
@endpush
@extends(backendView('layouts.app'))

@section('content')
<div class="container-xxl">
    <div class="row align-items-center">
        <div class="border-0 mb-4">
            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                <h3 class="fw-bold mb-0"> Add Modification</h3>
                 <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/addmodification/index')}}">Modification</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Modification</li>
                        </ol>
                    </nav>
            </div>
        </div>
    </div> <!-- Row end  -->
    <div class="row clearfix g-3">
        
        <div class="col-lg-12">
            <div class="card mb-3">
                <!-- <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                    <h6 class="m-0 fw-bold">Customer Group Information</h6>
                </div> -->
                <div class="card-body">
                    <form action="{{ route('addmodification.store') }}" method="POST" id="customergroupForm">
                        @csrf
                        <div class="row g-3 align-items-center">
                            <div class="col-md-6">
                                    <label class="form-label">Enter Modification Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="modification_name" placeholder="Please enter Name" >
                                    <span class="text-danger kt-form__help error modification_name"></span>
                            </div>
                            <div class="col-md-6">
                                    <label class="form-label">Do you need any additional information for this modification? <span class="text-danger">*</span></label>
                                    <select class="form-control category" id="modification_information" name="modification_information">
                                        <option value="">Please Select</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                    <span class="text-danger kt-form__help error modification_information"></span>
                            </div>
                            <div class="col-md-6" >
                                    <label class="form-label" > Enter Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control" rows="3" name="modification_desc" placeholder="Please enter Description" style="resize: none;"></textarea>
                                    <span class="text-danger kt-form__help error modification_desc"></span>
                            </div>
                            <div class="col-md-6" id="info_type_div" >
                                    <label class="form-label">What type of value do you want to get from the customer? <span class="text-danger">*</span></label>
                                    <div class="row col-11">
                                    <div class="col-3"> <input type="radio"  value="integer_value" name="option" > Intger value</div>
                                    <div class="col-3"><input type="radio"  value="message"  name="option" > Message</div>
                                    <div class="col-3">   <input type="radio"  value="both" name="option" > Both </div>
                                    </div>
                                    <span class="text-danger kt-form__help error option"></span>
                            </div>
                                <div class="col-md-6 integer_div" id="integer_div">
                                <label class="form-label">Enter integer label </label>
                                    <div class="mb-2">
                                        <input type="text" class="form-control"  name="integer_label" id="integer_label" >
                                        <span class="text-danger kt-form__help error right_finish_side_price"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 integer_div_1" id="integer_div_1"> 
                                    <div class="mb-2">
                                        <label class="form-label">Enter Integer value </label>
                                        <input class="form-control form-control-sm tagify-input" id="integer_inch" name="integer_inch[]" >
                                        <span class="text-danger kt-form__help error integer_inch"></span>
                                        <span class="text-danger integer_inch_error"></span>
                                    </div>
                                </div>
                        
                                
                            
                            <div class="col-md-6" id="message_div">
                                <label class="form-label" >Enter message label </label>
                                <div class="mb-2">
                                    <input type="text" class="form-control"  name="message"   id="message">
                                    <span class="text-danger kt-form__help error right_finish_side_price"></span>
                                </div>
                            </div>
                     
                            <!-- <div class="row" id="message_div" style=" margin-top:30px;display: none;">
                                <div class="row col-6">
                                  <label class="form-label">Enter message label </label>
                                        <div class="mb-2">
                                            <input type="text" class="form-control"  name="message" >
                                            <span class="text-danger kt-form__help error right_finish_side_price"></span>
                                        </div>
                                </div>
                            </div>
                            <div class="row" id="integer_div" style="display: none;">
                                <div class="row col-6">
                                  <label class="form-label">Enter integer label </label>
                                        <div class="mb-2">
                                            <input type="text" class="form-control"  name="integer_label" >
                                            <span class="text-danger kt-form__help error right_finish_side_price"></span>
                                        </div>
                                </div>
                                <div class="row col-11">
                                        <div class="mb-2">
                                            <label class="form-label">Enter Integer value </label>
                                            <input class="form-control form-control-sm tagify-input" id="integer_inch" name="integer_inch[]" >
                                            <span class="text-danger kt-form__help error integer_inch"></span>
                                            <span class="text-danger integer_inch_error"></span>
                                        </div>
                                </div>
                            </div> -->
</div>
                        <button type="submit" class="btn btn-warning mt-4 text-uppercase px-5">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- Row End -->
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{asset('public/validation/CustomerGroupValidation.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/jQuery.tagify.min.js"></script>
@endpush

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
@endpush

@push('custom_scripts')
<script>
    $(document).ready(() => {
    let selectedOptionYes = ''; // Store selected radio button value for "Yes"
    let visibleFieldsYes = {}; // Store visibility states of fields for "Yes"

    let selectedOptionNo = ''; // Store selected radio button value for "No"
    let visibleFieldsNo = {}; // Store visibility states of fields for "No"

    // Hide fields initially
    $('#info_type_div').hide();
    $('#message_div').hide();
    $('#integer_div').hide();
    $('#integer_div_1').hide();

    $('#modification_information').change(function() {
        let modification_info = $(this).val();
        console.log(modification_info);
        if (modification_info === "Yes") {
            $('#info_type_div').show();

            if (selectedOptionYes === "integer_value") {
                $('#integer_div').show();
                $('#integer_div_1').show();
            } else if (selectedOptionYes === "message") {
                $('#message_div').show();
            } else if (selectedOptionYes === "both") {
                $('#message_div').show();
                $('#integer_div').show();
                $('#integer_div_1').show();
            }
        } else {
            $('#info_type_div').hide();
            $('#message_div').hide();
            $('#integer_div').hide();
            $('#integer_div_1').hide();

            if (selectedOptionNo === "integer_value") {
                $('#integer_div').show();
                $('#integer_div_1').show();
            } else if (selectedOptionNo === "message") {
                $('#message_div').show();
            } else if (selectedOptionNo === "both") {
                $('#message_div').show();
                $('#integer_div').show();
                $('#integer_div_1').show();
            }
        }
    });

    $('input[name="option"]').change(function() {
        if ($('#modification_information').val() === "Yes") {
            selectedOptionYes = $(this).val();
            visibleFieldsYes = {
                messageDiv: $('#message_div').is(':visible'),
                integerDiv: $('#integer_div').is(':visible'),
                integerDiv1: $('#integer_div_1').is(':visible')
            };

            if (selectedOptionYes === "integer_value") {
                $('#message_div').hide();
                $('#integer_div').show();
                $('#integer_div_1').show();
            } else if (selectedOptionYes === "message") {
                $('#message_div').show();
                $('#integer_div').hide();
                $('#integer_div_1').hide();
            } else {
                $('#message_div').show();
                $('#integer_div').show();
                $('#integer_div_1').show();
            }
        } else {
            selectedOptionNo = $(this).val();
            visibleFieldsNo = {
                messageDiv: $('#message_div').is(':visible'),
                integerDiv: $('#integer_div').is(':visible'),
                integerDiv1: $('#integer_div_1').is(':visible')
            };

            if (selectedOptionNo === "integer_value") {
                $('#message_div').hide();
                $('#integer_div').show();
                $('#integer_div_1').show();
            } else if (selectedOptionNo === "message") {
                $('#message_div').show();
                $('#integer_div').hide();
                $('#integer_div_1').hide();
            } else {
                $('#message_div').show();
                $('#integer_div').show();
                $('#integer_div_1').show();
            }
        }
    });
});

</script>

  <script>
    var validateDepthInput ;
        //depth_name_inch_error
        $(document).ready(() => {
            
            // Get the input element by its class name
            const input = document.querySelector('.tagify-input');

            // Initialize Tagify
            var tagifyInstance = new Tagify(input);
            let inputField = $('#integer_inch');

            validateDepthInput = function() {
                const numberRegex = /^-?\d+\.?\d*$/;
                let isValid = true;

                let errorSpan = inputField.siblings('.integer_inch_error');
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
    </script>
@endpush

@extends(backendView('layouts.app'))
@section('content')
<div class="container-xxl">
   <div class="row align-items-center">
      <div class="border-0 mb-4">
         <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
            <h3 class="fw-bold mb-0"> Edit Modification</h3>
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{url('admin/addmodification/index')}}">Modification</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit Modification</li>
               </ol>
            </nav>
         </div>
      </div>
   </div>
   <!-- Row end  -->
   <div class="row clearfix g-3">
      <div class="col-lg-12">
         <div class="card mb-3">
            <div class="card-body">
               <form action="{{ url('admin/addmodification-update')}}\{{ $addmodification->modification_id}}" method="POST" id="customergroupForm">
                  @method('PATCH')
                  @csrf
                  <div class="row g-3 align-items-center">
                     <div class="col-md-6">
                        <label class="form-label">Enter Name of Modification <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="modification_name" value="{{$addmodification->modification_nm}}" placeholder="Please enter name">
                        <span class="text-danger kt-form__help error modification_name"></span>
                     </div>
                     <div class="col-md-6">
                        <label class="form-label">Do you need any additional information for this modification? <span class="text-danger">*</span></label>
                        <input type="text"  id="modification_info_input" value="{{$addmodification->modification_info}}" hidden>
                        <div class="mb-2">
                           <select class="form-control category" id="modification_information" name="modification_information">
                              <option value="">Please Select</option>
                              @if($addmodification->modification_info == "Yes")
                              <option value="Yes" selected>Yes</option>
                              <option value="No">No</option>
                              @else
                              <option value="Yes">Yes</option>
                              <option value="No" selected>No</option>
                              @endif
                           </select>
                           <span class="text-danger kt-form__help error modification_information"></span>
                        </div>
                     </div>
                     <div class="col-md-6" >
                        <label class="form-label" > Description <span class="text-danger">*</span></label>
                        <textarea class="form-control" rows="3" name="modification_desc" placeholder="Please enter  description" style="resize: none;">{{$addmodification->modification_desc}}</textarea>
                        <span class="text-danger kt-form__help error modification_desc"></span>
                     </div>
                     <input type="text"  id="info_type_input" value="{{$addmodification->info_type}}" hidden >
                     <div class="col-md-6" id="info_type_div" style="display: none;">
                        <label class="form-label">What type of value do you want to get from the customer?</label>
                        <div class="row col-11">
                           <div class="col-3"> <input type="radio"  value="integer_value" name="option" {{ $selectedOption === 'integer_value' ? 'checked' : '' }}> Intger value</div>
                           <div class="col-3"><input type="radio"  value="message"  name="option" {{ $selectedOption === 'message' ? 'checked' : '' }}> Message</div>
                           <div class="col-3">   <input type="radio"  value="both" name="option" {{ $selectedOption === 'both' ? 'checked' : '' }}> Both </div>
                        </div>
                        <span class="text-danger kt-form__help error right_finish_side_price"></span>
                     </div>
                     <div class="col-md-6 integer_div"style="display: none;" id="integer_div">
                        <label class="form-label">Enter integer label </label>
                        <div class="mb-2">
                           <input type="text" class="form-control"  name="integer_label" value="{{$addmodification->integer_lable}}" >
                           <span class="text-danger kt-form__help error integer_label"></span>
                        </div>
                     </div>
                     <div class="col-md-6 integer_div" style="display: none;" id="integer_div_1">
                        <div class="mb-2">
                           <label class="form-label">Enter Integer value </label>
                           @php
                           $Values = $modification_value->implode(',');
                           @endphp
                           <input class="form-control form-control-sm tagify-input" value="{{$Values}}"  id="integer_inch" name="integer_inch[]" >
                           <span class="text-danger kt-form__help error integer_inch"></span>
                           <span class="text-danger integer_inch_error"></span>
                        </div>
                     </div>
                     <div class="col-md-6" id="message_div"style="display: none;" id="message_div">
                        <label class="form-label" >Enter message label </label>
                        <div class="mb-2">
                           <input type="text" class="form-control"  name="message" value="{{$addmodification->message_label}}" >
                           <span class="text-danger kt-form__help error message"></span>
                        </div>
                     </div>
                  </div>
            </div>
         </div>
         <button type="submit" class="btn btn-warning mt-4 text-uppercase px-5">Submit</button>
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
@push('scripts')
<script type="text/javascript" src="{{asset('public/validation/CustomerGroupValidation.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/jQuery.tagify.min.js"></script>
@endpush
@push('custom_scripts')

<script type="text/javascript">
$(document).ready(function() {
    var initialModificationInfo = "{{ $addmodification->modification_info }}";
    var radiotypevalue = "{{ $addmodification->info_type }}";
    var previousRadioValue = "{{ $addmodification->info_type }}";

    function handleInitialDisplay() {
        if (initialModificationInfo === "Yes") {
            $('#info_type_div').show();
        }

        if (radiotypevalue === "integer_value") {
            $('#info_type_div').show();
            $('#integer_div').show();
            $('#integer_div_1').show();
        } else if (radiotypevalue === "message") {
            $('#info_type_div').show();
            $('#message_div').show();
        } else if (radiotypevalue === "both") {
            $('#info_type_div').show();
            $('#integer_div').show();
            $('#integer_div_1').show();
            $('#message_div').show();
        }
    }
    handleInitialDisplay();

    $('#modification_information').change(function() {
        var selectedOption = $(this).val();
        // Clear radio button selection on dropdown change
        $('input[type="radio"][name="option"]').prop('checked', false);

        if (selectedOption === 'Yes') {
            $('#info_type_div').show();
            // Restore previous radio button selection
            $('input[type="radio"][name="option"][value="' + previousRadioValue + '"]').prop('checked', true);
            showCorrespondingFields(previousRadioValue);
        } else if (selectedOption === 'No') {
            $('#info_type_div').hide();
            $('#integer_div').hide();
            $('#integer_div_1').hide();
            $('#message_div').hide();
        }
    });

    $('input[type="radio"][name="option"]').change(function() {
        var selectedOption = $(this).val();
        previousRadioValue = selectedOption;
        hideAllFields();
        showCorrespondingFields(selectedOption);
    });

    function hideAllFields() {
        $('#info_type_div').hide();
        $('#integer_div').hide();
        $('#integer_div_1').hide();
        $('#message_div').hide();
    }

    function showCorrespondingFields(value) {
        if (value === 'integer_value') {
            $('#info_type_div').show();
            $('#integer_div').show();
            $('#integer_div_1').show();
        } else if (value === 'message') {
            $('#info_type_div').show();
            $('#message_div').show();
        } else if (value === 'both') {
            $('#info_type_div').show();
            $('#integer_div').show();
            $('#integer_div_1').show();
            $('#message_div').show();
        }
    }
});

</script>
@if($addmodification->modification_info == "Yes")
    <script>
        $(document).ready(function() {
            $('#info_type_div').show();
        });
    </script>
@elseif($addmodification->info_type == "integer_value")
    <script>
        $(document).ready(function() {
            $('#info_type_div').show();
            $('#integer_div').show();
        });
    </script>
@elseif($addmodification->info_type == "message")
    <script>
        $(document).ready(function() {
            $('#info_type_div').show();
            $('#message_div').show();
        });
    </script>
@elseif($addmodification->info_type == "both")
    <script>
        $(document).ready(function() {
            $('#info_type_div').show();
            $('#integer_div').show();
            $('#message_div').show();
        });
    </script>
@endif
<!-- <script>
   $(document).ready(() => {
       let modification_info = $('#modification_information').val();
       if (modification_info == "Yes") {
           $('#info_type_div').show();
       }
   
       $('#modification_information').change(function () {
           let modification_info = $(this).val();
           if (modification_info == "Yes") {
               $('#info_type_div').show();
           } else {
               $('#info_type_div').hide();
               $('#message_div').hide();
               $('.integer_div').hide();
               $('#integer_inch').val('');
               $('#integer_label').val('');
               $('#message').val('');
           }
       });
   $(document).ready(() => {
   var modification_info_input= $('#modification_info_input').val();
   if(modification_info_input == "Yes"){
   $('#info_type_div').show();
   console.log("yes");
   }else{
   $('#info_type_div').hide();
   console.log("no");
   }
   var info_type_input= $('#info_type_input').val();
   if(info_type_input == ""){
       $('#message_div').hide();
         $('.integer_div').hide();
   }else if(info_type_input == "integer_value" ){
       $('#message_div').hide();
         $('.integer_div').show();
   
   }else if(info_type_input == "message"){
       $('#message_div').show();
      $('.integer_div').hide();
   }else{
       $('#message_div').show();
       $('.integer_div').show();
   }
   })
   $(document).ready(() => {
   var info_type_input= $('#info_type_input').val();
   $('#modification_info').change(function() {
       let modification_info = $(this).val();
       console.log(modification_info);
       if (modification_info == "Yes") {
           $('#info_type_div').show();
           
           if(info_type_input == ""){
                   $('#message_div').hide();
                   $('.integer_div').hide();
               }else if(info_type_input == "integer_value" ){
                   $('#message_div').hide();
                   $('.integer_div').show();
   
               }else if(info_type_input == "message"){
                   $('#message_div').show();
               $('.integer_div').hide();
               }else{
                   $('#message_div').show();
                   $('.integer_div').show();
               }
            }
        else 
       {
           $('#info_type_div').hide();
           $('#message_div').hide();
           $('.integer_div').hide();
       
       }
   });
   $('input[name="option"]').change(function() {
   var selectedValue = $(this).val();
   if(selectedValue == "integer_value"){
       $('#message_div').hide();
         $('.integer_div').show();
   
   }else if(selectedValue == "message"){
       $('#message_div').show();
      $('.integer_div').hide();
   }else{
       $('#message_div').show();
       $('.integer_div').show();
   }
   $('#content' + selectedValue.charAt(selectedValue.length - 1)).show();
   });
   
   });
</script>
<script>
   document.addEventListener("DOMContentLoaded", function () {
       var selectedOption = "{{ $selectedOption }}";
   var integer_radio = document.getElementById("integer_radio");
   var message_radio = document.getElementById("message_radio");
   var both_radio = document.getElementById("both_radio");
   
   var hiddenDiv1 = document.getElementById("message_div");
   var hiddenDiv2 = document.getElementById("integer_div");
   
   if (selectedOption === "both") {
       both_radio.checked = true;
       hiddenDiv1.style.display = "block";
       //console.log(hiddenDiv1);
       hiddenDiv2.style.display = "block";
   } 
   
   else if (selectedOption === "message") {
       message_radio.checked = true;
       hiddenDiv2.style.display = "none";
       hiddenDiv1.style.display = "block";
   }
   else{
       hiddenDiv1.style.display = "none";
       hiddenDiv2.style.display = "block";
   }
   
   both_radio.addEventListener("change", function () {
       console.log("done");
       hiddenDiv1.style.display = "block";
       hiddenDiv2.style.display = "block";
   });
   
   message_radio.addEventListener("change", function () {
       hiddenDiv2.style.display = "none";
       hiddenDiv1.style.display = "block";
   });
   });
   
</script> -->
<script>
   var validateDepthInput ;
       $(document).ready(() => {
           const input = document.querySelector('.tagify-input');
   
           var tagifyInstance = new Tagify(input);
           let inputField = $('#integer_inch');
   
           validateDepthInput = function() {
               const numberRegex = /^-?\d+\.?\d*$/;
               let isValid = true;
   
               let errorSpan = inputField.siblings('.integer_inch_error');
               errorSpan.empty();
   
               let depthTags = tagifyInstance.value.map(tag => tag.value); 
   
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
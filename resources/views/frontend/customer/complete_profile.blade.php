
<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Deluxewood Cabinetry Signup</title>
     <link rel="icon" href="{{asset('public/img/logo.png')}}" type="image/x-icon">
    
    

    <!-- project css file  -->
    <link rel="stylesheet" href="https://designmykitchen.cloud/public/backend/ebazar.style.min.css">
    <link rel="stylesheet" href="https://designmykitchen.cloud/public/backend/custom.css">
    <style type="text/css">
        .sgmn_cls 
    {
        display: flex;
        list-style: none;
        padding: 0;
    }
    .sgmn_cls li 
    {
/*        margin-right: 20px;*/
    }
    </style>
</head>

<body style="background-color: #FBFAF6;">
    <div id="ebazar-layout" class="theme-blue">
      
        <!-- main body area -->
        <div class="main p-2 py-3 p-xl-5 ">
              <div class="col-lg-12 row">
            <div class="col-lg-10"></div>
            <div class="col-lg-2">
                <ul class="sgmn_cls">
            <li>
                <a class="nav-link collapsed font-weight-bold" href="{{url('contact-us')}}" title="Get Help" style="color: #101010;">
                    Contact
                </a>
            </li>
            <li>
                <a class="nav-link collapsed font-weight-bold" href="{{url('about')}}" title="Get Help" style="color: #101010;">
                    About Us
                </a>
            </li>
        </ul>
            </div>

        </div>
            <!-- Body: Body -->
            <div class="body d-flex p-0 p-xl-5">
              @if(Auth::check() && Auth::user()->role_id == 1) 
               <a href="{{url('admin/home')}}" class="mb-0 brand-icon" style="text-align: center; padding-bottom: 25px;">
               <span class="logo-icon">
               <img src="{{asset('public/logo.png')}}" height="60" style="width:auto">
               </span>
               </a>
               @elseif(Auth::check() && Auth::user()->role_id == 2) 
               <a href="{{url('dashboard')}}" class="mb-0 brand-icon" style="text-align: center; padding-bottom: 25px;">
               <span class="logo-icon">
               <img src="{{asset('public/logo.png')}}" height="60" style="width:auto">
               </span>
               </a>
               @else
               <a href="{{url('/')}}" class="mb-0 brand-icon" style="text-align: center; padding-bottom: 25px;">
               <span class="logo-icon">
               <img src="{{asset('public/logo.png')}}" height="60" style="width:auto">
               </span>
               </a>
               @endif  
<div class="container-xxl">

    <div class="row g-0">
    

        <div class="col-lg-12 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h200">
            <div class="w-100 p-3 p-md-5 card" style="max-width: 50rem; border-radius: 25px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px!important;">
                <!-- Form -->
                <form class="row " action="{{url('complete-profile/store/')}}/{{$id}}" enctype="multipart/form-data"  method="POST" id="CustomerForm">
                @csrf
              

                    <div class="col-12 text-center mb-5">
                        <h1> Complete your profile </h1>
                        <!-- <span>Free access to our dashboard.</span> -->
                    </div>
                    <h5  style="margin:0 0 14px 0;"><u>Basic Information</u><span class="text-danger"> *</span></h5>
                    <div class="col-6">
                        <div class="mb-2">
                            <label class="form-label">Name of Company</label>
                            <input type="text" name="company_name"class="form-control form-control-sm" placeholder="Enter name of company">
                            <span class="text-danger kt-form__help error company_name"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-2">
                            <label class="form-label">Address</label>
                            <input type="text" name="address"class="form-control form-control-sm" placeholder="Enter address">
                            <span class="text-danger kt-form__help error address"></span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-2">
                            <label class="form-label">Representative Name</label>
                            <input type="text" name="representative_name"class="form-control form-control-sm" placeholder="Enter representative name">
                            <span class="text-danger kt-form__help error representative_name"></span>
                        </div>
                    </div>
                    <!-- <div class="col-6">
                        <div class="mb-2">
                            <label class="form-label">Showroom</label>
                            <input type="text" name="showroom" class="form-control form-control-sm" placeholder="Enter showroom">
                            <span class="text-danger kt-form__help error showroom"></span>
                        </div>
                    </div> -->
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Contact Number</label>
                        <input type="tel" maxlength="10" name="contact_number"class="form-control form-control-sm" placeholder="Enter contact number">
                        <span class="text-danger kt-form__help error contact_number"></span>
                    </div>
                </div>
                <!-- <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Domestic Lines Carried</label>
                        <input type="text" name="domenstic_lines"class="form-control form-control-sm" placeholder="Enter domestic lines carried">
                        <span class="text-danger kt-form__help error domenstic_lines"></span>
                    </div>
                </div> -->
               <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Email</label>
                        <input type="text" name="email" class="form-control form-control-sm" placeholder="name@example.com">
                        <span class="text-danger kt-form__help error email"></span>
                    </div>
                </div>
                <!-- <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Import Lines</label>
                        <input type="text" name="import_lines" class="form-control form-control-sm" placeholder="Enter import lines">
                        <span class="text-danger kt-form__help error import_lines"></span>
                    </div>
                </div> -->
                 <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Fax</label>
                        <input type="tel" name="fax" class="form-control form-control-sm" placeholder="Enter fax">
                        <span class="text-danger kt-form__help error fax"></span>
                    </div>
                </div>
                <!-- <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Date Business Started</label>
                        <input type="date" max="{{ now()->format('Y-m-d') }}" name="date_business_started" class="form-control form-control-sm" placeholder="Enter date business started">
                        <span class="text-danger kt-form__help error date_business_started"></span>
                    </div>
                </div> -->
                <!-- <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Showroom SQ FT</label>
                        <input type="text" name="showroom_sq"class="form-control form-control-sm" placeholder="Enter showroom SQ FT">
                        <span class="text-danger kt-form__help error showroom_sq"></span>
                    </div>
                </div> -->
              <!-- <div class="col-6">
                <div class="mb-2">
                    <label class="form-label">Annual Cabinet Sales</label>
                    <input type="tel" name="annual_cabinet_sales" class="form-control form-control-sm" placeholder="Enter annual cabinet sales">
                    <span class="text-danger kt-form__help error annual_cabinet_sales"></span>
                </div>
            </div> -->
              
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">City</label>
                        <input type="text" name="city" class="form-control form-control-sm" placeholder="Enter city">
                        <span class="text-danger kt-form__help error city"></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">State</label>
                        <select class="form-control category"  name="state"   >
                            <option value="">Please Select</option>
                            @foreach($state as $index => $stateName )
                            <option value="{{$stateName}}">{{$stateName}}</option>
                           @endforeach
                        </select>
                        <!-- <input type="text" name="state" class="form-control form-control-sm" placeholder="Enter State"> -->
                        <span class="text-danger kt-form__help error state"></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Company Logo</label>
                        <label class="custom-file">
                            <input type="File" class="form-control" id="company_logo" name="company_logo" onCLick="compantLogoClicked()" ><br>
                          

                            <span class="text-danger" id="company_logo_error"></span>
                        
                        </label>
                    </div>
                    <img id="imgPreview" class="userimage" />
                </div>
                <h5  style="margin:20px 0 14px 0;"><u>Owner Information</u> <span class="text-danger">*</span></h5>
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Owner Name</label>
                        <input type="text" name="owner_name" class="form-control form-control-sm" placeholder="Enter owner name">
                        <span class="text-danger kt-form__help error owner_name"></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Owner's Address</label>
                        <input type="text" name="owner_address" class="form-control form-control-sm" placeholder="Enter owner's address">
                        <span class="text-danger kt-form__help error owner_address"></span>
                    </div>
                </div>
               <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Phone</label>
                        <input type="text" name="owner_phone" class="form-control form-control-sm" placeholder="Enter phone" maxlength="10">
                        <span class="text-danger kt-form__help error owner_phone"></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">City</label>
                        <input type="text" name="owner_city"class="form-control form-control-sm" placeholder="Enter city">
                        <span class="text-danger kt-form__help error owner_city"></span>
                    </div>
                </div><div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">State</label>
                        <select class="form-control category"  name="owner_state" >
                            <option value="">Please Select</option>
                           @foreach($state as $index => $stateName )
                            <option value="{{$stateName}}">{{$stateName}}</option>
                           @endforeach
                        </select>
                        <!-- <input type="text" name="owner_state" class="form-control form-control-sm" placeholder="Enter State"> -->
                        <span class="text-danger kt-form__help error owner_state"></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Zip</label>
                        <input type="text" name="owner_zip" class="form-control form-control-sm" placeholder="Enter zip">
                        <span class="text-danger kt-form__help error owner_zip"></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Email</label>
                        <input type="text" name="owner_email" class="form-control form-control-sm" placeholder="Enter email">
                        <span class="text-danger kt-form__help error owner_email"></span>
                    </div>
                </div>
                <h5  style="margin:20px 0 14px 0;"><u>Reference </u></h5>

                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Name of Company</label>
                        <input type="text" name="reference_com_name" class="form-control form-control-sm" placeholder="Enter name of company">
                        <span class="text-danger kt-form__help error product_name"></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Address</label>
                        <input type="text" name="reference_address" class="form-control form-control-sm" placeholder="Enter address">
                        <span class="text-danger kt-form__help error product_name"></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Contact Number</label>
                        <input type="text" name="reference_contact_number" class="form-control form-control-sm" placeholder="Enter contact number">
                        <span class="text-danger kt-form__help error reference_contact_number"></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">City</label>
                        <input type="text" name="reference_city" class="form-control form-control-sm" placeholder="Enter city">
                        <span class="text-danger kt-form__help error product_name"></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">State</label>
                        <select class="form-control category"  name="reference_state" >
                            <option value="">Please Select</option>
                           @foreach($state as $index => $stateName )
                            <option value="{{$stateName}}">{{$stateName}}</option>
                           @endforeach
                        </select>
                        <!-- <input type="text" name="reference_state"class="form-control form-control-sm" placeholder="Enter State"> -->
                        <span class="text-danger kt-form__help error product_name"></span>
                    </div>
                </div>
                <div class="col-6">
                        <div class="mb-2">
                            <label class="form-label"> Zip </label>
                            <input type="text" name="reference_zip"class="form-control form-control-sm" placeholder="Enter zip">
                            <span class="text-danger kt-form__help error product_name"></span>
                        </div>
                    </div>
                    <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Email</label>
                        <input type="email" name="reference_email"class="form-control form-control-sm" placeholder="name@example.com">
                        <span class="text-danger kt-form__help error product_name"></span>
                    </div>
                </div>
                <div class="col-6">
                        <div class="mb-2">
                            <label class="form-label"> Type of Account </label>
                            <input type="text" name="account_type" class="form-control form-control-sm" placeholder="Enter account type">
                            <span class="text-danger kt-form__help error product_name"></span>
                        </div>
                </div>
                <h5 style="margin:20px 0 14px 0;"><u>Tax Exempt</u> <span class="text-danger">*</span></h5>
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Are you Tax Exempt</label>
                        <select class="form-control category"  id="tex_exempt" name="tex_exempt"   >
                          
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                        <span class="text-danger kt-form__help error tex_exempt"></span>
                    </div>
                </div>
                <div class="col-6" id="texId_div">
                    <div class="mb-2">
                        <label class="form-label">Tax ID</label>
                        <input type="text" name="tex_id" class="form-control form-control-sm" placeholder="Enter tax id">
                        <span class="text-danger kt-form__help error tex_id"></span>
                    </div>
                </div>
                <div class="col-12" id="texForm_div">
                    <div class="mb-2">
                        <label class="form-label">Tax Exempt Form</label><br>
                        <label  class="form-label">
                        <input type="File" class="form-control" id="tex_form"  name="tex_exempt_form" onCLick="texFormClicked()" ><br>
                        
                            <span class="text-danger" id="tex_form_error"></span>
                        </label>
                    </div>
                 
                </div>
               
                    <!-- <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="confirmation" value="" id="confirmation" data-validation="required">
                            <label class="form-check-label" for="flexCheckDefault">
                                I accept the <a href="{{url('terms-condition')}}" target="_blank" title="Terms and Conditions" class="text-secondary">Terms and Conditions</a>
                            </label><br>
                            <span class="text-danger" id="confirmation_error"></span>
                        </div>
                    </div>  -->
                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-lg btn-block btn-light lift text-uppercase" alt="SIGNUP">SIGN UP</button>
                    </div>
                    <div class="col-12 text-center mt-4">
                        <span>Already have an account? <a href="{{url('/')}}" title="Sign in" class="text-secondary">Sign in here</a></span>
                    </div>
                </form>
                <!-- End Form -->

            </div>
        </div>
    </div> <!-- End Row -->

</div>
            </div>

        </div>

    </div>



 

 
    <script src="https://designmykitchen.cloud/public/backend/dist/assets/bundles/libscripts.bundle.js"></script>
<script type="text/javascript" src="{{asset('public/validation/CustomerFormValidation.js')}}"></script> 
 
<script>
    $(document).ready(()=>{
    if( $('#tex_exempt').val() == "Yes"){
            $('#texId_div').show();
            $('#texForm_div').show();
    }else{
        $('#texId_div').hide();
        $('#texForm_div').hide();
    }
    $('#tex_exempt').change(function(){
        let tex_exempt = $(this).val();
        if(tex_exempt == "Yes"){
            $('#texId_div').show();
            $('#texForm_div').show();
        }else{
            $('#texId_div').hide();
            $('#texForm_div').hide();
        }
    })

});
$(document).ready(function() {
  $('form').on('submit', function(event) {
    var isValid = true;
    // $('[data-validation="required"]').each(function() {
    //   if (!$(this).prop('checked')) {
    //     isValid = false;
    //     $('#confirmation_error').html("Please check the 'I Accept' checkbox to proceed");
    //   }
    // });

    // if ($('#confirmation').prop('checked')) {
    //   $('#confirmation_error').empty();
    // }

    // if (!isValid) {
    //   event.preventDefault();
    // }
  });
});
 function validateForm() {
    var isValid = true;
       var company_logo = $('#company_logo');
       var tex_form = $('#tex_form');
       var tex_exempt = $('#tex_exempt');
      // var confirmation = $('#confirmation');
          
           if(tex_exempt.val() === "Yes"){
                console.log(tex_exempt);
            if(tex_form.val()==''){
                    isValid = false;
                    alert("Please Select Tax Exempt Form");
                    $('#tex_form_error').html("Please Select Tax Exempt Form");
             }
            }else{
                $('#tex_form_error').empty();
            }
        //    if (!$('#confirmation').prop('checked')) {
        //         isValid = false;
        //         $('#confirmation_error').html("Please check the 'I Accept' checkbox to proceed");
        //         console.log("hjsf");
              
        //    }
           return isValid;
           
      
    }
    function validateForm() {
        var isValid = true;
        var pro_kitchen_pdf = $('#tex_form');
        
        if (pro_kitchen_pdf.val() !== '') {
            var allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png', 'gif'];
            var fileExtension = pro_kitchen_pdf.val().split('.').pop().toLowerCase();
            if (!allowedExtensions.includes(fileExtension)) {
                isValid = false;
                $('#tex_form_error').html("Invalid file format. Please upload a PDF or an image file");
            }
        }

        return isValid;
    }
    function validateForm() {
    var isValid = true;
       var company_logo = $('#company_logo');
       var tex_form = $('#tex_form');
       var tex_exempt = $('#tex_exempt');
        //     if(company_logo.val()==''){
        //         isValid = false;
        //         $('#company_logo_error').html("Please Select Company Logo");
        //    }
           if(tex_exempt.val() === "Yes"){
                console.log(tex_exempt);
                if(tex_form.val()==''){
                        isValid = false;
                        $('#tex_form_error').html("Please Select Tax Exempt Form");
                        console.log("hjsf");
                       
                    
                }
            }else{
                    $('#tex_form_error').empty();
                    
                    // var allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png', 'gif'];
                    //         var fileExtension = tex_form.val().split('.').pop().toLowerCase();
                    //         if (!allowedExtensions.includes(fileExtension)) {
                    //             isValid = false;
                    //             $('#tex_form_error').html("Invalid file format. Please upload a PDF or an image file");
                    //         }
            }
           return isValid;
           
      
    }
       function validateForm1() {
        var isValid = true;
        var company_logo = $('#company_logo');
        
        if (company_logo.val() !== '') {
            var allowedExtensions = ['jpg', 'jpeg', 'png'];
            var fileExtension = company_logo.val().split('.').pop().toLowerCase();
            if (!allowedExtensions.includes(fileExtension)) {
                isValid = false;
                $('#company_logo_error').html("Invalid file format. Please upload a image file");
            }
        }

        return isValid;
    }


    function texFormClicked() {
        $('#tex_form_error').empty(); // Clear the error message
    }
     $('form').on('submit', validateForm);
      function compantLogoClicked() 
    {
    $('#company_logo_error').empty(); // Clear the error message
    }
    $('form').on('submit', validateForm1);
  
    function texFormClicked() {
        $('#tex_form_error').empty(); // Clear the error message
    }
     function compantLogoClicked() 
    {
    $('#company_logo_error').empty(); // Clear the error message
    }
    // function confirmationClicked() {
    //     $('#confirmation_error').empty(); // Clear the error message
    // }
  
  

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);
            $("#blah").css("width", "100").css("height", "100");
        }

        reader.readAsDataURL(input.files[0]);
    }
}
$("#tex_form").change(function(){
    readURL(this);
});

$(document).ready(()=>{
      $('#company_logo').change(function(){
        const file = this.files[0];
        console.log(file);
        if (file){
          let reader = new FileReader();
          reader.onload = function(event){
            console.log(event.target.result);
            $('#imgPreview').attr('src', event.target.result);
            $("#imgPreview").css("width", "100").css("height", "100");
          }
          reader.readAsDataURL(file);
        }
      });
    });

    </script>
 <script>
    $(document).ready(function () {
        $('input[name="contact_number"]').on('input', function () {
            // Remove non-digit characters and limit to 10 characters
            var cleanedInput = $(this).val().replace(/\D/g, '').slice(0, 10);
            $(this).val(cleanedInput);
        });
         $('input[name="fax"]').on('input', function () {
            // Remove non-digit characters
            var cleanedInput = $(this).val().replace(/\D/g, '');
            $(this).val(cleanedInput);
        });
          $('input[name="owner_phone"]').on('input', function () {
            // Remove non-digit characters and limit to 10 characters
            var cleanedInput = $(this).val().replace(/\D/g, '').slice(0, 10);
            $(this).val(cleanedInput);
        });
        $('input[name="annual_cabinet_sales"]').on('input', function () {
            var inputValue = $(this).val();
            var isValid = /^(\$)?(\d{1,3}(,\d{3})*|(\d+))(\.\d{2})?$/.test(inputValue);
            
            if (!isValid) {
                // Remove characters that are not numbers or "$"
                $(this).val(inputValue.replace(/[^0-9$]/g, ''));
            }
        });
         $('input[name="tex_id"]').on('input', function () {
            // Remove non-digit characters
            var cleanedInput = $(this).val().replace(/\D/g, '');
            $(this).val(cleanedInput);
        });
    });
</script>
</body>

</html>
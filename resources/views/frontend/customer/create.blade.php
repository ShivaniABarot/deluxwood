<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Deluxewood Cabinetry Signup</title>
    <link rel="icon" href="{{asset('public/img/logo.png')}}" type="image/x-icon">
    
    <!-- Project CSS files -->
    <link rel="stylesheet" href="https://deluxewoodexpress.com/public/backend/ebazar.style.min.css">
    <link rel="stylesheet" href="https://deluxewoodexpress.com/public/backend/custom.css">
    <style type="text/css">
        .sgmn_cls {
            display: flex;
            list-style: none;
            padding: 0;
        }
        .sgmn_cls li {
            /* margin-right: 20px; */
        }
        
        /* Loading overlay styles */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        
        .loading-content {
            background: white;
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            max-width: 300px;
        }
        
        .loading-spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #007bff;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .loading-text {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        
        .loading-subtext {
            font-size: 14px;
            color: #666;
        }
        
        /* Button loading state */
        .btn-loading {
            position: relative;
            pointer-events: none;
        }
        
        .btn-loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 2px solid #ffffff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 1s linear infinite;
        }
    </style>
</head>
<body style="background-color: #FBFAF6;">
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-content">
            <div class="loading-spinner"></div>
            <div class="loading-text">Creating Your Account</div>
            <div class="loading-subtext">Please wait while we process your information...</div>
        </div>
    </div>

    <div id="ebazar-layout" class="theme-blue">
        <!-- Main body area -->
        <div class="main p-2 py-3 p-xl-5">
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
                            <img src="{{asset('logo.png')}}" height="60" style="width:auto">
                        </span>
                    </a>
                @elseif(Auth::check() && Auth::user()->role_id == 2)
                    <a href="{{url('dashboard')}}" class="mb-0 brand-icon" style="text-align: center; padding-bottom: 25px;">
                        <span class="logo-icon">
                            <img src="{{ asset('logo.png') }}" height="60" style="width:auto">
                        </span>
                    </a>
                @else
                    <a href="{{url('/')}}" class="mb-0 brand-icon" style="text-align: center; padding-bottom: 25px;">
                        <span class="logo-icon">
                            <img src="{{ asset('logo.png') }}" height="60" style="width: auto;" alt="Logo">
                        </span>
                    </a>
                @endif
                <div class="container-xxl">
                    <div class="row g-0">
                        <div class="col-lg-12 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h200">
                            <div class="w-100 p-3 p-md-5 card" style="max-width: 50rem; border-radius: 25px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px!important;">
                                <!-- Form -->
                                <form class="row" action="{{url('customer/store')}}" enctype="multipart/form-data" method="POST" id="CustomerForm">
                                    @csrf
                                    <div class="col-12 text-center mb-5">
                                        <h1>Create your account</h1>
                                    </div>
                                    <h5 style="margin:0 0 14px 0;"><u>Basic Information</u><span class="text-danger"> *</span></h5>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Name of Company</label>
                                            <input type="text" name="company_name" class="form-control form-control-sm" placeholder="Enter name of company">
                                            <span class="text-danger kt-form__help error company_name"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Company Logo</label>
                                            <label class="custom-file">
                                                <input type="file" class="form-control" id="company_logo" name="company_logo" onclick="compantLogoClicked()">
                                                <span class="text-danger" id="company_logo_error"></span>
                                            </label>
                                        </div>
                                        <img id="imgPreview" class="userimage" />
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Address</label>
                                            <input type="text" name="address" class="form-control form-control-sm" placeholder="Enter address">
                                            <span class="text-danger kt-form__help error address"></span>
                                        </div>
                                    </div>
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
                                            <select class="form-control category" name="state">
                                                <option value="">Please Select</option>
                                                @foreach($state as $index => $stateName)
                                                    <option value="{{$stateName}}">{{$stateName}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger kt-form__help error state"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Representative Name</label>
                                            <input type="text" name="representative_name" class="form-control form-control-sm" placeholder="Enter representative name">
                                            <span class="text-danger kt-form__help error representative_name"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Contact Number</label>
                                            <input type="tel" maxlength="10" name="contact_number" class="form-control form-control-sm" placeholder="Enter contact number">
                                            <span class="text-danger kt-form__help error contact_number"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Email</label>
                                            <input type="text" name="email" class="form-control form-control-sm" placeholder="name@example.com">
                                            <span class="text-danger kt-form__help error email"></span>
                                        </div>
                                    </div>
                                   
                                    
                                    
                                    <h5 style="margin:20px 0 14px 0;"><u>Owner Information</u> <span class="text-danger">*</span></h5>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Owner Name</label>
                                            <input type="text" name="owner_name" class="form-control form-control-sm" placeholder="Enter owner name">
                                            <span class="text-danger kt-form__help error owner_name"></span>
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
                                            <label class="form-label">Email</label>
                                            <input type="text" name="owner_email" class="form-control form-control-sm" placeholder="Enter email">
                                            <span class="text-danger kt-form__help error owner_email"></span>
                                        </div>
                                    </div>
                                    <h5 style="margin:20px 0 14px 0;"><u>Reference</u></h5>
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
                                            <select class="form-control category" name="reference_state">
                                                <option value="">Please Select</option>
                                                @foreach($state as $index => $stateName)
                                                    <option value="{{$stateName}}">{{$stateName}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger kt-form__help error product_name"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Zip</label>
                                            <input type="text" name="reference_zip" class="form-control form-control-sm" placeholder="Enter zip">
                                            <span class="text-danger kt-form__help error product_name"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="reference_email" class="form-control form-control-sm" placeholder="name@example.com">
                                            <span class="text-danger kt-form__help error product_name"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Type of Account</label>
                                            <input type="text" name="account_type" class="form-control form-control-sm" placeholder="Enter account type">
                                            <span class="text-danger kt-form__help error product_name"></span>
                                        </div>
                                    </div>
                                    <h5 style="margin:20px 0 14px 0;"><u>Tax Exempt</u> <span class="text-danger">*</span></h5>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Are you Tax Exempt</label>
                                            <select class="form-control category" id="tex_exempt" name="tex_exempt">
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
                                        <div class="row">
                                            <div class="col-6 mb-2">
                                                <label class="form-label">Tax Exempt Form</label><br>
                                                <label class="form-label">
                                                    <input type="file" class="form-control" id="tex_form" name="tex_exempt_form" onclick="texFormClicked()">
                                                    <br>
                                                    <span class="text-danger" id="tex_form_error"></span>
                                                </label>
                                            </div>
                                            <div class="col-6 mb-2">
                                                <label class="form-label">Sales Certificate</label><br>
                                                <label class="form-label">
                                                    <input type="file" class="form-control" id="sales_form" name="sales_form" onclick="salesFormClicked()">
                                                    <br>
                                                    <span class="text-danger" id="sales_form_error"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-2">
                                                <label class="form-label">Password</label>
                                                <input type="password" name="password" class="form-control form-control-sm" placeholder="8+ characters required">
                                                <span class="text-danger kt-form__help error password"></span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-2">
                                                <label class="form-label">Confirm Password</label>
                                                <input type="password" name="confirm_password" class="form-control form-control-sm" placeholder="8+ characters required">
                                                <span class="text-danger kt-form__help error confirm_password"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="confirmation" value="" id="confirmation" data-validation="required">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                I Accept the <a href="{{url('terms-condition')}}" target="_blank" title="Terms and Conditions" class="text-secondary">Terms and Conditions</a>
                                            </label><br>
                                            <span class="text-danger" id="confirmation_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center mt-4">
                                        <button type="submit" class="btn btn-lg btn-block btn-light lift text-uppercase" id="submitButton">
                                            <span id="buttonText">SIGN UP</span>
                                        </button>
                                    </div>
                                    <div class="col-12 text-center mt-4">
                                        <span>Already have an account? <a href="{{url('/')}}" title="Sign in" class="text-secondary">Sign in here</a></span>
                                    </div>
                                </form>
                                <!-- End Form -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://deluxewoodexpress.com/public/backend/dist/assets/bundles/libscripts.bundle.js"></script>
    <script type="text/javascript" src="{{ asset('validation/CustomerFormValidation.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Show/hide tax exempt fields based on selection
            if ($('#tex_exempt').val() === "Yes") {
                $('#texId_div').show();
                $('#texForm_div').show();
            } else {
                $('#texId_div').hide();
                $('#texForm_div').hide();
            }
            $('#tex_exempt').change(function() {
                let tex_exempt = $(this).val();
                if (tex_exempt === "Yes") {
                    $('#texId_div').show();
                    $('#texForm_div').show();
                } else {
                    $('#texId_div').hide();
                    $('#texForm_div').hide();
                }
            });

            // Clear error messages on input change
            $('input, select').on('input change', function() {
                $(this).siblings('.text-danger').empty();
            });

            // Function to show loading
            function showLoading() {
                $('#loadingOverlay').css('display', 'flex');
                $('#submitButton').addClass('btn-loading').prop('disabled', true);
                $('#buttonText').text('Processing...');
            }

            // Function to hide loading
            function hideLoading() {
                $('#loadingOverlay').css('display', 'none');
                $('#submitButton').removeClass('btn-loading').prop('disabled', false);
                $('#buttonText').text('SIGN UP');
            }

            // Form submission handling
            $('#CustomerForm').on('submit', function(event) {
                var isValid = true;

                // Validate confirmation checkbox
                if (!$('#confirmation').prop('checked')) {
                    isValid = false;
                    $('#confirmation_error').html("Please check the 'I Accept' checkbox to proceed");
                } else {
                    $('#confirmation_error').empty();
                }

                // Validate company logo
                var company_logo = $('#company_logo');
                if (company_logo.val() !== '') {
                    var allowedExtensions = ['jpg', 'jpeg', 'png'];
                    var fileExtension = company_logo.val().split('.').pop().toLowerCase();
                    if (!allowedExtensions.includes(fileExtension)) {
                        isValid = false;
                        $('#company_logo_error').html("Invalid file format. Please upload a JPG or PNG file");
                    }
                }

                // Validate tax exempt form and sales certificate when tex_exempt is Yes
                if ($('#tex_exempt').val() === "Yes") {
                    var tex_form = $('#tex_form');
                    if (tex_form.val() === '') {
                        isValid = false;
                        $('#tex_form_error').html("Please select a Tax Exempt Form");
                    } else {
                        var allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png'];
                        var fileExtension = tex_form.val().split('.').pop().toLowerCase();
                        if (!allowedExtensions.includes(fileExtension)) {
                            isValid = false;
                            $('#tex_form_error').html("Invalid file format. Please upload a PDF or image file");
                        }
                    }

                    var sales_form = $('#sales_form');
                    if (sales_form.val() === '') {
                        isValid = false;
                        $('#sales_form_error').html("Please select a Sales Certificate");
                    } else {
                        var allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png'];
                        var fileExtension = sales_form.val().split('.').pop().toLowerCase();
                        if (!allowedExtensions.includes(fileExtension)) {
                            isValid = false;
                            $('#sales_form_error').html("Invalid file format. Please upload a PDF or image file");
                        }
                    }
                } else {
                    $('#tex_form_error').empty();
                    $('#sales_form_error').empty();
                }

                if (!isValid) {
                    event.preventDefault();
                    return false;
                }

                // Show loading if validation passes
                showLoading();
                
                // If there's an error during submission, you can hide the loading
                // This would typically be handled in your server response or AJAX error callback
                // For now, we'll let the form submit normally
            });

            // Handle form submission errors (if using AJAX)
            // You can add this if you want to handle errors and hide loading
            $(document).ajaxError(function() {
                hideLoading();
            });

            // Clear specific error messages on file input change
            $('#company_logo').on('change', function() {
                $('#company_logo_error').empty();
                const file = this.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function(event) {
                        $('#imgPreview').attr('src', event.target.result);
                        $("#imgPreview").css("width", "100").css("height", "100");
                    };
                    reader.readAsDataURL(file);
                }
            });

            $('#tex_form').on('change', function() {
                $('#tex_form_error').empty();
            });

            $('#sales_form').on('change', function() {
                $('#sales_form_error').empty();
            });

            $('#confirmation').on('change', function() {
                $('#confirmation_error').empty();
            });

            // Input validation for phone numbers and tax ID
            $('input[name="contact_number"], input[name="owner_phone"]').on('input', function() {
                var cleanedInput = $(this).val().replace(/\D/g, '').slice(0, 10);
                $(this).val(cleanedInput);
            });

            $('input[name="tex_id"]').on('input', function() {
                var cleanedInput = $(this).val().replace(/\D/g, '');
                $(this).val(cleanedInput);
            });
        });
    </script>
</body>
</html>
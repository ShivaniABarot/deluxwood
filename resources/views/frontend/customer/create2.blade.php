<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Deluxewood Cabinetry Signup</title>
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
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
    </style>
</head>

<body style="background-color: #FBFAF6;">
    <div id="ebazar-layout" class="theme-blue">
        <div class="main p-2 py-3 p-xl-5 ">
            <div class="col-lg-12 row">
                <div class="col-lg-10"></div>
                <div class="col-lg-2">
                    <ul class="sgmn_cls">
                        <li>
                            <a class="nav-link collapsed font-weight-bold" href="{{url('contact-us')}}" title="Get Help"
                                style="color: #101010;">Contact</a>
                        </li>
                        <li>
                            <a class="nav-link collapsed font-weight-bold" href="{{url('about')}}" title="Get Help"
                                style="color: #101010;">About Us</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="body d-flex p-0 p-xl-5">
                @if(Auth::check() && Auth::user()->role_id == 1)
                    <a href="{{url('admin/home')}}" class="mb-0 brand-icon"
                        style="text-align: center; padding-bottom: 25px;">
                        <span class="logo-icon">
                            <img src="{{ asset('logo.png') }}" height="60" width="auto" alt="Logo">
                        </span>
                    </a>
                @elseif(Auth::check() && Auth::user()->role_id == 2)
                    <a href="{{url('dashboard')}}" class="mb-0 brand-icon"
                        style="text-align: center; padding-bottom: 25px;">
                        <span class="logo-icon">
                            <img src="{{ asset('logo.png') }}" height="60" width="auto" alt="Logo">
                        </span>
                    </a>
                @else
                    <a href="{{url('/')}}" class="mb-0 brand-icon" style="text-align: center; padding-bottom: 25px;">
                        <span class="logo-icon">
                            <img src="{{ asset('logo.png') }}" height="60" width="auto" alt="Logo">
                        </span>
                    </a>
                @endif
                <div class="container-xxl">
                    <div class="row g-0">
                        <div
                            class="col-lg-12 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h200">
                            <div class="w-100 p-3 p-md-5 card"
                                style="max-width: 50rem; border-radius: 25px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px!important;">
                                <form class="row" action="{{url('customer/store')}}" enctype="multipart/form-data"
                                    method="POST" id="CustomerForm">
                                    @csrf
                                    <div class="col-12 text-center mb-5">
                                        <h1>Create your account</h1>
                                    </div>
                                    <h5 style="margin:0 0 14px 0;"><u>Dealer Information</u><span class="text-danger">
                                            *</span></h5>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Name of Company <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="company_name" class="form-control form-control-sm"
                                                placeholder="Enter name of company" required>
                                            <span class="text-danger kt-form__help error company_name"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">DBA</label>
                                            <input type="text" name="dba" class="form-control form-control-sm"
                                                placeholder="Enter DBA">
                                            <span class="text-danger kt-form__help error dba"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Business Type <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control form-control-sm" name="business_type" required>
                                                <option value="">Select Business Type</option>
                                                <option value="Kitchen/Bath Design Company">Kitchen/Bath Design Company
                                                </option>
                                                <option value="Contractor">Contractor</option>
                                            </select>
                                            <span class="text-danger kt-form__help error business_type"></span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-2">
                                            <label class="form-label">Business Address <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="business_address"
                                                class="form-control form-control-sm" placeholder="Enter address"
                                                required>
                                            <span class="text-danger kt-form__help error business_address"></span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-2">
                                            <label class="form-label">City <span class="text-danger">*</span></label>
                                            <input type="text" name="business_city" class="form-control form-control-sm"
                                                placeholder="Enter city" required>
                                            <span class="text-danger kt-form__help error business_city"></span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-2">
                                            <label class="form-label">State <span class="text-danger">*</span></label>
                                            <select class="form-control form-control-sm" name="business_state" required>
                                                <option value="">Please Select</option>
                                                @foreach($state as $index => $stateName)
                                                    <option value="{{$stateName}}">{{$stateName}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger kt-form__help error business_state"></span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-2">
                                            <label class="form-label">Zip Code <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="business_zip" class="form-control form-control-sm"
                                                placeholder="Enter zip code" required>
                                            <span class="text-danger kt-form__help error business_zip"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Showroom? <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control form-control-sm" name="has_showroom"
                                                id="has_showroom" required>
                                                <option value="">Select Option</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            <span class="text-danger kt-form__help error has_showroom"></span>
                                        </div>
                                    </div>
                                    <div class="col-6" id="showroom_sqft" style="display:none;">
                                        <div class="mb-2">
                                            <label class="form-label">Showroom SQ FT</label>
                                            <input type="text" name="showroom_sqft" class="form-control form-control-sm"
                                                placeholder="Enter square footage">
                                            <span class="text-danger kt-form__help error showroom_sqft"></span>
                                        </div>
                                    </div>
                                    <div class="col-12" id="showroom_location" style="display:none;">
                                        <div class="mb-2">
                                            <label class="form-label">Showroom Location</label>
                                            <input type="text" name="showroom_location"
                                                class="form-control form-control-sm"
                                                placeholder="Enter showroom location">
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" name="same_as_business"
                                                    id="same_as_business">
                                                <label class="form-check-label" for="same_as_business">Same as Business
                                                    Address</label>
                                            </div>
                                            <span class="text-danger kt-form__help error showroom_location"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Main Contact Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="main_contact_name"
                                                class="form-control form-control-sm"
                                                placeholder="Enter main contact name" required>
                                            <span class="text-danger kt-form__help error main_contact_name"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Main Contact Phone <span
                                                    class="text-danger">*</span></label>
                                            <input type="tel" maxlength="10" name="main_contact_phone"
                                                class="form-control form-control-sm" placeholder="Enter phone number"
                                                required>
                                            <span class="text-danger kt-form__help error main_contact_phone"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Main Contact Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" name="main_contact_email"
                                                class="form-control form-control-sm" placeholder="name@example.com"
                                                required>
                                            <span class="text-danger kt-form__help error main_contact_email"></span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-2">
                                            <label class="form-label">Billing Address (if different from Business
                                                Address)</label>
                                            <input type="text" name="billing_address"
                                                class="form-control form-control-sm"
                                                placeholder="Enter billing address">
                                            <span class="text-danger kt-form__help error billing_address"></span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-2">
                                            <label class="form-label">Billing Contact Name</label>
                                            <input type="text" name="billing_contact_name"
                                                class="form-control form-control-sm" placeholder="Enter name">
                                            <span class="text-danger kt-form__help error billing_contact_name"></span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-2">
                                            <label class="form-label">Billing Contact Number</label>
                                            <input type="tel" maxlength="10" name="billing_contact_number"
                                                class="form-control form-control-sm" placeholder="Enter phone number">
                                            <span class="text-danger kt-form__help error billing_contact_number"></span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="mb-2">
                                            <label class="form-label">Billing Contact Email</label>
                                            <input type="email" name="billing_contact_email"
                                                class="form-control form-control-sm" placeholder="name@example.com">
                                            <span class="text-danger kt-form__help error billing_contact_email"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Company Logo</label>
                                            <input type="file" class="form-control form-control-sm" id="company_logo"
                                                name="company_logo" accept=".jpg,.jpeg,.png">
                                            <span class="text-danger" id="company_logo_error"></span>
                                        </div>
                                        <img id="imgPreview" class="userimage" style="display:none;" />
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Domestic Lines Carried</label>
                                            <textarea name="domestic_lines" class="form-control form-control-sm"
                                                placeholder="Enter domestic lines carried"></textarea>
                                            <span class="text-danger kt-form__help error domestic_lines"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Imported Lines Carried</label>
                                            <textarea name="imported_lines" class="form-control form-control-sm"
                                                placeholder="Enter imported lines carried"></textarea>
                                            <span class="text-danger kt-form__help error imported_lines"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Date Business Started</label>
                                            <input type="date" max="{{ now()->format('Y-m-d') }}"
                                                name="date_business_started" class="form-control form-control-sm">
                                            <span class="text-danger kt-form__help error date_business_started"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Annual Cabinets Sales</label>
                                            <input type="text" name="annual_cabinet_sales"
                                                class="form-control form-control-sm" placeholder="Enter annual sales">
                                            <span class="text-danger kt-form__help error annual_cabinet_sales"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Projected Annual Deluxe Wood Cabinetry
                                                Sales</label>
                                            <input type="text" name="projected_sales"
                                                class="form-control form-control-sm"
                                                placeholder="Enter projected sales">
                                            <span class="text-danger kt-form__help error projected_sales"></span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">How Did You Hear About Us? <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control form-control-sm" name="hear_about_us"
                                                id="hear_about_us" required>
                                                <option value="">Select Option</option>
                                                <option value="Website">Website</option>
                                                <option value="Google">Google</option>
                                                <option value="Word of Mouth">Word of Mouth</option>
                                                <option value="Referral">Referral</option>
                                                <option value="Sales Rep">Sales Rep</option>
                                                <option value="Other">Other</option>
                                            </select>
                                            <span class="text-danger kt-form__help error hear_about_us"></span>
                                        </div>
                                    </div>
                                    <div class="col-6" id="hear_about_note" style="display:none;">
                                        <div class="mb-2">
                                            <label class="form-label">Note</label>
                                            <input type="text" name="hear_about_note"
                                                class="form-control form-control-sm" placeholder="Enter note">
                                            <span class="text-danger kt-form__help error hear_about_note"></span>
                                        </div>
                                    </div>
                                    <h5 style="margin:20px 0 14px 0;"><u>Tax Exemption</u> <span
                                            class="text-danger">*</span></h5>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Are you Tax Exempt? <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-control form-control-sm" name="tax_exempt"
                                                id="tax_exempt" required>
                                                <option value="No">No</option>
                                                <option value="Yes">Yes</option>
                                            </select>
                                            <span class="text-danger kt-form__help error tax_exempt"></span>
                                        </div>
                                    </div>
                                    <div class="col-6" id="tax_exempt_form" style="display:none;">
                                        <div class="mb-2">
                                            <label class="form-label">Tax Exemption Form</label>
                                            <input type="file" class="form-control form-control-sm"
                                                id="tax_exempt_form_file" name="tax_exempt_form"
                                                accept=".pdf,.jpg,.jpeg,.png">
                                            <span class="text-danger" id="tax_exempt_form_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-2">
                                            <label class="form-label">Notes</label>
                                            <textarea name="notes" class="form-control form-control-sm"
                                                placeholder="Enter any additional notes"></textarea>
                                            <span class="text-danger kt-form__help error notes"></span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-2">
                                                <label class="form-label">Password</label>
                                                <input type="password" name="password"
                                                    class="form-control form-control-sm"
                                                    placeholder="8+ characters required">
                                                <span class="text-danger kt-form__help error password"></span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-2">
                                                <label class="form-label">Confirm Password</label>
                                                <input type="password" name="confirm_password"
                                                    class="form-control form-control-sm"
                                                    placeholder="8+ characters required">
                                                <span class="text-danger kt-form__help error confirm_password"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="confirmation" value=""
                                                id="confirmation" data-validation="required">
                                            <label class="form-check-label" for="confirmation">
                                                I Accept the <a href="{{url('terms-condition')}}" target="_blank"
                                                    title="Terms and Conditions" class="text-secondary">Terms and
                                                    Conditions</a>
                                            </label><br>
                                            <span class="text-danger" id="confirmation_error"></span>
                                        </div>
                                    </div>



                                    <div class="col-12 text-center mt-4">
                                        <button type="submit" class="btn btn-lg btn-block btn-light lift text-uppercase"
                                            alt="SIGNUP">SIGN UP</button>
                                    </div>
                                    <div class="col-12 text-center mt-4">
                                        <span>Already have an account? <a href="{{url('/')}}" title="Sign in"
                                                class="text-secondary">Sign in here</a></span>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://deluxewoodexpress.com/public/backend/dist/assets/bundles/libscripts.bundle.js"></script>
    <script type="text/javascript" src="{{asset('public/validation/CustomerFormValidation.js')}}"></script>
    <script>
        $(document).ready(() => {
            // Showroom conditional fields
            $('#has_showroom').change(function () {
                if ($(this).val() === "Yes") {
                    $('#showroom_sqft').show();
                    $('#showroom_location').show();
                } else {
                    $('#showroom_sqft').hide();
                    $('#showroom_location').hide();
                }
            });

            // Same as Business Address checkbox
            $('#same_as_business').change(function () {
                if ($(this).is(':checked')) {
                    $('input[name="showroom_location"]').val($('input[name="business_address"]').val());
                }
            });

            // Tax exempt conditional field
            if ($('#tax_exempt').val() === "Yes") {
                $('#tax_exempt_form').show();
            } else {
                $('#tax_exempt_form').hide();
            }
            $('#tax_exempt').change(function () {
                if ($(this).val() === "Yes") {
                    $('#tax_exempt_form').show();
                } else {
                    $('#tax_exempt_form').hide();
                }
            });

            // Hear about us conditional note field
            $('#hear_about_us').change(function () {
                if ($(this).val() === "Referral" || $(this).val() === "Sales Rep" || $(this).val() === "Other") {
                    $('#hear_about_note').show();
                } else {
                    $('#hear_about_note').hide();
                }
            });

            // Company logo preview
            $('#company_logo').change(function () {
                const file = this.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function (event) {
                        $('#imgPreview').attr('src', event.target.result).show();
                        $("#imgPreview").css("width", "100").css("height", "100");
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Form validation on submit
            $('form').on('submit', function (event) {
                var isValid = true;
                $('[data-validation="required"]').each(function () {
                    if (!$(this).prop('checked')) {
                        isValid = false;
                        $('#confirmation_error').html("Please check the 'I Accept' checkbox to proceed");
                    }
                });
                if ($('#confirmation').prop('checked')) {
                    $('#confirmation_error').empty();
                }
                if ($('#tax_exempt').val() === "Yes" && !$('#tax_exempt_form_file').val()) {
                    isValid = false;
                    $('#tax_exempt_form_error').html("Please upload a tax exemption form");
                }
                if (!isValid) {
                    event.preventDefault();
                }
            });

            // Input restrictions
            $('input[name="main_contact_phone"], input[name="billing_contact_number"]').on('input', function () {
                var cleanedInput = $(this).val().replace(/\D/g, '').slice(0, 10);
                $(this).val(cleanedInput);
            });
            $('input[name="annual_cabinet_sales"], input[name="projected_sales"]').on('input', function () {
                var inputValue = $(this).val();
                var isValid = /^(\$)?(\d{1,3}(,\d{3})*|(\d+))(\.\d{2})?$/.test(inputValue);
                if (!isValid) {
                    $(this).val(inputValue.replace(/[^0-9$]/g, ''));
                }
            });
        });

        function texFormClicked() {
            $('#tax_exempt_form_error').empty();
        }

        function compantLogoClicked() {
            $('#company_logo_error').empty();
        }
    </script>
</body>

</html>
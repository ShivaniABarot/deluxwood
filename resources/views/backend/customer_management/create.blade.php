@extends(backendView('layouts.app'))

@section('title', 'Customers')

@section('content')

    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">

                <div
                    class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">

                    <h3 class="fw-bold mb-0">Add Customer </h3>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/customers')}}">Customers</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Customer</li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div> <!-- Row end  -->
        <div class="row clearfix g-3">


            <div class="col-lg-12 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h200">
                <div class="w-100 p-3 p-md-5 card border-0 shadow-sm" style="max-width: 100rem;">
                    <!-- Form -->
                    <form class="row g-1 p-3 p-md-4" action="{{url('admin/customer/store')}}" enctype="multipart/form-data"
                        method="POST" id="CustomerForm">

                        @csrf

                        <h5 style="margin:0 0 18px 0;"><b>Basic Information </b> <span class="text-danger">*</span></h5>
                        <div class="col-6">
                            <div class="mb-2">
                                <label class="form-label">Name of Company</label>
                                <input type="text" name="company_name" class="form-control form-control-sm"
                                    placeholder="Enter Name of Company">
                                <span class="text-danger kt-form__help error company_name"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <label class="form-label">Representative Name</label>
                                <input type="text" name="representative_name" class="form-control form-control-sm"
                                    placeholder="Enter Representative Name">
                                <span class="text-danger kt-form__help error representative_name"></span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-2">
                                <label class="form-label">Contact number</label>
                                <input type="text" name="contact_number" class="form-control form-control-sm"
                                    placeholder="Enter Contact number">
                                <span class="text-danger kt-form__help error contact_number"></span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-2">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control form-control-sm"
                                    placeholder="name@example.com">
                                <span class="text-danger kt-form__help error email"></span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-2">
                                <label class="form-label">Fax</label>
                                <input type="text" name="fax" class="form-control form-control-sm" placeholder="Enter Fax">
                                <span class="text-danger kt-form__help error fax"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" class="form-control form-control-sm"
                                    placeholder="Enter Address">
                                <span class="text-danger kt-form__help error address"></span>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mb-2">
                                <label class="form-label">City</label>
                                <input type="text" name="city" class="form-control form-control-sm"
                                    placeholder="Enter City">
                                <span class="text-danger kt-form__help error city"></span>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="mb-2">
                                <label class="form-label">State</label>
                                <select class="form-control category" name="state">
                                    <option value="">Please Select</option>
                                    @foreach($state as $index => $stateName)
                                        <option value="{{$stateName}}">{{$stateName}}</option>
                                    @endforeach
                                </select>
                                <!-- <input type="text" name="state" class="form-control form-control-sm" placeholder="Enter State"> -->
                                <span class="text-danger kt-form__help error state"></span>
                            </div>
                        </div>

                        <!-- <div class="col-6">
                            <div class="mb-2">
                                <label class="form-label">Showroom</label>
                                <input type="text" name="showroom"  class="form-control form-control-sm" placeholder="Enter Showroom">
                                <span class="text-danger kt-form__help error showroom"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <label class="form-label">Showroom SQ FT</label>
                                <input type="text" name="showroom_sq"   class="form-control form-control-sm" placeholder="Enter Showroom SQ FT">
                                <span class="text-danger kt-form__help error showroom_sq"></span>
                            </div>
                        </div>
                    <div class="col-6">
                        <div class="mb-2">
                            <label class="form-label">Domestic lines carried</label>
                            <input type="text" name="domenstic_lines"  class="form-control form-control-sm" placeholder="Enter Domenstic lines carried">
                            <span class="text-danger kt-form__help error domenstic_lines"></span>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-2">
                            <label class="form-label">Import lines</label>
                            <input type="text" name="import_lines"  class="form-control form-control-sm" placeholder="Enter Import lines">
                            <span class="text-danger kt-form__help error import_lines"></span>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-2">
                            <label class="form-label">Date Business Started</label>
                            <input type="date" name="date_business_started"  class="form-control form-control-sm" placeholder="Enter Date Business Started">
                            <span class="text-danger kt-form__help error date_business_started"></span>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-2">
                            <label class="form-label">Annual Cabinet Sales</label>
                            <input type="text" name="annual_cabinet_sales"  class="form-control form-control-sm" placeholder="Enter Annual Cabinet Sales">
                            <span class="text-danger kt-form__help error annual_cabinet_sales"></span>
                        </div>
                    </div> -->

                        <div class="col-6">
                            <div class="mb-2">
                                <label class="form-label">Company Logo</label>

                                <!-- <input type="file" class="custom-file-input" id="company_logo" name="company_logo" onCLick="compantLogoClicked()"><br> -->
                                <input type="File" class="form-control" id="company_logo" name="company_logo"
                                    onCLick="compantLogoClicked()">
                                <!-- @if ($errors->has('company_logo'))
                                    <div class="text-danger">{{ $errors->first('company_logo') }}</div>
                                @endif

                                <span class="text-danger" id="company_logo_error"></span> -->


                            </div>
                            <img id="imgPreview" class="userimage" />
                        </div>
                        <h5 style="margin:20px 0 18px 0;"><b>Owner Information</b> <span class="text-danger">*</span></h5>
                        <div class="col-6">
                            <div class="mb-2">
                                <label class="form-label">Owner Name</label>
                                <input type="text" name="owner_name" class="form-control form-control-sm"
                                    placeholder="Enter Owner Name">
                                <span class="text-danger kt-form__help error owner_name"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <label class="form-label">Owner's Address</label>
                                <input type="text" name="owner_address" class="form-control form-control-sm"
                                    placeholder="Enter Owner's Address">
                                <span class="text-danger kt-form__help error owner_address"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <label class="form-label">Phone</label>
                                <input type="text" name="owner_phone" class="form-control form-control-sm"
                                    placeholder="Enter Phone">
                                <span class="text-danger kt-form__help error owner_phone"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <label class="form-label">City</label>
                                <input type="text" name="owner_city" class="form-control form-control-sm"
                                    placeholder="Enter City">
                                <span class="text-danger kt-form__help error owner_city"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <label class="form-label">State</label>
                                <select class="form-control category" name="owner_state">
                                    <option value="">Please Select</option>
                                    @foreach($state as $index => $stateName)
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
                                <input type="text" name="owner_zip" class="form-control form-control-sm"
                                    placeholder="Enter Zip">
                                <span class="text-danger kt-form__help error owner_zip"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <label class="form-label">Email</label>
                                <input type="email" name="owner_email" class="form-control form-control-sm"
                                    placeholder="Enter Email">
                                <span class="text-danger kt-form__help error owner_email"></span>
                            </div>
                        </div>
                        <h5 style="margin:20px 0 18px 0;"><b>Reference </b></h5>

                        <div class="col-6">
                            <div class="mb-2">
                                <label class="form-label">Name of company</label>
                                <input type="text" name="reference_com_name" class="form-control form-control-sm"
                                    placeholder="Enter Name of company">
                                <span class="text-danger kt-form__help error product_name"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <label class="form-label">Address</label>
                                <input type="text" name="reference_address" class="form-control form-control-sm"
                                    placeholder="Enter Address">
                                <span class="text-danger kt-form__help error product_name"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <label class="form-label">Contact Number</label>
                                <input type="text" name="reference_contact_number" class="form-control form-control-sm"
                                    placeholder="Enter Contact Number">
                                <span class="text-danger kt-form__help error reference_contact_number"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <label class="form-label">City</label>
                                <input type="text" name="reference_city" class="form-control form-control-sm"
                                    placeholder="Enter City">
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
                                <!-- <input type="text" name="reference_state"class="form-control form-control-sm" placeholder="Enter State"> -->
                                <span class="text-danger kt-form__help error product_name"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <label class="form-label"> Zip </label>
                                <input type="text" name="reference_zip" class="form-control form-control-sm"
                                    placeholder="Enter Zip">
                                <span class="text-danger kt-form__help error product_name"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <label class="form-label">Email</label>
                                <input type="email" name="reference_email" class="form-control form-control-sm"
                                    placeholder="name@example.com">
                                <span class="text-danger kt-form__help error product_name"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <label class="form-label"> Type of Account </label>
                                <input type="text" name="account_type" class="form-control form-control-sm"
                                    placeholder="Enter Account Type">
                                <span class="text-danger kt-form__help error product_name"></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <label class="form-label"> Status </label>
                                <select class="form-control category" name="status">
                                    <option value="">Please Select</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive" selected>Inactive</option>
                                </select>
                                <span class="text-danger kt-form__help error product_name"></span>
                            </div>
                        </div>
                        <h5 style="margin:20px 0 18px 0;"><b>Tax Exempt</b> <span class="text-danger">*</span></h5>
                        <div class="col-6">
                            <div class="mb-2">
                                <label class="form-label">Are you Tax Exempt</label>
                                <select class="form-control category" id="tex_exempt" name="tex_exempt">
                                    <option value="">Please Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>

                                </select>
                                <span class="text-danger kt-form__help error tex_exempt"></span>
                            </div>
                        </div>
                        <div class="col-6" id="texId_div">
                            <div class="mb-2">
                                <label class="form-label">Tax Id</label>
                                <input type="text" name="tex_id" class="form-control form-control-sm"
                                    placeholder="Enter Tax Id">
                                <span class="text-danger kt-form__help error tex_id"></span>
                            </div>
                        </div>
                        <div class="col-12" id="texForm_div">
    <div class="row">
        <!-- Tax Exempt Form -->
        <div class="col-md-6 mb-2">
            <label for="tex_exempt_form" class="form-label">Tax Exempt Form</label>
            <input type="file" class="form-control" id="tex_exempt_form" name="tex_exempt_form" onclick="texFormClicked()">
            <span class="text-danger" id="tex_form_error">
                @error('tex_exempt_form')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <!-- Sales Certificate -->
        <div class="col-md-6 mb-2">
            <label for="sales_form" class="form-label">Sales Certificate</label>
            <input type="file" class="form-control" id="sales_form" name="sales_form" onclick="salesFormClicked()">
            <span class="text-danger" id="sales_form_error">
                @error('sales_form')
                    {{ $message }}
                @enderror
            </span>
        </div>
    </div>
</div>

                        <div class="row">
                            <div class="col-6" style="margin-top:30px;">
                                <div class="mb-2">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control form-control-sm"
                                        placeholder="8+ characters required">
                                    <span class="text-danger kt-form__help error password"></span>
                                </div>
                            </div>
                            <div class="col-6" style="margin-top:30px;">
                                <div class="mb-2">
                                    <label class="form-label">Confirm password</label>
                                    <input type="password" name="confirm_password" class="form-control form-control-sm"
                                        placeholder="8+ characters required">
                                    <span class="text-danger kt-form__help error confirm_password"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-lg btn-block btn-light lift text-uppercase"
                                alt="SIGNUP">Submit</button>
                        </div>

                    </form>
                    <!-- End Form -->

                </div>
            </div>
        </div> <!-- End Row -->

    </div>
@endsection

@push('styles')

@endpush

@push('custom_styles')
@endpush

@push('scripts')
    <!-- Plugin Js-->
    <script type="text/javascript" src="{{asset('public/validation/CustomerFormValidation.js')}}"></script>
@endpush

@push('custom_scripts')
    <script>
       $(document).ready(() => {
    if ($('#tex_exempt').val() == "Yes") {
        $('#texId_div').show();
        $('#texForm_div').show();
    } else {
        $('#texId_div').hide();
        $('#texForm_div').hide();
    }
    $('#tex_exempt').change(function() {
        let tex_exempt = $(this).val();
        console.log(tex_exempt);
        if (tex_exempt == "Yes") {
            $('#texId_div').show();
            $('#texForm_div').show();
        } else {
            $('#texId_div').hide();
            $('#texForm_div').hide();
        }
    });
});

function validateForm() {
    var isValid = true;
    var company_logo = $('#company_logo');
    var tex_exempt_form = $('#tex_exempt_form'); // Updated from tex_form
    var tex_exempt = $('#tex_exempt');
    var sales_form = $('#sales_form');

    // Clear previous error messages
    $('#company_logo_error').empty();
    $('#tex_form_error').empty(); // Updated to match Blade error span
    $('#sales_form_error').empty();

    // Validate tax exempt form and sales certificate if tax exempt is "Yes"
    if (tex_exempt.val() === "Yes") {
        if (tex_exempt_form.val() === '') {
            isValid = false;
            $('#tex_form_error').html("Please upload the Tax Exempt Form");
            console.log('Tax exempt form missing');
        }
        if (sales_form.val() === '') {
            isValid = false;
            $('#sales_form_error').html("Please upload the Sales Certificate");
            console.log('Sales certificate missing');
        }
    }

    console.log('Validation result:', isValid);
    return isValid;
}
$('form').on('submit', validateForm);

function compantLogoClicked() {
    $('#company_logo_error').empty();
}

function texFormClicked() {
    $('#tex_form_error').empty();
}

function salesFormClicked() {
    $('#sales_form_error').empty();
}

$(document).ready(() => {
    $('#company_logo').change(function() {
        const file = this.files[0];
        console.log(file);
        if (file) {
            let reader = new FileReader();
            reader.onload = function(event) {
                console.log(event.target.result);
                $('#imgPreview').attr('src', event.target.result);
                $("#imgPreview").css("width", "100").css("height", "100");
            };
            reader.readAsDataURL(file);
        }
    });
});


       

    </script>
@endpush

@push('modals')

@endpush
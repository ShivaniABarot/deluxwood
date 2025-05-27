@extends(backendView('layouts.app'))

@section('title', 'Customers')

@section('content')
<div class="container-xxl">
<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">Customer Details </h3>
				 <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/customers')}}">Customers</a></li>
                            <li class="breadcrumb-item active" aria-current="page">View Customer</li>
                        </ol>
                    </nav>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row clearfix g-3">
	

		<div class="col-lg-12 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h200">
			<div class="w-100 p-3 p-md-5 card border-0 shadow-sm" style="max-width: 100rem;">
				<!-- Form -->
				<form class="row g-1 p-3 p-md-4" action="" enctype="multipart/form-data"  method="POST" id="CustomerForm">
              
                    <h5  style="margin:0 0 18px 0;"><b>Basic Information </b> </h5>
					<div class="col-6">
						<div class="mb-2">
							<label class="form-label">Name of Company</label>
							<input type="text" name="company_name" value="{{$customer->company_name}}"class="form-control form-control-sm" placeholder="Enter Name of Company" disabled>
                            <span class="text-danger kt-form__help error company_name"></span>
						</div>
					</div>
                    <div class="col-6">
						<div class="mb-2">
							<label class="form-label">Representative Name</label>
							<input type="text" name="representative_name" value="{{$customer->representative_name}}" class="form-control form-control-sm" disabled placeholder="Enter Representative Name">
                            <span class="text-danger kt-form__help error representative_name"></span>
						</div>
					</div>
                    <div class="col-4">
                    <div class="mb-2">
                        <label class="form-label">Contact number</label>
                        <input type="number" name="contact_number"  value="{{$customer->contact_number}}" class="form-control form-control-sm" disabled placeholder="Enter Contact number">
                        <span class="text-danger kt-form__help error contact_number"></span>
                    </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-2">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{$customer->email}}" class="form-control form-control-sm" disabled placeholder="name@example.com">
                            <span class="text-danger kt-form__help error email"></span>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-2">
                            <label class="form-label">Fax</label>
                            <input type="text" name="fax"  value="{{$customer->fax}}" class="form-control form-control-sm" disabled placeholder="Enter Fax">
                            <span class="text-danger kt-form__help error fax"></span>
                        </div>
                    </div>
				    <div class="col-6">
						<div class="mb-2">
							<label class="form-label">Address</label>
							<input type="text" name="address" value="{{$customer->address}}" class="form-control form-control-sm" disabled placeholder="Enter Address">
                            <span class="text-danger kt-form__help error address"></span>
						</div>
					</div>
                    <div class="col-3">
                    <div class="mb-2">
                        <label class="form-label">City</label>
                        <input type="text" name="city" value="{{$customer->city}}" class="form-control form-control-sm" disabled placeholder="Enter City">
                        <span class="text-danger kt-form__help error city"></span>
                    </div>
                    </div>
                    <div class="col-3">
                        <div class="mb-2">
                            <label class="form-label">State</label>
                            <select class="form-control category"  name="state" disabled>
                                <option value="">Please Select</option>
                                @foreach($state as $index => $stateName )
                                    @if($stateName == "$customer->state") 
                                        <option value="{{$stateName}}" selected>{{$stateName}}</option>
                                    @else
                                        <option value="{{$stateName}}">{{$stateName}}</option>
                                    @endif    
                                @endforeach
                            </select>
                            <!-- <input type="text" name="state" class="form-control form-control-sm" disabled placeholder="Enter State"> -->
                            <span class="text-danger kt-form__help error state"></span>
                        </div>
                    </div>
                    
					<!-- <div class="col-6">
						<div class="mb-2">
							<label class="form-label">Showroom</label>
							<input type="text" name="showroom" value="{{$customer->showroom}}" class="form-control form-control-sm" disabled placeholder="Enter Showroom">
                            <span class="text-danger kt-form__help error showroom"></span>
						</div>
					</div>
                    <div class="col-6">
                        <div class="mb-2">
                            <label class="form-label">Showroom SQ FT</label>
                            <input type="text" name="showroom_sq"  value="{{$customer->showroom_sq}}" class="form-control form-control-sm" disabled placeholder="Enter Showroom SQ FT">
                            <span class="text-danger kt-form__help error showroom_sq"></span>
                        </div>
                    </div>
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Domestic lines carried</label>
                        <input type="text" name="domenstic_lines" value="{{$customer->domenstic_lines}}" class="form-control form-control-sm" disabled placeholder="Enter Domenstic lines carried">
                        <span class="text-danger kt-form__help error domenstic_lines"></span>
                    </div>
                </div>
            
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Import lines</label>
                        <input type="text" name="import_lines" value="{{$customer->import_lines}}" class="form-control form-control-sm" disabled placeholder="Enter Import lines">
                        <span class="text-danger kt-form__help error import_lines"></span>
                    </div>
                </div>
                
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Date Business Started</label>
                        <input type="date" name="date_business_started" value="{{$customer->date_business_started}}" class="form-control form-control-sm" disabled placeholder="Enter Date Business Started">
                        <span class="text-danger kt-form__help error date_business_started"></span>
                    </div>
                </div>
                
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Annual Cabinet Sales</label>
                        <input type="text" name="annual_cabinet_sales" value="{{$customer->annual_cabinet_sales}}" class="form-control form-control-sm" disabled placeholder="Enter Annual Cabinet Sales">
                        <span class="text-danger kt-form__help error annual_cabinet_sales"></span>
                    </div>
                </div> -->
              
               <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Company Logo</label>
                    </div>    
                    @if ($customer['company_logo'] !== null && $customer['company_logo'] !== '')
                        <img src="{{ asset('public/img/companyLogo/' . $customer['company_logo']) }}" style="height: 100px; width: 100px" class='preview-image'>
                    @else
                        <p>No company logo available</p>
                    @endif
                </div>
                <h5  style="margin:20px 0 18px 0;"><b>Owner Information</b> </h5>
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Owner Name</label>
                        <input type="text" name="owner_name" value="{{$customer->owner_name}}" class="form-control form-control-sm" disabled placeholder="Enter Owner Name">
                        <span class="text-danger kt-form__help error owner_name"></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Owner's Address</label>
                        <input type="text" name="owner_address" value="{{$customer->owner_address}}" class="form-control form-control-sm" disabled placeholder="Enter Owner's Address">
                        <span class="text-danger kt-form__help error owner_address"></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Phone</label>
                        <input type="text" name="owner_phone" value="{{$customer->owner_phone}}" class="form-control form-control-sm" disabled placeholder="Enter Phone">
                        <span class="text-danger kt-form__help error owner_phone"></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">City</label>
                        <input type="text" name="owner_city" value="{{$customer->owner_city}}" class="form-control form-control-sm" disabled placeholder="Enter City">
                        <span class="text-danger kt-form__help error owner_city"></span>
                    </div>
                </div><div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">State</label>
                        <select class="form-control category"  name="owner_state"  disabled>
                            <option value="">Please Select</option>
                           @foreach($state as $index => $stateName )
                                @if($stateName == "$customer->owner_state") 
                                    <option value="{{$stateName}}" selected>{{$stateName}}</option>
                                @else
                                    <option value="{{$stateName}}">{{$stateName}}</option>
                                @endif    
                           @endforeach
                        </select>
                        <!-- <input type="text" name="owner_state" class="form-control form-control-sm" disabled placeholder="Enter State"> -->
                        <span class="text-danger kt-form__help error owner_state"></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Zip</label>
                        <input type="text" name="owner_zip" value="{{$customer->owner_zip}}" class="form-control form-control-sm" disabled placeholder="Enter Zip">
                        <span class="text-danger kt-form__help error owner_zip"></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Email</label>
                        <input type="email" name="owner_email" value="{{$customer->owner_email}}" class="form-control form-control-sm" disabled placeholder="Enter Email">
                        <span class="text-danger kt-form__help error owner_email"></span>
                    </div>
                </div>
                <h5  style="margin:20px 0 18px 0;"><b>Reference </b></h5>

                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Name of company</label>
                        <input type="text" name="reference_com_name" value="{{$customer->reference_com_name}}" class="form-control form-control-sm" disabled placeholder="Enter Name of company">
                     
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Address</label>
                        <input type="text" name="reference_address" value="{{$customer->reference_address}}" class="form-control form-control-sm" disabled placeholder="Enter Address">
                     
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Contact Number</label>
                        <input type="text" name="reference_contact_number" value="{{$customer->reference_contact_number}}" class="form-control form-control-sm" disabled placeholder="Enter Contact Number">
                     
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">City</label>
                        <input type="text" name="reference_city" value="{{$customer->reference_city}}" class="form-control form-control-sm" disabled placeholder="Enter City">
                     
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">State</label>
                        <select class="form-control category"  name="reference_state" disabled>
                            <option value="">Please Select</option>
                           @foreach($state as $index => $stateName )
                                @if($stateName == "$customer->reference_state") 
                                    <option value="{{$stateName}}" selected>{{$stateName}}</option>
                                @else
                                    <option value="{{$stateName}}">{{$stateName}}</option>
                                @endif    
                           @endforeach
                        </select>
                        <!-- <input type="text" name="reference_state"class="form-control form-control-sm" disabled placeholder="Enter State"> -->
                     
                    </div>
                </div>
                <div class="col-6">
						<div class="mb-2">
							<label class="form-label"> Zip </label>
							<input type="text" name="reference_zip" value="{{$customer->reference_zip}}" class="form-control form-control-sm" disabled placeholder="Enter Zip">
                         
						</div>
					</div>
                    <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Email</label>
                        <input type="email" name="reference_email" value="{{$customer->reference_email}}" class="form-control form-control-sm" disabled placeholder="name@example.com">
                     
                    </div>
                </div>
                <div class="col-6">
						<div class="mb-2">
							<label class="form-label"> Type of Account </label>
							<input type="text" name="account_type" value="{{$customer->account_type}}"  class="form-control form-control-sm" disabled placeholder="Enter Account Type">
                         
						</div>
				</div>
                <div class="col-6">
						<div class="mb-2">
							<label class="form-label"> Status </label>
                            <select class="form-control category"  name="status"  disabled>
                            <option value="">Please Select</option>
                            @if($customer->status == "Active")
                            <option value="Active" selected>Active</option>
                            <option value="Inactive">Inactive</option>
                            @else
                            <option value="Active">Active</option>
                            <option value="Inactive" selected>Inactive</option>
                           @endif
                        </select>
                         
						</div>
				</div>
                <h5 style="margin:20px 0 18px 0;"><b>Tax Exempt</b> </h5>
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Are you Tax Exempt</label>
                        <select class="form-control category"  name="tex_exempt"  disabled>
                            <option value="">Please Select</option>
                            @if($customer->tex_exempt == "Yes")
                            <option value="Yes" selected>Yes</option>
                            <option value="No">No</option>
                            @else
                            <option value="Yes" >Yes</option>
                            <option value="No" selected>No</option>
                            @endif
                        </select>
                        <span class="text-danger kt-form__help error tex_exempt"></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Tax Id</label>
                        <input type="text" name="tex_id" value="{{$customer->tex_id}}" class="form-control form-control-sm" disabled placeholder="Enter Tax Id">
                        <span class="text-danger kt-form__help error tex_id"></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-2">
                        <label class="form-label">Tax Exempt Form</label><br>
                        <!-- <span>{{$customer->tex_exempt_form}}</span><br> -->
                        @if ($customer->tex_exempt_form)
                          <a href="{{ route('download.file', ['filename' =>$customer->tex_exempt_form]) }}" class="btn btn-dark">Download {{ $customer->tex_exempt_form }}</a>
                        @else
                          <p>No Tax Exempt Form file available</p>
                        @endif

                        <!-- <a href="{{ asset('img/texExemptForm/' . $customer->tex_exempt_form) }}" download>Download {{ $customer->tex_exempt_form }}</a> -->


                    </div>
                    
                </div>	
                <div class="col-6" id="texId_div">
                  <div class="mb-2">
                     <label class="form-label">Note</label>
                     <input type="text" name="company_note"  value="{{$customer->company_note}}" class="form-control form-control-sm" placeholder="Enter company note" disabled>
                     <span class="text-danger kt-form__help error company_note"></span>
                  </div>
               </div>
                
					<!-- <div class="col-12 text-center mt-4">
						<button type="submit" class="btn btn-lg btn-block btn-light lift text-uppercase" alt="SIGNUP">Update</button>
					</div>
					 -->
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
	// function validateForm() {
    // var isValid = true;
    //    var company_logo = $('#company_logo');
    //    var tex_form = $('#tex_form');
    //         if(company_logo.val()==''){
    //             isValid = false;
    //             $('#company_logo_error').html("Please Select Company Logo");
    //        }
    //        if(tex_form.val()==''){
    //             isValid = false;
    //             $('#tex_form_error').html("Please Select Tax Exempt Form");
    //             console.log("hjsf");
    //        }
    //        return isValid;
           
      
    // }
    // $('form').on('submit', validateForm);
    
    // function compantLogoClicked() {
    // $('#company_logo_error').empty(); // Clear the error message
    // }
    // function texFormClicked() {
    //     $('#tex_form_error').empty(); // Clear the error message
    // }
  

// function readURL(input) {
//     if (input.files && input.files[0]) {
//         var reader = new FileReader();

//         reader.onload = function (e) {
//             $('#blah').attr('src', e.target.result);
//             $("#blah").css("width", "100").css("height", "100");
//         }

//         reader.readAsDataURL(input.files[0]);
//     }
// }
// $("#tex_form").change(function(){
//     readURL(this);
// });

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
@endpush

@push('modals')

@endpush


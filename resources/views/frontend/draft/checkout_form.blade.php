@extends(backendView('layouts.app'))

@section('title', 'Add Draft')

@section('content')


<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">Checkout</h3>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row clearfix g-3">
		
		<div class="col-lg-12">
			<div class="card mb-3">
				<div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
					<h6 class="m-0 fw-bold">Basic Information <span class="text-danger">*</span></h6>
				</div>
				<div class="card-body">
					<form action="{{url('store-checkout-form')}}" method="POST" id="custdraftForm" enctype="multipart/form-data">
						@csrf 
						<div class="row g-3 align-items-center">
                            <input name="status" value="{{$action}}" hidden>
                            <input name="customerDraftId" value="{{$customerDraftId}}" hidden>
                            <input name="discountedPrice" value="{{$discountedPrice}}" hidden>
                            <input name="subTotal" value="{{$subTotal}}" hidden>

							<div class="col-md-6">
								<label class="form-label">PO Number</label>
								<input type="text" class="form-control" value="{{$customer_draft->po_number}}"name="po_number" placeholder="please enter PO number" >
								<span class="text-danger kt-form__help error po_number"></span>
							</div>
							<div class="col-md-6">
								<label class="form-label">Designer</label>
								<input type="text" class="form-control" name="designer"  value="{{$customer_draft->designer}}"  placeholder="please enter designer" >
								<span class="text-danger kt-form__help error designer"></span>
							
							</div>
							
							
							<div class="col-md-6">
								<label class="form-label">Order Tag</label>
								<input type="text" class="form-control" name="order_tag"  value="{{old('order_tag')}}" placeholder="please enter order tag" >
								<span class="text-danger kt-form__help error order_tag"></span>
								@if ($errors->has('order_tag'))
									<span class="text-danger">{{ $errors->first('order_tag') }}</span>
								@endif
							</div>
							
						    <div class="col-md-6">
							    <label class="form-label">Discount (%)</label>
							    @if($CustomerGroup && $CustomerGroup->group_title !== null)
							        <input type="text" class="form-control" value="{{$CustomerGroup->group_title}}"  placeholder="please enter discount" disabled>
							    @else
							        <input type="text" class="form-control" value="None" disabled>
							    @endif
							    <span class="text-danger kt-form__help error discount"></span>

							</div>
							    @if($CustomerGroup)
								    <input type="text" value="{{$CustomerGroup->group_dicount_percent}}"  name="discount" hidden> 
								@else
								    <input type="text" value=""  name="discount" hidden> 
								@endif
							<div class="col-md-6">
								<label class="form-label">Dealer Name</label>
								<input type="text" class="form-control" name="dealer_name"  value="{{ old('dealer_name')}}"  placeholder="please enter dealer name">
								<span class="text-danger kt-form__help error dealer_name"></span>
								@if ($errors->has('dealer_name'))
									<span class="text-danger">{{ $errors->first('dealer_name') }}</span>
								@endif
							</div>
							<div class="col-md-6">
								<label class="form-label">Dealer Email</label>
								<input type="text" class="form-control" name="dealer_email"   value="{{ old('dealer_email')}}"   placeholder="please enter dealer email">
								<span class="text-danger kt-form__help error dealer_email"></span>
								@if ($errors->has('dealer_email'))
									<span class="text-danger">{{ $errors->first('dealer_email') }}</span>
								@endif
							</div>
						</div>
						<div class="  bg-transparent border-bottom-0" style="margin-top: 40px;margin-bottom: 20px;">
							<h6 class="m-0 fw-bold">Billing Information <span class="text-danger">*</span></h6>
						</div>
						<div class="row g-3 align-items-center">
						<div class="col-md-8">
								<label class="form-label">Address</label>
								<input type="text" class="form-control" name="address"   value="{{ old('address')}}"  placeholder="please enter address">
								<span class="text-danger kt-form__help error address"></span>
								@if ($errors->has('address'))
									<span class="text-danger">{{ $errors->first('address') }}</span>
								@endif
						</div>
						<div class="col-md-4">
								<label class="form-label">Contact No</label>
								<input type="text" class="form-control" name="contact_no"  value="{{ old('contact_no')}}"   placeholder="please enter contact">
								<span class="text-danger kt-form__help error contact_no"></span>
								@if ($errors->has('contact_no'))
									<span class="text-danger">{{ $errors->first('contact_no') }}</span>
								@endif
						</div>
						<div class="col-md-4">
								<label class="form-label">State</label>
								<select class="form-control" name="state">
									<option value="">Please Select</option>
									 @foreach($state as $val)
                                      <option value="{{ $val->state_id}}">{{$val->state_name}}</option>
                                     @endforeach
                                 </select>
								<span class="text-danger kt-form__help error state"></span>
								@if ($errors->has('state'))
									<span class="text-danger">{{ $errors->first('state') }}</span>
								@endif
						</div>
						<div class="col-md-4">
								<label class="form-label">City</label>
								<input type="text" class="form-control" name="city"   value="{{ old('city')}}"  placeholder="please enter city">
								<span class="text-danger kt-form__help error city"></span>
								@if ($errors->has('city'))
									<span class="text-danger">{{ $errors->first('city') }}</span>
								@endif
						</div>
						
						<div class="col-md-4">
								<label class="form-label">Zip Code</label>
								<input type="text" class="form-control" name="zip_code"   value="{{ old('zip_code')}}" placeholder="please eneter zip code">
								<span class="text-danger kt-form__help error zip_code"></span>
								@if ($errors->has('zip_code'))
									<span class="text-danger">{{ $errors->first('zip_code') }}</span>
								@endif
						</div>
						<!-- <div class="  bg-transparent border-bottom-0" style="margin-top: 40px;margin-bottom: 20px;">
							<h6 class="m-0 fw-bold">Shipping Information <span class="text-danger">*</span></h6>
						</div>
						<div class="col-md-4">
								<label class="form-label">Name</label>
								<input type="text" class="form-control" name="ship_name"  placeholder="please enter contact">
								<span class="text-danger kt-form__help error ship_name"></span>
						</div>
						<div class="col-md-4">
								<label class="form-label">Email</label>
								<input type="text" class="form-control" name="ship_email"   placeholder="please enter contact">
								<span class="text-danger kt-form__help error ship_email"></span>
						</div>
						<div class="col-md-4">
								<label class="form-label">Contact No</label>
								<input type="text" class="form-control" name="ship_contact_no"   placeholder="please enter contact">
								<span class="text-danger kt-form__help error ship_contact_no"></span>
						</div>
						<div class="col-md-8">
								<label class="form-label">Address</label>
								<input type="text" class="form-control" name="ship_address"   placeholder="please enter address">
								<span class="text-danger kt-form__help error ship_address"></span>
						</div>
						<div class="col-md-4">
								<label class="form-label">State</label>
								<select class="form-control" name="ship_state">
									<option value="">Please Select</option>
									 @foreach($state as $val)
                                   
                                     <option value="{{ $val->state_id}}" >{{$val->state_name}}</option> 
                                    
                                     @endforeach
                                 </select>
								<span class="text-danger kt-form__help error ship_state"></span>
						</div>
						<div class="col-md-4">
								<label class="form-label">City</label>
								<input type="text" class="form-control" name="ship_city"   placeholder="please enter city">
								<span class="text-danger kt-form__help error ship_city"></span>
						</div>
						
						<div class="col-md-4">
								<label class="form-label">Zip Code</label>
								<input type="text" class="form-control" name="ship_zip_code"  placeholder="please eneter zip code">
								<span class="text-danger kt-form__help error ship_zip_code"></span>
						</div> -->
						
					</div><br>
					<br>
					<div class="col-md-4">
					    <label class="form-label">Upload Pro Kitchen (Optional)</label>
					    <input type="file" class="form-control" name="pro_kitchen_pdf" id="pro_kitchen_pdf" onClick="proPdfClicked()">
					    <p style="margin-top: 10px; text-align: center;">(PDF/Excel File)</p>
					    <span class="text-danger" id="pro_kitchen_pdf_error"></span>
					</div>
						<button type="submit" class="btn btn-warning mt-4 text-uppercase px-5">Next</button>
					</form>
				</div>
			</div>
		</div>
	</div><!-- Row End -->
</div>




@endsection

@push('styles')
<!-- plugin css file  -->
<link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/responsive.dataTables.min.css') !!}">
<link rel="stylesheet" href="{!! backendAssets('dist/assets/plugin/datatables/dataTables.bootstrap5.min.css') !!}">
@endpush

@push('custom_styles')
<style>
    /* White buttons with black border */
    .btn-white-border {
        background-color: white;
		border-top: 1px solid gray;
        border-bottom: 1px solid black;
        color: black;
    }
    .btn-light:focus
    {
      background-color: #eca72f!important;
    }
</style>
@endpush

@push('scripts')
<!-- Plugin Js -->
<script src="{!! backendAssets('dist/assets/bundles/apexcharts.bundle.js') !!}"></script>
<script src="{!! backendAssets('dist/assets/bundles/dataTables.bundle.js') !!}"></script>
<script src="{!! backendAssets('dist/assets/js/page/index.js') !!}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1Jr7axGGkwvHRnNfoOzoVRFV3yOPHJEU&callback=myMap"></script>
@endpush

@push('custom_scripts')
<script>
	$('#myDataTable')
		.addClass('nowrap')
		.dataTable({
			responsive: true,
			columnDefs: [{
				targets: [-1, -3],
				className: 'dt-body-right'
			}]
		});

	//function validateForm() {
     //   var isValid = true;
       // var pro_kitchen_pdf = $('#pro_kitchen_pdf');
        
        // Optional validation: Check if a file is selected and validate its extension
        // if (pro_kitchen_pdf.val() !== '') {
        //     var allowedExtensions = ['pdf', 'xls', 'xlsx']; // Add other allowed extensions if needed
        //     var fileExtension = pro_kitchen_pdf.val().split('.').pop().toLowerCase();
        //     if (!allowedExtensions.includes(fileExtension)) {
        //         isValid = false;
        //         $('#pro_kitchen_pdf_error').html("Invalid file format. Please upload a PDF or Excel file.");
        //     }
        // }

    //     return isValid;
    // }

    // $('form').on('submit', validateForm);

    // function proPdfClicked() {
    //     $('#pro_kitchen_pdf_error').empty(); // Clear the error message
    // }
</script>
<!-- <script type="text/javascript" src="{{asset('/validation/CheckoutFormValidation.js')}}"></script>  -->
@endpush

<!-- 
<div class="col-md-6">
								<label class="form-label">Group Discription </label>
								<textarea class="form-control" rows="3" name="group_description" placeholder="Please enter group description" style="resize: none;"></textarea>
								<span class="text-danger kt-form__help error group_description"></span>
							</div> -->
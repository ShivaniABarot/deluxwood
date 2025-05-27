@extends(backendView('layouts.app'))

@section('title', 'Add Draft')

@section('content')


<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">Add Shipping Information </h3>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row clearfix g-3">
		
		<div class="col-lg-12">
			<div class="card mb-3">
			
				<div class="card-body">
					<form action="{{url('store-shipping-information')}}/{{$id}}" method="POST" id="custdraftForm" enctype="multipart/form-data">
						@csrf 
						<div class="row g-3 align-items-center">
						
						</div>
						
						<div class="row g-3 align-items-center">
						
						<div class="  bg-transparent border-bottom-0" style="margin-top: 40px;margin-bottom: 20px;">
							<h6 class="m-0 fw-bold"></h6>
						</div>
						<div class="col-md-4">
								<label class="form-label">Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="ship_name"  value="{{ $draft->ship_name}}" placeholder="please enter contact">
								<span class="text-danger kt-form__help error ship_name"></span>
								@if ($errors->has('ship_name'))
									<span class="text-danger">{{ $errors->first('ship_name') }}</span>
								@endif
						</div>
						<div class="col-md-4">
								<label class="form-label">Email <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="ship_email"   value="{{ $draft->ship_email }}" placeholder="please enter contact">
								<span class="text-danger kt-form__help error ship_email"></span>
								@if ($errors->has('ship_email'))
									<span class="text-danger">{{ $errors->first('ship_email') }}</span>
								@endif
						</div>
						<div class="col-md-4">
								<label class="form-label">Contact No <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="ship_contact_no"  value="{{ $draft->ship_contact_no}}" placeholder="please enter contact">
								<span class="text-danger kt-form__help error ship_contact_no"></span>
								@if ($errors->has('ship_contact_no'))
									<span class="text-danger">{{ $errors->first('ship_contact_no') }}</span>
								@endif
						</div>
						<div class="col-md-8">
								<label class="form-label">Address <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="ship_address"  value="{{ $draft->ship_address}}" placeholder="please enter address">
								<span class="text-danger kt-form__help error ship_address"></span>
								@if ($errors->has('ship_address'))
									<span class="text-danger">{{ $errors->first('ship_address') }}</span>
								@endif
						</div>
						<div class="col-md-4">
								<label class="form-label">State <span class="text-danger">*</span></label>
								<select class="form-control" name="ship_state">
									<option value="">Please Select</option>
                                    @foreach($state as $val)
                                        @if($val->state_id == $draft->ship_state)
                                            <option value="{{ $val->state_id}}" selected>{{$val->state_name}}</option>
                                        @else
                                            <option value="{{ $val->state_id}}" >{{$val->state_name}}</option>
                                        @endif
                                    @endforeach
                                 </select>
								<span class="text-danger kt-form__help error ship_state"></span>
								@if ($errors->has('ship_state'))
									<span class="text-danger">{{ $errors->first('ship_state') }}</span>
								@endif
						</div>
						<div class="col-md-4">
								<label class="form-label">City <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="ship_city"  value="{{ $draft->ship_city}}" placeholder="please enter city">
								<span class="text-danger kt-form__help error ship_city"></span>
								@if ($errors->has('ship_city'))
									<span class="text-danger">{{ $errors->first('ship_city') }}</span>
								@endif
						</div>
						
						<div class="col-md-4">
								<label class="form-label">Zip Code <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="ship_zip_code"  value="{{ $draft->ship_zip_code }}" placeholder="please eneter zip code">
								<span class="text-danger kt-form__help error ship_zip_code"></span>
								@if ($errors->has('ship_zip_code'))
									<span class="text-danger">{{ $errors->first('ship_zip_code') }}</span>
								@endif
						</div>
						
					</div><br>
				
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

	function validateForm() {
        var isValid = true;
        var pro_kitchen_pdf = $('#pro_kitchen_pdf');
        
        // Optional validation: Check if a file is selected and validate its extension
        if (pro_kitchen_pdf.val() !== '') {
            var allowedExtensions = ['pdf', 'xls', 'xlsx']; // Add other allowed extensions if needed
            var fileExtension = pro_kitchen_pdf.val().split('.').pop().toLowerCase();
            if (!allowedExtensions.includes(fileExtension)) {
                isValid = false;
                $('#pro_kitchen_pdf_error').html("Invalid file format. Please upload a PDF or Excel file.");
            }
        }

        return isValid;
    }

    $('form').on('submit', validateForm);

    function proPdfClicked() {
        $('#pro_kitchen_pdf_error').empty(); // Clear the error message
    }
</script>
<!-- <script type="text/javascript" src="{{asset('public/validation/CustomerDraftValidation.js')}}"></script>  -->
@endpush

<!-- 
<div class="col-md-6">
								<label class="form-label">Group Discription </label>
								<textarea class="form-control" rows="3" name="group_description" placeholder="Please enter group description" style="resize: none;"></textarea>
								<span class="text-danger kt-form__help error group_description"></span>
							</div> -->
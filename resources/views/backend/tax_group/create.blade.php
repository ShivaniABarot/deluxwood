@extends(backendView('layouts.app'))

@section('title', 'Customer Group Add')

@section('content')
<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">Customer Group Add</h3>
				 <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/tax-group/index')}}">Tax Group</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Tax Group</li>
                        </ol>
                    </nav>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row clearfix g-3">
		
		<div class="col-lg-12">
			<div class="card mb-3">
				<div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
					<h6 class="m-0 fw-bold">Tax Group Information</h6>
				</div>
				<div class="card-body">
					<form action="{{url('admin/tax-group/store')}}" method="POST" id="customergroupForm">
						@csrf
						<div class="row g-3 align-items-center">
                        <div class="col-md-6">
                            <label class="form-label">Tax Title <span class="text-danger">*</span></label>
                            <select class="form-control category" name="tax_group" id="taxDropdown">
                                <option value="">Please Select</option>
                                <option value="With Tax">With Tax</option>
                                <option value="Without Tax">Without Tax</option>
                            </select>
                            <span class="text-danger kt-form__help error tax_group"></span>
                        </div>

                        <div class="col-md-6" id="taxRateContainer" style="display: none;">
                            <label class="form-label">Tax Rate(%) <span class="text-danger">*</span></label>
                            <input type="text" step="0.001" class="form-control" name="tax_rate" placeholder="Please enter group discount">
                            <span class="text-danger kt-form__help error tax_rate"></span>
                        </div>
                		<!-- <div class="col-md-6">
								<label class="form-label">Tax Description <span class="text-danger">*</span></label>
								<textarea class="form-control" rows="3" name="tax_description" placeholder="Please enter group description" style="resize: none;"></textarea>
								<span class="text-danger kt-form__help error group_description"></span> 
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

@push('styles')
@endpush

@push('custom_styles')
@endpush

@push('scripts')
<script type="text/javascript" src="{{asset('public/validation/CustomerGroupValidation.js')}}"></script> 
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

@endpush

@push('custom_scripts')
<script>
    $(document).ready(function() {
        // Initially hide the Tax Rate input
        $('#taxRateInput').hide();

        // Attach change event to the dropdown
        $('.category').change(function() {
            var selectedValue = $(this).val();

            // Show/hide Tax Rate input based on the dropdown selection
            if (selectedValue === 'With Tax') {
                $('#taxRateInput').show();
            } else {
                $('#taxRateInput').hide();
            }
        });
    });
</script>
<script>
    $(document).ready(function () {
        // Attach change event to the dropdown
        $('#taxDropdown').change(function () {
            // Get the selected value
            var selectedValue = $(this).val();

            // Show/hide the tax rate container based on the selected value
            if (selectedValue === 'With Tax') {
                $('#taxRateContainer').show();
            } else {
                $('#taxRateContainer').hide();
            }
        });
    });
</script>

@endpush

@push('modals')
@endpush
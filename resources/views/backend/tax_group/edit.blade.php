@extends(backendView('layouts.app'))

@section('title', 'Tax Group Edit')

@section('content')
<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">Tax Group Edit</h3>
				 <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/tax-group/index')}}">Tax Group</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Tax Group</li>
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
					<form action='{{url("admin/tax-group/update/$tax_group->tax_group_id")}}' method="POST" id="customergroupForm">
					@method('PATCH')
                            @csrf
						<div class="row g-3 align-items-center">
                        <div class="col-md-6">
                            <label class="form-label">Tax Title <span class="text-danger">*</span></label>
                            <select class="form-control category" name="tax_group" id="taxDropdown">
                            <option value="">Please Select</option>
                              @if($tax_group->tax_group == "With Tax")
                              <option value="With Tax" selected>With Tax</option>
                              <option value="Without Tax">Without Tax</option>
                              @else
                              <option value="With Tax">With Tax</option>
                              <option value="Without Tax" selected>Without Tax</option>
                              @endif
                            </select>
                            <span class="text-danger kt-form__help error tax_title"></span>
                        </div>
                            <div class="col-md-6" id="taxRateContainer" style="{{ $tax_group->tax_group == 'With Tax' ? '' : 'display: none;' }}">
                            <label class="form-label">Tax Rate(%) <span class="text-danger">*</span></label>
                            <input type="text" step="0.001" class="form-control" id="tax_rate" name="tax_rate" value="{{$tax_group->tax_rate}}" placeholder="Please enter group discount">
                            <span class="text-danger kt-form__help error tax_rate"></span>
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
        // Show/hide taxRateContainer based on the selected value of tax_group
        $('#taxDropdown').on('change', function() {
            var selectedValue = $(this).val();
            if (selectedValue == 'With Tax') {
                $('#taxRateContainer').show();
            } else {
                $('#taxRateContainer').hide();
                 $('#tax_rate').val('');
            }
        });
        
        // Trigger the change event on page load to set the initial state
        $('#taxDropdown').trigger('change');
    });
</script>

@endpush

@push('modals')
@endpush
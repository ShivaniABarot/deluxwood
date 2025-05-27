@extends(backendView('layouts.app'))

@section('title', 'Product Add')

@section('content')
<div class="container-xxl">

	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0">Products Add</h3>
				<button type="submit" class="btn btn-primary btn-set-task w-sm-100 py-2 px-5 text-uppercase">Save</button>
			</div>
		</div>
	</div> <!-- Row end  -->

	<div class="row g-3 mb-3">
		
		<div class="col-xl-12 col-lg-12">
			<div class="card mb-3">
				<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
					<h6 class="mb-0 fw-bold ">Basic information</h6>
				</div>
				<div class="card-body">
					<form action="{{url('admin/product-store')}}" method="POST" id="customergroupForm" enctype="multipart/form-data">
						@csrf
					<div class="row g-3 align-items-center">
							<div class="col-6">
								<div class="mb-2">
									<label class="form-label">Product Category</label>
									<select class="form-control category"  name="product_category_id"   >
										<option value="">Please Select</option>
										@foreach($productCategory as $productCategory )
											<option value="{{$productCategory->category_id}}">{{$productCategory->title}}</option>
										@endforeach
									</select>
									<span class="text-danger kt-form__help error product_category_id"></span>
								</div>
							</div>
							<div class="col-6">
								<div class="mb-2">
									<label class="form-label">Door Style</label>
									<!-- <input type="text" name="representative_name"  class="form-control form-control-sm" placeholder="Enter Representative Name"> -->
									<select id="door_style_id" class="form-control form-control-sm"  name="door_style_id[]"  multiple>
										<option value="">Please Select</option>
										@foreach($doorStyle as $doorStyle )
											<option value="{{$doorStyle->doorStyle_id}}">{{$doorStyle->name}}</option>
										@endforeach
										<!-- Add more options for other states -->
									</select>
									<span class="text-danger kt-form__help error door_style_id"></span>
								</div>
							</div>
							<div class="col-6">
								<div class="mb-2">
									<label class="form-label">Product Name</label>
									<input type="text" name="product_name"  class="form-control form-control-sm" placeholder="Enter Product Name">
									<span class="text-danger kt-form__help error product_name"></span>
								</div>
							</div>
						</div>
						<button type="submit" class="btn btn-primary mt-4 text-uppercase px-5">Submit</button>
					</form>
				</div>
			</div>
	
		</div>
	</div><!-- Row end  -->

</div>
@endsection

@push('styles')
<!--plugin css file -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

@endpush

@push('custom_styles')
@endpush

@push('scripts')
<!-- Jquery Plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script type="text/javascript" src="{{asset('public/validation/CustomerGroupValidation.js')}}"></script> 
@endpush

@push('custom_scripts')
<script>

    $(document).ready(function() {
        $('#door_style_id').select2();
    });

</script>
@endpush

@push('modals')
<!-- Modal Cropper-->
<div class="modal docs-cropped" id="getCroppedCanvasModal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Cropped</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-white border lift" data-bs-dismiss="modal">Close</button>
				<a class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.jpg') !!}">Download</a>
			</div>
		</div>
	</div>
</div>
@endpush
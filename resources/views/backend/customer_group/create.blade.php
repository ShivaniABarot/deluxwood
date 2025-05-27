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
                            <li class="breadcrumb-item"><a href="{{url('admin/customer-group/index')}}">Customer Group</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Customer Group</li>
                        </ol>
                    </nav>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row clearfix g-3">
		
		<div class="col-lg-12">
			<div class="card mb-3">
				<div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
					<h6 class="m-0 fw-bold">Customer Group Information</h6>
				</div>
				<div class="card-body">
					<form action="{{url('admin/customer-group/store')}}" method="POST" id="customergroupForm">
						@csrf
						<div class="row g-3 align-items-center">
							<div class="col-md-6">
								<label class="form-label">Group Title <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="group_title" placeholder="Please enter group title">
								<span class="text-danger kt-form__help error group_title"></span>
							</div>
							<div class="col-md-6">
								<label class="form-label">Group Discount (%) <span class="text-danger">*</span></label>
								<input type="text"  step="0.001" class="form-control" name="group_discount_percent" placeholder="Please enter group discount ">
								<span class="text-danger kt-form__help error group_discount_percent"></span>
							</div>
							<div class="col-md-6">
								<label class="form-label">Group Description <span class="text-danger">*</span></label>
								<textarea class="form-control" rows="3" name="group_description" placeholder="Please enter group description" style="resize: none;"></textarea>
								<span class="text-danger kt-form__help error group_description"></span>
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
@endpush

@push('custom_scripts')
<script type="text/javascript" src="{{asset('public/validation/CustomerGroupValidation.js')}}"></script> 
@endpush

@push('modals')
@endpush
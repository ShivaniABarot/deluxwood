@extends(backendView('layouts.app'))

@section('title', 'Category Edit')

@section('content')
<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0"> Edit Category</h3>
				<nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/categories-list')}}">Category</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
                        </ol>
                    </nav>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row clearfix g-3">
		
		<div class="col-lg-12">
			<div class="card mb-3">
				<!-- <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
					<h6 class="m-0 fw-bold">Customer Group Information</h6>
				</div> -->
				<div class="card-body">
					<form action="{{url('admin/categories-update')}}\{{$category->category_id}}" method="POST" id="customergroupForm">
                    @method('PATCH')
						@csrf
						<div class="row g-3 align-items-center">
							<div class="col-md-6">
								<label class="form-label">Title <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="title" value="{{$category->title}}" placeholder="Please enter Title">
								<span class="text-danger kt-form__help error title"></span>
							</div>
							<div class="col-md-6" >
								<label class="form-label" style="margin-top:30px;"> Description <span class="text-danger">*</span></label>
								<textarea class="form-control" rows="3" name="description" placeholder="Please enter Description" style="resize: none;">{{$category->description}}</textarea>
								<span class="text-danger kt-form__help error description"></span>
							</div>
						</div>
						<button type="submit" class="btn btn-light mt-4 text-uppercase px-5">Submit</button>
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
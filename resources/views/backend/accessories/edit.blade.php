@extends(backendView('layouts.app'))

@section('content')
<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
			<div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
				<h3 class="fw-bold mb-0"> Edit Accessory</h3>
				 <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('admin/home')}}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{url('admin/accessories/index')}}">Accessory</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Accessory</li>
                        </ol>
                    </nav>
			</div>
		</div>
	</div> <!-- Row end  -->
	<div class="row clearfix g-3">
		
		<div class="col-lg-12">
			<div class="card mb-3">
				<div class="card-body">
				 <form action="{{ url('admin/accessories-update')}}\{{ $addaccessories->accessories_id}}" method="POST" id="customergroupForm">
                    @method('PATCH')
						@csrf
						<div class="row g-3 align-items-center">
							<div class="col-md-6">
								<label class="form-label">Enter Accessory Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="accessories_name" value="{{$addaccessories->accessories_nm}}" placeholder="Please enter name">
								<span class="text-danger kt-form__help error accessories_name"></span>
							</div>
							<div class="col-md-6">
								<label class="form-label">Enter Maximum Quantity <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="quantity" value="{{$addaccessories->quantity}}"  placeholder="Please enter Name" >
								<span class="text-danger kt-form__help error quantity"></span>
							</div>
							<div class="col-md-12" >
								<label class="form-label" style="margin-top:30px;"> Enter Description <span class="text-danger">*</span></label>
								<textarea class="form-control" rows="3" name="accessories_description" placeholder="Please enter  description" style="resize: none;">{{$addaccessories->accessories_desc}}</textarea>
								<span class="text-danger kt-form__help error accessories_description"></span>
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
@push('scripts')
<script type="text/javascript" src="{{asset('public/validation/CustomerGroupValidation.js')}}"></script>

@endpush

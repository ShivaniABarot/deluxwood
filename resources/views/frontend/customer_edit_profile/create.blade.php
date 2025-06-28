@extends(backendView('layouts.app'))

@section('content')
<div class="container-xxl">
	<div class="row align-items-center">
		<div class="border-0 mb-4">
        <div class="dropdown user-profile ml-2 ml-sm-3 d-flex align-items-center zindex-popover">
			
            <div class="u-info me-2">
                <p class="mb-0 text-end line-height-sm "><span class="font-weight-bold">Admin</span></p>
                <small>Admin Profile</small>
            </div>
            <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static">
                <img class="avatar lg rounded-circle img-thumbnail" src="https://deluxewoodexpress.com/public/backend/dist/assets/images/profile_av.svg" alt="profile">
            </a>
            
            
        </div>
		</div>
	</div> Row end 
	<div class="row clearfix g-3">
		
		<div class="col-lg-12">
			<div class="card mb-3">
				<!-- <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
					<h6 class="m-0 fw-bold">Customer Group Information</h6>
				</div> -->
				<div class="card-body">
					<form action="{{ route('accessories.store') }}" method="POST" id="accessoriesForm">
						@csrf
						<div class="row g-3 align-items-center">
							<div class="col-md-6">
								<label class="form-label">Enter Accessories Name</label>
								<input type="text" class="form-control" name="accessories_nm" placeholder="Please enter name" required>
								<span class="text-danger kt-form__help error accessories_nm"></span>
							</div>
							<div class="col-md-6" >
								<label class="form-label" style="margin-top:30px;"> Enter Description </label>
								<textarea class="form-control" rows="3" name="accessories_desc" placeholder="Please enter  description" style="resize: none;"></textarea>
								<span class="text-danger kt-form__help error accessories_desc"></span>
							</div>
						</div>
						<button type="submit" class="btn btn-primary mt-4 text-uppercase px-5">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div><!-- Row End -->
</div>
@endsection


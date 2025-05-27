@extends(backendView('layouts.app'))

@section('title', 'Customer Edit Profile')

@section('content')
<div class="container-xxl">
	<div class="row g-3 mb-3">
		
		<div class="col-xl-12 col-lg-12">
			<div class="card mb-3">
				<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
					<h6 class="mb-0 fw-bold ">My Account</h6>
				</div>
				<div class="card-body">
					
						
					<div class="row g-3 align-items-center">

						
							<div class="row g-3 align-items-center" style="margin-top:30px">

							<div class="col-6">
								<div class="mb-2">
									<label class="form-label"> Name</label>
									<input type="text" name="name"  value="{{$user->name}}" class="form-control form-control-sm" readonly >
									<span class="text-danger kt-form__help error name"></span>
								</div>
							</div>
							
                            <div class="col-6">
								<div class="mb-2">
									<label class="form-label">User Name </label>
									<input type="text" name="user_name"  value="{{$user->user_name}}" class="form-control form-control-sm" readonly>
									<span class="text-danger kt-form__help error user_name"></span>
								</div>
							</div>
                            
                          
                            <div class="col-6">
								<div class="mb-2">
									<label class="form-label">Email</label>
                               		<input type="text" name="email"  value="{{$user->email}}"class="form-control form-control-sm" readonly>
									<span class="text-danger kt-form__help error email"></span>
								</div>
							</div>
                         
							
						</div>
						</div>
						<!-- <button type="submit" class="btn btn-primary mt-4 text-uppercase px-5">Save Changes</button> -->
					
				</div>
			</div>
	
		</div>
	</div><!-- Row end  -->

</div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{asset('public/validation/CustomerGroupValidation.js')}}"></script>

@endpush



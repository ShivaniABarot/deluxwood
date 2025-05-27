@extends(backendView('layouts.app'))

@section('title', 'Reset Password')

@section('content')
<div class="container-xxl">
	<div class="row g-3 mb-3">
		
		<div class="col-xl-12 col-lg-12">
			<div class="card mb-3">
				<div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
					<h6 class="mb-0 fw-bold ">Change Password</h6>
				</div>
				<div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @elseif (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
					<form action="{{ url('change-password') }}" method="POST" id="RestpassForm" enctype="multipart/form-data">
                    @method('PATCH')
						@csrf
					     	<div class="row g-3 align-items-center">
								<div class="col-6">
									<div class="mb-2">
										<label class="form-label">Old Password</label>
										<input type="password" name="current_password"  value="{{ old('current_password') }}" value="" class="form-control form-control-sm form-control"  >
										<span class="text-danger kt-form__help error current_password"></span>
										@error('current_password')
											<div class="text-danger">{{ $message }}</div>
										@enderror
									</div>
								</div>
							</div>
							<div class="row g-3 align-items-center">
                            <div class="col-6">
								<div class="mb-2">
									<label class="form-label">New Password</label>
									<input type="password" name="new_password"  value="{{ old('new_password') }}" class="form-control form-control-sm form-control" >
									<span class="text-danger kt-form__help error new_password"></span>
									@error('new_password')
										<div class="text-danger">{{ $message }}</div>
									@enderror
								</div>
							</div>
                            </div>
							<div class="row g-3 align-items-center">
                            <div class="col-6">
								<div class="mb-2">
									<label class="form-label">Confirm New Password</label>
									<input type="password" name="new_password_confirmation"  value=""class="form-control form-control-sm" >
									<span class="text-danger kt-form__help error new_password_confirmation"></span>
									@error('new_password_confirmation')
										<div class="text-danger">{{ $message }}</div>
									@enderror
								</div>
							</div>
                           
						</div>
						<button type="submit" class="btn btn-primary mt-4 text-uppercase px-5">Reset Password</button>
					</form>
				</div>
			</div>
	
		</div>
	</div><!-- Row end  -->

</div>
@endsection




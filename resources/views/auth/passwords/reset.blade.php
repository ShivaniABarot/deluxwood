@extends(backendView('layouts.auth'))

@section('title', 'Signin')

@section('content')
<div class="container-xxl">

	<div class="row g-0">
		<div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center rounded-lg auth-h100">
			<div style="max-width: 25rem;">
				<div class="text-center mb-5">
				<img src="{{asset('public/logo.png')}}">
				</div>
				 
				<!-- Image block -->
				<div class="">
					<img src="{!! backendAssets('dist/assets/images/login-img.svg') !!}" alt="login-img">
				</div>
			</div>
		</div>
		
		<div class="col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
		
		
	 
		<div class="w-100 p-3 p-md-5 card border-0 shadow-sm" style="max-width: 32rem;">
				<!-- Form -->
				<form class="row g-1 p-3 p-md-4" method="post" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
					<div class="col-12 text-center mb-5">
						<h2>Sign in</h2>
						<!-- <span>Free access to our dashboard.</span> -->
					</div>
					<!-- <div class="col-12 text-center mb-4">
						<a class="btn btn-lg btn-light btn-block" href="#">
							<span class="d-flex justify-content-center align-items-center">
								<img class="avatar xs me-2" src="{!! backendAssets('dist/assets/images/google.svg') !!}" alt="Image Description">
								Sign in with Google
							</span>
						</a>
						<span class="dividers text-muted mt-4">OR</span>
					</div> -->
					<div class="col-12">
						<div class="mb-2">
							<label class="form-label">Email address</label>
							<input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="name@example.com" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                            

							 @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
						</div>
					</div>
                    <div class="col-12">
						<div class="mb-2">
							<label class="form-label">Password</label>
                            <input id="password" type="password" class="form-control form-control-lg " name="password" required autocomplete="new-password">
							 <!-- @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror -->
						</div>
					</div>
                    <div class="col-12">
						<div class="mb-2">
							<label class="form-label">Confirm Password</label>
                             
                            <input id="password-confirm" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
						           

							 @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
						</div>
					</div>
					 
					<!-- <div class="col-12">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
							<label class="form-check-label" for="flexCheckDefault">
								Remember me
							</label>
						</div>
					</div> -->
					<div class="col-12 text-center mt-4">
                    <button type="submit" class="btn btn-lg btn-block btn-light text-uppercase" atl="signin"><b>Reset Password</b></button>
					</div>
					 
				</form>
				<!-- End Form -->

			</div>
		</div>
	</div> <!-- End Row -->

</div>
@endsection

@push('styles')
@endpush

@push('custom_styles')
@endpush

@push('scripts')
@endpush

@push('custom_scripts')
@endpush

@push('modals')
@endpush
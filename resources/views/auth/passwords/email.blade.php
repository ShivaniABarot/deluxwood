
@extends(backendView('layouts.auth'))

@section('title', 'Password Reset')

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
				<form class="row g-1 p-3 p-md-4" method="POST" action="{{ route('password.email') }}">
                @csrf
					<div class="col-12 text-center mb-5">
						 
						<h2>Forgot password?</h2>
						<span>Enter the email address you used when you joined and we'll send you instructions to reset your password.</span>
					</div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

					<div class="col-12">
						<div class="mb-2">
							<label class="form-label">Email address</label>
							<input type="email" class="form-control form-control-lg  @error('email') is-invalid @enderror" placeholder="name@example.com" name="email" value="{{ old('email') ?? session('email', '') }}"  required autocomplete="email" autofocus>
                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
						</div>
					</div>
					<div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-lg btn-block btn-light text-uppercase">
                            <b>{{ __('Send Password Reset Link') }}</b>
                        </button>
					</div>
                    
					<div class="col-12 text-center mt-4">
						<span class="text-muted"><a href="{{url('login')}}" class="text-secondary">Back to Sign in</a></span>
					</div>
				</form>
                
				<!-- End Form -->
                
			</div>
		</div>
	</div> <!-- End Row -->

</div>

<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection

@push('styles')
@endpush

@push('custom_styles')
@endpush

@push('scripts')
@endpush

@push('custom_scripts')
<script>
window.setTimeout( function() {
  window.location.reload();
}, 15000);
</script>
@endpush

@push('modals')
@endpush

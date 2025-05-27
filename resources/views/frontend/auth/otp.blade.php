@extends(backendView('layouts.auth'))

@section('title', 'otp')

@section('content')
<div class="container-xxl">

	<div class="row g-0">
		<div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center rounded-lg auth-h100">
			<div style="max-width: 25rem;">
				<div class="text-center mb-5">
				<img src="{{asset('public/AKUNTHA LOGO (PNG).png')}}" style="height: 120px; width: 342px;">
				</div>
				 
				<!-- Image block -->
				<div class="">
					<img src="{!! backendAssets('dist/assets/images/login-img.svg') !!}" alt="login-img">
				</div>
			</div>
		</div>
		
		<div class="col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
		
		
		<p id="message_error" style="color:red;"></p>
<p id="message_success" style="color:green;"></p>
		<div class="w-100 p-3 p-md-5 card border-0 shadow-sm" style="max-width: 32rem;">
				<!-- Form -->
				<form class="row g-1 p-3 p-md-4" method="post" id="verificationForm">
                    @csrf
					<div class="col-12 text-center mb-5">
						<h2>Sign in</h2>
						<!-- <span>Free access to our dashboard.</span> -->
					</div>
				    <div class="col-12">
						<div class="mb-2">
                        <!-- <input type="text" name="email" value="{{ $email }}"> -->
							<label class="form-label">Enter OTP</label>
                            <p class="info_cls" style="color:green">An otp has been sent to <span id="email">{{ str_repeat('*', strlen($email) - 15) . substr($email, -15)}}</span></p>
							<input type="text" class="form-control form-control-lg" placeholder="123456" name="otp" value="{{ old('email') }}" required  autofocus>
						</div>
					</div>
                   <p class="time"></p>

					
					<div class="col-12 text-center mt-4">
                    <button type="submit" class="btn btn-lg btn-block btn-light text-uppercase" atl="signin"><b>SIGN IN</b></button>
					</div>
					
					<div class="col-12 text-center mt-3">
						<span>Don't have an account yet? <a href="{{url('signup')}}" class="text-secondary">Sign up here</a></span>
					</div>
					<!--<div class="col-4 text-center mt-2"></div>
						<div class="col-4 text-center mt-2">
						<a class="text-secondary" href="{{url('password/reset')}}">Forgot Password?</a>
					</div>-->
					
					
				</form>
				<!-- End Form -->

			</div>
		</div>
	</div> <!-- End Row -->

</div>
@endsection

<!-- <button id="resendOtpVerification">Resend Verification OTP</button> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script>

    $(document).ready(function(){
        $('#verificationForm').submit(function(e){
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url:"{{ route('verifiedOtp') }}",
                type:"POST",
                data: formData,
                success:function(res){
                    if(res.success){
                        //alert(response.msg);  // Display the success message if needed
                        window.location.href = "{{url('/dashboard')}}";  // Redirect to the specified URL
                    }
                    else{
                        $('#message_error').text(res.msg);
                        setTimeout(() => {
                            $('#message_error').text('');
                        }, 3000);
                    }
                }
            });

        });

    });

    function timer()
    {
        var seconds = 30;
        var minutes = 1;

        var timer = setInterval(() => {

            if(minutes < 0){
                $('.time').text('');
                clearInterval(timer);
            }
            else{
                let tempMinutes = minutes.toString().length > 1? minutes:'0'+minutes;
                let tempSeconds = seconds.toString().length > 1? seconds:'0'+seconds;

                $('.time').text(tempMinutes+':'+tempSeconds);
            }

            if(seconds <= 0){
                minutes--;
                seconds = 59;
            }

            seconds--;

        }, 1000);
    }

    timer();

</script>

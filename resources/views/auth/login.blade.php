@extends(backendView('layouts.auth'))

@section('title', 'Sign In')

@section('content')
<div class="container-xxl">
    <div class="row g-0">
        <!-- Left Side: Logo and Image -->
        <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center rounded-lg auth-h100">
            <div style="max-width: 25rem;">
                <div class="text-center mb-5">
                    <img src="{{ asset('logo.png') }}" alt="Site Logo">
                </div>
                <div>
                    <img src="{{ asset('backend/dist/assets/images/login-img.svg') }}" alt="Login Illustration">
                </div>
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="col-lg-6 d-flex justify-content-center align-items-center auth-h100">
            <div class="w-100 p-3 p-md-5 card border-0 shadow-sm" style="max-width: 32rem;">
                <!-- Form -->
                <form class="row g-3 p-3 p-md-4" method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf
                    <div class="col-12 text-center mb-4">
                        <h2>Sign In</h2>
                        <h5 class="mt-3"><u>Framed and Frameless Line</u></h5>
                    </div>

                    <!-- Session Status/Error Messages -->
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

                    <!-- Email Field -->
                    <div class="col-12">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" 
                               placeholder="name@example.com" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Password Field with Eye Icon -->
                    <div class="col-12">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                   id="password" name="password" placeholder="***************" 
                                   required autocomplete="current-password">
                            <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- reCAPTCHA -->
                    <div class="col-12 mt-3">
                        <div class="g-recaptcha" 
                             data-sitekey="{{ config('services.recaptcha.site_key') }}" 
                             data-callback="verifyRecaptchaCallback" 
                             data-expired-callback="expiredRecaptchaCallback">
                        </div>
                        <div class="invalid-feedback captcha-error" style="display: none;">
                            Please complete the reCAPTCHA.
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12 text-center mt-4">
                        <button type="submit" class="btn btn-lg btn-primary btn-block text-uppercase" 
                                aria-label="Sign In">Sign In</button>
                    </div>

                    <!-- Links -->
                    <div class="col-12 text-center mt-3">
                        <span>Don't have an account? <a href="{{ route('register') }}" class="text-primary">Sign up</a></span>
                    </div>
                    <div class="col-12 text-center mt-2">
                        <a href="{{ route('password.request') }}" class="text-primary">Forgot Password?</a>
                    </div>
                </form>
                <!-- End Form -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <style>
        .captcha-error {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        .input-group .btn-outline-secondary {
            border-color: #ced4da;
        }
        .input-group .btn-outline-secondary:hover {
            background-color: #f8f9fa;
        }
        .input-group .btn-outline-secondary i.fas {
            color: #000000; /* Black color for eye icon */
        }
    </style>
@endpush

@push('scripts')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endpush

@push('custom_scripts')
    <script>
        let recaptchaVerified = false;
        const captchaError = document.querySelector('.captcha-error');

        // reCAPTCHA verification callback
        function verifyRecaptchaCallback(response) {
            recaptchaVerified = true;
            captchaError.style.display = 'none';
        }

        // reCAPTCHA expiration callback
        function expiredRecaptchaCallback() {
            recaptchaVerified = false;
            captchaError.style.display = 'block';
        }

        // Form submission validation
        document.getElementById('loginForm').addEventListener('submit', function (event) {
            if (!recaptchaVerified) {
                event.preventDefault();
                captchaError.style.display = 'block';
            }
        });

        // Password toggle functionality
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const toggleIcon = this.querySelector('i');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        });
    </script>
@endpush

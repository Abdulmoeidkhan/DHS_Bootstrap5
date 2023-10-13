<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>BXSS | Event Management System</title>

    <meta name="description" content="" />

    @include("layouts.header")
    <!-- Vendor -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}" />
        <!-- just remove arrow (->) to make it PWA  @->laravelPWA -->
    @livewireStyles

</head>

<body>
    <!-- Content -->

    <div class="authentication-wrapper authentication-cover">
        <!-- Logo -->
        <a href="route('signIn')" class="auth-cover-brand d-flex align-items-center gap-2">
            <!-- missing above {} -->
            <span class="app-brand-text demo text-heading fw-bold">Badar Expo Solution</span>
        </a>
        <!-- /Logo -->
        <div class="authentication-inner row m-0">
            <!-- /Left Section -->
            <div class="d-none d-lg-flex col-lg-7 col-xl-8 align-items-center justify-content-center p-5 pb-2">
                <img src="{{asset('assets/img/illustrations/auth-login-illustration-light.png')}}" class="auth-cover-illustration w-100" alt="auth-illustration" data-app-light-img="illustrations/auth-login-illustration-light.png" data-app-dark-img="illustrations/auth-login-illustration-dark.png" />
                <img src="{{asset('assets/img/illustrations/auth-cover-login-mask-light.png')}}" class="authentication-image" alt="mask" data-app-light-img="illustrations/auth-cover-login-mask-light.png" data-app-dark-img="illustrations/auth-cover-login-mask-dark.png" />
            </div>
            <!-- /Left Section -->

            <!-- Login -->
            <div class="d-flex col-12 col-lg-5 col-xl-4 align-items-center authentication-bg position-relative py-sm-5 px-4 py-4">
                <div class="w-px-400 mx-auto pt-5 pt-lg-0">
                    <img class="align-items-center authentication-bg" src="{{asset('images/icons/Badar-Logo-Black.png')}}" widht="400px" height="400px" alt="Logo" />
                    <h5 class="mb-2 fw-semibold">Welcome to Event Management System</h5>
                    <p class="mb-4">Please sign-in to your account and start the adventure</p>

                    <form id="formAuthentication" class="mb-3" action="{{route('signIn.request')}}" method="POST">
                        <!-- missing above {} -->
                        <div class="form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" autofocus />
                            <label for="email">Email</label>
                        </div>
                        <div class="mb-3">
                            <div class="form-password-toggle">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                        <label for="password">Password</label>
                                    </div>
                                    <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 d-flex justify-content-between">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember-me" />
                                <label class="form-check-label" for="remember-me"> Remember Me </label>
                            </div>
                            <a href="auth-forgot-password-cover.html" class="float-end mb-1">
                                <span>Forgot Password?</span>
                            </a>
                        </div>
                        @csrf
                        <input type="submit" name="Sign In" value="LOGIN" class="btn btn-danger d-grid w-100" style="background:#e04440;" />
                    </form>

                    <p class="text-center mt-2">
                        <span>New on our platform?</span>
                        <a href="{{route('signUp')}}">
                            <span>Register an account</span>
                        </a>
                    </p>
                    <p class="text-center mt-2">
                        <span>Need to Activate Account?</span>
                        <a href="{{route('accountActivation')}}">
                            <span>Activate Account</span>
                        </a>
                    </p>

                    <div class="divider my-4">
                        <div class="divider-text">or</div>
                    </div>

                    <div class="d-flex justify-content-center gap-2">
                        <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-facebook">
                            <i class="tf-icons mdi mdi-24px mdi-facebook"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-twitter">
                            <i class="tf-icons mdi mdi-24px mdi-twitter"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-icon btn-lg rounded-pill btn-text-github">
                            <i class="tf-icons mdi mdi-24px mdi-github"></i>
                        </a>

                        <a href="route('login.google')" class="btn btn-icon btn-lg rounded-pill btn-text-google-plus">
                            <!-- missing above {} -->
                            <i class="tf-icons mdi mdi-24px mdi-google"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Login -->
        </div>
    </div>

    <!-- / Content -->

    @include('layouts.footer')
    @livewireScripts
    <!-- Page JS -->
    <script src="{{asset('assets/js/pages-auth.js')}}"></script>
    <!-- Vendors JS -->
    <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
    
</body>

</html>
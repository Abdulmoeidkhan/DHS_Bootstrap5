@extends('layouts.layout')
@section("content")
<style>
    .gradient-class {
        background: #2BC0E4;
        background: -webkit-linear-gradient(to right, #EAECC6, #2BC0E4);
        background: linear-gradient(to right, #EAECC6, #2BC0E4);
    }
</style>
<div class="page-wrapper gradient-class" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6"
    data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div
        class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
                <div class="col-md-8 col-lg-6 col-xxl-3">
                    <div class="card mb-0"
                        style="border-radius: 30px;;box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;">
                        <div class="card-body">
                            <a href="{{route('pages.dashboard')}}"
                                class="text-nowrap logo-img text-center d-block py-3 w-100">
                                <img src="{{asset('images/icons/ideas_logo_2024.png')}}" width="180" alt="IDEAS">
                            </a>
                            <p class="text-center">Delegation Handling System</p>
                            <form action="{{route('request.activation')}}" method="POST">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                                        name="email">
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                                    <p style="text-align:right;margin-top:2px">
                                        <a class="text-badar fw-bold ms-2" href="#" id="togglePassword1">Show</a>
                                    </p>
                                    <script>
                                        const togglePassword = document
                                                .querySelector('#togglePassword1');
                                            const password = document.querySelector('#password');
                                            togglePassword.addEventListener('click', () => {
                                                // Toggle the type attribute using
                                                // getAttribure() method
                                                const type = password
                                                    .getAttribute('type') === 'password' ?
                                                    'text' : 'password';
                                                password.setAttribute('type', type);
                                                togglePassword.innerText=togglePassword.innerText !=="Show"? 'Show':'Hide'
                                            });
                                    </script>
                                </div>
                                <div class="mb-4">
                                    <label for="activationCode" class="form-label">Email OTP</label>
                                    <input type="text" class="form-control" id="activationCode" name="activationCode"
                                        placeholder="Enter your Email OTP" required />
                                </div>
                                @csrf
                                <input type="submit" name="Activation" value="Activate" value="Sign Up"
                                    class="btn btn-badar w-100 py-8 fs-4 mb-4 rounded-2" />
                            </form>
                            <div class="d-flex align-items-center justify-content-center">
                                <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                                <a class="text-badar fw-bold ms-2" href="{{route('signIn')}}">Sign In</a>
                            </div>
                            <div class="d-flex align-items-center justify-content-center">
                                <p class="fs-4 mb-0 fw-bold">New to DHS?</p>
                                <a class="text-badar fw-bold ms-2" href="{{route('signUp')}}">Create an account</a>
                            </div>
                            <livewire:otp-resend-component compName="Resend Otp" />
                            <br />
                            <img style="width:445px;width:-webkit-fill-available;"
                                src="{{asset('images/icons/Partners.png')}}" alt="Partners LOGO" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
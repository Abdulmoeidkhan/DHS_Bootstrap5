@extends('layouts.layout')
@section("content")
<!--  Body Wrapper -->
@if (session('error'))
<script>
    alert("{{session('error')}}");
</script>
@endif
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
                <div class="col-md-8 col-lg-6 col-xxl-3">
                    <div class="card mb-0">
                        <div class="card-body">
                            <a href="{{route('dashboard')}}" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                <img src="{{asset('images/icons/Badar-Logo-Black.png')}}" width="180" alt="">
                            </a>
                            <p class="text-center">Delegation Handling System</p>
                            <form action="{{route('activation.request')}}" method="POST">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                                </div>
                                <div class="mb-4">
                                    <label for="activationCode" class="form-label">Activation Code</label>
                                    <input type="text" class="form-control" id="activationCode" name="activationCode" placeholder="Enter your Activation Code" />
                                </div>
                                @csrf
                                <input type="submit" name="Activation" value="Activate" value="Sign Up" class="btn btn-badar w-100 py-8 fs-4 mb-4 rounded-2" />
                                <div class="d-flex align-items-center justify-content-center">
                                    <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                                    <a class="text-badar fw-bold ms-2" href="{{route('signIn')}}">Sign In</a>
                                </div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <p class="fs-4 mb-0 fw-bold">New to DHS?</p>
                                    <a class="text-badar fw-bold ms-2" href="{{route('signUp')}}">Create an account</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
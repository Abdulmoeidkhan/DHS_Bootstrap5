@extends('layouts.layout')
@section("content")
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
  <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
    <div class="d-flex align-items-center justify-content-center w-100">
      <div class="row justify-content-center w-100">
        <div class="col-md-8 col-lg-6 col-xxl-3">
          <div class="card mb-0">
            <div class="card-body">
              <a href="{{route('pages.dashboard')}}" class="text-nowrap logo-img text-center d-block py-3 w-100">
                <img src="{{asset('images/icons/Badar-Logo-Black.png')}}" width="180" alt="">
              </a>
              <p class="text-center">Delegation Handling System</p>
              <form action="{{route('request.signIn')}}" method="POST">
                <div class="mb-3">
                  <label for="email" class="form-label">Email Address</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" autofocus aria-describedby="emailHelp">
                </div>
                <div class="mb-4">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="d-flex align-items-center justify-content-between mb-4">
                  <div class="form-check">
                    <input class="form-check-input badar" type="checkbox" value="" id="flexCheckChecked" checked>
                    <label class="form-check-label text-dark" for="flexCheckChecked">
                      Remeber this Device
                    </label>
                  </div>
                  <a class="text-badar fw-bold" href="#">Forgot Password ?</a>
                </div>
                @csrf
                <input type="submit" name="Sign In" value="Sign In" class="btn btn-badar w-100 py-8 fs-4 mb-4 rounded-2" />
                <div class="d-flex align-items-center justify-content-center">
                  <p class="fs-4 mb-0 fw-bold">New to DHS?</p>
                  <a class="text-badar fw-bold ms-2" href="{{route('signUp')}}">Create an account</a>
                </div>
                <div class="d-flex align-items-center justify-content-center">
                  <p class="fs-4 mb-0 fw-bold">Activate Account?</p>
                  <a class="text-badar fw-bold ms-2" href="{{route('accountActivation')}}">Activate</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@auth
@extends('layouts.layout')
@section("content")
<div class="container-fluid">
    @if(session('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <div>{{session('message')}}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div>{{session('error')}}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div id="liveAlertPlaceholder"></div>
    <div class="row">
        <div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Profile Information</h5>
                    <div class="table-responsive">
                        <form name="profileActivation" id="profileActivation" method="POST" action="{{route('request.activateProfile')}}">
                            <fieldset>
                                <legend>Profile Activation</legend>
                                @csrf
                                <div class="mb-3">
                                    <label for="activationCode" class="form-label">Activation Code</label>
                                    <input type="text" name="activationCode" class="form-control" id="activationCode" placeholder="Activation Code" required>
                                </div>
                                <input type="hidden" name="uid" value="{{$user->uid}}" />
                                <input type="submit" name="submit" class="btn btn-success" value="Activate" />
                            </fieldset>
                        </form>
                    </div>
                    <script async src="https://unpkg.com/axios/dist/axios.min.js"></script>
                    <script async src="{{asset('assets/js/formValidations.js')}}"></script>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@endauth
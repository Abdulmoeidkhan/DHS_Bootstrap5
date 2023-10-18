@auth
@extends('layouts.layout')
@section("content")
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <div class="mb-4">
                        <h5 class="card-title fw-semibold">Profile Picture</h5>
                    </div>
                    <!-- <img src="asset('assets/images/profile/user-1.jpg')" width="200px" height="200px" class="rounded mx-auto d-block" alt="User Profile Picture"> -->
                    <img src="{{$user->images?$user->images->base64_image:($user->avatar?$user->avatar:asset('assets/images/profile/user-1.jpg'))}}" width="200px" height="200px" class="rounded mx-auto d-block" alt="User Profile Picture">
                    <br />
                    <form action="{{route('request.imageUpload')}}" method="post" enctype="multipart/form-data">
                        <div class="input-group">
                            <input type="hidden" value="{{$user->uid}}" name="id" />
                            <input type="file" class="form-control" id="uploadFile" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="image" accept="image/png, image/jpeg" required>
                            <button class="btn btn-outline-danger" type="submit">Upload</button>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Profile Information</h5>
                    <div class="table-responsive">
                        <form name="userBasicInfo" id="userBasicInfo" method="POST" action="#" >
                            @csrf
                            <div class="mb-3">
                                <label for="disabledInputEmail1" class="form-label">Registered Email Address</label>
                                <input type="email" class="form-control" id="disabledInputEmail1" placeholder="Registered Email Address" aria-describedby="emailHelp" value="{{$user->email}}" disabled>
                                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                            </div>
                            <div class="mb-3">
                                <label for="inputUserName" class="form-label">Your User Name</label>
                                <input type="text" class="form-control" id="inputUserName" placeholder="User Name" aria-describedby="userHelp" value="{{$user->name}}" minlength="3" maxlength="20" required>
                            </div>
                            <div class="mb-3">
                                <label for="inputContactNumber" class="form-label">Your Contact Number</label>
                                <input type="number" class="form-control" id="inputContactNumber" placeholder="Contact Number" aria-describedby="userHelp" value="{{$user->contact_number}}" minlength="3" maxlength="20" required>
                            </div>
                            <div class="mb-3">
                                <label for="userInputPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="userInputPassword" placeholder="Password">
                            </div>
                            <div class="mb-3">
                                <label for="userInputPasswordConfirm" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="userInputPasswordConfirm" placeholder="Confirm Password">
                            </div>
                            <!-- <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                            </div>
                            <div class="mb-3">
                                <label for="disabledTextInput" class="form-label">Disabled input</label>
                                <input type="text" id="disabledTextInput" class="form-control" placeholder="Disabled input">
                            </div>
                            <div class="mb-3">
                                <label for="disabledSelect" class="form-label">Disabled select menu</label>
                                <select id="disabledSelect" class="form-select">
                                    <option>Disabled select</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="disabledFieldsetCheck" disabled>
                                    <label class="form-check-label" for="disabledFieldsetCheck">
                                        Can't check this
                                    </label>
                                </div>
                            </div>
                            <fieldset disabled>
                                <legend>Profile View Information Only</legend>
                                <div class="mb-3">
                                    <label for="disabledInputEmail1" class="form-label">Registered Email Address</label>
                                    <input type="email" class="form-control" id="disabledInputEmail1" placeholder="Registered Email Address" aria-describedby="emailHelp" value="{{$user->email}}" disabled>
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                </div>
                            </fieldset> -->
                            <input type="hidden" value="{{$user->uid}}"/>
                            <input type="submit" class="btn btn-primary" value="Submit" />
                        </form>
                        <script async src="{{asset('assets/js/formValidations.js')}}"></script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endauth
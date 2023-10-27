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
                        <form name="userBasicInfo" id="userBasicInfo">
                            <fieldset>
                                <legend>Generarl Information</legend>
                                @csrf
                                <div class="mb-3">
                                    <label for="disabledInputEmail1" class="form-label">Registered Email Address</label>
                                    <input name="disabledInputEmail1" type="email" class="form-control" id="disabledInputEmail1" placeholder="Registered Email Address" aria-describedby="emailHelp" value="{{$user->email}}" disabled>
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="inputUserName" class="form-label">Your User Name</label>
                                    <input name="inputUserName" type="text" class="form-control" id="inputUserName" placeholder="User Name" aria-describedby="userHelp" value="{{$user->name}}" minlength="3" maxlength="20" required>
                                </div>
                                <div class="mb-3">
                                    <label for="inputContactNumber" class="form-label">Your Contact Number</label>
                                    <input type="number" name="inputContactNumber" class="form-control" id="inputContactNumber" placeholder="Contact Number" aria-describedby="userHelp" value="{{$user->contact_number}}" minlength="3" maxlength="20" required>
                                </div>
                                <input type="hidden" name="uid" value="{{$delegate->uid}}" />
                                <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                            </fieldset>
                        </form>
                    </div>
                    <br />
                    <div class="table-responsive">
                        <form name="userPasswordInfo" id="userPasswordInfo">
                            <fieldset>
                                <legend>Password Information</legend>
                                @csrf
                                <div class="mb-3">
                                    <label for="userInputPassword" class="form-label">Password</label>
                                    <input type="password" name="userInputPassword" onkeypress="checkPasswordStrength(this)" class="form-control" id="userInputPassword" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                </div>
                                <div class="mb-3">
                                    <label for="userInputPasswordConfirm" class="form-label">Confirm Password</label>
                                    <input type="password" name="userInputPasswordConfirm" onkeypress="checkPasswordStrength(this)" class="form-control" id="userInputPasswordConfirm" placeholder="Confirm Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                </div>
                            </fieldset>
                            <input type="hidden" name="uid" value="{{$user->uid}}" />
                            <input type="submit" name="submit" class="btn btn-badar" value="Change" />
                        </form>
                    </div>
                    <br />
                    <div class="table-responsive">
                        <form name="userPermissionAndRolesInfo" id="userPermissionAndRolesInfo">
                            <fieldset <?php echo $user->uid === auth()->user()->uid ? 'disabled' : '' ?>>
                                <legend>Permissions & Roles</legend>
                                @csrf
                                <div class="mb-3">
                                    <label for="roleSelect" class="form-label">Roles</label>
                                    <select id="roleSelect" name="roles" class="form-select" <?php echo $user->uid === auth()->user()->uid ? 'disabled' : ($user->roles[0]->name == "delegate" ? 'disabled' : ''); ?>>
                                        @foreach($roles as $role)
                                        <option value="{{$role->name}}" <?php echo $user->roles[0]->name === $role->name ? 'selected' : '' ?>>{{$role->display_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <div class="form-label">Permissions</div>

                                    @foreach($permissions as $permission)
                                    <div class="form-check">
                                        <input class="form-check-input text-capitalize" type="checkbox" name="{{$permission->name}}" id="{{$permission->name}}" <?php echo $user->uid === auth()->user()->uid ? 'disabled' : '' ?> <?php
                                                                                                                                                                                                                                    foreach ($user->permissions as $userPermission) {
                                                                                                                                                                                                                                        echo $permission->name === $userPermission->name ? 'checked' : '';
                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                    ?> />
                                        <label class="form-check-label" for="{{$permission->name}}">
                                            {{$permission->display_name}}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </fieldset>

                            <input type="hidden" name="uid" value="{{$user->uid}}" />
                            <input type="submit" name="submit" class="btn btn-danger" value="Authorise" />
                        </form>
                    </div>
                    <!-- <br />
                    <h5 class="card-title fw-semibold mb-4">Profile Information</h5>
                    <div class="table-responsive">
                        <form name="profileActivation" id="profileActivation" method="POST" action="{{route('request.activateProfile')}}">
                            <fieldset>
                                <legend>Profile Activation</legend>
                                @csrf
                                <div class="mb-3">
                                    <label for="prefixSelect" class="form-label">Prefix</label>
                                    <select id="prefixSelect" name="prefixSelect" class="form-select">
                                        <option value="DL" selected>DL</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="activationCode" class="form-label">Activation Code</label>
                                    <input type="number" name="activationCode" class="form-control" id="activationCode" placeholder="Activation Number (Please do not put code (DL,LO) in this field )" required>
                                </div>
                                <input type="hidden" name="uid" value="{{$user->uid}}" />
                                <input type="submit" name="submit" class="btn btn-success" value="Activate" />
                            </fieldset>
                        </form>
                    </div> -->
                    <script async src="https://unpkg.com/axios/dist/axios.min.js"></script>
                    <script async src="{{asset('assets/js/formValidations.js')}}"></script>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@endauth
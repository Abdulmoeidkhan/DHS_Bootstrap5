@auth
@extends('layouts.layout')
@section("content")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.4/cropper.min.css'>
<style>
    .box,
    .box-representatives {
        padding: 0.5em;
        width: 100%;
        margin: 0.5em;
    }

    .box-2,
    .box-2-representatives {
        padding: 0.5em;
        width: calc(100%/2 - 1em);
    }

    .hide,
    .hide-representatives {
        display: none;
    }

    img {
        max-width: 100%;
    }
</style>
<div id="liveAlertPlaceholder"></div>
<div class="row">
    <div class="col-lg-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="mb-4">
                    <h5 class="card-title fw-semibold">Profile Picture</h5>
                </div>
                <!-- <img src="asset('assets/images/profile/user-1.jpg')" width="200px" height="200px" class="rounded mx-auto d-block" alt="User Profile Picture"> -->
                <img src="{{$user->images?$user->images->img_blob:($user->avatar?$user->avatar:asset('assets/images/profile/user-1.jpg'))}}" width="200px" height="200px" class="rounded mx-auto d-block" alt="User Profile Picture">
                <br />
                <form action="{{route('request.imageUpload')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group">
                        <input type="hidden" value="{{$user->uid}}" name="id" />
                        <!-- <input type="file" class="form-control" id="uploadFile" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="image" accept="image/png, image/jpeg" required>
                        <button class="btn btn-outline-danger" type="submit">Upload</button> -->
                    </div>
                    <div class="mb-3">
                        <label for="delegation_picture" class="form-label">Picture</label>
                        <input name="delegation_picture" type="file" class="form-control" id="delegation_picture" accept="image/png, image/jpeg">
                        <input name="savedpicture" type="hidden" class="form-control" id="savedpicture" value="">
                        <div class="box-2">
                            <div class="result"></div>
                        </div>
                        <div class="box-2 img-result {{isset($delegationHead->delegation_picture) ? ($delegationHead?->delegation_picture?->img_blob ? '' : 'hide') : ''}}">
                            <img class="cropped" src="{{isset($delegationHead->delegation_picture)? $delegationHead?->delegation_picture?->img_blob:''}}" alt="" />
                        </div>
                        <div class="box">
                            <div class="options hide">
                                <label>Width</label>
                                <input type="number" class="img-w" value="300" min="100" max="1200" />
                            </div>
                            <button class="btn save hide">Save</button>
                        </div>
                        <button class="btn btn-outline-danger" type="submit">Upload</button>
                    </div>
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
                            <input type="hidden" name="uid" value="{{$user->uid}}" />
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
                            <input type="hidden" name="uid" value="{{$user->uid}}" />
                            <input type="submit" name="submit" class="btn btn-badar" value="Change" />
                        </fieldset>
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
                                @if($user->roles[0]->name == "delegate" || $user->roles[0]->name == "liason" || $user->roles[0]->name == "interpreter" || $user->roles[0]->name == "receiving" || $user->roles[0]->name == "hotels" || $user->roles[0]->name == "airport" || $user->roles[0]->name == "vendor")
                                <select id="roleSelect" name="roles" class="form-select" <?php echo $user->uid === auth()->user()->uid ? 'disabled' : ($user->roles[0]->name == "delegate" || $user->roles[0]->name == "liason" || $user->roles[0]->name == "interpreter" || $user->roles[0]->name == "receiving" || $user->roles[0]->name == "hotels" || $user->roles[0]->name == "airport" || $user->roles[0]->name == "vendor" ? 'disabled' : ''); ?>>
                                    @foreach($roles as $role)
                                    <option value="{{$role->name}}" <?php echo $user->roles[0]->name === $role->name ? 'selected' : '' ?>>{{$role->display_name}}</option>
                                    @endforeach
                                </select>
                                @else
                                <select id="roleSelect" name="roles" class="form-select">
                                    @foreach($selectiveRoles as $selectiveRole)
                                    <option value="{{$selectiveRole->name}}" <?php echo $user->roles[0]->name === $selectiveRole->name ? 'selected' : '' ?>>{{$selectiveRole->display_name}}</option>
                                    {{$selectiveRole->name}}
                                    @endforeach
                                </select>
                                @endif
                            </div>
                            <!-- <div class="mb-3"> 
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
                            </div>-->

                            <input type="hidden" name="uid" value="{{$user->uid}}" />
                            <input type="submit" name="submit" class="btn btn-danger" value="Authorise" />
                        </fieldset>
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
<script src='https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.8.1/cropper.min.js'></script>
<script>
    // vars
    let result = document.querySelector('.result'),
        img_result = document.querySelector('.img-result'),
        save = document.querySelector('.save'),
        cropped = document.querySelector('.cropped'),
        img_w = document.querySelector('.img-w'),
        dwn = document.querySelector('.download'),
        upload = document.querySelector('#delegation_picture'),
        cropper = '';

    // on change show image with crop options
    upload.addEventListener('change', e => {
        if (e.target.files.length) {
            // start file reader
            const reader = new FileReader();
            reader.onload = e => {
                if (e.target.result) {
                    // create new image
                    let img = document.createElement('img');
                    img.id = 'image';
                    img.src = e.target.result;
                    // clean result before
                    result.innerHTML = '';
                    // append new image
                    result.appendChild(img);
                    // show save btn and options
                    save.classList.remove('hide');
                    // options.classList.remove('hide');
                    // init cropper
                    cropper = new Cropper(img);
                }
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    // save on click
    save.addEventListener('click', e => {
        e.preventDefault();
        // get result to data uri
        let imgSrc = cropper.getCroppedCanvas({
            width: img_w.value // input value
        }).toDataURL();
        // remove hide class of img
        cropped.classList.remove('hide');
        img_result.classList.remove('hide');
        // show image cropped
        cropped.src = imgSrc;
        document.getElementById('savedpicture').value = imgSrc;
        dwn.classList.remove('hide');
        dwn.download = 'imagename.png';
        dwn.setAttribute('href', imgSrc);
    });
</script>
<script>
    // vars
    let result_representatives = document.querySelector('.result-representatives'),
        img_result_representatives = document.querySelector('.img-result-representatives'),
        save_representatives = document.querySelector('.save-representatives'),
        cropped_representatives = document.querySelector('.cropped-representatives'),
        img_w_representatives = document.querySelector('.img-w-representatives'),
        dwn_representatives = document.querySelector('.download-representatives'),
        upload_representatives = document.querySelector('#rep_picture'),
        cropper_representatives = '';

    // on change show image with crop options
    upload_representatives.addEventListener('change', e => {
        if (e.target.files.length) {
            // start file reader
            const reader = new FileReader();
            reader.onload = e => {
                if (e.target.result) {
                    // create new image
                    let img = document.createElement('img');
                    img.id = 'image';
                    img.src = e.target.result;
                    // clean result before
                    result_representatives.innerHTML = '';
                    // append new image
                    result_representatives.appendChild(img);
                    // show save btn and options
                    save_representatives.classList.remove('hide-representatives');
                    // options.classList.remove('hide');
                    // init cropper
                    cropper_representatives = new Cropper(img);
                }
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    // save on click
    save_representatives.addEventListener('click', e => {
        e.preventDefault();
        // get result to data uri
        let imgSrc = cropper_representatives.getCroppedCanvas({
            width: img_w_representatives.value // input value
        }).toDataURL();
        // remove hide class of img
        cropped_representatives.classList.remove('hide-representatives');
        img_result_representatives.classList.remove('hide-representatives');
        // show image cropped
        cropped_representatives.src = imgSrc;
        document.getElementById('rep_saved_picture').value = imgSrc;
        dwn_representatives.classList.remove('hide-representatives');
        dwn_representatives.download = 'imagename.png';
        dwn_representatives.setAttribute('href', imgSrc);
    });
</script>
@endsection
@endauth
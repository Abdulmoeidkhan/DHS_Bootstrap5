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
                        <h5 class="card-title fw-semibold">Member Picture</h5>
                    </div>
                    <img src="{{$delegateImage?$delegateImage->base64_image:asset('assets/images/profile/user-1.jpg')}}" width="200px" height="200px" class="rounded mx-auto d-block" alt="Member Profile Picture">
                    <br />
                    <form action="{{route('request.imageUpload')}}" method="post" enctype="multipart/form-data">
                        <div class="input-group">
                            <input type="hidden" value="{{$delegate->uid}}" name="id" />
                            <input type="file" class="form-control" id="uploadFile" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="image" accept="image/png, image/jpeg" required>
                            <button class="btn btn-outline-danger" type="submit">Upload</button>
                        </div>
                        @csrf
                    </form>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <h5 class="card-title fw-semibold">Representative Picture</h5>
                    </div>
                    <img src="{{$repImage?$repImage->base64_image:asset('assets/images/profile/user-1.jpg')}}" width="200px" height="200px" class="rounded mx-auto d-block" alt="User Profile Picture">
                    <br />
                    <form action="{{route('request.imageUpload')}}" method="post" enctype="multipart/form-data">
                        <div class="input-group">
                            <input type="hidden" value="{{$delegate->rep_uid}}" name="id" />
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
                    <h5 class="card-title fw-semibold mb-4">Member Information</h5>
                    <div class="table-responsive">
                        <form name="delegationInfo" id="delegationInfo" method="POST" action="{{route('request.updateDelegation')}}">
                            <fieldset>
                                <legend>Member Information</legend>
                                @csrf
                                <div class="mb-3">
                                    <label for="first_Name" class="form-label">Member First Name</label>
                                    <input name="first_Name" type="text" class="form-control" id="first_Name" placeholder="First Name" value="{{$delegate->first_Name}}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="last_Name" class="form-label">Member Last Name</label>
                                    <input name="last_Name" type="text" class="form-control" id="last_Name" placeholder="Last Name" value="{{$delegate->last_Name}}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="designation" class="form-label">Designation</label>
                                    <input name="designation" type="text" class="form-control" id="designation" placeholder="Designation" value="{{$delegate->designation}}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="organistaion" class="form-label">Organistaion</label>
                                    <input name="organistaion" type="text" class="form-control" id="organistaion" placeholder="Organistaion" value="{{$delegate->organistaion}}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="passport" class="form-label">Passport</label>
                                    <input name="passport" type="text" class="form-control" id="passport" placeholder="Passport" value="{{$delegate->passport}}">
                                </div>
                                <div class="mb-3">
                                    <input class="form-check-input" type="radio" name="self" id="self" value="1" <?php echo $delegate->self ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="self">
                                        Self
                                    </label>
                                </div>
                                <div class="mb-3">
                                    <input class="form-check-input" type="radio" name="self" id="rep" value="0" <?php echo !$delegate->self ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="rep">
                                        Representative
                                    </label>
                                </div>
                                <div class="mb-3">
                                    <label for="rep_first_Name" class="form-label">Representative First Name</label>
                                    <input name="rep_first_Name" type="text" class="form-control" id="rep_first_Name" placeholder="Representative First Name" value="{{$delegate->rep_first_Name}}">
                                </div>
                                <div class="mb-3">
                                    <label for="rep_last_Name" class="form-label">Representative Last Name</label>
                                    <input name="rep_last_Name" type="text" class="form-control" id="rep_last_Name" placeholder="Representative Last Name" value="{{$delegate->rep_last_Name}}">
                                </div>
                                <input type="hidden" name="uid" value="{{$delegate->uid}}" />
                                <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                            </fieldset>
                        </form>
                    </div>
                    <br />
                </div>
            </div>
        </div>
    </div>
    <?php echo $delegate->country ? '<script id="scriptElement">document.getElementById("country").value="' . $delegate->country . '";document.getElementById("scriptElement").remove()</script>' : ''; ?>
</div>
@endsection
@endauth
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
                    <img src="{{$member->image?$member->image->base64_image:asset('assets/images/profile/user-1.jpg')}}" width="200px" height="200px" class="rounded mx-auto d-block" alt="Member Profile Picture">
                    <br />
                    <form action="{{route('request.imageUpload')}}" method="post" enctype="multipart/form-data">
                        <div class="input-group">
                            <input type="hidden" value="{{$member->member_uid}}" name="id" />
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
                        <form name="memberInfo" id="memberInfo" method="POST" action="#">
                            <fieldset>
                                <legend>Member Information</legend>
                                @csrf
                                <div class="mb-3">
                                    <label for="member_rank" class="form-label">Member First Name</label>
                                    <input name="member_rank" type="text" class="form-control" id="member_rank" placeholder="Rank" value="{{$member->member_rank}}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="member_first_Name" class="form-label">Member First Name</label>
                                    <input name="member_first_Name" type="text" class="form-control" id="member_first_Name" placeholder="First Name" value="{{$member->member_first_Name}}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="member_last_Name" class="form-label">Member Last Name</label>
                                    <input name="member_last_Name" type="text" class="form-control" id="member_last_Name" placeholder="Last Name" value="{{$member->last_Name}}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="member_designation" class="form-label">Designation</label>
                                    <input name="member_designation" type="text" class="form-control" id="member_designation" placeholder="Designation" value="{{$member->member_designation}}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="member_organistaion" class="form-label">Organistaion</label>
                                    <input name="member_organistaion" type="text" class="form-control" id="member_organistaion" placeholder="Organistaion" value="{{$member->member_organistaion}}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="passport" class="form-label">Passport</label>
                                    <input name="passport" type="text" class="form-control" id="passport" placeholder="Passport" value="{{$member->passport}}">
                                </div>
                                <input type="hidden" name="uid" value="{{$member->uid}}" />
                                <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                            </fieldset>
                        </form>
                    </div>
                    <br />
                </div>
            </div>
        </div>
    </div>
    <?php echo $member->country ? '<script id="scriptElement">document.getElementById("country").value="' . $member->country . '";document.getElementById("scriptElement").remove()</script>' : ''; ?>
</div>
@endsection
@endauth
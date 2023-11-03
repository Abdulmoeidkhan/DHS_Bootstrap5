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
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">New Member</h5>
                    <div class="table-responsive">
                        <form name="memberBasicInfo" id="memberBasicInfo" method="POST" action="{{route('request.addMemberRequest',$id)}}" enctype="multipart/form-data">
                            <fieldset>
                                <legend>Add Members Form</legend>
                                @csrf
                                <div class="mb-3">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input name="firstName" type="text" class="form-control" id="firstName" placeholder="First Name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input name="lastName" type="text" class="form-control" id="lastName" placeholder="Last Name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="designation" class="form-label">Designation</label>
                                    <input name="designation" type="text" class="form-control" id="designation" placeholder="Designation" required>
                                </div>
                                <div class="mb-3">
                                    <label for="organistaion" class="form-label">Organisation</label>
                                    <input name="organistaion" type="text" class="form-control" id="organistaion" placeholder="Organisation" required>
                                </div>
                                <div class="mb-3">
                                    <label for="rank" class="form-label">Rank</label>
                                    <input name="rank" type="text" class="form-control" id="rank" placeholder="Rank" required>
                                </div>
                                <div class="mb-3">
                                    <label for="passport" class="form-label">Passport</label>
                                    <input name="passport" type="text" class="form-control" id="passport" placeholder="Passport" required>
                                </div>
                                <div class="mb-3">
                                    <label for="picture" class="form-label">Picture</label>
                                    <input name="picture" type="file" class="form-control" id="picture" accept="image/png, image/jpeg" required>
                                </div>
                                <input name="delegation" type="hidden" id="delegation" value="{{$id}}" required>
                                <input type="submit" name="submit" class="btn btn-primary" value="Add Member" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@endauth
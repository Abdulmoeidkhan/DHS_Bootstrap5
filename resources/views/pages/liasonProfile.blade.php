@auth
@extends('layouts.layout')
@section("content")

<div id="liveAlertPlaceholder"></div>
<div class="row">
    @if($liason->liason_officer)
    <div class="col-lg-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="mb-4">
                    <h5 class="card-title fw-semibold">Liason Picture</h5>
                </div>
                <img src="{{$liason->image?$liason->image->base64_image:asset('assets/images/profile/user-1.jpg')}}" width="200px" height="200px" class="rounded mx-auto d-block" alt="Liason Profile Picture">
                <br />
                <form action="{{session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'liason' ?route('request.imageUpload'):''}}" method="POST" enctype="multipart/form-data">
                    <fieldset <?php echo session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'liason' ? '' : 'disabled' ?>>
                        <div class="input-group">
                            <input type="hidden" value="{{$liason->liason_officer}}" name="id" />
                            <input type="file" class="form-control" id="uploadFile" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="image" accept="image/png, image/jpeg" required>
                            <button class="btn btn-outline-danger" type="submit">Upload</button>
                        </div>
                        @csrf
                </form>
            </div>
        </div>
    </div>
    @else
    <div class="col-lg-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="mb-4">
                    <h5 class="card-title fw-semibold ">Liason Does Not Active His/Her Profile yet</h5>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="col-lg-8 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Liason Information</h5>
                <div class="table-responsive">
                    <form name="liasonInfo" id="liasonInfo" method="POST" action="{{session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'liason' ?route('request.updateLiasonRequest',$liason->liason_uid):''}}">
                        <fieldset <?php echo session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'liason' ? '' : 'disabled' ?>>
                            <legend>Liason Information</legend>
                            @csrf
                            <div class="mb-3">
                                <label for="liason_rank" class="form-label">Liason Rank</label>
                                <select name="liason_rank" id="liason_rank" class="form-select">
                                    <option value="" selected disabled hidden> Select Rank </option>
                                    @foreach (\App\Models\Rank::all() as $renderRank)
                                    <option value="{{$renderRank->ranks_uid}}" <?php echo $liason->liason_rank == $renderRank->ranks_uid ? 'selected' : '' ?>>{{$renderRank->ranks_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="liason_first_Name" class="form-label">Liason First Name</label>
                                <input name="liason_first_Name" type="text" class="form-control" id="liason_first_Name" placeholder="First Name" value="{{$liason->liason_first_name}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="liason_last_Name" class="form-label">Liason Last Name</label>
                                <input name="liason_last_Name" type="text" class="form-control" id="liason_last_Name" placeholder="Last Name" value="{{$liason->liason_last_name}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="liason_designation" class="form-label">Designation</label>
                                <input name="liason_designation" type="text" class="form-control" id="liason_designation" placeholder="Designation" value="{{$liason->liason_designation}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="liason_contact" class="form-label">Contact</label>
                                <input name="liason_contact" type="text" class="form-control" id="liason_contact" placeholder="Liason Contact Number" value="{{$liason->liason_contact}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="liason_identity" class="form-label">Passport</label>
                                <input name="liason_identity" type="text" class="form-control" id="liason_identity" placeholder="Passport" value="{{$liason->liason_identity}}">
                            </div>
                            <input type="hidden" name="liason_uid" value="{{$liason->liason_uid}}" />
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                        </fieldset>
                    </form>
                </div>
                <br />
            </div>
        </div>
    </div>
</div>
@endsection
@endauth
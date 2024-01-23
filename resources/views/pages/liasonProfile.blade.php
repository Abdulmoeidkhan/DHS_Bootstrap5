@auth
@extends('layouts.layout')
@section("content")

<div id="liveAlertPlaceholder"></div>
<div class="row">
    @if($officer->officer_uid)
    <div class="col-lg-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="mb-4">
                    <h5 class="card-title fw-semibold">Officer Picture</h5>
                </div>
                <img src="{{$officer->image?$officer->image->img_blob:asset('assets/images/profile/user-1.jpg')}}" width="200px" height="200px" class="rounded mx-auto d-block" alt="Liason Profile Picture">                <br />
                <form action="{{session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'liason' ?route('request.imageUpload'):''}}" method="POST" enctype="multipart/form-data">
                    <fieldset <?php echo session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'liason' ? '' : 'disabled' ?>>
                        <div class="input-group">
                            <input type="hidden" value="{{$officer->officer_uid}}" name="id" />
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
                    <form name="liasonInfo" id="liasonInfo" method="POST" action="{{session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'liason' ?route('request.updateOfficerRequest',$officer->officer_uid):''}}">
                        <fieldset <?php echo session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'liason' ? '' : 'disabled' ?>>
                            <legend>Liason Information</legend>
                            @csrf
                            <div class="mb-3">
                                <label for="officer_rank" class="form-label">Liason Rank</label>
                                <select name="officer_rank" id="officer_rank" class="form-select">
                                    <option value="" selected disabled hidden> Select Rank </option>
                                    @foreach (\App\Models\Rank::all() as $renderRank)
                                    <option value="{{$renderRank->ranks_uid}}" <?php echo $officer->officer_rank == $renderRank->ranks_uid ? 'selected' : '' ?>>{{$renderRank->ranks_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="officer_first_name" class="form-label">Liason First Name</label>
                                <input name="officer_first_name" type="text" class="form-control" id="officer_first_name" placeholder="First Name" value="{{$officer->officer_first_name}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="officer_first_name" class="form-label">Liason Last Name</label>
                                <input name="officer_first_name" type="text" class="form-control" id="officer_first_name" placeholder="Last Name" value="{{$officer->officer_last_name}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="officer_designation" class="form-label">Designation</label>
                                <input name="officer_designation" type="text" class="form-control" id="officer_designation" placeholder="Designation" value="{{$officer->officer_designation}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="officer_contact" class="form-label">Contact</label>
                                <input name="officer_contact" type="text" class="form-control" id="officer_contact" placeholder="Liason Contact Number" value="{{$officer->officer_contact}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="officer_identity" class="form-label">Passport</label>
                                <input name="officer_identity" type="text" class="form-control" id="officer_identity" placeholder="Passport" value="{{$officer->officer_identity}}">
                            </div>
                            <input type="hidden" name="officer_uid" value="{{$officer->officer_uid}}" />
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
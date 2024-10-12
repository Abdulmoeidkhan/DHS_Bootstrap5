@auth
@extends('layouts.layout')
@section("content")

<div id="liveAlertPlaceholder"></div>
<div class="row">

    @if($receiving->receiving_officer)
    <div class="col-lg-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="mb-4">
                    <h5 class="card-title fw-semibold">Receiving Officer Picture</h5>
                </div>
                <img src="{{$receiving->image?$receiving->image->base64_image:asset('assets/images/profile/user-1.jpg')}}" width="200px" height="200px" class="rounded mx-auto d-block" alt="Receiving Officer Profile Picture">
                <br />
                <form action="{{session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'receiving' ?route('request.imageUpload'):''}}" method="POST" enctype="multipart/form-data">
                    <fieldset <?php echo session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'receiving' ? '' : 'disabled' ?>>
                        <div class="input-group">
                            <input type="hidden" value="{{$receiving->receiving_officer}}" name="id" />
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
                    <h5 class="card-title fw-semibold ">Receiving Officer Does Not Active His/Her Profile yet</h5>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="col-lg-8 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Receiving Officer Information</h5>
                <div class="table-responsive">
                    <form name="ReceivingInfo" id="ReceivingInfo" method="POST" action="{{session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'receiving' ?route('request.updateReceivingRequest',$receiving->receiving_uid):''}}">
                        <fieldset <?php echo session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'Receiving' ? '' : 'disabled' ?>>
                            <legend>Receiving Officer Information</legend>
                            @csrf
                            <div class="mb-3">
                                <label for="receiving_rank" class="form-label">Receiving Officer Rank</label>
                                <select name="receiving_rank" id="receiving_rank" class="form-select">
                                    <option value="" selected disabled hidden> Select Rank </option>
                                    @foreach (\App\Models\Rank::all() as $renderRank)
                                    <option value="{{$renderRank->ranks_uid}}" <?php echo $receiving->receiving_rank == $renderRank->ranks_uid ? 'selected' : '' ?>>{{$renderRank->ranks_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                </div>
                <div class="mb-3">
                    <label for="receiving_first_Name" class="form-label">Receiving Officer First Name</label>
                    <input name="receiving_first_Name" type="text" class="form-control" id="receiving_first_Name" placeholder="First Name" value="{{$receiving->receiving_first_name}}" required>
                </div>
                <div class="mb-3">
                    <label for="receiving_last_Name" class="form-label">Receiving Officer Last Name</label>
                    <input name="receiving_last_Name" type="text" class="form-control" id="receiving_last_Name" placeholder="Last Name" value="{{$receiving->receiving_last_name}}" required>
                </div>
                <div class="mb-3">
                    <label for="receiving_designation" class="form-label">Designation</label>
                    <input name="receiving_designation" type="text" class="form-control" id="receiving_designation" placeholder="Designation" value="{{$receiving->receiving_designation}}" required>
                </div>
                <div class="mb-3">
                    <label for="contact" class="form-label">Contact</label>
                    <input name="receiving_contact" type="text" minlength='0' maxlength='14' class="form-control" id="contact" placeholder="Receiving Officer Contact Number" value="{{$receiving->receiving_contact}}" required>
                </div>
                <div class="mb-3">
                    <label for="receiving_identity" class="form-label">Passport</label>
                    <input name="receiving_identity" type="text" class="form-control" id="receiving_identity" placeholder="Passport" value="{{$receiving->receiving_identity}}">
                </div>
                <input type="hidden" name="receiving_uid" value="{{$receiving->receiving_uid}}" />
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
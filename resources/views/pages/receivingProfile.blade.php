@auth
@extends('layouts.layout')
@section("content")

<div id="liveAlertPlaceholder"></div>
<div class="row">

    @if($Receiving->Receiving_officer)
    <div class="col-lg-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="mb-4">
                    <h5 class="card-title fw-semibold">Receiving Officer Picture</h5>
                </div>
                <img src="{{$Receiving->image?$Receiving->image->base64_image:asset('assets/images/profile/user-1.jpg')}}" width="200px" height="200px" class="rounded mx-auto d-block" alt="Receiving Officer Profile Picture">
                <br />
                <form action="{{session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'receiving' ?route('request.imageUpload'):''}}" method="POST" enctype="multipart/form-data">
                    <fieldset <?php echo session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'receiving' ? '' : 'disabled' ?>>
                        <div class="input-group">
                            <input type="hidden" value="{{$Receiving->Receiving_officer}}" name="id" />
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
                    <form name="ReceivingInfo" id="ReceivingInfo" method="POST" action="{{session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'receiving' ?route('request.updateReceiving OfficerRequest',$Receiving->Receiving_uid):''}}">
                        <fieldset <?php echo session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'Receiving' ? '' : 'disabled' ?>>
                            <legend>Receiving Officer Information</legend>
                            @csrf
                            <div class="mb-3">
                                <label for="Receiving_rank" class="form-label">Receiving Officer Rank</label>
                                <input name="Receiving_rank" type="text" class="form-control" id="Receiving_rank" placeholder="Rank" value="{{$Receiving->Receiving_rank}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="Receiving_first_Name" class="form-label">Receiving Officer First Name</label>
                                <input name="Receiving_first_Name" type="text" class="form-control" id="Receiving_first_Name" placeholder="First Name" value="{{$Receiving->Receiving_first_name}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="Receiving_last_Name" class="form-label">Receiving Officer Last Name</label>
                                <input name="Receiving_last_Name" type="text" class="form-control" id="Receiving_last_Name" placeholder="Last Name" value="{{$Receiving->Receiving_last_name}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="Receiving_designation" class="form-label">Designation</label>
                                <input name="Receiving_designation" type="text" class="form-control" id="Receiving_designation" placeholder="Designation" value="{{$Receiving->Receiving_designation}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="Receiving_contact" class="form-label">Contact</label>
                                <input name="Receiving_contact" type="text" class="form-control" id="Receiving_contact" placeholder="Receiving Officer Contact Number" value="{{$Receiving->Receiving_contact}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="passport" class="form-label">Passport</label>
                                <input name="passport" type="text" class="form-control" id="passport" placeholder="Passport" value="{{$Receiving->Receiving_identity}}">
                            </div>
                            <input type="hidden" name="uid" value="{{$Receiving->Receiving_uid}}" />
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
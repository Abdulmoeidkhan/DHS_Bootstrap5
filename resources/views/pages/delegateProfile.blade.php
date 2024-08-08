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
                    <h5 class="card-title fw-semibold">Delegate Picture</h5>
                </div>
                <img src="{{$delegateImage?$delegateImage->img_blob:asset('assets/images/profile/user-1.jpg')}}" width="200px" height="200px" class="rounded mx-auto d-block" alt="Delegate Profile Picture">
                <br />
                <form action="{{session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'delegate' ?route('request.imageUpload'):''}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <fieldset <?php echo session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'delegate' ? '' : 'disabled' ?>>
                        <!-- <div class="input-group">
                            <input type="hidden" value="{{$delegate->delegates_uid}}" name="id" />
                            <input type="file" class="form-control" id="uploadFile" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="image" accept="image/png, image/jpeg" required>
                            <button class="btn btn-outline-danger" type="submit">Upload</button>
                        </div> -->
                        <input type="hidden" value="{{$delegate->delegates_uid}}" name="id" required />
                        <div class="mb-3">
                            <label for="delegation_picture" class="form-label">Picture</label>
                            <input name="delegation_picture" type="file" class="form-control" id="delegation_picture" accept="image/png, image/jpeg" required>
                            <input name="savedpicture" type="hidden" class="form-control" id="savedpicture" value="" required>
                            <div class="box-2">
                                <div class="result"></div>
                            </div>
                            <div class="box-2 img-result {{isset($delegationHead->delegation_picture) ? ($delegationHead?->delegation_picture?->img_blob ? '' : 'hide') : ''}}">
                                <img class="cropped" src="{{isset($delegationHead->delegation_picture)? $delegationHead?->delegation_picture?->img_blob:''}}" alt="" />
                            </div>
                            <div class="box">
                                <div class="options hide">
                                    <label>Width</label>
                                    <input type="number" class="img-w" value="300" min="100" max="1200" required />
                                </div>
                                <button class="btn save hide">Save</button>
                            </div>
                            <button class="btn btn-outline-danger" type="submit">Upload</button>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="card-body p-4">
                <div class="mb-4">
                    <h5 class="card-title fw-semibold">Rep Picture</h5>
                </div>
                <img src="{{$repImage?$repImage->img_blob:asset('assets/images/profile/user-1.jpg')}}" width="200px" height="200px" class="rounded mx-auto d-block" alt="User Profile Picture">
                <br />
                <form action="{{session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'delegate' ?route('request.imageUpload'):''}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <fieldset <?php echo session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'delegate' ? '' : 'disabled' ?>>
                        <!-- <div class="input-group">
                            <input type="file" class="form-control" id="uploadFile" aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="image" accept="image/png, image/jpeg" required>
                        </div> -->
                        <input type="hidden" value="{{$rep->delegates_uid}}" name="id" required />
                        <div class="mb-3">
                            <label for="rep_picture" class="form-label">Picture</label>
                            <input name="rep_picture" type="file" class="form-control" id="rep_picture" accept="image/png, image/jpeg" required>
                            <input name="savedpicture" type="hidden" class="form-control" id="savedpicture-2" value="" required>
                            <div class="box-2">
                                <div class="result-representatives"></div>
                            </div>
                            <div class="box-2 img-result-representatives {{isset($delegationHead->delegation_picture) ? ($delegationHead?->delegation_picture?->img_blob ? '' : 'hide') : ''}}">
                                <img class="cropped-representatives" src="{{isset($delegationHead->delegation_picture)? $delegationHead?->delegation_picture?->img_blob:''}}" alt="" />
                            </div>
                            <div class="box">
                                <div class="options hide-representatives">
                                    <label>Width</label>
                                    <input type="number" class="img-w-representatives" value="300" min="100" max="1200" required />
                                </div>
                                <button class="btn save-representatives hide-representatives">Save</button>
                            </div>
                            <button class="btn btn-outline-danger" type="submit">Upload</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-5 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Delegate Information</h5>
                <div class="table-responsive">
                    <form name="delegationInfo" id="delegationInfo" method="POST" action="{{session()->get('user')->roles[0]->name == 'admin' ? route('request.updateDelegation'):''}}">
                        <fieldset <?php echo session()->get('user')->roles[0]->name == 'admin' ? '' : 'disabled' ?>>
                            <legend>Delegate Information</legend>
                            @csrf
                            <div class="mb-3">
                                <label for="self_rank" class="form-label">Rank</label>
                                <select name="self_rank" id="self_rank" class="form-select">
                                    <option value="" selected disabled hidden> Select Rank </option>
                                    @foreach (\App\Models\Rank::all() as $renderRank)
                                    <option value="{{$renderRank->ranks_uid}}" <?php echo $delegate->rank == $renderRank->ranks_uid ? 'selected' : '' ?>>{{$renderRank->ranks_name}}</option>
                                    @endforeach
                                </select>
                                <!-- <input name="rank" type="text" class="form-control" id="rank" placeholder="Rank" value="{{$delegate->rank}}"> -->
                            </div>
                            <div class="mb-3">
                                <label for="self_first_Name" class="form-label">First Name</label>
                                <input name="self_first_Name" type="text" class="form-control" id="self_first_Name" placeholder="First Name" value="{{$delegate->first_Name}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="self_last_Name" class="form-label">Last Name</label>
                                <input name="self_last_Name" type="text" class="form-control" id="self_last_Name" placeholder="Last Name" value="{{$delegate->last_Name}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="self_designation" class="form-label">Designation</label>
                                <input name="self_designation" type="text" class="form-control" id="self_designation" placeholder="Designation" value="{{$delegate->designation}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="golf_player" class="form-label">Golf Player</label>
                                <select name="golf_player" id="golf_player" class="form-select">
                                    <option value="0" {{isset($delegationData)?($delegationData->golf_player == 0 ? 'Selected':''):''}}> No </option>
                                    <option value="1" {{isset($delegationData)?($delegationData->golf_player == 1 ? 'Selected':''):''}}> Yes </option>
                                </select>
                            </div>
                            <!-- <div class="mb-3">
                                <label for="organistaion" class="form-label">Organistaion</label>
                                <input name="organistaion" type="text" class="form-control" id="organistaion" placeholder="Organistaion" value="{{$delegate->organistaion}}" required>
                            </div> -->
                            <div class="mb-3">
                                <label for="delegation_response" class="form-label">Delegation Response</label>
                                <select class="form-select" aria-label="Delegation Response" id="delegation_response" name="delegation_response" required>
                                    <option value="Accepted" {{isset($delegationData)?($delegationData->delegation_response == 'Accepted' ? 'Selected':''):''}}> Accepted </option>
                                    <option value="Regretted" {{isset($delegationData)?($delegationData->delegation_response == 'Regretted' ? 'Selected':''):''}}> Regretted </option>
                                </select>
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
                                    Rep
                                </label>
                            </div>
                            <div class="mb-3">
                                <label for="rep_rank" class="form-label">Rank</label>
                                <select name="rep_rank" id="rep_rank" class="form-select">
                                    <option value="" selected disabled hidden> Select Rank </option>
                                    @foreach (\App\Models\Rank::all() as $renderRank)
                                    <option value="{{$renderRank->ranks_uid}}" {{isset($rep)?($rep->rank == $renderRank->ranks_uid ? 'Selected':''):''}}>{{$renderRank->ranks_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="rep_first_Name" class="form-label">Rep First Name</label>
                                <input name="rep_first_Name" type="text" class="form-control" id="rep_first_Name" placeholder="Rep First Name" value="{{$rep->first_Name}}">
                            </div>
                            <div class="mb-3">
                                <label for="rep_last_Name" class="form-label">Rep Last Name</label>
                                <input name="rep_last_Name" type="text" class="form-control" id="rep_last_Name" placeholder="Rep Last Name" value="{{$rep->last_Name}}">
                            </div>
                            <div class="mb-3">
                                <label for="rep_designation" class="form-label">Designation</label>
                                <input name="rep_designation" type="text" class="form-control" id="rep_designation" value="{{isset($rep)?$rep->designation :''}}" placeholder="Rep Designation">
                            </div>
                            <input type="hidden" name="delegation_uid" value="{{$delegate->delegation}}" />
                            <input type="hidden" name="self_delegate_uid" value="{{$delegate->delegates_uid}}" />
                            <input type="hidden" name="rep_delegate_uid" value="{{$rep->delegates_uid}}" />
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                        </fieldset>
                    </form>
                </div>
                <br />
            </div>
        </div>
    </div>
    <div class="col-lg-3 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Programs</h5>
                <div class="table-responsive">
                    <form name="programInfo" id="programInfo" method="POST" action="{{session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'delegate' ? route('request.setInterests'):''}}">
                        <fieldset <?php echo session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'delegate' ? '' : 'disabled' ?>>
                            <legend>Programs</legend>
                            @csrf
                            @foreach (\App\Models\Program::all() as $key=>$program)
                            <div class="mb-3">
                                <input name="program_uid-{{$key}}" type="checkbox" class="form-check-input" id="program-{{$key}}" value="{{$program->program_uid}}" <?php echo in_array($program->program_uid, $delegate->interests) ? 'checked' : '' ?>>
                                &nbsp;
                                <label for="program-{{$key}}" class="form-label"><b>{{$program->program_name}}</b> (Day-{{$program->program_day}} &nbsp; {{$program->program_start_time}}-{{$program->program_end_time}} )</label>
                            </div>
                            @endforeach
                            <input type="hidden" name="guest_uid" value="{{$delegate->delegates_uid}}" />
                            <input type="hidden" name="delegation_uid" value="{{$delegate->delegation}}" />
                            @if(session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'delegate')
                            <input type="submit" name="submit" class="btn btn-primary" value="Update Interest" />
                            @endif
                        </fieldset>
                    </form>
                </div>
                <br />
                <div class="table-responsive">
                    <h5 class="card-title fw-semibold mb-4">Feedback</h5>
                    @if(count($delegateFeedback)>0)
                    <ul class="list-group">
                        @foreach($delegateFeedback as $key=> $feedback)
                        <li class="list-group-item list-group-item-success">
                            <div class="row">
                                <div class="col">
                                    <span style="vertical-align:-webkit-baseline-middle">
                                        {{$feedback->feedback}}
                                    </span>
                                </div>
                                <form name="feedbackDelete" class="col" id="feedbackDelete" method="POST" action="{{session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'delegate' ? route('request.deleteFeedback'):''}}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$feedback->feedback_uid}}" />
                                    <button type="submit" class="btn btn-outline-badar float-end border-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M18 6l-12 12" />
                                            <path d="M6 6l12 12" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <form name="feedback" id="feedback" method="POST" action="{{session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'delegate' ? route('request.setFeedback'):''}}">
                        <fieldset <?php echo session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'delegate' ? '' : 'disabled' ?>>
                            <legend>Feedback</legend>
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control" name="feedback" id="feedback" placeholder="feedback" value="" />
                            </div>
                            <input type="hidden" name="guest_uid" value="{{$delegate->delegates_uid}}" />
                            <input type="hidden" name="delegation_uid" value="{{$delegate->delegation}}" />
                            @if(session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'delegate')
                            <input type="submit" name="submit" class="btn btn-primary" value="Add Feedback" />
                            @endif
                        </fieldset>
                    </form>
                    @endif
                </div>
                <br />
                <div class="table-responsive">
                    <h5 class="card-title fw-semibold mb-4">Wish List</h5>
                    <form name="wishInfo" id="wishInfo" method="POST" action="{{session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'delegate' ? route('request.setWish'):''}}">
                        <fieldset <?php echo session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'delegate' ? '' : 'disabled' ?>>
                            <legend>Wishes</legend>
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control" name="wish" id="wish" placeholder="Wish" value="" />
                            </div>
                            <input type="hidden" name="guest_uid" value="{{$delegate->delegates_uid}}" />
                            <input type="hidden" name="delegation_uid" value="{{$delegate->delegation}}" />
                            @if(session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'delegate')
                            <input type="submit" name="submit" class="btn btn-primary" value="Add Wish" />
                            @endif
                        </fieldset>
                    </form>
                    <br />
                    <ul class="list-group">
                        @foreach($delegateWishes as $key=> $wish)
                        <li class="list-group-item list-group-item-success">
                            <div class="row">
                                <div class="col">
                                    <span style="vertical-align:-webkit-baseline-middle">
                                        {{$wish->wish}}
                                    </span>
                                </div>
                                <form name="wishDelete" class="col" id="wishDelete" method="POST" action="{{session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'delegate' ? route('request.deleteWish'):''}}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$wish->wish_uid}}" />
                                    <button type="submit" class="btn btn-outline-badar float-end border-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="18" height="18" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M18 6l-12 12" />
                                            <path d="M6 6l12 12" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
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
        document.getElementById('savedpicture-2').value = imgSrc;
        dwn_representatives.classList.remove('hide-representatives');
        dwn_representatives.download = 'imagename.png';
        dwn_representatives.setAttribute('href', imgSrc);
    });
</script>
<?php echo $delegate->country ? '<script id="scriptElement">document.getElementById("country").value="' . $delegate->country . '";document.getElementById("scriptElement").remove()</script>' : ''; ?>
@endsection
@endauth
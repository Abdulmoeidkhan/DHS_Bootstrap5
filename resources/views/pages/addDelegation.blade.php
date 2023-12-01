@auth
@extends('layouts.layout')
@section("content")
@if(session()->get('user')->roles[0]->name === "admin")
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
<div class="row">
    <div class="d-flex justify-content-center">
        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#VIPModal">Add VIP'S</button>
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#DelegateModal">Add Rank's</button>
        <!-- <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#DelegateModal">Add Delegates</button> -->
        <div class="modal fade" id="VIPModal" tabindex="-1" aria-labelledby="VIPModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">VIP's Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <livewire:add-vips-component />
                </div>
            </div>
        </div>
        <div class="modal fade" id="DelegateModal" tabindex="-1" aria-labelledby="DelegateModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delegates Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <livewire:add-rank-component />
                    <!-- <livewire:add-delegate-component /> -->
                </div>
            </div>
        </div>
    </div>
</div>
<br />
@endif
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">New Delegation</h5>
                <div class="table-responsive">
                    <form name="delegationBasicInfo" id="delegationBasicInfo" method="POST" action="{{isset($delegations)?route('request.updateDelegationRequest'):route('request.addDelegationRequest')}}" enctype="multipart/form-data">
                        <fieldset>
                            <legend>Add Invitaion Details</legend>
                            @csrf
                            <div class="mb-3">
                                <label for="countryInput" class="form-label">Select Country</label>
                                <select class="form-select" aria-label="Country Name" id="countryInput" name="country" required>
                                    <option value="" selected disabled hidden> Select Country </option>
                                    @foreach(\App\Models\Country::all() as $country)
                                    <option value="{{$country->name}}" {{isset($delegations)?($delegations->country == $country->value ? 'Selected':''):''}}> {{$country->value}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <livewire:invited-by-component selectedVip="{{isset($delegations)?$delegations->invited_by:''}}" />
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea name="address" class="form-control" id="address" placeholder="Address">{{isset($delegations)?$delegations->address:''}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="delegation_response" class="form-label">Delegation Response</label>
                                <select class="form-select" aria-label="Delegation Response" id="delegation_response" name="delegation_response" required>
                                    <option value="Awaited" {{isset($delegations)?($delegations->delegation_response == 'Awaited' ? 'Selected':''):''}}> Awaited </option>
                                    <option value="Accepted" {{isset($delegations)?($delegations->delegation_response == 'Accepted' ? 'Selected':''):''}}> Accepted </option>
                                    <option value="Regretted" {{isset($delegations)?($delegations->delegation_response == 'Regretted' ? 'Selected':''):''}}> Regretted </option>
                                </select>
                            </div>
                            <!-- <div class="mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input name="first_name" class="form-control" id="first_name" placeholder="First Name" />
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input name="last_name" class="form-control" id="last_name" placeholder="Last Name" />
                            </div>
                            <div class="mb-3">
                                <label for="designation" class="form-label">Designation</label>
                                <input name="designation" class="form-control" id="lasdesignationt_name" placeholder="Designation" />
                            </div>
                            <div class="mb-3">
                                <label for="rank" class="form-label">Rank</label>
                                <select class="form-select" aria-label="rank" id="rank" name="rank" required>
                                    @foreach (\App\Models\Rank::all() as $rank)
                                    <option value="{{$rank->ranks_uid}}"> {{$rank->ranks_name}} </option>
                                    @endforeach
                                </select>
                            </div> -->
                            <div class="mb-3">
                                <label for="exhibition" class="form-label">Event Name</label>
                                <select class="form-select" aria-label="Event Name" id="exhibition" name="exhibition" required>
                                    <option value="" selected disabled hidden> Select Event </option>
                                    @foreach(\App\Models\Event::all() as $event)
                                    <option value="{{$event->name}}" {{isset($delegations)?($delegations->exhibition == $event->name ? 'Selected':''):''}}> {{$event->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="rank" class="form-label">Rank</label>
                                <select name="self_rank" id="self_rank" class="form-select" required>
                                    <option value="" selected disabled hidden> Select Rank </option>
                                    @foreach (\App\Models\Rank::all() as $renderRank)
                                    <option value="{{$renderRank->ranks_uid}}" {{isset($delegationHead)?($delegationHead->rank == $renderRank->ranks_uid ? 'Selected':''):''}}>{{$renderRank->ranks_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="self_first_Name" class="form-label">First Name</label>
                                <input name="self_first_Name" type="text" class="form-control" id="self_first_Name" value="{{isset($delegationHead)?($delegationHead->first_Name):''}}" placeholder="First Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="self_last_Name" class="form-label">Last Name</label>
                                <input name="self_last_Name" type="text" class="form-control" id="self_last_Name" value="{{isset($delegationHead)?($delegationHead->last_Name):''}}" placeholder="Last Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="self_designation" class="form-label">Designation</label>
                                <input name="self_designation" type="text" class="form-control" id="self_designation" value="{{isset($delegationHead)?($delegationHead->designation):''}}" placeholder="Designation" required>
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
                            </div>
                            @if(isset($delegationHead))
                            <input name="self_delegation_uid" type="hidden" class="form-control" id="self_delegation_uid" value="{{isset($delegationHead)?$delegationHead->delegates_uid :''}}">
                            @endif
                            <div class="mb-3">
                                <label for="pdf" class="form-label">Document</label>
                                <input name="pdf" type="file" class="form-control" id="pdf" accept="application/pdf">
                                @if(isset($delegationHead)?$delegationHead->delegation_document:0)
                                <object data="{{ route('request.getPdf' , $delegationHead->delegates_uid ) }}" type="application/pdf" width="100%" height="1000px">
                                    <p>Your browser does not support PDF embedding. You can <a href="{{ route('request.getPdf' , $delegationHead->delegates_uid ) }}">download the PDF</a> instead.</p>
                                </object>
                                @endif
                            </div>
                            <div class="mb-3">
                                <input class="form-check-input" type="radio" name="self" id="self" value="1" {{isset($delegationHead)?($delegationHead->self?'checked':''):'checked'}} />
                                <label class="form-check-label" for="self">
                                    Self
                                </label>
                            </div>
                            <div class="mb-3">
                                <input class="form-check-input" type="radio" name="self" id="rep" value="0" {{isset($delegationHead)?($delegationHead->self?'':'checked'):''}}>
                                <label class="form-check-label" for="rep">
                                    Representative
                                </label>
                            </div>
                            <div class="mb-3">
                                <label for="rep_rank" class="form-label">Rank</label>
                                <select name="rep_rank" id="rep_rank" class="form-select">
                                    <option value="" selected disabled hidden> Select Rank </option>
                                    @foreach (\App\Models\Rank::all() as $renderRank)
                                    <option value="{{$renderRank->ranks_uid}}" {{isset($representatives)?($representatives->rank == $renderRank->ranks_uid ? 'Selected':''):''}}>{{$renderRank->ranks_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="rep_first_Name" class="form-label">Representative First Name</label>
                                <input name="rep_first_Name" type="text" class="form-control" id="rep_first_Name" value="{{isset($representatives)?$representatives->first_Name :''}}" placeholder="Representative First Name">
                            </div>
                            <div class="mb-3">
                                <label for="rep_last_Name" class="form-label">Representative Last Name</label>
                                <input name="rep_last_Name" type="text" class="form-control" id="rep_last_Name" value="{{isset($representatives)?$representatives->last_Name :''}}" placeholder="Representative Last Name">
                            </div>
                            <div class="mb-3">
                                <label for="rep_designation" class="form-label">Designation</label>
                                <input name="rep_designation" type="text" class="form-control" id="rep_designation" value="{{isset($representatives)?$representatives->designation :''}}" placeholder="Representative Designation">
                            </div>
                            <div class="mb-3">
                                <label for="rep_picture" class="form-label">Picture</label>
                                <input name="rep_picture" type="file" class="form-control" id="rep_picture" accept="image/png, image/jpeg">
                                <input name="rep_saved_picture" type="hidden" class="form-control" id="rep_saved_picture" value="">
                                <div class="box-2-representatives">
                                    <div class="result-representatives"></div>
                                </div>
                                <div class="box-2-representatives img-result-representatives {{isset($representatives->delegation_picture) ? ($representatives?->delegation_picture?->img_blob ? '' : 'hide') : ''}}">
                                    <img class="cropped-representatives" src="{{isset($representatives->delegation_picture)? $representatives?->delegation_picture?->img_blob:''}}" alt="" />
                                </div>
                                <div class="box-representatives">
                                    <div class="options-representatives hide-representatives">
                                        <label>Width</label>
                                        <input type="number" class="img-w-representatives" value="300" min="100" max="1200" />
                                    </div>
                                    <button class="btn save-representatives hide-representatives">Save</button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="rep_Pdf" class="form-label">Document</label>
                                <input name="rep_Pdf" type="file" class="form-control" id="rep_Pdf" accept="application/pdf">
                                @if(isset($representatives)?$representatives->delegation_document:0)
                                <object data="{{route('request.getPdf' , $representatives->delegates_uid)}}" type="application/pdf" width="100%" height="1000px">
                                    <p>Your browser does not support PDF embedding. You can <a href="{{route('request.getPdf',$representatives->delegates_uid)}}">download the PDF</a> instead.</p>
                                </object>
                                @endif
                            </div>
                            <!-- @if(isset($representatives)) -->
                            <input name="rep_delegation_uid" type="hidden" class="form-control" id="rep_delegation_uid" value="{{isset($representatives)?$representatives->delegates_uid :''}}">
                            <!-- @endif -->
                            @if(isset($delegations))
                            <input name="uid" type="hidden" class="form-control" id="uid" value="{{isset($delegations)?$delegations->uid :''}}">
                            @endif
                            
                            <input type="submit" name="submit" class="btn {{isset($delegations)?'btn-success':'btn-primary'}}" value="{{isset($delegations)?'Update Delegation':'Add Delegation'}}" />
                        </fieldset>
                    </form>
                </div>
                <br />
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
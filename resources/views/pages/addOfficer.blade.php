@auth
@extends('layouts.layout')
@section("content")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.4/cropper.min.css'>
<style>
    .box {
        padding: 0.5em;
        width: 100%;
        margin: 0.5em;
    }

    .box-2 {
        padding: 0.5em;
        width: calc(100%/2 - 1em);
    }

    .hide {
        display: none;
    }

    img {
        max-width: 100%;
    }
</style>
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-ti tle fw-semibold mb-4">New Officer</h5>
                <div class="table-responsive">
                    <form name="officerBasicInfo" id="officerBasicInfo" method="POST" action="{{isset($officer->officer_uid)? route('request.updateOfficer',$officer->officer_uid):route('request.addOfficer')}}" enctype="multipart/form-data">
                        <fieldset>
                            <legend>Add Officer Form</legend>
                            @csrf
                            <div class="mb-3">
                                <label for="officer_rank" class="form-label">Rank</label>
                                <select name="officer_rank" id="officer_rank" class="form-select">
                                    <option value="" selected disabled hidden> Select Rank </option>
                                    @foreach (\App\Models\Rank::all() as $renderRank)
                                    <option value="{{$renderRank->ranks_uid}}" {{isset($officer->officer_rank) ? ($officer->officer_rank->ranks_uid == $renderRank->ranks_uid ? 'selected' : '') : ''}}>{{$renderRank->ranks_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="officer_first_name" class="form-label">First Name</label>
                                <input name="officer_first_name" type="text" class="form-control" id="officer_first_name" placeholder="Officer First Name" value="{{isset($officer) ? $officer->officer_first_name : ''}}" required />
                            </div>
                            <div class="mb-3">
                                <label for="officer_last_name" class="form-label">Last Name</label>
                                <input name="officer_last_name" type="text" class="form-control" id="officer_last_name" placeholder="Officer Last Name" value="{{isset($officer) ? $officer->officer_last_name : ''}}" required />
                            </div>
                            <div class="mb-3">
                                <label for="officer_type" class="form-label">Type</label>
                                <select name="officer_type" id="officer_type" class="form-select" {{isset($officer->officer_type)?'disabled':''}}>
                                    <option value="" selected disabled hidden> Select Type </option>
                                    <option value="Liason" {{isset($officer->officer_type) ? ($officer->officer_type == 'Liason' ? 'selected' : '') : ''}}> Liason Officer </option>
                                    <option value="Interpreter" {{isset($officer->officer_type) ? ($officer->officer_type == 'Interpreter' ? 'selected' : '') : ''}}> Interpreter Officer </option>
                                    <option value="Receiving" {{isset($officer->officer_type) ? ($officer->officer_type == 'Receiving' ? 'selected' : '') : ''}}> Receiving Officer </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="officer_designation" class="form-label">Designation</label>
                                <input name="officer_designation" type="text" class="form-control" id="officer_designation" placeholder="Officer Officer Designation" value="{{isset($officer) ? $officer->officer_designation : ''}}" required />
                            </div>
                            <div class="mb-3">
                                <label for="officer_contact" class="form-label">Contact Number</label>
                                <input name="officer_contact" type="number" class="form-control" id="officer_contact" placeholder="Officer Contact Number" value="{{isset($officer) ? $officer->officer_contact : ''}}" required />
                            </div>
                            <div class="mb-3">
                                <label for="officer_identity" class="form-label">Officer CNIC</label>
                                <input name="officer_identity" type="number" class="form-control" id="officer_identity" placeholder="Officer Identity" value="{{isset($officer) ? $officer->officer_identity : ''}}" required />
                            </div>
                            <div class="mb-3">
                                <label for="officer_address" class="form-label">Officer Address</label>
                                <input name="officer_address" type="text" class="form-control" id="officer_address" placeholder="Officer Address" value="{{isset($officer) ? $officer->officer_address : ''}}" required />
                            </div>
                            <div class="mb-3">
                                <label for="officer_remarks" class="form-label">Officer Remarks</label>
                                <input name="officer_remarks" type="text" class="form-control" id="officer_remarks" placeholder="Officer Remarks" value="{{isset($officer) ? $officer->officer_remarks : ''}}" required />
                            </div>
                            <div class="mb-3">
                                <label for="officer_picture" class="form-label">Picture</label>
                                <input name="officer_picture" type="file" class="form-control" id="officer_picture" accept="image/png, image/jpeg">
                                <input name="savedpicture" type="hidden" class="form-control" id="savedpicture" value="">
                                <div class="box-2">
                                    <div class="result"></div>
                                </div>
                                <div class="box-2 img-result {{isset($officer->officer_picture) ? ($officer?->officer_picture?->img_blob ? '' : 'hide') : ''}}">
                                    <img class="cropped" src="{{isset($officer->officer_picture)? $officer?->officer_picture?->img_blob:''}}" alt="" />
                                </div>
                                <div class="box">
                                    <div class="options hide">
                                        <label>Width</label>
                                        <input type="number" class="img-w" value="300" min="100" max="1200" />
                                    </div>
                                    <button class="btn save hide">Save</button>
                                </div>
                            </div>
                            <!-- <div class="mb-3">
                                <label for="pdf" class="form-label">Document</label>
                                <input name="pdf" type="file" class="form-control" id="pdf" accept="application/pdf">
                                @if(isset($officer?->officer_document))
                                <object data="{{ route('request.getPdf' , $officer->officer_uid ) }}" type="application/pdf" width="100%" height="1000px">
                                    <p>Your browser does not support PDF embedding. You can <a href="{{ route('request.getPdf' , $officer->officer_uid ) }}">download the PDF</a> instead.</p>
                                </object>
                                @endif
                            </div> -->
                            <input type="submit" name="submit" class="btn {{isset($officer->officer_uid)?'btn-success':'btn-primary'}}" value="{{isset($officer->officer_uid)?'Update Officer':'Add Officer'}}" />
                        </fieldset>
                    </form>
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
        upload = document.querySelector('#officer_picture'),
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
@endsection
@endauth
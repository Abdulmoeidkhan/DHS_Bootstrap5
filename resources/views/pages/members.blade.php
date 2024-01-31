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

<!-- @if(session()->get('user')->roles[0]->name === "delegate" )
<div class="row">
    <div class="d-flex justify-content-center">
        <a type="button" href="{{route('pages.addMember',session()->get('user')->uid)}}" class="btn btn-outline-success">Add Delegates</a>
    </div>
</div>
@elseif(session()->get('user')->roles[0]->name === "admin")
<div class="row">
    <div class="d-flex justify-content-center">
        <a type="button" href="{{route('pages.addMember',$id)}}" class="btn btn-outline-success">Add Delegates</a>
    </div>
</div>
@endif -->
@if(session()->get('user')->roles[0]->name =="admin" || session()->get('user')->roles[0]->name =="delegate")
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
                                <!-- <label for="rank" class="form-label">Rank</label>
                                <input name="rank" type="text" class="form-control" id="rank" placeholder="Rank" required> -->
                                <label for="rank" class="form-label">Rank</label>
                                <select name="rank" id="rank" class="form-select">
                                    <option value="" selected disabled hidden> Select Rank </option>
                                    @foreach (\App\Models\Rank::all() as $renderRank)
                                    <option value="{{$renderRank->ranks_uid}}">{{$renderRank->ranks_name}}</option>
                                    @endforeach
                                </select>
                            </div>
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
                            <!-- <div class="mb-3">
                                <label for="organistaion" class="form-label">Organisation</label>
                                <input name="organistaion" type="text" class="form-control" id="organistaion" placeholder="Organisation" required>
                            </div> -->
                            <!-- <div class="mb-3">
                                <label for="passport" class="form-label">Passport</label>
                                <input name="passport" type="text" class="form-control" id="passport" placeholder="Passport" required>
                            </div> -->
                            <div class="mb-3">
                                <label for="picture" class="form-label">Picture</label>
                                <input name="picture" type="file" class="form-control" id="picture" accept="image/png, image/jpeg">
                                <input name="savedpicture" type="hidden" class="form-control" id="savedpicture" value="">
                                <div class="box-2">
                                    <div class="result"></div>
                                </div>
                                <div class="box-2 img-result hide">
                                    <img class="cropped" src="" alt="" />
                                </div>
                                <div class="box">
                                    <div class="options hide">
                                        <label>Width</label>
                                        <input type="number" class="img-w" value="300" min="100" max="1200" />
                                    </div>
                                    <button class="btn save hide">Save</button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="pdf" class="form-label">Document</label>
                                <input name="pdf" type="file" class="form-control" id="pdf" accept="application/pdf">
                            </div>
                            <!-- <div class="mb-3">
                                <label for="picture" class="form-label">Picture</label>
                                <input name="picture" type="file" class="form-control" id="picture" accept="image/png, image/jpeg">
                            </div>
                            <div class="mb-3">
                                <label for="pdf" class="form-label">Document</label>
                                <input name="pdf" type="file" class="form-control" id="pdf" accept="application/pdf">
                            </div> -->
                            <input name="delegation" type="hidden" id="delegation" value="{{$id}}" required>
                            <input name="delegation_type" type="hidden" id="delegation_type" value="Member" required>
                            <input type="submit" name="submit" class="btn btn-primary" value="Add Member" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
<br />
<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Delegates</h5>
            <div class="table-responsive">
                <table id="table"      data-virtual-scroll="true"   data-flat="true" data-search="true" data-show-refresh="true" data-show-pagination-switch="true" data-click-to-select="true" data-toggle="table" data-url="{{route('request.getMembers',$id)}}" data-pagination="true" data-show-toggle="true" data-show-export="true" data-show-columns="true" data-show-columns-toggle-all="true" data-page-list="[10, 25, 50, 100, all]">
                    <thead>
                        <tr>
                            <th data-field="id">Id</th>
                            <th data-field="rankName.ranks_name" data-sortable="true">Rank</th>
                            <th data-field="first_Name" data-sortable="true">First Name</th>
                            <th data-field="last_Name" data-sortable="true">Last Name</th>
                            <th data-field="designation" data-sortable="true">Designation</th>
                            <th data-field="delegation_type" data-sortable="true">Type</th>
                            <th data-field="flight.passport" data-sortable="true">Passport</th>
                            <th data-field="status" data-sortable="true" data-field="status" data-formatter="statusFormatter">Member Active</th>
                            @if(session()->get('user')->roles[0]->name =="admin" || session()->get('user')->roles[0]->name =="delegate")
                            <th data-field="delegates_uid" data-sortable="true" data-field="status" data-formatter="statusChangerFormatter">Status Changer</th>
                            @endif
                            <th data-field="flight.arrival_flight" data-sortable="true">Arrival Flight</th>
                            <th data-field="flight.arrival_date" data-sortable="true">Arrival Date</th>
                            <th data-field="flight.arrival_time" data-sortable="true">Arrival Time</th>
                            <th data-field="flight.departure_flight" data-sortable="true">Departure Flight</th>
                            <th data-field="flight.departure_date" data-sortable="true">Departure Date</th>
                            <th data-field="flight.departure_time" data-sortable="true">Departure Time</th>
                            <th data-field="image.img_blob" data-sortable="true" data-formatter="operatePicture" data-force-hide="true">Image</th>
                            @if(session()->get('user')->roles[0]->name =="admin" || session()->get('user')->roles[0]->name =="delegate")
                            <th data-field="delegates_uid" data-sortable="true" data-formatter="operateDelegate" data-force-hide="true">Actions</th>
                            @endif
                            <!-- <th data-field="organistaion" data-sortable="true">Organistaion</th> -->
                            <!-- <th data-field="last_Name" data-sortable="true">Delegate Last Name</th>
                            <th data-field="last_Name" data-sortable="true">Delegate Last Name</th> -->
                            <!-- <th data-field="first_Name">Delegation Code</th> -->
                            <!-- <th data-field="member_uid" data-formatter="operateProfileFormatter" data-events="operateProfile">Profile</th> -->
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    window.operateProfile = {
        'click .like': function(e, value, row) {
            alert('You click like action, row: ' + JSON.stringify(row))
        },
        'click .remove': function(e, value, row) {
            alert('You click remove action, row: ' + JSON.stringify(row))
        }
    }

    function operateProfileFormatter(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                // '<a href="https://github.com/wenzhixin/' + value + '" target="_blank">' + value + '</a>',
                '<a class="btn btn-outline-success" href="memberFullProfile/' + value + '">',
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
                '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>',
                '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>',
                '<path d="M6 21v-2a4 4 0 0 1 4 -4h3.5"></path>',
                '<path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z"></path>',
                '</svg>',
                '</a>',
                '</div>',
                '<div class="right">',
                '<a class="like" href="javascript:void(0)" title="Like">',
                '<i class="fa fa-heart"></i>',
                '</a>  ',
                '<a class="remove" href="javascript:void(0)" title="Remove">',
                '<i class="fa fa-trash"></i>',
                '</a>',
                '</div>'
            ].join('')
        }
    }

    function operateDelegate(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-success" href="addMember/' + value + '">',
                '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">',
                '<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>',
                '<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>',
                '<path d="M6 21v-2a4 4 0 0 1 4 -4h3.5"></path>',
                '<path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z"></path>',
                '</svg>',
                '</a>',
                '</div>',
                '<div class="right">',
                '<a class="like" href="javascript:void(0)" title="Like">',
                '<i class="fa fa-heart"></i>',
                '</a>',
                '<a class="remove" href="javascript:void(0)" title="Remove">',
                '<i class="fa fa-trash"></i>',
                '</a>',
                '</div>'
            ].join('')
        }
    }

    function operatePicture(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<img src="' + value + '" width="80px" height="80px"/>',
                '</div>'
            ].join('')
        }
    }

    function statusFormatter(value, row, index) {
        return value ? ['<div class="left">', 'Yes', '</div>'].join('') : ['<div class="left">', 'No', '</div>'].join('');
    }

    function statusChangerFormatter(value, row, index) {
        if (value) {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-danger" href="delegateStatusChanger/' + row.delegates_uid + '">',
                '<span><i class="ti ti-users" style="font-size:24px;"></i></span>',
                '</a>',
                '</div>',
            ].join('')
        } else {
            return [
                '<div class="left">',
                '<a class="btn btn-outline-success" href="delegateStatusChanger/' + row.delegates_uid + '">',
                '<span><i class="ti ti-users" style="font-size:24px;"></i></span>',
                '</a>',
                '</div>',
            ].join('')
        }
    }
</script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.8.1/cropper.min.js'></script>
<script>
    // vars
    let result = document.querySelector('.result'),
        img_result = document.querySelector('.img-result'),
        save = document.querySelector('.save'),
        cropped = document.querySelector('.cropped'),
        img_w = document.querySelector('.img-w'),
        dwn = document.querySelector('.download'),
        upload = document.querySelector('#picture'),
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
@include("layouts.tableFoot")
@endsection
@endauth
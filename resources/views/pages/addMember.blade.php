@auth
@extends('layouts.layout')
@section("content")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.4/cropper.min.css'>
<style>
    .page {
        margin: 1em auto;
        max-width: 768px;
        display: flex;
        align-items: flex-start;
        flex-wrap: wrap;
        height: 100%;
    }

    .box {
        padding: 0.5em;
        width: 100%;
        margin: 0.5em;
    }

    .box-2 {
        padding: 0.5em;
        width: calc(100%/2 - 1em);
    }

    .options label,
    .options input {
        width: 4em;
        padding: 0.5em 1em;
    }

    /* .btn {
        background: white;
        color: black;
        border: 1px solid black;
        padding: 0.5em 1em;
        text-decoration: none;
        margin: 0.8em 0.3em;
        display: inline-block;
        cursor: pointer;
    } */

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
                <h5 class="card-title fw-semibold mb-4">New Member</h5>
                <div class="table-responsive">
                    <form name="memberBasicInfo" id="memberBasicInfo" method="POST" action="{{route('request.updateMemberRequest',$id)}}" enctype="multipart/form-data">
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
                                    <option value="{{$renderRank->ranks_uid}}" <?php echo $renderRank->ranks_uid === $member->rank ? 'selected' : '' ?>>{{$renderRank->ranks_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="firstName" class="form-label">First Name</label>
                                <input name="firstName" type="text" class="form-control" id="firstName" placeholder="First Name" value="{{$member->first_Name}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input name="lastName" type="text" class="form-control" id="lastName" placeholder="Last Name" value="{{$member->last_Name}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="designation" class="form-label">Designation</label>
                                <input name="designation" type="text" class="form-control" id="designation" placeholder="Designation" value="{{$member->designation}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="organistaion" class="form-label">Organisation</label>
                                <input name="organistaion" type="text" class="form-control" id="organistaion" placeholder="Organisation" value="{{$member->organisation}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="picture" class="form-label">Picture</label>
                                <input name="picture" type="file" class="form-control" id="picture" accept="image/png, image/jpeg">
                                <div class="box-2">
                                    <div class="result"></div>
                                </div>
                                <div class="box-2 img-result hide">
                                    <img class="cropped" src="" alt="" name="picture" />
                                </div>
                                <div class="box">
                                    <div class="options hide">
                                        <label> Width</label>
                                        <input type="number" class="img-w" value="300" min="100" max="1200" />
                                    </div>
                                    <button class="btn save hide">Save</button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="pdf" class="form-label">Document</label>
                                <input name="pdf" type="file" class="form-control" id="pdf" accept="application/pdf">
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="update Member" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Flight Information</h5>
                <div class="table-responsive">
                    <form name="flightBasicInfo" id="flightBasicInfo" method="POST" action="{{route('request.addDelegationFlight',$id)}}" enctype="multipart/form-data">
                        <fieldset>
                            <legend>Add FlightInfo Form</legend>
                            @csrf
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="arrival_date" class="form-label">Arrival Date</label>
                                            <input name="arrival_date" type="date" class="form-control" id="arrival_date" value="{{$flight?->arrival_date}}" placeholder="Arrival Date" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="arrival_time" class="form-label">Arrival Time</label>
                                            <input name="arrival_time" type="time" class="form-control" id="arrival_time" value="{{$flight?->arrival_time}}" placeholder="Arrival Time" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="departure_date" class="form-label">Departure Date</label>
                                            <input name="departure_date" type="date" class="form-control" id="departure_date" value="{{$flight?->departure_date}}" placeholder="Departure Date" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="mb-3">
                                            <label for="departure_time" class="form-label">Departure Time</label>
                                            <input name="departure_time" type="time" class="form-control" id="departure_time" value="{{$flight?->departure_time}}" placeholder="Departure Time" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col align-self-center">
                                        <div class="mb-3">
                                            <label for="passport" class="form-label">Passport</label>
                                            <input name="passport" type="text" class="form-control" value="{{$flight?->passport}}" id="passport" placeholder="Passport" required>
                                        </div>
                                    </div>
                                    <div class="col align-self-center">
                                        <div class="mb-3">
                                            <label class="form-label">Arrived : </label>
                                            <input class="form-check-input" type="radio" name="arrived" id="arrived" value="1" <?php echo $flight?->arrived ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="arrived">
                                                Yes
                                            </label>
                                            &nbsp;
                                            <input class="form-check-input" type="radio" name="arrived" id="notArrived" value="0" <?php echo !$flight?->arrived ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="notArrived">
                                                No
                                            </label>
                                            &nbsp;
                                            &nbsp;
                                            &nbsp;
                                            &nbsp;
                                            <label class="form-label">Departed : </label>
                                            <input class="form-check-input" type="radio" name="departed" id="departed" value="1" <?php echo $flight?->departed ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="departed">
                                                Yes
                                            </label>
                                            &nbsp;
                                            <input class="form-check-input" type="radio" name="departed" id="notDeparted" value="0" <?php echo !$flight?->departed ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="notDeparted">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="mb-3">
                                <label for="organistaion" class="form-label">Organisation</label>
                                <input name="organistaion" type="text" class="form-control" id="organistaion" placeholder="Organisation" required>
                            </div> -->
                            <br />
                            <input name="delegate_uid" type="hidden" id="delegate_uid" value="{{$id}}" required>
                            <input name="flightsegment_uid" type="hidden" id="flightsegment_uid" value="{{$flight?->flightsegment_uid}}">
                            <input type="submit" name="submit" class="btn btn-primary" value="Update Flight" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<main class="page">
    <!-- leftbox -->
    <div class="box-2">
        <div class="result"></div>
    </div>
    <!--rightbox-->
    <div class="box-2 img-result hide">
        <!-- result of crop -->
        <img class="cropped" src="" alt="">
    </div>
    <!-- input file -->
    <div class="box">
        <button class="btn save hide">Save</button>
    </div>
</main>
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
        dwn.classList.remove('hide');
        dwn.download = 'imagename.png';
        dwn.setAttribute('href', imgSrc);
    });
</script>
@endsection
@endauth
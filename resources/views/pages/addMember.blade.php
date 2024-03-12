@auth
@extends('layouts.layout')
@section("content")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.4/cropper.min.css'>
<style>
    /* .page {
        margin: 1em auto;
        max-width: 768px;
        display: flex;
        align-items: flex-start;
        flex-wrap: wrap;
        height: 100%;
    } */

    .box {
        padding: 0.5em;
        width: 100%;
        margin: 0.5em;
    }

    .box-2 {
        padding: 0.5em;
        width: calc(100%/2 - 1em);
    }

    /* .options label,
    .options input {
        width: 4em;
        padding: 0.5em 1em;
    } */

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
                                <label for="first_Name" class="form-label">First Name</label>
                                <input name="first_Name" type="text" class="form-control" id="first_Name" placeholder="First Name" value="{{$member->first_Name}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="last_Name" class="form-label">Last Name</label>
                                <input name="last_Name" type="text" class="form-control" id="last_Name" placeholder="Last Name" value="{{$member->last_Name}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="designation" class="form-label">Designation</label>
                                <input name="designation" type="text" class="form-control" id="designation" placeholder="Designation" value="{{$member->designation}}" required>
                            </div>
                            <div class="mb-3">
                                <label for="picture" class="form-label">Picture</label>
                                <input name="picture" type="file" class="form-control" id="picture" accept="image/png, image/jpeg">
                                <input name="savedpicture" type="hidden" class="form-control" id="savedpicture" value="">
                                <div class="box-2">
                                    <div class="result"></div>
                                </div>
                                <div class="box-2 img-result <?php echo $memberPicture?->img_blob ? '' : 'hide' ?>">
                                    <img class="cropped" src="{{$memberPicture?->img_blob}}" alt="" />
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
                                <object data="{{ route('request.getPdf' , $member->delegates_uid ) }}" type="application/pdf" width="100%" height="1000px">
                                    <p>Your browser does not support PDF embedding. You can <a href="{{ route('request.getPdf' , $member->delegates_uid ) }}">download the PDF</a> instead.</p>
                                </object>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update Member" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<main class="page">
    <div class="box-2">
        <div class="result"></div>
    </div>
    <div class="box-2 img-result hide">
        <img class="cropped" src="" alt="">
    </div>
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
        document.getElementById('savedpicture').value = imgSrc;
        dwn.classList.remove('hide');
        dwn.download = 'imagename.png';
        dwn.setAttribute('href', imgSrc);
    });

</script>
@endsection
@endauth
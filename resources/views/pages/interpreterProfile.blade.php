@auth
@extends('layouts.layout')
@section("content")

<div id="liveAlertPlaceholder"></div>
<div class="row">

    @if($interpreter->interpreter_officer)
    <div class="col-lg-4 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <div class="mb-4">
                    <h5 class="card-title fw-semibold">Interpreter Picture</h5>
                </div>
                <img src="{{$interpreter->image?$interpreter->image->base64_image:asset('assets/images/profile/user-1.jpg')}}" width="200px" height="200px" class="rounded mx-auto d-block" alt="Interpreter Profile Picture">
                <br />
                <form action="{{session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'interpreter' ?route('request.imageUpload'):''}}" method="POST" enctype="multipart/form-data">
                    <fieldset <?php echo session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'interpreter' ? '' : 'disabled' ?>>
                        <div class="input-group">
                            <input type="hidden" value="{{$interpreter->interpreter_officer}}" name="id" /> 
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
                    <h5 class="card-title fw-semibold ">Interpreter Does Not Active His/Her Profile yet</h5>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="col-lg-8 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Interpreter Information</h5>
                <div class="table-responsive">
                    <form name="interpreterInfo" id="interpreterInfo" method="POST" action="{{session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'delegate' ?route('request.updateInterpreterRequest',$interpreter->interpreter_uid):''}}">
                        <fieldset <?php echo session()->get('user')->roles[0]->name == 'admin' || session()->get('user')->roles[0]->name == 'interpreter' ? '' : 'disabled' ?>>
                            <legend>Interpreter Information</legend>
                            @csrf
                            <div class="mb-3">
                                <label for="interpreter_rank" class="form-label">Interpreter Rank</label>
                                <select name="interpreter_rank" id="interpreter_rank" class="form-select">
                                    <option value="" selected disabled hidden> Select Rank </option>
                                    @foreach (\App\Models\Rank::all() as $renderRank)
                                    <option value="{{$renderRank->ranks_uid}}" <?php echo $interpreter->interpreter_rank == $renderRank->ranks_uid ? 'selected' : '' ?>>{{$renderRank->ranks_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="interpreter_first_Name" class="form-label">Interpreter First Name</label>
                                <input name="interpreter_first_Name" type="text" class="form-control" id="interpreter_first_Name" placeholder="First Name" value="{{$interpreter->interpreter_first_name}}" required>   
                            </div>
                            <div class="mb-3">
                                <label for="interpreter_last_Name" class="form-label">Interpreter Last Name</label>
                                <input name="interpreter_last_name" type="text" class="form-control" id="interpreter_last_name" placeholder="Last Name" value="{{$interpreter->interpreter_last_name}}" required>   
                            </div>
                            <div class="mb-3">
                                <label for="interpreter_designation" class="form-label">Designation</label>
                                <input name="interpreter_designation" type="text" class="form-control" id="interpreter_designation" placeholder="Designation" value="{{$interpreter->interpreter_designation}}" required>   
                            </div>
                            <div class="mb-3">
                                <label for="contact" class="form-label">Contact</label>
                                <input name="interpreter_contact" type="text" minlength='0' maxlength='11' class="form-control" id="contact" placeholder="Interpreter Contact Number" value="{{$interpreter->interpreter_contact}}" required>    
                            </div>
                            <div class="mb-3">
                                <label for="interpreter_identity" class="form-label">Passport/Identity</label>
                                <input name="interpreter_identity" type="text" class="form-control" id="interpreter_identity" placeholder="Passport" value="{{$interpreter->interpreter_identity}}">    
                            </div>
                            <input type="hidden" name="interpreter_uid" value="{{$interpreter->interpreter_uid}}" />    
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
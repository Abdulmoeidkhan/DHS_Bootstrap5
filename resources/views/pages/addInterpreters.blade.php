@auth
@extends('layouts.layout')
@section("content")
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">New Interpreter</h5>
                <div class="table-responsive">
                    <form name="interpreterBasicInfo" id="interpreterBasicInfo" method="POST" action="{{route('request.addInterpreter')}}" enctype="multipart/form-data">
                        <fieldset>
                            <legend>Add Interpreter Form</legend>
                            @csrf
                            <div class="mb-3">
                                <label for="interpreter_rank" class="form-label">Rank</label>
                                <select name="interpreter_rank" id="interpreter_rank" class="form-select">
                                    <option value="" selected disabled hidden> Select Rank </option>
                                    @foreach (\App\Models\Rank::all() as $renderRank)
                                    <option value="{{$renderRank->ranks_uid}}">{{$renderRank->ranks_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="interpreter_designation" class="form-label">Designation</label>
                                <input name="interpreter_designation" type="text" class="form-control" id="interpreter_designation" placeholder="Interpreter Officer Designation" />
                            </div>
                            <div class="mb-3">
                                <label for="interpreter_first_name" class="form-label">First Name</label>
                                <input name="interpreter_first_name" type="text" class="form-control" id="interpreter_first_name" placeholder="Interpreter First Name" />
                            </div>
                            <div class="mb-3">
                                <label for="interpreter_last_name" class="form-label">Last Name</label>
                                <input name="interpreter_last_name" type="text" class="form-control" id="interpreter_last_name" placeholder="Interpreter Last Name" />
                            </div>
                            <div class="mb-3">
                                <label for="interpreter_contact" class="form-label">Contact Number</label>
                                <input name="interpreter_contact" type="number" class="form-control" id="interpreter_contact" placeholder="Interpreter Contact Number" />
                            </div>
                            <div class="mb-3">
                                <label for="interpreter_identity" class="form-label">Interpreter CNIC</label>
                                <input name="interpreter_identity" type="number" class="form-control" id="interpreter_identity" placeholder="Interpreter Identity" />
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Add Interpreter" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endauth
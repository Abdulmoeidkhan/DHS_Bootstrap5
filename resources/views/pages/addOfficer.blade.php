@auth
@extends('layouts.layout')
@section("content")
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">New Officer</h5>
                <div class="table-responsive">
                    <form name="officerBasicInfo" id="officerBasicInfo" method="POST" action="{{route('request.addOfficer')}}" enctype="multipart/form-data">
                        <fieldset>
                            <legend>Add Officer Form</legend>
                            @csrf
                            <div class="mb-3">
                                <label for="officer_rank" class="form-label">Rank</label>
                                <select name="officer_rank" id="officer_rank" class="form-select">
                                    <option value="" selected disabled hidden> Select Rank </option>
                                    @foreach (\App\Models\Rank::all() as $renderRank)
                                    <option value="{{$renderRank->ranks_uid}}">{{$renderRank->ranks_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="officer_first_name" class="form-label">First Name</label>
                                <input name="officer_first_name" type="text" class="form-control" id="officer_first_name" placeholder="Officer First Name" required />
                            </div>
                            <div class="mb-3">
                                <label for="officer_last_name" class="form-label">Last Name</label>
                                <input name="officer_last_name" type="text" class="form-control" id="officer_last_name" placeholder="Officer Last Name" required />
                            </div>
                            <div class="mb-3">
                                <label for="officer_type" class="form-label">Rank</label>
                                <select name="officer_type" id="officer_type" class="form-select">
                                    <option value="" selected disabled hidden> Select Rank </option>
                                    <option value="" > Select Rank </option>
                                    <option value="" > Select Rank </option>
                                    <option value="" > Select Rank </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="officer_designation" class="form-label">Designation</label>
                                <input name="officer_designation" type="text" class="form-control" id="officer_designation" placeholder="Officer Officer Designation" required />
                            </div>
                            <div class="mb-3">
                                <label for="officer_contact" class="form-label">Contact Number</label>
                                <input name="officer_contact" type="number" class="form-control" id="officer_contact" placeholder="Officer Contact Number" required />
                            </div>
                            <div class="mb-3">
                                <label for="officer_identity" class="form-label">Officer CNIC</label>
                                <input name="officer_identity" type="number" class="form-control" id="officer_identity" placeholder="Officer Identity" required />
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Add Officer" required />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endauth
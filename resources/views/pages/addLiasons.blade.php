@auth
@extends('layouts.layout')
@section("content")
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">New Liason</h5>
                    <div class="table-responsive">
                        <form name="liasonBasicInfo" id="liasonBasicInfo" method="POST" action="{{route('request.addLiason')}}" enctype="multipart/form-data">
                            <fieldset>
                                <legend>Add Liason Form</legend>
                                @csrf
                                <div class="mb-3">
                                    <label for="liason_rank" class="form-label">Rank</label>
                                    <input name="liason_rank" type="text" class="form-control" id="liason_rank" placeholder="Liason Officer Rank" />
                                </div>
                                <div class="mb-3">
                                    <label for="liason_designation" class="form-label">Designation</label>
                                    <input name="liason_designation" type="text" class="form-control" id="liason_designation" placeholder="Liason Officer Designation" />
                                </div>
                                <div class="mb-3">
                                    <label for="liason_first_name" class="form-label">First Name</label>
                                    <input name="liason_first_name" type="text" class="form-control" id="liason_first_name" placeholder="Liason First Name" />
                                </div>
                                <div class="mb-3">
                                    <label for="liason_last_name" class="form-label">Last Name</label>
                                    <input name="liason_last_name" type="text" class="form-control" id="liason_last_name" placeholder="Liason Last Name" />
                                </div>
                                <div class="mb-3">
                                    <label for="liason_contact" class="form-label">Contact Number</label>
                                    <input name="liason_contact" type="number" class="form-control" id="liason_contact" placeholder="Liason Contact Number" />
                                </div>
                                <div class="mb-3">
                                    <label for="liason_identity" class="form-label">Liason CNIC</label>
                                    <input name="liason_identity" type="number" class="form-control" id="liason_identity" placeholder="Liason Identity" />
                                </div>
                                <input type="submit" name="submit" class="btn btn-primary" value="Add Liason" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endauth
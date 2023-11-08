@auth
@extends('layouts.layout')
@section("content")
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">New Hotel</h5>
                <div class="table-responsive">
                    <form name="memberBasicInfo" id="memberBasicInfo" method="POST" action="{{!empty($hotel)?route('request.updateHotel',$hotel->hotel_uid):route('request.addHotel')}}">
                        <fieldset>
                            <legend>Add Hotel</legend>
                            @csrf
                            <div class="mb-3">
                                <label for="hotel_names" class="form-label">Hotel Name</label>
                                <input name="hotel_names" type="text" class="form-control" id="hotel_names" value="{{!empty($hotel)?$hotel->hotel_names:''}}" placeholder="Hotel Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="hotel_address" class="form-label">Hotel Address</label>
                                <input name="hotel_address" type="text" class="form-control" id="hotel_address" value="{{!empty($hotel)?$hotel->hotel_address:''}}" placeholder="Hotel Address" required>
                            </div>
                            <div class="mb-3">
                                <label for="contact_person" class="form-label">Contact Person</label>
                                <input name="contact_person" type="text" class="form-control" id="contact_person" value="{{!empty($hotel)?$hotel->contact_person:''}}" placeholder="Contact Person" required>
                            </div>
                            <div class="mb-3">
                                <label for="contact_number" class="form-label">Contact Number</label>
                                <input name="contact_number" type="text" class="form-control" id="contact_number" value="{{!empty($hotel)?$hotel->contact_number:''}}" placeholder="Contact Number" required>
                            </div>
                            <div class="mb-3">
                                <label for="hotel_remarks" class="form-label">Hotel Remarks</label>
                                <input name="hotel_remarks" type="text" class="form-control" id="hotel_remarks" value="{{!empty($hotel)?$hotel->hotel_remarks:''}}" placeholder="Hotel Remarks" required>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="{{!empty($hotel)?'Update Hotel':'Add Hotel'}}" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endauth
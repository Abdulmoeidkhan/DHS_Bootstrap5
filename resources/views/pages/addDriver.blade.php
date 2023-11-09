@auth
@extends('layouts.layout')
@section("content")
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">{{!empty($driver)?"Update Driver":"New Driver"}}</h5>
                <div class="table-responsive">
                    <form name="addDriverInfo" id="addDriverInfo" method="POST" action="{{!empty($driver)?route('request.updateDriver',$driver->driver_uid):route('request.addDriver')}}">
                        <fieldset>
                            <legend>{{!empty($driver)?"Update Driver":"Add Driver"}}</legend>
                            @csrf
                            <div class="mb-3">
                                <label for="driver_name" class="form-label">Driver Name</label>
                                <input name="driver_name" type="text" class="form-control" id="driver_name" value="{{!empty($driver)?$driver->driver_name:''}}" placeholder="Driver Name" required>
                            </div>
                            <div class="mb-3">
                                <label for="driver_cnic" class="form-label">Driver CNIC</label>
                                <input name="driver_cnic" type="number" class="form-control" id="driver_cnic" value="{{!empty($driver)?$driver->driver_cnic:''}}" placeholder="Driver CNIC" required>
                            </div>
                            <div class="mb-3">
                                <label for="driver_contact" class="form-label">Driver Contact</label>
                                <input name="driver_contact" type="text" class="form-control" id="driver_contact" value="{{!empty($driver)?$driver->driver_contact:''}}" placeholder="Contact Person" required>
                            </div>
                            <div class="mb-3">
                                <label for="driver_remarks" class="form-label">Driver Remarks</label>
                                <input name="driver_remarks" type="text" class="form-control" id="driver_remarks" value="{{!empty($driver)?$driver->driver_remarks:''}}" placeholder="Driver Remarks" required>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="{{!empty($driver)?'Update Driver':'Add Driver'}}" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endauth
@auth
@extends('layouts.layout')
@section("content")
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">{{!empty($car)?"Update Car":"New Car"}}</h5>
                <div class="table-responsive">
                    <form name="addCarInfo" id="addCarInfo" method="POST" action="{{!empty($car)?route('request.updateCar',$car->car_uid):route('request.addCar')}}">
                        <fieldset>
                            <legend>{{!empty($car)?"Update Car":"Add Car"}}</legend>
                            @csrf
                            <div class="mb-3">
                                <label for="car_number" class="form-label">Car Number</label>
                                <input name="car_number" type="text" class="form-control" id="car_number" value="{{!empty($car)?$car->car_number:''}}" placeholder="Car Number" required>
                            </div>
                            <div class="mb-3">
                                <label for="car_makes" class="form-label">Car Makes</label>
                                <input name="car_makes" type="text" class="form-control" id="car_makes" value="{{!empty($car)?$car->car_makes:''}}" placeholder="Car Makes" required>
                            </div>
                            <div class="mb-3">
                                <label for="car_model" class="form-label">Car Model</label>
                                <input name="car_model" type="text" class="form-control" id="car_model" value="{{!empty($car)?$car->car_model:''}}" placeholder="Car  Model" required>
                            </div>
                            <div class="mb-3">
                                <label for="driver_uid" class="form-label">Drivers</label>
                                <select class="form-select" aria-label="Driver Select" id="driver_uid" name="driver_uid" required>
                                    <option value="" selected disabled hidden> Select Driver </option>
                                    @foreach($drivers as $key=>$driver)
                                    @if(!empty($car) && $car->driver_uid === $driver->driver_uid)
                                    <option value="{{$driver->driver_uid}}" selected>{{$driver->driver_name}}</option>
                                    @else
                                    <option value="{{$driver->driver_uid}}"> {{$driver->driver_name}} </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="car_remarks" class="form-label">Car Remarks</label>
                                <input name="car_remarks" type="text" class="form-control" id="car_remarks" value="{{!empty($car)?$car->car_remarks:''}}" placeholder="Car Remarks" required>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="{{!empty($car)?'Update Car':'Add Car'}}" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endauth
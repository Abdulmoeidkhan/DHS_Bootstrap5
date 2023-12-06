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
                                <label for="car_vendor" class="form-label">Car Vendor</label>
                                <input name="car_vendor" type="text" class="form-control" id="car_vendor" value="{{!empty($car)?$car->car_vendor:''}}" placeholder="Car Vendor" required>
                            </div>
                            <div class="mb-3">
                                <label for="car_color" class="form-label">Car Color</label>
                                <input name="car_color" type="text" class="form-control" id="car_color" value="{{!empty($car)?$car->car_color:''}}" placeholder="Car Color" required>
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
                                    @elseif($driver->driver_status ==1)
                                    <option value="{{$driver->driver_uid}}">{{$driver->driver_name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="car_category" class="form-label">Car Category</label>
                                <select class="form-select" aria-label="Car Category Select" id="car_category" name="car_category" required>
                                    <option value="" selected disabled hidden> Select Car Category </option>
                                    @foreach($carcategorys as $key=>$carcategory)
                                    @if(!empty($car) && $car->car_category === $carcategory->car_category_uid)
                                    <option value="{{$carcategory->car_category_uid}}" selected>{{$carcategory->car_category}}</option>
                                    @else
                                    <option value="{{$carcategory->car_category_uid}}"> {{$carcategory->car_category}} </option>
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
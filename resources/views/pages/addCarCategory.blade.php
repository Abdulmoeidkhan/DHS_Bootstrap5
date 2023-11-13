@auth
@extends('layouts.layout')
@section("content")
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">{{!empty($carcategory)?"Update Car Category":"New Car Category"}}</h5>
                <div class="table-responsive">
                    <form name="addCarCategoryInfo" id="addCarCategoryInfo" method="POST" action="{{!empty($carcategory)?route('request.updateCarCategory',$carcategory->car_uid):route('request.addCarCategory')}}">
                        <fieldset>
                            <legend>{{!empty($carcategory)?"Update Car Category":"Add Car Category"}}</legend>
                            @csrf
                            <div class="mb-3">
                                <label for="car_category" class="form-label">Car Category</label>
                                <input name="car_category" type="text" class="form-control" id="car_category" value="{{!empty($carcategory)?$carcategory->car_category:''}}" placeholder="Car Category" required>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="{{!empty($carcategory)?'Update Car Category':'Add Car Category'}}" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endauth
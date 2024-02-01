@auth
@extends('layouts.layout')
@section("content")

<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Assign Delegation Details</h5>
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">S.No</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Hotel</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Standard</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Suite</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Superior</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Double Occupance</h6>
                            </th>
                        </tr>
                    </thead>
                    @if($hotelPlans!=null)
                    <tbody>
                        <tr>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">1</h6>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">{{$hotelPlans->hotelName->hotel_names}}</p>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-1 text-capitalize">{{$hotelPlans->hotel_roomtype_standard}}</h6>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">{{$hotelPlans->hotel_roomtype_suite}}</p>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">{{$hotelPlans->hotel_roomtype_superior}}</p>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">{{$hotelPlans->hotel_roomtype_doubleOccupancy}}</p>
                            </td>
                        </tr>
                    </tbody>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@endauth
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
                                <h6 class="fw-semibold mb-0">Country</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Invited By</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Address</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Exhibition</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Members</h6>
                            </th>
                            <!-- <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Delegate Profile</h6>
                            </th> -->
                        </tr>
                    </thead>
                    @if($delegation!=null)
                    <tbody>
                        <tr>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">1</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-1 text-capitalize">{{$delegation?$delegation->country:''}}</h6>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">{{$delegation?$delegation->vip->vips_name:''}}</p>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">{{$delegation?$delegation->address:''}}</p>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">{{$delegation?$delegation->exhibition:''}}</p>
                            </td>
                            <td class="border-bottom-0">
                                <div class="mb-0 fw-normal">
                                    <a class="btn btn-outline-danger" href="{{$delegation?route('pages.members',$delegation->uid):''}}">
                                        <i class="ti ti-users" style="font-size: 24px;"></i>
                                    </a>
                                </div>
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
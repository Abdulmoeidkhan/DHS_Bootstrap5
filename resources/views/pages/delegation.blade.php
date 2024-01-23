@auth
@extends('layouts.layout')
@section("content")
    <div class="row">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Invitation Details</h5>
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
                                    <h6 class="fw-semibold mb-0">Delegation Response</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Address</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Exhibition</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Delegation Code</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Delegate & Members</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">1</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1 text-capitalize">{{$delegation->country}}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">{{$delegation->vip->rank_name->ranks_name}}</p>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        @if($delegation->delegation_response ==="Accepted")
                                        <span class="badge bg-success rounded-3 fw-semibold">Accepted</span>
                                        @else
                                        <h6 class="fw-semibold mb-1">{{$delegation->delegation_response}}</h6>
                                        @endif
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">{{$delegation->address}}</p>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">{{$delegation->exhibition}}</p>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">{{$delegation->delegationCode}}</p>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2 justify-content-center ">
                                        <a class="btn btn-outline-success" href="{{route('pages.delegateProfile')}}">
                                            <i class="ti ti-user-check" style="font-size: 24px;"></i>
                                        </a>
                                        <a class="btn btn-outline-badar" href="{{route('pages.members',session()->get('user')->uid)}}">
                                            <i class="ti ti-user-plus" style="font-size: 24px;"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@endauth
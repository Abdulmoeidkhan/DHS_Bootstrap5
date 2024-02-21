@auth
@extends('layouts.layout')
@section("content")
<div class="row">
    <div class="card w-100">
        <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">Delegation Badge Printing</h5>
            <div class="table-responsive text-center">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0 ">
                                <h6 class="fw-semibold mb-0">S.No</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Name</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Designation</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Delegation Type</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Rank</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">E-Badge</h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($delegates as $index => $delegate)
                        <tr>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">{{$index+1}}</h6>
                            </td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-1 text-capitalize">
                                    {{$delegate->first_Name.' '.$delegate->last_Name}}
                                </h6>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">{{$delegate->designation}}</p>
                            </td>
                            <td class="border-bottom-0">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="fw-normal mx-auto">{{$delegate->self == 1 && $delegate->delegation_type == 'Member' ? "Member":"Head"}}</span>
                                </div>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal">
                                    @foreach(\App\Models\Rank::where('ranks_uid',$delegate->rank)->get() as $renderRank)
                                    {{$renderRank->ranks_name}}
                                    @endforeach
                                </p>
                            </td>
                            <td class="border-bottom-0">
                                <div class="d-flex align-items-center gap-2">
                                    <a class="btn btn-outline-success mx-auto" href="{{route('pages.e-badge',$delegate->delegates_uid)}}">
                                        <i class="ti ti-id-badge-2" style="font-size: 24px;"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@endauth
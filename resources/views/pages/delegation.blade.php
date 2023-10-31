@auth
@extends('layouts.layout')
@section("content")
@if(session('message'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <div>{{session('message')}}</div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@elseif(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <div>{{session('error')}}</div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="container-fluid">
    <div class="row">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">User Panel</h5>
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
                            @foreach($users as $index => $user)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{$index+1}}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1 text-capitalize">{{$user->name}}</h6>
                                    <span class="fw-normal">{{$user->roles[0]->display_name}}</span>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">{{$user->email}}</p>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="fw-normal">{{$user->contact_number?$user->contact_number:"Not Provided"}}</span>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        @if($user->activated)
                                        <span class="badge bg-success rounded-3 fw-semibold">Activated</span>
                                        @else
                                        <h6 class="fw-semibold mb-1">{{$user->activation_code}}</h6>
                                        @endif
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <livewire:user-status-component :userStatus='$user->status' :user='$user' />
                                    
                                </td>
                                <td class="border-bottom-0">
                                    <livewire:user-update-component :userStatus='$user->status' :user='$user' />
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endauth
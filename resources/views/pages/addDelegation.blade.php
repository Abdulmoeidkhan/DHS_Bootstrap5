@auth
@extends('layouts.layout')
@section("content")
<div class="container-fluid">
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
    @if(session()->get('user')->roles[0]->name === "admin")
    <div class="row">
        <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#VIPModal">Add VIP'S</button>
            &nbsp;
            &nbsp;
            &nbsp;
            &nbsp;
            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#DelegateModal">Add Delegates</button>
            <div class="modal fade" id="VIPModal" tabindex="-1" aria-labelledby="VIPModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">VIP's Form</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <livewire:add-vips-component />
                    </div>
                </div>
            </div>
            <div class="modal fade" id="DelegateModal" tabindex="-1" aria-labelledby="DelegateModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delegates Form</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <livewire:add-delegate-component />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br />
    @endif
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">New Delegation</h5>
                    <div class="table-responsive">
                        <form name="delegationBasicInfo" id="delegationBasicInfo" method="POST" action="{{route('request.addDelegationRequest')}}" enctype="multipart/form-data">
                            <fieldset>
                                <legend>Add Delegation Form</legend>
                                @csrf
                                <livewire:country-select-component />
                                <livewire:invited-by-component />
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea name="address" class="form-control" id="address" placeholder="Address"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="eventSelect" class="form-label">Event Name</label>
                                    <select class="form-select" aria-label="Event Name" id="eventSelect" required>
                                        @foreach($events as $event)
                                        <option value="{{$event->name}}"> {{$event->name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <livewire:delegate-component />
                                <input type="submit" name="submit" class="btn btn-primary" value="Add Event" />
                            </fieldset>
                        </form>
                    </div>
                    <br />
                    <script async src="https://unpkg.com/axios/dist/axios.min.js"></script>
                    <script async src="{{asset('assets/js/formValidations.js')}}"></script>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@endauth
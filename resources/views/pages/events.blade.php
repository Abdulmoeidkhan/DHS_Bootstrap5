@auth
@extends('layouts.layout')
@section("content")
<div class="container-fluid">
    <!--  Row 1 -->
    @if(session()->get('user')->roles[0]->name === "admin")
    <div class="row">
        <div class="d-flex justify-content-center">
            <a type="button" href="{{route('pages.addEvent')}}" class="btn btn-outline-success">Add Event</a>
        </div>
    </div>
    @endif
    <div class="row mt-5">
        <ul class="nav nav-pills mb-3 d-flex justify-content-center" id="pills-tab" role="tablist">
            <li class="nav-item mx-2" role="presentation">
                <button class="btn btn-outline-primary active" id="current-event" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Upcoming</button>
            </li>
            <li class="nav-item mx-2" role="presentation">
                <button class="btn btn-outline-warning" id="past-event" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Past</button>
            </li>
            <li class="nav-item mx-2" role="presentation">
                <button class="btn btn-outline-dark " id="all-event" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">All</button>
            </li>
        </ul>
        <div class="tab-content mt-5" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="current-event" tabindex="0">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($futureEvents as $futureEvent)
                    <div class="col" id="{{$futureEvent->uid}}">
                        <div class="card">
                            <img src="{{ Storage::url($futureEvent->banner) }}" class="card-img-top" alt="{{$futureEvent->name}} Picture">
                            <div class="card-body">
                                <h5 class="card-title text-capitalize">{{$futureEvent->name}}</h5>
                                <p class="card-text">{{$futureEvent->description ? $futureEvent->description : ""}}</p>
                                <p class="card-text">Start Date : {{$futureEvent->start_date}}</p>
                                <p class="card-text">End Date : {{$futureEvent->end_date}}</p>
                                <p class="card-text">Number Of Days : {{$futureEvent->days}}</p>
                                <p class="card-text">Venue : {{$futureEvent->venue}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @if(sizeof($futureEvents) < 1)
                    <p>No Upcoming Event Available !</p>
                    @endif
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="past-event" tabindex="0">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach($pastEvents as $pastEvent)
                    <div class="col" id="{{$pastEvent->uid}}">
                        <div class="card">
                            <img src="{{ Storage::url($pastEvent->banner) }}" class="card-img-top" alt="{{$pastEvent->name}} Picture">
                            <div class="card-body">
                                <h5 class="card-title text-capitalize">{{$pastEvent->name}}</h5>
                                <p class="card-text">{{$pastEvent->description ? $pastEvent->description : ""}}</p>
                                <p class="card-text">Start Date : {{$pastEvent->start_date}}</p>
                                <p class="card-text">End Date : {{$pastEvent->end_date}}</p>
                                <p class="card-text">Number Of Days : {{$pastEvent->days}}</p>
                                <p class="card-text">Venue : {{$pastEvent->venue}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="all-event" tabindex="0">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($allEvents as $allEvent)
                    <div class="col" id="{{$allEvent->uid}}">
                        <div class="card">
                            <img src="{{ Storage::url($allEvent->banner) }}" class="card-img-top" alt="{{$pastEvent->name}} Picture">
                            <div class="card-body">
                                <h5 class="card-title text-capitalize">{{$allEvent->name}}</h5>
                                <p class="card-text">{{$allEvent->description ? $allEvent->description:""}}</p>
                                <p class="card-text">Start Date : {{$allEvent->start_date}}</p>
                                <p class="card-text">End Date : {{$allEvent->end_date}}</p>
                                <p class="card-text">Number Of Days : {{$allEvent->days}}</p>
                                <p class="card-text">Venue : {{$allEvent->venue}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>


@endsection
@endauth
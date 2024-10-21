<div class="col-lg-{{$firstCol}}">
    <div class="row">
        <div class="col-lg-{{$secondCol}}">
            <div class="card overflow-hidden mb-1 ">
                <div class="card-body p-4 ">
                    <h5 class="card-title mb-9 fw-semibold text-center">{{$heading}}
                        <span wire:click="update" wire:loading.class='spinner'>
                            <i class="ti ti-refresh text-dark"></i>
                        </span>
                    </h5>
                    <div class="row align-items-center">
                        <div class="col-12">
                            <h4 class="fw-semibold mb-3 text-center">
                                @if(isset($childComp))
                                <b>
                                    {{$calcultedValue['totalcount']}}
                                </b>
                                <div class="me-2">
                                    <span class="fs-3">All</span>
                                    <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                                    <span class="fs-3">Assign</span>
                                    <span class="round-8 bg-success rounded-circle me-2 d-inline-block"></span>
                                    <span class="fs-3">Available</span>
                                    <span class="round-8 bg-warning rounded-circle me-2 d-inline-block"></span>
                                </div>
                                @else
                                <b>
                                    {{$calcultedValue}}
                                </b>
                                @endif
                            </h4>
                            <div class="text-center">
                                @if(isset($childComp))
                                @foreach ($childComp as $key=>$comp)
                                <span
                                    class="badge mx-auto my-1 bg-primary rounded-3 fw-semibold text-center">{{$comp['heading']}}
                                    :{{$calcultedValue[$key]}} </span>
                                @endforeach
                                <br />
                                @foreach ($childComp as $key=>$comp)
                                <span
                                    class="badge mx-auto my-1 bg-success rounded-3 fw-semibold text-center">{{$comp['heading']}}
                                    :{{$calcultedValue['assign'][$key]}} </span>
                                @endforeach
                                <br />
                                @foreach ($childComp as $key=>$comp)
                                <span
                                    class="badge mx-auto my-1 bg-warning rounded-3 fw-semibold text-center">{{$comp['heading']}}
                                    :{{$calcultedValue['unassign'][$key]}} </span>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
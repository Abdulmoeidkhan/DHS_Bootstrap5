<!-- <div class="table-responsive"> -->
<form name="carPlan" id="carPlan" <?php echo $isForSaved ? 'wire:submit="save"' : 'wire:submit="update"' ?>>
    <div class="modal-body">
        <fieldset>
            <legend>Add Car Plan Form</legend>
            <div class="mb-3">
                <label for="car_a_quantity" class="col-form-label">Car A Quantity:</label>
                <input type="number" class="form-control" wire:model="carAQuantity">
            </div>
            <div class="mb-3">
                <label for="carSelectA" class="col-form-label">Car A Select :</label>
                <select class="form-select" wire:model="carACarDetail" multiple aria-label="Car To Be Associate" id="carSelectA">
                    @foreach(\App\Models\CarMake::where('car_category_uid','61346491-983a-40ed-8477-2d9ed84e6767')->get() as $key=>$car)
                    @if($car->car_make_name)
                    <option class="text-capitalize" value="{{$car->id}}" {{in_array($car->id, $carACarDetail) ? 'selected' : ''}}>
                        {{$car->car_make_name}}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="delegateSelectA" class="col-form-label">Delegate Select :</label>
                <select class="form-select" wire:model="carADetail" multiple aria-label="Delegate To Be Associate" id="delegateSelectA">
                    @foreach(\App\Models\Delegate::where('delegation',$this->delegationUid)->get() as $key=>$delegate)
                    @if($delegate->first_Name)
                    <option class="text-capitalize" value="{{$delegate->delegates_uid}}">
                        {{$delegate->first_Name.' '.$delegate->last_Name.' - '.$delegate->delegation_type}}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="car_b_quantity" class="col-form-label">Car B Quantity:</label>
                <input type="number" class="form-control" wire:model="carBQuantity">
            </div>
            <div class="mb-3">
                <label for="carSelectB" class="col-form-label">Car B Select :</label>
                <select class="form-select" wire:model="carBCarDetail" multiple aria-label="Car To Be Associate" id="carSelectB">
                    @foreach(\App\Models\CarMake::where('car_category_uid','a2f0a2e4-984b-42e9-a4b9-0e9f9d11c8ee')->get() as $key=>$car)
                    @if($car->car_make_name)
                    <option class="text-capitalize" value="{{$car->id}}" {{in_array($car->id, $carBCarDetail) ? 'selected' : ''}}>
                        {{$car->car_make_name}}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="delegateSelectB" class="col-form-label">Delegate Select :</label>
                <select class="form-select" wire:model="carBDetail" multiple aria-label="Delegate To Be Associate" id="delegateSelectB">
                    @foreach(\App\Models\Delegate::where('delegation',$this->delegationUid)->get() as $key=>$delegate)
                    @if($delegate->first_Name)
                    <option class="text-capitalize" value="{{$delegate->delegates_uid}}">
                        {{$delegate->first_Name.' '.$delegate->last_Name.' - '.$delegate->delegation_type}}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="car_c_quantity" class="col-form-label">Car C Quantity:</label>
                <input type="number" class="form-control" wire:model="carCQuantity">
            </div>
            <div class="mb-3">
                <label for="carSelectC" class="col-form-label">Car C Select :</label>
                <select class="form-select" wire:model="carCCarDetail" multiple aria-label="Car To Be Associate" id="carSelectC">
                    @foreach(\App\Models\CarMake::where('car_category_uid','a2f0a2e4-984b-42e9-a4b9-0e9f9d22c9ee')->get() as $key=>$car)
                    @if($car->car_make_name)
                    <option class="text-capitalize" value="{{$car->id}}" {{in_array($car->id, $carCCarDetail) ? 'selected' : ''}}>
                        {{$car->car_make_name}}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="delegateSelectC" class="col-form-label">Delegate Select :</label>
                <select class="form-select" wire:model="carCDetail" multiple aria-label="Delegate To Be Associate" id="delegateSelectC">
                    @foreach(\App\Models\Delegate::where('delegation',$this->delegationUid)->get() as $key=>$delegate)
                    @if($delegate->first_Name)
                    <option class="text-capitalize" value="{{$delegate->delegates_uid}}">
                        {{$delegate->first_Name.' '.$delegate->last_Name.' - '.$delegate->delegation_type}}
                    </option>
                    @endif
                    @endforeach
                </select>
            </div>
            <input type="hidden" wire:model="delegationUid">
        </fieldset>
    </div>
    <div class="modal-footer">
        <button type="button" id="closeBtn" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        @if($isForSaved)
        <input type="submit" name="savePlan" class="btn btn-primary" value="Add Car Plan" class="btn btn-primary" data-bs-dismiss="modal" />
        @else
        <input type="submit" name="updatePlan" class="btn btn-primary" value="Update Car Plan" class="btn btn-primary" data-bs-dismiss="modal" />
        @endif
        <!-- <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button> -->
    </div>
</form>
<!-- <div class="table-responsive"> -->
<form name="hotelPlan" id="hotelPlan" <?php echo $isForSaved ? 'wire:submit="save"' : 'wire:submit="update"' ?>>
    <div class="modal-body">
        <fieldset>
            <legend>Add Hotel Plan Form</legend>
            <div class="mb-3">
                <label for="hotelUid" class="col-form-label">Hotel:</label>
                <select wire:model="hotelUid" class="form-select" required>
                    <option value="" selected disabled hidden>Select Hotel</option>
                    @foreach (\App\Models\Hotel::all() as $Category)
                    @if($hotelUid == $Category->hotel_uid)
                    <option value="{{$Category->hotel_uid}}" wire:key="{{ $Category->hotel_uid }}" selected>{{$Category->hotel_names}}</option>
                    @else
                    <option value="{{$Category->hotel_uid}}" wire:key="{{ $Category->hotel_uid }}">{{$Category->hotel_names}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="hotel_roomtype_suite" class="col-form-label">Suite Quantity:</label>
                <input type="number" class="form-control" wire:model="suiteQuantity" required>
            </div>
            <div class="mb-3">
                <label for="delegateSelectSu" class="col-form-label">Delegate Select :</label>
                <select class="form-select" wire:model="hotelSuiteDetail" multiple aria-label="Delegate To Be Associate" id="delegateSelectSu" >
                    <option value="" selected disabled hidden> Select Delegate To Be Associate </option>
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
                <label for="hotel_roomtype_delux" class="col-form-label">Delux Quantity:</label>
                <input type="number" class="form-control" wire:model="deluxQuantity" required>
            </div>
            <div class="mb-3">
                <label for="delegateSelectDe" class="col-form-label">Delegate Select :</label>
                <select class="form-select" wire:model="hotelDeluxDetail" multiple aria-label="Delegate To Be Associate" id="delegateSelectDe" >
                    <option value="" selected disabled hidden> Select Delegate To Be Associate </option>
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
                <label for="hotel_roomtype_executive" class="col-form-label">Executive Quantity:</label>
                <input type="number" class="form-control" wire:model="execQuantity" required>
            </div>
            <div class="mb-3">
                <label for="delegateSelectEx" class="col-form-label">Delegate Select :</label>
                <select class="form-select" wire:model="hotelExecDetail" multiple aria-label="Delegate To Be Associate" id="delegateSelectEx" >
                    <option value="" selected disabled hidden> Select Delegate To Be Associate </option>
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
                <label for="hotel_roomtype_standard" class="col-form-label">Standard Quantity:</label>
                <input type="number" class="form-control" wire:model="standardQuantity" required>
            </div>
            <div class="mb-3">
                <label for="delegateSelectSt" class="col-form-label">Delegate Select :</label>
                <select class="form-select" wire:model="hotelStandardDetail" multiple aria-label="Delegate To Be Associate" id="delegateSelectSt" >
                    <option value="" selected disabled hidden> Select Delegate To Be Associate </option>
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
                <label for="hotel_roomtype_doubleOccupancy" class="col-form-label">Double Occupancy Quantity:</label>
                <input type="number" class="form-control" wire:model="dOccupancyQuantity" required>
            </div>
            <div class="mb-3">
                <label for="delegateSelectDb" class="col-form-label">Delegate Select :</label>
                <select class="form-select" wire:model="hotelDoubleDetail" multiple aria-label="Delegate To Be Associate" id="delegateSelectDb" >
                    <option value="" selected disabled hidden> Select Delegate To Be Associate </option>
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
        <input type="submit" name="savePlan" class="btn btn-primary" value="Add Hotel Plan" class="btn btn-primary" data-bs-dismiss="modal" />
        @else
        <input type="submit" name="updatePlan" class="btn btn-primary" value="Update Hotel Plan" class="btn btn-primary" data-bs-dismiss="modal" />
        @endif
    </div>
</form>
<!-- </div> -->
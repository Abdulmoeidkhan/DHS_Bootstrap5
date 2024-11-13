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
                <label for="delegateSelectA" class="col-form-label">Delegate Select :</label>
                <select class="form-select" wire:model="carADetail" multiple aria-label="Delegate To Be Associate" id="delegateSelectA">
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
                <label for="car_b_quantity" class="col-form-label">Car B Quantity:</label>
                <input type="number" class="form-control" wire:model="carBQuantity">
            </div>
            <div class="mb-3">
                <label for="delegateSelectB" class="col-form-label">Delegate Select :</label>
                <select class="form-select" wire:model="carBDetail" multiple aria-label="Delegate To Be Associate" id="delegateSelectB" >
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
                <label for="car_c_quantity" class="col-form-label">Car C Quantity:</label>
                <input type="number" class="form-control" wire:model="carCQuantity">
            </div>
            <div class="mb-3">
                <label for="delegateSelectC" class="col-form-label">Delegate Select :</label>
                <select class="form-select" wire:model="carCDetail" multiple aria-label="Delegate To Be Associate" id="delegateSelectC">
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
        <input type="submit" name="savePlan" class="btn btn-primary" value="Add Car Plan" class="btn btn-primary" data-bs-dismiss="modal" />
        @else
        <input type="submit" name="updatePlan" class="btn btn-primary" value="Update Car Plan" class="btn btn-primary" data-bs-dismiss="modal" />
        @endif
        <!-- <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button> -->
    </div>
</form>
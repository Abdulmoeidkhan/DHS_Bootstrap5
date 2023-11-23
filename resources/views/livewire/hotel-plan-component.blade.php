<!-- <div class="table-responsive"> -->
<form name="hotelPlan" id="hotelPlan" <?php echo $isForSaved ? 'wire:submit="save"' : 'wire:submit="update"' ?>>
    <div class="modal-body">
        <fieldset>
            <legend>Add Hotel Plan Form</legend>
            <div class="mb-3">
                <label for="hotel_quantity" class="col-form-label">Room Quantity:</label>
                <input type="number" class="form-control" wire:model="hotelQuantity">
            </div>
            <div class="mb-3">
                <label for="hotelUid" class="col-form-label">Hotel:</label>
                <select wire:model="hotelUid" class="form-select">
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
                <label for="hotelRoomtypeUid" class="col-form-label">Room Type:</label>
                <select wire:model="hotelRoomtypeUid" class="form-select">
                    <option value="" selected disabled hidden>Select Room Type</option>
                    @foreach (\App\Models\Roomtype::all() as $Category)
                    @if($hotelRoomtypeUid == $Category->room_type_uid)
                    <option value="{{$Category->room_type_uid}}" wire:key="{{ $Category->room_type_uid }}" selected>{{$Category->room_type}}</option>
                    @else
                    <option value="{{$Category->room_type_uid}}" wire:key="{{ $Category->room_type_uid }}">{{$Category->room_type}}</option>
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
        <input type="submit" name="savePlan" class="btn btn-primary" value="Add Hotel Plan" class="btn btn-primary" data-bs-dismiss="modal"/>
        @else
        <input type="submit" name="updatePlan" class="btn btn-primary" value="Update Hotel Plan" class="btn btn-primary" data-bs-dismiss="modal"/>
        @endif
    </div>
</form>
<!-- </div> -->
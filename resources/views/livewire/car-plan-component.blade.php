<div class="table-responsive">
    <form name="carPlan" id="carPlan" <?php echo $isForSaved ? 'wire:submit="save"' : 'wire:submit="update"' ?>>
        <fieldset>
            <legend>Add Car Plan Form</legend>
            <div class="mb-3">
                <label for="car_quantity" class="col-form-label">Car Quantity:</label>
                <input type="number" class="form-control" wire:model="carQuantity">
            </div>
            <div class="mb-3">
                <label for="car_category_uid" class="col-form-label">Car Category:</label>
                <select wire:model="carCategory" class="form-select">
                    <option value="" selected disabled hidden>Select Car Category </option>
                    @foreach (\App\Models\CarCategory::all() as $Category)
                    @if($carCategory == $Category->car_category_uid)
                    <option value="{{$Category->car_category_uid}}" wire:key="{{ $Category->car_category_uid }}" selected>{{$Category->car_category}}</option>
                    @else
                    <option value="{{$Category->car_category_uid}}" wire:key="{{ $Category->car_category_uid }}">{{$Category->car_category}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <input type="hidden" wire:model="delegationUid">
            @if($isForSaved)
            <input type="submit" name="savePlan" class="btn btn-primary" value="Add Car Plan" />
            @else
            <input type="submit" name="updatePlan" class="btn btn-primary" value="Update Car Plan" />
            @endif
        </fieldset>
    </form>
</div>
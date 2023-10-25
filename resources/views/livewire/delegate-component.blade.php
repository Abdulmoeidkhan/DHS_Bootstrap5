<div class="mb-3">
    <label for="delegate" class="form-label">Delegate</label>
    <select class="form-select" aria-label="Delegate To Be Associate" id="delegate">
    <option value="" selected disabled hidden> Select Delegate To Be Associate </option>
        @foreach($delegates as $key=>$delegate)
        <option value="{{$delegate->uid}}"> {{$delegate->first_Name.' '.$delegate->last_Name}} </option>
        @endforeach
    </select>
</div>
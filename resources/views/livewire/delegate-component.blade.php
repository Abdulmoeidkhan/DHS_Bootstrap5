<div class="mb-3">
    <label for="delegate" class="form-label">Delegate</label>
    <select class="form-select" aria-label="Delegate To Be Associate" id="delegate">
        @foreach($delegates as $key=>$delegate)
        <option value="{{$delegate->name}}"> {{$delegate->first_Name.' '.$delegate->first_Name}} </option>
        @endforeach
    </select>
</div>
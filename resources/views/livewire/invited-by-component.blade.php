<div class="mb-3">
    <label for="invitedBy" class="form-label">Invited By</label>
    <select class="form-select" aria-label="VIP's Name" id="invitedBy" required>
        @foreach($vips as $key=>$vip)
        <option value="{{$vip->name}}"> {{$vip->name}} </option>
        @endforeach
    </select>
</div>
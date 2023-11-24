<div class="mb-3">
    <label for="invitedBy" class="form-label">Invited By</label>
    <select class="form-select" aria-label="VIP's Name" id="invitedBy" name="invitedBy" required>
    <option value="" selected disabled hidden> Select Invited By </option>
        @foreach($vips as $key=>$vip)
        <option value="{{$vip->vips_uid}}"> {{$vip->vips_name}} </option>
        @endforeach
    </select>
</div>
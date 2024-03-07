<div class="mb-3">
    <label for="invited_by" class="form-label">Invited By</label>
    <select class="form-select" aria-label="VIP's Name" id="invited_by" name="invited_by" required>
        <option value="" selected disabled hidden> Select Invited By </option>
        @foreach($vips as $key=>$vip)
        <option value="{{$vip->vips_uid}}" {{$selectedVip == $vip->vips_uid?'selected':''}}> {{$vip->vips_designation}} </option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label for="invitedBy" class="form-label">Invited By</label>
    <select class="form-select" aria-label="VIP's Name" id="invitedBy" required>
        @foreach($users as $key=>$user)
        <option value="{{$vip->name}}"> {{$user->name}} </option>
        @endforeach
    </select>
</div>
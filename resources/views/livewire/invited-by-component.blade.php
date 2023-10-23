<datalist id="invitedByList">
    @foreach($vips as $key=>$vip)
    <option value="{{$vip->name}}"> {{$vip->name}} </option>
    @endforeach
</datalist>
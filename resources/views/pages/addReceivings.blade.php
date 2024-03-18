@auth
@extends('layouts.layout')
@section("content")
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">New Receiving Officer</h5>
                <div class="table-responsive">
                    <form name="receivingBasicInfo" id="receivingBasicInfo" method="POST" action="{{route('request.addReceiving')}}" enctype="multipart/form-data">
                        <fieldset>
                            <legend>Add Receiving Officer Form</legend>
                            @csrf
                            <div class="mb-3">
                                <label for="receiving_rank" class="form-label">Rank</label>
                                <select name="receiving_rank" id="receiving_rank" class="form-select">
                                    <option value="" selected disabled hidden> Select Rank </option>
                                    @foreach (\App\Models\Rank::all() as $renderRank)
                                    <option value="{{$renderRank->ranks_uid}}">{{$renderRank->ranks_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="receiving_designation" class="form-label">Designation</label>
                                <input name="receiving_designation" type="text" class="form-control" id="receiving_designation" placeholder="Receiving Officer Designation" />
                            </div>
                            <div class="mb-3">
                                <label for="receiving_first_name" class="form-label">First Name</label>
                                <input name="receiving_first_name" type="text" class="form-control" id="receiving_first_name" placeholder="Receiving First Name" />
                            </div>
                            <div class="mb-3">
                                <label for="receiving_last_name" class="form-label">Last Name</label>
                                <input name="receiving_last_name" type="text" class="form-control" id="receiving_last_name" placeholder="Receiving Last Name" />
                            </div>
                            <div class="mb-3">
                                <label for="contact" class="form-label">Contact Number</label>
                                <input name="receiving_contact" type="text" minlength='0' maxlength='11' class="form-control" id="contact" placeholder="Receiving Contact Number" />
                            </div>
                            <div class="mb-3">
                                <label for="receiving_identity" class="form-label">Receiving CNIC</label>
                                <input name="receiving_identity" type="text" class="form-control" id="receiving_identity" placeholder="Receiving Identity" onchange="isNumeric('identity')" title="13 DIGIT CNIC CODE" data-inputmask="'mask': '99999-9999999-9'" required maxlength="15" />
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Add Receiving" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endauth
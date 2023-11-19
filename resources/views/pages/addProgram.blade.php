@auth
@extends('layouts.layout')
@section("content")
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">New Program</h5>
                <div class="table-responsive">
                    <form name="programBasicInfo" id="programBasicInfo" method="POST" action="{{route('request.addProgram')}}">
                        <fieldset>
                            <legend>Add Program Form</legend>
                            @csrf
                            <div class="mb-3">
                                <label for="program_name" class="form-label">Program Name</label>
                                <input name="program_name" type="text" class="form-control" id="program_name" placeholder="Program Name" />
                            </div>
                            <div class="mb-3">
                                <label for="program_day" class="form-label">Program Day</label>
                                <input name="program_day" type="number" class="form-control" id="program_day" placeholder="Program Day ( 1 - 2 - 3)" min="1" max="10" />
                            </div>
                            <div class="mb-3">
                                <label for="program_start_time" class="form-label">Program Start Time</label>
                                <input name="program_start_time" type="number" class="form-control" id="program_start_time" placeholder="Program Start Time (0000 - 2359)" minlength="4" maxlength="4" min="0000" max="2359" />
                            </div>
                            <div class="mb-3">
                                <label for="program_end_time" class="form-label">Program End Time</label>
                                <input name="program_end_time" type="number" class="form-control" id="program_end_time" placeholder="Program End
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                
                                Time (0000 - 2359)" minlength="4" maxlength="4" min="0000" max="2359" />
                            </div>
                            <br/>
                            <input type="submit" name="submit" class="btn btn-primary" value="Add Program" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endauth
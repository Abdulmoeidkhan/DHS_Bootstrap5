@extends('layouts.layout')
@section("content")
<style>
    @media print {
        .btn-contain {
            display: none;
        }

        .app-header {
            display: none;
        }
    }
</style>
<div class="container-fluid">
    <div class="row btn-contain container">
        <div class="d-flex justify-content-center">
            <button class="btn btn-outline-primary" onclick="window.print()">Print this Invitation</button>
        </div>
        <br />
        <br />
    </div>
    <div class="row container-first-child">
        <div class="col-md-12 parent-print-program d-print-inline">
            <div>
                <h3 class="text-capitalize">Dear {{$delegate->first_Name}}&nbsp;{{$delegate->last_Name}} - {{$delegation->country}}</h3>
                <br />
                <br />
                <p>{{config('localvariables.para1')}}</p>
                <p>{{config('localvariables.para2')}}</p>
                <br />
                <div class="container">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Activation Code</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">{{$delegation->delegationCode}}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br />
                <p>
                    {{config('localvariables.para4')}}
                </p>
                <br />
                <ul class="list-group ">
                    <li class="list-group-item">{{config('localvariables.li1')}}</li>
                    <li class="list-group-item">{{config('localvariables.li2')}}</li>
                    <li class="list-group-item">{{config('localvariables.li3')}}</li>
                    <li class="list-group-item">{{config('localvariables.li4')}}</li>
                </ul>
            </div>
        </div>
    </div>
    <br />
    <br />
    <br />
    <div class="row">
        <div class="col-md-12">
            <div>
                <h2 class="text-capitalize">{{config('localvariables.heading2')}}</h2>
                <br />
                <ul class="list-group ">
                    <li class="list-group-item">{{config('localvariables.li5')}}</li>
                    <li class="list-group-item">{{config('localvariables.li6')}}</li>
                    <li class="list-group-item">{{config('localvariables.li7')}}</li>
                    <li class="list-group-item">{{config('localvariables.li8')}}</li>
                </ul>
                <br />
                <p class="blockquote">
                    <?php echo config('localvariables.eventName'); ?>
                </p>
                <!-- <p>
                    Location : <?php echo config('localvariables.eventLocation'); ?>
                </p>
                <p>
                    Date : <?php echo config('localvariables.eventDate'); ?>
                </p> -->
            </div>
        </div>
    </div>
    <div class="row container-first-child">
        <div class="col-md-12 parent-print-program">
            <div>
                <br />
                <h2>How to Print your e-Badge?</h2>

                <p>Go to the Badge Tab in Navigation Bar (Side Bar)</p>
                <p>
                    Click on the Blue Button in a row to print required Badge
                </p>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <br />
            <div>
                <h2>Important Note:</h2>
                <br />
                <p class="blockquote">
                <ol>
                    <li class="list-group-item">If you have more than one delegate, you can enter that information with “Add New” and enter your required information and save.</li>
                    <li class="list-group-item">For your participation confirmation on IDEAS 2022, you will need your e- Badge paper print along with further required documents at your “Arrival” in Pakistan. Please bring your e-Badge print copy and show our Airport Welcome Desk or assigned receiving officer.</li>
                </ol>
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <br />
            <div>
                <h2>Contact Information:</h2>
                <br />
                <p class="blockquote">
                <ol>
                    <li class="list-group-item">
                        DEFENCE EXPORT PROMOTION ORGANIZATION E-10 SECTOR DEFENCE COMPLEX ISLAMABAD
                    </li>
                    <li class="list-group-item">
                        Phone : 92-51-9262017, 92-51-9262031, 92-51-9262042, 92-51-9262018
                        Email : info@depo.gov.pk, www.depo.gov.pk
                    </li>
                </ol>
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <img src="{{asset('images/icons/Partners.png')}}" style="width:100%;" alt="Partners LOGO" />
    </div>
</div>
@endsection
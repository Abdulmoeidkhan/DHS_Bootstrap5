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

        .container-fluid {
            font-size: 12px;
            font-family: Arial, Helvetica, sans-serif;
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
                <h3 class="text-capitalize">Dear {{$delegate->rankName->ranks_name}}&nbsp;{{$delegate->first_Name}}&nbsp;{{$delegate->last_Name}} - {{$delegation->country}}</h3>
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
                <!-- <p class="blockquote">
                    <?php echo config('localvariables.eventName'); ?>
                </p> -->
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
                <h2>To Print your e-Badge?</h2>

                <p>Navigate to the Badge Tab in the Navigation Bar (Side Bar).</p>
                <p>
                    Click on the Blue Button in the corresponding row to print the required Badge.
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
                    <li class="list-group-item">1. If you have multiple delegates, you can add their information by selecting "Add New" and entering the required details.</li>
                    <li class="list-group-item">2. Upon your arrival in Pakistan, please present a printed copy of your e-Badge along with any other necessary documents at the Airport Welcome Desk or to the assigned receiving officer.</li>
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
                        DEFENCE EXPORT PROMOTION ORGANIZATION
                    </li>
                    <li class="list-group-item">
                        Sector E-10, Defence Complex Islamabad (DCI), Islamabad - Pakistan
                        Tel: 92-51-9262017, 92-51-9262031, 92-51-9262042
                        Fax: +92 51 9262018
                        Email: info@depo.org.pk
                        URL: www.depo.gov.pk

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
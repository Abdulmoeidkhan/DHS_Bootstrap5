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

        .container-fluid {
            margin-top: -80px;
        }

        .logo-class {
            width: 120px;
            height: 120px;
        }

    }
</style>
<div class="container-fluid">
    <div class="row btn-contain container">
        <div class="d-flex justify-content-center">
            <button class="btn btn-outline-primary" onclick="window.print()">Print this Invitation</button>
        </div>
    </div>
    <br />
    <div class="row container-first-intro-child">
        <div class="col-md-12 d-flex align-items-center">
            <img src="{{asset('images/icons/ideas_logo_2024.png')}}" width="200px" height="200px" class="logo-class" alt="Partners LOGO" />
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <div style="font-weight: 500; text-decoration:underline; font-size: 12px;" class="d-flex align-items-center">ONLINE REGISTRATION OF DELEGATION</div>
        </div>
    </div>
    <br />
    <div class="row container-first-child">
        <div class="col-md-12 parent-print-program d-print-inline">
            <div>
                <!-- <h3 class="text-capitalize">Dear {{$delegate->rankName->ranks_name}}&nbsp;{{$delegate->first_Name}}&nbsp;{{$delegate->last_Name}} - {{$delegation->country}}</h3> -->
                <h4 class="text-capitalize" style="font-weight: 600; padding-left:2rem">Honorable Delegate,</h4>
                <!-- <br /> -->
                <p style="padding-left:2rem">{{config('localvariables.para1')}}</p>
                <div class="container">
                    <table class="table table-bordered table-hover">
                        <!-- <thead>
                            <tr>
                                <th scope="col"><b style-=>Activation Code</b></th>
                                <th scope="col"><b>QR CODE</b></th>
                                <th scope="col">Secondary Link</th> 
                        </tr>
                        </thead>-->
                        <tbody>
                            <tr>
                                <th scope="row">Activation Code <br /><b>{{$delegation->delegationCode}}</b></th>
                                <th scope="row"><img src="{{asset('images/primary_QR.png')}}" width="100px" height="100px" /></th>
                                <!-- <th scope="row"><img src="{{asset('images/secondary_QR.png')}}" width="100px" height="100px" /></th> -->
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p style="text-align:center">(In case of login/ signup issue please contact on <a href="mailto:support@badarexpo.com">support@badarexpo.com</a> or Whatsapp <b>+92-300-0204623</b>)</p>
                <p style="padding-left:2rem;">
                    {{config('localvariables.para4')}}
                </p>
                <div style="padding-left:2rem;">
                    <ol>
                        <li>{{config('localvariables.li1')}}</li>
                        <li>{{config('localvariables.li2')}}</li>
                        <li>{{config('localvariables.li3')}}</li>
                        <li>{{config('localvariables.li4')}}</li>
                        <li>{{config('localvariables.li5')}}</li>
                        <li>{{config('localvariables.li6')}}</li>
                        <li>{{config('localvariables.li7')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="row container-first-child">
        <div class="col-md-12 parent-print-program d-flex flex-row-reverse">
            <div>
                <p>Regards<br />Team IT DEPO</p>
                <!-- <p></p> -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <br />
            <div>
                <h6 style="padding-left:2rem; text-decoration:underline; font-weight:900;">Contact Information:</h6>
                <ol>
                    <li class="list-group-item">
                        DEFENCE EXPORT PROMOTION ORGANIZATION
                    </li>
                    <li class="list-group-item">
                        Sector E-10, Defence Complex Islamabad (DCI), Islamabad - Pakistan
                        <br />
                        Tel: <b>+92-51-9262011, +92-51-9262031, +92-51-9262042 </b>
                        <br />
                        Fax: <b>+92 51 9262018</b>
                        <br />
                        Email: <a href="mailto:mea@depo.gov.pk">mea@depo.gov.pk</a>
                        <br />
                        URL: <a href="www.depo.gov.pk" target="_blank">www.depo.gov.pk</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <img src="{{asset('images/icons/Partners.png')}}" style="width:80%; height:40%;" alt="Partners LOGO" />
    </div>
</div>
@endsection
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
            font-size: 14px;
            font-family: Arial, Helvetica, sans-serif;
            text-align: justify;
        }

        .container-fluid {
            margin-top: -40px;
            padding-left: 0px;
        }

        .logo-class {
            width: 120px;
            height: 120px;
        }

        .container-mine {
            display: flex;
            justify-content: space-around;
            text-align: center;
            margin: 10px 0px;
        }

    }

    .container-mine {
        display: flex;
        justify-content: space-around;
        text-align: center;
        margin: 20px 0px;
    }
</style>
<div class="container-fluid">
    <div class="row btn-contain container">
        <div class="d-flex justify-content-center">
            <button class="btn btn-outline-primary" onclick="window.print()">Print this Invitation</button>
        </div>
    </div>
    <br />
    <div class="row container-first-intro-child" style="padding-left:2rem;">
        <div class="col-md-12 d-flex align-items-center">
            <img src="{{asset('images/icons/ideas_logo_2024.png')}}" width="200px" height="200px" class="logo-class" alt="Partners LOGO" />
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <div style="font-weight: 600; text-decoration:underline; font-size: 18px; text-align:center; padding-top: 30px;" class="d-flex align-items-center">ONLINE REGISTRATION OF DELEGATION</div>
        </div>
    </div>
    <br />
    <div class="row container-first-child">
        <div class="col-md-12 parent-print-program d-print-inline">
            <div>
                <h4 class="text-capitalize" style="font-weight: 600; padding-left:2rem">Honorable Delegate,</h4>
                <p style="padding-left:2rem;text-indent:2rem;">The Defence Export Promotion Organization team welcome you for the International Defence Exhibition and Seminar IDEAS 2024. Please confirm your attendance by creating account / Login ID on our Online Delegation System at <b><a href="https://delegation.ideaspakistan.gov.pk" target="_blank">www.delegation.ideaspakistan.gov.pk</a></b>. Your Activation Code is given below:- </p>
                <div class="container-mine">
                    <div style="font-weight:bolder; padding-left:8rem;"><br />Activation Code <br /><br /><b>{{$delegation->delegationCode}}</b></div>
                    <div style="padding-right:8rem"><img src="{{asset('images/primary_QR.png')}}" width="100px" height="100px" /></div>
                </div>
                <p style="text-align:center; font-size:12px;">(In case of login/ signup issue please contact on <a href="mailto:support@badarexpo.com">support@badarexpo.com</a> or Whatsapp <b><a href="tel:+923000204623">+92-300-0204623</a></b>)</p>
                <p style="padding-left:2rem; text-indent:2rem;">
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
                <p style="line-height: 14px; margin-bottom:0px;">Regards<br />Team IT DEPO</p>
                <!-- <p></p> -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <br />
            <div>
                <ol>
                    <li class="list-group-item" style="text-decoration:underline; font-weight:900;">
                        Contact Information:
                    </li>
                    <li class="list-group-item">
                        DEFENCE EXPORT PROMOTION ORGANIZATION
                    </li>
                    <li class="list-group-item">
                        Sector E-10, Defence Complex Islamabad (DCI), Islamabad - Pakistan
                        <br />
                        Tel:+92-51-9262011, +92-51-9262031, +92-51-9262042
                        <br />
                        Fax: +92 51 9262018
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
        <img src="{{asset('images/icons/Partners-1.png')}}" style="width:80%; height:40%;" alt="Partners LOGO" />
    </div>
    <br/>
    <div class="row d-flex justify-content-end">{{$delegation->country}}/{{$delegate->invitedByDesignation->vips_designation}} &nbsp;</div>
</div>
@endsection
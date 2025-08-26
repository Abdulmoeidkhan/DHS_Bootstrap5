<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Email Invitation</title>
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
</head>

<body class="antialiased">
    <div class="container-fluid">
        <div class="row container-first-intro-child" style="padding-left:2rem;">
            <div class="col-md-12 d-flex align-items-center">
                <img src="{{asset('images/icons/pimec-2025.png')}}" width="200px" height="200px" class="logo-class"
                    alt="Partners LOGO" />
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                <div style="font-weight: 600; text-decoration:underline; font-size: 18px; text-align:center; padding-top: 30px;"
                    class="d-flex align-items-center">ONLINE REGISTRATION OF DELEGATION</div>
            </div>
        </div>
        <br />
        <div class="row container-first-child">
            <div class="col-md-12 parent-print-program d-print-inline">
                <div>
                    <h4 class="text-capitalize" style="font-weight: 600; padding-left:2rem">Honorable
                        {{$delegate->rankName->ranks_name}}
                        {{$delegate->first_Name}} {{$delegate->last_Name}},</h4>
                    <p style="padding-left:2rem;text-indent:2rem;">The Pakistan International Maritime Expo & Conference
                        (PIMEC) team welcome
                        you for the International Defence Exhibition and Seminar PIMEC 2025. Please confirm your
                        attendance
                        by creating account / Login ID on our Online Delegation System at <b><a
                                href="https://delegation.pimec.gov.pk"
                                target="_blank">www.delegation.pimec.gov.pk</a></b>.
                        Your Activation Code is given
                        below:- </p>
                    <div class="container-mine">
                        <div style="font-weight:bolder; padding-left:8rem;"><br />Activation Code
                            <br /><br /><b>{{$delegation->delegationCode}}</b>
                        </div>
                        <div style="padding-right:8rem"><img src="{{$message->embed(public_path('images/primary_QR.png'))}}" width="100px"
                                height="100px" /></div>
                    </div>
                    <p style="text-align:center; font-size:12px;">(In case of login/ signup issue please contact on <a
                            href="mailto:support@badarexpo.com">support@badarexpo.com</a> or Whatsapp <b><a
                                href="tel:+923000204623">+92-300-0204623</a></b>)</p>
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
                    <p style="line-height: 14px; margin-bottom:0px;">Regards<br />Team PIMEC</p>
                    <!-- <p></p> -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <br />
                <div style="display: flex; justify-content:space-evenly;">
                    <div>
                        <ol>
                            <li class="list-group-item" style="text-decoration:underline; font-weight:900;">
                                Contact Information:
                            </li>
                            <li class="list-group-item">
                                PIMEC Secretariat Islamabad
                            </li>
                            <li class="list-group-item">
                                Address : Sector E-9, Naval Headquarters, Islamabad - Pakistan
                                <br />
                                Phone : +92 51-20065120
                                <br />
                                Email: <a href="mailto:pimec@paknavy.gov.pk">pimec@paknavy.gov.pk</a>
                                <br />
                                URL: <a href="www.paknavy.gov.pk" target="_blank">www.paknavy.gov.pk</a>
                            </li>
                        </ol>
                    </div>
                    <div>
                        <ol>
                            <li class="list-group-item" style="text-decoration:underline; font-weight:900;">
                                Contact Information:
                            </li>
                            <li class="list-group-item">
                                Joint PIMEC Cell
                            </li>
                            <li class="list-group-item">
                                Address : 9 Liaquat barracks HQs, COMKAR
                                <br />
                                Phone : +92 21-48502801-2
                                <br />
                                Cell : +92 326-8050300
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <img src="{{ $message->embed(public_path('assets/images/logos/pimec-2025-logostrip.png')) }}" style="width:80%; height:40%;" alt="Partners LOGO" />
        </div>
        <br />
    </div>
</body>

</html>
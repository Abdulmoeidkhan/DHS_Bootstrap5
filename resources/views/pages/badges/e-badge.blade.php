<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/styles.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/e-badge.css')}}" />
    <title>E-Badge</title>
    <style>
        .special-row {
            border: 1px solid black;
            border-radius: 25px;
        }

        .special-row-2 {
            border-radius: 25px;
            background-color: #c8c8c8;
            padding: 10px;
        }

        .special-col,
        .barcode-class {
            margin: 10px auto;
            padding: 10px;
        }

        .special-col {
            background-color: #c8c8c8;
            padding: 20px;
        }
        @media screen {
            .container-fluid{
                padding:50px 500px;
            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <img src="{{asset('images/icons/ideas_logo_2024.png')}}" width="180px" />
            </div>
            <div class="col-6">
                <h3>12th Internation Defence Exhibition and Seminar (IDEAS)</h3>
                <p>19-22 November, 2024 at Karachi Expo Centre - Pakistan</p>
            </div>
            <div class="col">
                <h3>e-Badge Paper</h3>
                <p>Delegation ID : {{$delegations[0]->delegationCode}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <ul>
                    <li>You will need to provide this confirmation e-Badge Print Paper and passport at your arrival in Karachi Airport to update your arrival status and receive your official exhibition access pass.</li>
                    <li>This e-Badge is strictly non-transferable and only valid for the person whose name is printed on it</li>
                </ul>
            </div>
        </div>
        <div class="row special-row text-center">
            <div class="col">
                <div class="special-col">
                    e-Badge Digital Barcode Scan
                </div>
            </div>
            <div class="col barcode-class">
                <div id="barCode" class="mx-auto" custom-id="{{$delegations[0]->delegationCode}}"></div>
            </div>
            <div class="col">
                <div class="special-col">
                    Invitation Number
                </div>
            </div>
        </div>
        <div class="row">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Delegate Information</th>
                        <th scope="col">Officers Information</th>
                        <th scope="col">Accomodation Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <ul>
                                <li>
                                    @foreach(\App\Models\Rank::where('ranks_uid',$delegates[0]->rank)->get() as $renderRank)
                                    {{$renderRank->ranks_name}}
                                    @endforeach
                                    @foreach($delegates as $key=>$delegate)
                                    {{$delegate->first_Name}}
                                    &nbsp;
                                    {{$delegate->last_Name}}
                                    &nbsp;
                                    (
                                    {{$delegate->self===1 ?'Self':'Rep'}}
                                    )
                                    @endforeach
                                </li>
                                <li>
                                    @foreach($delegates as $key=>$delegate)
                                    {{$delegate->self===1 &&$delegate->delegation_type==="Member" ?'Member':'Head'}}
                                    @endforeach
                                    /
                                    @foreach($delegations as $key=>$delegation)
                                    {{$delegation->country}}
                                    @endforeach
                                    /
                                    @foreach($invitedBys as $key=>$invitedBy)
                                    Invited By : {{$invitedBy->vips_designation}}
                                    @endforeach
                                </li>
                            </ul>
                        </td>
                        <td>
                            <ul>
                                @foreach($officers as $key=>$officer)
                                <li class="text-capitalize">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-shield" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h2" />
                                        <path d="M22 16c0 4 -2.5 6 -3.5 6s-3.5 -2 -3.5 -6c1 0 2.5 -.5 3.5 -1.5c1 1 2.5 1.5 3.5 1.5z" />
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    </svg>
                                    @foreach(\App\Models\Rank::where('ranks_uid',$officer->officer_designation)->get() as $officerKey=> $renderRank)
                                    {{$renderRank->ranks_name}}
                                    @endforeach
                                    {{$officer->officer_first_name}}
                                    &nbsp;
                                    {{$officer->officer_last_name}}
                                    &nbsp;
                                    (
                                    {{$officer->officer_type}}
                                    Officer
                                    )
                                </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <ul>
                                @if($hotelNames)
                                @foreach($hotelNames as $key=>$hotelName)
                                <li class="text-capitalize">
                                    {{$hotelName->hotel_names}}
                                </li>
                                @endforeach
                                @endif
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row special-row-2">
            <div class="col">
                Delegation Details
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Passport</th>
                        <th scope="col">Arrival Flight</th>
                        <th scope="col">Arrival Date</th>
                        <th scope="col">Arrival Time</th>
                        <th scope="col">Departure Flight</th>
                        <th scope="col">Departure Date</th>
                        <th scope="col">Departure Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($flightDetails as $key=>$flightDetail)
                    <tr>
                        <td>{{$flightDetail->passport}}</td>
                        <td>{{$flightDetail->arrival_flight}}</td>
                        <td>{{$flightDetail->arrival_date}}</td>
                        <td>{{$flightDetail->arrival_time}}</td>
                        <td>{{$flightDetail->departure_flight}}</td>
                        <td>{{$flightDetail->departure_date}}</td>
                        <td>{{$flightDetail->departure_time}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row special-row-2 text-center">
            <p>
                <b>YOU MUST PRINT</b> this confirmation e-Badge with embedded barcode and MUST be clear and legible on the printed page.
            </p>
            <br />
            <p>
                <b>Please print and bring this e-Badge with you on your arrival</b>
            </p>
        </div>
        <div class="row">
            <img src="{{asset('images/icons/Partners.png')}}" style="width:100%;" alt="Partners LOGO" />
        </div>
    </div>
    <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/jquery/jquery-barcode.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/app.min.js')}}"></script>
    <script src="{{asset('assets/js/ebadge.js')}}"></script>
</body>

</html>
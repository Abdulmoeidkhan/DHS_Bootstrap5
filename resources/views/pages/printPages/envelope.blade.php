<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Badge Printing</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="shortcut icon" type="image/png" href="{{asset('images/icons/Badar-icon-128x128.png')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/styles.min.css')}}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,700&amp;family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&amp;display=swap">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/badge.css') }}">
</head>

<body class="antialiased">
    <div class="container">
        <br />
        <div class="row">
            <div class="btn-parent d-flex justify-content-center">
                <button class="btn btn-outline-primary" onclick="window.print()">Print this Envelope</button>
            </div>
        </div>
        <br />
        <br />
        <div class="row">
            <div class="col">
            </div>
            <div class="col">
            </div>
            <div class="col">
                <div class="d-flex justify-content-end align-items-center">
                    <p class="text-right">{{$delegate->invitation_number}} / {{$delegation->delegationCode}}</p>
                </div>
            </div>
            <div class="col">
            </div>
        </div>
        <div class="row">
            <div class="d-flex justify-content-evenly align-items-center">
                <div>
                    <h5 style="text-transform:capitalize; font-weight:700;">{{$delegate->rank->ranks_name}}</h5>
                    <h5 style="text-transform:capitalize; font-weight:700;">
                        {{$delegate->first_Name}} {{$delegate->last_Name}}
                    </h5>
                    <h6 class="text-left" style="text-transform:uppercase;">
                        {{$delegate->designation}}
                    </h6>
                    <h6 class="text-left" style="text-transform:uppercase;">
                        {{$delegation->country}}
                    </h6>
                </div>
            </div>
        </div>
        <!-- <div class="container ">
        <div class="row float-left container-first-child">
            <div class="col-md-12 parent-print-program text-center d-print-inline badge-box-2">
                <div>
                    <div class="card-border ">
                        <p class="text-right">{{$delegate->invitation_number}} / {{$delegation->delegationCode}}</p>
                        <div class="logo-child">
                            <div>
                                <h5 class="text-left">{{$delegate->rank->ranks_name}}</h5>
                                <h5 class="text-left">
                                    {{$delegate->first_Name}} {{$delegate->last_Name}}
                                </h5>
                            </div>
                        </div>
                        <p class="text-left" style="text-transform:uppercase;">
                            {{$delegate->designation}}
                        </p>
                        <p class="text-left" style="text-transform:uppercase;">
                            {{$delegation->country}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="{{ asset('assets/js/badge.js') }}"></script>
</body>

</html>
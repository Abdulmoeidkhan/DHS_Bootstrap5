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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,700&amp;family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&amp;display=swap">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/badge.css') }}">
</head>

<body class="antialiased">
    <div class="container-fluid">
        <br />
        <div class="row">
            <div class="btn-parent d-flex justify-content-center">
                <button class="btn btn-outline-primary" onclick="window.print()">Print this E-badge</button>
            </div>
        </div>
        <br />
        <br />
        <div class="row my-5">
            <div class="d-flex align-items-center my-3">
                <div class="card-border">
                    <div class="logo-child">
                        <div>
                            <h4 class="text-left mx-3">
                                {{$printDoc->first}} {{$printDoc->second}}
                                </br>
                                {{$printDoc->third}}
                            </h4>
                        </div>
                    </div>
                    <div class="d-flex my-1">
                        <div id="barCode" custom-id="{{$printDoc->sixth}}"></div>
                    </div>
                    <h6 style="text-transform: uppercase;" class="text-center mx-3">
                        {{$printDoc->forth}}/{{$printDoc->fifth}}/{{$printDoc->sixth}}
                    </h6>
                </div>
                <div class="card-border mx-4">
                    <div class="logo-child mx-5">
                        @if($printDoc->image)
                        <img src="{{$printDoc->image->img_blob}}" style="height: 120px; width: 100px;"
                            class="img-fluid" alt="" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" type="text/javascript">
    </script>
    <script type="text/javascript" src="{{ asset('assets/jquery/jquery-barcode.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/badge.js') }}"></script>
</body>

</html>
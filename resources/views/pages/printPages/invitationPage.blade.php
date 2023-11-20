<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invitation Print</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,700&amp;family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&amp;display=swap">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/badge.css') }}">
</head>

<body class="antialiased">
    <div class="btn-parent">
        <button class="btn btn-outline-primary" onclick="window.print()">Print this E-badge</button>
        <button class="btn btn-outline-secondary" onclick="downloadBadge()">Download this E-badge</button>
    </div>
    <div class="container">
        <div class="row container-first-child">
            <div class="col-md-12 parent-print-program d-print-inline">
                <div>
                    <h1>Dear PrintName - Country </h1>

                    <p class="blockquote">
                        <?php echo config('localvariables.eventName'); ?>
                    </p>
                    <p>
                        Location : <?php echo config('localvariables.eventLocation'); ?>
                    </p>
                    <p>
                        Date : <?php echo config('localvariables.eventDate'); ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div>
                    <h2>Registration</h2>
                    <br />

                    <p class="blockquote">
                        <?php echo config('localvariables.eventName'); ?>
                    </p>
                    <p>
                        Location : <?php echo config('localvariables.eventLocation'); ?>
                    </p>
                    <p>
                        Date : <?php echo config('localvariables.eventDate'); ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="row container-first-child">
            <div class="col-md-8 parent-print-program">
                <div>
                    <!-- <img src="{{asset('images/Pimec.png')}}" class="logo-img" alt="Pimec" />
                    <br /> -->

                    <p class="blockquote">
                        Your E-Badge Information
                    </p>
                    <p>
                        Registration Date : <?php echo substr_replace($personals->created_at, "", 10); ?>
                    </p>
                    <p>
                        Registration Type : Trade Vistor
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla repellat eos nobis doloribus unde doloremque vel laborum id, distinctio mollitia dicta molestias consequuntur debitis vero obcaecati veniam omnis placeat laboriosam!
                    </p>
                </div>
            </div>
            <div class="col-md-4 parent-print-program text-center">
                <div class="card-border">
                    <!-- <h1>
                        <mark>E-Badge</mark>
                    </h1> -->
                    <div class="logo-child">
                        <img src="{{asset('images/Pimec.png')}}" class="logo-img" alt="Pimec" />
                        <img src="{{asset('images/Bxss.png')}}" class="logo-img" alt="Pimec" />
                    </div>
                    <h4 style="text-transform:uppercase;">
                        <?php echo $personals->Fname . " " . $personals->Lname; ?>
                        <br />
                        <?php echo $personals->Designation; ?>
                        <br />
                        <?php echo $organisations->Companyname; ?>
                    </h4>
                    <!-- Bar Code Tag -->
                    <div id="barCode" custom-id="<?php echo $personals->Badge; ?>"></div>
                    <code>
                        <?php echo $personals->Badge; ?>
                    </code>
                    <h2>
                        Trade Visitor
                    </h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h2>Terms & conditions</h2>
                    <br />
                    <p class="blockquote">
                    <ol>
                        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa animi, sunt nostrum omnis voluptatum, quidem tempore laborum saepe fugit aliquid ullam expedita molestias quis distinctio eligendi tenetur, qui sequi officiis!</li>
                        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa animi, sunt nostrum omnis voluptatum, quidem tempore laborum saepe fugit aliquid ullam expedita molestias quis distinctio eligendi tenetur, qui sequi officiis!</li>
                        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa animi, sunt nostrum omnis voluptatum, quidem tempore laborum saepe fugit aliquid ullam expedita molestias quis distinctio eligendi tenetur, qui sequi officiis!</li>
                        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa animi, sunt nostrum omnis voluptatum, quidem tempore laborum saepe fugit aliquid ullam expedita molestias quis distinctio eligendi tenetur, qui sequi officiis!</li>
                        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa animi, sunt nostrum omnis voluptatum, quidem tempore laborum saepe fugit aliquid ullam expedita molestias quis distinctio eligendi tenetur, qui sequi officiis!</li>
                        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa animi, sunt nostrum omnis voluptatum, quidem tempore laborum saepe fugit aliquid ullam expedita molestias quis distinctio eligendi tenetur, qui sequi officiis!</li>
                    </ol>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('js/badge.js') }}"></script>
</body>

</html>
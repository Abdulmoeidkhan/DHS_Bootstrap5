<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/styles.min.css')}}" />
    <title>E-Badge</title>
    <style>
        .special-row {
            border: 1px solid black;
            border-radius: 25px;
        }

        .special-col {
            background-color: #c8c8c8;
            margin:10px auto;
            padding: 20px;
        }
    </style>
</head>

<body>
    <br />
    <div class="container">
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
                <p>Delegation ID : DL91441833</p>
            </div>
        </div>
        <br />
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
            <div class="col">b</div>
            <div class="col">
                <div class="special-col">
                    Invitation Number
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/sidebarmenu.js')}}"></script>
    <script src="{{asset('assets/js/app.min.js')}}"></script>
</body>

</html>
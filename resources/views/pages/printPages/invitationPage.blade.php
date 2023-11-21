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
            <button class="btn btn-outline-primary" onclick="window.print()">Print this E-badge</button>
        </div>
        <br />
        <br />
    </div>
    <div class="row container-first-child">
        <div class="col-md-12 parent-print-program d-print-inline">
            <div>
                <h3 class="text-capitalize">Dear {{$delegate->first_Name}}&nbsp;{{$delegate->last_Name}} - {{$delegate->country}}</h3>
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
        <div class="col-md-12 ">
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
        <div class="col-md-12 parent-print-program">
            <div>
                <!-- <img src="{{asset('images/Pimec.png')}}" class="logo-img" alt="Pimec" />
                    <br /> -->

                <p class="blockquote">
                    Your E-Badge Information
                </p>
                <p>
                </p>
                <p>
                    Registration Type : Trade Vistor
                </p>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla repellat eos nobis doloribus unde doloremque vel laborum id, distinctio mollitia dicta molestias consequuntur debitis vero obcaecati veniam omnis placeat laboriosam!
                </p>
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
                    <li class="list-group-item">Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa animi, sunt nostrum omnis voluptatum, quidem tempore laborum saepe fugit aliquid ullam expedita molestias quis distinctio eligendi tenetur, qui sequi officiis!</li>
                    <li class="list-group-item">Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa animi, sunt nostrum omnis voluptatum, quidem tempore laborum saepe fugit aliquid ullam expedita molestias quis distinctio eligendi tenetur, qui sequi officiis!</li>
                    <li class="list-group-item">Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa animi, sunt nostrum omnis voluptatum, quidem tempore laborum saepe fugit aliquid ullam expedita molestias quis distinctio eligendi tenetur, qui sequi officiis!</li>
                    <li class="list-group-item">Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa animi, sunt nostrum omnis voluptatum, quidem tempore laborum saepe fugit aliquid ullam expedita molestias quis distinctio eligendi tenetur, qui sequi officiis!</li>
                    <li class="list-group-item">Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa animi, sunt nostrum omnis voluptatum, quidem tempore laborum saepe fugit aliquid ullam expedita molestias quis distinctio eligendi tenetur, qui sequi officiis!</li>
                    <li class="list-group-item">Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa animi, sunt nostrum omnis voluptatum, quidem tempore laborum saepe fugit aliquid ullam expedita molestias quis distinctio eligendi tenetur, qui sequi officiis!</li>
                </ol>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
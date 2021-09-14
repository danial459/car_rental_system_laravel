@extends('layouts.app')


@section('content')

<div class="container mw-100" style="margin-bottom: 100px;">
    <div class="shadow p-4 rounded bg-white js-active mt-5" >
    <div class="table-responsive" >
        <h3 class="title text-center multisteps-form__title">All available cars</h3>
        <table class="table table-sm table-bordered mt-3" >
            <thead>
                <tr >

                    <th class="th-lg">Plate no.</th>
                    <th class="th-lg">Image</th>
                    <th class="th-lg">Car model</th>
                    <th class="th-lg">Rate(RM)</th>

                </tr>
            </thead>
            <tbody>
              @foreach ( $cars as $car )
                <tr>
                    <td>{{$car->no_plate}}</td>
                    <td><img src='{{asset($car->link)}}' class="img-fluid img-thumbnail" style="max-height:200px; max-width:300px; overflow: hidden" alt="car"></td>
                    <td>{{$car->car_name}}</td>
                    <td>{{$car->rate}}</td>
                </tr>

              @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>

@endsection

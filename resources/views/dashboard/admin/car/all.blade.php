@extends('layouts.app')

@section('content')

<div class="mx-3 shadow rounded bg-white p-2">
    <a href="{{route('admin.car.add')}}" ><button type="button" class="btn btn-success mx-2 btn-sm">Add new car</button></a>
</div>

<link href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css" rel="stylesheet">

<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>

<div class="container mw-100" style="margin-bottom: 100px;">
    <div class="shadow p-4 rounded bg-white js-active mt-3" >
    <div class="table-responsive" >
        <h3 class="title text-center multisteps-form__title">Cars</h3>


<table
  data-toggle="table"
  data-search="true"
  data-pagination="true"
  data-show-columns="true">
  <thead>

    <tr class="tr-class-1">
      <th data-field="no_plate" data-valign="middle">Plate no.</th>
      <th data-field="car_name" data-valign="middle">Model</th>
      <th data-field="rate" data-valign="middle">Rate(RM)/hour</th>
      <th data-field="under_service" data-valign="middle">Under service</th>
    </tr>
  </thead>
  <tbody>

@foreach($cars as $car)
    <tr id="tr-id-1" class="tr-class-1" data-title="bootstrap table" data-object='{"key": "value"}'>
      <td><a href="{{route('admin.car.plateNo.show',['no_plate' => $car->no_plate])}}" target="_blank">{{ $car->no_plate }}</a></td>
      <td>{{$car->car_name}}</td>
      <td>{{$car->rate}}</td>
      <td>
        @if ($car->under_service == false)
        <span class="badge badge-success">No</span>
        @else
        <span class="badge badge-danger">Yes</span>
        @endif
      </td>
    </tr>
@endforeach


  </tbody>
</table>

    </div>
    </div>
</div>



@endsection

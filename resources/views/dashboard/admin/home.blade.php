@extends('layouts.app')

@section('content')

<link href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css" rel="stylesheet">

<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>

<div class="container mw-100" style="margin-bottom: 100px;">
    <div class="shadow p-4 rounded bg-white js-active mt-5" >
    <div class="table-responsive" >
        <h3 class="title text-center multisteps-form__title">Customer books</h3>


<table
  data-toggle="table"
  data-search="true"
  data-pagination="true"
  data-show-columns="true">
  <thead>

    <tr class="tr-class-1">
      <th data-field="id" data-valign="middle">Id</th>
      <th data-field="name" data-valign="middle">Name</th>
      <th data-field="no_plate" data-valign="middle">Plate No.</th>
      <th data-field="car" data-valign="middle">Car</th>
      <th data-field="start_time" data-valign="middle">Start time</th>
      <th data-field="end_time" data-valign="middle">End time</th>
      <th data-field="pick_up" data-valign="middle">Pick up</th>
      <th data-field="note" data-valign="middle">Note</th>
      <th data-field="price" data-valign="middle">Price(RM)</th>
    </tr>
  </thead>
  <tbody>

@foreach($books as $book)
  @foreach($book->cars as $car)
    <tr id="tr-id-1" class="tr-class-1" data-title="bootstrap table" data-object='{"key": "value"}'>
      <td>
        <a href="{{route('admin.book.show',$car->pivot->id)}}" target="_blank">{{ $car->pivot->id }}</a>
      </td>
      <td><a href="{{route('admin.customer.show',['custName' => $car->pivot->name])}}" target="_blank">{{$car->pivot->name}}</a></td>
      <td><a href="{{route('admin.car.plateNo.show',['no_plate' => $car->pivot->no_plate])}}" target="_blank">{{$car->pivot->no_plate}}</a></td>
      <td>{{$car->car_name}}</td>
      <td>{{$car->pivot->start_date}} at {{ $car->pivot->start_time }}</td>
      <td>{{$car->pivot->end_date}} at {{ $car->pivot->end_time }}</td>
      <td>{{ $car->pivot->pick_up }}</td>
      <td>{{$car->pivot->note}}</td>
      <td>{{$car->pivot->price}}</td>
    </tr>
  @endforeach
@endforeach


  </tbody>
</table>

    </div>
    </div>
</div>









@endsection

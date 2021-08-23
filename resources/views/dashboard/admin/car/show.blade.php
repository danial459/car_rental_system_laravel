@extends('layouts.app')

@section('content')



<div class="d-flex flex-column">
    <div class="text-left d-sm-flex d-md-flex d-lg-flex d-xl-flex justify-content-sm-center justify-content-md-center justify-content-lg-center justify-content-xl-center">

    <div class="col-sm-12 col-md-8 col-lg-8 col-xl-4 shadow p-4 rounded bg-white js-active mt-5 ">

        <h3 class="title text-center">Car details</h3>

        <div class="form-row mt-4 ">
            <div class="form-group col-12 col-sm-6 border rounded">
                <label class="label-control">Plate No.</label>
               <div>{{$car->no_plate}}</div>
            </div>
            <div class="form-group col-12 col-sm-6 border rounded">
                <label class="label-control">Model</label>
               <div>{{$car->car_name}}</div>
            </div>

        </div>
        <div class="form-row mt-4 ">
            <div class="form-group col-12 col-sm-6 border rounded">
                <label class="label-control">Rate(RM)</label>
               <div>{{$car->rate}}</div>
            </div>
            <div class="form-group col-12 col-sm-6 border rounded">
                <label class="label-control">Under service</label>
               <div class="d-flex">
               <div>
                  @if ($car->under_service == false)
                      <span class="badge badge-success">No</span>
                  @else
                      <span class="badge badge-danger">Yes</span>
                  @endif
               </div>
               <div class="ml-auto">
                  <a href="{{route('admin.car.underService' , ['no_plate' => $car->no_plate])}}" ><i class="material-icons mb-2">autorenew</i></a>
               </div>

               </div>
            </div>

        </div>
        <div class="form-row mt-4 ">
            <div class="form-group col-12 col-sm-6 border rounded">
                <label class="label-control">Car picture</label>
                <div><img src="{{ asset($car->link)}}" class="img-fluid img-thumbnail" style="max-height:200px; max-width:300px; overflow: hidden" alt="car"></div>
            </div>


        </div>


    </div>
    </div>

<div class="container mw-100" style="margin-bottom: 100px;">
<div class="shadow p-4 rounded bg-white js-active mt-5" >
<div class="table-responsive" >

<div class="text-center">
      <h3 class="title">Books</h3>
      <small class="text-muted">This car booked by these customers.</small>
</div>

<table
  data-toggle="table"
  data-search="true"
  data-pagination="true"
  data-show-columns="true">
  <thead>
    <tr class="tr-class-1">
        <th data-field="id" data-valign="middle">Id</th>
        <th data-field="no_plate" data-valign="middle">Customer name</th>
        <th data-field="start_time" data-valign="middle">Start time</th>
        <th data-field="end_time" data-valign="middle">End time</th>
        <th data-field="pick_up" data-valign="middle">Pick up</th>
        <th data-field="note" data-valign="middle">Note</th>
        <th data-field="price" data-valign="middle">Price</th>
      </tr>
  </thead>
  <tbody>
    @forelse($books as $book)

      <tr id="tr-id-1" class="tr-class-1" data-title="bootstrap table" data-object='{"key": "value"}'>
        <td><a href="{{route('admin.book.show',$book->id)}}" target="_blank">{{$book->id}}</a></td>
        <td><a href="{{route('admin.customer.show',['custName' => $book->name])}}" target="_blank">{{$book->name}}</a></td>
        <td>{{$book->start_date}} at {{ $book->start_time }}</td>
        <td>{{$book->end_date}} at {{ $book->end_time }}</td>
        <td>{{ $book->pick_up }}</td>
        <td>{{$book->note}}</td>
        <td>{{$book->price}}</td>
      </tr>

    @empty

    <tr id="tr-id-1" class="tr-class-1" data-title="bootstrap table" data-object='{"key": "value"}'>
        <td class="text-center" colspan="7">No book yet.</td>
    </tr>

    @endforelse
  </tbody>
</table>

</div>
</div>
</div>




</div>



<link href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css" rel="stylesheet">
<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>



@endsection

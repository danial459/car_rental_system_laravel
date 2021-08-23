@extends('layouts.app')

@section('content')

<link href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css" rel="stylesheet">

<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>


<div class="container mw-100" style="margin-bottom: 100px;">
    <div class="shadow p-4 rounded bg-white js-active mt-5" >
    <div class="table-responsive" >
        <h3 class="title text-center multisteps-form__title">Customers</h3>

<table
  data-toggle="table"
  data-search="true"
  data-show-columns="true">
  <thead>

    <tr class="tr-class-1">
      <th data-field="name">Name</th>
      <th data-field="email">Email</th>
      <th data-field="address">Address</th>
      <th data-field="ic_number">IC number</th>
      <th data-field="phone_no">Phone no.</th>
    </tr>
  </thead>
  <tbody>

@foreach ( $customers as $customer )
    <tr id="tr-id-1" class="tr-class-1" data-title="bootstrap table" data-object='{"key": "value"}'>
      <td id="td-id-1" class="td-class-1" data-title="bootstrap table">
        <a href="{{route('admin.customer.show',['custName' => $customer->name])}}" target="_blank">{{$customer->name}}</a>
      </td>
      <td>{{$customer->email}}</td>
      <td>{{$customer->address}}</td>
      <td>{{$customer->ic_number}}</td>
      <td>{{$customer->phone_no}}</td>
    </tr>
@endforeach

  </tbody>
</table>


</div>
</div>
</div>





@endsection

@extends('layouts.app')

@section('content')

<form action="{{route('user.booking.create.store')}}" method="POST">
    @csrf
<div class="row text-left d-lg-flex d-xl-flex justify-content-lg-center justify-content-xl-center">
    <div class="col-lg-7 col-xl-6 offset-xl-0 text-left">
        <div class="card d-lg-flex justify-content-lg-center" style="margin: 0px;margin-top: 41px;margin-bottom: 12px;">
            <div class="card-header-primary card-header">
                <h2 class="title text-center">Booking Confirmation</h2>
            </div>
            <div class="card-body">
                    @csrf
                    <div class="form-group row">
                      <label for="startDate" class="col-sm-2 col-form-label">Start date</label>
                      <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="startDate" name="start_date" value="{{session('start_date')}}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="startTime" class="col-sm-2 col-form-label">Start time</label>
                      <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" id="startTime" name="start_time" value="{{session('start_time')}}">
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="endDate" class="col-sm-2 col-form-label">End date</label>
                        <div class="col-sm-10">
                          <input type="text" readonly class="form-control-plaintext" id="endDate" name="end_date"  value="{{session('end_date')}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="endTime" class="col-sm-2 col-form-label">End time</label>
                        <div class="col-sm-10">
                          <input type="text" readonly class="form-control-plaintext" id="endTime" name="end_time" value="{{session('end_time')}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="pickUp" class="col-sm-2 col-form-label">Pick up place</label>
                        <div class="col-sm-10">
                          <input type="text" readonly class="form-control-plaintext" id="pick_up" name="pick_up" value="{{session('pick_up')}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="plate_no" class="col-sm-2 col-form-label">Plate no</label>
                        <div class="col-sm-10">
                          <input type="text" readonly class="form-control-plaintext" id="no_plate" name="no_plate" value="{{session('no_plate')}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="note" class="col-sm-2 col-form-label">Note</label>
                        <div class="col-sm-10">
                          <input type="text" readonly class="form-control-plaintext" id="note" name="note" value="{{session('note')}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="car" class="col-sm-2 col-form-label">Car model</label>
                        <div class="col-sm-10">
                          <input type="text" readonly class="form-control-plaintext" id="car" name="car" value="{{$car->car_name}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="price" class="col-sm-2 col-form-label">Total price(RM)</label>
                        <div class="col-sm-10">
                          <input type="text" readonly class="form-control-plaintext" id="price" name="price" value="{{session('price')}}">
                        </div>
                      </div>
            </div>
            <input type="hidden" id="action" name="action" value="1">
        </div>
    </div>
</div>
<div class="d-flex justify-content-center"><button id="success" name="button" class="btn btn-primary mt-5" type="submit">Confirm</button></div>
</form>


<script>



</script>
@endsection

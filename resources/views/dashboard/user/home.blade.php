@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 ">
            <div class="card">
                <div class="form-inline card-header card-header-icon card-header-primary" style='cursor: pointer;' onclick="myBooking()">
                  <div class="card-icon">
                  <i class="material-icons">book</i>
                  </div>
                  <div class="ml-2">
                  <h4>My bookings</h4>
                  </div>
                </div>
                <div class="card-body pb-4">
                    @forelse ($books as $book)
                      <h4><b>{{$book->car_name}}</b> on <b>{{$book->pivot->start_date}}</b> at <b>{{$book->pivot->start_time}}</b></h4>
                    @empty
                      <h4><b>You have no booking.</b></h4>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="form-inline card-header card-header-icon card-header-primary">
                  <div class="card-icon">
                    <i class="material-icons">notification_important</i>
                  </div>
                  <div class="ml-2">
                    <h4>Notification</h4>
                    </div>
                </div>
                <div class="card-body pb-4">
                    <h4 class="card-title">No announcement yet.</h4>
                </div>
            </div>
        </div>
    </div>

<form id='myBooking' action="{{route('user.myBooking')}}">
@csrf
</form>


@endsection
<script>


    function myBooking() {
        document.getElementById('myBooking').submit();
    }

    function myNotification() {
        document.getElementById('myNoti').submit();
    }



      </script>

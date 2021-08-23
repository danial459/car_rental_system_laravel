@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 ">
            <div class="card">
                <div class="form-inline card-header card-header-icon card-header-rose" style='cursor: pointer;' onclick="myBooking()">
                  <div class="card-icon">
                  <i class="material-icons">language</i>
                  </div>
                  <div class="ml-2">
                  <h4>Current booking</h4>
                  </div>
                </div>
                <div class="card-body pb-4">
                    <h4 class="card-title">Here is the Icon</h4>
                        The place is close to Barceloneta Beach and bus stop just 2 min by walk and near to "Naviglio" where you can enjoy the main night life in Barcelona...
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="form-inline card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                    <i class="material-icons">language</i>
                  </div>
                  <div class="ml-2">
                    <h4>Here is the Text</h4>
                    </div>
                </div>
                <div class="card-body">
                    <h4 class="card-title">Here is the Icon</h4>
                        The place is close to Barceloneta Beach and bus stop just 2 min by walk and near to "Naviglio" where you can enjoy the main night life in Barcelona...
                </div>
            </div>
        </div>
    </div>
      <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="form-inline card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                    <i class="material-icons">language</i>
                  </div>
                  <div class="ml-2">
                    <h4>Here is the Text</h4>
                    </div>
                </div>
                <div class="card-body">
                    <h4 class="card-title">Here is the Icon</h4>
                        The place is close to Barceloneta Beach and bus stop just 2 min by walk and near to "Naviglio" where you can enjoy the main night life in Barcelona...
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="form-inline card-header card-header-icon card-header-rose">
                  <div class="card-icon">
                    <i class="material-icons">language</i>
                  </div>
                  <div class="ml-2">
                    <h4>Here is the Text</h4>
                    </div>
                </div>
                <div class="card-body">
                    <h4 class="card-title">Here is the Icon</h4>
                        The place is close to Barceloneta Beach and bus stop just 2 min by walk and near to "Naviglio" where you can enjoy the main night life in Barcelona...
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

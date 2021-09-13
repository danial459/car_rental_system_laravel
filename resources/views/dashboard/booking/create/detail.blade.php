@extends('layouts.app')

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <div class="container">
        <div class="alert-icon">
            <i class="material-icons">warning</i>
        </div>
       Warning Alert:
        <div class="mt-3">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
         </div>
    </div>
</div>
@endif

<form action="{{route('user.booking.create.confirmation')}}" method="GET">
    @csrf
        <div id="multple-step-form-n" class="container overflow-hidden" style="margin-top: 0px;margin-bottom: 10px;padding-bottom: 30px;padding-top: 57px;">

            <div id="multistep-start-row" class="row">
                <div id="multistep-start-column" class="col-12 col-lg-8 m-auto">

                        <div id="single-form-next" class="multisteps-form__panel shadow p-4 rounded bg-white js-active pb-5" data-animation="scaleIn">
                            <h3 class="title text-center multisteps-form__title">Fill the details</h3>
                            <div id="form-content" class="multisteps-form__content">
                                <div id="input-grp-double" class="form-row mt-4">
                                    <div class="form-group col-12 col-sm-6">
                                        <label class="label-control">Start date</label>
                                        <input type="date" class="form-control " name="start_date" value="{{old('start_date')}}"/>
                                    </div>
                                    <div class="form-group col-12 col-sm-6 mt-4 mt-sm-0">
                                        <label class="label-control">Start time</label>
                                        <input type="time" class="form-control " name="start_time" value="{{old('start_time')}}"/>
                                    </div>
                                </div>
                                <div id="input-grp-double" class="form-row mt-4">
                                    <div class="form-group col-12 col-sm-6">
                                        <label class="label-control">End date</label>
                                        <input type="date" class="form-control " name="end_date" value="{{old('end_date')}}"/>
                                    </div>
                                    <div class="form-group col-12 col-sm-6 mt-4 mt-sm-0">
                                        <label class="label-control">End time</label>
                                        <input type="time" class="form-control " name="end_time" value="{{old('end_time')}}"/>
                                    </div>
                                </div>
                                <div id="input-grp-double" class="form-row mt-4">
                                    <div class="form-group col-12 col-sm-6">
                                        <label class="label-control">Pick up place</label>
                                    </div>
                                </div>
                                <div id="input-grp-double" class="form-row">
                                    <div class="form-group col-12 col-sm-6 form-check form-check-radio">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="pick_up" id="pickup1" value="center" >
                                            Center
                                            <span class="circle">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-group col-12 col-sm-6 mt-4 mt-sm-0 form-check form-check-radio">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="pick_up" id="pickup2">
                                            Meet up
                                            <span class="circle">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                        <textarea type="text" id="pickupvalue" class="form-control form-control-lg" style=" font-size: 0.875em" onclick="pickup()" > </textarea>
                                    </div>
                                </div>
                                <div id="input-grp-single" class="form-row mt-4">
                                    <div class="col-12"><input class="form-control multisteps-form__input" type="text" name="note" placeholder="Note(Optional)" value="{{old('note')}}"></div>
                                </div>

                            </div>
                        </div>


                </div>
            </div>
        </div>
        <div class="container mw-100" style="margin-bottom: 100px;">
            <div class="shadow p-4 rounded bg-white js-active mt-5" >
            <div class="table-responsive" >
                <h3 class="title text-center multisteps-form__title">Choose the car</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Plate no.</th>
                            <th>Image</th>
                            <th>Car model</th>
                            <th>Rate/hour(RM)</th>
                            <th>Choose</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ( $cars as $car )
                        <tr>
                            <td>{{$car->no_plate}}</td>
                            <td><img src='{{asset($car->link)}}' class="img-fluid img-thumbnail" style="max-height:200px; max-width:300px; overflow: hidden" alt="car"></td>
                            <td>{{$car->car_name}}</td>
                            <td>{{$car->rate}}</td>
                            <td>
                                <div class="form-check form-check-radio">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="no_plate" id="no_plate" value="{{$car->no_plate}}" >
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                           </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
         <input type="hidden" name="action" value="1">
        <div class="d-flex justify-content-center"><button id="button" name="button" class="btn btn-primary mt-5" type="submit">Next</button></div>
        </div>

    </form>


<script>


function pickup(){

document.getElementById('pickup2').checked=true;
}

$("#button").click(function(){
     if(this.click)
     {
         $("#pickup2").val($("#pickupvalue").val());

     }
     else {
         $("#pickup2").val("");

     }
     });

</script>


@endsection

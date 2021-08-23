@extends('layouts.app')

@section('content')


<div class="container mw-100" style="margin-bottom: 100px;">
    <div class="shadow p-4 rounded bg-white js-active mt-5" >
    <div class="table-responsive" >
        <h3 class="title text-center multisteps-form__title">Your booking</h3>
        <table class="table table-sm table-bordered" >
            <thead>
                <tr >
                    <th class="th-lg">id.</th>
                    <th class="th-lg">Plate no.</th>
                    <th class="th-lg">Image</th>
                    <th class="th-lg">Car model</th>
                    <th class="th-lg">Total(RM)</th>
                    <th class="th-lg">Start time</th>
                    <th class="th-lg">End time</th>
                    <th class="th-lg">Pick up place</th>
                    <th class="th-lg">Note</th>
                    <th class="th-lg">Action</th>
                </tr>
            </thead>
            <tbody>
              @forelse ( $myBooks as $myBook )
                <tr>
                    <td>{{$myBook->pivot->id}}</td>
                    <td>{{$myBook->no_plate}}</td>
                    <td><img src='{{ asset('/images/'.$myBook->link.'.jpg') }}' alt="car"></td>
                    <td>{{$myBook->car_name}}</td>
                    <td>{{$myBook->pivot->price}}</td>
                    <td>{{$myBook->pivot->start_date." at ".$myBook->pivot->start_time}}</td>
                    <td>{{$myBook->pivot->end_date." at ".$myBook->pivot->end_time}}</td>
                    <td>{{$myBook->pivot->pick_up}}</td>
                    <td>{{$myBook->pivot->note}}</td>
                    <td>
                        <div class="form-inline">
                            <a href="{{route('user.booking.edit.detail', $myBook->pivot->id)}}">
                            <button data-toggle="tooltip" data-placement="left" data-original-title="Edit" class="btn btn-success btn-fab btn-fab-mini m-1">
                              <i class="material-icons">edit</i>
                            </button>
                            </a>
                            <a href="#deleteModal{{$myBook->pivot->id}}" data-toggle="modal" >
                            <button data-toggle="tooltip" data-placement="left" title="Delete" class="btn btn-danger btn-fab btn-fab-mini m-1">
                              <i class="material-icons">delete</i>
                            </button>
                            <div class="modal fade" id="deleteModal{{$myBook->pivot->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-body">
                                        Are you sure to delete this booking?
                                  </div>
                                  <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                    <button onclick="event.preventDefault();document.getElementById('deleteBooking{{$myBook->pivot->id}}').submit();" type="button" class="btn btn-danger" >
                                      Yes</button>
                                            <form id="deleteBooking{{$myBook->pivot->id}}" action="{{route('user.myBooking.delete')}}" method="POST">
                                                  @csrf
                                                  @method('DELETE')
                                                <input type="hidden" name="book_delete" value="{{$myBook->pivot->id}}">
                                            </form>
                                  </div>
                                </div>
                              </div>
                            </div>


                           </a>

                    </div>


                   </td>

                </tr>

                @empty
                <tr>
                    <td class="text-center" colspan="9">You have no booking.</td>
                </tr>

              @endforelse
            </tbody>
        </table>
    </div>
</div>
</div>


<script>





</script>


@endsection

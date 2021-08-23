@extends('layouts.app')

@section('content')

<div class="d-flex flex-column">
<div class="text-left d-lg-flex d-xl-flex justify-content-lg-center justify-content-xl-center">

<div class="col-lg-4 col-xl-4 shadow p-4 rounded bg-white js-active mt-5 ">

    <h3 class="title text-center">Book details</h3>

    <div class="form-row mt-4 ">
        <div class="form-group col-12 col-sm-4 border rounded">
            <label class="label-control">Book Id</label>
           <div>{{$books->id}}</div>
        </div>
        <div class="form-group col-12 col-sm-4 mt-4 mt-sm-0 border rounded">
            <label class="label-control">Name</label>
            <div><a href="{{route('admin.customer.show',['custName' => $books->name])}}" target="_blank">{{$books->name}}</a></div>
        </div>
        <div class="form-group col-12 col-sm-4 mt-4 mt-sm-0 border rounded">
            <label class="label-control">No plate</label>
            <div><a href="{{route('admin.car.plateNo.show',['no_plate' => $books->no_plate])}}" target="_blank">{{$books->no_plate}}</a></div>
        </div>
    </div>
    <div class="form-row mt-4 ">
        <div class="form-group col-12 col-sm-6 border rounded">
            <label class="label-control">Start date</label>
           <div>{{$books->start_date}}</div>
        </div>
        <div class="form-group col-12 col-sm-6 mt-4 mt-sm-0 border rounded">
            <label class="label-control">Start time</label>
            <div>{{$books->start_time}}</div>
        </div>
    </div>
    <div class="form-row mt-4 ">
        <div class="form-group col-12 col-sm-6 border rounded">
            <label class="label-control">End date</label>
           <div>{{$books->end_date}}</div>
        </div>
        <div class="form-group col-12 col-sm-6 mt-4 mt-sm-0 border rounded">
            <label class="label-control">End time</label>
            <div>{{$books->end_time}}</div>
        </div>
    </div>
    <div class="form-row mt-4">
        <div class="form-group col-12 col-sm-4 border rounded">
            <label class="label-control text-center">Pick up place</label>
           <div>{{$books->pick_up}}</div>
        </div>
        <div class="form-group col-12 col-sm-4 mt-4 mt-sm-0 border rounded">
            <label class="label-control">Note</label>
            <div>{{$books->note}}</div>
        </div>
        <div class="form-group col-12 col-sm-4 mt-4 mt-sm-0 border rounded">
            <label class="label-control">Price</label>
            <div>{{$books->price}}</div>
        </div>
    </div>


</div>



</div>

<div class="d-flex justify-content-center">
<div class="mt-3">
    <a href="{{route('admin.book.edit.detail', ['bookId' => $books->id])}}"><button type="button" class="btn btn-success btn-sm mr-2">Edit</button></a>
    <button type="button" class="btn btn-danger btn-sm ml-3" data-toggle="modal" data-target="#DeleteBookModal" >Delete</button>
    <div class="modal fade" id="DeleteBookModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
              Are you sure to delete this book?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-danger" onclick="event.preventDefault();
              document.getElementById('delete-book-form').submit();">Delete</button>
            </div>
          </div>
        </div>
      </div>
                      <form id="delete-book-form" action="{{ route('admin.book.delete') }}" method="POST" class="d-none">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="admin_delete_book_id" value="{{$books->id}}">
                      </form>

</div>
</div>

</div>


@endsection

@extends('backend.master.masterback')
@section('title')
Category List
@endsection
@push('link')
<link href="{{asset('backend/plugins/file-upload/file-upload-with-preview.min.css')}}" rel="stylesheet"
    type="text/css" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush
@section('content')
<div class="col-md-12 col-lg-12 ">
    <div class="d-flex justify-content-between py-2">
        <h2 class="text-center">ADMINS LIST</h2>
        <a href="" class="btn btn-primary">
            NEW ADMINS</a>
    </div>
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @elseif (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Divison</th>
                <th scope="col">Dristic</th>
                <th scope="col">H.Dristic</th>
                <th scope="col">Address</th>
                <th scope="col">Picture</th>
                <th scope="col">Ordered </th>
                <th scope="col">Membership</th>
                <th scope="col">ACTION</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($clients as $value )
            <tr>
                <td>{{$value->id}}</td>
                <td>{{$value->first_name}}{{$value->last_name}}</td>
                <td>{{$value->division}}</td>
                <td>{{$value->district}}</td>
                <td>{{$value->home_district}}</td>
                <td>{{$value->address}}</td>
                <td><img class="img-fluid" style="width:70px;height:50px"
                        src="{{ asset('images/clients/' . $value->image) }}" /></td>
                <td>00</td>
                <td>Yes</td>
                <td>
                    <a href="{{url('user/update/'.$value->id)}}" class="btn btn-success">Edit</a>
                    <a href="{{url('user/delete/'.$value->id)}}" onclick="return confirm('Are you Sure ?')"
                        class="btn btn-danger">Delete</a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection
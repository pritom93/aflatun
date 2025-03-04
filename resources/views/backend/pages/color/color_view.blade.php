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
        <h2 class="text-center">Color</h2>
        <a href="{{url('admins/color')}}" class="btn btn-primary">
            NEW COLOR</a>
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
                <th scope="col">NAME</th>
                <th scope="col">WONER</th>
                <th scope="col">ACTION</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($colors as $value )
            <tr>
                <td>{{$value->id}}</td>
                <td>{{$value->color_name}}</td>
                <td>{{$value->color_code}}</td>
                <td>
                    <a href="{{url('admins/color/edit/'.$value->id)}}" class="btn btn-success">Edit</a>
                    <a href="{{url('admins/color/delete/'.$value->id)}}" onclick="return confirm('Are you Sure ?')"
                        class="btn btn-danger">Delete</a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection
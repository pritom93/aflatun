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
        <h2 class="text-center">Attribute VALUE LIST</h2>
        <a href="{{url('admins/attr/new_attr_val')}}" class="btn btn-primary">
            New Value Set</a>
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
                <th scope="col">Attribute</th>
                <th scope="col">Value Name</th>
                <th scope="col">Description</th>
                <th scope="col">Count</th>
                <th scope="col">ACTION</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($attrval as $value )
            <tr>
                <td>{{$value->id}}</td>
                <td>{{$value->attrname}}</td>
                <td>{{$value->name}}</td>
                <td>{{$value->description}}</td>
                <td>{{$value->count}}</td>
                <td>
                    <a href="{{url('admins/attr/edit_attr_val/'.$value->id)}}" class="btn btn-success">Edit</a>
                    <a href="{{url('admins/attr/delete_attr_val/'.$value->id)}}"
                        onclick="return confirm('Are you Sure ?')" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection
@extends('backend.master.masterback')
@section('title')
Unit List
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
                <th scope="col">Unit ID</th>
                <th scope="col">Unit Name</th>
                <th scope="col">UnitSlug</th>>
                <th scope="col">Action</th>>
            </tr>
        </thead>

        <tbody>
            @foreach ($units as $unit)
            <tr>
                <td>{{$unit->id}}</td>
                <td>{{$unit->unit_name}}</td>
                <td>{{$unit->slug}}</td>
                <td>
                    <a href="{{url('admins/unit_view/update/'.$unit->id)}}" class="btn btn-success">Edit</a>
                    <a href="{{url('admins/unit_view/delete/'.$unit->id)}}" onclick="return confirm('Are you Sure ?')"
                        class="btn btn-danger">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
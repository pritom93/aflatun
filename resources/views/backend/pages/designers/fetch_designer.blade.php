@extends('backend.master.masterback')
@section('title')
Fashion Designer
@endsection
@push('link')
<link href="{{asset('backend/plugins/file-upload/file-upload-with-preview.min.css')}}" rel="stylesheet"
    type="text/css" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush
@section('content')
<div class="col-md-12 col-lg-12 ">
    <div class="d-flex justify-content-between py-2">
        <h2 class="text-center">FASHION DESIGNER</h2>
        <a href="{{url('admins/new-designer')}}" class="btn btn-primary">
            NEW DESIGNER</a>
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
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Address</th>
                <th scope="col">Image</th>
                <th scope="col">Bio</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($designers as $designer)
            <tr>
                <td>{{ $designer->id }}</td>
                <td>{{ $designer->name }}</td>
                <td>{{ $designer->email }}</td>
                <td>{{ $designer->phone }}</td>
                <td>{{ $designer->address }}</td>
                <td>
                    @if($designer->image)
                    <img src="{{ asset('uploads/designers/' . $designer->image) }}" alt="Image"
                        style="width: 70px; height: 70px; border-radius: 50%;">
                    @else
                    <span>No Image</span>
                    @endif
                </td>
                <td>{{ Str::limit($designer->bio, 50) }}</td>
                <td>{{ ucfirst($designer->status) }}</td>
                <td>
                    <a href="{{ url('admins/designer/edit/'.$designer->id) }}" class="btn btn-success btn-sm">Edit</a>
                    <a href="{{ url('admins/designer/delete/'.$designer->id) }}" onclick="return confirm('Are you sure?')"
                        class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
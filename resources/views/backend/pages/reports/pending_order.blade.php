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
        <h2 class="text-center">Pending List</h2>
        
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
                <th scope="col">user_id</th>
                <th scope="col">payment_method</th>
                <th scope="col">payment_status</th>
                <th scope="col">shipping_charge</th>
                <th scope="col">discount</th>
                <th scope="col">subtotal</th>
                <th scope="col">total</th>
                <th scope="col">delivery_status</th>
                <th scope="col">delivery_date</th>
                <th scope="col">order_status</th>
                <th scope="col">order_status</th>
                <th scope="col">order_date</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($orders as $order )
            <tr>
                
                
            
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <span class="short-desc">
                    </span>
                    <span class="full-desc d-none">
                       
                    </span>
                    <a href="#" class="toggle-desc">See More</a>
                </td>
                <td><img class="img-fluid" style="width:70px;height:50px"
                        src="" /></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a href="" class="btn btn-success">Edit</a>
                    <a href="" onclick="return confirm('Are you Sure ?')"
                        class="btn btn-danger">Delete</a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection
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
                <th scope="col">UNIT</th>
                <th scope="col">CAT</th>
                <th scope="col">NAME</th>
                <th scope="col">PRICE</th>
                <th scope="col">DES</th>
                <th scope="col">IMG</th>
                <th scope="col">QTY</th>
                <th scope="col">PROMOTED</th>
                <th scope="col">VAT</th>
                <th scope="col">ACTION</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($products as $value )
            <tr>
                
                
            
                <td>{{$value->id}}</td>
                <td>{{$value->unit_id}}</td>
                <td>{{$value->category_id}}</td>
                <td>{{$value->name}}</td>
                <td>{{$value->product_price}}</td>
                <td>
                    <span class="short-desc">
                        {{ \Illuminate\Support\Str::limit($value->description, 15, '...') }}
                    </span>
                    <span class="full-desc d-none">
                        {{ $value->description }}
                    </span>
                    <a href="#" class="toggle-desc">See More</a>
                </td>
                <td><img class="img-fluid" style="width:70px;height:50px"
                        src="{{ asset('images/products/' . $value->product_image) }}" /></td>
                <td>{{$value->product_available_quantity}}</td>
                <td>{{$value->promoted_item}}</td>
                <td>{{$value->vat}}</td>
                <td>
                    <a href="{{url('admins/product/update/'.$value->id)}}" class="btn btn-success">Edit</a>
                    <a href="{{url('admins/product/delete/'.$value->id)}}" onclick="return confirm('Are you Sure ?')"
                        class="btn btn-danger">Delete</a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
@endsection
@push('backend_script')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".toggle-desc").forEach(function (element) {
            element.addEventListener("click", function (event) {
                event.preventDefault();
                let parent = this.closest("td");
                let shortDesc = parent.querySelector(".short-desc");
                let fullDesc = parent.querySelector(".full-desc");

                if (fullDesc.classList.contains("d-none")) {
                    shortDesc.classList.add("d-none");
                    fullDesc.classList.remove("d-none");
                    this.textContent = "See Less";
                } else {
                    shortDesc.classList.remove("d-none");
                    fullDesc.classList.add("d-none");
                    this.textContent = "See More";
                }
            });
        });
    });
</script>
@endpush
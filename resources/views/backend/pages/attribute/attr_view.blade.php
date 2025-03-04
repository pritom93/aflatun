@extends('backend.master.masterback')
@section('title')
Admin List
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
                <th scope="col">Native</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($attrs as $value )
            <tr>
                <td>{{$value->name}}</td>
                <td>{{$value->native_name}}</td>
                <td>{{$value->slug}}</td>
                <td>{{$value->description}}</td>
                <td>
                    <a href="{{url('admins/attr/edit/'.$value->id)}}" class="btn btn-success">Edit</a>
                    {{-- <a href="{{url('admins/attr/delete/'.$value->id)}}" onclick="return confirm('Are you Sure ?')"
                        class="btn btn-danger">Delete</a> --}}
                    <button id="AttrDeleteButtonID" data-id="{{$value->id}}" type="button"
                        class="btn btn-danger">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@push('backend_script')
<script>
    $("#AttrDeleteButtonID").on("click",function(){
     const id = $(this).attr('data-id');
let data = {
    id: id
}
console.log(id)
     $.ajax({
        url: "{{url('admins/attr/delete')}}",
        type: 'POST',
        data: data,
        dataType: 'json',
        success: function(response){
            console.log(response)
        }
    });
});
</script>
@endpush
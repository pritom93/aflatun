@extends('backend.master.masterback')

@section('title')
Admin List
@endsection

@push('link')
<link href="{{ asset('backend/plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet" type="text/css" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush

@section('content')
<div class="col-md-12 col-lg-12">
    <div class="d-flex justify-content-between py-2">
        {{-- <h2 class="text-center">Attribute</h2> --}}
        <a href="{{ url('admins/add/attribute') }}" class="btn btn-primary">NEW ATTR</a>
        <a href="{{ url('admins/attr/attr_val') }}" class="btn btn-primary">NEW VALUE</a>
    </div>

    @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
    @elseif (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                {{-- <th>Native</th>
                <th>Slug</th>
                <th>Description</th> --}}
                <th>Value</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($attrs as $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->name }}</td>
                {{-- <td>{{ $value->native_name }}</td>
                <td>{{ $value->slug }}</td>
                <td>{{ $value->description }}</td> --}}
                <td>{{ $value->attrvalue ? join(', ',array_column(json_decode($value->attrvalue),'name')) : '' }}</td>
                <td>
                    <a href="{{ url('admins/attr/edit/'.$value->id) }}" class="btn btn-success">Edit</a>
                    <button class="btn btn-danger deleteAttrBtn" data-id="{{ $value->id }}">Delete</button>
                    <button class="btn btn-primary setValueBtn" data-id="{{ $value->id }}">{{ $value->id }}</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal: Set Attribute Value -->
<div class="modal fade" id="setValueModal" tabindex="-1" aria-labelledby="setValueModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Set Attribute Value</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="attrValueFormID">
            @csrf
            <input type="hidden" id="AttrValNameID" name="attrname">
            {{-- <div class="mb-3">  
                <select class="input--style-5" aria-label="Default select example" id="AttrbuteID">
                    @foreach ($attrs as $value)
                    <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                </select>
            </div>  --}}
            <div class="mb-3">
                <label for="ValmainNameID" class="form-label">Main Name</label>
                <input type="text" class="form-control" id="ValmainNameID" name="ValmainNameID">
            </div>                                                                               
            {{-- <div class="mb-3">
                <label for="AttrValDesID" class="form-label">Description</label>
                <input type="text" class="form-control" id="AttrValDesID" name="AttrValDesID">
            </div> --}}
            {{-- <div class="mb-3">
                <label for="AttrCountID" class="form-label">Count</label>
                <input type="number" class="form-control" id="AttrCountID" name="AttrCountID">
            </div> --}}
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('backend_script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // Open modal and set attribute ID
    $('.setValueBtn').on('click', function () {
        const attrId = $(this).data('id');
        $('#AttrValNameID').val(attrId);
        $('#setValueModal').modal('show');
    });

    // Delete attribute via AJAX
    $('.deleteAttrBtn').on('click', function () {
        if (!confirm('Are you sure?')) return;
        const attrId = $(this).data('id');

        $.ajax({
            url: "{{ url('admins/attr/delete') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: attrId
            },
            success: function (response) {
                location.reload(); // Refresh the page or use JS to remove the row
            },
            error: function (xhr) {
                alert('Delete failed');
                console.error(xhr.responseText);
            }
        });
    });


        $('#attrValueFormID').submit(function (event) {
        event.preventDefault();
       
        const attrData = {
            _token: '{{ csrf_token() }}',
            attrname: $('#AttrValNameID').val(),
            name: $('#ValmainNameID').val(),
            // des: $('#AttrValDesID').val(),
            // count: $('#AttrCountID').val(),
        };

        $.ajax({
            url: "{{ url('admins/attr/new_attr_val') }}",
            type: 'POST',
            data: attrData,
            success: function (response) {
                $('#setValueModal').modal('hide');
                alert('Attribute value saved successfully!');
                $('#attrValueFormID')[0].reset(); // Clear form
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert('Validation or server error occurred');
            }
        });
    });

});
</script>
@endpush
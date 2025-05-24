@extends('backend.master.masterback')

@section('title')
Fashion Designer
@endsection

@push('link')
<link href="{{ asset('backend/plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet" />
<link href="{{ asset('form/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('form/vendor/datepicker/daterangepicker.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('form/css/main.css') }}" rel="stylesheet" media="all">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<style>
    .card-5 {
        background-color: rgba(20, 23, 24, 0.4);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        padding: 20px;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
    }
    .image-preview-container {
        margin-top: 10px;
        text-align: center;
    }
    .image-preview {
        width: 160px;
        height: 140px;
        border-radius: 50%;
        border: 2px solid #ccc;
    }
    .modal-dialog-slide {
        transform: translateY(-100px);
        transition: transform 0.4s ease-out;
    }
    .modal.fade.show .modal-dialog-slide {
        transform: translateY(0);
    }
</style>
@endpush

@section('content')
<div class="col-md-12 col-lg-12">
    <div class="d-flex justify-content-between py-2">
        <h2 class="text-center">FASHION DESIGNER</h2>
        <a href="{{ url('admins/new-designer') }}" class="btn btn-primary">NEW DESIGNER</a>
    </div>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @elseif (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Phone</th>
                <th>Address</th><th>Image</th><th>Bio</th><th>Status</th><th>Action</th>
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
                        <img src="{{ asset('images/designers/' . $designer->image) }}" style="width: 70px; height: 70px; border-radius: 50%;">
                    @else
                        No Image
                    @endif
                </td>
                <td>{{ Str::limit($designer->bio, 50) }}</td>
                <td>{{ $designer->status == 1 ? 'Active' : 'Inactive' }}</td>
                <td>
                    <a href="#" class="btn btn-success btn-sm editbutton" data-id="{{ $designer->id }}">Edit</a>
                    <a href="{{ route('designers.delete', $designer->id) }}" 
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Are you sure you want to delete this designer?')">
                        Delete
                     </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="designerModal" tabindex="-1" aria-labelledby="designerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-slide">
        <div class="modal-content card-5">
            <div class="modal-header">
                <h5 class="modal-title">Update Fashion Designer</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="designerForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="designer_id">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" id="adminname">
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" id="adminemail">
                    </div>
                    <div class="mb-3">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" id="phone">
                    </div>
                    <div class="mb-3">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" id="address">
                    </div>
                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image" id="image" accept="image/*" onchange="previewImage(event)">
                        <div class="image-preview-container">
                            <img id="imagePreview" src="" class="image-preview" alt="Image Preview">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Bio</label>
                        <textarea class="form-control" name="bio" id="bio" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="">Select Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">SUBMIT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('backend_script')
<script>
    const imageBasePath = "{{ asset('images/designers') }}/";

    $(document).ready(function () {
        $('.editbutton').on('click', function () {
            let row = $(this).closest('tr');
            $('#designer_id').val(row.find('td:eq(0)').text().trim());
            $('#adminname').val(row.find('td:eq(1)').text().trim());
            $('#adminemail').val(row.find('td:eq(2)').text().trim());
            $('#phone').val(row.find('td:eq(3)').text().trim());
            $('#address').val(row.find('td:eq(4)').text().trim());
            $('#bio').val(row.find('td:eq(6)').text().trim());
            $('#status').val(row.find('td:eq(7)').text().trim().toLowerCase());
            $('#imagePreview').attr('src', row.find('td:eq(5) img').attr('src') || '');

            new bootstrap.Modal(document.getElementById('designerModal')).show();
        });

        $('#designerForm').on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('designer.update') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (res) {
                    if (res.status === 'success') {
                        location.reload(); // Reload table to reflect changes
                    } else {
                        alert(res.message);
                    }
                },
                error: function (err) {
                    if (err.status === 422) {
                        let msg = '';
                        $.each(err.responseJSON.errors, function (key, value) {
                            msg += value[0] + '\n';
                        });
                        alert(msg);
                    } else {
                        console.error(err);
                        alert('Something went wrong!');
                    }
                }
            });
        });
    });

    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = () => {
            $('#imagePreview').attr('src', reader.result);
        };
        reader.readAsDataURL(event.target.files[0]);
    }


</script>
@endpush
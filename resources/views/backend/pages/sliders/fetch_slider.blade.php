@extends('backend.master.masterback')

@section('title')
Sliders
@endsection

@push('link')
<link href="{{ asset('backend/plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
    .modal.fade .modal-dialog {
        transform: translateY(-100%);
        transition: transform 0.4s ease-out;
    }

    .modal.fade.show .modal-dialog {
        transform: translateY(0);
    }
</style>
@endpush

@section('content')
<div class="col-md-12 col-lg-12">
    <div class="d-flex justify-content-between py-2">
        <h2 class="text-center">SLIDERS</h2>
        <a href="{{ url('admin/sliders') }}" class="btn btn-primary">NEW SLIDER</a>
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
                <th>Title</th>
                <th>Subtitle</th>
                <th>Image</th>
                <th>Image URL</th>
                <th>Button Text</th>
                <th>Button Link</th>
                <th>Page</th>
                <th>Precedence</th>
                <th>Status</th>
                <th>Starts</th>
                <th>Ends</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sliders as $slider)
            <tr>
                <td class="slider-id">{{ $slider->id }}</td>
                <td class="slider-title">{{ $slider->title }}</td>
                <td class="slider-subtitle">{{ $slider->subtitle }}</td>
                <td>
                    @if($slider->image)
                    <img src="{{ asset('images/sliders/' . $slider->image) }}" width="70">
                    @else No Image
                    @endif
                </td>
                <td class="slider-image-url">{{ $slider->image_url }}</td>
                <td class="slider-button-text">{{ $slider->button_text }}</td>
                <td class="slider-button-link">{{ $slider->button_link }}</td>
                <td class="slider-page">{{ $slider->page }}</td>
                <td class="slider-precedence">{{ $slider->precedence }}</td>
                <td class="slider-status">{{ $slider->is_active ? 'Active' : 'Inactive' }}</td>
                <td class="slider-starts">{{ $slider->starts_at }}</td>
                <td class="slider-ends">{{ $slider->ends_at }}</td>
                <td>
                    <button class="btn btn-success btn-sm editSliderBtn">Edit</button>
                    <a href="{{url('admins/slider/delete/'.$slider->id)}}" class="btn btn-danger btn-sm"
                        onclick="return confirm('Are you sure you want to delete this slider?')">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="editSliderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="updateSliderForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" id="sliderId">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Slider</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body row g-3">
                    <div class="col-md-6">
                        <label>Title</label>
                        <input type="text" name="title" id="sliderTitle" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Subtitle</label>
                        <input type="text" name="subtitle" id="sliderSubtitle" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Upload New Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Image URL</label>
                        <input type="text" name="image_url" id="sliderImageUrl" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Button Text</label>
                        <input type="text" name="button_text" id="sliderButtonText" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Button Link</label>
                        <input type="text" name="button_link" id="sliderButtonLink" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Page</label>
                        <input type="number" name="page" id="sliderPage" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Precedence</label>
                        <input type="number" name="precedence" id="sliderPrecedence" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Status</label>
                        <select name="is_active" id="sliderStatus" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Start Date</label>
                        <input type="date" name="starts_at" id="sliderStartsAt" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>End Date</label>
                        <input type="date" name="ends_at" id="sliderEndsAt" class="form-control">
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary mt-3" type="submit">Update Slider</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('backend_script')
<script>
   $(document).ready(function () {
    // Show modal with data
    $('.editSliderBtn').on('click', function () {
        let row = $(this).closest('tr');

        let id = row.find('.slider-id').text().trim();
        let title = row.find('.slider-title').text().trim();
        let subtitle = row.find('.slider-subtitle').text().trim();
        let imageUrl = row.find('.slider-image-url').text().trim();
        let buttonText = row.find('.slider-button-text').text().trim();
        let buttonLink = row.find('.slider-button-link').text().trim();
        let page = row.find('.slider-page').text().trim();
        let precedence = row.find('.slider-precedence').text().trim();
        let status = row.find('.slider-status').text().trim().toLowerCase() === 'active' ? '1' : '0';
        let startsAt = row.find('.slider-starts').text().trim();
        let endsAt = row.find('.slider-ends').text().trim();

        $('#sliderId').val(id);
        $('#sliderTitle').val(title);
        $('#sliderSubtitle').val(subtitle);
        $('#sliderImageUrl').val(imageUrl);
        $('#sliderButtonText').val(buttonText);
        $('#sliderButtonLink').val(buttonLink);
        $('#sliderPage').val(page);
        $('#sliderPrecedence').val(precedence);
        $('#sliderStatus').val(status);
        $('#sliderStartsAt').val(startsAt);
        $('#sliderEndsAt').val(endsAt);

        $('#editSliderModal').modal('show');
    });

    // AJAX update with image
    $('#updateSliderForm').submit(function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        let imageFile = $('input[name="image"]')[0]?.files[0];

        if (imageFile) {
            formData.append('image', imageFile);
        }

        $.ajax({
            url: "{{ url('admins/slider/update') }}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (res) {
                if (res.status === 'success') {
                    alert('Slider updated successfully!');
                    window.location.reload();
                } else {
                    alert('Failed to update slider.');
                }
            },
            error: function (err) {
                console.error(err);
                alert('An error occurred while updating.');
            }
        });
    });
});
</script>
@endpush
@extends('backend.master.masterback')

@section('title')
Events
@endsection

@section('content')
<div class="col-xl-12 col-md-12 col-sm-12 col-12">
    <div class="wrapper wrapper--w790">
        <div class="card card-5">
            <div class="card-heading">
                <h2 class="title">Add Event</h2>
            </div>
            <div class="card-body">
                <div id="errorsList" class="d-flex content-align-center"></div>
                <form id="eventForm" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="name">Event Name</div>
                        <div class="value">
                            <input class="input--style-5" type="text" name="event_name" id="event_name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Description</div>
                        <div class="value">
                            <textarea class="input--style-5" name="description" id="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Location</div>
                        <div class="value">
                            <input class="input--style-5" type="text" name="location" id="location">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Organizer</div>
                        <div class="value">
                            <input class="input--style-5" type="text" name="organizer" id="organizer">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Start Date</div>
                        <div class="value">
                            <input class="input--style-5" type="date" name="start_date" id="start_date">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">End Date</div>
                        <div class="value">
                            <input class="input--style-5" type="date" name="end_date" id="end_date">
                        </div>
                    </div>

                    {{-- Banner Image --}}
                    <div class="form-row">
                        <div class="name">Banner Image</div>
                        <div class="value">
                            <input class="input--style-5" type="file" name="banner" id="banner" accept="image/*"
                                onchange="previewSingleImage(event, 'bannerPreview')">
                            <div class="image-preview-container">
                                <img id="bannerPreview" src="" alt="Banner Preview" class="image-preview">
                            </div>
                        </div>
                    </div>

                    {{-- Thumbnail Image --}}
                    <div class="form-row">
                        <div class="name">Thumbnail Image</div>
                        <div class="value">
                            <input class="input--style-5" type="file" name="thumbnail" id="thumbnail" accept="image/*"
                                onchange="previewSingleImage(event, 'thumbnailPreview')">
                            <div class="image-preview-container">
                                <img id="thumbnailPreview" src="" alt="Thumbnail Preview" class="image-preview">
                            </div>
                        </div>
                    </div>

                    {{-- Gallery Images --}}
                    <div class="form-row">
                        <div class="name">Gallery Images</div>
                        <div class="value">
                            <div id="galleryInputs">
                                <input class="input--style-5 mb-2" type="file" name="images[]" accept="image/*"
                                    onchange="previewMultipleImages(event)">
                            </div>
                            <button type="button" class="btn btn-sm btn-success mt-2" onclick="addGalleryInput()">Add
                                More Images</button>
                            <div class="gallery-preview-container d-flex flex-wrap mt-2" id="galleryPreview"></div>
                        </div>
                    </div>

                    <div class="form-row m-t-20">
                        <button class="btn btn--radius-2 btn--red" type="submit">SUBMIT</button>
                    </div>
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
        $('#eventForm').on('submit', function (e) {
            e.preventDefault();
            $('#errorsList').html('');

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('event.store') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    alert(response.message || 'Event created successfully!');
                    $('#eventForm')[0].reset();
                    $('#bannerPreview').attr('src', '');
                    $('#thumbnailPreview').attr('src', '');
                    $('#galleryPreview').html('');
                    $('#galleryInputs').html('<input class="input--style-5 mb-2" type="file" name="images[]" accept="image/*" onchange="previewMultipleImages(event)">');
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorHtml = '<ul class="alert alert-danger">';
                    $.each(errors, function (key, value) {
                        errorHtml += `<li>${value[0]}</li>`;
                    });
                    errorHtml += '</ul>';
                    $('#errorsList').html(errorHtml);
                }
            });
        });
    });

    function previewSingleImage(event, previewId) {
        const reader = new FileReader();
        reader.onload = function () {
            document.getElementById(previewId).src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    function previewMultipleImages(event) {
        const files = event.target.files;
        const galleryContainer = document.getElementById('galleryPreview');
        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'gallery-image-preview';
                galleryContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    }

    function addGalleryInput() {
        let input = document.createElement('input');
        input.type = 'file';
        input.name = 'images[]';
        input.accept = 'image/*';
        input.className = 'input--style-5 mb-2';
        input.setAttribute('onchange', 'previewMultipleImages(event)');
        document.getElementById('galleryInputs').appendChild(input);
    }

</script>
@endpush

@push('link')
<style>
    .gallery-preview-container {
        gap: 10px;
    }

    .gallery-image-preview {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #ccc;
        margin-right: 10px;
    }

    .image-preview-container,
    .gallery-preview-container {
        margin-top: 10px;
        text-align: center;
    }

    .image-preview {
        width: 160px;
        height: 140px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #ccc;
    }

    .gallery-image-preview {
        width: 120px;
        height: 100px;
        object-fit: cover;
        margin: 5px;
        border-radius: 12px;
        border: 2px solid #ccc;
    }
</style>

<link href="{{asset('form/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">
<link href="{{asset('form/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i"
    rel="stylesheet">
<link href="{{asset('form/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
<link href="{{asset('form/vendor/datepicker/daterangepicker.css')}}" rel="stylesheet" media="all">
<link href="{{asset('form/css/main.css')}}" rel="stylesheet" media="all">

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
</style>
@endpush
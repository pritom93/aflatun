@extends('backend.master.masterback')

@section('title')
Add Slider
@endsection

@section('content')
<div class="col-xl-12 col-md-12 col-sm-12 col-12">
    <div class="wrapper wrapper--w790">
        <div class="card card-5">
            <div class="card-heading">
                <h2 class="title">Create New Slider</h2>
            </div>
            <div class="card-body">
                <form id="SliderForm" enctype="multipart/form-data">
                    @csrf

                    <div class="form-row">
                        <div class="name">Title</div>
                        <div class="value">
                            <input class="input--style-5" type="text" id="title" name="title" placeholder="Enter slider title">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="name">Subtitle</div>
                        <div class="value">
                            <input class="input--style-5" type="text" id="subtitle" name="subtitle" placeholder="Enter subtitle text">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="name">Button Text</div>
                        <div class="value">
                            <input class="input--style-5" type="text" id="button_text" name="button_text" placeholder="e.g. Shop Now">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="name">Button Link</div>
                        <div class="value">
                            <input class="input--style-5" type="text" id="button_link" name="button_link" placeholder="https://example.com">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="name">Page</div>
                        <div class="value">
                            <input class="input--style-5" type="number" id="page" name="page" min="0" placeholder="e.g. 1">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="name">Precedence</div>
                        <div class="value">
                            <input class="input--style-5" type="number" id="precedence" name="precedence" min="0" placeholder="e.g. 1">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="name">Status</div>
                        <div class="value">
                            <select name="is_active" id="is_active" class="input--style-5">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="name">Start Date</div>
                        <div class="value">
                            <input class="input--style-5" type="datetime-local" id="starts_at" name="starts_at">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="name">End Date</div>
                        <div class="value">
                            <input class="input--style-5" type="datetime-local" id="ends_at" name="ends_at">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="name">Banner Image</div>
                        <div class="value">
                            <input class="input--style-5" type="file" id="image" name="image" accept="image/*" onchange="previewSliderImage(this, 'bannerPreview')">
                            <div class="image-preview-container">
                                <img id="bannerPreview" src="" alt="Banner Preview" class="image-preview">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="name">Image Link</div>
                        <div class="value">
                            <input class="input--style-5" type="text" id="image_link" name="image_link" placeholder="https://example.com">
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
<script>
    function previewSliderImage(inputElement, previewId) {
        const file = inputElement.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function () {
                document.getElementById(previewId).src = reader.result;
            };
            reader.readAsDataURL(file);
        }
    }

    $(document).ready(function () {
        $('#SliderForm').on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this); // auto collects all inputs including file

            $.ajax({
                url: "{{ url('admins/sliders') }}",
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (response) {
                    alert("Slider created successfully!");
                    console.log(response);
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMsg = "Validation failed:\n";
                        $.each(errors, function (key, value) {
                            errorMsg += `- ${value[0]}\n`;
                        });
                        alert(errorMsg);
                    } else {
                        alert("Server error: " + xhr.status);
                    }
                }
            });
        });
    });
</script>
@endpush

@push('link')
<style>
    .image-preview-container {
        margin-top: 10px;
        text-align: center;
    }

    .image-preview {
        width: 160px;
        height: 140px;
        border-radius: 12px;
        object-fit: cover;
        border: 2px solid #ccc;
    }

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

<link href="{{asset('form/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">
<link href="{{asset('form/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
<link href="{{asset('form/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
<link href="{{asset('form/vendor/datepicker/daterangepicker.css')}}" rel="stylesheet" media="all">
<link href="{{asset('form/css/main.css')}}" rel="stylesheet" media="all">
@endpush

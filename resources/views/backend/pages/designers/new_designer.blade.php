@extends('backend.master.masterback')
@section('title')
Desiners
@endsection
@section('content')
<div class="col-xl-12 col-md-12 col-sm-12 col-12">
    <div class="wrapper wrapper--w790">
        <div class="card card-5">
            <div class="card-heading">
                <h2 class="title">Add Fashion Designer</h2>
            </div>
            <div class="card-body">
                <div id="errorsList" class="d-flex content-align-center"></div>
                <form id="designerForm" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="name">Name</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" type="text" id="adminname" name="name">
                                <p id="username" class="text-danger"></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Email</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" type="email" id="adminemail" name="email">
                                <p id="email" class="text-danger"></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Phone</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" type="text" name="phone" id="phone">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Address</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" type="text" name="address" id="address">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Image Upload with Live Preview -->
                    <div class="form-row">
                        <div class="name">Image</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" type="file" name="image" id="image" accept="image/*" onchange="previewImage(event)">
                            </div>
                            <div class="image-preview-container">
                                <img id="imagePreview" src="" alt="Image Preview" class="image-preview">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="name">Bio</div>
                        <div class="value">
                            <div class="input-group">
                                <textarea class="input--style-5" name="bio" id="bio" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Status</div>
                        <div class="value">
                            <div class="input-group">
                                <select class="input--style-5" name="status" id="status">
                                    <option value="">Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
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
@push('link')
<link href="{{asset('form/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">
<link href="{{asset('form/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
<!-- Font special for pages-->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i"
    rel="stylesheet">

<!-- Vendor CSS-->
<link href="{{asset('form/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
<link href="{{asset('form/vendor/datepicker/daterangepicker.css')}}" rel="stylesheet" media="all">

<!-- Main CSS-->
<link href="{{asset('form/css/main.css')}}" rel="stylesheet" media="all">

<style>
.card-5 {
    background-color: rgba(20, 23, 24, 0.4); /* light transparent blue */
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    padding: 20px;
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: white; /* <<< This makes all text inside white */
}
    .image-preview-container {
        margin-top: 10px;
        text-align: center;
    }
    .image-preview {
        width: 160px;
        height: 140px;
        border-radius: 50%;
        /* object-fit: cover; */
        border: 2px solid #ccc;
    }
</style>
@endpush
@push('backend_script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#designerForm').on('submit', function (e) {
            e.preventDefault();
    
            // Clear old errors
            $('#errorsList').html('');
            $('.is-invalid').removeClass('is-invalid');
    
            const name = $('#adminame').val();
            const email = $('#adminemail').val();
            const phone = $('#phone').val();
            const address = $('#address').val();
            const bio = $('#bio').val();
            const status = $('#status').val();
    
            const data = {
                name: name,
                email: email,
                phone: phone,
                address: address,
                bio: bio,
                status: status,
            };
    console.log(data);
            $.ajax({
                url: "{{ route('designer.store') }}",
                type: "POST",
                data: data,
                dataType: 'json',
                success: function (response) {

                    alert(response.message || 'Designer added successfully!');
                    $('#designerForm')[0].reset();
                },
               
            });
        });
    });
    </script>
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('imagePreview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endpush

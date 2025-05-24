@extends('backend.master.masterback');
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

@endpush
@section('title')
Dashboard
@endsection

@section('content')
<div class="container min-vh-100 d-flex align-items-center justify-content-center bg-light">
    <div class="row w-100">
        <div class="col-md-4 mx-auto animate-slide-in rounded-4 shadow-lg bg-white p-5">
            <form id="RoleFormID" method="" action="" class="space-y-4">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <label for="name" class="fw-bold text-primary">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter Role Name"
                        class="form-control form-control-lg colorful-input" required>
                </div>

                <!-- Status -->
                <div class="form-group mt-3">
                    <label for="status" class="fw-bold text-primary">Status</label>
                    <select name="status" id="status"
                        class="form-select form-select-lg colorful-input" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <!-- Permission -->
                <div class="form-group mt-3">
                    <label for="permission" class="fw-bold text-primary">Status</label>
                    <select name="permission" id="permission"
                        class="form-select form-select-lg colorful-input" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="text-center mt-4">
                    <button type="submit"
                        class="btn btn-lg btn-gradient w-100 text-white fw-bold shadow-sm">
                        Save Role
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('link')
<style>
    .animate-slide-in {
        animation: slide-in 0.7s ease-in-out forwards;
        opacity: 0;
        transform: translateY(40px);
    }

    @keyframes slide-in {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .colorful-input {
        border: 2px solid #d0d0d0;
        transition: all 0.4s ease-in-out;
        border-radius: 1rem;
    }

    .colorful-input:focus {
        border-color: #6a11cb;
        box-shadow: 0 0 10px #6a11cb88;
    }

    .btn-gradient {
        background: linear-gradient(45deg, #6a11cb, #2575fc);
        border: none;
        border-radius: 1rem;
        transition: transform 0.3s ease;
    }

    .btn-gradient:hover {
        transform: scale(1.05);
        background: linear-gradient(45deg, #2575fc, #6a11cb);
    }
</style>
@endpush
@push('backend_script')

<script>
   $("#RoleFormID").submit(function(event) {
        event.preventDefault();

        let name = $('#name').val();
        let status = $('#status').val();
        let permission = $('#permission').val();

        const formData = new FormData();
        formData.append("name", name);
        formData.append("status", status);
        formData.append("permission", permission);
  
        $.ajax({
            url: "{{ url('admins/new-role-insert') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    $("#RoleFormID")[0].reset(); // reset the form
                } else {
                    alert("Something went wrong.");
                }
            },
            error: function(xhr) {
                let err = xhr.responseJSON.errors;
                let msg = '';
                for (const key in err) {
                    msg += err[key][0] + '\n';
                }
                alert(msg);
            }
        });
    });
</script>



<script src="{{asset('form/vendor/jquery/jquery.min.js')}}"></script>
<!-- Vendor JS-->
<script src="{{asset('form/vendor/select2/select2.min.js')}}"></script>
<script src="{{asset('form/vendor/datepicker/moment.min.js')}}"></script>
<script src="{{asset('form/vendor/datepicker/daterangepicker.js')}}"></script>

<!-- Main JS-->
<script src="{{asset('form/js/global.js')}}"></script>


@endpush
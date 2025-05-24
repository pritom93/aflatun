@extends('backend.master.masterback')

@push('link')
<!-- Fonts and Icons -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600&display=swap" rel="stylesheet">
<link href="{{ asset('form/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet">

<!-- Custom CSS -->
<style>
    .card {
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        padding: 30px;
        background-color: #fff;
    }

    .form-row {
        margin-bottom: 20px;
    }

    .name {
        font-weight: 600;
        margin-bottom: 8px;
    }

    .input-group input,
    .input-group select {
        width: 100%;
        padding: 12px 15px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 16px;
    }

    .input-group input[type="file"] {
        padding: 8px;
    }

    select {
        background-color: #fff;
        height: 50px;
    }

    .form-row img {
        margin-bottom: 15px;
        border-radius: 50%;
    }

    .btn {
        padding: 12px 25px;
        border: none;
        border-radius: 8px;
        background-color: #e63946;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
    }

    .radio-container {
        display: inline-block;
        margin-right: 20px;
    }
</style>
@endpush

@section('title')
Dashboard
@endsection

@section('content')
<div class="container mt-5">
    <div class="card">
        <h2 class="mb-4">Edit Admin</h2>
        <form id="AdminFormUpdate" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="hiddenAdminID" value="{{ $admins_data->id }}">

            <div class="form-row">
                <label class="name">Name</label>
                <div class="input-group">
                    <input type="text" id="adminname" name="name" value="{{ $admins_data->name }}">
                </div>
            </div>

            <div class="form-row">
                <label class="name">Email</label>
                <div class="input-group">
                    <input type="email" id="adminemail" name="email" value="{{ $admins_data->email }}">
                </div>
            </div>

            <div class="form-row">
                <label class="name">Password</label>
                <div class="input-group">
                    <input type="password" id="adminpassword" name="password" placeholder="Password is not shown">
                </div>
            </div>

            <div class="form-row">
                <label class="name">Admin Area</label>
                <div class="input-group">
                    <input type="number" id="adminarea" name="adminarea" value="{{ $admins_data->admin_area_id }}">
                </div>
            </div>

            <div class="form-row">
                <label class="name">Role</label>
                <div class="input-group">
                    <select id="adminrole" name="adminrole">
                        <option value="{{ $admins_data->role_id}}">{{ $admins_data->role_id }}</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row">
                <label class="name">Avatar</label><br>
                <img src="{{ asset('images/admins/' . $admins_data->avatar) }}" width="100" height="100" alt="Avatar">
                <div class="input-group">
                    <input type="file" id="adminavatar" name="avatar">
                </div>
            </div>

            <div class="form-row">
                <label class="name">Status</label>
                <div class="input-group">
                    <select id="adminstatus" name="status">
                        <option value="1" {{ $admins_data->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $admins_data->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <label class="name">Are you sure?</label>
                <div>
                    <label class="radio-container">Yes
                        <input type="radio" name="exist" checked>
                    </label>
                    <label class="radio-container">No
                        <input type="radio" name="exist">
                    </label>
                </div>
            </div>

            <div class="form-row">
                <button type="submit" class="btn">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('backend_script')
<script>
    $("#AdminFormUpdate").submit(function (e) {
        e.preventDefault();

        let formData = new FormData(this);
        formData.append("id", $("#hiddenAdminID").val());

        $.ajax({
            url: "{{ url('admins/update_admin') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                alert("Admin updated successfully!");
                console.log(res);
            },
            error: function (err) {
                console.error("Error:", err);
                alert("Something went wrong.");
            }
        });
    });
</script>
@endpush
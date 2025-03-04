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
<div class="col-xl-12 col-md-12 col-sm-12 col-12">


    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title">NEW ADMIN REGISTRATION</h2>
                </div>
                <div class="card-body">
                    <form id="AdminFormUpdate">
                        @csrf
                        <div class="form-row">
                            <div class="name">Name</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" value="{{$admins_data->name}}"
                                        id="adminname" name="name">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Email</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="email" value="{{$admins_data->email}}"
                                        id="adminemail" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Password</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="password" placeholder="Password is not Showing"
                                        id="adminpassword" name="password">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Admin Area</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="number" value="{{$admins_data->admin_area_id}}"
                                        id="adminarea" name="adminarea">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Role</div>
                            <div class="value">
                                <div class="input-group">
                                    <input type="hidden" id="hiddenAdminID" value="{{$admins_data->id}}">
                                    <input class="input--style-5" type="number" value="{{$admins_data->role_id}}"
                                        id="adminrole" name="adminrole">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <img src="{{asset('images/admins/'.$admins_data->avatar)}}" alt="Profile Picture"
                                class="rounded-circle" width="100" height="100">

                            <div class="name">Avatar</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="file" id="adminavatar" name="avatar">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">Status</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select id="adminstatus" name="subject">
                                            <option disabled="disabled" selected="selected">Choose option</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row p-t-20">
                            <label class="label label--block">Are you sure?</label>
                            <div class="p-t-15">
                                <label class="radio-container m-r-55">Yes
                                    <input type="radio" checked="checked" name="exist">
                                    <span class="checkmark"></span>
                                </label>
                                <label class="radio-container">No
                                    <input type="radio" name="exist">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <button onclick="adminRegistration()" class="btn btn--radius-2 btn--red"
                                type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('backend_script')
<script>
    $("#AdminFormUpdate").submit(function(event){
        event.preventDefault();
    // function adminRegistration(){
       let name   = $('#adminname').val();
       let email  = $('#adminemail').val();
       let password = $('#adminpassword').val();
       let admin_area = $('#adminarea').val();
       let role   = $('#adminrole').val();
       let status = $('#adminstatus').val();
       let id = $('#hiddenAdminID').val();
      
       const admindata = new FormData();
        admindata.append("name", name);
        admindata.append("email", email);
        admindata.append("pass", password);
        admindata.append("admin_area", admin_area);
        admindata.append("role", role);
        admindata.append("status", status);
        admindata.append("id", id);
        const fileInput = document.getElementById("adminavatar");
                const file = fileInput.files[0];
                if (!file) {
                    alert("Please select an image first.");
                    return;
                }
                admindata.append("avatar", file);

       $.ajax({
        url: "{{url('admins/update_admin')}}",
            type: "POST",
            data: admindata,
            processData: false,
            contentType: false, 
            enctype: "multipart/form-data",
            success: function (response) {
                console.log(response);
                $('#AdminFormmain')[0].reset();
                document.getElementById('#adminEmailID').innerHTML = "email is wrong";
            },

       });
        
    })
</script>



<script src="{{asset('form/vendor/jquery/jquery.min.js')}}"></script>
<!-- Vendor JS-->
<script src="{{asset('form/vendor/select2/select2.min.js')}}"></script>
<script src="{{asset('form/vendor/datepicker/moment.min.js')}}"></script>
<script src="{{asset('form/vendor/datepicker/daterangepicker.js')}}"></script>

<!-- Main JS-->
<script src="{{asset('form/js/global.js')}}"></script>


@endpush
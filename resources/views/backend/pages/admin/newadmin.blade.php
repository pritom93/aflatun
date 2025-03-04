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



    <div class="wrapper wrapper--w790">
        <div class="card card-5">
            <div class="card-heading">
                <h2 class="title">NEW ADMIN REGISTRATION</h2>
            </div>
            <div class="card-body">
                <div id="errorsList" class="d-flex content-align-center"></div>
                <form id="AdminFormmain">
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
                            <p id="adminEmailID"></p>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Password</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" type="password" id="adminpassword" name="password" />
                                <p id="password" class="text-danger"></p>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Admin Area</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" type="number" id="adminarea" name="adminarea">

                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Role</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" type="number" id="adminrole" name="adminrole">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
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
                        <button id="adminForm" class="btn btn--radius-2 btn--red" type="submit">SUBMIT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection
@push('backend_script')
<script>
    $("#AdminFormmain").submit(function(event){
        event.preventDefault();
    // function adminRegistration(){
       let name   = $('#adminname').val();
       let email  = $('#adminemail').val();
       let password = $('#adminpassword').val();
       let admin_area = $('#adminarea').val();
       let role   = $('#adminrole').val();
       let status = $('#adminstatus').val();
      
       const formData = new FormData();
        formData.append("name", name);
        formData.append("email", email);
        formData.append("pass", password);
        formData.append("admin_area", admin_area);
        formData.append("role", role);
        formData.append("status", status);
        // const fileInput = document.getElementById("adminavatar");
        //         const file = fileInput.files[0];
        //         if (!file) {
        //             alert("Please select an image first.");
        //             return;
        //         }
        //         formData.append("avatar", file);

       $.ajax({
        url: "{{url('admin/newadmin')}}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false, 
            enctype: "multipart/form-data",
            success: function (response) {
                console.log(response);
                $('#AdminFormmain')[0].reset();
                document.getElementById('#adminEmailID').innerHTML = "email is wrong";
            },
            error: function (xhr, status, error) {
                if(xhr.status == 422){
                    // let err = "<ul class='list-group'>"
                    // const valueErr = JSON.parse(xhr.responseText)
                    // const ky = Object.keys(errSms.errors)
                    // ky.forEach(item => {
                    //     document.getElementById(item).innerHTML = item[0]
                    //     err += `<li class='text-danger'>${item[0]}</li>`
                    // });
                    // err += "</ul>";
                    // document.getElementById("errorsList").innerHTML = err

                    const errSms = JSON.parse(xhr.responseText)
                    const ky = Object.keys(errSms.errors)
                    ky.map(item => {
                        document.getElementById(item).innerHTML = errSms.errors[item][0]
                    })
                }
                
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
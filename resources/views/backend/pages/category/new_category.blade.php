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




    <div class="card card-5">
        <div class="card-heading">
            <h2 class="title">Set Category</h2>
        </div>
        <div class="card-body">
            <form id="CategoryFormmain" method="">

                <div class="form-row">
                    <div class="name">Category Name</div>
                    <div class="value">
                        <div class="input-group">
                            <input class="input--style-5" type="text" id="CategoryName" name="CategoryName">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="name">Native Name</div>
                    <div class="value">
                        <div class="input-group">
                            <input class="input--style-5" type="text" id="nativeName" name="nativeName">
                        </div>
                    </div>
                </div>
                <div class="form-row">
<div class="name">Parent Category</div>
                    <div class="value">
                        <div class="input-group">
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select id="ParentCategoryID" name="subject">
                                    <option disabled="disabled" selected="selected">Parent Category</option>
                                    @foreach ($categories as $value)
                                    <option value="{{$value->id}}">{{$value->category_name}}</option>
                                    @endforeach
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="form-row">
                    <div class="name">ICON</div>
                    <div class="value">
                        <div class="input-group">
                            <input class="input--style-5" type="file" id="CategoryIcon" name="CategoryIcon">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="name">Status</div>
                    <div class="value">
                        <div class="input-group">
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select id="CategoryStatus" name="subject">
                                    <option disabled="disabled" selected="selected">Choose option</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <button id="" class="btn btn--radius-2 btn--red" type="submit">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@push('backend_script')
<script>
    $(document).ready(function(){
        $("#CategoryFormmain").submit(function(event){
            event.preventDefault();
            
            var c_name = $('#CategoryName').val(); 
            var c_n_name = $('#nativeName').val();
            var c_status = $('#CategoryStatus').val();
var parent = $('#ParentCategoryID').val();
            
            const category = new FormData();
            category.append('cname', c_name);
            category.append('cn_name', c_n_name);
            category.append('cstatus', c_status);
category.append('parent', parent);
            
            
            const fileInput = document.getElementById("CategoryIcon");
            const file = fileInput.files[0];
            if (!file) {
                alert("Please select an image first.");
                return;
            }
            category.append("cicon", file);
            
            console.log(category);

            $.ajax({
                url: "{{url('admins/new_category')}}",
                type: 'POST', 
                data: category,
                processData: false,
                contentType: false, 
                enctype: "multipart/form-data",
                success: function (response) {
                    console.log(response);
                    if(response.status == 'success'){
                        alert(response.message);
                    }
                },
               
            });
        });
    });
</script>



<script src="{{asset('form/vendor/jquery/jquery.min.js')}}"></script>
<!-- Vendor JS-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{asset('form/vendor/select2/select2.min.js')}}"></script>
<script src="{{asset('form/vendor/datepicker/moment.min.js')}}"></script>
<script src="{{asset('form/vendor/datepicker/daterangepicker.js')}}"></script>

<!-- Main JS-->
<script src="{{asset('form/js/global.js')}}"></script>


@endpush
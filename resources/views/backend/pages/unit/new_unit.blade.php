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
            <form id="unitFormID" method="">

                <div class="form-row">
                    <div class="name">Unit Name</div>
                    <div class="value">
                        <div class="input-group">
                            <input class="input--style-5" type="text" id="unitName" name="unitName">
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
    $('#unitFormID').submit(function(event){
        event.preventDefault();

        var unitName = $('#unitName').val();
        let data = {
            name: unitName,
        };

        $.ajax({
            url: "{{url('admins/createunit')}}",
            type: 'POST',
            data: data,
            dataType: 'json',
            success: function(response){ 
                console.log(response);
                alert("Unit created successfully!");
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
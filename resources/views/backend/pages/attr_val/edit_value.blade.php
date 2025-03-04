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
Values
@endsection
@section('content')
<div class="col-xl-12 col-md-12 col-sm-12 col-12">



    <div class="wrapper wrapper--w790">
        <div class="card card-5">
            <div class="card-heading">
                <h2 class="title">Attr Value Set</h2>
            </div>
            <div class="card-body">
                <form id="attrValueFormID" method="">

                    <div class="form-row">
                        <div class="name">Attribute Name</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" type="number" value="{{($attrval->attrname_id)}}"
                                    id="AttrValNameID" name="AttrValNameID">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Main Name</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" type="text" value="{{($attrval->name)}}"
                                    id="ValmainNameID" name="ValmainNameID">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Description</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" type="text" value="{{($attrval->description)}}"
                                    id="AttrValDesID" name="AttrValDesID">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="name">Count</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-5" type="number" value="{{($attrval->count)}}"
                                    id="AttrCountID" name="AttrCountID">
                            </div>
                            <input type="hidden" value="{{($attrval->id)}}" id="attrValHiddenID">
                        </div>
                    </div>
                    <div>
                        <button id="" class="btn btn--radius-2 btn--red" type="submit">SUBMIT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('backend_script')
<script>
    $(document).ready(function() {
    $('#attrValueFormID').submit(function(event) {
        event.preventDefault();
        const atrname = $('#AttrValNameID').val();
        const name = $('#ValmainNameID').val();
        const des = $('#AttrValDesID').val();
        const count = $('#AttrCountID').val();
        const id = $('#attrValHiddenID').val();
        let attrValue = {
            attrname: atrname,
            name: name,
            des: des,
            count: count,
            id: id
        }

        
        $.ajax({
            url: "{{url('admins/attr/update_attr_val')}}",
            type: 'POST',
            data: attrValue,
            dataType: 'json',
            success: function(response) {
                console.log(response);
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    if (errors.attrname) {
                        $('#AttrValNameID').after(
                            '<span class="error-message" style="color: red;">' + errors
                            .attrname[0] + '</span>');
                    }
                    if (errors.name) {
                        $('#ValmainNameID').after(
                            '<span class="error-message" style="color: red;">' + errors
                            .name[0] + '</span>');
                    }
                    if (errors.des) {
                        $('#AttrValDesID').after(
                            '<span class="error-message" style="color: red;">' + errors
                            .des[0] + '</span>');
                    }
                    if (errors.count) {
                        $('#AttrCountID').after(
                            '<span class="error-message" style="color: red;">' + errors
                            .count[0] + '</span>');
                    }

                }
            }
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
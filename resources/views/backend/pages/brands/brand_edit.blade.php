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
            <h2 class="title">SET BRAND</h2>
        </div>
        <div class="card-body">
            <form id="BrandFormID">

                <div class="form-row">
                    <div class="name">BRAND NAME</div>
                    <div class="value">
                        <div class="input-group">
                            <input class="input--style-5" type="text" value="{{$brands->name}}" id="brandName"
                                name="brandIDName">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="name">BRAND WONER NAME</div>
                    <div class="value">
                        <div class="input-group">
                            <input class="input--style-5" type="text" value="{{$brands->woner}}" id="BrandWoner"
                                name="BrandIDWoner">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="name">Brand Woner Phone</div>
                    <div class="value">
                        <div class="input-group">
                            <input class="input--style-5" type="tel" value="{{$brands->phone}}" id="WonerPhone"
                                name="WonerIDPhone">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="imageUpload" class="form-label">Brand Logo<a href="javascript:void(0)" id="clearImage"
                            class="text-danger" title="Clear Image">x</a></label>
                    <input class="form-control" type="file" id="imageUpload" accept="image/*" name="image">
                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760">
                    <div id="imagePreview" class="mt-2"></div>
                    <div><img class="img-fluid" style="width:70px;height:50px"
                            src="{{ asset('images/brands/' . $brands->image) }}" /></td>
                    </div>
                </div>
                <div class="form-row">
                    <div class="name">Contuct Address</div>
                    <div class="value">
                        <div class="input-group">
                            <input class="input--style-5" value="{{$brands->address}}" type="text"
                                id="WonerContuctAdress" name="WonerContucIDtAdress">
                            <input value="{{$brands->id}}" type="hidden" id="brandsHiddenID" name="brandsHiddenID">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="name">Product Name</div>
                    <div class="value">
                        <div class="input-group">
                            <input class="input--style-5" type="text" value="{{$brands->name}}" id="ProductName"
                                name="ProductIDName">
                        </div>
                    </div>
                </div>
                <div>
                    <button id="" class="btn btn--radius-2 btn--red" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@push('backend_script')
<script>
    $(document).ready(function(){
        $('#BrandFormID').submit(function(event){
            event.preventDefault();
            let BrandsData = new FormData();
                BrandsData.append('name', $('#brandName').val());
                BrandsData.append('woner', $('#BrandWoner').val());
                BrandsData.append('phone', $('#WonerPhone').val());
                BrandsData.append('address', $('#WonerContuctAdress').val());
                BrandsData.append('name', $('#ProductName').val());
                BrandsData.append('id', $('#brandsHiddenID').val());
                const fileInput = document.getElementById("imageUpload");
                 const file = fileInput.files[0];
                 BrandsData.append("image", file);
                 console.log(BrandsData);
                 

            $.ajax({
                url: "{{url('admins/brand/update')}}",
                type: 'POST',
                data: BrandsData,
                processData: false,
                contentType: false,
                enctype: 'multipart/form-data',
                success: function(response){
                    console.log(response);
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
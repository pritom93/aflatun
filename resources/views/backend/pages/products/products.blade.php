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
            <h2 class="title">SET PRODUCT</h2>
        </div>
        <div class="card-body">
            <form id="ProductFormID">

                <div class="form-row">
                    <div class="name">Unit Name</div>
                    <div class="value">
                        <div class="input-group">
                            <input class="input--style-5" type="number" id="UnitName" name="UnitIDName">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="name">Category Name</div>
                    <div class="value">
                        <div class="input-group">
                            <input class="input--style-5" type="number" id="CategoryName" name="CategoryIDName">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="name">Product Name</div>
                    <div class="value">
                        <div class="input-group">
                            <input class="input--style-5" type="text" id="ProductName" name="ProducIDtName">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="name">Price</div>
                    <div class="value">
                        <div class="input-group">
                            <input class="input--style-5" type="number" id="ProductPrice" name="ProductIDPrice">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="name">Description</div>
                    <div class="value">
                        <div class="input-group">
                            <input class="input--style-5" type="text" id="DescriptionProduct"
                                name="DescriptionIDProduct">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="imageUpload" class="form-label">Upload (Single File) <a href="javascript:void(0)"
                            id="clearImage" class="text-danger" title="Clear Image">x</a></label>
                    <input class="form-control" type="file" id="imageUpload" accept="image/*" name="image">
                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760">
                    <div id="imagePreview" class="mt-2"></div>
                </div>
                <div class="form-row">
                    <div class="name">Available Quantity</div>
                    <div class="value">
                        <div class="input-group">
                            <input class="input--style-5" type="number" id="ProductQNTY" name="ProductIDQNTY">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="name">Available Size</div>
                    <div class="value">
                        <div class="input-group">
                            <input class="input--style-5" type="text" id="SizeProduct" name="SizeIDProduct">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="name">Promoted</div>
                    <div class="value">
                        <div class="input-group">
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select id="ProductPromoted" name="subject">
                                    <option value="yes">YES</option>
                                    <option value="no">NO</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="name">Color</div>
                    <div class="value">
                        <div class="input-group">
                            <input class="form-check-input" type="checkbox" value="pink" id="ProductColor">pink
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="name">VAT %</div>
                    <div class="value">
                        <div class="input-group">
                            <input class="input--style-5" type="text" id="ProductVAT" name="ProductVAT">
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
        $('#ProductFormID').submit(function(event){
            event.preventDefault();
            let ProductData = new FormData();
                ProductData.append('unit', $('#UnitName').val());
                ProductData.append('category_id', $('#CategoryName').val());
                ProductData.append('name', $('#ProductName').val());
                ProductData.append('price', $('#ProductPrice').val());
                ProductData.append('des', $('#DescriptionProduct').val());
                ProductData.append('qty', $('#ProductQNTY').val());
                ProductData.append('size', $('#SizeProduct').val());
                ProductData.append('promot', $('#ProductPromoted').val());
                ProductData.append('color', $('#ProductColor').val());
                ProductData.append('vat', $('#ProductVAT').val());
                const fileInput = document.getElementById("imageUpload");
                 const file = fileInput.files[0];
                 ProductData.append("image", file);
                 console.log(ProductData);
                 

            $.ajax({
                url: "{{url('admins/add/product')}}",
                type: 'POST',
                data: ProductData,
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
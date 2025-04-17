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
    <div class="wrapper">
        <div class="card component-card_2  p-4" style="background: #0000">
            <div class="card-heading">
                <h2 class="title">Create Product</h2>
            </div>
            <div class="card-body">
                <form id="combinationForm">
                    <div class="form-row mb-4">
                        <div class="form-group col-md-2">
                            <label for="inputAddress">Product name</label>
                            <input class="form-control" type="text" id="ProductName" name="ProducIDtName">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="brandName">Brand</label>
                            <select class="form-control" id="brandName" name="brandName">                             
                                <option value="">Easy</option>
                                <option value="">Shant</option>
                                <option value="">Cline</option>                               
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="CategoryName">Category</label>
                            <select class="form-control" type="number" id="CategoryName" name="CategoryIDName">
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="subCategoryName">Subcategory</label>
                            <select class="form-control" id="subCategoryName" name="subCategoryName">                             
                                <option value="">polister</option>
                                <option value="">Shant</option>
                                <option value="">Cline</option>                               
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="UnitName">Unit</label>
                            <select class="form-control" id="UnitName" name="UnitIDName">
                                @foreach ($units as $unit)
                                <option value="{{$unit->id}}">{{$unit->unit_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="DesinerNameID">Desiner?</label>
                            <select class="form-control" id="DesinerNameID" name="DesinerNameID">                             
                                <option value="0">None</option>                                                    
                            </select>
                        </div>                       
                    </div>


                    <div id="combinationsContainer">
                        <!-- First Row (Template Row) -->
                        <div class="form-row mb-4 combination-row">
                            <!-- Size -->
                            <div class="form-group col-md-1">
                                <label>Size</label>
                                <select class="form-control size-select">
                                    <option value="">Select Size</option>
                                    @foreach ($sizes as $value)
                                    <option value="{{$value->id}}">{{$value->size_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Color -->
                            <div class="form-group col-md-2">
                                <label>Color</label>
                                <select class="form-control color-select">
                                    <option value="">Select Color</option>
                                    @foreach ($colors as $value)
                                    <option value="{{$value->id}}">{{$value->color_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Price -->
                            <div class="form-group col-md-1">
                                <label>Price</label>
                                <input type="number" class="form-control price-input" placeholder="Enter Price" min="0">
                            </div>
                            <div class="form-group col-md-1">
                                <label>Buying Price</label>
                                <input type="number" class="form-control costing-input" placeholder="Enter Price" min="0">
                            </div>
                            <div class="form-group col-md-1">
                                <label>Stock</label>
                                <input type="number" class="form-control stock-input" placeholder="Enter Stock Quantity" min="0">
                            </div>
                            <div class="form-group col-md-2">
                                <label>SKU</label>
                                <input type="text" class="form-control sku-input" placeholder="Product Identifying Code" min="0">
                            </div>
                            <div class="form-group col-md-1">
                                <label>Discount</label>
                                <input type="number" class="form-control discount-input" placeholder="Product Identifying Code" min="0">
                            </div>
                            <div class="form-group col-md-2">
                                <label>Variant Image</label>
                                <input type="file" class="form-control vrimage-input" placeholder="Image This Color">
                            </div>
                            <div class="form-group col-md-1">
                                <label>Display?</label>
                                <select class="form-control display-select">
                                    <option value="">Select Size</option>                                  
                                    <option value="1">YES</option>
                                    <option value="0">NO</option>                                   
                                </select>
                            </div>
                            <!-- Remove Button -->
                            <div class="form-group col-md-1 d-flex align-items-end">
                                <button class="badge badge-danger removeCombination" type="button">X</button>
                            </div>
                        </div>
                    </div>
                    <!-- Add More Button -->
                    <button class="badge badge-success mt-2" id="CombinationButton" type="button">Add More</button>

                    <div class="form-row mb-4">
                        <div class="form-group col-md-3">
                            <label for="inputUnit">Price</label>
                            <input class="form-control" type="number" id="ProductPrice" name="ProductIDPrice">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="category">VAT</label>
                            <input class="form-control" type="number" id="ProductVAT" name="ProductVAT">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="category">QTY</label>
                            <input class="form-control" type="number" id="ProductQNTY" name="ProductIDQNTY">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="category">Promot</label>
                            <select class="form-control" id="ProductPromoted" name="subject">
                                <option value="yes">YES</option>
                                <option value="no">NO</option>
                            </select>
                        </div>
                        <div class="form-group col-md-1">
                            <label for="category">Status</label>
                            <select class="form-control" id="statusID" name="statusID">
                                <option value="1">YES</option>
                                <option value="0">NO</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label for="imageUpload" class="form-label">Upload (Single File) <a href="javascript:void(0)"
                                id="clearImage" class="text-danger" title="Clear Image">x</a></label>
                        <input class="form-control" type="file" id="imageUpload" accept="image/*" name="image">
                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760">
                        <div id="imagePreview" class="mt-2"></div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="inputCity">Description</label>
                        <textarea class="form-control" id="DescriptionProduct" name="DescriptionIDProduct" cols="30" rows="5"></textarea>
                    </div>
                    
                    <button class="btn btn--radius-2 btn--red" type="submit">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('backend_script')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let combinationArray = [{ colorId: '', sizeId: '', price: 0, stock: 0, sku: 0, costing: 0, discount: 0, variantImage: '', display: '' }]; // Initial blank object

    function updateCombinationArray() {
        combinationArray = []; // Reset array

        $(".combination-row").each(function () {
            let sizeId = $(this).find(".size-select").val() || '';
            let colorId = $(this).find(".color-select").val() || '';
            let price = $(this).find(".price-input").val() || 0;
            let stock = $(this).find(".stock-input").val() || 0;
            let sku = $(this).find(".sku-input").val() || 0;
            let discount = $(this).find(".discount-input").val() || 0;
            let costing = $(this).find(".costing-input").val() || 0;
            let display = $(this).find(".display-select").val() || '';
            let variantImage = $(this).find(".vrimage-input").val() || '';

            combinationArray.push({ sizeId, colorId, price, stock, sku, discount, costing, display, variantImage });
        });

        console.log(combinationArray); // Debugging
    }

    // Add More Button Click
    $("#CombinationButton").on("click", function (e) {
        e.preventDefault();

        // Append new row to container
        let newRow = $(".combination-row:first").clone(); // Clone first row
        newRow.find(".size-select").val('');
        newRow.find(".color-select").val('');
        newRow.find(".price-input").val('');
        newRow.find(".stock-input").val('');
        newRow.find(".sku-input").val('');
        newRow.find(".discount-input").val('');
        newRow.find(".costing-input").val('');
        newRow.find(".vrimage-input").val('');

        $("#combinationsContainer").append(newRow);

        // Push blank object to array
        combinationArray.push({ colorId: '', sizeId: '', price: 0, stock: 0, sku: 0, discount: 0, costing: 0,display: '', variantImage: ''});

        console.log(combinationArray); // Debugging
    });

    $(document).on("click", ".removeCombination", function (e) {
        e.preventDefault();
        if ($(".combination-row").length > 1) {
            $(this).closest(".combination-row").remove();
            updateCombinationArray(); // Rebuild array after removal
        }
    });
    });

    $("#combinationForm").on("submit", function (e) {
        e.preventDefault(); // Prevent default form submission
        let combinationArray = [];
    let formData = new FormData(this);

    // Extract Combination Data
    $(".combination-row").each(function (index) {
            let sizeId = $(this).find(".size-select").val() || '';
            let colorId = $(this).find(".color-select").val() || '';
            let price = $(this).find(".price-input").val() || 0;
            let stock = $(this).find(".stock-input").val() || 0;
            let sku = $(this).find(".sku-input").val() || 0;
            let discount = $(this).find(".discount-input").val() || 0;
            let costing = $(this).find(".costing-input").val() || 0;
            let display = $(this).find(".display-select").val() || '';
            let fileInput = $(this).find(".vrimage-input")[0]; // Get file input element
            let variantImage = fileInput.files.length > 0 ? fileInput.files[0] : null;

                let combinationItem = {
                    sizeId: sizeId,
                    colorId: colorId,
                    price: price,
                    stock: stock,
                    sku: sku,
                    discount: discount,
                    costing: costing,
                    display: display,
                    variantImage: variantImage ? `variant_image_${index}` : ""
                };

                    combinationArray.push(combinationItem);

                    // Append file separately to FormData
                    if (variantImage) {
                        formData.append(`variant_image_${index}`, variantImage);
                    }
        });

        // Append JSON data to FormData
        formData.append("combinations", JSON.stringify(combinationArray));
        // for (var pair of formData.entries()) {
        //     console.log(pair[0]+ ', ' + pair[1]); 
        // }
        // return false;
        $.ajax({
                url: "{{url('admins/add/product')}}",
                type: "POST",
                data: formData,
                processData: false, 
                contentType: false, 
                enctype: "multipart/form-data",
                success: function (response) {
                    console.log(response);
                    if (response.status === "success") {
                        alert(response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                    alert("Something went wrong!");
                }
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
<script defer src="https://cdn.jsdelivr.net/npm/@coreui/coreui-pro@5.10.0/dist/js/coreui.bundle.min.js"></script>

@endpush
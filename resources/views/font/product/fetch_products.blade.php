@extends('font.master.mastering')
@section('title')
@endsection
@section('content')
<div class="row">
    <!-- Left Sidebar (Advertisement) -->
    {{-- <div class="col-md-2">
        <div class="menu p-3 bg-light border rounded">
            <h5>Menu</h5>
            <ul class="list-group">
                <li class="list-group-item"><a href="#">Home</a></li>
                <li class="list-group-item"><a href="#">Categories</a></li>
                <li class="list-group-item"><a href="#">Offers</a></li>
                <li class="list-group-item"><a href="#">Contact</a></li>
            </ul>
        </div>
    </div> --}}

    <!-- Center Content (Products) -->
    <div class="col-md-9">
        <div class="row justify-content-center">
            @foreach ($products as $product)
            <div class="col-md-3">
                <div class="product-card p-3 border rounded">
                    <!-- Product Image -->
                    <img id="product-image-{{$product->id}}" 
                         src="{{ asset('images/products/'.$product->image) }}" 
                         style="height: 180px; width:100%;" alt="Product Image">
                    
                    <div class="product-details mt-3">
                        <h5 class="product-title">{{$product->name}}</h5>
                        <div class="product-rating">★★★★☆ (4.5)</div>

                        <!-- Product Price -->
                        <p class="product-price">
                            <span id="product-price-{{$product->id}}" class="">
                                BDT: {{ $product->product_variation->first()->price ?? 'N/A' }}
                            </span>
                        </p>
                       
                        <!-- Color Buttons -->
                        <div class="product-colors d-flex">
                            @foreach ($product->product_variation as $variation)
                                @php
                                    $colorCode = $variation->color->color_code ?? $variation->color_id; // Use color_code, fallback to color_id
                                @endphp
                        
                                <button class="color-btn me-2 border rounded-circle" 
                                    data-product-id="{{ $product->id }}" 
                                    data-image="{{ asset('images/products/variant/'.$variation->image) }}" 
                                    data-price="{{ $variation->price }}"
                                    data-color="{{ $colorCode }}"
                                    data-colorId="{{ $variation->color_id }}"
                                    style="width: 30px; height: 30px; background-color: {{ $colorCode }}; border: 2px solid #ddd;">
                                </button>
                            @endforeach
                        </div>
                         {{-- size --}}
                         <div class="product-size d-flex mt-2">
                            @foreach ($product->product_variation as $variation)
                                <button class="size-btn me-2 border rounded px-3 py-1" 
                                    data-product-id="{{ $product->id }}" 
                                    data-price="{{ $variation->price }}"
                                    data-size="{{ $variation->size->size_name ?? $variation->size_id }}"
                                    data-sizeId="{{ $variation->size_id }}"
                                    style="background-color: #f8f9fa; border: 2px solid #ddd; font-weight: bold;">
                                    {{ $variation->size->size_name ?? $variation->size_id }}
                                </button>
                            @endforeach
                        </div>

                        <!-- Add to Cart Button -->
                        <button class="btn btn-add-cart w-100 mt-2 btn-primary add-to-cart"
                            data-product-id="{{ $product->id }}"
                            data-product-name="{{ $product->name }}"
                            data-price="{{ $product->product_variation->first()->price ?? 0 }}"
                            data-color=""
                        >
                            Add to Cart
                        </button>

                        <button class="btn btn-buy-now w-100 mt-2 btn-success">Buy Now</button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Right Sidebar (Advertisement) -->
    <div class="col-md-1">
        <div class="advertisement p-3 bg-light border rounded">
            <h5>Advertisement</h5>
            <img src="{{ asset('images/ads/ad-banner.jpg') }}" style="width: 100%; height: 200px;" alt="Ad Banner">
            <p class="mt-2">Check out our latest offers!</p>
        </div>
    </div>
</div>
<!-- jQuery for changing product image and price -->
@endsection
@push('link')
<style>
    body {
        background-color: #f5f5f5;
    }
    .product-card {
        background: #fff;
        border-radius: 8px;
        padding: 15px;
        margin-top: 16px;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        transition: 0.3s ease-in-out;
    }
    .product-card:hover {
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        transform: scale(1.02);
    }
    .product-card img {
        width: 100%;
        height: auto;
        object-fit: contain;
    }
    .product-title {
        font-size: 1.1rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 8px;
    }
    .product-price {
        font-size: 1.3rem;
        font-weight: bold;
        color: #b12704;
    }
    .product-original-price {
        font-size: 1rem;
        color: #888;
        text-decoration: line-through;
    }
    .product-discount {
        color: green;
        font-weight: bold;
    }
    .product-rating {
        color: #ffa41c;
    }
    .btn-add-cart {
        background: #ff9900;
        color: white;
        font-weight: bold;
        border-radius: 20px;
        padding: 8px 12px;
    }
    .btn-add-cart:hover {
        background: #e68900;
    }
    .btn-buy-now {
        background: #ff5722;
        color: white;
        font-weight: bold;
        border-radius: 20px;
        padding: 8px 12px;
    }
    .btn-buy-now:hover {
        background: #d84315;
    }

</style>
@endpush
@push('script')

<script>
   $(document).ready(function() {
    var selectedColor = null;
    var selectedSize = null;

    // Color Selection
    $(".color-btn").click(function() {
        selectedColor = $(this).data("color");
        var productId = $(this).data("product-id");
        var newImage = $(this).data("image");
        var newPrice = $(this).data("price");

        // Update Image & Price
        $("#product-image-" + productId).attr("src", newImage);
        $("#product-price-" + productId).text("BDT: " + newPrice);

        // Store selected color in Add to Cart button
        $(".add-to-cart[data-product-id='" + productId + "']").data("color", selectedColor);
        $(".add-to-cart[data-product-id='" + productId + "']").data("image", newImage);
        
        // Highlight selected color
        $(".color-btn[data-product-id='" + productId + "']").removeClass("selected");
        $(this).addClass("selected");
    });

    // Size Selection
    $(".size-btn").click(function() {
        selectedSize = $(this).data("size");
        var productId = $(this).data("product-id");
        var newPrice = $(this).data("price");

        // Update Price
        $("#product-price-" + productId).text("BDT: " + newPrice);

        // Store selected size in Add to Cart button
        $(".add-to-cart[data-product-id='" + productId + "']").data("size", selectedSize);
        $(".add-to-cart[data-product-id='" + productId + "']").data("price", newPrice);

        // Highlight selected size
        $(".size-btn[data-product-id='" + productId + "']").removeClass("py-2 selected");
        $(this).addClass("py-2 selected");
    });

    // Add to Cart Function
    $(".add-to-cart").click(function() {
        var productId = $(this).data("product-id");
        var productName = $(this).data("product-name");
        var price = $(this).data("price");
        var color = $(this).data("color");
        var size = $(this).data("size");
        var colorId = $(this).data("colorId");
        var sizeId = $(this).data("sizeId");
        var image = $(this).data("image");

        if (!color || !size) {
            alert("Please select both color and size before adding to cart!");
            return;
        }

        console.log("Adding to cart:", { productId, productName, price, sizeId, colorId, image });

        $.ajax({
            url: "{{ route('cart.add') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                product_id: productId,
                name: productName,
                price: price,
                color: color,
                size: size,
                image: image,
                quantity: 1
            },
            success: function(response) {
                console.log(response);
                return false;
                    Swal.fire({
                        title: "Success!",
                        text: response.message,
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000
                    });
                    $('#cart-count').text(response.cart_count);
                },
                 error: function(xhr) {
                    Swal.fire({
                        title: "Error!",
                        text: "Something went wrong. Please try again.",
                        icon: "error"
                    });
                }
        });
    });
});

    // ---------------------------------
    // $(document).ready(function() {
    //     // Store selected color details
    //     $(".color-btn").click(function() {
    //         var productId = $(this).data("product-id");
    //         var newImage = $(this).data("image");
    //         var newPrice = $(this).data("price");
    //         var newColor = $(this).data("color");

    //         // Update Image & Price
    //         $("#product-image-" + productId).attr("src", newImage);
    //         $("#product-price-" + productId).text("BDT: " + newPrice);

    //         // Store selected color & price in Add to Cart button
    //         $(".add-to-cart[data-product-id='" + productId + "']").data("price", newPrice);
    //         $(".add-to-cart[data-product-id='" + productId + "']").data("color", newColor);
    //     });

    //     // Add to Cart Function
    //     $(".add-to-cart").click(function() {
    //         var productId = $(this).data("product-id");
    //         var productName = $(this).data("product-name");
    //         var price = $(this).data("price");
    //         var color = $(this).data("color");
    //         var size = $(this).data("size");
    //         var image = $("#product-image-" + productId).attr("src");

    //         if (!color) {
    //             alert("Please select a color first!");
    //             return;
    //         }

    //         $.ajax({
    //             url: "{{ route('cart.add') }}",
    //             method: "POST",
    //             data: {
    //                 _token: "{{ csrf_token() }}",
    //                 product_id: productId,
    //                 name: productName,
    //                 price: price,
    //                 color: color,
    //                 quantity: 1
    //             },
    //             success: function(response) {
    //                 alert(response.message);
    //             }
    //         });
    //     });
    // });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush
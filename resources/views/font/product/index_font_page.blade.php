@extends('font.master.mastering')
@section('title')
@endsection
@section('content')
<div class="row">
    <!-- Left Sidebar (Advertisement) -->
    <div class="col-md-2">
        <div class="menu p-3 bg-light border rounded">
            {{-- <h5>Menu</h5> --}}
            <ul class="list-group">
                {{-- <li class="list-group-item"><a href="#">Home</a></li>
                <li class="list-group-item"><a href="#">Categories</a></li>
                <li class="list-group-item"><a href="#">Offers</a></li>
                <li class="list-group-item"><a href="#">Contact</a></li> --}}
            </ul>
        </div>
    </div>

    <!-- Center Content (Products) -->
    <div class="col-md-8">
        <div class="row justify-content-center">
            @foreach($products as $product)
            
            <div class="col-md-3">
                <div class="product-card p-3 border rounded">
                    <!-- Product Image -->
                    <div class="image-container">
                        <img id="product-image-{{$product->id}}" 
                            src="{{ asset('images/products/'.$product->product_image) }}" 
                            class="zoom-image"
                            alt="Product Image">
                    </div>
                    
                    <div class="product-details mt-3 d-flex flex-column" style="flex-grow: 1;">
                        <h5 class="product-title" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                            {{$product->product_name}}
                        </h5>
                        <p class="product-description" style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                            {{Str::limit($product->product_description, 60, '...')}}
                        </p>
                        
                        <!-- Product Price -->
                        <p class="product-price">
                            <span id="product-price-{{$product->id}}" class="">
                                BDT: {{ $product->product_variation->first()->price ?? 'N/A' }}
                            </span>
                        </p>
                
                        <!-- Add to Cart Button -->
                        <a href="{{url('view-products-details/'.$product->id)}}">
                            <button class="btn btn-add-cart w-100 mt-2 btn-secondary add-to-cart"
                                    data-product-id="{{ $product->id }}"
                                    data-product-name="{{ $product->product_name }}"
                                    data-price="{{ $product->product_variation->first()->price ?? 0 }}"
                                    data-color="">
                                BUY NOW
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="col-md-12 d-flex justify-content-center mt-4">
        <nav>
            <ul class="pagination">
                @if ($products->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">Previous</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $products->previousPageUrl() }}">Previous</a>
                    </li>
                @endif
    
                @if ($products->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $products->nextPageUrl() }}">Next</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">Next</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>

    <!-- Right Sidebar (Advertisement) -->
    <div class="col-md-2">
        <div class="advertisement p-3 bg-light border rounded">
            {{-- <h5>Advertisement</h5>
            <img src="{{ asset('images/ads/ad-banner.jpg') }}" style="width: 100%; height: 200px;" alt="Ad Banner">
            <p class="mt-2">Check out our latest offers!</p> --}}
        </div>
    </div>
</div>
<!-- jQuery for changing product image and price -->
@endsection
@push('link')
<style>
    
    body {
        background-color: #e5e5e5;
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
        height: 200px; /* Set fixed height */
        object-fit: cover; /* Ensure image aspect ratio is maintained */
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
        color: rgb(12, 6, 6);
    }
    .btn-add-cart {
        background: rgb(12, 6, 6);
        color: white;
        font-weight: bold;
        border-radius: 20px;
        padding: 8px 12px;
    }
    .btn-add-cart:hover {
        background: #d84315;
    }
    .btn-buy-now {
        background: rgb(12, 6, 6);
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
    //                 product_name: productName,
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
@push('link')

@endpush
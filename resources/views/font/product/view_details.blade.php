@extends('font.master.mastering')
@push('link')
<style>
    .image-magnifier {
        position: relative;
        overflow: hidden;
        cursor: zoom-in;
    }

    .image-magnifier img {
        transition: transform 0.2s ease-in-out;
    }

    .image-magnifier:hover img {
        transform: scale(2);
    }

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
        color: rgb(12, 6, 6);
    }

    .btn-add-cart, .btn-buy-now {
        background: rgb(12, 6, 6);
        color: white;
        font-weight: bold;
        border-radius: 20px;
        padding: 8px 12px;
    }

    .btn-add-cart:hover {
        background: #074200;
    }

    .btn-buy-now:hover {
        background: #d84315;
    }
</style>
@endpush

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <div class="image-magnifier">
                <img id="product-image-{{$products->id}}" 
                     src="{{ asset('images/products/'.$products->image) }}" 
                     class="img-fluid rounded">
            </div>
        </div>

        <div class="col-md-4">
            <div class="product-details mt-3">
                <h5 class="product-title">{{$products->name}}</h5>
                <div class="product-rating">★★★★☆ (4.5)
                    <br>
                    <strong class="sku">STOCK:</strong> 
                    <span class="skus" id="product-stock-{{$products->id}}">
                        {{ $products->product_variation->first()->stock ?? 'N/A' }}
                    </span>
                    <br>
                    <strong class="skus">SKU:</strong> 
                    <span class="skus" id="product-sku-{{$products->id}}">
                        {{ $products->product_variation->first()->sku ?? 'N/A' }}
                    </span>
                </div>

                <p class="product-price">
                    <span id="product-price-{{$products->id}}">
                        BDT: {{ $products->product_variation->first()->price ?? 'N/A' }}
                    </span>
                </p>

                <!-- Color Buttons (only if stock > 0) -->
                <div class="product-colors d-flex">
                    @foreach ($products->colors as $color)
                        @php
                            $hasStock = $products->product_variants
                                ->where('color_id', $color->id)
                                ->where('stock', '>', 0)
                                ->count() > 0;
                        @endphp

                        @if($hasStock)
                            <button class="color-btn me-2 border rounded-circle px-2 mx-2" 
                                    data-product-id="{{ $products->id }}"
                                    data-image="{{ asset('images/products/variant/'.$color->image) }}"
                                    data-color="{{ $color->id }}"
                                    style="width: 30px; height: 30px; background-color: {{ $color->color_code}}; border: 2px solid #ddd;">
                            </button>
                        @endif
                    @endforeach
                </div>

                <!-- Size Buttons (populated dynamically via JS) -->
                <div class="product-size d-flex mt-3"></div>

                <button class="btn btn-add-cart w-100 mt-2 btn-primary add-to-cart"
                        data-product-id="{{ $products->id }}"
                        data-product-name="{{ $products->name }}"
                        data-price="{{ $products->product_variation->first()->price ?? 0 }}"
                        data-color="">
                    Add to Cart
                </button>

                <a href="{{url('/cart')}}">
                    <button class="btn btn-buy-now w-100 mt-2 btn-success">Buy Now</button>
                </a>

                <br><br>
                <p class="descriptionp">{{$products->description}}</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    var selectedColor = null;
    var selectedSize = null;
    const productUri = "{{url('images/products/variant')}}/";

    async function findData(colorId, sizeId) {
        const variants = @json($products->product_variants);
        return variants.find(v => 
            v.color_id == colorId && 
            v.size_id == sizeId &&
            v.stock > 0
        ) || null;
    }

    $(".color-btn").click(async function() {
        selectedColor = $(this).data("color");
        var productId = $(this).data("product-id");

        const filterVariation = @json($products->product_variants).filter(item => 
            item.color_id == selectedColor && item.stock > 0
        );

        if (filterVariation.length > 0) {
            $("#product-image-" + productId).attr("src", productUri + filterVariation[0]['image']);
        }

        const availableSizes = filterVariation.map(d => d['size_id']);
        const filteredSizes = @json($products->sizes).filter(size =>
            availableSizes.includes(size.id) &&
            @json($products->product_variants).some(variant =>
                variant.color_id == selectedColor &&
                variant.size_id == size.id &&
                variant.stock > 0
            )
        );

        let sizeButtons = "";
        filteredSizes.forEach(data => {
            sizeButtons += `<button class="size-btn me-2 border rounded px-3 py-1 mx-2 btn-outline-info" 
                               data-product-id="${productId}"
                               data-size="${data.id}">
                               ${data.size_name}
                           </button>`;
        });

        $(".product-size").html(sizeButtons);

        const variant = await findData(selectedColor, selectedSize);
        if (variant) {
            $("#product-price-" + productId).text("BDT: " + variant.price);
            $("#product-stock-" + productId).text(variant.stock);
            $("#product-sku-" + productId).text(variant.sku);
        }
    });

    $(document).on("click", ".size-btn", async function() {
        selectedSize = $(this).data("size");
        var productId = $(this).data("product-id");

        const variant = await findData(selectedColor, selectedSize);
        if (variant) {
            $("#product-price-" + productId).text("BDT: " + variant.price);
            $("#product-stock-" + productId).text(variant.stock);
            $("#product-sku-" + productId).text(variant.sku);
        }

        $(".size-btn[data-product-id='" + productId + "']").removeClass("py-2 selected");
        $(this).addClass("py-2 selected");
    });

    $(".add-to-cart").click(function() {
        var productId = $(this).data("product-id");
        var productName = $(this).data("product-name");
        var price = $("#product-price-" + productId).text().replace("BDT: ", "").trim();
        var color = selectedColor;
        var size = selectedSize;
        var image = $("#product-image-" + productId).attr("src");

        if (!color || !size) {
            alert("Please select both color and size before adding to cart!");
            return;
        }

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
                Swal.fire({
                    title: "Added",
                    text: response.message,
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1000
                });
                $('#cart-count').text(response.cart_count);
            }  
        });
    });

    // Optional: Image magnifier
    const imageContainer = document.querySelector(".image-magnifier");
    const image = imageContainer.querySelector("img");

    imageContainer.addEventListener("mousemove", function (e) {
        let rect = imageContainer.getBoundingClientRect();
        let x = (e.clientX - rect.left) / rect.width * 100;
        let y = (e.clientY - rect.top) / rect.height * 100;
        image.style.transformOrigin = `${x}% ${y}%`;
        image.style.transform = "scale(2)";
    });

    imageContainer.addEventListener("mouseleave", function () {
        image.style.transform = "scale(1)";
        image.style.transformOrigin = "center center";
    });
});
</script>
@endpush
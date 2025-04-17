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

    .btn-add-cart {
        background: rgb(12, 6, 6);
        color: white;
        font-weight: bold;
        border-radius: 20px;
        padding: 8px 12px;
    }

    .btn-add-cart:hover {
        background: #074200;
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
@section('content')
<div class="container mt-5">
    <div class="row">
        <!-- Product Images -->
        {{-- <div class="col-md-8">
            <img id="product-image-{{$products->id}}" src="{{ asset('images/products/'.$products->image) }}"
                class="img-fluid rounded">
        </div> --}}
        <div class="col-md-8">
            <div class="image-magnifier">
                <img id="product-image-{{$products->id}}" 
                     src="{{ asset('images/products/'.$products->image) }}" 
                     class="img-fluid rounded">
            </div>
        </div>

        <!-- Product Details -->
        <div class="col-md-4">
            <div class="product-details mt-3">
                <h5 class="product-title">{{$products->name}}</h5>
                <div class="product-rating">★★★★☆ (4.5)
                    <br>
                    <strong class="sku">STOCK:</strong> <span class="skus" id="product-stock-{{$products->id}}">{{
                        $products->product_variation->first()->stock ?? 'N/A' }}</span>
                    <br>
                    <strong class="skus">SKU:</strong> <span class="skus" id="product-sku-{{$products->id}}">{{
                        $products->product_variation->first()->sku ?? 'N/A' }}</span>
                </div>
                <p class="product-price">
                    <span id="product-price-{{$products->id}}">
                        BDT: {{ $products->product_variation->first()->price ?? 'N/A' }}
                    </span>
                </p>

                <!-- Color Buttons -->
                <div class="product-colors d-flex">
                    @foreach ($products->colors as $color)
                    <button class="color-btn me-2 border rounded-circle px-2 mx-2" data-product-id="{{ $products->id }}"
                        data-image="{{ asset('images/products/variant/'.$color->image) }}" {{-- {{--
                        data-price="{{ $color->price }}" --}} data-color="{{ $color->id }}"
                        style="width: 30px; height: 30px; background-color: {{ $color->color_code}}; border: 2px solid #ddd;">
                    </button>
                    @endforeach
                </div>
                <!-- Size Buttons -->
                <div class="product-size d-flex mt-3">
                </div>

                <!-- Buttons -->
                <button class="btn btn-add-cart w-100 mt-2 btn-primary add-to-cart"
                    data-product-id="{{ $products->id }}" data-product-name="{{ $products->name }}"
                    data-price="{{ $products->product_variation->first()->price ?? 0 }}" data-color="">
                    Add to Cart
                </button>
                <a href="{{url('/cart')}}"><button class="btn btn-buy-now w-100 mt-2 btn-success">Buy Now</button><a>
            </div>
            </br>
            <p class="descriptionp">{{$products->description}}</p>

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
        return variants.find(variant => variant.color_id == colorId && variant.size_id == sizeId) || null;
    }

    // Handle Color Selection
    $(".color-btn").click(async function() {
        selectedColor = $(this).data("color");
        var productId = $(this).data("product-id");

        // Get all variations for selected color
        const filterVariation = @json($products->product_variants).filter(item => item.color_id == selectedColor);
        
        if (filterVariation.length > 0) {
            $("#product-image-" + productId).attr("src", productUri + filterVariation[0]['image']);
        }

        // Update Available Sizes
        const availableSizes = filterVariation.map(d => d['size_id']);
        const filteredSizes = @json($products->sizes).filter(size => availableSizes.includes(size.id));

        let sizeButtons = "";
        filteredSizes.forEach(data => {
            sizeButtons += `<button class="size-btn me-2 border rounded px-3 py-1 mx-2 btn-outline-info" 
                               data-product-id="${productId}"
                               data-size="${data.id}">
                               ${data.size_name}
                           </button>`;
        });

        $(".product-size").html(sizeButtons);

        // Update Stock, SKU, and Price if Size is already selected
        const variant = await findData(selectedColor, selectedSize);
        if (variant) {
            $("#product-price-" + productId).text("BDT: " + variant.price);
            $("#product-stock-" + productId).text(variant.stock);
            $("#product-sku-" + productId).text(variant.sku);
        }
    });

    // Handle Size Selection
    $(document).on("click", ".size-btn", async function() {
        selectedSize = $(this).data("size");
        var productId = $(this).data("product-id");

        // Find Variant
        const variant = await findData(selectedColor, selectedSize);
        if (variant) {
            $("#product-price-" + productId).text("BDT: " + variant.price);
            $("#product-stock-" + productId).text(variant.stock);
            $("#product-sku-" + productId).text(variant.sku);
        }

        // Highlight Selected Size
        $(".size-btn[data-product-id='" + productId + "']").removeClass("py-2 selected");
        $(this).addClass("py-2 selected");
    });

    // Add to Cart Function
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

        console.log("Adding to cart:", { productId, productName, price, color, size, image });

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
                updateCartCount(response.cart_count);
                console.log(response);
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

    // CART PAGE FUNCTIONALITY
    updateTotal();

    $(".increment").click(function() {
        let input = $(this).siblings(".quantity");
        input.val(parseInt(input.val()) + 1);
        updateTotal();
    });

    $(".decrement").click(function() {
        let input = $(this).siblings(".quantity");
        let value = parseInt(input.val());
        if (value > 1) {
            input.val(value - 1);
            updateTotal();
        }
    });

    // Remove Item from Cart
    $(".remove-btn").click(function() {
        $(this).closest("tr").remove();
        updateTotal();
    });

    // Update Price Dynamically in Cart
    function updateTotal() {
        let subtotal = 0;
        $("#cart-items tr").each(function() {
            let unitPrice = parseFloat($(this).find(".unit-price").text().replace(/[^\d.]/g, ""));
            let quantity = parseInt($(this).find(".quantity").val());
            let totalPrice = unitPrice * quantity;

            $(this).find(".price").text("BDT: " + totalPrice.toFixed(2));
            subtotal += totalPrice;
        });

        let tax = subtotal * 0.05;
        let shipping = subtotal > 0 ? 100.00 : 0;
        let finalTotal = subtotal + tax + shipping;

        $("#subtotal").text("BDT: " + subtotal.toFixed(2));
        $("#tax").text("BDT: " + tax.toFixed(2));
        $("#shipping").text("BDT: " + shipping.toFixed(2));
        $("#total-price").text("BDT: " + finalTotal.toFixed(2));
    }

    // Checkout Button Click
    $("#checkout-btn").click(function() {
        let cartItems = [];
        $("#cart-items tr").each(function() {
            let id = $(this).data("id");
            let product = $(this).find("td:eq(1)").text();
            let color = $(this).find("td:eq(2)").text();
            let size = $(this).find("td:eq(3)").text();
            let price = parseFloat($(this).find(".price").text().replace(/[^\d.]/g, ""));
            let quantity = parseInt($(this).find(".quantity").val());

            cartItems.push({ id, product, color, size, price, quantity });
        });

        let orderData = {
            cart: cartItems,
            subtotal: parseFloat($("#subtotal").text().replace("BDT: ", "")),
            tax: parseFloat($("#tax").text().replace("BDT: ", "")),
            shipping: parseFloat($("#shipping").text().replace("BDT: ", "")),
            total: parseFloat($("#total-price").text().replace("BDT: ", "")),
            address: $("#shipping-address").val(),
            receiving: $(".Receiving-Time").val(),
            name: $(".customerName").val(),
            email: $(".emailaddress").val(),
            phone: $(".phoneNumber").val(),
            payment: $("#payment-method").val()
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{url('/checkout')}}",
            type: "POST",
            data: JSON.stringify(orderData),
            contentType: "application/json",
            success: function(response) {
                if (response.cart_cleared) {
                    $("#cart-items").empty();
                    $("#subtotal").text("BDT: 0.00");
                    $("#tax").text("BDT: 0.00");
                    $("#shipping").text("BDT: 0.00");
                    $("#total-price").text("BDT: 0.00");

                    localStorage.removeItem("cart");
                    sessionStorage.removeItem("cart");
                }
            },
            error: function(error) {
                console.log(error);
                if (error.status == 401) {
                    window.location.href = "{{ url('login_user')}}";
                }
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endpush
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}" />
    <title>Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .remove-btn {
            cursor: pointer;
            color: red;
        }

        .remove-btn:hover {
            color: darkred;
        }

        .quantity-btn {
            width: 30px;
            height: 30px;
            font-size: 18px;
            text-align: center;
        }
    </style>
</head>

<body>
    {{--
    <div class="container mt-5"> --}}
        <h3 class="mb-4 text-center">🛒 Your Shopping Cart</h3>
        <div class="row">
            <div class="col-md-1">
            </div>

            <!-- Cart Items Section -->
            <div class="col-md-8">
                <div class="card p-3">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>Pictures</th>
                                <th>Product</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody id="cart-items">
                            @php
                            $cart = Session::get('cart', []);
                            @endphp
                            @foreach ($cart as $item)
                            @php
                            $colorName = \App\Models\Color::where('id', $item['color'])->value('color_name');
                            $sizeName = \App\Models\Size::where('id', $item['size'])->value('size_name');
                            $stock = \App\Models\ProductVariant::where([
                            ['product_id', $item['product_id']],
                            ['color_id', $item['color']],
                            ['size_id', $item['size']]
                            ])->value('stock');
                            @endphp

                            <tr data-id="{{ $item['product_id'] }}" data-colorid="{{ $item['color'] }}"
                                data-sizeid="{{ $item['size'] }}" data-stock="{{ $stock }}">
                                <td>
                                    <img src="{{ $item['image'] ?? asset('images/products/variant/default-product.jpg') }}"
                                        alt="{{ $item['name'] }}" width="50">
                                </td>
                                <td>{{ $item['name'] }}<br><span class="unit-price"
                                        data-price="{{ $item['price'] }}">BDT:{{ $item['price'] }}</span></td>
                                <td>{{ $colorName ?? 'N/A' }}</td>
                                <td>{{ $sizeName ?? 'N/A' }}</td>
                                <td class="price">BDT: {{ $item['price'] * $item['quantity'] }}</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-secondary quantity-btn decrement">-</button>
                                    <input type="number" class="quantity text-center" value="{{ $item['quantity'] }}"
                                        min="1" max="{{ $stock }}" style="width:50px;">
                                    <button class="btn btn-sm btn-outline-secondary quantity-btn increment">+</button>
                                </td>
                                <td>
                                    <button class="rounded-pill remove-btn">Cancel</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Order Summary & Address -->
            <div class="col-md-3 row">
                <!-- Address Section -->
                <div class="card p-3 mb-3 information">
                    @if(Auth::check())
                    <p class="form-control customerName px-2">{{ Auth::user()->name }}</p>
                    <p class="form-control emailaddress">{{ Auth::user()->email }}</p>
                    <p class="form-control phoneNumber">{{ Auth::user()->phone }}</p>
                    @else
                    <p class="text-danger">You are not logged in.</p>
                    @endif
                    <h5>📍 Shipping Address</h5>
                    <textarea id="shipping-address" class="form-control" placeholder="Enter your address"></textarea>
                    <input class="form-control Receiving-Time" type="date" placeholder="Receiving Time"></input>
                </div>
                <button type="button" class="btn btn-success informationbutton">Shipping Information</button>

                <!-- Payment Section -->
                <div class="card p-3 mb-3">
                    <h5>💳 Payment Method</h5>
                    <select class="form-control mb-2" id="payment-method">
                        <option value="cash-on-delivery">Cash-On-Delivery</option>
                        <option value="bkash">bKash</option>
                        <option value="nagad">Nagad</option>
                        <option value="rocket">Rocket</option>
                        <option value="Credit-Card">Credit Card</option>
                        <option value="PayPal">PayPal</option>
                        <option value="Google-Pay">Google Pay</option>
                    </select>
                </div>

                <!-- Order Summary -->
                <div class="card p-3">
                    <h5>📦 Order Summary</h5>
                    <p>Subtotal: <b id="subtotal">BDT: 0.00</b></p>
                    <p>Tax (5%): <b id="tax">BDT: 0.00</b></p>
                    <p>Shipping Charge: <b id="shipping">BDT: 100.00</b></p>
                    <hr>
                    <h5>Total: <b id="total-price">BDT: 0.00</b></h5>
                    <button id="checkout-btn" class="btn btn-success w-100 mt-3">Checkout</button>
                </div>
            </div>

        </div>
        {{--
    </div> --}}

    <script>
        $(document).ready(function() {
    var shipinformation = $('.information');
    shipinformation.hide();

    $(".informationbutton").click(function() {
        shipinformation.toggle();
    });

    updateTotal();

    // Quantity Increase / Decrease
    $(".increment").click(function () {
    let row = $(this).closest("tr");
    let input = row.find(".quantity");
    let currentQty = parseInt(input.val());
    let maxStock = parseInt(row.data("stock"));

    if (currentQty < maxStock) {
        input.val(currentQty + 1);
        updateRowPrice($(this));
        updateTotal();
    } else {
        Swal.fire({
            icon: 'warning',
            title: 'Stock Limit Reached',
            text: `Only ${maxStock} available in stock.`,
            timer: 1500,
            showConfirmButton: false
        });
    }
});

// Quantity Decrease
$(".decrement").click(function () {
    let input = $(this).siblings(".quantity");
    let value = parseInt(input.val());
    if (value > 1) {
        input.val(value - 1);
        updateRowPrice($(this));
        updateTotal();
    }
});

// Quantity Input Manual Validation
$(".quantity").on("input", function () {
    let row = $(this).closest("tr");
    let maxStock = parseInt(row.data("stock"));
    let input = $(this);
    let value = parseInt(input.val());

    if (value > maxStock) {
        Swal.fire({
            icon: 'warning',
            title: 'Stock Limit Exceeded',
            text: `Only ${maxStock} in stock.`,
            timer: 1500,
            showConfirmButton: false
        });
        input.val(maxStock);
    } else if (value < 1 || isNaN(value)) {
        input.val(1);
    }

    updateRowPrice(input);
    updateTotal();
});

    // Remove Item
    $(".remove-btn").click(function() {
        $(this).closest("tr").remove();
        // item remove from cart
        let id = $(this).closest("tr").data("id");
        let colorid = $(this).closest("tr").data("colorid");
        let sizeid = $(this).closest("tr").data("sizeid");
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
        $.ajax({
            url: "{{url('/remove-cart')}}",
            type: "POST",
            data: {
                id: id,
                colorid: colorid,
                sizeid: sizeid
            },
            success: function(response) {
                alert(response.message);
            },
            error: function(error) {
                console.log(error);
            }
        });
        updateTotal();
    });

    // Update Total Price
    function updateTotal() {
        let subtotal = 0;

        $("#cart-items tr").each(function() {
            let rowPriceText = $(this).find(".price").text();
            let rowPrice = parseFloat(rowPriceText.replace(/[^\d.]/g, "")); // Extract price number
            subtotal += rowPrice;
        });

        let tax = subtotal * 0.05; // 5% tax
        let shipping = subtotal > 0 ? 100.00 : 0; // Shipping charge only if cart has items
        let finalTotal = subtotal + tax + shipping;

        $("#subtotal").text(`BDT: ${subtotal.toFixed(2)}`);
        $("#tax").text(`BDT: ${tax.toFixed(2)}`);
        $("#shipping").text(`BDT: ${shipping.toFixed(2)}`);
        $("#total-price").text(`BDT: ${finalTotal.toFixed(2)}`);
    }

    // Update Individual Row Price
    function updateRowPrice(element) {
        let row = element.closest("tr");
        let quantity = parseInt(row.find(".quantity").val());
        let unitPrice = parseFloat(row.find(".unit-price").data("price")); // Fetch base price
        let totalPrice = unitPrice * quantity;

        row.find(".price").text(`BDT: ${totalPrice.toFixed(2)}`);
    }

    // Checkout Button Click
    $("#checkout-btn").click(function() {
        let cartItems = [];

        $("#cart-items tr").each(function() {
            let id = $(this).data("id");
            let cID = $(this).data("colorid");
            let sID = $(this).data("sizeid");
            let quantity = parseInt($(this).find(".quantity").val());

            cartItems.push({
                product_id: id,
                color: cID,
                size: sID,
                quantity: quantity
            });
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
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        $.ajax({
            url: "{{url('/checkout')}}",
            type: "POST",
            data: JSON.stringify(orderData),
            contentType: "application/json",
            success: function(response) {
                console.log(response);
                return false;
                if (response.cart_cleared) {
                    $("#cart-items").empty(); 
                    $("#subtotal").text("BDT: 0.00");
                    $("#tax").text("BDT: 0.00");
                    $("#shipping").text("BDT: 0.00");
                    $("#total-price").text("BDT: 0.00");

                    localStorage.removeItem("cart");
                    sessionStorage.removeItem("cart");
                    Swal.fire({
                        title: "Order Has been Successfully",
                        text: response.message,
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1000
                    });
                }
            },
            error: function(error) {
                console.log(error);
                if (error.status == 401) {
                    window.location.href = "{{ url('login_user') }}";
                }
            }
        });
    });
});
    </script>

</body>

</html>


{{-- {
"product_id": "2",
"name": "Galena Pacheco",
"price": "300",
"color": "gray",
"quantity": "1",
"image": "http:\/\/localhost\/AFLATUN\/public\/images\/products\/variant\/2025-03-2067dc397a9e16b1742485882.png",
"size": "XL"
} --}}
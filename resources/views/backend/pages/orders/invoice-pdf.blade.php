<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; background: #0c0606; color: #fff; font-size: 13px; position: relative; }
        
        /* Watermark Text */
        .watermark-text {
            position: absolute;
            top: 40%;
            left: 20%;
            font-size: 80px;
            color: #ffa332;
            opacity: 0.05;
            transform: rotate(-30deg);
            z-index: -1;
            white-space: nowrap;
        }

        /* Seal Image */
        .seal {
            position: absolute;
            bottom: 100px;
            right: 40px;
            width: 200px;
            height: 200px;
            opacity: 0.2;
        }

        .invoice-card { padding: 40px; background: linear-gradient(45deg, #0c0606, #1d0e0e); position: relative; }
        .invoice-title { font-size: 28px; color: #ffa332; font-weight: bold; text-align: center; margin-bottom: 30px; }
        .section-title { font-weight: bold; font-size: 18px; color: #ffa332; margin-bottom: 10px; }
        .invoice-table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        .invoice-table th, .invoice-table td { border: 1px solid #ffa332; padding: 8px; }
        .invoice-table th { background: #140a0a; color: #ffa332; text-transform: uppercase; }
        .note-text { font-style: italic; color: #ffa332; margin-top: 20px; }
        .total-amount { font-size: 22px; font-weight: bold; color: #ffa332; }
        .row { display: flex; justify-content: space-between; }
        .col-6 { width: 48%; }
        .text-end { text-align: right; }
    </style>
</head>
<body>

    <!-- Watermark Text -->
    <div class="watermark-text">AFLATUN</div>

    <!-- Seal Image -->
    <img src="{{ asset('backend/logo/seal.png') }}" class="seal" alt="Official Seal">

    <div class="invoice-card ">
        <h2 class="invoice-title">Invoice #{{ $order->id }}</h2>

        <div class="row p-2">
            <div class="col-2">
                <h4 class="section-title">Billing Information</h4>
                @if($order->client)
                    <p><strong>Name:</strong> {{ $order->client->first_name }} {{ $order->client->last_name }}</p>
                    <p><strong>Phone:</strong> {{ $order->user->phone ?? '-' }}</p>
                    <p><strong>Email:</strong> {{ $order->client->email }}</p>
                    <p><strong>Address:</strong> {{ $order->client->address }}</p>
                @elseif($order->user)
                    <p><strong>Name:</strong> {{ $order->user->name }}</p>
                    <p><strong>Phone:</strong> {{ $order->user->phone ?? '-' }}</p>
                    <p><strong>Email:</strong> {{ $order->user->email }}</p>
                @else
                    <p>No billing information found.</p>
                @endif
            </div>

            <div class="col-2 text-end">
                <h4 class="section-title">Order Details</h4>
                <p><strong>Order ID:</strong> {{ $order->id }}</p>
                <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
                <p><strong>Order Date:</strong> {{ $order->created_at->format('d M, Y') }}</p>
                @if($order->receiving_time)
                <p><strong>Receiving Time:</strong> {{ $order->receiving_time }}</p>
                @endif
            </div>
        </div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->product->name ?? 'N/A' }}</td>
                    <td>{{ $item->color->color_name ?? '-' }}</td>
                    <td>{{ $item->size->size_name ?? 'N/A' }}</td>
                    <td>${{ number_format($item->unit_price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->total_price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row" style="margin-top: 20px;">
            <div class="col-4">
                <p class="note-text"><strong>Note:</strong> Thank you for your order!</p>
            </div>
            <div class="col-6 text-end">
                <h4 class="section-title">Order Summary</h4>
                <p><strong>Subtotal:</strong> ${{ number_format($order->subtotal, 2) }}</p>
                <p><strong>Shipping:</strong> ${{ number_format($order->shipping_charge, 2) }}</p>
                <p><strong>Tax:</strong> ${{ number_format($order->tax, 2) }}</p>
                <h3 class="total-amount"><strong>Total:</strong> ${{ number_format($order->total, 2) }}</h3>
            </div>
        </div>
    </div>

</body>
</html>
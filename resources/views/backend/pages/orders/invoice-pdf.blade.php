<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #fff;
            background-color: #0c0606;
            position: relative;
        }

        .container {
            padding: 30px;
        }

        .invoice-header {
            background: linear-gradient(45deg, #331a1a, #321919);
            padding: 20px;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        .invoice-title {
            font-size: 26px;
            font-weight: bold;
            color: #ffa332;
        }

        .section-title {
            color: #ffa332;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #0c0606;
            margin-top: 20px;
        }

        .invoice-table th {
            background: #140a0a;
            color: #ffa332;
            padding: 8px;
            text-transform: uppercase;
            font-size: 12px;
        }

        .invoice-table td {
            padding: 8px;
            border-bottom: 1px solid #ffa332;
            color: #fff;
            font-size: 12px;
        }

        .note-text {
            font-style: italic;
            color: #ffa332;
            margin-top: 20px;
        }

        .total-amount {
            font-size: 20px;
            font-weight: bold;
            color: #ffa332;
        }

        .text-end {
            text-align: right;
        }

        .watermark {
            position: absolute;
            font-size: 4rem;
            font-weight: bold;
            color: rgba(255, 163, 50, 0.05);
            transform: rotate(-30deg);
        }

        .watermark.center { top: 40%; left: 25%; }
        .watermark.tl { top: 5%; left: 5%; }
        .watermark.tr { top: 5%; right: 5%; }
        .watermark.bl { bottom: 5%; left: 5%; }
        .watermark.br { bottom: 5%; right: 5%; }

    </style>
</head>
<body>
    <!-- Watermarks -->
    <div class="watermark center">Afaltun</div>
    <div class="watermark tl">Afaltun</div>
    <div class="watermark tr">Afaltun</div>
    <div class="watermark bl">Afaltun</div>
    <div class="watermark br">Afaltun</div>

    <div class="container">
        <div class="invoice-header">
            <h2 class="invoice-title">Invoice #{{ $order->id }}</h2>
        </div>

        <div class="row" style="display: flex; justify-content: space-between;">
            <div style="width: 48%;">
                <h4 class="section-title">Billing Information</h4>
                <p><strong>Name:</strong> {{ $order->name }}</p>
                <p><strong>Phone:</strong> {{ $order->phone }}</p>
                <p><strong>Email:</strong> {{ $order->email }}</p>
                <p><strong>Address:</strong> {{ $order->address }}</p>
            </div>
            <div style="width: 48%; text-align: right;">
                <h4 class="section-title">Order Details</h4>
                <p><strong>Order ID:</strong> {{ $order->id }}</p>
                <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
                <p><strong>Receiving Time:</strong> {{ $order->receiving_time }}</p>
                <p><strong>Date:</strong> {{ $order->created_at->format('d M, Y') }}</p>
            </div>
        </div>

        <!-- Product Table -->
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Color</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderItems as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->color }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals -->
        <div class="row" style="margin-top: 30px; display: flex; justify-content: space-between;">
            <div style="width: 48%;">
                <p class="note-text"><strong>Note:</strong> Thank you for your order! If you have any questions, please contact us.</p>
            </div>
            <div style="width: 48%;" class="text-end">
                <h4 class="section-title">Order Summary</h4>
                <p><strong>Subtotal:</strong> ${{ number_format($order->subtotal, 2) }}</p>
                <p><strong>Shipping Charge:</strong> ${{ number_format($order->shipping_charge, 2) }}</p>
                <p><strong>Tax:</strong> ${{ number_format($order->tax, 2) }}</p>
                <p class="total-amount"><strong>Total:</strong> ${{ number_format($order->total, 2) }}</p>
            </div>
        </div>
    </div>
</body>
</html>
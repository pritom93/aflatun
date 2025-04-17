@extends('backend.master.masterback')
@section('title')
Invoice #{{ $order->id }}
@endsection

@section('content')
<div class="container mt-4">
    <div class="invoice-card shadow-lg border-0 position-relative">
        <!-- Background Image -->
        <div class="invoice-background"></div>

        <div class="card-header text-white text-center">
            <h2 class="invoice-title"><i class="fas fa-file-invoice"></i> Invoice #{{ $order->id }}</h2>
        </div>
        
        <div class="card-body p-5">
            <div class="row">
                <!-- Customer Details -->
                <div class="col-md-6">
                    <h4 class="section-title">Billing Information</h4>
                    <p><strong>Name:</strong> {{ $order->name }}</p>
                    <p><strong>Phone:</strong> {{ $order->phone }}</p>
                    <p><strong>Email:</strong> {{ $order->email }}</p>
                    <p><strong>Address:</strong> {{ $order->address }}</p>
                </div>
                <!-- Order Details -->
                <div class="col-md-6 text-md-end">
                    <h4 class="section-title">Order Details</h4>
                    <p><strong>Order ID:</strong> {{ $order->id }}</p>
                    <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
                    <p><strong>Receiving Time:</strong> {{ $order->receiving_time }}</p>
                    <p><strong>Date:</strong> {{ $order->created_at->format('d M, Y') }}</p>
                </div>
            </div>

            <!-- Product Table -->
            <div class="table-responsive mt-4">
                <table class="table invoice-table text-center">
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
            </div>

            <!-- Totals -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <p class="note-text"><strong>Note:</strong> Thank you for your order! If you have any questions, please contact us.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h4 class="section-title">Order Summary</h4>
                    <p><strong>Subtotal:</strong> ${{ number_format($order->subtotal, 2) }}</p>
                    <p><strong>Shipping Charge:</strong> ${{ number_format($order->shipping_charge, 2) }}</p>
                    <p><strong>Tax:</strong> ${{ number_format($order->tax, 2) }}</p>
                    <h3 class="total-amount"><strong>Total:</strong> ${{ number_format($order->total, 2) }}</h3>
                </div>
            </div>

            <!-- Print & Download Buttons -->
            <div class="text-center mt-4">
                <button class="btn custom-btn print-btn" onclick="window.print()">
                    <i class="fas fa-print"></i> Print Invoice
                </button>
                <a href="{{ route('invoice.download', $order->id) }}" class="btn custom-btn download-btn">
                    <i class="fas fa-file-download"></i> Download PDF
                </a>
                {{-- <a href="{{ route('invoice.download', $order->id) }}" class="btn custom-btn download-btn">
                    <i class="fas fa-file-download"></i> Order Accepted
                </a> --}}
            </div>
        </div>
    </div>
</div>
@endsection

@push('style')
<style>
    /* Background Image */
    .invoice-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('/images/invoice-bg.jpg'); /* Change to your image path */
        background-size: cover;
        background-position: center;
        opacity: 0.1;
        z-index: -1;
    }

    /* Card Styling */
    .invoice-card {
        background: linear-gradient(45deg, rgb(12, 6, 6), rgb(29, 14, 14));
        border-radius: 10px;
        overflow: hidden;
        position: relative;
    }

    .card-header {
        background: linear-gradient(45deg, rgb(51, 26, 26), rgb(50, 25, 25));
        padding: 20px;
    }

    .invoice-title {
        font-size: 28px;
        font-weight: bold;
        letter-spacing: 1px;
    }

    /* Table Styling */
    .invoice-table {
        width: 100%;
        border-collapse: collapse;
        background: rgb(12, 6, 6);
        color: rgb(12, 6, 6);
        text-align: center;
        border-radius: 10px;
        overflow: hidden;
    }
    .invoice-table th {
        background: rgb(20, 10, 10);
        padding: 12px;
        text-transform: uppercase;
    }
    .invoice-table td {
        padding: 10px;
        border-bottom: 1px solid rgb(255, 163, 50);
    }

    /* Section Titles */
    .section-title {
        font-weight: bold;
        font-size: 18px;
        color: rgb(255, 163, 50);
    }

    /* Total Amount */
    .total-amount {
        font-size: 24px;
        font-weight: bold;
        color: rgb(255, 163, 50);
    }

    /* Note Text */
    .note-text {
        font-style: italic;
        color: rgb(255, 163, 50);
    }

    /* Custom Buttons */
    .custom-btn {
        background: white;
        color: rgb(12, 6, 6);
        border: 2px solid rgb(12, 6, 6);
        padding: 10px 20px;
        font-weight: bold;
        border-radius: 5px;
        transition: all 0.3s;
    }
    .custom-btn:hover {
        background: rgb(12, 6, 6);
        color: white;
    }
    .print-btn {
        margin-right: 10px;
    }
    .text-md-end {
        text-align: right;
    }

</style>
@endpush
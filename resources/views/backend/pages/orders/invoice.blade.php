@extends('backend.master.masterback')

@section('title')
Invoice #{{ $order->id }}
@endsection

@section('content')
<div class="container mt-4">
    <div class="invoice-card shadow-lg border-0 position-relative">
        <!-- Background -->
        <div class="invoice-background"></div>

        <div class="card-header text-white text-center">
            <h2 class="invoice-title"><i class="fas fa-file-invoice"></i> Invoice #{{ $order->id }}</h2>
        </div>

        <div class="card-body p-5">
            <div class="row">
                <!-- Billing Info -->
                <div class="col-md-6">
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

                <!-- Order Info -->
                <div class="col-md-6 text-md-end">
                    <h4 class="section-title">Order Details</h4>
                    <p><strong>Order ID:</strong> {{ $order->id }}</p>
                    <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
                    <p><strong>Order Date:</strong> {{ $order->created_at->format('d M, Y') }}</p>
                    @if($order->receiving_time)
                    <p><strong>Receiving Time:</strong> {{ $order->receiving_time }}</p>
                    @endif
                </div>
            </div>

            <!-- Products Table -->
            <div class="table-responsive mt-4">
                <table class="table invoice-table text-center">
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
            </div>

            <!-- Totals -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <p class="note-text"><strong>Note:</strong> Thank you for your order!</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h4 class="section-title">Order Summary</h4>
                    <p><strong>Subtotal:</strong> ${{ number_format($order->subtotal, 2) }}</p>
                    <p><strong>Shipping:</strong> ${{ number_format($order->shipping_charge, 2) }}</p>
                    <p><strong>Tax:</strong> ${{ number_format($order->tax, 2) }}</p>
                    <h3 class="total-amount"><strong>Total:</strong> ${{ number_format($order->total, 2) }}</h3>
                </div>
            </div>

            <!-- Buttons -->
            <div class="text-center mt-4">
                <button class="btn custom-btn print-btn" onclick="window.print()">
                    <i class="fas fa-print"></i> Print Invoice
                </button>
                <a href="{{ route('invoice.download', $order->id) }}" class="btn custom-btn download-btn">
                    <i class="fas fa-file-download"></i> Download PDF
                </a>
            </div>

        </div>
    </div>
</div>
@endsection

@push('style')
<style>
/* Background Image */
.invoice-background { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url('/images/invoice-bg.jpg'); background-size: cover; background-position: center; opacity: 0.08; z-index: -1; }
/* Card Styling */
.invoice-card { background: linear-gradient(45deg, #0c0606, #1d0e0e); border-radius: 10px; overflow: hidden; position: relative; }
.card-header { background: linear-gradient(45deg, #331a1a, #321919); padding: 20px; }
.invoice-title { font-size: 28px; font-weight: bold; letter-spacing: 1px; }
.invoice-table { width: 100%; background: #0c0606; color: #fff; text-align: center; }
.invoice-table th { background: #140a0a; padding: 12px; text-transform: uppercase; }
.invoice-table td { padding: 10px; border-bottom: 1px solid #ffa332; }
.section-title { font-weight: bold; font-size: 18px; color: #ffa332; }
.total-amount { font-size: 24px; font-weight: bold; color: #ffa332; }
.note-text { font-style: italic; color: #ffa332; }
.custom-btn { background: white; color: #0c0606; border: 2px solid #0c0606; padding: 10px 20px; font-weight: bold; border-radius: 5px; transition: all 0.3s; }
.custom-btn:hover { background: #0c0606; color: white; }
.print-btn { margin-right: 10px; }
.text-md-end { text-align: right; }

@media print {
    /* Hide elements that you don't want to print */
    .invoice-background, .custom-btn, .card-header {
        display: none;
    }

    /* Adjust font size and padding */
    body {
        font-size: 14px;
    }

    .invoice-title {
        font-size: 22px;
    }

    .invoice-table th, .invoice-table td {
        font-size: 12px;
        padding: 8px;
        border: 1px solid #ffa332;
    }

    /* Fix background color for table header and cells */
    .invoice-table th {
        background: #140a0a !important; /* Set header background to dark color */
        color: #ffa332 !important; /* Set text color for headers to gold */
    }

    .invoice-table td {
        background: #0c0606 !important; /* Ensure dark background for table cells */
        color: #fff !important; /* White text for table cells */
    }

    .total-amount {
        font-size: 18px;
    }

    /* Ensure the print version of the invoice is full-width */
    .invoice-card {
        width: 100%;
        margin: 0;
        padding: 0;
    }

    /* Hide buttons during printing */
    .print-btn, .download-btn {
        display: none;
    }
}
@media print {
    body {
        -webkit-print-color-adjust: exact; /* Ensure background colors are printed */
        color-adjust: exact;
    }
}
</style>
@endpush

@extends('backend.master.masterback')
@section('title')
Order View
@endsection

@section('content')
<div class="card shadow-lg">
    <div class="card-header bg-dark text-white text-center">
        <h4><i class="fas fa-shopping-cart"></i> Current Orders</h4>
    </div>
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table custom-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Payment</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $order)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ ucfirst($order->payment_method) }}</td>
                        <td>${{ number_format($order->total, 2) }}</td>
                        <td>
                            <a href="{{ route('invoice.show', $order->id) }}" class="btn custom-btn">
                                <i class="fas fa-file-invoice"></i> Invoice
                            </a>
                            <button class="btn custom-btn delete-btn" data-id="{{ $order->id }}">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('style')
<style>
    /* Table Styling */
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        background: rgb(53, 51, 51);
        color: white;
        text-align: center;
        border-radius: 10px;
        overflow: hidden;
    }
    .custom-table th {
        background: rgb(20, 10, 10);
        padding: 12px;
        text-transform: uppercase;
    }
    .custom-table td {
        padding: 10px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Hover Effect */
    .custom-table tbody tr {
        transition: transform 0.3s, background 0.3s;
    }
    .custom-table tbody tr:hover {
        transform: scale(1.009);
        background: rgb(39, 35, 35);
    }

    /* Custom Buttons */
    .custom-btn {
        background: #2c2a2a;
        color: rgb(185 169 169);
        border: 2px solid rgb(40 37 37);
        padding: 5px 12px;
        font-weight: bold;
        border-radius: 5px;
        transition: all 0.3s;
    }
    .custom-btn:hover {
        background: rgb(30, 22, 22);
        color: white;
    }

    /* Delete Button */
    .delete-btn {
        margin-left: 5px;
    }
</style>
@endpush

@push('backend_script')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        console.log("Order Page Loaded!");

        // Delete Order Event
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                let orderId = this.getAttribute('data-id');
                if (confirm("Are you sure you want to delete this order?")) {
                    // Implement AJAX or redirect to delete route
                    console.log("Deleting order:", orderId);
                }
            });
        });
    });
</script>
@endpush
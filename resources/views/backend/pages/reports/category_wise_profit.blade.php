@extends('backend.master.masterback')

@section('title')
Category Wise Profit
@endsection

@push('link')
<link href="{{ asset('backend/plugins/file-upload/file-upload-with-preview.min.css') }}" rel="stylesheet" type="text/css" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center py-3">
        <h2>Category Wise Profit Report</h2>
        <input type="text" id="searchInput" class="form-control w-25" placeholder="Search Categories...">
    </div>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="profitTable">
            <thead class="table-dark">
                <tr style="background: #161200;">
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Sold Quantity</th>
                    <th>Total Revenue</th>
                    <th>Total Cost</th>
                    <th>Profit / Loss</th>
                    <th>Status</th>
                    <th>Action</th> <!-- New Column -->
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $key => $category)
                    @php
                        $soldQuantity = 0;
                        $totalRevenue = 0;
                        $totalCost = 0;

                        foreach ($category->products as $product) {
                            foreach ($product->product_variation as $vr) {
                            $quantity = $product->orderItems->sum('quantity');
                            $soldQuantity += $quantity;
                            $totalRevenue += $quantity * $product->price;
                            $totalCost += $quantity * $vr->cost_price;
                            }
                        }

                        $profitLoss = $totalRevenue - $totalCost;
                    @endphp
                    <tr style="background: #564600;">
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td>{{ $soldQuantity }}</td>
                        <td>${{ number_format($totalRevenue, 2) }}</td>
                        <td>${{ number_format($totalCost, 2) }}</td>
                        <td>${{ number_format($profitLoss, 2) }}</td>
                        <td>
                            @if ($profitLoss >= 0)
                                <span class="badge bg-success">Profit</span>
                            @else
                                <span class="badge bg-danger">Loss</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#orderDetailsModal{{ $category->id }}">
                                View Orders
                            </button>
                        </td>
                    </tr>

                    <!-- Modal for each category -->
                    <div class="modal fade" id="orderDetailsModal{{ $category->id }}" tabindex="-1" aria-labelledby="orderDetailsModalLabel{{ $category->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="orderDetailsModalLabel{{ $category->id }}">Order Details for {{ $category->category_name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @forelse($category->products as $product)
                                        @foreach($product->orderItems as $orderItem)
                                            @php
                                                $client = $orderItem->order->client ?? null;
                                            @endphp
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $product->name ?? 'Product' }}</h5>
                                                    <p class="card-text">
                                                        <strong>Client Name:</strong> {{ $client->first_name.$client->last_name ?? 'N/A' }}<br>
                                                        
                                                        <strong>Address:</strong> {{ $client->address ?? 'N/A' }}<br>
                                                        <strong>Email:</strong> {{ $client->email ?? 'N/A' }}<br>
                                                        <hr>
                                                        <strong>Order ID:</strong> {{ $orderItem->order->id ?? 'N/A' }}<br>
                                                        <strong>Order Date:</strong> {{ $orderItem->order->created_at->format('d M Y') ?? 'N/A' }}<br>
                                                        <strong>Quantity Sold:</strong> {{ $orderItem->quantity }}<br>
                                                        <strong>Price per Unit:</strong> ${{ number_format($product->price, 2) }}
                                                    </p>
                                                </div>
                                            </div>
                                            @endforeach
                                            <button class="btn btn-primary" onclick="window.location.href='{{ route('generate-pdf', $category->id) }}'">Download PDF</button>
                                    @empty
                                        <p>No Orders Found for this category.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                 
                @endforeach
            </tbody>

            <tfoot  class="table-secondary">
                <tr style="    background: #1a1500;color: white;">
                    <th colspan="2" class="text-end">Total:</th>
                    <th>
                        {{ $categories->sum(function($category) {
                            return $category->products->sum(function($product) {
                                return $product->orderItems->sum('quantity');
                            });
                        }) }}
                    </th>
                    <th>
                        ${{ number_format($categories->sum(function($category) {
                            return $category->products->sum(function($product) {
                                return $product->orderItems->sum('quantity') * $product->price;
                            });
                        }), 2) }}
                    </th>
                    <th>
                        ${{ number_format($categories->sum(function($category) {
                            return $category->products->sum(function($product) {
                                return $product->orderItems->sum('quantity') * $product->cost_price;
                            });
                        }), 2) }}
                    </th>
                    <th>
                        ${{ number_format($categories->sum(function($category) {
                            $totalRev = $category->products->sum(function($product) {
                                return $product->orderItems->sum('quantity') * $product->price;
                            });
                            $totalCost = $category->products->sum(function($product) {
                                return $product->orderItems->sum('quantity') * $product->cost_price;
                            });
                            return $totalRev - $totalCost;
                        }), 2) }}
                    </th>
                    <th colspan="2"></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<script>
// Search functionality
document.getElementById('searchInput').addEventListener('keyup', function() {
    var value = this.value.toLowerCase();
    var rows = document.querySelectorAll("#profitTable tbody tr");

    rows.forEach(function(row) {
        row.style.display = row.innerText.toLowerCase().includes(value) ? "" : "none";
    });
});
</script>
@endsection
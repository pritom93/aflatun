<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Wise Profit Report</title>
</head>
<body>
    <h1>Category Wise Profit Report for {{ $category->category_name }}</h1>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity Sold</th>
                <th>Revenue</th>
                <th>Cost</th>
                <th>Profit / Loss</th>
            </tr>
        </thead>
        <tbody>
            @foreach($category->products as $product)
            @foreach($product->product_variation as $vr)
                @php
                    $quantity = $product->orderItems->sum('quantity');
                    $revenue = $quantity * $product->price;
                    $cost = $quantity * $vr->cost_price;
                    $profitLoss = $revenue - $cost;
                @endphp
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $quantity }}</td>
                    <td>${{ number_format($revenue, 2) }}</td>
                    <td>${{ number_format($cost, 2) }}</td>
                    <td>${{ number_format($profitLoss, 2) }}</td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
    <h3>Total Revenue: ${{ number_format($category->products->sum(function($product) {
        return $product->orderItems->sum('quantity') * $product->price;
    }), 2) }}</h3>
    <h3>Total Cost: ${{ number_format($category->products->sum(function($product) {
        return $product->orderItems->sum('quantity') * ;
    }), 2) }}</h3>
    <h3>Total Profit / Loss: ${{ number_format($category->products->sum(function($product) {
        $revenue = $product->orderItems->sum('quantity') * $product->price;
        $cost = $product->orderItems->sum('quantity') * $product->cost_price;
        return $revenue - $cost;
    }), 2) }}</h3>
</body>
</html>
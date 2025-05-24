@extends('backend.master.masterback')

@section('title')
Category-wise Sells Report
@endsection

@section('content')
<div class="row layout-top-spacing">
    <div class="col-12">
        <div class="card shadow-lg border-0 rounded-4 animate__animated animate__fadeIn">
            <div class="card-header bg-gradient-info text-white d-flex justify-content-between align-items-center rounded-top-4">
                <h4 class="mb-0">🗂️ Category-wise Sells Report</h4>
                <button class="btn btn-light btn-sm shadow-sm" onclick="window.print()">
                    <i class="bi bi-printer"></i> Print
                </button>
            </div>

            <div class="card-body p-4">
                <!-- Filter Form -->
                <form class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label">Start Date</label>
                        <input type="date" class="form-control shadow-sm" name="start_date">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">End Date</label>
                        <input type="date" class="form-control shadow-sm" name="end_date">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-info w-100 shadow">
                            <i class="bi bi-funnel-fill"></i> Filter
                        </button>
                    </div>
                </form>

                <!-- Table -->
                <div class="table-responsive animate__animated animate__fadeInUp mb-5">
                    <table class="table table-bordered table-striped shadow-sm text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Category</th>
                                <th>Total Orders</th>
                                <th>Total Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will come from AJAX -->
                        </tbody>
                    </table>
                </div>

                <!-- Chart -->
                <div class="card shadow-sm p-4">
                    <canvas id="categoryChart" height="120"></canvas>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@push('backend_script')
<script>
document.addEventListener('DOMContentLoaded', function () {

    let categoryChart;
    const ctx = document.getElementById('categoryChart').getContext('2d');

    function loadCategoryReport(start_date = '', end_date = '') {
        $.ajax({
            url: "{{ url('admins/category-sell') }}",
            type: "GET",
            data: {
                start_date: start_date,
                end_date: end_date
            },
            success: function (response) {
                console.log(response);

                // Table Data Append
                var tbody = "";
                response.forEach(function (item, index) {
                    tbody += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.cat_name}</td>
                            <td>${item.sale_quantity}</td>
                            <td>$${parseFloat(item.total_sale).toFixed(2)}</td>
                        </tr>
                    `;
                });
                $('table tbody').html(tbody);

                // Chart Data Update
                var labels = response.map(item => item.cat_name);
                var data = response.map(item => item.sale_quantity);
                var backgroundColors = ['#0d6efd', '#d63384', '#ffc107', '#198754', '#6610f2', '#dc3545'];

                if (categoryChart) {
                    categoryChart.destroy();
                }

                categoryChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Total Orders',
                            data: data,
                            backgroundColor: backgroundColors,
                            borderRadius: 8
                        }]
                    },
                    options: {
                        plugins: {
                            title: {
                                display: true,
                                text: 'Category-wise Orders',
                                font: { size: 18 }
                            }
                        },
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { stepSize: 1 }
                            }
                        }
                    }
                });
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    // Initial load
    loadCategoryReport();

    // Filter Form submit
    $('form').on('submit', function (e) {
        e.preventDefault();
        var start_date = $('input[name="start_date"]').val();
        var end_date = $('input[name="end_date"]').val();
        loadCategoryReport(start_date, end_date);
    });

});
</script>
@endpush

@endsection
@extends('backend.master.masterback')

@section('title')
Sells Report
@endsection

@section('content')
<div class="row layout-top-spacing">
    <div class="col-12">
        <div class="card shadow-lg border-0 rounded-4 animate__animated animate__fadeIn">
            <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center rounded-top-4">
                <h4 class="mb-0">📊 Sells Report Overview</h4>
                <button class="btn btn-light btn-sm shadow-sm" onclick="window.print()">
                    <i class="bi bi-printer"></i> Print Report
                </button>
            </div>
            <div class="card-body p-4">
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
                        <button type="submit" class="btn btn-primary w-100 shadow">
                            <i class="bi bi-funnel-fill"></i> Filter
                        </button>
                    </div>
                </form>

                <div class="table-responsive animate__animated animate__fadeInUp">
                    <table class="table table-hover table-striped table-bordered shadow-sm">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>#</th>
                                <th>Invoice ID</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Example row -->
                            <tr class="text-center">
                                <td>1</td>
                                <td>Male</td>
                                <td>John Doe</td>
                                <td>2025-04-24</td>
                                <td>$1,200.00</td>
                                <td><span class="badge bg-success">Completed</span></td>
                                <td>
                                    <button class="btn btn-info btn-sm">Customize<i class="bi bi-eye"></i></button>
                                    <button class="btn btn-danger btn-sm">Invoice<i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                            <!-- Repeat rows dynamically -->
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <nav>
                        <ul class="pagination pagination-sm">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('backend_script')
    <script>
 document.addEventListener("DOMContentLoaded", function () {
    function loadSalesDataReport(start_date = '', end_date = '') {
        $.ajax({
            url: "{{ url('admin/call-to-order') }}",
            type: "GET",
            dataType: "json",
            data: {
                start_date: start_date,
                end_date: end_date
            },
            success: function (response) {
                console.log(response);

                var tbody = "";
                response.forEach(function (report, index) {
                    tbody += `
                        <tr class="text-center">
                            <td>${index + 1}</td>
                            <td>${report.id}</td>
                            <td>${report.name} <br> ${report.phone}</td>
                            <td>${report.created_at.split('T')[0]}</td>
                            <td>$${parseFloat(report.total).toFixed(2)}</td>
                            <td>
                                ${report.order_status == '1' 
                                    ? '<span class="badge bg-success">Completed</span>' 
                                    : '<span class="badge bg-warning">Pending</span>'
                                }
                            </td>
                            <td>
                                <button class="btn btn-info btn-sm">Customize<i class="bi bi-eye"></i></button>
                                <button class="btn btn-danger btn-sm">Invoice<i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    `;
                });

                $('table tbody').html(tbody);
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    // Initial load without filter
    loadSalesDataReport();

    // Form submit handle
    $('form').on('submit', function (e) {
        e.preventDefault(); // prevent page reload

        var start_date = $('input[name="start_date"]').val();
        var end_date = $('input[name="end_date"]').val();

        loadSalesDataReport(start_date, end_date);
    });
});
    </script>
@endpush
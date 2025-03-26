@extends('font.master.mastering')
@section('title')
Fashion
@endsection
@section('content')
<!-- Hero Section with Video -->
{{-- <div class="container-fluid p-0">
    <video autoplay muted loop class="w-100 fashion-video">
        <source src="" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="video-overlay text-center text-white">
        <h1 class="display-4 fw-bold">Discover the Future of Fashion</h1>
        <p class="lead">Explore trends, designers, and exclusive collections.</p>
    </div>
</div> --}}

<!-- Fashion Trends Slider -->
<div id="fashionCarousel" class="carousel slide mt-5" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('images/products/banner.png') }}" class="d-block w-100 slider-img" alt="Fashion Trend 1">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/products/banner1.png') }}" class="d-block w-100 slider-img" alt="Fashion Trend 2">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/products/banner2.png') }}" class="d-block w-100 slider-img" alt="Fashion Trend 3">
        </div>
    </div>
</div>

<!-- Featured Fashion Designers -->
<div class="container py-5 text-center">
    <h2 class="fw-bold">Meet Our Designers</h2>
    <div class="row mt-4">
        {{-- @foreach($designers as $designer) --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-lg p-3">
                <img src="" class="img-fluid rounded-circle" alt="Fashion designer name and image">
                <h4 class="mt-3">designer name</h4>
                <p class="text-muted">designer bio</p>
            </div>
        </div>
        {{-- @endforeach --}}
    </div>
</div>

<!-- Our Fashion Events -->
<div class="container py-5">
    <h2 class="text-center fw-bold">Our Events</h2>
    <div class="row mt-4">
        {{-- @foreach($events as $event) --}}
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <img src="" class="img-fluid rounded" alt="event image and title alt">
                <div class="p-3">
                    <h4>event title</h4>
                    <p class="text-muted">Description</p>
                </div>
            </div>
        </div>
        {{-- @endforeach --}}
    </div>
</div>

<!-- Customer Fashion Gallery -->
<div class="container py-5 text-center">
    <h2 class="fw-bold">Our Customers</h2>
    <div class="row g-4">
        {{-- @foreach($customers as $customer) --}}
        <div class="col-md-3">
            <img src="" class="img-fluid rounded shadow-sm" alt="Customer Fashion">
        </div>
        {{-- @endforeach --}}
    </div>
</div>

<!-- Useful Fashion Websites -->
<div class="container py-5">
    <h2 class="text-center fw-bold">More Fashion Inspiration</h2>
    <div class="row mt-4">
        <div class="col-md-4">
            <a href="https://www.vogue.com" target="_blank" class="d-block text-decoration-none text-dark">
                <div class="card shadow-lg p-3">
                    <h4>Vogue</h4>
                    <p class="text-muted">Your guide to the latest trends and news.</p>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="https://www.elle.com" target="_blank" class="d-block text-decoration-none text-dark">
                <div class="card shadow-lg p-3">
                    <h4>ELLE</h4>
                    <p class="text-muted">Fashion, beauty, and culture updates.</p>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="https://www.gq.com" target="_blank" class="d-block text-decoration-none text-dark">
                <div class="card shadow-lg p-3">
                    <h4>GQ</h4>
                    <p class="text-muted">Men’s fashion and style trends.</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Initialize Carousel (Auto-slide every 2s) -->
<script>
    $(document).ready(function() {
        $('#fashionCarousel').carousel({
            interval: 2000, // 2 seconds
            ride: 'carousel'
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush
@push('link')
<style>
    /* Video Section */
    .fashion-video {
        height: 500px;
        object-fit: cover;
    }

    .video-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        background: rgba(0, 0, 0, 0.6);
        padding: 20px;
        border-radius: 10px;
    }

    /* Slider Images */
    .slider-img {
        height: 400px;
        object-fit: cover;
    }

    /* Cards */
    .card {
        transition: 0.3s;
        border-radius: 15px;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
</style>
@endpush
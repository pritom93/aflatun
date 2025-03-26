@extends('font.master.mastering')
@section('title')
About us
@endsection
@section('content')
<!-- Hero Section -->
<div id="bannerCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('images/products/banner3.png') }}" class="d-block w-100 banner-img" alt="Slide 1">
            <div class="carousel-caption">
                <h1 class="fw-bold">Who We Are</h1>
                <p class="lead">Empowering innovation, excellence, and trust.</p>
            </div>
        </div>
    </div>
</div>

<!-- About Section -->
<div class="container py-5">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h2 class="fw-bold">Our Story</h2>
            <p class="text-muted">We started with a vision to make a difference. Our journey has been fueled by passion, creativity, and innovation.</p>
            <p class="text-muted">Committed to excellence, we aim to provide solutions that redefine the industry.</p>
            <a href="#" class="btn btn-primary rounded-pill px-4">Learn More</a>
        </div>
        <div class="col-md-6 text-center">
            <img src="{{asset('images/products/banner.png')}}" class="img-fluid rounded shadow" alt="About Us">
        </div>
    </div>
</div>

<!-- Mission, Vision, Values -->
<div class="container py-5">
    <div class="row text-center">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4">
                <h3 class="fw-bold text-primary">Our Mission</h3>
                <p class="text-muted">To create innovative solutions that bring value and growth to businesses worldwide.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4">
                <h3 class="fw-bold text-success">Our Vision</h3>
                <p class="text-muted">To be a global leader in transforming industries through cutting-edge technology.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm p-4">
                <h3 class="fw-bold text-danger">Our Values</h3>
                <p class="text-muted">Integrity, Innovation, Customer-Centric, and Excellence in everything we do.</p>
            </div>
        </div>
    </div>
</div>

<!-- Team Section -->
<div class="container py-5">
    <h2 class="text-center fw-bold mb-4">Meet Our Team</h2>
    <div class="row">
      
        <div class="col-md-4 text-center">
            <div class="card border-0 shadow-sm p-3">
                <img src="{{asset('images/products/neo.jpg')}}" class="img-fluid rounded-circle mb-3" width="120" height="120" alt="">
                <h5 class="fw-bold">ASMA SHEIKH</h5>
                <p class="text-muted">Quality Assurance Officer</p>
            </div>
        </div>
      
    </div>
</div>
@endsection
@push('script')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Auto-slide interval setup (2 seconds per slide)
    var myCarousel = document.querySelector('#bannerCarousel');
    var carousel = new bootstrap.Carousel(myCarousel, {
        interval: 4000, // 2 seconds
        ride: 'carousel'
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush
@push('link')
<style>
        .banner-img {
        height: 500px; /* Adjust as needed */
        object-fit: cover;
    }

    .carousel-caption {
        background: rgba(0, 0, 0, 0.5); /* Dark overlay for readability */
        padding: 20px;
        border-radius: 10px;
    }
    .banner-section {
        position: relative;
        padding: 0;
        overflow: hidden;
    }

    .banner-img {
        width: 100%;
        height: 400px; /* Adjust height as needed */
        object-fit: cover;
    }

    .banner-overlay {
        position: relative;
    }

    .banner-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        background: rgba(0, 0, 0, 0.5); /* Overlay for readability */
        padding: 20px 40px;
        border-radius: 10px;
    }

    .card {
        transition: all 0.3s ease-in-out;
        border-radius: 15px;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background: #007bff;
        border: none;
        transition: 0.3s;
    }

    .btn-primary:hover {
        background: #0056b3;
    }
</style>
@endpush
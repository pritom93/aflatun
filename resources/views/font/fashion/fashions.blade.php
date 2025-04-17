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
        <div class="col-md-3 d-flex justify-content-center">
            <div class="designer-card">
                <div class="img-container">
                    <img src="{{ asset('images/fashions/f1.jpg') }}" class="designer-img" alt="Designer image">
                    <div class="overlay">
                        <strong>Shimura Yuki</strong>
                        <p class="mb-1">CEO of Renko KSB</p>
                        <button class="designer-button">View Profile</button>
                    </div>
                </div>
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
        <div class="col-md-6 col-lg-3 col-xl-3 mb-4">
            <div class="card shadow-lg border-0 small-event-card">
                <div class="event-image-container">
                    <img src="{{ asset('images/fashions/event1.jpg') }}" class="img-fluid rounded-top" alt="event image and title alt">
                    <div class="event-overlay">
                        <button>More Information</button>
                    </div>
                </div>
                <div class="px-3 pt-3 pb-2">
                    <h4 class="mb-2">HaPpY Chermony</h4>
                    <p class="text-muted mb-0" style="font-size: 0.95rem;">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 col-xl-3 mb-4">
            <div class="card shadow-lg border-0 small-event-card">
                <div class="event-image-container">
                    <img src="{{ asset('images/fashions/event2.jpg') }}" class="img-fluid rounded-top" alt="event image and title alt">
                    <div class="event-overlay">
                        <button>More Information</button>
                    </div>
                </div>
                <div class="px-3 pt-3 pb-2">
                    <h4 class="mb-2">HaPpY Chermony</h4>
                    <p class="text-muted mb-0" style="font-size: 0.95rem;">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                    </p>
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
        <div class="col-6 col-md-3">
            <div class="customer-image-container shadow-sm">
                <img src="{{ asset('images/fashions/c1.jpg') }}" alt="Customer Fashion" class="img-fluid">
                <div class="customer-zoom-overlay">
                    <button class="zoom-btn">Zoom</button>
                </div>
            </div>
        </div>       
        {{-- @endforeach --}}
    </div>
</div>


<!-- Useful Fashion Websites -->
<div class="container py-5">
    <h2 class="text-center fw-bold">More Fashion Inspiration</h2>
    <div class="row mt-4">
        {{-- @foreach($events as $event) --}}
        <div class="col-md-6 col-lg-3 col-xl-3 mb-4">
            <div class="card shadow-lg border-0 small-event-card">
                <div class="event-image-container">
                    <img src="{{ asset('images/fashions/men.jpg') }}" class="img-fluid rounded-top" alt="event image and title alt">
                    <div class="event-overlay">
                        <button>Men Trends</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 col-xl-3 mb-4">
            <div class="card shadow-lg border-0 small-event-card">
                <div class="event-image-container">
                    <img src="{{ asset('images/fashions/women1.webp') }}" class="img-fluid rounded-top" alt="event image and title alt">
                    <div class="event-overlay">
                        <button>Women Trends</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3 col-xl-3 mb-4">
            <div class="card shadow-lg border-0 small-event-card">
                <div class="event-image-container">
                    <img src="{{ asset('images/fashions/baby1.jpg') }}" class="img-fluid rounded-top" alt="event image and title alt">
                    <div class="event-overlay">
                        <button>Baby Trends</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- @endforeach --}}
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
    .customer-image-container {
        position: relative;
        overflow: hidden;
        border-radius: 0.75rem;
        transition: transform 0.3s ease;
    }

    .customer-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .customer-image-container:hover img {
        transform: scale(1.05);
    }

    .customer-zoom-overlay {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.4);
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.4s ease;
        border-radius: 0.75rem;
    }

    .customer-image-container:hover .customer-zoom-overlay {
        opacity: 1;
    }

    .zoom-btn {
        padding: 6px 14px;
        background: #fff;
        color: #000;
        border: none;
        border-radius: 25px;
        font-weight: bold;
        cursor: pointer;
    }

    .zoom-btn:hover {
        background-color: #f1f1f1;
    }
</style>

<style>
    .designer-card {
        position: relative;
        max-width: 300px;
        margin: 30px auto;
        padding: 20px;
        background: #fff;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    .img-container {
        position: relative;
        width: 200px;
        height: 200px;
        margin: 0 auto;
        overflow: hidden;
        border-radius: 50%;
    }

    .designer-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        transition: transform 0.4s ease;
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 100%;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        border-radius: 50%;
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        align-items: center;
        padding: 20px;
        box-sizing: border-box;
        transition: left 0.4s ease;
    }

    .img-container:hover .designer-img {
        transform: scale(1.05);
    }

    .img-container:hover .overlay {
        left: 0;
    }

    .designer-button {
        margin-top: 8px;
        padding: 6px 12px;
        background-color: #ffffff;
        color: #000000;
        border: none;
        border-radius: 20px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .designer-button:hover {
        background-color: #f0f0f0;
    }

    .overlay strong {
        font-size: 1rem;
    }
</style>

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
{{-- our event --}}
<style>
    .small-event-card {
        height: 100%;
    }

    .event-image-container {
        position: relative;
        height: 220px;
        overflow: hidden;
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
    }

    .event-image-container img {
        width: 100%;
        height: auto;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .event-overlay {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .event-image-container:hover .event-overlay {
        opacity: 1;
    }

    .event-image-container:hover img {
        transform: scale(1.05);
    }

    .event-overlay button {
        padding: 8px 18px;
        border: none;
        background-color: #ffffff;
        color: #000;
        font-weight: bold;
        border-radius: 25px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .event-overlay button:hover {
        background-color: #f0f0f0;
    }
</style>

@endpush
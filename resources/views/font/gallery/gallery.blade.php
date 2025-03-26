@extends('font.master.mastering')
@section('title')
Gallery
@endsection
@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4 fw-bold">Our Stunning Gallery</h2>

    <div class="row g-4">
        @foreach ($galleries as $gallery)
        <div class="col-md-4">
            <a href="{{ asset('images/products/' . $gallery->product_image) }}" class="gallery-item">
                <div class="card shadow-sm border-0">
                    <div class="gallery-img-wrapper">
                        <img src="{{ asset('images/products/' . $gallery->product_image) }}" class="img-fluid rounded" alt="Gallery Image">
                        <div class="overlay">
                            <h5 class="text-white">Beautiful View</h5>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>


@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush
@push('link')
<style>
     .gallery-img-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 15px;
        cursor: pointer;
    }

    .gallery-img-wrapper img {
        width: 100%;
        transition: transform 0.3s ease-in-out;
    }

    .gallery-img-wrapper:hover img {
        transform: scale(1.1);
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
        border-radius: 15px;
    }

    .gallery-img-wrapper:hover .overlay {
        opacity: 1;
    }
  
</style>
@endpush

<!-- bootstrap css -->
<link rel="stylesheet" type="text/css" href="{{asset('asset/css/bootstrap.min.css')}}">
<!-- style css -->
<link rel="stylesheet" type="text/css" href="{{asset('asset/css/style.css')}}">
<!-- Responsive-->
<link rel="stylesheet" href="{{asset('asset/css/responsive.css')}}">
<!-- fevicon -->
<link rel="icon" href="{{asset('asset/images/fevicon.png')}}')}}" type="image/gif" />
<!-- Scrollbar Custom CSS -->
<link rel="stylesheet" href="{{asset('asset/css/jquery.mCustomScrollbar.min.css')}}">
<!-- Tweaks for older IEs-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css')}}">
<!-- fonts -->
<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
<!-- font awesome -->
<link rel="stylesheet" type="text/css"
    href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css')}}">
<!--  -->
<!-- owl stylesheets -->
<link href="https://fonts.googleapis.com/css?family=Great+Vibes|Poppins:400,700&display=swap&subset=latin-ext"
    rel="stylesheet">
<link rel="stylesheet" href="{{asset('asset/css/owl.carousel.min.css')}}">
<link rel="stylesoeet" href="{{asset('asset/css/owl.theme.default.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css')}}"
    media="screen">
    <style>
.navbar {
    background: rgb(12, 6, 6); /* Dark background for the navbar */
    backdrop-filter: blur(10px); /* Blur effect for background */
    /* border-radius: 12px; */
    box-shadow: 2px 2px 6px rgb(0, 34, 10); /* Subtle shadow */
    padding: 15px 30px;
    position: fixed; /* Make navbar fixed at top */
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000; /* Ensure it stays on top of other content */
}

/* Navbar Brand */
.navbar-brand {
    font-weight: bold;
    font-size: 32px; /* Increased font size for brand */
    color: #ffffff; /* White color for brand */
    transition: color 0.3s ease;
}

.navbar-brand:hover {
    color: #f88c00; /* Yellow-orange color when hovered */
}

/* Navbar Link Styles */
.nav-link {
    color: #ffffff; /* White color for links */
    font-weight: 500; /* Medium weight for readability */
    font-size: 13px; /* Adjusted font size */
    position: relative;
    transition: color 0.3s ease;
}
.descriptionp {
    color: #0f0202;
}
.descriptionp:hover {
    color: #350303;
    font-weight: bold;
    font-size: 14px;
}
.nav-link::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: -5px;
    left: 50%;
    background: #f2ff00; /* Yellow color under links */
    transition: all 0.3s ease;
    transform: translateX(-50%);
}

.nav-link:hover {
    color: #f88c00; /* Hover effect with yellow-orange */
    font-weight: bold; /* Bold on hover */
}

.nav-link:hover::after {
    width: 100%; /* Underline expands on hover */
}

/* Cart Badge Styling */
.cart-badge {
    background: #f88c00; /* Yellow-orange for cart badge */
    color: white;
    font-size: 12px;
    padding: 5px 10px;
    border-radius: 50%;
    position: absolute;
    top: -5px;
    right: -10px;
}

/* Cart Container */
.cart-container {
    position: relative;
    display: inline-block;
}

/* Spacing between Navbar Items */
.navbar-nav .nav-item {
    margin-right: 25px;
}

/* Search Input Styling */
.navbar-nav input.form-control {
    width: 220px; 
    margin-left: 20px;
    border-radius: 20px;
    padding: 10px 15px;
}


@media (max-width: 991px) {
    .navbar {
        backdrop-filter: none; 
    }
    .icon-bar {
  display: block; /* Makes the bars block-level elements */
  width: 100%; /* Makes the bars fill the width of the button */
  height: 3px; /* Sets the height of the bars */
  background-color: #333; /* Sets the color of the bars */
  margin: 3px 0; /* Adds some margin between the bars */
  transition: 0.4s; /* Adds a smooth transition for animations */
}
.navbar-toggler.active .icon-bar:nth-child(1) {
  transform: rotate(-45deg) translate(-5px, 6px);
}

.navbar-toggler.active .icon-bar:nth-child(2) {
  opacity: 0;
}

.navbar-toggler.active .icon-bar:nth-child(3) {
  transform: rotate(45deg) translate(-5px, -6px);
}
    .navbar-nav {
        flex-direction: column;
        align-items: center;
    }

    .navbar-nav input.form-control {
        margin-top: 10px;
        width: 100%;
    }
}

.footer_section
{
    margin-top: 50px;
    padding: 25px;
   
   
}
.new-content {
    margin-top: 50px;
    padding: 50px;
    background: #f2f2f2; 
    border-radius: 10px;
}

.new-content h2 {
    font-size: 36px;
    font-weight: bold;
    color: #333; 
}

.new-content p {
    font-size: 18px;
    line-height: 1.6;
    color: #555;
}
.skus{
    font-size: 16px;
    font-weight: bold;
    color: #0f0202;
}
.sku{
    font-size: 14px;
    color: #0f0202;
}
   </style>
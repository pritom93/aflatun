<!DOCTYPE html>
<html lang="en">

<head>
   <title>@yield('title','aflatun')</title>
   @include('font.include.css_in');
   @stack('link');
</head>

<body>
   @include('font.include.header');
   <!-- fashion section start -->
   @yield('content');
   <!-- fashion section end -->
   @include('font.include.footer');
   <!-- copyright section end -->
   <!-- Javascript files-->
   @include('font.include.js')

   @stack('script');
</body>

</html>
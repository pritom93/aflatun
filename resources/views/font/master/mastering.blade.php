<!DOCTYPE html>
<html lang="en">

<head>
   <!-- basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- mobile metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
  
   <!-- site metas -->
   <meta name="csrf-token" content="{{csrf_token()}}" />
   <meta name="keywords" content="ecommerce">
   <meta name="description" content="here find new ecommerce">
   <meta name="author" content="Akmam1200">
   <title>@yield('title','aflatun')</title>
   @include('font.include.css_in')
   @stack('link')
</head>

<body>
   @include('font.include.header')
  
   <!-- fashion section start -->
   @yield('content')
   <!-- fashion section end -->
   @include('font.include.footer')
   <!-- copyright section end -->
   <!-- Javascript files-->
   @include('font.include.js')

   @stack('script')
   <script>
      $(document).ready(function(event) {
         $('#buttonLoginID').on('click',function(event){
            event.preventDefault();
            alert('hello ji');

         });
      });
   </script>
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
</body>

</html>
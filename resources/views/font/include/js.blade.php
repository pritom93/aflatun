<script src="{{asset('asset/js/jquery.min.js')}}"></script>
<script src="{{asset('asset/js/popper.min.js')}}"></script>
<script src="{{asset('asset/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('asset/js/jquery-3.0.0.min.js')}}"></script>
<script src="{{asset('asset/js/plugin.js')}}"></script>
<!-- sidebar -->
<script src="{{asset('asset/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{asset('asset/js/custom.js')}}"></script>
<script>
  $(document).ready(function() {
    $.ajaxSetup({
      headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                    });
                  });
App.init();
</script>
<script>
  function openNav() {
        document.getElementById("mySidenav").style.width = "250px";
      }
      
      function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
      }
      $.ajaxSetup({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
       });

       function updateCartCount(count) 
       {
            if (count > 0) {
                $("#cart-count").text(count);
            } else {
                $("#cart-count").text(0); // Show 0 when the cart is empty
            }
        }
</script>
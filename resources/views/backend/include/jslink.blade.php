<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{asset('backend/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('backend/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('backend/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('backend/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('backend/assets/js/app.js')}}"></script>
<script>
      $(document).ready(function() {
          App.init();
          $.ajaxSetup({
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
           });
      });
</script>
<script src="{{asset('backend/assets/js/custom.js')}}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{asset('backend/plugins/apex/apexcharts.min.js')}}"></script>
<script src="{{asset('backend/assets/js/dashboard/dash_1.js')}}"></script>
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{asset('backend/plugins/sweetalerts/sweetalert2.min.js')}}"></script>
<script src="{{asset('backend/plugins/sweetalerts/custom-sweetalert.js')}}"></script>

<script>
      function sweetMessage(resp)
      {
            const toast = swal.mixin({
                  toast: true,
                  position: 'top-end',
                  showConfirmButton: false,
                  timer: 3000,
                  padding: '2em'
                  });

                  toast({
                  type: resp.status,
                  title: resp.message,
                  padding: '2em',
            })
      }
</script>
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
   <style>
    .form-label {
        color: white;
    }
    body {
        /* background: linear-gradient(to right, #d6d6d6, #ffffff); */
        /* display: center; */
        justify-content: center;
        align-items: center; 
        height: 100vh;
    }
    .card {
        background: rgb(12, 6, 6);
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        /* background: linear-gradient(to right, #c87502, #cb8400); */
        
    }
    .form-row {
        display: flex;
        justify-content: space-between;
        gap: 15px;
    }
    .form-row .form-group {
        flex: 1;
    }
</style> 
</head>

<body>

    <div class="row justify-content-center py-5">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <h3 style="color: white; font-weight: bold;" class="text-center">Login</h3>
                <form id="LoginFormID">
              
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" id="email" class="form-control email" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" id="password" class="form-control password" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Log In</button>
                </form>
            </div>
            <a href="{{url('/signup_user')}}" class="btn btn-primary w-100 mt-3">Create an Account</a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#LoginFormID").submit(function(e) {
                e.preventDefault();
    
                var email = $(".email").val();
                var password = $(".password").val();
                let formData = {
                    email: email,
                    password: password
                }
                console.log(email);
    
                $.ajax({
                    url: "{{url('/login_request')}}",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                       console.log(response.message);
                        }      
                });
            });
        });
    </script>
   @include('font.include.js')
</body>

</html>

        


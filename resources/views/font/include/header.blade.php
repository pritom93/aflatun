<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{url('/')}}">AFLATUN</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            {{-- <span class="navbar-toggler-icon"></span> --}}
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{url('/')}}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('/shop')}}">Shop</a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('/gallery')}}">Gallery</a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('/fashion')}}">Fashion</a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('/contuct')}}">Contact</a></li>
                {{-- <li class="nav-item"><a class="nav-link" href="{{url('/login_user')}}">Sign In</a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('/signup_user')}}">Sign Up</a></li> --}}
                <li class="nav-item">
                    <input type="text" class="form-control" placeholder="Search" style="border-radius: 20px;">
                </li>
                <li class="nav-item cart-container">
                    <a class="nav-link" href="{{ url('/cart') }}">
                        Cart <span class="cart-badge" id="cart-count">
                            {{ session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}
                        </span>
                    </a>
                </li>

            @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown">
                        <img src="{{ asset('images/users/' . (auth()->user()->image ?? 'default.png')) }}" alt="Profile" class="rounded-circle me-2" width="32" height="32">
                        {{ auth()->user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="{{ url('/user/profile') }}">My Profile</a></li>
                        <li><a class="dropdown-item" href="{{ url('/user/orders') }}">My Orders</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ url('/logout') }}">Logout</a></li>
                    </ul>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link text-warning fw-bold" href="{{ url('/login_user') }}">
                        <i class="fas fa-user-lock me-1"></i> Login
                    </a>
                </li>
            @endauth
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Product Section -->
            <section class="new-content">
                
            </section>
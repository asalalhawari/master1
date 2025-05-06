 <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets1/img/logo/loder.png" alt="">
                </div>
            </div>
        </div>
    </div>
<header>
        <!--? Header Start -->
        <div class="pt-20 header-area header-transparent">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2 col-md-1">
                            <div class="logo">
                                <a href="/"><img src="assets1/img/logo/logo.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10 col-md-10">
                            <div class="menu-main d-flex align-items-center justify-content-end">
                                <!-- Main-menu -->
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li class="active"><a href="/">Home</a></li>
                                            <li><a href="about">About</a></li>
                                            <li><a href="service">Services</a></li>
                                            <li><a href="book-appointment">Booking</a></li>


                                            <li><a href="contact">Contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="header-right-btn f-right d-none d-lg-block ml-30">
                           @if (Route::has('login'))
    @auth
        <!-- Profile Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <img  class="img-xs rounded-circle"
               style="width: 40px; height: 40px; border-radius: 50%;"
     src="{{ Auth::user()->profile_picture ? asset('storage/profile_pictures/' . Auth::user()->profile_picture) : asset('assets/images/faces/face15.jpg') }}"
     alt="Profile Picture">
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="{{ url('/profile') }}" style="font-size: 14px; font-weight: bold;">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item" style="font-size: 14px; font-weight: bold; cursor: pointer;">Logout</button>
                </form>
            </div>
        </li>
    @else
        <div style="display: flex; gap: 10px;">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}" style="font-size: 17px;">Login</a>
            </li>
            <!-- @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}" style="font-size: 17px;">Register</a>
                </li>
            @endif -->
        </div>
    @endauth
@endif

                     </div>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>

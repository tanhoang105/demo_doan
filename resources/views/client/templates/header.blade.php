<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <h1 class="logo me-auto"><a href="#">Mentor</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="active" href="{{route('route_FE_Homeroute_FE_Home')}}">Trang chủ</a></li>
                <li><a href="{{route('route_FE_Homeroute_FE_Gioi_Thieu')}}">giới thiệu</a></li>
                <li><a href="{{route('route_FE_Homeroute_FE_Khoa_Hoc')}}">Khóa học </a></li>
                <li><a href="{{route('route_FE_Homeroute_FE_Giang_Vien')}}">Giang viên</a></li>

                {{-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="#">Drop Down 1</a></li>
                        <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                            <ul>
                                <li><a href="#">Deep Drop Down 1</a></li>
                                <li><a href="#">Deep Drop Down 2</a></li>
                                <li><a href="#">Deep Drop Down 3</a></li>
                                <li><a href="#">Deep Drop Down 4</a></li>
                                <li><a href="#">Deep Drop Down 5</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Drop Down 2</a></li>
                        <li><a href="#">Drop Down 3</a></li>
                        <li><a href="#">Drop Down 4</a></li>
                    </ul>
                </li> --}}
                <li><a href="{{route('route_FE_Homeroute_FE_Lien_He')}}">Liên hệ</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        <!-- .navbar -->

        <a href="#" class="get-started-btn">Get Started</a>

    </div>
</header>
<!-- End Header -->

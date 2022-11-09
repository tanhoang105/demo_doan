
<div class="navigation navigation_two">
    <div class="container">
        <div class="logo">
            <a href="{{route('home')}}"><img class="img-responsive" src="{{asset('client/images/logo.png')}}" alt="">
            </a>
        </div>
        <div id="navigation" class="menu-wrap">
            <ul>
                <li><a href="{{route('home')}}">Trang Chủ</a></li>
                <li><a href="{{route('client_giang_vien')}}">Giảng Viên</a></li>
                <li class=""><a href="{{route('client_khoa_hoc')}}"> Khóa Học</a>
                   
                </li>
                <li><a href="{{route('client_dang_ky')}}">Đăng Ký</a></li>
                <li><a href="{{route('client_lien_he')}}">Liên Hệ</a></li>
                <li><a href="{{route('client_gioi_thieu')}}">Giới Thiệu</a></li>
            </ul>
        </div>
        <!-- End: navigation  -->
        <div class="header_sign">
            <nav id="navigation">
                <ul>
                  <li><a href="#" style="color: red" aria-haspopup="true"><i class="fas fa-user">@if (Auth::user())
                    {{Auth::user()->name}}
                  @endif</i></a>
                    <ul class="dropdown" aria-label="submenu">
                      <li><a href="{{route('client_thong_tin_ca_nhan')}}">Thông tin chi tiết</a></li>
                      <li> <a href="{{route('logout')}}" class="dropdown-item">Sign out</a></li>
                      <li> <a href="" class="dropdown-item">Lịch sử đăng ký </a></li>
                      <li>
                      </li>
                    </ul>
                  </li>
                </ul>
              </nav>
           
        </div>
        @if (Auth::user())
        @if (Auth::user()->trang_thai == 1)
        <a class="btn btn-success" href="{{route('route_BE_Admin_Khoa_Hoc')}}">Admin</a>
        @else
        @endif
        @endif
        <!-- End: Sign in -->
    </div>
    <!--/ container -->
</div>

<style>
    /* Style The Dropdown Button */
    .dropbtn {
        background-color: #4CAF50;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }

    /* The container <div> - needed to position the dropdown content */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    /* Dropdown Content (Hidden by Default) */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    /* Links inside the dropdown */
    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    /* Change color of dropdown links on hover */
    .dropdown-content a:hover {
        background-color: #f1f1f1
    }

    /* Show the dropdown menu on hover */
    .dropdown:hover .dropdown-content {
        display: block;
    }

    /* Change the background color of the dropdown button when the dropdown content is shown */
    .dropdown:hover .dropbtn {
        background-color: #3e8e41;
    }
</style>

<div class="navigation navigation_two">
    <div class="container">
        <div class="logo">
            <a href="{{ route('home') }}"><img class="img-responsive" src="{{ asset('client/images/logo.png') }}"
                    alt="">
            </a>
        </div>
        <div id="navigation" class="menu-wrap">
            <ul>
                <li><a href="{{ route('home') }}">Trang Chủ</a></li>
                <li><a href="{{ route('client_giang_vien') }}">Giảng Viên</a></li>
                <?php
                $danhmuc = DB::table('danh_muc')
                    ->select('danh_muc.*')
                    ->get();
                ?>
                <li>
                    <a href="{{ route('client_khoa_hoc') }}"> Khóa Học</a>
                    <ul>
                        @foreach ($danhmuc as $value)
                            <li>
                                <form action="{{ route('client_khoa_hoc') }}">
                                    <input type="text" hidden value="{{ $value->id }}" name="id_danhmuc"
                                        id="">
                                    <button
                                        style="background: transparent;border: 0"><a style="text-align: left">{{ $value->ten_danh_muc }}</a></button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li><a href="{{ route('client_chinh_sach') }}">Chính sách</a></li>
                <li><a href="{{ route('client_gioi_thieu') }}">Giới Thiệu</a></li>
            </ul>
        </div>
        <!-- End: navigation  -->
        <div class="header_sign">

            @if (Auth::user())
                <nav id="navigation">
                    <ul>
                        <li><a>
                            @if (Auth::user()->hinh_anh == '')
                            <img src="{{ asset('custom/images/avatar-01.png') }}" style="width:40px; height: 40px; border-radius: 30px;">
                            @else
                            <img src="{{ Storage::url(Auth::user()->hinh_anh) }}" style="width:40px; height: 40px; border-radius: 30px;">
                            @endif
                            
                        </a> 
                            <ul class="dropdown" aria-label="submenu">
                                <li><a href="{{ route('client_lich_hoc') }}">Dịch vụ</a></li>
                                <li><a href="{{ route('client_thong_tin_ca_nhan') }}">Thông tin cá nhân</a></li>
                                <li> <a href="{{ route('client_lich_su_dang_ky', [$objUser->id]) }}"
                                        class="dropdown-item">Lịch sử đăng ký </a></li>
                                <li> <a href="{{ route('logout') }}" class="dropdown-item">Đăng xuất</a></li>
                                {{-- tài khoản đăng nhập khác tài khoản học viên thì có thể vào trang admin      --}}
                                @if (Auth::user()->vai_tro_id != 4)
                                    <li>
                                        <a href="/admin" class="dropdown-item">Admin </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                </nav>
            @else
                <a href=" {{ route('auth.loginForm') }} " class="more-link"> Đăng nhập </a>
            @endif
        </div>
        <!-- End: Sign in -->
    </div>
    <!--/ container -->
</div>

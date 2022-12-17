<nav class="col-md-2 d-none d-md-block bg-light sidebar" style="height: 600px;">

    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item" style="height: 50px;">
                <a class="nav-link" href=" {{ route('client_thong_tin_ca_nhan') }} ">
                    <span data-feather="user"></span>
                    Hồ sơ
                </a>
            </li>
            <li class="nav-item" style="height: 50px;">
                <a class="nav-link" href="{{route('khoa_hoc_dang_ki')}}">
                    <span data-feather="file"></span>
                    Khóa học
                </a>
            </li>
            <li class="nav-item" style="height: 50px;">
                <a class="nav-link" href=" {{ route('client_lich_hoc') }} ">
                    <span data-feather="calendar"></span>
                    Lịch học
                </a>
            </li>
            <li class="nav-item" style="height: 50px;">
                <a class="nav-link" href=" {{ route('client_lop') }} ">
                    <span data-feather="users"></span>
                    Lớp học
                </a>
            </li>
            <li class="nav-item" style="height: 50px;">
                <a class="nav-link" href=" {{ route('tk_ghi_no') }} ">
                    <span data-feather="dollar-sign"></span>
                    Số dư
                </a>
            </li>
        </ul>

    </div>
</nav>

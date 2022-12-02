  <!-- Sidebar -->


  <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          @if (isset($objUser))
              <div class="image">
                  @if ($objUser->hinh_anh == '')
                      <img src="{{ asset('custom/images/avatar-01.png') }}"
                          style="width:40px; height: 40px; border-radius: 30px;">
                  @else
                      <img src="{{ Storage::url($objUser->hinh_anh) }}"
                          style="width:40px; height: 40px; border-radius: 30px;">
                  @endif
              </div>
              <div class="info d-flex align-content-center flex-wrap">

                  <a href="#" class="d-block">{{ $objUser->name }}</a>
              </div>
          @endif
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
              <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                  <button class="btn btn-sidebar">
                      <i class="fas fa-search fa-fw"></i>
                  </button>
              </div>
          </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
              data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->
              @hasRoles(['admin'])

              <li class="nav-item">
                  <a href=" {{ route('route_BE_Admin_Thong_Ke') }}" class="nav-link ">
                      <i class="nav-icon fas fa-chart-pie"></i>
                      <p>
                          Thống kê
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
              </li>

              <li class="nav-item">
                  <a href=" {{ route('route_BE_Admin_Tai_Khoan') }}" class="nav-link ">
                      <i class="nav-icon fas fa-address-card"></i>
                      <p>
                          Tài Khoản
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href=" {{ route('route_BE_Admin_List_Quyen') }} " class="nav-link">
                      <i class="nav-icon fas fa-bars"></i>
                      <p>
                          Quyền tài khoản
                          <i class="fas fa-angle-left right"></i>

                      </p>
                  </a>
              </li>

              <li class="nav-item">
                  <a href=" {{ route('route_BE_Admin_List_Cap_Quyen') }} " class="nav-link">
                      <i class="nav-icon fas fa-bars"></i>
                      <p>
                          Cấp quyền tài khoản
                          <i class="fas fa-angle-left right"></i>

                      </p>
                  </a>
              </li>
              {{-- <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="pages/layout/top-nav.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Top Navigation</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Top Navigation + Sidebar</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/layout/boxed.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Boxed</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Fixed Sidebar</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/layout/fixed-sidebar-custom.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Fixed Sidebar <small>+ Custom Area</small></p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/layout/fixed-topnav.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Fixed Navbar</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/layout/fixed-footer.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Fixed Footer</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Collapsed Sidebar</p>
                        </a>
                    </li>
                </ul> --}}






              <li class="nav-item">
                  <a href=" {{ route('route_BE_Admin_List_Hoc_Vien') }} " class="nav-link">
                      <i class="nav-icon fas fa-users"></i>
                      <p>

                          Học viên
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>

              </li>

              <li class="nav-item">
                  <a href=" {{ route('route_BE_Admin_List_Giang_Vien') }} " class="nav-link">
                      <i class="nav-icon fas fa-user"></i>
                      <p>
                          Giảng viên
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>

              </li>
              <li class="nav-item">
                  <a href=" {{ route('route_BE_Admin_danh_sach_doi_lop') }} " class="nav-link">
                      <i class="nav-icon fas fa-copy"></i>
                      <p>
                          Yêu cầu đổi lớp
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>

              </li>

              <li class="nav-item">
                  <a href="{{ route('route_BE_Admin_quan_ly_tk_ghi_no') }}" class="nav-link">
                      <i class="nav-icon fas fa-edit"></i>
                      <p>
                          Tài khoản ghi nợ
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>

              </li>

              <li class="nav-item">
                  <a href="{{ route('route_BE_Admin_Vai_Tro') }}" class="nav-link">
                      <i class="nav-icon fas fa-edit"></i>
                      <p>
                          Vai Trò
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>

              </li>

              <li class="nav-item">
                  <a href=" {{ route('route_BE_Admin_Khuyen_Mai') }} " class="nav-link">
                      <i class="nav-icon fas fa-percent"></i>
                      <p>
                          Khuyến Mại
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>

              </li>

              <li class="nav-item">
                  <a href="{{ route('route_BE_Admin_Banner') }}" class="nav-link">
                      <i class="nav-icon fas fa-image"></i>
                      <p>
                          Banner
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>

              </li>
              @endhasRoles
              {{-- end admin --}}


              {{-- tác vụ của đào tạo  --}}
              @hasRoles(['admin' , 'đào tạo'])
              <li class="nav-item">
                  <a href="{{ route('route_BE_Admin_Xep_Lop') }}" class="nav-link">
                      <i class="nav-icon fas fa-edit"></i>
                      <p>
                          Xếp Lớp
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>

              </li>

              <li class="nav-item">
                  <a href="{{ route('route_BE_Admin_List_Ca_Thu') }}" class="nav-link">
                      <i class="nav-icon fas fa-calendar-alt"></i>
                      <p>
                          Lịch của lớp học
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>

              </li>

              <li class="nav-item">
                  <a href="{{ route('route_BE_Admin_List_Lich_Hoc') }}" class="nav-link">
                      <i class="nav-icon fas fa-edit"></i>
                      <p>
                          Lịch học của học viên
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>

              </li>

              <li class="nav-item">
                  <a href=" {{ route('route_BE_Admin_List_Lop') }}" class="nav-link ">
                      <i class="nav-icon fas fa-house-user"></i>
                      <p>
                          Lớp Học
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>

              </li>
              <li class="nav-item">
                  <a href="{{ route('route_Admin_BE_Danh_Muc_Khoa_Hoc') }}" class="nav-link">
                      <i class="nav-icon fas fa-industry"></i>
                      <p>
                          Danh mục khóa học
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>

              </li>

              <li class="nav-item">
                  <a href=" {{ route('route_BE_Admin_List_Thu_Hoc') }} " class="nav-link">
                      <i class="nav-icon fas fa-calendar-alt"></i>
                      <p>
                          Thứ Học
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>

              </li>




              <li class="nav-item">
                  <a href="{{ route('route_BE_Admin_Phong_Hoc') }}" class="nav-link">
                      <i class="nav-icon fas fa-house-user"></i>
                      <p>
                          Phòng Học
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>

              </li>

              <li class="nav-item">
                  <a href="{{ route('route_BE_Admin_Khoa_Hoc') }}" class="nav-link">
                      <i class="nav-icon fas fa-book"></i>
                      <p>
                          Khóa học
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>

              </li>

              <li class="nav-item">
                  <a href="{{ route('route_BE_Admin_Ca_Hoc') }}" class="nav-link">
                      <i class="nav-icon fas fa-calendar-alt"></i>
                      <p>
                          Ca Học
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>

              </li>



              @endhasRoles
              {{-- end tác vụ đào tạo --}}


              {{-- tác vụ của kế toán --}}
              @hasRoles(['admin' , 'kế toán'])
              <li class="nav-item">
                  <a href="{{ route('route_BE_Admin_Phuong_Thuc_Thanh_Toan') }}" class="nav-link">
                      <i class="nav-icon fas fa-money-check"></i>
                      <p>
                          Pương thức thanh toán
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>

              </li>

              <li class="nav-item">
                  <a href=" {{ route('route_BE_Admin_List_Thanh_Toan') }} " class="nav-link">
                      <i class="nav-icon fas fa-dollar-sign"></i>
                      <p>
                          Thanh Toán
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>

              </li>



              @endhasRoles

              @hasRoles(['admin','giảng viên'])
              <li class="nav-item">
                  <a href=" {{ route('route_BE_Admin_Lich_Day_Giang_Vien') }} " class="nav-link">
                      <i class="nav-icon fas fa-calendar"></i>
                      <p>
                          Lịch dạy
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>

              </li>
              @endhasRoles

              @hasRoles(['tuyển sinh','admin'])
              <li class="nav-item">
                  <a href=" {{ route('route_BE_Admin_List_Dang_Ky') }} " class="nav-link">
                      <i class="nav-icon fas fa-user-plus"></i>
                      <p>

                          Đăng ký
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>

              </li>

              @endhasRoles

              <li class="nav-item">
                  <a href=" {{ route('logout') }} " class="nav-link">
                      <i class="nav-icon fas fa-user-plus"></i>
                      <p>
                          Đăng xuất
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>

              </li>

          </ul>
      </nav>
      <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->

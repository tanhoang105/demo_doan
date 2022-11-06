  <!-- Sidebar -->


  <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          @if(isset($objUser))
              <div class="image">
                  <img style="border-radius: 100px;width: 50px; height: 50px;%" src= "{{ \Illuminate\Support\Facades\Storage::URL($objUser->hinh_anh)}}" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">

                        <a href="#" class="d-block" >{{$objUser->name}}</a>
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
              <li class="nav-item menu-open">
                  <a href=" {{ route('route_BE_Admin_List_Lop') }}" class="nav-link ">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                          Lớp Học
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>

              </li>
              <li class="nav-item">
                  <a href=" {{ route('route_BE_Admin_Tai_Khoan') }}" class="nav-link ">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>
                          Tài Khoản
                          <i class="right fas fa-angle-left"></i>
                      </p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-copy"></i>
                      <p>
                          Quyền  tài khoản
                          <i class="fas fa-angle-left right"></i>
                          <span class="badge badge-info right">6</span>
                      </p>
                  </a>
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
              </li>

              <li class="nav-item">
                  <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-tree"></i>
                      <p>
                          Thanh Toán
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>

              </li>


              <li class="nav-item">
                <a href=" {{route('route_BE_Admin_List_Dang_Ky')}} " class="nav-link">
                    <i class="nav-icon fas fa-tree"></i>
                    <p>

                        Đăng ký
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>

            </li>

              <li class="nav-item">
                <a href=" {{route('route_BE_Admin_List_Giang_Vien')}} " class="nav-link">
                    <i class="nav-icon fas fa-tree"></i>
                    <p>
                     Giảng viên
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>

            </li>


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
                  <a href="{{ route('route_BE_Admin_Danh_Muc_Khoa_Hoc') }}" class="nav-link">
                      <i class="nav-icon fas fa-edit"></i>
                      <p>
                          Danh mục khóa học
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>

              </li>

              <li class="nav-item">
                  <a href="{{ route('route_BE_Admin_Khoa_Hoc') }}" class="nav-link">
                      <i class="nav-icon fas fa-edit"></i>
                      <p>
                          Khóa học
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>

              </li>

              <li class="nav-item">
                  <a href="{{ route('route_BE_Admin_Phong_Hoc') }}" class="nav-link">
                      <i class="nav-icon fas fa-edit"></i>
                      <p>
                          Phòng Học
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
                      <i class="nav-icon fas fa-edit"></i>
                      <p>
                          Khuyến Mại
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>

              </li>

              <li class="nav-item">
                  <a href="{{ route('route_BE_Admin_Ca_Hoc') }}" class="nav-link">
                      <i class="nav-icon fas fa-edit"></i>
                      <p>
                          Ca Học
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>

              </li>

              <li class="nav-item">
                  <a href="{{ route('route_BE_Admin_Phuong_Thuc_Thanh_Toan') }}" class="nav-link">
                      <i class="nav-icon fas fa-edit"></i>
                      <p>
                          Pương thức thanh toán
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>

              </li>

              <li class="nav-item">
                  <a href="{{ route('route_BE_Admin_Banner') }}" class="nav-link">
                      <i class="nav-icon fas fa-edit"></i>
                      <p>
                          Banner
                          <i class="fas fa-angle-left right"></i>
                      </p>
                  </a>

              </li>


          </ul>
      </nav>
      <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->

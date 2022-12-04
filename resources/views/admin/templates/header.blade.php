  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <a href="{{ route('home') }}" class="nav-link">Home</a>
          </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
          <!-- Navbar Search -->
          <li class="nav-item">
              <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                  <i class="fas fa-search"></i>
              </a>
              <div class="navbar-search-block">
                  <form action="@yield('form-search')" class="form-inline">
                      @csrf
                      <div class="input-group input-group-sm">
                          <input style="display:block ; position:relative" class="form-control form-control-navbar"
                              name="keyword" id="keyword" type="search" placeholder="Tìm kiếm" aria-label="Search">
                          <div id="search_ajax">

                          </div>
                          <div class="input-group-append">
                              {{-- nút tìm kiếm --}}
                              <button class="btn btn-navbar" type="submit">
                                  <i class="fas fa-search"></i>
                              </button>

                              {{-- nút x hủy --}}
                              <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                  <i class="fas fa-times"></i>
                              </button>
                          </div>
                      </div>
                  </form>
              </div>
          </li>

          <li class="nav-item">
              <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
              </a>
          </li>
      </ul>
  </nav>
  <!-- /.navbar -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Woka Archive - @yield('title', 'Dashboard')</title>
  <meta
    content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
    name="viewport" />
  <link
    rel="icon"
    href="{{asset('assets/img/kaiadmin/logo-putih.png')}}"
    type="image/x-icon" />

  <!-- Fonts and icons -->
  <script src="{{asset('assets/js/plugin/webfont/webfont.min.js')}}"></script>
  <script>
    WebFont.load({
      google: {
        families: ["Public Sans:300,400,500,600,700"]
      },
      custom: {
        families: [
          "Font Awesome 5 Solid",
          "Font Awesome 5 Regular",
          "Font Awesome 5 Brands",
          "simple-line-icons",
        ],
        urls: ["{{asset('assets/css/fonts.min.css')}}"],
      },
      active: function() {
        sessionStorage.fonts = true;
      },
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }} " />
  <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <style>
    .sidebar {
      background: rgba(255, 255, 255, 0.10) !important;
      backdrop-filter: blur(18px);
      border-radius: 20px !important;
      margin: 10px;
      height: calc(100vh - 20px) !important;
      border: 1px solid rgba(255, 255, 255, 0.20);
    }

    /* TEXT & ICON PUTIH */
    .sidebar .nav>li>a,
    .sidebar .nav .nav-icon,
    .sidebar .nav .sub-item {
      color: white !important;
    }

    .btn-logout-aurora {
      background: linear-gradient(135deg,
          rgba(255, 60, 60, 0.9),
          rgba(255, 100, 140, 0.9),
          rgba(255, 102, 60, 0.9));
      color: #fff;
      border: none;
      padding: 8px 14px;
      /* LEBIH KECIL */
      border-radius: 10px;
      font-size: 14px;
      font-weight: 600;
      transition: 0.3s ease;
      box-shadow: 0 4px 10px rgba(255, 70, 70, 0.35);
      backdrop-filter: blur(6px);
    }

    .btn-logout-aurora:hover {
      background: linear-gradient(135deg,
          rgba(255, 60, 60, 0.9),
          rgba(255, 100, 140, 0.9),
          rgba(255, 102, 60, 0.9));
      transform: translateY(-2px);
      box-shadow: 0 6px 14px rgba(255, 60, 100, 0.55);
    }

    /* AGAR POSISI TETAP DI PALING BAWAH SIDEBAR */
    .sidebar-footer {
      position: absolute;
      bottom: 20px;
      width: 85%;
      left: 50%;
      transform: translateX(-50%);
    }

    
  </style>
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" data-background-color="dark">
      <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header">
          <a href="{{ route('admin.dashboard') }}" class="logo">
            <img
              src="{{asset('assets/img/kaiadmin/logo-putih.png')}}"
              alt="navbar brand"
              class="navbar-brand"
              height="40" />
            <span class="fw-bold text-white" style="font-size: 16px; padding-left:8px;">
              Woka Archive
            </span>
          </a>
          <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
              <i class="gg-menu-right"></i>
            </button>
            <button class="btn btn-toggle sidenav-toggler">
              <i class="gg-menu-left"></i>
            </button>
          </div>
          <button class="topbar-toggler more">
            <i class="gg-more-vertical-alt"></i>
          </button>
        </div>
        <!-- End Logo Header -->
      </div>
      <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
          <ul class="nav nav-secondary">
            @if(auth()->user()->role == 'admin')
            <li class="nav-item {{request()->routeIs('admin.dashboard.*') ? 'active' : ''}}">
              <a href="{{ route('admin.dashboard')}}">
                <i class="fas fa-home"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/admin/departemen') }}">
                <i class="fas fa-th-list"></i>
                <p>Departemen</p>
              </a>
            </li>
            <li class="nav-item {{request()->routeIs('admin.kategori.*') ? 'active' : ''}}">
              <a href="{{ route('admin.kategori.index')}}">
                <i class="fas fa-folder-open fa-2x text-primary"></i>
                <p>Kategori</p>
              </a>
            </li>
            <li class="nav-item {{request()->routeIs('admin.staff.*') ? 'active' : ''}}">
              <a href="{{ route('admin.staff.index')}}">
                <i class="fas fa-users fa-2x text-warning"></i>
                <p>Staff</p>
              </a>
            </li>
            <li class="nav-item {{request()->routeIs('admin.dokumen.*') ? 'active' : ''}}">
              <a href="{{ route('admin.dokumen.index')}}">
                <i class="fas fa-folder fa-2x text-primary"></i>
                <p>Dokumen</p>
              </a>
            </li>
            
            
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn-logout-aurora w-100">
                  Logout
                </button>
              </form>
            
            @endif

            @if(auth()->user()->role == 'staff')

            <li
              class="nav-item {{request()->routeIs('staff.dashboard') ? 'active' : ''}} ">
              <a href="{{ route('staff.dashboard')}}">
                <i class="fas fa-home"></i>
                <p>Dashboard</p>
              </a>
            </li>

             <li
              class="nav-item {{request()->routeIs('staff.profile.*') ? 'active' : ''}}">
              <a href="{{route('staff.profile')}}">
                <i class="fas fa-users fa-2x text-warning"></i>
                <p>Profile</p>
              </a>
            </li>

            <li class="nav-item {{request()->routeIs('staff.kategori.*') ? 'active' : ''}}">
              <a href="{{ route('staff.kategori')}}">
                <i class="fas fa-folder-open fa-2x text-primary"></i>
                <p>Kategori</p>
              </a>
            </li>

            <li
              class="nav-item {{request()->routeIs('staff.dokumen') ? 'active' : ''}}">
              <a href="{{ route('staff.dokumen.index')}}">
                <i class="fas fa-folder fa-2x text-primary"></i>
                <p>Kelola Dokumen</p>
              </a>
            </li>


           

           
            
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn-logout-aurora w-100">
                  Logout
                </button>
              </form>
            


            @endif
          </ul>
        </div>
      </div>
    </div>

    <!-- End Sidebar -->

    <div class="main-panel">
      <div class="main-header">
        <div class="main-header-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
              <img
                src="{{asset('assets/img/kaiadmin/logo_light.svg')}}"
                alt="navbar brand"
                class="navbar-brand"
                height="20" />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <!-- Navbar Header -->
        <nav
          class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
          <div class="container-fluid">


            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
              <li
                class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                <a
                  class="nav-link dropdown-toggle"
                  data-bs-toggle="dropdown"
                  href="#"
                  role="button"
                  aria-expanded="false"
                  aria-haspopup="true">
                  <i class="fa fa-search"></i>
                </a>
                <ul class="dropdown-menu dropdown-search animated fadeIn">
                  <form class="navbar-left navbar-form nav-search">
                    <div class="input-group">
                      <input
                        type="text"
                        placeholder="Search ..."
                        class="form-control" />
                    </div>
                  </form>
                </ul>
              </li>
              <li class="nav-item topbar-user dropdown hidden-caret">
                <a
                  class="dropdown-toggle profile-pic"
                  data-bs-toggle="dropdown"
                  href="#"
                  aria-expanded="false">
                  <div class="avatar-sm">
                    <img
                     src="{{ Auth::user()->role === 'staff'
        ? asset('storage/' . (optional(Auth::user()->staff)->foto ?? 'default.png'))
        : asset('storage/default.png')
    }}"
                      alt="..."
                      class="avatar-img rounded-circle" />
                  </div>
                  <span class="profile-username">
                    <span class="op-7">Hi,</span>
                    <span class="fw-bold">{{ Auth::user()->name }}</span>
                  </span>

                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                  <div class="dropdown-user-scroll scrollbar-outer">
                    <li>
                      <div class="user-box">
                        <div class="avatar-lg">
                          <img
                            src="{{ Auth::user()->role === 'staff'
        ? asset('storage/' . (optional(Auth::user()->staff)->foto ?? 'default.png'))
        : asset('storage/default.png')
    }}"
                            alt="image profile"
                            class="avatar-img rounded" />
                        </div>
                        <div class="u-text">
                          <span class="profile-username">
                            <span class="op-7">Hi,</span>
                            <span class="fw-bold">{{ Auth::user()->name }}</span>
                            <span class="fw-bold">{{ Auth::user()->email }}</span>
                            <a href="{{ route('login')}}" class="btn btn-xs btn-secondary btn-sm">Logout</a>
                          </span>


                        </div>
                      </div>
                    </li>
                  </div>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>

      <div class="container">
        @yield('content')
      </div>

      <footer class="footer">
        <div class="container-fluid d-flex justify-content-between">
          <nav class="pull-left">
            <ul class="nav">
              <li class="nav-item">
                <a class="nav-link" href="http://www.themekita.com">

                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"> </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"> </a>
              </li>
            </ul>
          </nav>
          <div class="copyright">
            2025, made with <i class="fa fa-heart heart text-danger"></i> by
            <a href="http://www.themekita.com">Kelompok 2 - Woka Archive</a>
          </div>
        </div>
      </footer>
    </div>


  </div>
  <!--   Core JS Files   -->
  <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

  <!-- jQuery Scrollbar -->
  <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

  <!-- Chart JS -->
  <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>

  <!-- jQuery Sparkline -->
  <script src="{{asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

  <!-- Chart Circle -->
  <script src="{{asset('assets/js/plugin/chart-circle/circles.min.js')}}"></script>

  <!-- Datatables -->
  <script src="{{asset('assets/js/plugin/datatables/datatables.min.js')}}"></script>

  <!-- Bootstrap Notify -->
  <script src="{{asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

  <!-- jQuery Vector Maps -->
  <script src="{{asset('assets/js/plugin/jsvectormap/jsvectormap.min.js')}}"></script>
  <script src="{{asset('assets/js/plugin/jsvectormap/world.js')}}"></script>

  <!-- Sweet Alert -->
  <script src="{{asset('assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>

  <!-- Kaiadmin JS -->
  <script src="{{asset('assets/js/kaiadmin.min.js')}}"></script>

  <!-- Kaiadmin DEMO methods, don't include it in your project! -->
  <script src="{{asset('assets/js/setting-demo.js')}}"></script>
  <script src="{{asset('assets/js/demo.js')}}"></script>
  <script>
    $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#177dff",
      fillColor: "rgba(23, 125, 255, 0.14)",
    });

    $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#f3545d",
      fillColor: "rgba(243, 84, 93, .14)",
    });

    $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
      type: "line",
      height: "70",
      width: "100%",
      lineWidth: "2",
      lineColor: "#ffa534",
      fillColor: "rgba(255, 165, 52, .14)",
    });
  </script>
  <script>
    $(document).ready(function() {
      $("#basic-datatables").DataTable({});

      $("#multi-filter-slect").DataTable({
        pegeLength: 5,
        initcomplate: function() {
          this.api()
            .columns()
            .every(function() {
              var column = this;
              var select = $(
                  '<slect class="form-select"><option value>=""></option></select>'
                )
                .appendTo($(columnn.footer()).empty())
                .on("change", function() {
                  var val = $.fn.DataTable.util.escapeRegex($(this).val());

                  column
                    .search(val ? "^" + val + "$" : "", true, false)
                    .draw();

                });
              column
                .data()
                .unique()
                .sort()
                .each(function(d, j) {
                  select.eppend(
                    '<option value="' + d + '">' + d + "</option>"
                  );
                });
            });
        },
      });

      $("#add-row").DataTable({
        pegeLength: 5,
      });

      var action =

        '<div> div class="form button-actiont"> <button type="button" data-bs-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg"data-original-title="edit task">'

      $("#addRowButton").click(function() {
        $("#add-row")
          .dataTable()
          .fnAddData([
            $("#addName").val(),
            $("#addposition").val(),
            $("#addOffice").val(),
            action,
          ]);
        $("#addRowModal").modal("hide");
      });
    });
  </script>
</body>

</html>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventaris Adbis - Poliban</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('ta/assets/images/logos/image.png') }}" />
    <link rel="stylesheet" href="{{ asset('ta/assets/css/styles.min.css') }}" />
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        <!--  App Topstrip -->
        <div class="app-topstrip bg-dark py-6 px-3 w-100 d-lg-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center justify-content-center gap-5 mb-2 mb-lg-0">
                <a class="d-flex justify-content-center" href="#">
                    <img src="{{ asset('ta/assets/images/logos/logo-wrappixel.svg') }}" alt="" width="150">
                </a>
            </div>
            <div class="d-lg-flex align-items-center gap-2">
                <div class="d-flex align-items-center justify-content-center gap-2">
                        <a class="btn btn-primary d-flex align-items-center gap-1 " href="{{ route('logout') }}"
                        >
                            <i class="ti ti-logout fs-5"></i>
                            Logout
                            <i class="ti ti-chevron-down fs-5"></i>
                        </a>
                </div>
            </div>

        </div>
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                   <a href="./index.html" class="text-nowrap logo-img">
  <img src="{{ asset('ta/assets/images/logos/image.png') }}" alt="Logo" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
  ADBIS 25
</a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-6"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                            <span class="hide-menu">Home</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                                <i class="ti ti-atom"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <!-- ---------------------------------- -->
                        <!-- Dashboard -->
                        <!-- ---------------------------------- -->
                        <li class="sidebar-item">
                            <a class="sidebar-link justify-content-between" href="{{ route('barang-masuk') }}"
                                aria-expanded="false">
                                <div class="d-flex align-items-center gap-3">
                                    <span class="d-flex">
                                        <i class="ti ti-aperture"></i>
                                    </span>
                                    <span class="hide-menu">Barang Masuk</span>
                                </div>

                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link justify-content-between" href="{{ route('barang-keluar') }}" aria-expanded="false">
                                <div class="d-flex align-items-center gap-3">
                                    <span class="d-flex">
                                        <i class="ti ti-shopping-cart"></i>
                                    </span>
                                    <span class="hide-menu">Barang Keluar</span>
                                </div>

                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link justify-content-between has-arrow" href="javascript:void(0)"
                                aria-expanded="false">
                                <div class="d-flex align-items-center gap-3">
                                    <span class="d-flex">
                                        <i class="ti ti-layout-grid"></i>
                                    </span>
                                    <span class="hide-menu">Front Pages</span>
                                </div>

                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a class="sidebar-link justify-content-between" href="#">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="round-16 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-circle"></i>
                                            </div>
                                            <span class="hide-menu">Homepage</span>
                                        </div>

                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link justify-content-between" href="#">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="round-16 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-circle"></i>
                                            </div>
                                            <span class="hide-menu">About Us</span>
                                        </div>

                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link justify-content-between" href="#">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="round-16 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-circle"></i>
                                            </div>
                                            <span class="hide-menu">Blog</span>
                                        </div>

                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link justify-content-between" href="#">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="round-16 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-circle"></i>
                                            </div>
                                            <span class="hide-menu">Blog Details</span>
                                        </div>

                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link justify-content-between" href="#">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="round-16 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-circle"></i>
                                            </div>
                                            <span class="hide-menu">Contact Us</span>
                                        </div>

                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link justify-content-between" href="#">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="round-16 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-circle"></i>
                                            </div>
                                            <span class="hide-menu">Portfolio</span>
                                        </div>

                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link justify-content-between" href="#">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="round-16 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-circle"></i>
                                            </div>
                                            <span class="hide-menu">Pricing</span>
                                        </div>

                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <span class="sidebar-divider lg"></span>
                        </li>
                        <li class="nav-small-cap">
                            <iconify-icon icon="solar:menu-dots-linear"
                                class="nav-small-cap-icon fs-4"></iconify-icon>
                            <span class="hide-menu">Apps</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link justify-content-between has-arrow" href="javascript:void(0)"
                                aria-expanded="false">
                                <div class="d-flex align-items-center gap-3">
                                    <span class="d-flex">
                                        <i class="ti ti-basket"></i>
                                    </span>
                                    <span class="hide-menu">Ecommerce</span>
                                </div>

                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a class="sidebar-link justify-content-between" href="#">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="round-16 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-circle"></i>
                                            </div>
                                            <span class="hide-menu">Shop</span>
                                        </div>

                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link justify-content-between" href="#">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="round-16 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-circle"></i>
                                            </div>
                                            <span class="hide-menu">Details</span>
                                        </div>

                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link justify-content-between" href="#">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="round-16 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-circle"></i>
                                            </div>
                                            <span class="hide-menu">List</span>
                                        </div>

                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link justify-content-between" href="#">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="round-16 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-circle"></i>
                                            </div>
                                            <span class="hide-menu">Checkout</span>
                                        </div>

                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link justify-content-between" href="#">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="round-16 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-circle"></i>
                                            </div>
                                            <span class="hide-menu">Add Product</span>
                                        </div>

                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a class="sidebar-link justify-content-between" href="#">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="round-16 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-circle"></i>
                                            </div>
                                            <span class="hide-menu">Edit Product</span>
                                        </div>

                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link " href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="ti ti-bell"></i>
                                <div class="notification bg-primary rounded-circle"></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-animate-up" aria-labelledby="drop1">
                                <div class="message-body">
                                    <a href="javascript:void(0)" class="dropdown-item">
                                        Item 1
                                    </a>
                                    <a href="javascript:void(0)" class="dropdown-item">
                                        Item 2
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">

                            <li class="nav-item dropdown">
                                <a class="nav-link " href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="./assets/images/profile/user-1.jpg" alt="" width="35"
                                        height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body">
                                        <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-user fs-6"></i>
                                            <p class="mb-0 fs-3">My Profile</p>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-mail fs-6"></i>
                                            <p class="mb-0 fs-3">My Account</p>
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="d-flex align-items-center gap-2 dropdown-item">
                                            <i class="ti ti-list-check fs-6"></i>
                                            <p class="mb-0 fs-3">My Task</p>
                                        </a>
                                        <a href="./authentication-login.html"
                                            class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div class="body-wrapper-inner">
                <div class="container-fluid">

                    @yield('content')

                    <div class="py-6 px-6 text-center">
                        <p class="mb-0 fs-4">Design and Developed by <a href="#"
                                class="pe-1 text-primary text-decoration-underline">Wrappixel.com</a> Distributed by <a
                                href="https://themewagon.com" target="_blank">ThemeWagon</a></p>
                    </div>
                </div>
            </div>

            <script src="{{ asset('ta/assets/libs/jquery/dist/jquery.min.js') }}"></script>
            <script src="{{ asset('ta/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
            <script src="{{ asset('ta/assets/js/sidebarmenu.js') }}"></script>
            <script src="{{ asset('ta/assets/js/app.min.js') }}"></script>
            <script src="{{ asset('ta/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
            <script src="{{ asset('ta/assets/libs/simplebar/dist/simplebar.js') }}"></script>
            <script src="{{ asset('ta/assets/js/dashboard.js') }}"></script>
            <!-- solar icons -->
            <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>

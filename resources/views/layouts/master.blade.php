<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="{{ asset('assets/img/logo/logo.png') }}" rel="icon">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/ruang-admin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" >

    <style>
        .sidebar-brand {
            color: #ffffff !important;
            background-color: #514e4e !important;
        }
        .bg-navbar {
            background-color: #514e4e !important;
        }
    </style>
</head>

<body id="page-top">
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
        </a>
        <hr class="sidebar-divider my-0">
        <li class="nav-item {{ request()->is('home') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <li class="nav-item {{ request()->is('member') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('member.index') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Member</span></a>
        </li>
        <li class="nav-item {{ request()->is('meal') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('meal.index') }}">
                <i class="fas fa-fw fa-utensils"></i>
                <span>Meal</span></a>
        </li>
        <li class="nav-item {{ request()->is('bazar') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('bazar.index') }}">
                <i class="fas fa-fw fa-shopping-cart"></i>
                <span>Bazar</span></a>
        </li>
        <li class="nav-item {{ request()->is('report') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('report.page') }}">
                <i class="fas fa-fw fa-book-open"></i>
                <span>Report</span></a>
        </li>
    </ul>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <!-- TopBar -->
            <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <img class="img-profile rounded-circle" src="{{ asset('assets/img/boy.png') }}" style="max-width: 60px">
                            <span class="ml-2 d-none d-lg-inline text-white small">{{ auth()->user()->name }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item"  href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- Topbar -->

            <!-- Container Fluid-->

        @yield('content')

        <!---Container Fluid-->
        </div>
        <!-- Footer -->
        <!-- Footer -->
    </div>
</div>

<!-- Scroll to top -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('assets/js/ruang-admin.min.js') }}"></script>
<script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('assets/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    @if (session()->get('success'))
    Swal.fire(
        {
            title: 'Success!',
            html: '{{ session()->get('success') }}',
            timer: 2000,
            icon:'success'
        }
    )
    @endif

    function deleteCheck(id){
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $("#deleteForm_"+id).submit()
            }
        })
    }

    $('.simpleDataInput').datepicker({
        format: 'yyyy-mm-dd',
        todayBtn: 'linked',
        todayHighlight: true,
        autoclose: true,
    });
</script>
</body>

</html>

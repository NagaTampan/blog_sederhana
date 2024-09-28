<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>@yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    @stack('css')

    <style>
        :root {
            --sidebar-width: 280px;
        }
        body {
            font-family: 'Poppins', sans-serif;
        }
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
            width: var(--sidebar-width);
            transition: all 0.3s ease;
        }
        .sidebar-sticky {
            height: calc(100vh - 48px);
            overflow-x: hidden;
            overflow-y: auto;
        }
        .sidebar .nav-link {
            font-weight: 500;
            color: #333;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover {
            background-color: #f8f9fa;
            color: #007bff;
        }
        .sidebar .nav-link.active {
            color: #007bff;
        }
        .sidebar .nav-link i {
            margin-right: 10px;
        }
        main {
          
            padding: 20px;
            transition: all 0.3s ease;
            width: calc(100% - var(--sidebar-width));
        }
        @media (max-width: 767.98px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                display: none;
            }
            .sidebar.show {
                display: block;
            }
            main {
                margin-left: 0;
            }
            .sidebar-open {
                margin-left: var(--sidebar-width);
            }
        }
        .navbar-brand {
            padding-top: .75rem;
            padding-bottom: .75rem;
            font-size: 1rem;
            background-color: rgba(0, 0, 0, .25);
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
        }
    </style>
</head>
<body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="{{ url('/') }}">
    <i class="fas fa-newspaper"></i> Eagle News
  </a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      @auth
        <form action="{{ route(name: 'logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-link nav-link px-3">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
      @endauth
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active animate__animated animate__fadeInLeft" href= "{{url('dashboard')}}">
              <i class="fas fa-tachometer-alt"></i>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link animate__animated animate__fadeInLeft" href="{{url('article')}}">
              <i class="fas fa-file-alt"></i>
              Articles
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link animate__animated animate__fadeInLeft" href="{{url('categories')}}">
              <i class="fas fa-list"></i>
              Category
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link animate__animated animate__fadeInLeft" href="{{url('users')}}">
              <i class="fas fa-users"></i>
              Users
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      @yield('content')
    </main>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script src="{{asset('back/js/dashboard.js')}}"></script>
@stack('js')

<script>
  document.addEventListener('DOMContentLoaded', (event) => {
    // Add animation to sidebar items on hover
    const sidebarItems = document.querySelectorAll('.sidebar .nav-link');
    sidebarItems.forEach(item => {
      item.addEventListener('mouseenter', () => {
        item.classList.add('animate__animated', 'animate__pulse');
      });
      item.addEventListener('mouseleave', () => {
        item.classList.remove('animate__animated', 'animate__pulse');
      });
    });

    // Toggle sidebar on mobile
    const sidebarToggle = document.querySelector('.navbar-toggler');
    const sidebar = document.querySelector('.sidebar');
    const main = document.querySelector('main');
    
    sidebarToggle.addEventListener('click', () => {
      sidebar.classList.toggle('show');
      main.classList.toggle('sidebar-open');
    });
  });
</script>
</body>
</html>

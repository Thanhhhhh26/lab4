<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tin Tức Việt') - Tin Tức Việt</title>
    <meta name="description" content="@yield('description', 'Trang tin tức tổng hợp hàng đầu Việt Nam')">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #c0392b;
            --primary-dark: #96281b;
            --secondary: #2c3e50;
            --light-bg: #f8f9fa;
        }
        body { font-family: 'Be Vietnam Pro', sans-serif; background: #f5f5f5; color: #333; }

        /* Navbar */
        .navbar-top { background: var(--primary); padding: 8px 0; }
        .navbar-top .nav-link { color: rgba(255,255,255,.85) !important; font-size: 13px; padding: 2px 10px !important; }
        .navbar-top .nav-link:hover { color: #fff !important; }
        .navbar-main { background: var(--secondary); box-shadow: 0 2px 8px rgba(0,0,0,.2); }
        .navbar-main .navbar-brand { color: #fff !important; font-size: 1.6rem; font-weight: 700; letter-spacing: -0.5px; }
        .navbar-main .navbar-brand span { color: #e74c3c; }
        .navbar-main .nav-link { color: rgba(255,255,255,.85) !important; font-weight: 500; padding: 12px 14px !important; font-size: 14px; transition: all .2s; }
        .navbar-main .nav-link:hover, .navbar-main .nav-link.active { color: #fff !important; background: rgba(255,255,255,.1); border-radius: 4px; }
        .search-form .form-control { border-radius: 20px 0 0 20px; border: none; font-size: 14px; }
        .search-form .btn { border-radius: 0 20px 20px 0; background: var(--primary); border: none; color: #fff; }

        /* Cards */
        .news-card { background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 4px rgba(0,0,0,.08); transition: transform .2s, box-shadow .2s; height: 100%; }
        .news-card:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0,0,0,.12); }
        .news-card img { width: 100%; height: 200px; object-fit: cover; }
        .news-card .card-body { padding: 15px; }
        .news-card .category-badge { background: var(--primary); color: #fff; font-size: 11px; padding: 2px 8px; border-radius: 3px; text-decoration: none; display: inline-block; margin-bottom: 8px; }
        .news-card .card-title a { color: #222; text-decoration: none; font-weight: 600; font-size: 15px; line-height: 1.4; }
        .news-card .card-title a:hover { color: var(--primary); }
        .news-card .card-meta { font-size: 12px; color: #888; }

        /* Featured */
        .featured-main { position: relative; border-radius: 10px; overflow: hidden; }
        .featured-main img { width: 100%; height: 420px; object-fit: cover; }
        .featured-main .overlay { position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(0,0,0,.85)); padding: 30px 20px 20px; }
        .featured-main .overlay h2 a { color: #fff; text-decoration: none; font-size: 1.3rem; font-weight: 700; }
        .featured-main .overlay h2 a:hover { color: #f39c12; }

        /* Section title */
        .section-title { font-size: 1.1rem; font-weight: 700; color: var(--secondary); border-left: 4px solid var(--primary); padding-left: 12px; margin-bottom: 20px; }

        /* Sidebar */
        .sidebar-card { background: #fff; border-radius: 8px; padding: 20px; box-shadow: 0 1px 4px rgba(0,0,0,.08); margin-bottom: 20px; }
        .popular-item { display: flex; gap: 12px; padding: 10px 0; border-bottom: 1px solid #f0f0f0; }
        .popular-item:last-child { border-bottom: none; }
        .popular-item img { width: 70px; height: 55px; object-fit: cover; border-radius: 5px; flex-shrink: 0; }
        .popular-item .title a { color: #333; text-decoration: none; font-size: 13px; font-weight: 500; line-height: 1.4; }
        .popular-item .title a:hover { color: var(--primary); }

        /* Footer */
        footer { background: var(--secondary); color: rgba(255,255,255,.8); padding: 40px 0 20px; margin-top: 40px; }
        footer h5 { color: #fff; font-weight: 600; margin-bottom: 15px; }
        footer a { color: rgba(255,255,255,.7); text-decoration: none; font-size: 14px; }
        footer a:hover { color: #fff; }
        footer .footer-bottom { border-top: 1px solid rgba(255,255,255,.1); margin-top: 30px; padding-top: 20px; font-size: 13px; }

        /* Auth */
        .auth-wrapper { min-height: 80vh; display: flex; align-items: center; }
        .auth-card { background: #fff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,.1); padding: 40px; max-width: 480px; width: 100%; }
        .auth-card .auth-logo { text-align: center; margin-bottom: 25px; }
        .auth-card .auth-logo h2 { color: var(--primary); font-weight: 700; }
        .btn-primary-custom { background: var(--primary); border: none; color: #fff; padding: 10px 20px; border-radius: 6px; font-weight: 500; width: 100%; }
        .btn-primary-custom:hover { background: var(--primary-dark); color: #fff; }

        /* Pagination */
        .pagination .page-link { color: var(--primary); }
        .pagination .page-item.active .page-link { background: var(--primary); border-color: var(--primary); }

        /* Alert */
        .alert { border-radius: 8px; font-size: 14px; }

        /* Breadcrumb */
        .breadcrumb-section { background: #fff; padding: 10px 0; border-bottom: 1px solid #eee; margin-bottom: 25px; }
        .breadcrumb { margin: 0; font-size: 13px; }
        .breadcrumb-item a { color: var(--primary); text-decoration: none; }

        /* News detail */
        .news-detail-img { width: 100%; max-height: 450px; object-fit: cover; border-radius: 8px; margin-bottom: 20px; }
        .news-content { font-size: 16px; line-height: 1.8; color: #444; }
        .news-content p { margin-bottom: 15px; }
        .news-content img { max-width: 100%; border-radius: 6px; }

        @media (max-width: 768px) {
            .featured-main img { height: 250px; }
            .auth-card { padding: 25px; }
        }
    </style>
    @yield('styles')
</head>
<body>

<!-- Top bar -->
<div class="navbar-top">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-calendar3 text-white-50 me-1"></i>
                <small class="text-white-50">{{ now()->locale('vi')->isoFormat('dddd, D/M/YYYY') }}</small>
            </div>
            <div class="d-flex align-items-center">
                @auth
                    <span class="text-white-50 me-2" style="font-size:13px"><i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-light py-0 px-2" style="font-size:12px">Đăng xuất</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-link"><i class="bi bi-box-arrow-in-right me-1"></i>Đăng nhập</a>
                    <a href="{{ route('register') }}" class="nav-link"><i class="bi bi-person-plus me-1"></i>Đăng ký</a>
                @endauth
            </div>
        </div>
    </div>
</div>

<!-- Main navbar -->
<nav class="navbar navbar-main navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="bi bi-newspaper me-2"></i>Tin<span>Tức</span>Việt
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <i class="bi bi-list text-white fs-4"></i>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="bi bi-house me-1"></i>Trang Chủ
                    </a>
                </li>
                @php
                    $navCategories = \Illuminate\Support\Facades\DB::table('categories')->where('status', 1)->limit(6)->get();
                @endphp
                @foreach($navCategories as $cat)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('danh-muc/'.$cat->slug) ? 'active' : '' }}"
                           href="{{ route('news.category', $cat->slug) }}">{{ $cat->name }}</a>
                    </li>
                @endforeach
            </ul>
            <form class="search-form d-flex" action="{{ route('news.search') }}" method="GET">
                <input class="form-control" type="search" name="q" placeholder="Tìm kiếm tin tức..."
                       value="{{ request('q') }}" style="min-width:200px">
                <button class="btn" type="submit"><i class="bi bi-search"></i></button>
            </form>
        </div>
    </div>
</nav>

<!-- Flash messages -->
@if(session('success'))
    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
@endif
@if(session('error'))
    <div class="container mt-3">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
@endif
@if(session('info'))
    <div class="container mt-3">
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="bi bi-info-circle me-2"></i>{{ session('info') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
@endif

<!-- Main content -->
<main>
    @yield('content')
</main>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5><i class="bi bi-newspaper me-2"></i>Tin Tức Việt</h5>
                <p style="font-size:14px">Trang tin tức tổng hợp hàng đầu Việt Nam. Cập nhật tin tức nhanh nhất, chính xác nhất 24/7.</p>
                <div class="d-flex gap-3 mt-3">
                    <a href="#"><i class="bi bi-facebook fs-5"></i></a>
                    <a href="#"><i class="bi bi-youtube fs-5"></i></a>
                    <a href="#"><i class="bi bi-twitter-x fs-5"></i></a>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <h5>Danh Mục</h5>
                <ul class="list-unstyled">
                    @foreach(\Illuminate\Support\Facades\DB::table('categories')->where('status',1)->limit(6)->get() as $cat)
                        <li class="mb-1"><a href="{{ route('news.category', $cat->slug) }}"><i class="bi bi-chevron-right me-1"></i>{{ $cat->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-4 mb-4">
                <h5>Liên Hệ</h5>
                <ul class="list-unstyled" style="font-size:14px">
                    <li class="mb-2"><i class="bi bi-geo-alt me-2"></i>123 Đường ABC, Hà Nội</li>
                    <li class="mb-2"><i class="bi bi-telephone me-2"></i>0123 456 789</li>
                    <li class="mb-2"><i class="bi bi-envelope me-2"></i>contact@tintucviet.vn</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Tin Tức Việt. Bảo lưu mọi quyền.</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>داشبورد مدیریت</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --light-color: #f8f9fc;
            --dark-color: #5a5c69;
        }

        body {
            background-color: #f8f9fc;
            font-family: 'Vazirmatn', sans-serif;
            color: var(--dark-color);
        }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, var(--primary-color) 10%, #224abe 100%);
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .sidebar .nav-item {
            position: relative;
        }

        .sidebar .nav-item .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 1rem;
            transition: all 0.3s;
        }

        .sidebar .nav-item .nav-link:hover {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar .nav-item .nav-link.active {
            color: #fff;
            font-weight: 700;
        }

        .sidebar .nav-item .nav-link i {
            margin-left: 0.5rem;
        }

        .topbar {
            height: 4.375rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            background-color: #fff;
        }

        .card {
            border: none;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            margin-bottom: 1.5rem;
        }

        .card-header {
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
            font-weight: 700;
            color: var(--primary-color);
        }

        .stat-card {
            border-left: 0.25rem solid;
        }

        .stat-card.primary {
            border-left-color: var(--primary-color);
        }

        .stat-card.success {
            border-left-color: var(--success-color);
        }

        .stat-card.warning {
            border-left-color: var(--warning-color);
        }

        .stat-card.danger {
            border-left-color: var(--danger-color);
        }

        .product-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .product-image {
            height: 120px;
            object-fit: cover;
            width: 100%;
        }

        .product-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #ff3b30;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.8rem;
        }

        .product-price {
            font-size: 1.2rem;
            font-weight: bold;
            color: #6a0dad;
        }

        .product-original-price {
            text-decoration: line-through;
            color: #6c757d;
            font-size: 1rem;
        }

        .stock-status {
            font-size: 0.8rem;
            padding: 3px 8px;
            border-radius: 4px;
            display: inline-block;
        }

        .stock-status.in-stock {
            background-color: rgba(0, 255, 136, 0.2);
            color: #00ff88;
        }

        .stock-status.out-of-stock {
            background-color: rgba(255, 59, 48, 0.2);
            color: #ff3b30;
        }

        .stock-status.pre-order {
            background-color: rgba(255, 204, 0, 0.2);
            color: #ffcc00;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-0">
                <div class="text-center py-4">
                    <h4 class="text-white">پنل مدیریت</h4>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>داشبورد</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.products.index') }}">
                            <i class="fas fa-fw fa-box"></i>
                            <span>محصولات</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.categories.index') }}">
                            <i class="fas fa-fw fa-list"></i>
                            <span>دسته‌بندی‌ها</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.tags.index') }}">
                            <i class="fas fa-fw fa-tags"></i>
                            <span>تگ‌ها</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.sliders.index') }}">
                            <i class="fas fa-fw fa-images"></i>
                            <span>اسلایدرها</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('articles.index') }}">
                            <i class="fas fa-fw fa-newspaper"></i>
                            <span>مقالات</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-10 p-0">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span
                                    class="me-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle" src="https://source.unsplash.com/random/30x30">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="#"><i
                                            class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>پروفایل</a></li>
                                <li><a class="dropdown-item" href="#"><i
                                            class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>تنظیمات</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                            class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>خروج</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </nav>

                <!-- Page Content -->
                <div class="container-fluid p-4">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">داشبورد</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card stat-card primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">کل
                                                محصولات</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $stats['total_products'] }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-box fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Annual) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card stat-card success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                محصولات تایید شده</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $stats['approved_products'] }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tasks Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card stat-card warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">در
                                                انتظار تایید</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $stats['pending_products'] }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card stat-card info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">کل
                                                کاربران</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ $stats['total_users'] }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">محصولات اخیر</h6>
                                </div>
                                <div class="card-body">
                                    @if ($recentProducts->count() > 0)
                                        <div class="row">
                                            @foreach ($recentProducts as $product)
                                                <div class="col-md-6 mb-4">
                                                    <div class="card product-card">
                                                        <div class="position-relative">
                                                            <img src="{{ asset('storage/' . $product->cover) }}"
                                                                class="product-image" alt="{{ $product->title }}">
                                                            @if ($product->discount > 0)
                                                                <span
                                                                    class="product-badge">{{ $product->discount }}%</span>
                                                            @endif
                                                        </div>
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $product->title }}</h5>
                                                            <div
                                                                class="d-flex justify-content-between align-items-center mb-2">
                                                                <div>
                                                                    @if ($product->discount > 0)
                                                                        <span
                                                                            class="product-original-price">{{ number_format($product->price) }}
                                                                            تومان</span>
                                                                        <span
                                                                            class="product-price">{{ number_format($product->final_price) }}
                                                                            تومان</span>
                                                                    @else
                                                                        <span
                                                                            class="product-price">{{ number_format($product->price) }}
                                                                            تومان</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <span
                                                                class="stock-status {{ $product->stock_status }}">{{ $product->stock_status_text }}</span>
                                                            <div class="mt-3">
                                                                <a href="{{ route('products.edit', $product) }}"
                                                                    class="btn btn-sm btn-warning">ویرایش</a>
                                                                <form
                                                                    action="{{ route('products.destroy', $product) }}"
                                                                    method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-danger"
                                                                        onclick="return confirm('آیا از حذف این محصول مطمئن هستید؟')">حذف</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-center text-muted">محصولی یافت نشد</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">مقالات اخیر</h6>
                                </div>
                                <div class="card-body">
                                    @if ($recentArticles->count() > 0)
                                        <div class="list-group">
                                            @foreach ($recentArticles as $article)
                                                <a href="{{ route('news.single', $article->slug) }}"
                                                    class="list-group-item list-group-item-action">
                                                    <div class="d-flex w-100 justify-content-between">
                                                        <h6 class="mb-1">{{ $article->title }}</h6>
                                                        <small>{{ $article->created_at->format('Y-m-d') }}</small>
                                                    </div>
                                                    <p class="mb-1">{{ Str::limit($article->content, 100) }}</p>
                                                </a>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-center text-muted">مقاله‌ای یافت نشد</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

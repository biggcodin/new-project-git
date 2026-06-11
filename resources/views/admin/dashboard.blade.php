<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>داشبورد مدیریت</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --bg: #0f172a;
            --card: #111827;
            --muted: #94a3b8;
            --text: #e5e7eb;
            --accent: #22d3ee;
            --accent-2: #a78bfa;
            --border: #1f2937;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --sidebar-bg: #0b1220;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            height: 100%;
            background: linear-gradient(135deg, #0b1220 0%, #0f172a 100%);
            color: var(--text);
            font-family: 'Vazirmatn', ui-sans-serif, system-ui, -apple-system, sans-serif;
            font-size: 14px;
            line-height: 1.6;
        }

        /* Layout */
        .container-fluid {
            padding: 0;
        }

        .row {
            margin: 0;
        }

        /* Sidebar */
        .sidebar {
            min-height: 100vh;
            background: var(--sidebar-bg);
            border-left: 1px solid var(--border);
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 25px 20px;
            text-align: center;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-header h4 {
            margin: 0;
            color: var(--accent);
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .sidebar .nav {
            padding: 15px 0;
        }

        .sidebar .nav-item {
            margin: 0 10px 5px 10px;
        }

        .sidebar .nav-link {
            color: var(--muted);
            padding: 12px 15px;
            border-radius: 10px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            border: 1px solid transparent;
        }

        .sidebar .nav-link:hover {
            color: var(--text);
            background: rgba(167, 139, 250, 0.1);
            border-color: rgba(167, 139, 250, 0.2);
            transform: translateX(-5px);
        }

        .sidebar .nav-link.active {
            color: var(--text);
            background: rgba(167, 139, 250, 0.15);
            border-color: rgba(167, 139, 250, 0.3);
            font-weight: 600;
        }

        .sidebar .nav-link i {
            color: var(--accent-2);
            font-size: 1.1em;
            width: 20px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            padding: 0;
        }

        /* Topbar */
        .topbar {
            height: 70px;
            background: var(--card);
            border-bottom: 1px solid var(--border);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            padding: 0 30px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .topbar .navbar-nav {
            flex-direction: row;
            align-items: center;
        }

        .topbar .nav-link {
            color: var(--text);
            padding: 8px 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.2s ease;
        }

        .topbar .nav-link:hover {
            color: var(--accent);
        }

        .topbar .dropdown-menu {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 10px;
            margin-top: 10px;
        }

        .topbar .dropdown-item {
            color: var(--text);
            padding: 10px 15px;
            border-radius: 6px;
            transition: background 0.2s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .topbar .dropdown-item:hover {
            background: rgba(167, 139, 250, 0.1);
        }

        .topbar .dropdown-item i {
            color: var(--accent-2);
        }

        .topbar .dropdown-divider {
            border-color: var(--border);
            margin: 5px 0;
        }

        .img-profile {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid var(--accent);
            object-fit: cover;
        }

        /* Page Content */
        .page-content {
            padding: 30px;
        }

        .page-heading {
            margin-bottom: 30px;
        }

        .page-heading h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -0.02em;
        }

        /* Stat Cards */
        .stat-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 20px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 4px;
            height: 100%;
            opacity: 0.7;
        }

        .stat-card.primary::before {
            background: linear-gradient(180deg, var(--accent), var(--accent-2));
        }

        .stat-card.success::before {
            background: linear-gradient(180deg, var(--success), #34d399);
        }

        .stat-card.warning::before {
            background: linear-gradient(180deg, var(--warning), #fbbf24);
        }

        .stat-card.info::before {
            background: linear-gradient(180deg, var(--accent-2), #c084fc);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: rgba(167, 139, 250, 0.3);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
        }

        .stat-card-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stat-card-info {
            flex: 1;
        }

        .stat-card-label {
            color: var(--muted);
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .stat-card-value {
            color: var(--text);
            font-size: 28px;
            font-weight: 700;
            margin: 0;
        }

        .stat-card-icon {
            font-size: 40px;
            opacity: 0.3;
        }

        .stat-card.primary .stat-card-icon {
            color: var(--accent);
        }

        .stat-card.success .stat-card-icon {
            color: var(--success);
        }

        .stat-card.warning .stat-card-icon {
            color: var(--warning);
        }

        .stat-card.info .stat-card-icon {
            color: var(--accent-2);
        }

        /* Section Cards */
        .section-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .section-card-header {
            padding: 15px 20px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.03), rgba(255, 255, 255, 0.0));
            border-bottom: 1px solid var(--border);
        }

        .section-card-header h6 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-card-header h6::before {
            content: '';
            width: 4px;
            height: 18px;
            background: linear-gradient(180deg, var(--accent), var(--accent-2));
            border-radius: 2px;
        }

        .section-card-body {
            padding: 20px;
        }

        /* Product Cards */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .product-card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent-2);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
        }

        .product-image-wrapper {
            position: relative;
            overflow: hidden;
        }

        .product-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .product-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: var(--danger);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 12px;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
        }

        .product-card-body {
            padding: 15px;
        }

        .product-title {
            margin: 0 0 10px 0;
            font-size: 15px;
            font-weight: 600;
            color: var(--text);
            line-height: 1.4;
        }

        .product-price-section {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
            flex-wrap: wrap;
        }

        .product-price {
            font-size: 16px;
            font-weight: 700;
            color: var(--accent);
        }

        .product-original-price {
            text-decoration: line-through;
            color: var(--muted);
            font-size: 13px;
            opacity: 0.7;
        }

        .price-unit {
            font-size: 11px;
            color: var(--muted);
            margin-right: 3px;
        }

        .stock-status {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 500;
            margin-bottom: 12px;
        }

        .stock-status.in-stock {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .stock-status.out-of-stock {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .stock-status.pre-order {
            background: rgba(245, 158, 11, 0.15);
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .product-actions {
            display: flex;
            gap: 8px;
        }

        .btn-action {
            padding: 6px 12px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-family: inherit;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            text-decoration: none;
        }

        .btn-warning-custom {
            background: rgba(245, 158, 11, 0.15);
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .btn-warning-custom:hover {
            background: rgba(245, 158, 11, 0.25);
            transform: translateY(-2px);
        }

        .btn-danger-custom {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .btn-danger-custom:hover {
            background: rgba(239, 68, 68, 0.25);
            transform: translateY(-2px);
        }

        /* Articles List */
        .articles-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .article-item {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 15px;
            transition: all 0.2s ease;
            text-decoration: none;
            display: block;
        }

        .article-item:hover {
            background: rgba(167, 139, 250, 0.05);
            border-color: var(--accent-2);
            transform: translateX(-5px);
        }

        .article-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .article-title {
            margin: 0;
            font-size: 14px;
            font-weight: 600;
            color: var(--text);
        }

        .article-date {
            color: var(--muted);
            font-size: 11px;
            direction: ltr;
        }

        .article-excerpt {
            margin: 0;
            color: var(--muted);
            font-size: 12px;
            line-height: 1.6;
        }

        /* Empty State */
        .empty-state {
            padding: 40px;
            text-align: center;
            color: var(--muted);
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 15px;
            opacity: 0.3;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                position: static;
                min-height: auto;
                height: auto;
            }

            .sidebar .nav-item {
                display: inline-block;
            }

            .topbar {
                padding: 0 15px;
            }

            .page-content {
                padding: 20px;
            }

            .products-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #0b1220;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--muted);
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar p-0">
                <div class="sidebar-header">
                    <h4>پنل مدیریت</h4>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>داشبورد</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.products.index') }}">
                            <i class="fas fa-box"></i>
                            <span>محصولات</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.categories.index') }}">
                            <i class="fas fa-list"></i>
                            <span>دسته‌بندی‌ها</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.tags.index') }}">
                            <i class="fas fa-tags"></i>
                            <span>تگ‌ها</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.sliders.index') }}">
                            <i class="fas fa-images"></i>
                            <span>اسلایدرها</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.articles.index') }}">
                            <i class="fas fa-newspaper"></i>
                            <span>مقالات</span>
                        </a>
                    </li>
                </ul>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.users.index') }}">
                        <i class="fas fa-users"></i>
                        <span>مدیریت کاربران</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.pending.products') }}">
                        <i class="fas fa-clock"></i>
                        <span>محصولات در لیست انتظار</span>
                    </a>
                </li>
            </div>


            <!-- Main Content -->
            <div class="col-md-10 main-content p-0">
                <!-- Topbar -->
                <nav class="topbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span>{{ Auth::user()->name }}</span>
                                <img class="img-profile" src="https://source.unsplash.com/random/30x30" alt="profile">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user"></i>
                                        پروفایل
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-cogs"></i>
                                        تنظیمات
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>
                                        خروج
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </nav>

                <!-- Page Content -->
                <div class="page-content">
                    <!-- Page Heading -->
                    <div class="page-heading">
                        <h1>داشبورد</h1>
                    </div>

                    <!-- Stat Cards Row -->
                    <div class="row g-3 mb-4">
                        <div class="col-xl-3 col-md-6">
                            <div class="stat-card primary">
                                <div class="stat-card-content">
                                    <div class="stat-card-info">
                                        <div class="stat-card-label">کل محصولات</div>
                                        <div class="stat-card-value">{{ $stats['total_products'] }}</div>
                                    </div>
                                    <div class="stat-card-icon">
                                        <i class="fas fa-box"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="stat-card success">
                                <div class="stat-card-content">
                                    <div class="stat-card-info">
                                        <div class="stat-card-label">محصولات تایید شده</div>
                                        <div class="stat-card-value">{{ $stats['approved_products'] }}</div>
                                    </div>
                                    <div class="stat-card-icon">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="stat-card warning">
                                <div class="stat-card-content">
                                    <div class="stat-card-info">
                                        <div class="stat-card-label">در انتظار تایید</div>
                                        <div class="stat-card-value">{{ $stats['pending_products'] }}</div>
                                    </div>
                                    <div class="stat-card-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="stat-card info">
                                <div class="stat-card-content">
                                    <div class="stat-card-info">
                                        <div class="stat-card-label">کل کاربران</div>
                                        <div class="stat-card-value">{{ $stats['total_users'] }}</div>
                                    </div>
                                    <div class="stat-card-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row g-3">
                        <!-- Recent Products -->
                        <div class="col-xl-8">
                            <div class="section-card">
                                <div class="section-card-header">
                                    <h6>محصولات اخیر</h6>
                                </div>
                                <div class="section-card-body">
                                    @if ($recentProducts->count() > 0)
                                        <div class="products-grid">
                                            @foreach ($recentProducts as $product)
                                                <div class="product-card">
                                                    <div class="product-image-wrapper">
                                                        <img src="{{ asset('storage/' . $product->cover) }}"
                                                            class="product-image" alt="{{ $product->title }}">
                                                        @if ($product->discount > 0)
                                                            <span
                                                                class="product-badge">{{ $product->discount }}%</span>
                                                        @endif
                                                    </div>
                                                    <div class="product-card-body">
                                                        <h5 class="product-title">{{ $product->title }}</h5>
                                                        <div class="product-price-section">
                                                            @if ($product->discount > 0)
                                                                <span class="product-original-price">
                                                                    {{ number_format($product->price) }}
                                                                    <span class="price-unit">تومان</span>
                                                                </span>
                                                                <span class="product-price">
                                                                    {{ number_format($product->final_price) }}
                                                                    <span class="price-unit">تومان</span>
                                                                </span>
                                                            @else
                                                                <span class="product-price">
                                                                    {{ number_format($product->price) }}
                                                                    <span class="price-unit">تومان</span>
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <span class="stock-status {{ $product->stock_status }}">
                                                            {{ $product->stock_status_text }}
                                                        </span>
                                                        <div class="product-actions">
                                                            <a href="{{ route('admin.products.edit', $product) }}"
                                                                class="btn-action btn-warning-custom">
                                                                <i class="fas fa-edit"></i>
                                                                ویرایش
                                                            </a>
                                                            <form
                                                                action="{{ route('admin.products.destroy', $product) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn-action btn-danger-custom"
                                                                    onclick="return confirm('آیا از حذف این محصول مطمئن هستید؟')">
                                                                    <i class="fas fa-trash"></i>
                                                                    حذف
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="empty-state">
                                            <i class="fas fa-box-open"></i>
                                            <div>محصولی یافت نشد</div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Recent Articles -->
                        <div class="col-xl-4">
                            <div class="section-card">
                                <div class="section-card-header">
                                    <h6>مقالات اخیر</h6>
                                </div>
                                <div class="section-card-body">
                                    @if ($recentArticles->count() > 0)
                                        <div class="articles-list">
                                            @foreach ($recentArticles as $article)
                                                <a href="{{ route('news.single', $article->slug) }}"
                                                    class="article-item">
                                                    <div class="article-header">
                                                        <h6 class="article-title">{{ $article->title }}</h6>
                                                        <span class="article-date">
                                                            {{ $article->created_at->format('Y-m-d') }}
                                                        </span>
                                                    </div>
                                                    <p class="article-excerpt">
                                                        {{ Str::limit($article->content, 100) }}
                                                    </p>
                                                </a>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="empty-state">
                                            <i class="fas fa-newspaper"></i>
                                            <div>مقاله‌ای یافت نشد</div>
                                        </div>
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

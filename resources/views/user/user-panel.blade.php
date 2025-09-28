<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <title>پنل کاربری - روشاک</title>
    <link rel="icon" href="images/icon.png" type="image/gif" sizes="16x16">
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Playhost - Game Hosting Website Template" name="description">
    <meta content="" name="keywords">
    <meta content="" name="author">
    <!-- CSS Files -->
    <link href="css/bootstrap.rtl.min.css" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="css/plugins.css" rel="stylesheet" type="text/css">
    <link href="css/swiper.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/coloring.css" rel="stylesheet" type="text/css">
    <!-- color scheme -->
    <link id="colors" href="css/colors/scheme-01.css" rel="stylesheet" type="text/css">
    <!-- Custom CSS for User Panel -->
    <link href="css/user-panel.css" rel="stylesheet" type="text/css">
    <style>
        /* Fix for scrolling issues */
        body {
            overflow-x: hidden;
            position: relative;
        }

        body.menu-open {
            overflow: hidden;
        }

        .mobile-sidebar {
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }

        .mobile-menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .mobile-menu-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* --- بهبود ریسپانسیو و فلکس برای profile-image-edit --- */
        .profile-image-edit {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .profile-image-edit .current-image {
            position: relative;
            width: 120px;
            height: 120px;
            flex-shrink: 0;
        }

        .profile-image-edit .current-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .profile-image-edit .image-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(34, 34, 34, 0.7);
            color: #fff;
            text-align: center;
            padding: 0.5rem 0;
            border-radius: 0 0 50% 50%;
            cursor: pointer;
            font-size: 0.95rem;
            transition: background 0.2s;
        }

        .profile-image-edit .image-overlay:hover {
            background: rgba(106, 13, 173, 0.8);
        }

        .profile-image-edit .image-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 0.3rem;
            font-size: 0.9rem;
            color: #ccc;
        }

        @media (max-width: 576px) {
            .profile-image-edit {
                flex-direction: column;
                align-items: center;
                gap: 0.7rem;
                text-align: center;
            }

            .profile-image-edit .image-info {
                align-items: center;
            }
        }

        .dashboard-section {
            display: none;
        }

        .dashboard-section.active {
            display: block !important;
        }

        .product-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .product-card:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: translateY(-2px);
        }

        .product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        .product-info h5 {
            margin-bottom: 5px;
            font-size: 1.1rem;
        }

        .product-price {
            font-weight: bold;
            color: #00ff88;
        }

        .product-original-price {
            text-decoration: line-through;
            color: #888;
            font-size: 0.9rem;
        }

        .product-discount {
            background: #ff3b30;
            color: white;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: bold;
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

        .order-status {
            font-size: 0.8rem;
            padding: 3px 8px;
            border-radius: 4px;
            display: inline-block;
        }

        .order-status.pending {
            background-color: rgba(255, 204, 0, 0.2);
            color: #ffcc00;
        }

        .order-status.processing {
            background-color: rgba(0, 122, 255, 0.2);
            color: #007aff;
        }

        .order-status.completed {
            background-color: rgba(0, 255, 136, 0.2);
            color: #00ff88;
        }

        .order-status.cancelled {
            background-color: rgba(255, 59, 48, 0.2);
            color: #ff3b30;
        }
    </style>
</head>

<body class="dark-scheme">
    <div id="wrapper">
        <!-- header begin -->
        <header class="transparent">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="de-flex sm-pt10">
                            <div class="de-flex-col">
                                <div class="de-flex-col">
                                    <!-- logo begin -->
                                    <div id="logo">
                                        <a href="index.html">
                                            <img class="logo-main" src="images/logo.png" alt="روشاک">
                                            <img class="logo-mobile" src="images/logo-mobile.png" alt="روشاک">
                                        </a>
                                    </div>
                                    <!-- logo close -->
                                </div>
                            </div>
                            <div class="de-flex-col me-auto">
                                <!-- Empty div for spacing -->
                            </div>
                            <div class="de-flex-col header-col-mid">
                                <ul id="mainmenu" class="d-lg-flex">
                                    <!-- منوها حذف شدند -->
                                </ul>
                            </div>
                            <div class="de-flex-col">
                                <!-- Mobile Menu Button -->
                                <div class="menu-btn">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- header close -->
        <!-- Mobile Sidebar -->
        <div class="mobile-sidebar">
            <div class="user-profile">
                <div class="profile-image">
                    <img src="images/people/1.jpg" alt="تصویر پروفایل کاربر">
                </div>
                <div class="profile-info">
                    <h5>نام کاربر</h5>
                    <span>user@example.com</span>
                </div>
            </div>
            <div class="sidebar-menu">
                <ul>
                    <li class="active">
                        <a href="#dashboard">
                            <i class="fa fa-home"></i>
                            <span>داشبورد</span>
                        </a>
                    </li>
                    <li>
                        <a href="#products">
                            <i class="fa fa-box"></i>
                            <span>محصولات من</span>
                        </a>
                    </li>
                    <li>
                        <a href="#orders">
                            <i class="fa fa-shopping-cart"></i>
                            <span>سفارشات</span>
                        </a>
                    </li>
                    <li>
                        <a href="#advertisement">
                            <i class="fa fa-bullhorn"></i>
                            <span>ثبت آگهی</span>
                        </a>
                    </li>
                    <li>
                        <a href="#profile">
                            <i class="fa fa-user"></i>
                            <span>پروفایل</span>
                        </a>
                    </li>
                    <li>
                        <a href="#settings">
                            <i class="fa fa-cog"></i>
                            <span>تنظیمات</span>
                        </a>
                    </li>
                    <li class="logout">
                        <a href="login.html">
                            <i class="fa fa-sign-out-alt"></i>
                            <span>خروج</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Mobile Menu Overlay -->
        <div class="mobile-menu-overlay"></div>
        <!-- content begin -->
        <div class="no-bottom no-top" id="content">
            <div id="top"></div>
            <!-- section begin -->
            <section id="section-user-panel" class="jarallax">
                <div class="container">
                    <div class="row">
                        <!-- Desktop Sidebar -->
                        <div class="col-lg-3 mb-4 d-none d-lg-block">
                            <div class="dashboard-sidebar">
                                <div class="user-profile">
                                    <div class="profile-image">
                                        <img src="images/people/1.jpg" alt="تصویر پروفایل کاربر">
                                    </div>
                                    <div class="profile-info">
                                        <h5>نام کاربر</h5>
                                        <span>user@example.com</span>
                                    </div>
                                </div>
                                <div class="sidebar-menu">
                                    <ul>
                                        <li class="active">
                                            <a href="#dashboard">
                                                <i class="fa fa-home"></i>
                                                <span>داشبورد</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#products">
                                                <i class="fa fa-box"></i>
                                                <span>محصولات من</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#orders">
                                                <i class="fa fa-shopping-cart"></i>
                                                <span>سفارشات</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#advertisement">
                                                <i class="fa fa-bullhorn"></i>
                                                <span>ثبت آگهی</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#profile">
                                                <i class="fa fa-user"></i>
                                                <span>پروفایل</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#settings">
                                                <i class="fa fa-cog"></i>
                                                <span>تنظیمات</span>
                                            </a>
                                        </li>
                                        <li class="logout">
                                            <a href="login.html">
                                                <i class="fa fa-sign-out-alt"></i>
                                                <span>خروج</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Main Content -->
                        <div class="col-lg-9">
                            <div class="dashboard-content">
                                <!-- Dashboard Section -->
                                <div id="dashboard" class="dashboard-section">
                                    <div class="dashboard-header">
                                        <h2>داشبورد</h2>
                                        <div class="header-actions">
                                            <a href="#profile" class="btn-main">
                                                <i class="fa fa-user-edit"></i>
                                                ویرایش پروفایل
                                            </a>
                                        </div>
                                    </div>
                                    <div class="stats-cards">
                                        <div class="row g-2">
                                            <div class="col-4">
                                                <div class="stat-card">
                                                    <div class="stat-icon">
                                                        <i class="fa fa-box"></i>
                                                    </div>
                                                    <div class="stat-info">
                                                        <h3>3</h3>
                                                        <p>محصولات فعال</p>
                                                        <small>از 5 محصول مجاز</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="stat-card">
                                                    <div class="stat-icon">
                                                        <i class="fa fa-ticket"></i>
                                                    </div>
                                                    <div class="stat-info">
                                                        <h3>2</h3>
                                                        <p>تیکت‌های باز</p>
                                                        <small>در انتظار پاسخ</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="stat-card">
                                                    <div class="stat-icon">
                                                        <i class="fa fa-wallet"></i>
                                                    </div>
                                                    <div class="stat-info">
                                                        <h3>150,000</h3>
                                                        <p>اعتبار حساب</p>
                                                        <small>آخرین شارژ: 2 روز پیش</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Recent Tickets -->
                                    <div class="dashboard-section">
                                        <div class="section-header">
                                            <h3>تیکت‌های اخیر</h3>
                                            <a href="#tickets" class="btn btn-link">مشاهده همه</a>
                                        </div>
                                        <!-- Desktop Table View -->
                                        <div class="table-responsive d-none d-lg-block">
                                            <table class="table table-pricing dark-style">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">شماره تیکت</th>
                                                        <th scope="col">موضوع</th>
                                                        <th scope="col">وضعیت</th>
                                                        <th scope="col">آخرین بروزرسانی</th>
                                                        <th scope="col">عملیات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th><span class="lbl">شماره تیکت</span>#TK-2024-001</th>
                                                        <td><span class="lbl">موضوع</span>مشکل در اتصال به سرور</td>
                                                        <td><span class="lbl">وضعیت</span><span
                                                                class="badge bg-warning">در انتظار پاسخ</span></td>
                                                        <td><span class="lbl">آخرین بروزرسانی</span>2 ساعت پیش</td>
                                                        <td>
                                                            <a href="#" class="btn-main"
                                                                data-hover="مشاهده تیکت"><span>مشاهده تیکت</span></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th><span class="lbl">شماره تیکت</span>#TK-2024-002</th>
                                                        <td><span class="lbl">موضوع</span>درخواست ارتقای پکیج</td>
                                                        <td><span class="lbl">وضعیت</span><span
                                                                class="badge bg-success">پاسخ داده شده</span></td>
                                                        <td><span class="lbl">آخرین بروزرسانی</span>1 روز پیش</td>
                                                        <td>
                                                            <a href="#" class="btn-main"
                                                                data-hover="مشاهده تیکت"><span>مشاهده تیکت</span></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th><span class="lbl">شماره تیکت</span>#TK-2024-003</th>
                                                        <td><span class="lbl">موضوع</span>گزارش مشکل فنی</td>
                                                        <td><span class="lbl">وضعیت</span><span
                                                                class="badge bg-danger">بسته شده</span></td>
                                                        <td><span class="lbl">آخرین بروزرسانی</span>3 روز پیش</td>
                                                        <td>
                                                            <a href="#" class="btn-main"
                                                                data-hover="مشاهده تیکت"><span>مشاهده تیکت</span></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- Mobile and Tablet Card View -->
                                        <div class="d-lg-none">
                                            <div class="ticket-cards">
                                                <!-- Ticket Card 1 -->
                                                <div class="ticket-card">
                                                    <div class="ticket-header">
                                                        <div class="ticket-id">#TK-2024-001</div>
                                                        <span class="badge bg-warning">در انتظار پاسخ</span>
                                                    </div>
                                                    <div class="ticket-body">
                                                        <h5>مشکل در اتصال به سرور</h5>
                                                        <div class="ticket-meta">
                                                            <span><i class="fa fa-clock"></i> 2 ساعت پیش</span>
                                                        </div>
                                                    </div>
                                                    <div class="ticket-footer">
                                                        <a href="#" class="btn-main btn-full"
                                                            data-hover="مشاهده تیکت"><span>مشاهده تیکت</span></a>
                                                    </div>
                                                </div>
                                                <!-- Ticket Card 2 -->
                                                <div class="ticket-card">
                                                    <div class="ticket-header">
                                                        <div class="ticket-id">#TK-2024-002</div>
                                                        <span class="badge bg-success">پاسخ داده شده</span>
                                                    </div>
                                                    <div class="ticket-body">
                                                        <h5>درخواست ارتقای پکیج</h5>
                                                        <div class="ticket-meta">
                                                            <span><i class="fa fa-clock"></i> 1 روز پیش</span>
                                                        </div>
                                                    </div>
                                                    <div class="ticket-footer">
                                                        <a href="#" class="btn-main btn-full"
                                                            data-hover="مشاهده تیکت"><span>مشاهده تیکت</span></a>
                                                    </div>
                                                </div>
                                                <!-- Ticket Card 3 -->
                                                <div class="ticket-card">
                                                    <div class="ticket-header">
                                                        <div class="ticket-id">#TK-2024-003</div>
                                                        <span class="badge bg-danger">بسته شده</span>
                                                    </div>
                                                    <div class="ticket-body">
                                                        <h5>گزارش مشکل فنی</h5>
                                                        <div class="ticket-meta">
                                                            <span><i class="fa fa-clock"></i> 3 روز پیش</span>
                                                        </div>
                                                    </div>
                                                    <div class="ticket-footer">
                                                        <a href="#" class="btn-main btn-full"
                                                            data-hover="مشاهده تیکت"><span>مشاهده تیکت</span></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Products Section -->
                                <div id="products" class="dashboard-section d-none">
                                    <div class="dashboard-header">
                                        <h2>محصولات من</h2>
                                        <div class="header-actions">
                                            <a href="#advertisement" class="btn-main">
                                                <i class="fa fa-plus"></i>
                                                ثبت محصول جدید
                                            </a>
                                        </div>
                                    </div>
                                    <div class="products-list">
                                        <!-- Product 1 -->
                                        <div class="product-card">
                                            <div class="row align-items-center">
                                                <div class="col-md-2">
                                                    <img src="images/covers-square/1.webp" alt="محصول"
                                                        class="product-image">
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="product-info">
                                                        <h5>اکانت پرمیوم Minecraft</h5>
                                                        <div class="d-flex align-items-center gap-2 mb-2">
                                                            <span class="product-price">120,000 تومان</span>
                                                            <span class="product-original-price">150,000 تومان</span>
                                                            <span class="product-discount">20%</span>
                                                        </div>
                                                        <span class="stock-status in-stock">موجود</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 text-end">
                                                    <div class="d-flex gap-2 justify-content-end">
                                                        <button class="btn btn-sm btn-warning">ویرایش</button>
                                                        <button class="btn btn-sm btn-danger">حذف</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Product 2 -->
                                        <div class="product-card">
                                            <div class="row align-items-center">
                                                <div class="col-md-2">
                                                    <img src="images/covers-square/2.webp" alt="محصول"
                                                        class="product-image">
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="product-info">
                                                        <h5>اکانت VIP CS:GO</h5>
                                                        <div class="d-flex align-items-center gap-2 mb-2">
                                                            <span class="product-price">200,000 تومان</span>
                                                        </div>
                                                        <span class="stock-status pre-order">پیش‌فروش</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 text-end">
                                                    <div class="d-flex gap-2 justify-content-end">
                                                        <button class="btn btn-sm btn-warning">ویرایش</button>
                                                        <button class="btn btn-sm btn-danger">حذف</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Product 3 -->
                                        <div class="product-card">
                                            <div class="row align-items-center">
                                                <div class="col-md-2">
                                                    <img src="images/covers-square/3.webp" alt="محصول"
                                                        class="product-image">
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="product-info">
                                                        <h5>اکانت Rust</h5>
                                                        <div class="d-flex align-items-center gap-2 mb-2">
                                                            <span class="product-price">180,000 تومان</span>
                                                        </div>
                                                        <span class="stock-status out-of-stock">ناموجود</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 text-end">
                                                    <div class="d-flex gap-2 justify-content-end">
                                                        <button class="btn btn-sm btn-warning">ویرایش</button>
                                                        <button class="btn btn-sm btn-danger">حذف</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Orders Section -->
                                <div id="orders" class="dashboard-section d-none">
                                    <div class="dashboard-header">
                                        <h2>سفارشات من</h2>
                                        <div class="header-actions">
                                            <a href="#dashboard" class="btn-main btn-secondary">
                                                <i class="fa fa-arrow-right"></i>
                                                بازگشت به داشبورد
                                            </a>
                                        </div>
                                    </div>
                                    <!-- Desktop Table View -->
                                    <div class="table-responsive d-none d-lg-block">
                                        <table class="table table-pricing dark-style">
                                            <thead>
                                                <tr>
                                                    <th scope="col">شماره سفارش</th>
                                                    <th scope="col">محصول</th>
                                                    <th scope="col">قیمت اصلی</th>
                                                    <th scope="col">تخفیف</th>
                                                    <th scope="col">قیمت نهایی</th>
                                                    <th scope="col">تاریخ</th>
                                                    <th scope="col">وضعیت</th>
                                                    <th scope="col">عملیات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th><span class="lbl">شماره سفارش</span>#ORD-2024-001</th>
                                                    <td><span class="lbl">محصول</span>اکانت پرمیوم Minecraft</td>
                                                    <td><span class="lbl">قیمت اصلی</span>150,000 تومان</td>
                                                    <td><span class="lbl">تخفیف</span>20%</td>
                                                    <td><span class="lbl">قیمت نهایی</span>120,000 تومان</td>
                                                    <td><span class="lbl">تاریخ</span>1402/12/15</td>
                                                    <td><span class="lbl">وضعیت</span><span
                                                            class="order-status completed">تکمیل شده</span></td>
                                                    <td>
                                                        <a href="#" class="btn-main"
                                                            data-hover="مشاهده جزئیات"><span>مشاهده
                                                                جزئیات</span></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th><span class="lbl">شماره سفارش</span>#ORD-2024-002</th>
                                                    <td><span class="lbl">محصول</span>اکانت VIP CS:GO</td>
                                                    <td><span class="lbl">قیمت اصلی</span>200,000 تومان</td>
                                                    <td><span class="lbl">تخفیف</span>0%</td>
                                                    <td><span class="lbl">قیمت نهایی</span>200,000 تومان</td>
                                                    <td><span class="lbl">تاریخ</span>1402/12/10</td>
                                                    <td><span class="lbl">وضعیت</span><span
                                                            class="order-status processing">در حال پردازش</span></td>
                                                    <td>
                                                        <a href="#" class="btn-main"
                                                            data-hover="مشاهده جزئیات"><span>مشاهده
                                                                جزئیات</span></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th><span class="lbl">شماره سفارش</span>#ORD-2024-003</th>
                                                    <td><span class="lbl">محصول</span>اکانت Rust</td>
                                                    <td><span class="lbl">قیمت اصلی</span>180,000 تومان</td>
                                                    <td><span class="lbl">تخفیف</span>10%</td>
                                                    <td><span class="lbl">قیمت نهایی</span>162,000 تومان</td>
                                                    <td><span class="lbl">تاریخ</span>1402/12/05</td>
                                                    <td><span class="lbl">وضعیت</span><span
                                                            class="order-status cancelled">لغو شده</span></td>
                                                    <td>
                                                        <a href="#" class="btn-main"
                                                            data-hover="مشاهده جزئیات"><span>مشاهده
                                                                جزئیات</span></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Mobile and Tablet Card View -->
                                    <div class="d-lg-none">
                                        <div class="order-cards">
                                            <!-- Order Card 1 -->
                                            <div class="order-card">
                                                <div class="order-header">
                                                    <div class="order-id">#ORD-2024-001</div>
                                                    <span class="order-status completed">تکمیل شده</span>
                                                </div>
                                                <div class="order-body">
                                                    <div class="order-info">
                                                        <div class="info-item">
                                                            <span class="label">محصول:</span>
                                                            <span class="value">اکانت پرمیوم Minecraft</span>
                                                        </div>
                                                        <div class="info-item">
                                                            <span class="label">قیمت اصلی:</span>
                                                            <span class="value">150,000 تومان</span>
                                                        </div>
                                                        <div class="info-item">
                                                            <span class="label">تخفیف:</span>
                                                            <span class="value">20%</span>
                                                        </div>
                                                        <div class="info-item">
                                                            <span class="label">قیمت نهایی:</span>
                                                            <span class="value">120,000 تومان</span>
                                                        </div>
                                                        <div class="info-item">
                                                            <span class="label">تاریخ:</span>
                                                            <span class="value">1402/12/15</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="order-footer">
                                                    <a href="#" class="btn-main btn-full"
                                                        data-hover="مشاهده جزئیات"><span>مشاهده جزئیات</span></a>
                                                </div>
                                            </div>
                                            <!-- Order Card 2 -->
                                            <div class="order-card">
                                                <div class="order-header">
                                                    <div class="order-id">#ORD-2024-002</div>
                                                    <span class="order-status processing">در حال پردازش</span>
                                                </div>
                                                <div class="order-body">
                                                    <div class="order-info">
                                                        <div class="info-item">
                                                            <span class="label">محصول:</span>
                                                            <span class="value">اکانت VIP CS:GO</span>
                                                        </div>
                                                        <div class="info-item">
                                                            <span class="label">قیمت اصلی:</span>
                                                            <span class="value">200,000 تومان</span>
                                                        </div>
                                                        <div class="info-item">
                                                            <span class="label">تخفیف:</span>
                                                            <span class="value">0%</span>
                                                        </div>
                                                        <div class="info-item">
                                                            <span class="label">قیمت نهایی:</span>
                                                            <span class="value">200,000 تومان</span>
                                                        </div>
                                                        <div class="info-item">
                                                            <span class="label">تاریخ:</span>
                                                            <span class="value">1402/12/10</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="order-footer">
                                                    <a href="#" class="btn-main btn-full"
                                                        data-hover="مشاهده جزئیات"><span>مشاهده جزئیات</span></a>
                                                </div>
                                            </div>
                                            <!-- Order Card 3 -->
                                            <div class="order-card">
                                                <div class="order-header">
                                                    <div class="order-id">#ORD-2024-003</div>
                                                    <span class="order-status cancelled">لغو شده</span>
                                                </div>
                                                <div class="order-body">
                                                    <div class="order-info">
                                                        <div class="info-item">
                                                            <span class="label">محصول:</span>
                                                            <span class="value">اکانت Rust</span>
                                                        </div>
                                                        <div class="info-item">
                                                            <span class="label">قیمت اصلی:</span>
                                                            <span class="value">180,000 تومان</span>
                                                        </div>
                                                        <div class="info-item">
                                                            <span class="label">تخفیف:</span>
                                                            <span class="value">10%</span>
                                                        </div>
                                                        <div class="info-item">
                                                            <span class="label">قیمت نهایی:</span>
                                                            <span class="value">162,000 تومان</span>
                                                        </div>
                                                        <div class="info-item">
                                                            <span class="label">تاریخ:</span>
                                                            <span class="value">1402/12/05</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="order-footer">
                                                    <a href="#" class="btn-main btn-full"
                                                        data-hover="مشاهده جزئیات"><span>مشاهده جزئیات</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Profile Edit Section -->
                                <div id="profile" class="dashboard-section d-none">
                                    <div class="dashboard-content">
                                        <div class="dashboard-header">
                                            <h2>ویرایش پروفایل</h2>
                                            <div class="header-actions">
                                                <a href="#dashboard" class="btn-main btn-secondary">
                                                    <i class="fa fa-arrow-right"></i>
                                                    بازگشت به داشبورد
                                                </a>
                                            </div>
                                        </div>
                                        <div class="profile-edit-section">
                                            <div class="row">
                                                <!-- Profile Image -->
                                                <div class="col-lg-4">
                                                    <div class="profile-image-edit">
                                                        <div class="current-image">
                                                            <img src="images/people/1.jpg" alt="تصویر پروفایل کاربر">
                                                            <div class="image-overlay">
                                                                <i class="fa fa-camera"></i>
                                                                <span>تغییر تصویر</span>
                                                            </div>
                                                        </div>
                                                        <input type="file" id="profile-image-input" class="d-none"
                                                            accept="image/*">
                                                        <div class="image-info">
                                                            <small>فرمت‌های مجاز: JPG, PNG, GIF</small>
                                                            <small>حداکثر حجم: 2MB</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Profile Form -->
                                                <div class="col-lg-8">
                                                    <form class="profile-form">
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="firstname">نام</label>
                                                                    <input type="text" class="form-control"
                                                                        id="firstname" value="نام کاربر">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="lastname">نام خانوادگی</label>
                                                                    <input type="text" class="form-control"
                                                                        id="lastname" value="نام خانوادگی">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="email">ایمیل</label>
                                                                    <input type="email" class="form-control"
                                                                        id="email" value="user@example.com">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="phone">شماره موبایل</label>
                                                                    <input type="tel" class="form-control"
                                                                        id="phone" value="09123456789">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="bio">درباره من</label>
                                                                    <textarea class="form-control" id="bio" rows="4">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <hr class="divider">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="current-password">رمز عبور فعلی</label>
                                                                    <input type="password" class="form-control"
                                                                        id="current-password">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="new-password">رمز عبور جدید</label>
                                                                    <input type="password" class="form-control"
                                                                        id="new-password">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="confirm-password">تکرار رمز عبور
                                                                        جدید</label>
                                                                    <input type="password" class="form-control"
                                                                        id="confirm-password">
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-actions">
                                                                    <button type="submit" class="btn-main">ذخیره
                                                                        تغییرات</button>
                                                                    <button type="reset"
                                                                        class="btn-main btn-secondary">انصراف</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Advertisement Section -->
                                <div id="advertisement" class="dashboard-section d-none">
                                    <div class="dashboard-content">
                                        <div class="dashboard-header">
                                            <h2>ثبت آگهی جدید</h2>
                                            <div class="header-actions">
                                                <a href="#dashboard" class="btn-main btn-secondary">
                                                    <i class="fa fa-arrow-right"></i>
                                                    بازگشت به داشبورد
                                                </a>
                                            </div>
                                        </div>
                                        <!-- Steps Progress -->
                                        <div class="advertisement-steps">
                                            <div class="step-progress">
                                                <div class="step active" data-step="1">
                                                    <div class="step-number">1</div>
                                                    <div class="step-title">انتخاب بازی و قوانین</div>
                                                </div>
                                                <div class="step" data-step="2">
                                                    <div class="step-number">2</div>
                                                    <div class="step-title">اطلاعات آگهی</div>
                                                </div>
                                                <div class="step" data-step="3">
                                                    <div class="step-number">3</div>
                                                    <div class="step-title">اطلاعات تماس</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="advertisement-section">
                                            <form class="advertisement-form" id="advertisementForm">
                                                <!-- Step 1: Game Selection and Rules -->
                                                <div class="form-step active" data-step="1">
                                                    <div class="rules-section mb-4">
                                                        <h4 class="mb-3">قوانین ثبت آگهی</h4>
                                                        <div class="rules-content">
                                                            <div class="rule-item">
                                                                <i class="fa fa-check-circle"></i>
                                                                <span>آگهی‌های ثبت شده باید مرتبط با خدمات گیمینگ و
                                                                    هاستینگ باشند.</span>
                                                            </div>
                                                            <div class="rule-item">
                                                                <i class="fa fa-check-circle"></i>
                                                                <span>اطلاعات تماس و قیمت‌ها باید دقیق و واقعی
                                                                    باشند.</span>
                                                            </div>
                                                            <div class="rule-item">
                                                                <i class="fa fa-check-circle"></i>
                                                                <span>تصاویر آگهی باید مرتبط با موضوع و با کیفیت مناسب
                                                                    باشند.</span>
                                                            </div>
                                                            <div class="rule-item">
                                                                <i class="fa fa-check-circle"></i>
                                                                <span>هر کاربر مجاز به ثبت حداکثر 3 آگهی فعال همزمان
                                                                    است.</span>
                                                            </div>
                                                            <div class="rule-item">
                                                                <i class="fa fa-check-circle"></i>
                                                                <span>مدیریت سایت حق حذف آگهی‌های نامناسب را
                                                                    دارد.</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="game-selection">
                                                        <h4 class="mb-3">انتخاب بازی</h4>
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="game-category">دسته‌بندی بازی</label>
                                                                    <select class="form-control" id="game-category"
                                                                        required>
                                                                        <option value="">انتخاب دسته‌بندی
                                                                        </option>
                                                                        <option value="fps">بازی‌های تیراندازی اول
                                                                            شخص</option>
                                                                        <option value="mmo">بازی‌های آنلاین چند نفره
                                                                        </option>
                                                                        <option value="strategy">بازی‌های استراتژیک
                                                                        </option>
                                                                        <option value="survival">بازی‌های بقا</option>
                                                                        <option value="other">سایر بازی‌ها</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="game-name">نام بازی</label>
                                                                    <select class="form-control" id="game-name"
                                                                        required disabled>
                                                                        <option value="">ابتدا دسته‌بندی را
                                                                            انتخاب کنید</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions mt-4">
                                                        <div class="d-flex justify-content-end">
                                                            <button type="button" class="btn-main next-step"
                                                                data-next="2">
                                                                ادامه
                                                                <i class="fa fa-arrow-left ms-2"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Step 2: Advertisement Details -->
                                                <div class="form-step d-none" data-step="2">
                                                    <div class="advertisement-details">
                                                        <h4 class="mb-3">اطلاعات آگهی</h4>
                                                        <div class="row g-3">
                                                            <!-- عنوان آگهی -->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="title">عنوان آگهی</label>
                                                                    <input type="text" class="form-control"
                                                                        id="title"
                                                                        placeholder="عنوان آگهی را وارد کنید" required>
                                                                    <small class="form-text text-muted">عنوان باید
                                                                        کوتاه و گویا باشد</small>
                                                                </div>
                                                            </div>
                                                            <!-- نوع آگهی -->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="ad-type">نوع آگهی</label>
                                                                    <select class="form-control" id="ad-type"
                                                                        required>
                                                                        <option value="">انتخاب نوع آگهی</option>
                                                                        <option value="server">سرور اختصاصی</option>
                                                                        <option value="vps">سرور مجازی</option>
                                                                        <option value="hosting">هاستینگ</option>
                                                                        <option value="domain">دامنه</option>
                                                                        <option value="other">سایر خدمات</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <!-- توضیحات -->
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="description">توضیحات</label>
                                                                    <textarea class="form-control" id="description" rows="6" placeholder="توضیحات کامل آگهی را وارد کنید"
                                                                        required></textarea>
                                                                    <small class="form-text text-muted">حداقل 100
                                                                        کاراکتر</small>
                                                                </div>
                                                            </div>
                                                            <!-- قیمت -->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="price">قیمت (تومان)</label>
                                                                    <div class="input-group">
                                                                        <input type="number" class="form-control"
                                                                            id="price"
                                                                            placeholder="قیمت را وارد کنید" required>
                                                                        <span class="input-group-text">تومان</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- تخفیف -->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="discount">تخفیف (%)</label>
                                                                    <input type="number" class="form-control"
                                                                        id="discount"
                                                                        placeholder="درصد تخفیف را وارد کنید"
                                                                        min="0" max="100">
                                                                </div>
                                                            </div>
                                                            <!-- مدت زمان نمایش -->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="duration">مدت زمان نمایش</label>
                                                                    <select class="form-control" id="duration"
                                                                        required>
                                                                        <option value="">انتخاب مدت زمان</option>
                                                                        <option value="7">7 روز</option>
                                                                        <option value="15">15 روز</option>
                                                                        <option value="30">30 روز</option>
                                                                        <option value="60">60 روز</option>
                                                                    </select>
                                                                    <small class="form-text text-muted">آگهی پس از
                                                                        اتمام مدت زمان به صورت خودکار غیرفعال
                                                                        می‌شود</small>
                                                                </div>
                                                            </div>
                                                            <!-- وضعیت موجودی -->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="stock-status">وضعیت موجودی</label>
                                                                    <select class="form-control" id="stock-status"
                                                                        required>
                                                                        <option value="in_stock">موجود</option>
                                                                        <option value="out_of_stock">ناموجود</option>
                                                                        <option value="pre_order">پیش‌فروش</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <!-- تصاویر -->
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label>تصاویر آگهی</label>
                                                                    <div class="image-upload-area">
                                                                        <div class="upload-box">
                                                                            <i class="fa fa-cloud-upload-alt"></i>
                                                                            <span>تصاویر را اینجا رها کنید یا کلیک
                                                                                کنید</span>
                                                                            <small>حداکثر 5 تصویر - هر تصویر حداکثر
                                                                                2MB</small>
                                                                        </div>
                                                                        <input type="file" id="images" multiple
                                                                            accept="image/*" class="d-none">
                                                                    </div>
                                                                    <div class="image-preview mt-3"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions mt-4">
                                                        <div class="d-flex justify-content-between">
                                                            <button type="button"
                                                                class="btn-main btn-secondary prev-step"
                                                                data-prev="1">
                                                                <i class="fa fa-arrow-right me-2"></i>
                                                                بازگشت
                                                            </button>
                                                            <button type="button" class="btn-main next-step"
                                                                data-next="3">
                                                                ادامه
                                                                <i class="fa fa-arrow-left ms-2"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Step 3: Contact Information -->
                                                <div class="form-step d-none" data-step="3">
                                                    <div class="contact-information">
                                                        <h4 class="mb-3">اطلاعات تماس</h4>
                                                        <div class="row g-3">
                                                            <!-- نام تماس -->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="contact-name">نام تماس</label>
                                                                    <input type="text" class="form-control"
                                                                        id="contact-name"
                                                                        placeholder="نام خود را وارد کنید" required>
                                                                </div>
                                                            </div>
                                                            <!-- شماره تماس -->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="contact-phone">شماره تماس</label>
                                                                    <input type="tel" class="form-control"
                                                                        id="contact-phone"
                                                                        placeholder="شماره موبایل خود را وارد کنید"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <!-- ایمیل -->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="contact-email">ایمیل</label>
                                                                    <input type="email" class="form-control"
                                                                        id="contact-email"
                                                                        placeholder="ایمیل خود را وارد کنید" required>
                                                                </div>
                                                            </div>
                                                            <!-- تلگرام (اختیاری) -->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="contact-telegram">نام کاربری تلگرام
                                                                        (اختیاری)</label>
                                                                    <input type="text" class="form-control"
                                                                        id="contact-telegram" placeholder="@username">
                                                                    <small class="form-text text-muted">بدون @ وارد
                                                                        کنید</small>
                                                                </div>
                                                            </div>
                                                            <!-- توضیحات تکمیلی -->
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <label for="contact-notes">توضیحات تکمیلی
                                                                        (اختیاری)</label>
                                                                    <textarea class="form-control" id="contact-notes" rows="3" placeholder="توضیحات تکمیلی خود را وارد کنید"></textarea>
                                                                </div>
                                                            </div>
                                                            <!-- قوانین و مقررات -->
                                                            <div class="col-12">
                                                                <div class="form-check">
                                                                    <input type="checkbox" class="form-check-input"
                                                                        id="terms" required>
                                                                    <label class="form-check-label" for="terms">
                                                                        با <a href="#" target="_blank">قوانین و
                                                                            مقررات</a> سایت موافقم
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions mt-4">
                                                        <div class="d-flex justify-content-between">
                                                            <button type="button"
                                                                class="btn-main btn-secondary prev-step"
                                                                data-prev="2">
                                                                <i class="fa fa-arrow-right me-2"></i>
                                                                بازگشت
                                                            </button>
                                                            <button type="submit" class="btn-main">
                                                                ثبت نهایی آگهی
                                                                <i class="fa fa-check ms-2"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Settings Section -->
                                <div id="settings" class="dashboard-section d-none">
                                    <div class="dashboard-content">
                                        <div class="dashboard-header">
                                            <h2>تنظیمات</h2>
                                            <div class="header-actions">
                                                <a href="#dashboard" class="btn-main btn-secondary">
                                                    <i class="fa fa-arrow-right"></i>
                                                    بازگشت به داشبورد
                                                </a>
                                            </div>
                                        </div>
                                        <div class="settings-section">
                                            <!-- تنظیمات اعلان‌ها -->
                                            <div class="settings-card">
                                                <h4>تنظیمات اعلان‌ها</h4>
                                                <div class="settings-content">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="notify-email" checked>
                                                        <label class="form-check-label" for="notify-email">
                                                            دریافت اعلان‌ها از طریق ایمیل
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="notify-sms" checked>
                                                        <label class="form-check-label" for="notify-sms">
                                                            دریافت اعلان‌ها از طریق پیامک
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="notify-browser" checked>
                                                        <label class="form-check-label" for="notify-browser">
                                                            دریافت اعلان‌های مرورگر
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- تنظیمات امنیت -->
                                            <div class="settings-card">
                                                <h4>تنظیمات امنیت</h4>
                                                <div class="settings-content">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="two-factor">
                                                        <label class="form-check-label" for="two-factor">
                                                            احراز هویت دو مرحله‌ای
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="login-notify" checked>
                                                        <label class="form-check-label" for="login-notify">
                                                            اطلاع‌رسانی ورود به حساب
                                                        </label>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <label for="session-timeout">زمان خروج خودکار (دقیقه)</label>
                                                        <select class="form-control" id="session-timeout">
                                                            <option value="30">30 دقیقه</option>
                                                            <option value="60" selected>1 ساعت</option>
                                                            <option value="120">2 ساعت</option>
                                                            <option value="240">4 ساعت</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- تنظیمات حساب کاربری -->
                                            <div class="settings-card">
                                                <h4>تنظیمات حساب کاربری</h4>
                                                <div class="settings-content">
                                                    <div class="form-group">
                                                        <label for="language">زبان پیش‌فرض</label>
                                                        <select class="form-control" id="language">
                                                            <option value="fa" selected>فارسی</option>
                                                            <option value="en">English</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="timezone">منطقه زمانی</label>
                                                        <select class="form-control" id="timezone">
                                                            <option value="Asia/Tehran" selected>تهران (GMT+3:30)
                                                            </option>
                                                            <option value="UTC">UTC</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="dark-mode" checked>
                                                        <label class="form-check-label" for="dark-mode">
                                                            حالت تاریک
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- تنظیمات حریم خصوصی -->
                                            <div class="settings-card">
                                                <h4>تنظیمات حریم خصوصی</h4>
                                                <div class="settings-content">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="profile-public" checked>
                                                        <label class="form-check-label" for="profile-public">
                                                            نمایش پروفایل برای عموم
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="show-email" checked>
                                                        <label class="form-check-label" for="show-email">
                                                            نمایش ایمیل در پروفایل
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="show-phone">
                                                        <label class="form-check-label" for="show-phone">
                                                            نمایش شماره تماس در پروفایل
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions mt-4">
                                                <button type="button" class="btn-main" id="save-settings">
                                                    <i class="fa fa-save"></i>
                                                    ذخیره تنظیمات
                                                </button>
                                                <button type="button" class="btn-main btn-secondary"
                                                    id="reset-settings">
                                                    <i class="fa fa-undo"></i>
                                                    بازنشانی تنظیمات
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- section close -->
        </div>
        <!-- content close -->
        <!-- footer begin -->
        <footer>
            <div class="container">
                <div class="row gx-5">
                    <div class="col-lg-4">
                        <img src="images/logo.png" alt="روشاک" class="footer-logo">
                        <div class="spacer-20"></div>
                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است،
                            چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی
                            تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.</p>
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <div class="widget">
                                    <h5> سرور بازی</h5>
                                    <ul>
                                        <li><a href="#">تندر و شهر</a></li>
                                        <li><a href="#">مسابقه مرموز الف</a></li>
                                        <li><a href="#">خشم خاموش</a></li>
                                        <li><a href="#">سیاهچال فانک</a></li>
                                        <li><a href="#">اودیسه کهکشانی</a></li>
                                        <li><a href="#">افسانه جنگ</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="widget">
                                    <h5>صفحات</h5>
                                    <ul>
                                        <li><a href="#"> سرور بازی</a></li>
                                        <li><a href="#">پایگاه دانش</a></li>
                                        <li><a href="#">درباره ما</a></li>
                                        <li><a href="#">بازاریابی</a></li>
                                        <li><a href="#">مکان ها</a></li>
                                        <li><a href="#">اخبار</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="widget">
                            <h5>خبرنامه</h5>
                            <form action="blank.php" class="row form-dark" id="form_subscribe" method="post"
                                name="form_subscribe">
                                <div class="col text-center">
                                    <a href="#" id="btn-subscribe"><i
                                            class="arrow_left bg-color-secondary"></i></a> <input class="form-control"
                                        id="txt_subscribe" name="txt_subscribe" placeholder="ایمیل خود را وارد کنید"
                                        type="text">
                                    <div class="clearfix"></div>
                                </div>
                            </form>
                            <div class="spacer-10"></div>
                            <small>ایمیل شما نزد ما محفوظ است. ما اسپم نمی کنیم.</small>
                            <div class="spacer-30"></div>
                            <div class="widget">
                                <h5>ما را دنبال کنید</h5>
                                <div class="social-icons">
                                    <a href="#" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a>
                                    <a href="#" class="social-icon"><i class="fa-brands fa-twitter"></i></a>
                                    <a href="#" class="social-icon"><i class="fa-brands fa-discord"></i></a>
                                    <a href="#" class="social-icon"><i class="fa-brands fa-tiktok"></i></a>
                                    <a href="#" class="social-icon"><i class="fa-brands fa-youtube"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="subfooter">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            کپی رایت 2024 - طراحی شده توسط روشاک
                        </div>
                        <div class="col-lg-6 col-sm-6 text-lg-end text-sm-start">
                            <ul class="menu-simple">
                                <li><a href="#">شرایط &amp; قوانین</a></li>
                                <li><a href="#">سیاست حفظ حریم خصوصی</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer close -->
    </div>
    <!-- Javascript Files -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/easing.js"></script>
    <script src="js/owl.carousel.js"></script>
    <script src="js/jquery.countTo.js"></script>
    <script src="js/validation.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/enquire.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.plugin.js"></script>
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/designesia.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/swiper.js"></script>
    <script src="js/custom-marquee.js"></script>
    <script src="js/custom-swiper-1.js"></script>
    <script>
        $(document).ready(function() {
            // Toggle mobile menu
            $('.menu-btn').click(function(e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).toggleClass('active');
                $('.mobile-sidebar').toggleClass('active');
                $('.mobile-menu-overlay').toggleClass('active');
                $('body').toggleClass('menu-open');
            });

            // Close menu when clicking overlay
            $('.mobile-menu-overlay').click(function() {
                $('.menu-btn').removeClass('active');
                $('.mobile-sidebar').removeClass('active');
                $('.mobile-menu-overlay').removeClass('active');
                $('body').removeClass('menu-open');
            });

            // Section switching functionality
            function switchSection(sectionId) {
                $('.dashboard-section').removeClass('active').addClass('d-none');
                $(sectionId).addClass('active').removeClass('d-none');
                // Hide all modals if any are open
                $('.modal').removeClass('show').attr('aria-hidden', 'true').css('display', 'none');
                $('.modal-backdrop').remove();
                // Hide mobile menu overlay if open
                $('.mobile-menu-overlay').removeClass('active');
                $('body').removeClass('menu-open');
                // Update active menu item
                $('.sidebar-menu li').removeClass('active');
                $('.sidebar-menu li a[href="' + sectionId + '"]').parent().addClass('active');
            }

            // Handle menu item clicks
            $('.sidebar-menu a').click(function(e) {
                e.preventDefault();
                const sectionId = $(this).attr('href');
                switchSection(sectionId);
                // Close mobile menu if open
                if ($('.mobile-sidebar').hasClass('active')) {
                    $('.menu-btn').removeClass('active');
                    $('.mobile-sidebar').removeClass('active');
                    $('.mobile-menu-overlay').removeClass('active');
                    $('body').removeClass('menu-open');
                }
            });

            // Handle direct button clicks (like "ویرایش پروفایل" button)
            $('.header-actions a').click(function(e) {
                e.preventDefault();
                const sectionId = $(this).attr('href');
                switchSection(sectionId);
            });

            // Initialize with dashboard section
            $('.dashboard-section').removeClass('active').addClass('d-none');
            $('#dashboard').addClass('active').removeClass('d-none');

            // Improved Button Ripple Effect
            $('.dashboard-header .header-actions .btn').on('mousedown', function(e) {
                if ('ontouchstart' in window) return; // Skip on touch devices
                const button = $(this);
                const ripple = $('<span class="ripple"></span>');
                const rect = button[0].getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                ripple.css({
                    width: size,
                    height: size,
                    left: x,
                    top: y
                });
                button.append(ripple);
                ripple.on('animationend', function() {
                    ripple.remove();
                });
            });

            // Prevent ripple effect on touch devices
            if ('ontouchstart' in window) {
                $('.dashboard-header .header-actions .btn').off('mousedown');
            }

            // Button Loading State (for future use)
            function setButtonLoading(button, isLoading) {
                if (isLoading) {
                    button.addClass('loading');
                    button.prop('disabled', true);
                } else {
                    button.removeClass('loading');
                    button.prop('disabled', false);
                }
            }

            // Image Upload Handling
            const imageUploadArea = $('.image-upload-area');
            const imageInput = $('#images');
            const imagePreview = $('.image-preview');
            const maxFiles = 5;
            const maxFileSize = 2 * 1024 * 1024; // 2MB

            // Simple image upload
            imageUploadArea.on('click', function() {
                imageInput.click();
            });

            imageInput.on('change', function() {
                const files = this.files;
                if (files.length > maxFiles) {
                    alert(`حداکثر ${maxFiles} تصویر مجاز است`);
                    return;
                }

                Array.from(files).forEach(file => {
                    if (!file.type.startsWith('image/')) {
                        alert('فقط فایل‌های تصویری مجاز هستند');
                        return;
                    }
                    if (file.size > maxFileSize) {
                        alert('حجم هر تصویر نباید بیشتر از 2MB باشد');
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewItem = $(`
                            <div class="image-preview-item">
                                <img src="${e.target.result}" alt="تصویر آگهی">
                                <button type="button" class="remove-image" title="حذف تصویر">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        `);
                        imagePreview.append(previewItem);
                    };
                    reader.readAsDataURL(file);
                });
            });

            // Remove image preview
            imagePreview.on('click', '.remove-image', function() {
                $(this).parent().remove();
            });

            // Character counter for description
            $('#description').on('input', function() {
                const length = $(this).val().length;
                const minLength = 30; // کاهش حداقل کاراکتر به 30
                const counter = $(this).next('.form-text');
                if (length < minLength) {
                    counter.text(`${minLength - length} کاراکتر دیگر نیاز است`);
                    counter.removeClass('text-success').addClass('text-warning');
                } else {
                    counter.text('توضیحات کافی است');
                    counter.removeClass('text-warning').addClass('text-success');
                }
            });

            // Form validation
            function validateStep(step) {
                let isValid = true;
                let errorMessage = '';

                switch (step) {
                    case 1:
                        // Validate game selection
                        if (!$('#game-category').val() || !$('#game-name').val()) {
                            errorMessage = 'لطفاً دسته‌بندی و نام بازی را انتخاب کنید';
                            isValid = false;
                        }
                        break;
                    case 2:
                        // Validate advertisement details
                        if (!$('#title').val()) {
                            errorMessage = 'لطفاً عنوان آگهی را وارد کنید';
                            isValid = false;
                        } else if (!$('#ad-type').val()) {
                            errorMessage = 'لطفاً نوع آگهی را انتخاب کنید';
                            isValid = false;
                        } else if (!$('#description').val() || $('#description').val().length <
                            30) { // کاهش حداقل کاراکتر به 30
                            errorMessage = 'توضیحات باید حداقل 30 کاراکتر باشد';
                            isValid = false;
                        } else if (!$('#price').val() || parseInt($('#price').val()) <= 0) {
                            errorMessage = 'لطفاً قیمت معتبر وارد کنید';
                            isValid = false;
                        } else if (!$('#duration').val()) {
                            errorMessage = 'لطفاً مدت زمان نمایش را انتخاب کنید';
                            isValid = false;
                        }
                        break;
                    case 3:
                        // Validate contact information
                        if (!$('#contact-name').val()) {
                            errorMessage = 'لطفاً نام تماس را وارد کنید';
                            isValid = false;
                        } else if (!$('#contact-phone').val()) {
                            errorMessage = 'لطفاً شماره تماس را وارد کنید';
                            isValid = false;
                        } else if (!$('#contact-email').val()) {
                            errorMessage = 'لطفاً ایمیل را وارد کنید';
                            isValid = false;
                        } else if (!$('#terms').is(':checked')) {
                            errorMessage = 'لطفاً با قوانین و مقررات موافقت کنید';
                            isValid = false;
                        }
                        break;
                }

                if (!isValid) {
                    alert(errorMessage);
                }

                return isValid;
            }

            // Form submission
            $('.advertisement-form').on('submit', function(e) {
                e.preventDefault();
                const priceInput = $('#price');
                const value = priceInput.val();
                if (value) {
                    priceInput.val(parseInt(value).toLocaleString('fa-IR'));
                }
                alert('آگهی با موفقیت ثبت شد');
            });

            // Reset form
            $('.advertisement-form button[type="reset"]').on('click', function() {
                imagePreview.empty();
                $('#price').val('');
            });

            // Advertisement Form Steps
            const gameCategories = {
                fps: ['Counter-Strike 2', 'Valorant', 'Call of Duty', 'Apex Legends', 'PUBG'],
                mmo: ['World of Warcraft', 'Final Fantasy XIV', 'Black Desert Online', 'Elder Scrolls Online',
                    'Lost Ark'
                ],
                strategy: ['Age of Empires IV', 'Civilization VI', 'Total War: Warhammer III', 'Starcraft II',
                    'Company of Heroes 3'
                ],
                survival: ['ARK: Survival Evolved', 'Rust', 'DayZ', '7 Days to Die', 'The Forest'],
                other: ['Minecraft', 'Terraria', 'Factorio', 'Space Engineers', 'Satisfactory']
            };

            // Handle game category change
            $('#game-category').on('change', function() {
                const category = $(this).val();
                const gameSelect = $('#game-name');
                gameSelect.empty().prop('disabled', !category);

                if (category) {
                    gameSelect.append('<option value="">انتخاب بازی</option>');
                    gameCategories[category].forEach(game => {
                        gameSelect.append(
                            `<option value="${game.toLowerCase().replace(/\s+/g, '-')}">${game}</option>`
                        );
                    });
                } else {
                    gameSelect.append('<option value="">ابتدا دسته‌بندی را انتخاب کنید</option>');
                }
            });

            // Handle step navigation
            $('.next-step').on('click', function() {
                const currentStep = $(this).closest('.form-step');
                const nextStepNum = $(this).data('next');
                const nextStep = $(`.form-step[data-step="${nextStepNum}"]`);

                // Validate current step
                if (!validateStep(currentStep.data('step'))) {
                    return;
                }

                // Update progress
                $('.step-progress .step').removeClass('active');
                $(`.step-progress .step[data-step="${nextStepNum}"]`).addClass('active');

                // Show next step
                currentStep.removeClass('active').addClass('d-none');
                nextStep.removeClass('d-none').addClass('active');
            });

            $('.prev-step').on('click', function() {
                const currentStep = $(this).closest('.form-step');
                const prevStepNum = $(this).data('prev');
                const prevStep = $(`.form-step[data-step="${prevStepNum}"]`);

                // Update progress
                $('.step-progress .step').removeClass('active');
                $(`.step-progress .step[data-step="${prevStepNum}"]`).addClass('active');

                // Show previous step
                currentStep.removeClass('active').addClass('d-none');
                prevStep.removeClass('d-none').addClass('active');
            });
        });
    </script>
</body>

</html>

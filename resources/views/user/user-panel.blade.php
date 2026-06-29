<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل کاربری</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
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

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        /* Alert Message */
        .alert-message {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            border: 1px solid;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
        }

        .alert-message.success {
            background: rgba(16, 185, 129, 0.1);
            color: #34d399;
            border-color: rgba(16, 185, 129, 0.3);
        }

        .alert-message.error {
            background: rgba(239, 68, 68, 0.1);
            color: #f87171;
            border-color: rgba(239, 68, 68, 0.3);
        }

        .alert-message i {
            font-size: 20px;
        }

        /* Header Section */
        .user-header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border);
        }

        .user-header h1 {
            margin: 0 0 10px 0;
            font-size: 28px;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -0.02em;
        }

        .welcome-text {
            color: var(--muted);
            font-size: 16px;
        }

        .welcome-text span {
            color: var(--accent);
            font-weight: 600;
        }

        /* Grid Layout */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
        }

        /* Menu Card */
        .menu-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 25px 20px;
            text-align: center;
            text-decoration: none;
            color: var(--text);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 15px;
            cursor: pointer;
        }

        .menu-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, var(--accent), var(--accent-2));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent-2);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
            background: rgba(17, 24, 39, 0.8);
        }

        .menu-card:hover::before {
            opacity: 0.7;
        }

        .menu-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: rgba(167, 139, 250, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--accent-2);
            transition: all 0.3s ease;
        }

        .menu-card:hover .menu-icon {
            background: rgba(167, 139, 250, 0.2);
            transform: scale(1.1);
        }

        .menu-title {
            font-size: 16px;
            font-weight: 600;
        }

        /* Wallet Specific Style */
        .wallet-card .menu-icon {
            background: rgba(34, 211, 238, 0.1);
            color: var(--accent);
        }

        .wallet-card:hover .menu-icon {
            background: rgba(34, 211, 238, 0.2);
        }

        .wallet-amount {
            font-size: 18px;
            font-weight: 700;
            color: var(--success);
            margin-top: 5px;
        }

        .wallet-hint {
            font-size: 11px;
            color: var(--muted);
            margin-top: -5px;
        }

        /* Role Card */
        .role-card .menu-icon {
            background: rgba(167, 139, 250, 0.15);
            color: var(--accent-2);
        }

        .role-card .role-name {
            font-size: 18px;
            font-weight: 700;
            color: var(--accent);
            margin-top: 5px;
        }

        .role-card .role-hint {
            font-size: 11px;
            color: var(--muted);
            margin-top: -5px;
        }

        /* Seller Request Status Card */
        .request-card .menu-icon {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .request-card .request-status {
            font-size: 16px;
            font-weight: 700;
            margin-top: 5px;
            padding: 4px 14px;
            border-radius: 20px;
            display: inline-block;
        }

        .request-status.pending {
            color: #fbbf24;
            background: rgba(245, 158, 11, 0.15);
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .request-status.approved {
            color: #34d399;
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .request-status.rejected {
            color: #f87171;
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .request-status.none {
            color: var(--muted);
            background: rgba(148, 163, 184, 0.1);
            border: 1px solid rgba(148, 163, 184, 0.2);
        }

        .btn-retry {
            margin-top: 10px;
            padding: 8px 20px;
            border-radius: 8px;
            border: none;
            background: linear-gradient(135deg, var(--accent-2), #8b5cf6);
            color: white;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 4px 15px -3px rgba(167, 139, 250, 0.4);
        }

        .btn-retry:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px -3px rgba(167, 139, 250, 0.6);
        }

        /* Notification Badge */
        .notification-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: var(--danger);
            color: white;
            font-size: 11px;
            font-weight: 700;
            min-width: 20px;
            height: 20px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 6px;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Logout Button Specific */
        .logout-card {
            border-color: rgba(239, 68, 68, 0.3);
        }

        .logout-card .menu-icon {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
        }

        .logout-card:hover {
            border-color: var(--danger);
        }

        .logout-card:hover .menu-icon {
            background: rgba(239, 68, 68, 0.2);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .dashboard-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- نمایش پیام وضعیت درخواست فروشندگی -->
        @if (session('seller_request_message'))
            <div class="alert-message {{ session('seller_request_status') == 'approved' ? 'success' : 'error' }}">
                <i
                    class="fas {{ session('seller_request_status') == 'approved' ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                {{ session('seller_request_message') }}
            </div>
        @endif

        <!-- Header -->
        <div class="user-header">
            <h1>پنل کاربری</h1>
            <div class="welcome-text">
                خوش آمدید، <span>{{ Auth::user()->name ?? 'کاربر گرامی' }}</span>
            </div>
        </div>

        <!-- Dashboard Grid -->
        <div class="dashboard-grid">

            <!-- نمایش نقش کاربر -->
            <div class="menu-card role-card">
                <div class="menu-icon">
                    <i
                        class="fas {{ match (Auth::user()->role) {
                            'super_admin' => 'fa-crown',
                            'admin' => 'fa-user-shield',
                            'seller' => 'fa-store',
                            'buyer' => 'fa-shopping-bag',
                            'user' => 'fa-user',
                            default => 'fa-user',
                        } }}"></i>
                </div>
                <div>
                    <div class="menu-title">نقش شما</div>
                    <div class="role-name">
                        {{ match (Auth::user()->role) {
                            'super_admin' => 'سوپر ادمین',
                            'admin' => 'ادمین',
                            'seller' => 'فروشنده',
                            'buyer' => 'خریدار',
                            'user' => 'کاربر عادی',
                            default => Auth::user()->role,
                        } }}
                    </div>
                    <div class="role-hint">وضعیت فعلی حساب شما</div>
                </div>
            </div>

            <!-- وضعیت درخواست فروشندگی -->
            <div class="menu-card request-card">
                <div class="menu-icon">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <div>
                    <div class="menu-title">وضعیت درخواست فروشندگی</div>
                    <div class="request-status {{ Auth::user()->seller_request_status ?? 'none' }}">
                        {{ Auth::user()->getSellerRequestStatusText() }}
                    </div>
                    @if (Auth::user()->seller_request_status == 'rejected')
                        <a href="{{ route('seller.product.request.index') }}" class="btn-retry">
                            <i class="fas fa-redo"></i>
                            درخواست مجدد
                        </a>
                    @elseif(Auth::user()->seller_request_status == 'none' && !Auth::user()->isSeller())
                        <div style="margin-top: 8px; font-size: 12px; color: var(--muted);">
                            برای ثبت درخواست، به بخش «درخواست فروشندگی» بروید.
                        </div>
                    @elseif(Auth::user()->isSeller())
                        <div style="margin-top: 8px; font-size: 12px; color: var(--success);">
                            <i class="fas fa-check-circle"></i> شما فروشنده هستید
                        </div>
                    @endif
                </div>
            </div>

            <!-- Wallet (Clickable) -->
            <a href="{{ route('wallet.charge') }}" class="menu-card wallet-card">
                <div class="menu-icon">
                    <i class="fas fa-wallet"></i>
                </div>
                <div>
                    <div class="menu-title">موجودی کیف پول</div>
                    <div class="wallet-amount">{{ number_format(Auth::user()->balance ?? 0) }} تومان</div>
                    <div class="wallet-hint">برای شارژ کلیک کنید</div>
                </div>
            </a>

            <!-- History -->
            <a href="{{ route('wallet.history') }}" class="menu-card">
                <div class="menu-icon">
                    <i class="fas fa-history"></i>
                </div>
                <div class="menu-title">تاریخچه تراکنش‌ها</div>
            </a>

            <!-- My Purchases -->
            <a href="{{ route('user.purchases') }}" class="menu-card">
                <div class="notification-badge">3</div>
                <div class="menu-icon">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="menu-title">خریدهای من</div>
            </a>

            <!-- Cart -->
            <a href="{{ route('cart.index') }}" class="menu-card">
                <div class="notification-badge">2</div>
                <div class="menu-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="menu-title">سبد خرید</div>
            </a>

            <!-- Seller Request (New Wizard) -->
            @if (
                !Auth::user()->isSeller() &&
                    Auth::user()->seller_request_status != 'pending' &&
                    Auth::user()->seller_request_status != 'approved')
                <a href="{{ route('seller.product.request.index') }}" class="menu-card">
                    <div class="menu-icon">
                        <i class="fas fa-store"></i>
                    </div>
                    <div class="menu-title">درخواست فروشندگی</div>
                </a>
            @elseif(Auth::user()->seller_request_status == 'pending')
                <div class="menu-card" style="cursor: default; opacity: 0.6;">
                    <div class="menu-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="menu-title">در انتظار بررسی</div>
                    <div style="font-size: 12px; color: var(--muted);">درخواست شما در حال بررسی است</div>
                </div>
            @endif

            <!--ثبت آگهی -->
            @if (Auth::user()->seller_request_status !== 'none' || Auth::user()->isSeller())
                <a href="{{ route('seller.product.create') }}" class="menu-card">
                    <div class="menu-icon">
                        <i class="fas fa-plus-circle"></i>
                    </div>
                    <div class="menu-title">ثبت آگهی جدید</div>
                </a>
            @endif

            <!-- My Ads -->
            <a href="{{ route('user.ads') }}" class="menu-card">
                <div class="menu-icon">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <div class="menu-title">آگهی‌های من</div>
            </a>

            <!-- Chat -->
            <a href="{{ route('user.chat') }}" class="menu-card">
                <div class="notification-badge">5</div>
                <div class="menu-icon">
                    <i class="fas fa-comments"></i>
                </div>
                <div class="menu-title">پیام‌ها و چت</div>
            </a>

            <!-- Edit Profile -->
            <a href="{{ route('user.profile.edit') }}" class="menu-card">
                <div class="menu-icon">
                    <i class="fas fa-user-edit"></i>
                </div>
                <div class="menu-title">ویرایش اطلاعات</div>
            </a>

            <!-- Logout -->
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="menu-card logout-card">
                <div class="menu-icon">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
                <div class="menu-title">خروج از حساب</div>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

        </div>
    </div>

</body>

</html>

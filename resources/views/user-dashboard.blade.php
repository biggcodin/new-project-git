<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>پروفایل من</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        :root {
            --primary: #a833ff;
            --primary-dark: #541cb5;
            --secondary: #ff7fff;
            --accent: #ff3cac;
            --text: #ffffff;
            --text-light: #cccccc;
            --bg-dark: #120e2b;
            --bg-card: #1c1938;
            --bg-element: #1e1b3a;
            --gold: #ffcc00;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text);
            padding-bottom: 70px;
        }

        .container {
            padding: 16px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* هدر پروفایل */
        .profile-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 4px 20px rgba(168, 51, 255, 0.3);
            position: relative;
            overflow: hidden;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            z-index: 0;
        }

        .profile-info {
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
            z-index: 1;
        }

        .profile-pic {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            border: 2px solid var(--secondary);
            object-fit: cover;
            background: #222;
            transition: transform 0.3s ease;
        }

        .profile-pic:hover {
            transform: scale(1.05);
        }

        .profile-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .profile-rating {
            color: var(--gold);
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* کارت‌ها */
        .cards-wrapper {
            display: grid;
            grid-template-columns: 1fr;
            gap: 15px;
        }

        @media (min-width: 768px) {
            .cards-wrapper {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .card-box {
            background-color: var(--bg-card);
            border-radius: 16px;
            padding: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .card-box h4 {
            margin-bottom: 12px;
            font-size: 16px;
            color: var(--secondary);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-box h4 i {
            font-size: 18px;
        }

        .card-option {
            padding: 10px 0;
            border-bottom: 1px solid #2e2b4d;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: var(--text-light);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .card-option:last-child {
            border-bottom: none;
        }

        .card-option:hover {
            color: var(--text);
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            padding: 10px 8px;
        }

        .card-option-content {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-option i:first-child {
            color: var(--gold);
            font-size: 16px;
            width: 20px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .card-option:hover i:first-child {
            transform: scale(1.2);
        }

        .card-option i:last-child {
            color: rgba(255, 255, 255, 0.3);
            font-size: 12px;
            transition: all 0.3s ease;
        }

        .card-option:hover i:last-child {
            color: var(--text);
            transform: translateX(-5px);
        }

        .badge-new {
            background: var(--accent);
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 10px;
            margin-right: 5px;
        }

        /* سایر عناصر */
        .wallet-box {
            margin: 15px 0;
            background: var(--bg-element);
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 14px;
        }

        .wallet-box strong {
            color: var(--secondary);
        }

        .discord-link {
            margin: 15px 0;
            background-color: #5865F2;
            border-radius: 12px;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .discord-link:hover {
            background-color: #4752c4;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(88, 101, 242, 0.4);
        }

        .discord-link i {
            margin-left: 8px;
            font-size: 18px;
        }

        /* فرم */
        .track-form {
            margin-top: 12px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .track-form input {
            padding: 10px 12px;
            border-radius: 8px;
            border: none;
            font-size: 14px;
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--text);
            transition: all 0.3s ease;
        }

        .track-form input:focus {
            outline: none;
            background-color: rgba(255, 255, 255, 0.15);
            box-shadow: 0 0 0 2px var(--primary);
        }

        .track-form button {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .track-form button:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(168, 51, 255, 0.4);
        }

        /* وضعیت خالی */
        .empty-state {
            text-align: center;
            padding: 20px;
            background-color: #2a254a;
            border-radius: 12px;
            margin-top: 12px;
            color: var(--text-light);
        }

        .empty-state i {
            font-size: 40px;
            color: #888;
            margin-bottom: 10px;
        }

        /* فوتر */
        footer {
            position: fixed;
            bottom: 0;
            right: 0;
            left: 0;
            background-color: var(--bg-card);
            display: flex;
            justify-content: space-around;
            padding: 10px 0;
            z-index: 100;
            box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.3);
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        @media (min-width: 768px) {
            footer {
                display: none;
            }

            body {
                padding-bottom: 0;
            }
        }

        footer a {
            color: var(--text-light);
            text-decoration: none;
            font-size: 11px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            padding: 5px 10px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        footer a.active {
            color: var(--gold);
            transform: translateY(-5px);
        }

        footer a i {
            font-size: 18px;
            transition: all 0.3s ease;
        }

        footer a.active i {
            color: var(--gold);
            transform: scale(1.2);
        }

        /* انیمیشن‌ها */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-box {
            animation: fadeIn 0.5s ease forwards;
            opacity: 0;
        }

        .card-box:nth-child(1) {
            animation-delay: 0.1s;
        }

        .card-box:nth-child(2) {
            animation-delay: 0.2s;
        }

        .card-box:nth-child(3) {
            animation-delay: 0.3s;
        }

        .card-box:nth-child(4) {
            animation-delay: 0.4s;
        }

        .card-box:nth-child(5) {
            animation-delay: 0.5s;
        }

        /* افکت موجی برای دکمه‌ها */
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.4);
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        }

        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="profile-header">
            <div class="profile-info">
                <img src="https://via.placeholder.com/64" class="profile-pic" alt="پروفایل" />
                <div>
                    <div class="profile-name">Biggie Old2</div>
                    <div class="profile-rating">0.0 <i class="fas fa-star"></i></div>
                </div>
            </div>
        </div>

        <div class="wallet-box"><strong>موجودی کیف پول:</strong> $0.00</div>

        <a href="#" class="discord-link">
            <i class="fab fa-discord"></i> اتصال به دیسکورد - اخبار و به‌روزرسانی‌ها
        </a>

        <div class="cards-wrapper">
            <div class="card-box">
                <h4><i class="fas fa-chart-line"></i>داشبورد فروش</h4>
                <a href="#" class="card-option">
                    <div class="card-option-content">
                        <i class="fas fa-chart-line"></i>
                        داشبورد
                    </div>
                    <i class="fas fa-chevron-left"></i>
                </a>
                <h4><i class="fas fa-gamepad"></i>ثبت اکانت بازی</h4>
                <a href="{{ route('user.account.create') }}" class="card-option">
                    <div class="card-option-content">
                        <i class="fas fa-plus-circle"></i>
                        ثبت اکانت جدید
                    </div>
                    <i class="fas fa-chevron-left"></i>
                </a>
                <a href="#" class="card-option">
                    <div class="card-option-content">
                        <i class="fas fa-list"></i>
                        لیست من
                    </div>
                    <i class="fas fa-chevron-left"></i>
                </a>
                <a href="#" class="card-option">
                    <div class="card-option-content">
                        <i class="fas fa-credit-card"></i>
                        گزینه‌های پرداخت
                    </div>
                    <i class="fas fa-chevron-left"></i>
                </a>
            </div>

            <div class="card-box">
                <h4><i class="fas fa-user-cog"></i>پروفایل من</h4>
                <a href="#" class="card-option">
                    <div class="card-option-content">
                        <i class="fas fa-cog"></i>
                        ویرایش پروفایل
                    </div>
                    <i class="fas fa-chevron-left"></i>
                </a>
                <a href="#" class="card-option">
                    <div class="card-option-content">
                        <i class="fas fa-box"></i>
                        خریدهای من
                    </div>
                    <i class="fas fa-chevron-left"></i>
                </a>
                <a href="#" class="card-option">
                    <div class="card-option-content">
                        <i class="fas fa-heart"></i>
                        علاقه‌مندی‌ها
                    </div>
                    <i class="fas fa-chevron-left"></i>
                </a>
                <a href="#" class="card-option">
                    <div class="card-option-content">
                        <i class="fas fa-star"></i>
                        بازخوردها
                    </div>
                    <i class="fas fa-chevron-left"></i>
                </a>
                <a href="#" class="card-option">
                    <div class="card-option-content">
                        <i class="fas fa-users"></i>
                        همکاری در فروش
                        <span class="badge-new">جدید</span>
                    </div>
                    <i class="fas fa-chevron-left"></i>
                </a>
                <a href="#" class="card-option">
                    <div class="card-option-content">
                        <i class="fas fa-bell"></i>
                        اعلان‌ها
                    </div>
                    <i class="fas fa-chevron-left"></i>
                </a>
                <a href="#" class="card-option">
                    <div class="card-option-content">
                        <i class="fas fa-globe"></i>
                        زبان و ارز
                    </div>
                    <i class="fas fa-chevron-left"></i>
                </a>
            </div>

            <div class="card-box">
                <h4><i class="fas fa-search"></i>پیگیری سفارش</h4>
                <p style="font-size: 13px; color: var(--text-light); margin-bottom: 10px;">
                    برای پیگیری وضعیت سفارش خود، شماره سفارش و ایمیلی که با آن خرید انجام شده را وارد کنید.
                </p>
                <form class="track-form">
                    <input type="text" placeholder="شماره سفارش">
                    <input type="email" placeholder="ایمیل صورتحساب">
                    <button type="submit">ردیابی سفارش</button>
                </form>
                <div class="empty-state">
                    <i class="fas fa-search"></i>
                    <p>هیچ اطلاعاتی وارد نشده است</p>
                </div>
            </div>

            <div class="card-box">
                <h4><i class="fas fa-box-open"></i>آخرین سفارش</h4>
                <div class="empty-state">
                    <i class="fas fa-box-open"></i>
                    <p>شما هنوز سفارشی ثبت نکرده‌اید</p>
                </div>
            </div>

            <div class="card-box">
                <h4><i class="fas fa-headset"></i>پشتیبانی</h4>
                <a href="#" class="card-option">
                    <div class="card-option-content">
                        <i class="fas fa-question-circle"></i>
                        مرکز کمک
                    </div>
                    <i class="fas fa-chevron-left"></i>
                </a>
                <a href="#" class="card-option">
                    <div class="card-option-content">
                        <i class="fas fa-blog"></i>
                        وبلاگ
                    </div>
                    <i class="fas fa-chevron-left"></i>
                </a>
                <a href="#" class="card-option">
                    <div class="card-option-content">
                        <i class="fas fa-sign-out-alt"></i>
                        خروج
                    </div>
                    <i class="fas fa-chevron-left"></i>
                </a>
            </div>

            <div class="card-box">
                <h4><i class="fas fa-list"></i>آخرین اکانت‌ها</h4>
                @if (auth()->user()->products && auth()->user()->products->count() > 0)
                    @foreach (auth()->user()->products as $product)
                        <a href="#" class="card-option">
                            <div class="card-option-content">
                                <i class="fas fa-box"></i>
                                {{ $product->title }} - {{ number_format($product->price) }} تومان
                            </div>
                            <span class="badge bg-warning text-dark ms-auto">
                                {{ ucfirst($product->status ?? 'pending') }}
                            </span>
                        </a>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="fas fa-box-open"></i>
                        <p>هنوز اکانتی ثبت نکرده‌اید.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <footer>
        <a href="#"><i class="fas fa-home"></i>خانه</a>
        <a href="#"><i class="fas fa-search"></i>جستجو</a>
        <a href="#"><i class="fas fa-comment"></i>پیام</a>
        <a href="#" class="active"><i class="fas fa-user"></i>پروفایل</a>
    </footer>

    <script>
        // حذف انیمیشن کلیک و اجازه حرکت به لینک
        document.querySelectorAll('.card-option, .discord-link').forEach(link => {
            link.addEventListener('click', function(e) {
                // فقط لینک‌های HTML (<a>) را پردازش کن
                if (this.tagName === 'A' && this.getAttribute('href')) {
                    // اجازه حرکت به لینک
                    return true; // معادل عدم استفاده از preventDefault
                }
            });
        });



        // فعال کردن لینک‌های فوتر
        document.querySelectorAll('footer a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector('footer a.active').classList.remove('active');
                this.classList.add('active');
            });
        });
    </script>
</body>

</html>

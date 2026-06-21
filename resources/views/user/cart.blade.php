<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <title>سبد خرید - روشاک</title>
    <link rel="icon" href="images/icon.png" type="image/gif" sizes="16x16">
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Playhost - Game Hosting Website Template" name="description">
    <meta content="" name="keywords">
    <meta content="" name="author">
    <!-- CSS Files -->
    <link href="css/bootstrap.rtl.min.css" rel="stylesheet" type="text/css" id="bootstrap">
    <link href="css/plugins.css" rel="stylesheet" type="text/css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/coloring.css" rel="stylesheet" type="text/css">
    <!-- color scheme -->
    <link id="colors" href="css/colors/scheme-01.css" rel="stylesheet" type="text/css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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

        .cart-page {
            min-height: 100vh;
            position: relative;
            padding: 40px 0;
            overflow: hidden;
        }

        .jarallax {
            position: relative;
            z-index: 0;
        }

        .jarallax>.jarallax-img {
            display: none;
        }

        .de-gradient-edge-top,
        .de-gradient-edge-bottom {
            display: none;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            position: relative;
            z-index: 2;
        }

        .cart-container {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 30px;
            margin-bottom: 20px;
            backdrop-filter: blur(6px);
        }

        .cart-header {
            border-bottom: 1px solid var(--border);
            padding-bottom: 20px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -0.02em;
        }

        .cart-header .text-light {
            color: var(--muted);
            font-size: 14px;
        }

        .cart-header .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            color: var(--muted);
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border);
            transition: all 0.2s ease;
            font-size: 13px;
        }

        .cart-header .btn-back:hover {
            color: var(--text);
            border-color: var(--accent-2);
            background: rgba(167, 139, 250, 0.1);
        }

        .cart-item {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
            position: relative;
        }

        .cart-item:hover {
            background: rgba(167, 139, 250, 0.05);
            border-color: var(--accent-2);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
        }

        .cart-item img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid var(--border);
        }

        .cart-item h4 {
            color: var(--text);
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .cart-item p {
            color: var(--muted);
            font-size: 13px;
            margin-bottom: 8px;
        }

        .cart-item del {
            color: var(--muted);
            opacity: 0.7;
            font-size: 12px;
        }

        .cart-item .text-success {
            color: var(--accent) !important;
            font-weight: 600;
        }

        .quantity-btn {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(167, 139, 250, 0.15);
            border: 1px solid rgba(167, 139, 250, 0.3);
            color: var(--accent-2);
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .quantity-btn:hover {
            background: rgba(167, 139, 250, 0.25);
            transform: translateY(-2px);
        }

        .quantity-number {
            width: 40px;
            text-align: center;
            background: transparent;
            border: none;
            color: var(--text);
            font-size: 16px;
            font-weight: 600;
        }

        .price-tag {
            background: rgba(34, 211, 238, 0.12);
            padding: 8px 20px;
            border-radius: 999px;
            font-size: 16px;
            font-weight: 700;
            color: var(--accent);
            display: inline-flex;
            align-items: center;
            white-space: nowrap;
            min-width: 160px;
            justify-content: center;
            border: 1px solid rgba(34, 211, 238, 0.3);
        }

        .price-tag .currency {
            margin-right: 5px;
            font-size: 12px;
            color: var(--muted);
        }

        .cart-item-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .view-btn {
            background: rgba(34, 211, 238, 0.15);
            color: var(--accent);
            border: 1px solid rgba(34, 211, 238, 0.3);
            padding: 8px 15px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .view-btn:hover {
            background: rgba(34, 211, 238, 0.25);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px -5px rgba(34, 211, 238, 0.4);
        }

        .remove-btn {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
            padding: 8px 15px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .remove-btn:hover {
            background: rgba(239, 68, 68, 0.25);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px -5px rgba(239, 68, 68, 0.4);
        }

        .checkout-btn {
            background: linear-gradient(135deg, var(--accent-2), #8b5cf6);
            border: none;
            padding: 15px 30px;
            border-radius: 10px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
            cursor: pointer;
            box-shadow: 0 4px 15px -3px rgba(167, 139, 250, 0.4);
        }

        .checkout-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #8b5cf6, var(--accent-2));
            opacity: 0;
            z-index: -1;
            transition: opacity 0.3s ease;
        }

        .checkout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px -3px rgba(167, 139, 250, 0.6);
        }

        .checkout-btn:hover::before {
            opacity: 1;
        }

        .checkout-btn:active {
            transform: translateY(0);
        }

        .summary-item {
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--text);
            font-size: 14px;
        }

        .summary-item:last-child {
            border-bottom: none;
        }

        .summary-item strong {
            font-size: 16px;
            color: var(--text);
        }

        .discount-section {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .discount-section h5 {
            color: var(--text);
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .discount-input-group {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .discount-input {
            flex: 1;
            background: #0b1220;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 12px 15px;
            color: var(--text);
            font-size: 14px;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .discount-input:focus {
            outline: none;
            border-color: rgba(34, 211, 238, 0.6);
            background: #0f172a;
            box-shadow: 0 0 0 3px rgba(34, 211, 238, 0.15);
        }

        .discount-input::placeholder {
            color: var(--muted);
        }

        .apply-discount-btn {
            background: linear-gradient(135deg, var(--accent-2), #8b5cf6);
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            color: white;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
            box-shadow: 0 4px 15px -3px rgba(167, 139, 250, 0.4);
        }

        .apply-discount-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px -3px rgba(167, 139, 250, 0.6);
        }

        .apply-discount-btn:active {
            transform: translateY(0);
        }

        .discount-message {
            margin-top: 10px;
            font-size: 13px;
            display: none;
            padding: 10px;
            border-radius: 8px;
        }

        .discount-message.success {
            color: #34d399;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            display: block;
        }

        .discount-message.error {
            color: #f87171;
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            display: block;
        }

        .stock-status {
            font-size: 11px;
            padding: 5px 10px;
            border-radius: 999px;
            margin-top: 5px;
            display: inline-block;
            font-weight: 500;
        }

        .stock-status.in-stock {
            background: rgba(16, 185, 129, 0.12);
            color: #d1fae5;
            border: 1px solid rgba(16, 185, 129, 0.35);
        }

        .stock-status.out-of-stock {
            background: rgba(239, 68, 68, 0.12);
            color: #fee2e2;
            border: 1px solid rgba(239, 68, 68, 0.35);
        }

        .stock-status.pre-order {
            background: rgba(245, 158, 11, 0.12);
            color: #fef3c7;
            border: 1px solid rgba(245, 158, 11, 0.35);
        }

        .product-discount {
            position: absolute;
            top: 10px;
            right: 10px;
            background: var(--danger);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 12px;
            z-index: 2;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .cart-container {
                padding: 20px;
            }

            .cart-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .cart-item img {
                width: 100px;
                height: 100px;
            }

            .cart-item-actions {
                flex-direction: column;
                width: 100%;
            }

            .price-tag {
                width: 100%;
            }

            .view-btn,
            .remove-btn {
                width: 100%;
            }

            .discount-input-group {
                flex-direction: column;
            }

            .apply-discount-btn {
                width: 100%;
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

<body class="dark-scheme">
    <div class="cart-page jarallax">
        <img src="images/background/9.webp" class="jarallax-img" alt="">
        <div class="de-gradient-edge-top"></div>
        <div class="de-gradient-edge-bottom"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- ============================================================ -->
                    <!-- لیست سبد خرید با دکمه بازگشت به پنل (طبق درخواست شما) -->
                    <!-- ============================================================ -->
                    <div class="cart-container">
                        <div class="cart-header">
                            <h2>سبد خرید شما</h2>
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <span class="text-light">تعداد محصولات: <span id="cart-count">0</span></span>
                                <a href="{{ route('user.panel') }}" class="btn-back">
                                    <i class="fas fa-arrow-right"></i>
                                    بازگشت به پنل
                                </a>
                            </div>
                        </div>
                        <div id="cart-items">
                            <!-- محصولات به صورت داینامیک از طریق جاوااسکریپت اضافه می‌شوند -->
                        </div>
                    </div>

                    <!-- ============================================================ -->
                    <!-- خلاصه سفارش با دو دکمه پرداخت (تنها بخش تغییر کرده) -->
                    <!-- ============================================================ -->
                    <div class="cart-container">
                        <h3 class="mb-4" style="color: var(--text); font-size: 20px; font-weight: 600;">خلاصه سفارش
                        </h3>

                        <!-- بخش کد تخفیف -->
                        <div class="discount-section">
                            <h5>کد تخفیف</h5>
                            <div class="discount-input-group">
                                <input type="text" class="discount-input" id="discount-code"
                                    placeholder="کد تخفیف خود را وارد کنید">
                                <button class="apply-discount-btn" onclick="applyDiscount()">
                                    <i class="fas fa-tag me-2"></i>
                                    اعمال کد تخفیف
                                </button>
                            </div>
                            <div id="discount-message" class="discount-message"></div>
                        </div>

                        <!-- جمع‌بندی قیمت‌ها -->
                        <div class="summary-item">
                            <span>جمع کل:</span>
                            <span id="cart-total" class="price-tag">0 تومان</span>
                        </div>
                        <div class="summary-item">
                            <span>تخفیف:</span>
                            <span id="cart-discount" class="price-tag">0 تومان</span>
                        </div>
                        <div class="summary-item mt-3">
                            <strong>مبلغ قابل پرداخت:</strong>
                            <strong id="cart-final-total" class="price-tag">0 تومان</strong>
                        </div>

                        <!-- دو دکمه پرداخت -->
                        <div class="d-grid gap-2 mt-4"
                            style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                            <!-- پرداخت از کیف پول -->
                            <form action="{{ route('checkout.wallet') }}" method="POST">
                                @csrf
                                <button type="submit" class="checkout-btn"
                                    style="background: linear-gradient(135deg, #10b981, #059669);">
                                    <i class="fas fa-wallet me-2"></i>
                                    پرداخت از کیف پول
                                </button>
                            </form>

                            <!-- پرداخت از درگاه -->
                            <form action="{{ route('checkout.gateway') }}" method="POST">
                                @csrf
                                <button type="submit" class="checkout-btn"
                                    style="background: linear-gradient(135deg, var(--accent-2), #8b5cf6);">
                                    <i class="fas fa-credit-card me-2"></i>
                                    پرداخت از درگاه
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================ -->
    <!-- Javascript Files (دست نخورده، فقط دکمه پرداخت و دیتای داینامیک) -->
    <!-- ============================================================ -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/designesia.js"></script>
    <script>
        // دریافت داده‌های سبد خرید از سرور
        const cartItemsData = @json($cartItems ?? []);
        const cartTotal = @json($total ?? 0);
        const cartCount = @json($count ?? 0);

        $(document).ready(function() {
            const items = cartItemsData.map(item => ({
                id: item.id,
                product_id: item.product_id,
                name: item.product_name || 'محصول',
                price: parseInt(item.price) || 0,
                discount: item.discount || 0,
                final_price: parseInt(item.price) || 0,
                quantity: parseInt(item.quantity) || 1,
                stockStatus: item.stockStatus || 'in_stock',
                image: item.image || 'images/covers-square/default.webp',
                options: item.options || {},
            }));

            window.cart = {
                items: items,
                total: cartTotal,
                discount: 0,
            };

            renderCartItems();
            updateTotals();

            // ----- حذف آیتم -----
            window.removeItem = function(itemId) {
                if (!confirm('آیا از حذف این آیتم اطمینان دارید؟')) return;

                $.ajax({
                    url: `/cart/${itemId}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            $(`.cart-item[data-id="${itemId}"]`).remove();
                            cart.items = cart.items.filter(item => item.id !== itemId);
                            cart.total = response.total;
                            cart.discount = 0;
                            updateTotals();
                            showToast(response.message, 'success');
                        }
                    },
                    error: function() {
                        showToast('خطا در حذف آیتم', 'error');
                    }
                });
            };

            // ----- نمایش جزئیات محصول -----
            window.viewDetails = function(itemId) {
                const item = cart.items.find(i => i.id === itemId);
                if (item) {
                    window.location.href = `/product/${item.product_id}`;
                }
            };

            // ----- به‌روزرسانی تعداد -----
            window.updateQuantity = function(itemId, newQuantity) {
                if (newQuantity < 1) return;

                $.ajax({
                    url: `/cart/${itemId}`,
                    type: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        quantity: newQuantity
                    },
                    success: function(response) {
                        if (response.success) {
                            const item = cart.items.find(i => i.id === itemId);
                            if (item) {
                                item.quantity = newQuantity;
                                item.final_price = response.item.final_price || item.final_price;
                            }
                            cart.total = response.total;
                            cart.discount = 0;
                            renderCartItems();
                            updateTotals();
                            showToast(response.message, 'success');
                        }
                    },
                    error: function() {
                        showToast('خطا در به‌روزرسانی تعداد', 'error');
                    }
                });
            };

            // ----- رندر آیتم‌ها -----
            function renderCartItems() {
                const cartContainer = document.getElementById('cart-items');
                cartContainer.innerHTML = '';

                if (cart.items.length === 0) {
                    cartContainer.innerHTML = `
                        <div class="text-center py-5" style="color: var(--muted);">
                            <i class="fas fa-shopping-cart" style="font-size: 48px; opacity: 0.3; display: block; margin-bottom: 15px;"></i>
                            <p style="font-size: 16px;">سبد خرید شما خالی است.</p>
                            <a href="{{ route('products.index') }}" class="btn-action" style="margin-top: 15px; display: inline-block; background: rgba(34,211,238,0.15); color: var(--accent); border: 1px solid rgba(34,211,238,0.3); padding: 10px 20px; border-radius: 8px; text-decoration: none;">
                                <i class="fas fa-store"></i> مشاهده محصولات
                            </a>
                        </div>
                    `;
                    return;
                }

                cart.items.forEach(item => {
                    const finalPrice = item.final_price;
                    const stockStatusClass = `stock-status ${item.stockStatus}`;
                    const stockStatusText = {
                        'in_stock': 'موجود',
                        'out_of_stock': 'ناموجود',
                        'pre_order': 'پیش‌فروش'
                    } [item.stockStatus] || 'موجود';

                    const cartItemHtml = `
                        <div class="cart-item" data-id="${item.id}">
                            <div class="row align-items-center">
                                <div class="col-md-3 position-relative">
                                    ${item.discount > 0 ? `<div class="product-discount">${item.discount}%</div>` : ''}
                                    <img src="${item.image}" alt="${item.name}" class="img-fluid" style="width: 120px; height: 120px; object-fit: cover; border-radius: 10px; border: 2px solid var(--border);">
                                </div>
                                <div class="col-md-5">
                                    <h4 class="mb-2" style="color: var(--text); font-size: 16px; font-weight: 600;">${item.name}</h4>
                                    <p class="text-light mb-0" style="color: var(--muted); font-size: 13px;">
                                        قیمت واحد: 
                                        ${item.discount > 0 ? `<del>${numberFormat(item.price)}</del> ` : ''}
                                        <span class="text-success" style="color: var(--accent) !important; font-weight: 600;">${numberFormat(finalPrice)}</span> تومان
                                    </p>
                                    <span class="${stockStatusClass}" style="font-size: 11px; padding: 5px 10px; border-radius: 999px; display: inline-block; margin-top: 5px; font-weight: 500;">${stockStatusText}</span>
                                </div>
                                <div class="col-md-4 text-center">
                                    <div class="cart-item-actions" style="display: flex; align-items: center; justify-content: center; gap: 10px; flex-wrap: wrap;">
                                        <div style="display: flex; align-items: center; gap: 5px;">
                                            <button class="quantity-btn" onclick="updateQuantity(${item.id}, ${item.quantity - 1})" style="width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background: rgba(167, 139, 250, 0.15); border: 1px solid rgba(167, 139, 250, 0.3); color: var(--accent-2); font-size: 18px; cursor: pointer; transition: all 0.3s ease;">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <span class="quantity-number" style="width: 40px; text-align: center; background: transparent; border: none; color: var(--text); font-size: 16px; font-weight: 600;">${item.quantity}</span>
                                            <button class="quantity-btn" onclick="updateQuantity(${item.id}, ${item.quantity + 1})" style="width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background: rgba(167, 139, 250, 0.15); border: 1px solid rgba(167, 139, 250, 0.3); color: var(--accent-2); font-size: 18px; cursor: pointer; transition: all 0.3s ease;">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="price-tag" style="background: rgba(34, 211, 238, 0.12); padding: 8px 20px; border-radius: 999px; font-size: 16px; font-weight: 700; color: var(--accent); display: inline-flex; align-items: center; white-space: nowrap; min-width: 160px; justify-content: center; border: 1px solid rgba(34, 211, 238, 0.3);">
                                            <span class="currency" style="margin-right: 5px; font-size: 12px; color: var(--muted);">تومان</span>
                                            <span>${numberFormat(finalPrice * item.quantity)}</span>
                                        </div>
                                        <button class="view-btn" onclick="viewDetails(${item.id})" style="background: rgba(34, 211, 238, 0.15); color: var(--accent); border: 1px solid rgba(34, 211, 238, 0.3); padding: 8px 15px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; display: inline-flex; align-items: center; justify-content: center; gap: 5px;">
                                            <i class="fas fa-eye"></i> نمایش
                                        </button>
                                        <button class="remove-btn" onclick="removeItem(${item.id})" style="background: rgba(239, 68, 68, 0.15); color: #f87171; border: 1px solid rgba(239, 68, 68, 0.3); padding: 8px 15px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; display: inline-flex; align-items: center; justify-content: center; gap: 5px;">
                                            <i class="fas fa-trash"></i> حذف
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                    cartContainer.innerHTML += cartItemHtml;
                });
            }

            function updateTotals() {
                const total = cart.items.reduce((sum, item) => {
                    return sum + (item.final_price * item.quantity);
                }, 0);
                cart.total = total;
                cart.discount = 0;

                document.getElementById('cart-count').textContent = cart.items.length;
                document.getElementById('cart-total').innerHTML = '<span class="currency">تومان</span><span>' +
                    numberFormat(total) + '</span>';
                document.getElementById('cart-discount').innerHTML = '<span class="currency">تومان</span><span>' +
                    numberFormat(0) + '</span>';
                document.getElementById('cart-final-total').innerHTML =
                    '<span class="currency">تومان</span><span>' + numberFormat(total) + '</span>';
            }

            function numberFormat(num) {
                return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            // ----- کد تخفیف -----
            window.applyDiscount = function() {
                const discountCode = document.getElementById('discount-code').value.trim();
                const messageElement = document.getElementById('discount-message');

                if (!discountCode) {
                    showDiscountMessage('لطفا کد تخفیف را وارد کنید', 'error');
                    return;
                }

                $.ajax({
                    url: '{{ route('discount.apply') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        code: discountCode,
                        total: cart.total
                    },
                    success: function(response) {
                        if (response.success) {
                            cart.discount = response.discount_amount;
                            showDiscountMessage(response.message, 'success');
                            updateTotals();
                        } else {
                            showDiscountMessage(response.message, 'error');
                        }
                    },
                    error: function() {
                        showDiscountMessage('خطا در ارتباط با سرور', 'error');
                    }
                });
            };

            function showDiscountMessage(message, type) {
                const messageElement = document.getElementById('discount-message');
                messageElement.textContent = message;
                messageElement.className = 'discount-message ' + type;
                setTimeout(() => {
                    messageElement.className = 'discount-message';
                }, 3000);
            }

            function showToast(message, type) {
                alert(message);
            }

            document.getElementById('discount-code').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    applyDiscount();
                }
            });
        });
    </script>
</body>

</html>

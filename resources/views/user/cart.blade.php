```html
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
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
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

        html, body {
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

        .jarallax > .jarallax-img {
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
                    <div class="cart-container">
                        <div class="cart-header">
                            <h2>سبد خرید شما</h2>
                            <span class="text-light">تعداد محصولات: <span id="cart-count">0</span></span>
                        </div>
                        <div id="cart-items">
                            <!-- محصولات به صورت داینامیک از طریق جاوااسکریپت اضافه می‌شوند -->
                        </div>
                    </div>
                    <div class="cart-container">
                        <h3 class="mb-4" style="color: var(--text); font-size: 20px; font-weight: 600;">خلاصه سفارش</h3>
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
                        <div class="d-grid gap-2 mt-4">
                            <button id="checkout-btn" class="checkout-btn">
                                <i class="fas fa-credit-card me-2"></i>
                                پرداخت و ثبت سفارش
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Javascript Files -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/designesia.js"></script>
    <script>
        // Initialize cart when document is ready
        $(document).ready(function() {
            // Define cart object
            window.cart = {
                items: [{
                        id: 1,
                        name: 'سرور بازی Minecraft',
                        price: 150000,
                        discount: 10,
                        stockStatus: 'in_stock',
                        image: 'images/covers-square/1.webp'
                    },
                    {
                        id: 2,
                        name: 'سرور بازی CS:GO',
                        price: 200000,
                        discount: 0,
                        stockStatus: 'in_stock',
                        image: 'images/covers-square/2.webp'
                    },
                    {
                        id: 3,
                        name: 'سرور بازی Rust',
                        price: 180000,
                        discount: 15,
                        stockStatus: 'pre_order',
                        image: 'images/covers-square/3.webp'
                    },
                    {
                        id: 4,
                        name: 'سرور بازی ARK',
                        price: 220000,
                        discount: 0,
                        stockStatus: 'out_of_stock',
                        image: 'images/covers-square/4.webp'
                    },
                    {
                        id: 5,
                        name: 'سرور بازی GTA V',
                        price: 250000,
                        discount: 20,
                        stockStatus: 'in_stock',
                        image: 'images/covers-square/5.webp'
                    },
                    {
                        id: 6,
                        name: 'سرور بازی Valheim',
                        price: 170000,
                        discount: 0,
                        stockStatus: 'in_stock',
                        image: 'images/covers-square/6.webp'
                    }
                ],
                total: 0,
                discount: 0
            };

            // Render cart items
            renderCartItems();

            // Calculate initial totals
            updateTotals();

            // Global functions
            window.removeItem = function(itemId) {
                const itemElement = document.querySelector(`.cart-item[data-id="${itemId}"]`);
                if (itemElement) {
                    itemElement.remove();
                    cart.items = cart.items.filter(item => item.id !== itemId);
                    updateTotals();
                }
            };

            // Add view details function
            window.viewDetails = function(itemId) {
                const item = cart.items.find(i => i.id === itemId);
                if (item) {
                    // در اینجا می‌توانید به صفحه جزئیات محصول هدایت کنید
                    // یا یک مودال نمایش جزئیات باز کنید
                    alert('نمایش جزئیات محصول: ' + item.name);
                }
            };

            function renderCartItems() {
                const cartContainer = document.getElementById('cart-items');
                cartContainer.innerHTML = '';

                cart.items.forEach(item => {
                    const finalPrice = item.price - (item.price * (item.discount / 100));
                    const stockStatusClass = `stock-status ${item.stockStatus}`;
                    const stockStatusText = {
                        'in_stock': 'موجود',
                        'out_of_stock': 'ناموجود',
                        'pre_order': 'پیش‌فروش'
                    } [item.stockStatus];

                    const cartItemHtml = `
                        <div class="cart-item" data-id="${item.id}">
                            <div class="row align-items-center">
                                <div class="col-md-3 position-relative">
                                    ${item.discount > 0 ? `<div class="product-discount">${item.discount}%</div>` : ''}
                                    <img src="${item.image}" alt="${item.name}" class="img-fluid">
                                </div>
                                <div class="col-md-5">
                                    <h4 class="mb-2">${item.name}</h4>
                                    <p class="text-light mb-0">
                                        قیمت واحد: 
                                        ${item.discount > 0 ? `<del>${numberFormat(item.price)}</del> ` : ''}
                                        <span class="text-success">${numberFormat(finalPrice)}</span> تومان
                                    </p>
                                    <span class="${stockStatusClass}">${stockStatusText}</span>
                                </div>
                                <div class="col-md-4 text-center">
                                    <div class="cart-item-actions">
                                        <div class="price-tag">
                                            <span class="currency">تومان</span>
                                            <span>${numberFormat(finalPrice)}</span>
                                        </div>
                                        <button class="view-btn" onclick="viewDetails(${item.id})">
                                            <i class="fas fa-eye"></i>
                                            نمایش
                                        </button>
                                        <button class="remove-btn" onclick="removeItem(${item.id})">
                                            <i class="fas fa-trash"></i>
                                            حذف
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
                cart.total = cart.items.reduce((sum, item) => {
                    const finalPrice = item.price - (item.price * (item.discount / 100));
                    return sum + finalPrice;
                }, 0);
                cart.discount = 0;

                // Update cart count
                document.getElementById('cart-count').textContent = cart.items.length;

                // Update totals display
                document.getElementById('cart-total').innerHTML = '<span class="currency">تومان</span><span>' +
                    numberFormat(cart.total) + '</span>';
                document.getElementById('cart-discount').innerHTML = '<span class="currency">تومان</span><span>' +
                    numberFormat(cart.discount) + '</span>';
                document.getElementById('cart-final-total').innerHTML =
                    '<span class="currency">تومان</span><span>' + numberFormat(cart.total - cart.discount) +
                    '</span>';
            }

            // Number formatting function
            function numberFormat(num) {
                return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

            // Checkout button handler
            document.getElementById('checkout-btn').addEventListener('click', function() {
                if (cart.items.length === 0) {
                    alert('سبد خرید شما خالی است!');
                    return;
                }
                alert('در حال انتقال به صفحه پرداخت...');
            });

            // Add discount code functionality
            window.applyDiscount = function() {
                const discountCode = document.getElementById('discount-code').value.trim();
                const messageElement = document.getElementById('discount-message');

                if (!discountCode) {
                    showDiscountMessage('لطفا کد تخفیف را وارد کنید', 'error');
                    return;
                }

                // اینجا می‌توانید کد تخفیف را با سرور چک کنید
                // فعلاً برای مثال، کد "DISCOUNT20" را قبول می‌کنیم
                if (discountCode === 'DISCOUNT20') {
                    cart.discount = Math.floor(cart.total * 0.2); // 20% تخفیف
                    showDiscountMessage('کد تخفیف با موفقیت اعمال شد', 'success');
                    updateTotals();
                } else {
                    showDiscountMessage('کد تخفیف نامعتبر است', 'error');
                }
            };

            function showDiscountMessage(message, type) {
                const messageElement = document.getElementById('discount-message');
                messageElement.textContent = message;
                messageElement.className = 'discount-message ' + type;

                // پاک کردن پیام بعد از 3 ثانیه
                setTimeout(() => {
                    messageElement.className = 'discount-message';
                }, 3000);
            }

            // اضافه کردن قابلیت فشردن Enter برای اعمال کد تخفیف
            document.getElementById('discount-code').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    applyDiscount();
                }
            });
        });
    </script>
</body>

</html>
```
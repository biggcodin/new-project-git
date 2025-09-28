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
    <style>
        .cart-page {
            min-height: 100vh;
            position: relative;
            padding: 40px 0;
            overflow: hidden;
        }

        .cart-page::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }

        .jarallax {
            position: relative;
            z-index: 0;
        }

        .jarallax>.jarallax-img {
            position: absolute;
            object-fit: cover;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .de-gradient-edge-top {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 100px;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0) 100%);
            z-index: 1;
        }

        .de-gradient-edge-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100px;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0) 100%);
            z-index: 1;
        }

        .cart-container {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            padding: 30px;
            margin-bottom: 20px;
        }

        .cart-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .cart-item {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }

        .cart-item:hover {
            background: rgba(255, 255, 255, 0.05);
            transform: translateY(-2px);
        }

        .cart-item img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
        }

        .quantity-btn {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .quantity-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .quantity-number {
            width: 40px;
            text-align: center;
            background: transparent;
            border: none;
            color: white;
            font-size: 16px;
        }

        .price-tag {
            background: rgba(255, 255, 255, 0.1);
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #00ff88;
            display: inline-flex;
            align-items: center;
            white-space: nowrap;
            min-width: 160px;
            justify-content: center;
        }

        .price-tag .currency {
            margin-right: 5px;
            font-size: 14px;
        }

        .cart-item-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }

        .view-btn {
            background: rgba(0, 255, 136, 0.1);
            color: #00ff88;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .view-btn:hover {
            background: rgba(0, 255, 136, 0.2);
            transform: translateY(-2px);
        }

        .remove-btn {
            background: rgba(255, 59, 48, 0.1);
            color: #ff3b30;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .remove-btn:hover {
            background: rgba(255, 59, 48, 0.2);
            transform: translateY(-2px);
        }

        .checkout-btn {
            background: linear-gradient(45deg, var(--secondary-color), var(--primary-color));
            border: none;
            padding: 15px 30px;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: 500;
            width: 100%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .checkout-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            opacity: 0;
            z-index: -1;
            transition: opacity 0.3s ease;
        }

        .checkout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(var(--primary-rgb), 0.3);
        }

        .checkout-btn:hover::before {
            opacity: 1;
        }

        .checkout-btn:active {
            transform: translateY(0);
        }

        .summary-item {
            padding: 10px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .summary-item:last-child {
            border-bottom: none;
        }

        .discount-section {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .discount-input-group {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .discount-input {
            flex: 1;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 12px 15px;
            color: white;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .discount-input:focus {
            outline: none;
            border-color: var(--primary-color);
            background: rgba(255, 255, 255, 0.08);
        }

        .discount-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .apply-discount-btn {
            background: linear-gradient(45deg, var(--secondary-color), var(--primary-color));
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            color: white;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .apply-discount-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(var(--primary-rgb), 0.3);
        }

        .apply-discount-btn:active {
            transform: translateY(0);
        }

        .discount-message {
            margin-top: 10px;
            font-size: 14px;
            display: none;
        }

        .discount-message.success {
            color: #00ff88;
            display: block;
        }

        .discount-message.error {
            color: #ff3b30;
            display: block;
        }

        .stock-status {
            font-size: 12px;
            padding: 4px 8px;
            border-radius: 4px;
            margin-top: 5px;
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

        .product-discount {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #ff3b30;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-weight: bold;
            z-index: 2;
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
                        <div class="cart-header d-flex justify-content-between align-items-center">
                            <h2 class="mb-0">سبد خرید شما</h2>
                            <span class="text-light">تعداد محصولات: <span id="cart-count">0</span></span>
                        </div>
                        <div id="cart-items">
                            <!-- محصولات به صورت داینامیک از طریق جاوااسکریپت اضافه می‌شوند -->
                        </div>
                    </div>
                    <div class="cart-container">
                        <h3 class="mb-4">خلاصه سفارش</h3>
                        <div class="discount-section">
                            <h5 class="mb-3">کد تخفیف</h5>
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
                        <div class="summary-item d-flex justify-content-between">
                            <span>جمع کل:</span>
                            <span id="cart-total" class="price-tag">0 تومان</span>
                        </div>
                        <div class="summary-item d-flex justify-content-between">
                            <span>تخفیف:</span>
                            <span id="cart-discount" class="price-tag">0 تومان</span>
                        </div>
                        <div class="summary-item d-flex justify-content-between mt-3">
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
                                        <button class="view-btn" onclick="viewDetails(${item.id})">نمایش</button>
                                        <button class="remove-btn" onclick="removeItem(${item.id})">حذف</button>
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

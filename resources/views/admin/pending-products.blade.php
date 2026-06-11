```html
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>درخواست‌های تایید نشده</title>
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
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        /* Header */
        .page-header {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border);
        }

        .page-header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -0.02em;
        }

        /* Alert */
        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: #34d399;
            border-color: rgba(16, 185, 129, 0.3);
        }

        .alert-info {
            background: rgba(34, 211, 238, 0.1);
            color: var(--accent);
            border-color: rgba(34, 211, 238, 0.3);
            text-align: center;
            padding: 30px;
        }

        /* Grid Layout */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
        }

        /* Product Card */
        .product-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 20px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .product-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, var(--accent), var(--accent-2));
            opacity: 0.7;
        }

        .product-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent-2);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
        }

        /* Product Layout */
        .product-layout {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }

        .product-image-wrapper {
            flex-shrink: 0;
        }

        .product-image {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid var(--border);
        }

        .product-image-placeholder {
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.03);
            border: 2px solid var(--border);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image-placeholder i {
            font-size: 40px;
            color: var(--muted);
        }

        .product-info {
            flex: 1;
            min-width: 0;
        }

        .product-title {
            margin: 0 0 10px 0;
            font-size: 16px;
            font-weight: 600;
            color: var(--text);
            line-height: 1.4;
        }

        .product-meta {
            margin: 0;
            padding: 4px 0;
            color: var(--muted);
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .product-meta i {
            color: var(--accent);
            width: 14px;
            text-align: center;
        }

        /* Price */
        .price-section {
            margin: 12px 0;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .product-price {
            font-size: 18px;
            font-weight: 700;
            color: var(--accent);
        }

        .product-original-price {
            text-decoration: line-through;
            color: var(--muted);
            font-size: 14px;
            opacity: 0.7;
        }

        .price-unit {
            font-size: 11px;
            color: var(--muted);
            margin-right: 3px;
        }

        /* Badges */
        .badges-section {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin: 12px 0;
        }

        .stock-status,
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 10px;
            border-radius: 999px;
            font-size: 11px;
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

        .status-pending {
            background: rgba(245, 158, 11, 0.12);
            color: #fef3c7;
            border: 1px solid rgba(245, 158, 11, 0.35);
        }

        .status-pending::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--warning);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .date-info {
            margin: 10px 0 0 0;
            color: var(--muted);
            font-size: 11px;
            opacity: 0.7;
            direction: ltr;
            text-align: right;
        }

        /* Media Section */
        .media-section {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid var(--border);
        }

        .media-section h6 {
            margin: 0 0 10px 0;
            font-size: 13px;
            font-weight: 600;
            color: var(--text);
        }

        .media-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .media-thumbnail {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid var(--border);
            transition: transform 0.2s ease;
        }

        .media-thumbnail:hover {
            transform: scale(1.1);
            border-color: var(--accent);
        }

        .media-video {
            width: 90px;
            border-radius: 6px;
            border: 1px solid var(--border);
        }

        .no-media {
            color: var(--muted);
            font-size: 12px;
        }

        /* Action Buttons */
        .action-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-top: 15px;
        }

        .btn-action {
            padding: 10px 15px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .btn-success {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .btn-success:hover {
            background: rgba(16, 185, 129, 0.25);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px -5px rgba(16, 185, 129, 0.4);
        }

        .btn-danger {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .btn-danger:hover {
            background: rgba(239, 68, 68, 0.25);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px -5px rgba(239, 68, 68, 0.4);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .products-grid {
                grid-template-columns: 1fr;
            }

            .product-layout {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .product-image,
            .product-image-placeholder {
                width: 150px;
                height: 150px;
            }

            .price-section {
                justify-content: center;
            }

            .badges-section {
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    @php use Illuminate\Support\Str; @endphp

    <div class="container">
        <div class="page-header">
            <h2>درخواست‌های ثبت محصول کاربران (در انتظار تایید)</h2>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if ($pendingProducts->count())
            <div class="products-grid">
                @foreach ($pendingProducts as $product)
                    <div class="product-card">
                        <div class="product-layout">
                            <div class="product-image-wrapper">
                                @if ($product->cover)
                                    <img src="{{ asset('storage/' . $product->cover) }}" alt="{{ $product->title }}"
                                        class="product-image">
                                @else
                                    <div class="product-image-placeholder">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                            </div>

                            <div class="product-info">
                                <h5 class="product-title">{{ $product->title }}</h5>

                                <p class="product-meta">
                                    <i class="fas fa-user"></i>
                                    <span>کاربر: {{ $product->user->name ?? '---' }}</span>
                                </p>

                                <p class="product-meta">
                                    <i class="fas fa-tag"></i>
                                    <span>زیردسته: {{ $product->subSubcategory->name ?? '---' }}</span>
                                </p>

                                <div class="price-section">
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

                                <div class="badges-section">
                                    <span class="stock-status {{ $product->stock_status }}">
                                        {{ $product->stock_status_text }}
                                    </span>
                                    <span class="status-badge status-pending">در انتظار تایید</span>
                                </div>

                                <p class="date-info">
                                    <i class="fas fa-clock"></i>
                                    {{ $product->created_at->format('Y/m/d H:i') }}
                                </p>
                            </div>
                        </div>

                        <div class="media-section">
                            <h6>
                                <i class="fas fa-paperclip" style="color: var(--accent); margin-left: 5px;"></i>
                                فایل‌های ارسالی:
                            </h6>
                            @if ($product->media && $product->media->count())
                                <div class="media-wrapper">
                                    @foreach ($product->media as $media)
                                        @if (Str::startsWith($media->file_type, 'image/'))
                                            <img src="{{ asset('storage/' . $media->file_path) }}" alt="media"
                                                class="media-thumbnail">
                                        @elseif(Str::startsWith($media->file_type, 'video/'))
                                            <video controls class="media-video">
                                                <source src="{{ asset('storage/' . $media->file_path) }}"
                                                    type="{{ $media->file_type }}">
                                                ویدئو پشتیبانی نمی‌شود.
                                            </video>
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <span class="no-media">فایلی ارسال نشده است</span>
                            @endif
                        </div>

                        <div class="action-buttons">
                            <form method="POST" action="{{ route('pending.products.approve', $product) }}">
                                @csrf
                                <button type="submit" class="btn-action btn-success"
                                    onclick="return confirm('آیا مطمئنید می‌خواهید این محصول را تایید کنید؟')">
                                    <i class="fas fa-check"></i>
                                    <span>تایید</span>
                                </button>
                            </form>

                            <form method="POST" action="{{ route('pending.products.reject', $product) }}">
                                @csrf
                                <button type="submit" class="btn-action btn-danger"
                                    onclick="return confirm('آیا مطمئنید می‌خواهید این محصول را رد کنید؟')">
                                    <i class="fas fa-times"></i>
                                    <span>رد</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle" style="font-size: 24px; margin-bottom: 10px;"></i>
                <p style="margin: 0;">درخواستی برای تایید وجود ندارد.</p>
            </div>
        @endif
    </div>
</body>

</html>
```

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>درخواست‌های تایید نشده | مدیریت محصولات</title>
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
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        /* Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
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

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            color: var(--text);
            background: linear-gradient(180deg, #101827, #0b1220);
            border: 1px solid var(--border);
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            border-color: var(--accent-2);
            box-shadow: 0 5px 15px -5px rgba(167, 139, 250, 0.3);
        }

        .btn-back i {
            color: var(--accent-2);
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

        /* Table */
        .table-wrapper {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
            margin-bottom: 25px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            min-width: 1100px;
        }

        thead th {
            background: linear-gradient(180deg, #0e1626, #0d1524);
            color: var(--muted);
            font-weight: 600;
            font-size: 13px;
            text-align: right;
            padding: 15px;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }

        tbody td {
            padding: 15px;
            border-bottom: 1px solid var(--border);
            color: var(--text);
            vertical-align: middle;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background: rgba(167, 139, 250, 0.05);
        }

        /* Product Image */
        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid var(--border);
        }

        .no-image {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--muted);
        }

        /* Badges */
        .badge-custom {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-pending {
            background: rgba(245, 158, 11, 0.12);
            color: #fef3c7;
            border: 1px solid rgba(245, 158, 11, 0.35);
        }

        .stock-in-stock {
            background: rgba(16, 185, 129, 0.12);
            color: #d1fae5;
            border: 1px solid rgba(16, 185, 129, 0.35);
        }

        .stock-out-of-stock {
            background: rgba(239, 68, 68, 0.12);
            color: #fee2e2;
            border: 1px solid rgba(239, 68, 68, 0.35);
        }

        .stock-pre-order {
            background: rgba(245, 158, 11, 0.12);
            color: #fef3c7;
            border: 1px solid rgba(245, 158, 11, 0.35);
        }

        /* Price */
        .price-original {
            text-decoration: line-through;
            color: var(--muted);
            font-size: 12px;
            display: block;
        }

        .price-final {
            color: var(--accent);
            font-weight: 600;
            font-size: 14px;
        }

        .price-unit {
            font-size: 11px;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
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

        .btn-success {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .btn-success:hover {
            background: rgba(16, 185, 129, 0.25);
            transform: translateY(-2px);
        }

        .btn-danger {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .btn-danger:hover {
            background: rgba(239, 68, 68, 0.25);
            transform: translateY(-2px);
        }

        /* Pagination */
        .pagination-wrapper {
            margin-top: 30px;
            display: flex;
            justify-content: center;
        }

        .pagination-wrapper nav {
            display: flex;
            gap: 5px;
        }

        .pagination-wrapper .page-link {
            padding: 8px 14px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: #0b1220;
            color: var(--text);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .pagination-wrapper .page-link:hover {
            background: rgba(167, 139, 250, 0.1);
            border-color: var(--accent-2);
        }

        .pagination-wrapper .active .page-link {
            background: linear-gradient(180deg, rgba(34, 211, 238, 0.15), rgba(167, 139, 250, 0.15));
            border-color: rgba(34, 211, 238, 0.35);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn-action {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    @php use Illuminate\Support\Str; @endphp

    <div class="container">
        <div class="page-header">
            <h2>مدیریت محصولات در انتظار تایید</h2>
            <a href="{{ route('admin.dashboard') }}" class="btn-back">
                <i class="fas fa-arrow-right"></i>
                <span>بازگشت به داشبورد</span>
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if ($pendingProducts->count())
            <div class="table-wrapper">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>تصویر</th>
                                <th>عنوان محصول</th>
                                <th>کاربر</th>
                                <th>زیردسته</th>
                                <th>قیمت</th>
                                <th>موجودی</th>
                                <th>وضعیت تایید</th>
                                <th>تاریخ ثبت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendingProducts as $key => $product)
                                <tr>
                                    <td>{{ $pendingProducts->firstItem() + $key }}</td>
                                    <td>
                                        @if ($product->cover)
                                            <img src="{{ asset('storage/' . $product->cover) }}"
                                                alt="{{ $product->title }}" class="product-image">
                                        @else
                                            <div class="no-image">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->user->name ?? '---' }}</td>
                                    <td>{{ $product->subSubcategory->name ?? '---' }}</td>
                                    <td>
                                        @if ($product->discount > 0)
                                            <span class="price-original">
                                                {{ number_format($product->price) }}
                                                <span class="price-unit">تومان</span>
                                            </span>
                                            <span class="price-final">
                                                {{ number_format($product->final_price) }}
                                                <span class="price-unit">تومان</span>
                                            </span>
                                        @else
                                            <span class="price-final">
                                                {{ number_format($product->price) }}
                                                <span class="price-unit">تومان</span>
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge-custom stock-{{ $product->stock_status }}">
                                            {{ $product->stock_status_text }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge-custom status-pending">در انتظار تایید</span>
                                    </td>
                                    <td style="direction: ltr; text-align: right;">
                                        {{ $product->created_at->format('Y/m/d H:i') }}
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <form method="POST"
                                                action="{{ route('admin.pending.products.approve', $product) }}">
                                                @csrf
                                                <button type="submit" class="btn-action btn-success"
                                                    onclick="return confirm('آیا مطمئنید می‌خواهید این محصول را تایید کنید؟')">
                                                    <i class="fas fa-check"></i>
                                                    <span>تایید</span>
                                                </button>
                                            </form>
                                            <form method="POST"
                                                action="{{ route('admin.pending.products.reject', $product) }}">
                                                @csrf
                                                <button type="submit" class="btn-action btn-danger"
                                                    onclick="return confirm('آیا مطمئنید می‌خواهید این محصول را رد کنید؟')">
                                                    <i class="fas fa-times"></i>
                                                    <span>رد</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="pagination-wrapper">
                {{ $pendingProducts->links() }}
            </div>
        @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle" style="font-size: 24px; margin-bottom: 10px; display: block;"></i>
                <p style="margin: 0;">درخواستی برای تایید وجود ندارد.</p>
            </div>
        @endif
    </div>
</body>

</html>

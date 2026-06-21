<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>خریدهای من</title>
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

        /* Filters */
        .filters-wrapper {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 20px 25px;
            margin-bottom: 25px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: flex-end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            flex: 1;
            min-width: 150px;
        }

        .filter-group label {
            font-size: 12px;
            color: var(--muted);
            font-weight: 500;
        }

        .filter-select {
            background: #0b1220;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 8px 12px;
            color: var(--text);
            font-family: inherit;
            font-size: 13px;
            outline: none;
            transition: all 0.2s ease;
            cursor: pointer;
            width: 100%;
        }

        .filter-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(34, 211, 238, 0.15);
        }

        .btn-filter {
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
            display: inline-flex;
            align-items: center;
            gap: 6px;
            height: 40px;
        }

        .btn-filter:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px -3px rgba(167, 139, 250, 0.4);
        }

        .btn-filter-reset {
            padding: 8px 16px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: transparent;
            color: var(--muted);
            font-family: inherit;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s ease;
            height: 40px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-filter-reset:hover {
            color: var(--text);
            border-color: var(--muted);
        }

        /* Orders Grid */
        .orders-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 20px;
        }

        /* Order Card */
        .order-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
        }

        .order-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent-2);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
        }

        .order-header {
            padding: 15px 20px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.03), rgba(255, 255, 255, 0.0));
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .order-id {
            font-size: 13px;
            color: var(--muted);
            font-family: monospace;
        }

        .order-date {
            font-size: 12px;
            color: var(--muted);
            direction: ltr;
        }

        .order-body {
            padding: 20px;
        }

        .order-items-list {
            margin: 10px 0 15px 0;
        }

        .order-item-row {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 13px;
        }

        .order-item-row:last-child {
            border-bottom: none;
        }

        .order-item-name {
            color: var(--text);
        }

        .order-item-price {
            color: var(--muted);
        }

        .order-footer {
            padding: 15px 20px;
            background: rgba(0, 0, 0, 0.2);
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .total-price {
            font-size: 16px;
            font-weight: 700;
            color: var(--accent);
        }

        .total-label {
            font-size: 11px;
            color: var(--muted);
            display: block;
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-completed {
            background: rgba(16, 185, 129, 0.12);
            color: #d1fae5;
            border: 1px solid rgba(16, 185, 129, 0.35);
        }

        .status-paid {
            background: rgba(16, 185, 129, 0.12);
            color: #d1fae5;
            border: 1px solid rgba(16, 185, 129, 0.35);
        }

        .status-processing {
            background: rgba(34, 211, 238, 0.12);
            color: #cffafe;
            border: 1px solid rgba(34, 211, 238, 0.35);
        }

        .status-pending {
            background: rgba(245, 158, 11, 0.12);
            color: #fef3c7;
            border: 1px solid rgba(245, 158, 11, 0.35);
        }

        .status-failed {
            background: rgba(239, 68, 68, 0.12);
            color: #fee2e2;
            border: 1px solid rgba(239, 68, 68, 0.35);
        }

        .status-canceled {
            background: rgba(148, 163, 184, 0.12);
            color: #d1d5db;
            border: 1px solid rgba(148, 163, 184, 0.35);
        }

        /* Action Button */
        .btn-action {
            padding: 8px 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            background: rgba(34, 211, 238, 0.15);
            color: var(--accent);
            border: 1px solid rgba(34, 211, 238, 0.3);
        }

        .btn-action:hover {
            background: rgba(34, 211, 238, 0.25);
            transform: translateY(-2px);
        }

        .btn-action-warning {
            background: rgba(245, 158, 11, 0.15);
            color: #fbbf24;
            border-color: rgba(245, 158, 11, 0.3);
        }

        .btn-action-warning:hover {
            background: rgba(245, 158, 11, 0.25);
        }

        .btn-action-success {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border-color: rgba(16, 185, 129, 0.3);
        }

        .btn-action-success:hover {
            background: rgba(16, 185, 129, 0.25);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--muted);
        }

        .empty-state i {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.3;
            color: var(--accent-2);
        }

        .empty-state p {
            font-size: 16px;
            margin: 0;
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
            flex-wrap: wrap;
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

            .orders-grid {
                grid-template-columns: 1fr;
            }

            .filters-wrapper {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-filter,
            .btn-filter-reset {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h2>خریدهای من</h2>
            <a href="{{ route('user.panel') }}" class="btn-back">
                <i class="fas fa-arrow-right"></i>
                بازگشت به پنل
            </a>
        </div>

        <!-- Filters -->
        <form method="GET" action="{{ route('user.purchases') }}" class="filters-wrapper">
            <div class="filter-group">
                <label for="status">وضعیت سفارش</label>
                <select name="status" id="status" class="filter-select" onchange="this.form.submit()">
                    <option value="">همه</option>
                    @foreach ($statuses as $key => $label)
                        <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="filter-group" style="flex: 0; min-width: 0; flex-direction: row; gap: 8px;">
                <button type="submit" class="btn-filter">
                    <i class="fas fa-filter"></i>
                    اعمال
                </button>
                <a href="{{ route('user.purchases') }}" class="btn-filter-reset">
                    <i class="fas fa-undo"></i>
                </a>
            </div>
        </form>

        @if ($purchases->count())
            <div class="orders-grid">
                @foreach ($purchases as $order)
                    <div class="order-card">
                        <div class="order-header">
                            <span class="order-id">#{{ $order->order_number }}</span>
                            <span class="order-date">{{ $order->created_at->format('Y/m/d H:i') }}</span>
                        </div>

                        <div class="order-body">
                            <!-- وضعیت -->
                            <div
                                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                <span class="status-badge status-{{ $order->status }}">
                                    {{ $order->status_text }}
                                </span>
                                <span style="font-size: 13px; color: var(--muted);">
                                    {{ $order->items->count() }} محصول
                                </span>
                            </div>

                            <!-- لیست آیتم‌ها -->
                            <div class="order-items-list">
                                @foreach ($order->items->take(3) as $item)
                                    <div class="order-item-row">
                                        <span class="order-item-name">{{ $item->product_name }}</span>
                                        <span class="order-item-price">{{ number_format($item->subtotal) }}
                                            تومان</span>
                                    </div>
                                @endforeach
                                @if ($order->items->count() > 3)
                                    <div
                                        style="font-size: 12px; color: var(--muted); text-align: center; padding-top: 5px;">
                                        و {{ $order->items->count() - 3 }} محصول دیگر
                                    </div>
                                @endif
                            </div>

                            <!-- جمع کل -->
                            <div
                                style="margin-top: 15px; padding-top: 15px; border-top: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <span class="total-label">مبلغ کل</span>
                                    <span class="total-price">{{ number_format($order->total_amount) }} تومان</span>
                                </div>
                                @if ($order->paid_amount > 0)
                                    <div style="text-align: left;">
                                        <span class="total-label" style="color: var(--success);">پرداخت شده</span>
                                        <span
                                            style="color: var(--success); font-weight: 600; display: block;">{{ number_format($order->paid_amount) }}
                                            تومان</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="order-footer">
                            @if ($order->status == 'pending')
                                <a href="{{ route('payment.retry', $order->id) }}"
                                    class="btn-action btn-action-warning">
                                    <i class="fas fa-credit-card"></i>
                                    پرداخت
                                </a>
                            @elseif ($order->status == 'completed')
                                <a href="#" class="btn-action btn-action-success">
                                    <i class="fas fa-download"></i>
                                    دانلود فاکتور
                                </a>
                            @else
                                <span style="color: var(--muted); font-size: 13px;">
                                    <i class="fas fa-info-circle"></i>
                                    {{ $order->status_text }}
                                </span>
                            @endif

                            <a href="{{ route('order.details', $order->id) }}" class="btn-action">
                                <i class="fas fa-eye"></i>
                                مشاهده جزئیات
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper">
                {{ $purchases->appends(request()->query())->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-shopping-bag"></i>
                <p>هنوز خریدی انجام نداده‌اید.</p>
                <a href="{{ route('products.index') }}" class="btn-action" style="margin-top: 20px;">
                    <i class="fas fa-store"></i>
                    مشاهده محصولات
                </a>
            </div>
        @endif
    </div>
</body>

</html>

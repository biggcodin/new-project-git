<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تاریخچه تراکنش‌ها</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
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

        /* Balance Card */
        .balance-card {
            background: linear-gradient(135deg, rgba(34, 211, 238, 0.1), rgba(167, 139, 250, 0.1));
            border: 1px solid rgba(34, 211, 238, 0.3);
            border-radius: 14px;
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .balance-label {
            color: var(--muted);
            font-size: 14px;
        }

        .balance-amount {
            font-size: 24px;
            font-weight: 700;
            color: var(--text);
        }

        .balance-currency {
            font-size: 14px;
            color: var(--accent);
            margin-right: 5px;
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

        .filter-select option {
            background: #0b1220;
            color: var(--text);
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

        .btn-reset {
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
        }

        .btn-reset:hover {
            color: var(--text);
            border-color: var(--muted);
        }

        /* Table */
        .table-wrapper {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 700px;
        }

        thead {
            background: rgba(255, 255, 255, 0.03);
        }

        th {
            text-align: right;
            padding: 14px 20px;
            font-size: 12px;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.03em;
            border-bottom: 1px solid var(--border);
        }

        td {
            padding: 14px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.03);
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: rgba(255, 255, 255, 0.02);
        }

        /* Status Badge */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-completed {
            background: rgba(16, 185, 129, 0.12);
            color: #d1fae5;
            border: 1px solid rgba(16, 185, 129, 0.35);
        }

        .badge-pending {
            background: rgba(245, 158, 11, 0.12);
            color: #fef3c7;
            border: 1px solid rgba(245, 158, 11, 0.35);
        }

        .badge-failed {
            background: rgba(239, 68, 68, 0.12);
            color: #fee2e2;
            border: 1px solid rgba(239, 68, 68, 0.35);
        }

        .badge-canceled {
            background: rgba(148, 163, 184, 0.12);
            color: #d1d5db;
            border: 1px solid rgba(148, 163, 184, 0.35);
        }

        /* Amount colors */
        .amount-positive {
            color: var(--success);
            font-weight: 600;
        }

        .amount-negative {
            color: var(--danger);
            font-weight: 600;
        }

        /* Pagination */
        .pagination-wrapper {
            padding: 20px 25px;
            border-top: 1px solid var(--border);
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
            font-size: 13px;
        }

        .pagination-wrapper .page-link:hover {
            background: rgba(167, 139, 250, 0.1);
            border-color: var(--accent-2);
        }

        .pagination-wrapper .active .page-link {
            background: linear-gradient(135deg, rgba(34, 211, 238, 0.15), rgba(167, 139, 250, 0.15));
            border-color: rgba(34, 211, 238, 0.35);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: var(--muted);
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 15px;
            opacity: 0.3;
            color: var(--accent-2);
        }

        .empty-state p {
            margin: 0;
            font-size: 15px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .balance-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .filters-wrapper {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-filter,
            .btn-reset {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="page-header">
            <h2>تاریخچه تراکنش‌ها</h2>
            <a href="{{ route('user.panel') }}" class="btn-back">
                <i class="fas fa-arrow-right"></i>
                بازگشت به پنل
            </a>
        </div>

        <!-- Balance -->
        <div class="balance-card">
            <div>
                <div class="balance-label">موجودی فعلی کیف پول</div>
                <div class="balance-amount">
                    {{ number_format($balance) }}
                    <span class="balance-currency">تومان</span>
                </div>
            </div>
            <a href="{{ route('wallet.charge') }}" class="btn-filter" style="background: linear-gradient(135deg, var(--accent), #22d3ee);">
                <i class="fas fa-plus-circle"></i>
                شارژ کیف پول
            </a>
        </div>

        <!-- Filters -->
        <form method="GET" action="{{ route('wallet.history') }}" class="filters-wrapper">
            <div class="filter-group">
                <label for="type">نوع تراکنش</label>
                <select name="type" id="type" class="filter-select" onchange="this.form.submit()">
                    <option value="">همه</option>
                    @foreach($types as $key => $label)
                        <option value="{{ $key }}" {{ request('type') == $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="filter-group">
                <label for="status">وضعیت</label>
                <select name="status" id="status" class="filter-select" onchange="this.form.submit()">
                    <option value="">همه</option>
                    @foreach($statuses as $key => $label)
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
                <a href="{{ route('wallet.history') }}" class="btn-reset">
                    <i class="fas fa-undo"></i>
                </a>
            </div>
        </form>

        <!-- Transactions Table -->
        <div class="table-wrapper">
            @if($transactions->count())
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>تاریخ</th>
                                <th>نوع</th>
                                <th>مبلغ</th>
                                <th>موجودی قبل</th>
                                <th>موجودی بعد</th>
                                <th>وضعیت</th>
                                <th>توضیحات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->id }}</td>
                                    <td>{{ $transaction->created_at->format('Y/m/d H:i') }}</td>
                                    <td>{{ $transaction->type_text }}</td>
                                    <td class="{{ $transaction->amount > 0 ? 'amount-positive' : 'amount-negative' }}">
                                        {{ $transaction->amount > 0 ? '+' : '' }}
                                        {{ number_format(abs($transaction->amount)) }}
                                        تومان
                                    </td>
                                    <td>{{ number_format($transaction->balance_before) }}</td>
                                    <td>{{ number_format($transaction->balance_after) }}</td>
                                    <td>
                                        <span class="badge badge-{{ $transaction->status }}">
                                            {{ $transaction->status_text }}
                                        </span>
                                    </td>
                                    <td style="font-size: 12px; color: var(--muted); max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        {{ $transaction->description ?? '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper">
                    {{ $transactions->appends(request()->query())->links() }}
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-receipt"></i>
                    <p>هیچ تراکنشی برای نمایش وجود ندارد.</p>
                </div>
            @endif
        </div>
    </div>
</body>

</html>
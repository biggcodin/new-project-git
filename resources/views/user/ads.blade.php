<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>آگهی‌های من</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
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

        body {
            background: linear-gradient(135deg, #0b1220 0%, #0f172a 100%);
            color: var(--text);
            font-family: 'Vazirmatn', sans-serif;
            padding: 30px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

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
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 10px;
            color: var(--text);
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-back:hover {
            border-color: var(--accent-2);
            transform: translateY(-2px);
        }

        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 20px;
            margin-bottom: 20px;
            position: relative;
            transition: 0.3s;
        }

        .card:hover {
            border-color: var(--accent-2);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .card-title {
            font-size: 20px;
            font-weight: 600;
            margin: 0;
            color:#10b981;
        }

        .badge-custom {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
        }

        .badge-pending {
            background: rgba(245, 158, 11, 0.12);
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .badge-approved {
            background: rgba(16, 185, 129, 0.12);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .badge-rejected {
            background: rgba(239, 68, 68, 0.12);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .card-body {
            color: var(--muted);
            font-size: 14px;
        }

        .card-body .row {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 8px;
        }

        .card-body .label {
            color: var(--muted);
            width: 120px;
        }

        .card-body .value {
            color: var(--text);
            font-weight: 500;
        }

        .reason-box {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 8px;
            padding: 12px 15px;
            margin-top: 10px;
            color: #f87171;
        }

        .btn-sm {
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 13px;
            border: none;
            cursor: pointer;
            transition: 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-weight: 600;
        }

        .btn-edit {
            background: rgba(34, 211, 238, 0.15);
            color: var(--accent);
            border: 1px solid rgba(34, 211, 238, 0.3);
        }

        .btn-edit:hover {
            background: rgba(34, 211, 238, 0.25);
            transform: translateY(-2px);
        }

        .btn-disabled {
            background: rgba(148, 163, 184, 0.1);
            color: var(--muted);
            border: 1px solid rgba(148, 163, 184, 0.2);
            cursor: not-allowed;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--muted);
        }

        .empty-state i {
            font-size: 48px;
            opacity: 0.3;
            margin-bottom: 15px;
        }

        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h2>آگهی‌های من</h2>
            <a href="{{ route('user.panel') }}" class="btn-back">
                <i class="fas fa-arrow-right"></i> بازگشت به پنل
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success"
                style="padding:15px;border-radius:10px;background:rgba(16,185,129,0.1);color:#34d399;border:1px solid rgba(16,185,129,0.3);">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger"
                style="padding:15px;border-radius:10px;background:rgba(239,68,68,0.1);color:#f87171;border:1px solid rgba(239,68,68,0.3);">
                {{ session('error') }}
            </div>
        @endif

        @forelse($products as $product)
            @php
                $statusText = match ($product->status) {
                    'pending' => 'در انتظار بررسی',
                    'approved' => 'تأیید شده',
                    'rejected' => 'رد شده',
                    default => $product->status,
                };
                $badgeClass = match ($product->status) {
                    'pending' => 'badge-pending',
                    'approved' => 'badge-approved',
                    'rejected' => 'badge-rejected',
                    default => '',
                };
            @endphp
            <div class="card">
                <div class="card-header">
                    <span class="card-title">{{ $product->name }}</span>
                    <span class="badge-custom {{ $badgeClass }}">
                        {{ $statusText }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <span class="label">نوع بازی:</span>
                        <span class="value">{{ $product->subSubcategory->name ?? 'نامشخص' }}</span>
                    </div>
                    <div class="row">
                        <span class="label">قیمت:</span>
                        <span class="value">{{ number_format($product->price) }} تومان</span>
                    </div>
                    <div class="row">
                        <span class="label">تاریخ ثبت:</span>
                        <span class="value">{{ $product->created_at->format('Y/m/d H:i') }}</span>
                    </div>

                    @if ($product->status === 'rejected')
                        <div class="reason-box">
                            <i class="fas fa-exclamation-circle"></i>
                            <strong>دلیل رد:</strong>
                            @php
                                $reason = $product->rejection_reason;
                                if (empty($reason) && !empty($product->meta['admin_message'])) {
                                    $reason = $product->meta['admin_message'];
                                }
                                if (empty($reason)) {
                                    $reason = 'دلیلی ثبت نشده است.';
                                }
                            @endphp
                            {{ $reason }}
                        </div>
                    @endif

                    <div style="margin-top:15px;display:flex;gap:10px;flex-wrap:wrap;">
                        @if ($product->status === 'rejected')
                            <a href="{{ route('user.product-application.edit', $product) }}" class="btn-sm btn-edit">
                                <i class="fas fa-edit"></i> ویرایش آگهی
                            </a>
                        @else
                            <span class="btn-sm btn-disabled">
                                <i class="fas fa-lock"></i> غیرقابل ویرایش
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h4>هیچ آگهی ثبت نکرده‌اید</h4>
                <p style="color:var(--muted);">برای ثبت آگهی جدید، به بخش «ثبت آگهی جدید» در پنل کاربری بروید.</p>
                <a href="{{ route('seller.product.create') }}" class="btn-sm btn-edit"
                    style="padding:10px 20px;font-size:14px;margin-top:10px;">
                    <i class="fas fa-plus"></i> ثبت آگهی جدید
                </a>
            </div>
        @endforelse

        @if ($products->hasPages())
            <div style="display:flex;justify-content:center;margin-top:20px;">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</body>

</html>

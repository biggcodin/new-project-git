<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>مدیریت یکپارچه فروشندگان</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        /* ===== تمام استایل‌های قبلی (بدون تغییر) ===== */
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
            padding: 15px;
            margin: 0;
            min-height: 100vh;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border);
            flex-wrap: wrap;
            gap: 10px;
        }

        .page-header h2 {
            margin: 0;
            font-size: 22px;
            font-weight: 700;
            color: var(--text);
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 10px;
            text-decoration: none;
            color: var(--text);
            background: linear-gradient(180deg, #101827, #0b1220);
            border: 1px solid var(--border);
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 14px;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            border-color: var(--accent-2);
        }

        .alert {
            padding: 12px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid;
            font-size: 14px;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: #34d399;
            border-color: rgba(16, 185, 129, 0.3);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #f87171;
            border-color: rgba(239, 68, 68, 0.3);
        }

        .filter-bar {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 12px 18px;
            margin-bottom: 25px;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
        }

        .filter-bar .filter-group {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .filter-bar .filter-group label {
            color: var(--muted);
            font-size: 13px;
            font-weight: 500;
            white-space: nowrap;
        }

        .filter-bar .form-control,
        .filter-bar .form-select {
            background: #0b1220;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 7px 12px;
            color: var(--text);
            font-family: inherit;
            font-size: 13px;
            outline: none;
            transition: 0.2s;
            min-width: 140px;
        }

        .filter-bar .form-control:focus,
        .filter-bar .form-select:focus {
            border-color: var(--accent);
        }

        .filter-bar .btn-filter {
            padding: 7px 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-family: inherit;
            font-weight: 600;
            font-size: 13px;
            transition: 0.2s;
            background: linear-gradient(135deg, var(--accent-2), #8b5cf6);
            color: white;
        }

        .filter-bar .btn-filter:hover {
            transform: translateY(-2px);
        }

        .filter-bar .btn-reset {
            padding: 7px 16px;
            border-radius: 8px;
            border: 1px solid var(--border);
            cursor: pointer;
            font-family: inherit;
            font-weight: 600;
            font-size: 13px;
            transition: 0.2s;
            background: transparent;
            color: var(--muted);
        }

        .filter-bar .btn-reset:hover {
            background: rgba(255, 255, 255, 0.05);
            color: var(--text);
        }

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
            padding: 12px 15px;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
            position: sticky;
            top: 0;
            z-index: 5;
        }

        tbody td {
            padding: 12px 15px;
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

        .badge-custom {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-pending {
            background: rgba(245, 158, 11, 0.12);
            color: #fef3c7;
            border: 1px solid rgba(245, 158, 11, 0.35);
        }

        .badge-approved {
            background: rgba(16, 185, 129, 0.12);
            color: #d1fae5;
            border: 1px solid rgba(16, 185, 129, 0.35);
        }

        .badge-rejected {
            background: rgba(239, 68, 68, 0.12);
            color: #fee2e2;
            border: 1px solid rgba(239, 68, 68, 0.35);
        }

        .badge-none {
            background: rgba(148, 163, 184, 0.1);
            color: var(--muted);
            border: 1px solid rgba(148, 163, 184, 0.2);
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: inherit;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .btn-info {
            background: rgba(34, 211, 238, 0.15);
            color: var(--accent);
            border: 1px solid rgba(34, 211, 238, 0.3);
        }

        .btn-info:hover {
            background: rgba(34, 211, 238, 0.25);
        }

        .btn-success {
            background: rgba(16, 185, 129, 0.15);
            color: var(--success);
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .btn-success:hover {
            background: rgba(16, 185, 129, 0.25);
        }

        .btn-danger {
            background: rgba(239, 68, 68, 0.15);
            color: var(--danger);
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .btn-danger:hover {
            background: rgba(239, 68, 68, 0.25);
        }

        .btn-warning {
            background: rgba(245, 158, 11, 0.15);
            color: var(--warning);
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .btn-warning:hover {
            background: rgba(245, 158, 11, 0.25);
        }

        .btn-secondary {
            background: rgba(148, 163, 184, 0.1);
            color: var(--muted);
            border: 1px solid rgba(148, 163, 184, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(148, 163, 184, 0.2);
        }

        .actions-group {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }

        .sub-table {
            width: 100%;
            margin-top: 8px;
            border-top: 1px dashed var(--border);
        }

        .sub-table td {
            padding: 5px 4px;
            border: none;
            font-size: 13px;
        }

        .sub-table .label {
            color: var(--muted);
            width: 90px;
        }

        .modal-content {
            background: var(--card);
            color: var(--text);
            border: 1px solid var(--border);
            border-radius: 14px;
        }

        .modal-header {
            border-bottom: 1px solid var(--border);
        }

        .modal-header .btn-close {
            filter: invert(1);
        }

        .modal-body .detail-row {
            display: flex;
            padding: 8px 0;
            border-bottom: 1px solid var(--border);
        }

        .modal-body .detail-row:last-child {
            border-bottom: none;
        }

        .modal-body .detail-label {
            width: 35%;
            color: var(--muted);
            font-weight: 500;
            flex-shrink: 0;
        }

        .modal-body .detail-value {
            width: 65%;
            color: var(--text);
            font-weight: 500;
            word-break: break-word;
        }

        .modal-body .detail-value img {
            max-width: 150px;
            border-radius: 10px;
            border: 1px solid var(--border);
            cursor: pointer;
            transition: 0.2s;
        }

        .modal-body .detail-value img:hover {
            transform: scale(1.02);
            border-color: var(--accent);
        }

        .modal-footer {
            border-top: 1px solid var(--border);
        }

        .rejection-reason-box {
            background: rgba(239, 68, 68, 0.08);
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-radius: 8px;
            padding: 8px 14px;
            color: #f87171;
            margin-top: 5px;
            font-size: 13px;
        }

        .admin-message-box {
            background: rgba(34, 211, 238, 0.08);
            border: 1px solid rgba(34, 211, 238, 0.2);
            border-radius: 8px;
            padding: 8px 14px;
            color: var(--accent);
            margin-top: 5px;
            font-size: 13px;
        }

        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination-wrapper .page-link {
            padding: 6px 12px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background: #0b1220;
            color: var(--text);
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 14px;
        }

        .pagination-wrapper .page-link:hover {
            background: rgba(167, 139, 250, 0.1);
            border-color: var(--accent-2);
        }

        .pagination-wrapper .active .page-link {
            background: linear-gradient(180deg, rgba(34, 211, 238, 0.15), rgba(167, 139, 250, 0.15));
            border-color: rgba(34, 211, 238, 0.35);
        }

        .product-status-summary {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            margin-bottom: 5px;
        }

        .product-status-summary .badge-custom {
            font-size: 11px;
            padding: 3px 10px;
        }

        .media-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 5px;
        }

        .media-grid .media-item {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            border: 1px solid var(--border);
            overflow: hidden;
            cursor: pointer;
            transition: 0.2s;
            position: relative;
            background: #0b1220;
        }

        .media-grid .media-item:hover {
            transform: scale(1.05);
            border-color: var(--accent);
        }

        .media-grid .media-item img,
        .media-grid .media-item video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .media-grid .media-item .play-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 28px;
            opacity: 0.8;
            text-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
        }

        .media-modal-content {
            background: transparent;
            border: none;
        }

        .media-modal-body {
            text-align: center;
            padding: 0;
        }

        .media-modal-body img,
        .media-modal-body video {
            max-width: 100%;
            max-height: 80vh;
            border-radius: 14px;
            border: 1px solid var(--border);
        }

        .media-modal-footer {
            border-top: none;
            justify-content: center;
        }

        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .filter-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-bar .filter-group {
                flex-wrap: wrap;
            }

            .filter-bar .form-control,
            .filter-bar .form-select {
                min-width: 100%;
            }

            .modal-body .detail-row {
                flex-direction: column;
                gap: 3px;
            }

            .modal-body .detail-label,
            .modal-body .detail-value {
                width: 100%;
            }

            .table-responsive table {
                min-width: 800px;
            }

            .media-grid .media-item {
                width: 60px;
                height: 60px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h2>مدیریت یکپارچه فروشندگان</h2>
            <a href="{{ route('admin.dashboard') }}" class="btn-back">
                <i class="fas fa-arrow-right"></i> بازگشت به داشبورد
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
        @endif

        <form method="GET" action="{{ route('admin.seller.applications.index') }}" class="filter-bar">
            <div class="filter-group">
                <label for="search"><i class="fas fa-search"></i></label>
                <input type="text" name="search" id="search" class="form-control"
                    placeholder="جستجوی نام کاربر یا محصول..." value="{{ request('search') }}">
            </div>
            <div class="filter-group">
                <label for="identity_status">وضعیت هویت:</label>
                <select name="identity_status" id="identity_status" class="form-select">
                    <option value="">همه</option>
                    <option value="pending" {{ request('identity_status') == 'pending' ? 'selected' : '' }}>در انتظار
                    </option>
                    <option value="approved" {{ request('identity_status') == 'approved' ? 'selected' : '' }}>تأیید شده
                    </option>
                    <option value="rejected" {{ request('identity_status') == 'rejected' ? 'selected' : '' }}>رد شده
                    </option>
                    <option value="none" {{ request('identity_status') == 'none' ? 'selected' : '' }}>ثبت نشده
                    </option>
                </select>
            </div>
            <div class="filter-group">
                <label for="product_status">وضعیت محصول:</label>
                <select name="product_status" id="product_status" class="form-select">
                    <option value="">همه</option>
                    <option value="pending" {{ request('product_status') == 'pending' ? 'selected' : '' }}>در انتظار
                    </option>
                    <option value="approved" {{ request('product_status') == 'approved' ? 'selected' : '' }}>تأیید شده
                    </option>
                    <option value="rejected" {{ request('product_status') == 'rejected' ? 'selected' : '' }}>رد شده
                    </option>
                </select>
            </div>
            <button type="submit" class="btn-filter"><i class="fas fa-filter"></i> اعمال</button>
            <a href="{{ route('admin.seller.applications.index') }}" class="btn-reset"><i class="fas fa-times"></i>
                لغو</a>
        </form>

        <div class="table-wrapper">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>نام کاربر</th>
                            <th>وضعیت هویتی</th>
                            <th>عملیات هویتی</th>
                            <th>محصولات ثبت‌شده</th>
                            <th>عملیات محصولات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            @php
                                $latestApp = $user->sellerApplications->first();
                                $identityStatus = $latestApp ? $latestApp->status : 'none';
                                $products = $user->products;
                                $pendingProducts = $products->where('status', 'pending');
                                $approvedProducts = $products->where('status', 'approved');
                                $rejectedProducts = $products->where('status', 'rejected');
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $user->name }}</strong>
                                    <div style="font-size:12px;color:var(--muted);">{{ $user->username }}</div>
                                </td>
                                <td>
                                    @if ($latestApp)
                                        <span class="badge-custom badge-{{ $identityStatus }}">
                                            {{ $latestApp->getStatusText() }}
                                        </span>
                                        @if ($latestApp->rejection_reason && $identityStatus === 'rejected')
                                            <div class="rejection-reason-box" style="margin-top:5px;font-size:12px;">
                                                <i class="fas fa-comment"></i> دلیل رد:
                                                {{ $latestApp->rejection_reason }}
                                            </div>
                                        @endif
                                    @else
                                        <span class="badge-custom badge-none">ثبت نشده</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="actions-group">
                                        @if ($latestApp)
                                            <button type="button" class="btn-sm btn-info" data-bs-toggle="modal"
                                                data-bs-target="#identityModal{{ $latestApp->id }}">
                                                <i class="fas fa-eye"></i> جزئیات
                                            </button>
                                            @if ($identityStatus === 'pending')
                                                <form
                                                    action="{{ route('admin.seller.applications.approve-identity', $latestApp) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn-sm btn-success"
                                                        onclick="return confirm('آیا از تأیید هویت این کاربر مطمئن هستید؟')">
                                                        <i class="fas fa-check"></i> تایید
                                                    </button>
                                                </form>
                                                <button type="button" class="btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#rejectIdentityModal{{ $latestApp->id }}">
                                                    <i class="fas fa-times"></i> رد
                                                </button>
                                            @elseif($identityStatus === 'approved')
                                                <span class="badge-custom badge-approved" style="cursor:default;">
                                                    <i class="fas fa-check-circle"></i> تأیید شده
                                                </span>
                                            @elseif($identityStatus === 'rejected')
                                                <span class="badge-custom badge-rejected" style="cursor:default;">
                                                    <i class="fas fa-times-circle"></i> رد شده
                                                </span>
                                            @endif
                                        @else
                                            <span style="color:var(--muted);font-size:12px;">بدون درخواست</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="product-status-summary">
                                        <span class="badge-custom badge-pending">در انتظار:
                                            {{ $pendingProducts->count() }}</span>
                                        <span class="badge-custom badge-approved">تایید:
                                            {{ $approvedProducts->count() }}</span>
                                        <span class="badge-custom badge-rejected">رد:
                                            {{ $rejectedProducts->count() }}</span>
                                    </div>
                                    @if ($products->count() > 0)
                                        <details>
                                            <summary
                                                style="cursor:pointer;color:var(--accent-2);font-size:13px;margin-top:5px;">
                                                <i class="fas fa-chevron-down"></i> مشاهده لیست
                                                ({{ $products->count() }})
                                            </summary>
                                            <table class="sub-table">
                                                @foreach ($products as $prod)
                                                    <tr>
                                                        <td class="label">{{ $prod->name }}</td>
                                                        <td>
                                                            <span class="badge-custom badge-{{ $prod->status }}">
                                                                @if ($prod->status === 'pending')
                                                                    در انتظار
                                                                @elseif($prod->status === 'approved')
                                                                    تایید شده
                                                                @elseif($prod->status === 'rejected')
                                                                    رد شده
                                                                @else
                                                                    {{ $prod->status }}
                                                                @endif
                                                            </span>
                                                            @if ($prod->rejection_reason)
                                                                <div
                                                                    style="font-size:11px;color:#f87171;margin-top:3px;">
                                                                    <i class="fas fa-comment"></i>
                                                                    {{ $prod->rejection_reason }}
                                                                </div>
                                                            @endif
                                                            @if (!empty($prod->meta['admin_message']))
                                                                <div
                                                                    style="font-size:11px;color:var(--accent);margin-top:3px;">
                                                                    <i class="fas fa-envelope"></i>
                                                                    {{ $prod->meta['admin_message'] }}
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="actions-group">
                                                                <button type="button" class="btn-sm btn-info"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#productModal{{ $prod->id }}">
                                                                    <i class="fas fa-eye"></i>
                                                                </button>
                                                                @if ($prod->status === 'pending')
                                                                    @if ($identityStatus === 'rejected')
                                                                        <span class="badge-custom badge-rejected"
                                                                            style="cursor:default;font-size:11px;">
                                                                            <i class="fas fa-times-circle"></i> هویت رد
                                                                            شده
                                                                        </span>
                                                                    @else
                                                                        <form
                                                                            action="{{ route('admin.products.approve', $prod) }}"
                                                                            method="POST" style="display:inline;">
                                                                            @csrf
                                                                            <button type="submit"
                                                                                class="btn-sm btn-success"
                                                                                onclick="return confirm('آیا از تأیید این آگهی مطمئن هستید؟')">
                                                                                <i class="fas fa-check"></i>
                                                                            </button>
                                                                        </form>
                                                                        <button type="button"
                                                                            class="btn-sm btn-danger"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#rejectProductModal{{ $prod->id }}">
                                                                            <i class="fas fa-times"></i>
                                                                        </button>
                                                                    @endif
                                                                @elseif($prod->status === 'approved')
                                                                    <span class="badge-custom badge-approved"
                                                                        style="cursor:default;font-size:11px;">
                                                                        <i class="fas fa-check-circle"></i>
                                                                    </span>
                                                                @elseif($prod->status === 'rejected')
                                                                    <span class="badge-custom badge-rejected"
                                                                        style="cursor:default;font-size:11px;">
                                                                        <i class="fas fa-times-circle"></i>
                                                                    </span>
                                                                @endif
                                                                @if (in_array($prod->status, ['pending', 'rejected']))
                                                                    <form
                                                                        action="{{ route('admin.products.destroy', $prod) }}"
                                                                        method="POST" style="display:inline;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn-sm btn-danger"
                                                                            onclick="return confirm('آیا از حذف این آگهی مطمئن هستید؟')">
                                                                            <i class="fas fa-trash"></i>
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </details>
                                    @else
                                        <span style="color:var(--muted);font-size:13px;">هیچ محصولی ثبت نشده</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="actions-group">
                                        <a href="{{ route('admin.products.index', ['user_id' => $user->id]) }}"
                                            class="btn-sm btn-warning">
                                            <i class="fas fa-list"></i> مدیریت
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <!-- ===== مودال جزئیات هویت ===== -->
                            @if ($latestApp)
                                <div class="modal fade" id="identityModal{{ $latestApp->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">جزئیات درخواست هویتی</h5>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="detail-row">
                                                    <div class="detail-label">نام و نام خانوادگی</div>
                                                    <div class="detail-value">{{ $latestApp->first_name }}
                                                        {{ $latestApp->last_name }}</div>
                                                </div>
                                                <div class="detail-row">
                                                    <div class="detail-label">کد ملی</div>
                                                    <div class="detail-value">{{ $latestApp->national_code }}</div>
                                                </div>
                                                <div class="detail-row">
                                                    <div class="detail-label">شماره موبایل</div>
                                                    <div class="detail-value">{{ $latestApp->phone }}</div>
                                                </div>
                                                <div class="detail-row">
                                                    <div class="detail-label">تاریخ تولد</div>
                                                    <div class="detail-value">
                                                        {{ \Illuminate\Support\Str::limit($latestApp->birth_date, 10, '') }}
                                                    </div>
                                                </div>
                                                <div class="detail-row">
                                                    <div class="detail-label">شماره کارت بانکی</div>
                                                    <div class="detail-value">{{ $latestApp->bank_card_number }}</div>
                                                </div>
                                                <div class="detail-row">
                                                    <div class="detail-label">بالای ۱۸ سال</div>
                                                    <div class="detail-value">
                                                        {{ $latestApp->is_over_18 ? 'بله' : 'خیر' }}</div>
                                                </div>
                                                @if (!empty($latestApp->custom_fields_data))
                                                    <div class="detail-row"
                                                        style="flex-direction:column;align-items:stretch;gap:5px;">
                                                        <div class="detail-label" style="width:100%;">فیلدهای اختصاصی
                                                        </div>
                                                        <div class="detail-value" style="width:100%;">
                                                            <ul style="margin:0;padding-right:20px;">
                                                                @foreach ($latestApp->custom_fields_data as $key => $value)
                                                                    <li><strong>{{ $key }}</strong>:
                                                                        {{ is_array($value) ? json_encode($value) : $value }}
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="detail-row">
                                                    <div class="detail-label">تصویر کارت ملی</div>
                                                    <div class="detail-value">
                                                        @if ($latestApp->national_card_image)
                                                            <a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#imageModal{{ $latestApp->id }}">
                                                                <img src="{{ asset('storage/' . $latestApp->national_card_image) }}"
                                                                    alt="کارت ملی">
                                                            </a>
                                                        @else
                                                            <span style="color:var(--muted);">آپلود نشده</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                @if ($latestApp->rejection_reason)
                                                    <div class="detail-row">
                                                        <div class="detail-label">دلیل رد</div>
                                                        <div class="detail-value"
                                                            style="color:#f87171;font-weight:500;">
                                                            {{ $latestApp->rejection_reason }}</div>
                                                    </div>
                                                @endif
                                                @if ($latestApp->admin_message)
                                                    <div class="detail-row">
                                                        <div class="detail-label">پیام ادمین</div>
                                                        <div class="detail-value">{{ $latestApp->admin_message }}
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="detail-row">
                                                    <div class="detail-label">تاریخ ثبت</div>
                                                    <div class="detail-value">
                                                        {{ $latestApp->created_at->format('Y/m/d H:i') }}</div>
                                                </div>
                                                @if ($latestApp->reviewed_at)
                                                    <div class="detail-row">
                                                        <div class="detail-label">تاریخ بررسی</div>
                                                        <div class="detail-value">
                                                            {{ $latestApp->reviewed_at->format('Y/m/d H:i') }}</div>
                                                    </div>
                                                @endif
                                                <div class="detail-row">
                                                    <div class="detail-label">وضعیت</div>
                                                    <div class="detail-value">
                                                        <span class="badge-custom badge-{{ $latestApp->status }}">
                                                            {{ $latestApp->getStatusText() }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn-sm btn-secondary"
                                                    data-bs-dismiss="modal">بستن</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- مودال بزرگنمایی تصویر کارت ملی -->
                                @if ($latestApp->national_card_image)
                                    <div class="modal fade" id="imageModal{{ $latestApp->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content" style="background:transparent;border:none;">
                                                <div class="modal-header"
                                                    style="border-bottom:none;padding-bottom:0;">
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body" style="text-align:center;padding:0;">
                                                    <img src="{{ asset('storage/' . $latestApp->national_card_image) }}"
                                                        style="max-width:100%;max-height:80vh;border-radius:14px;border:1px solid var(--border);">
                                                </div>
                                                <div class="modal-footer"
                                                    style="border-top:none;justify-content:center;">
                                                    <button type="button" class="btn-sm btn-secondary"
                                                        data-bs-dismiss="modal">بستن</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- مودال رد هویت -->
                                @if ($identityStatus === 'pending')
                                    <div class="modal fade" id="rejectIdentityModal{{ $latestApp->id }}"
                                        tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form
                                                    action="{{ route('admin.seller.applications.reject-identity', $latestApp) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">رد درخواست هویتی</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p style="color:var(--muted);">لطفاً دلیل رد را وارد کنید.</p>
                                                        <div class="form-group">
                                                            <label style="color:var(--muted);font-weight:500;">دلیل رد
                                                                <span style="color:var(--danger);">*</span></label>
                                                            <textarea name="rejection_reason" class="form-control"
                                                                style="width:100%;background:#0b1220;border:1px solid var(--border);border-radius:10px;padding:12px;color:var(--text);font-family:inherit;"
                                                                rows="4" required></textarea>
                                                        </div>
                                                        <div class="form-group" style="margin-top:15px;">
                                                            <label style="color:var(--muted);font-weight:500;">پیام
                                                                اضافی (اختیاری)</label>
                                                            <input type="text" name="admin_message"
                                                                class="form-control"
                                                                style="width:100%;background:#0b1220;border:1px solid var(--border);border-radius:10px;padding:12px;color:var(--text);font-family:inherit;"
                                                                placeholder="پیام تکمیلی به کاربر...">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn-sm btn-secondary"
                                                            data-bs-dismiss="modal">انصراف</button>
                                                        <button type="submit" class="btn-sm btn-danger">
                                                            <i class="fas fa-times"></i> رد درخواست
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            <!-- ===== مودال جزئیات محصول ===== -->
                            @foreach ($products as $prod)
                                <div class="modal fade" id="productModal{{ $prod->id }}" tabindex="-1"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">جزئیات آگهی</h5>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="detail-row">
                                                    <div class="detail-label">عنوان</div>
                                                    <div class="detail-value">{{ $prod->name }}</div>
                                                </div>
                                                <div class="detail-row">
                                                    <div class="detail-label">قیمت</div>
                                                    <div class="detail-value">
                                                        @if ($prod->discount_price && $prod->discount_price > 0)
                                                            <span
                                                                style="text-decoration:line-through;color:var(--muted);">{{ number_format($prod->price) }}
                                                                تومان</span>
                                                            <span
                                                                style="color:var(--success);">{{ number_format($prod->discount_price) }}
                                                                تومان</span>
                                                        @else
                                                            {{ number_format($prod->price) }} تومان
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="detail-row">
                                                    <div class="detail-label">موجودی</div>
                                                    <div class="detail-value">{{ $prod->quantity }}</div>
                                                </div>
                                                <div class="detail-row">
                                                    <div class="detail-label">نوع بازی (زیردسته دوم)</div>
                                                    <div class="detail-value">
                                                        {{ $prod->subSubcategory->name ?? 'نامشخص' }}</div>
                                                </div>
                                                <div class="detail-row">
                                                    <div class="detail-label">دسته‌بندی</div>
                                                    <div class="detail-value">
                                                        @php
                                                            $catNames = array_filter([
                                                                $prod->category->name ?? '',
                                                                $prod->subcategory->name ?? '',
                                                                $prod->subSubcategory->name ?? '',
                                                            ]);
                                                        @endphp
                                                        {{ implode(' → ', $catNames) ?: 'نامشخص' }}
                                                    </div>
                                                </div>
                                                <div class="detail-row">
                                                    <div class="detail-label">توضیحات</div>
                                                    <div class="detail-value">{{ $prod->description ?: 'ندارد' }}
                                                    </div>
                                                </div>
                                                @if ($prod->attributes->count() > 0)
                                                    <div class="detail-row"
                                                        style="flex-direction:column;align-items:stretch;gap:5px;">
                                                        <div class="detail-label" style="width:100%;">ویژگی‌ها</div>
                                                        <div class="detail-value" style="width:100%;">
                                                            <ul style="margin:0;padding-right:20px;">
                                                                @foreach ($prod->attributes as $attr)
                                                                    <li><strong>{{ $attr->key }}</strong>:
                                                                        {{ $attr->value }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($prod->media->count() > 0)
                                                    <div class="detail-row"
                                                        style="flex-direction:column;align-items:stretch;gap:5px;">
                                                        <div class="detail-label" style="width:100%;">رسانه‌ها
                                                            ({{ $prod->media->count() }})
                                                        </div>
                                                        <div class="detail-value" style="width:100%;">
                                                            <div class="media-grid">
                                                                @foreach ($prod->media as $media)
                                                                    @php
                                                                        $isImage = in_array($media->file_type, [
                                                                            'image/jpeg',
                                                                            'image/png',
                                                                            'image/gif',
                                                                            'image/webp',
                                                                            'image/jpg',
                                                                        ]);
                                                                    @endphp
                                                                    <div class="media-item" data-bs-toggle="modal"
                                                                        data-bs-target="#mediaModal{{ $media->id }}">
                                                                        @if ($isImage)
                                                                            <img src="{{ asset('storage/' . $media->file_path) }}"
                                                                                alt="رسانه">
                                                                        @else
                                                                            <video
                                                                                src="{{ asset('storage/' . $media->file_path) }}"
                                                                                muted></video>
                                                                            <div class="play-icon"><i
                                                                                    class="fas fa-play-circle"></i>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($prod->cover)
                                                    <div class="detail-row">
                                                        <div class="detail-label">تصویر کاور</div>
                                                        <div class="detail-value">
                                                            <a href="#" data-bs-toggle="modal"
                                                                data-bs-target="#coverModal{{ $prod->id }}">
                                                                <img src="{{ asset('storage/' . $prod->cover) }}"
                                                                    alt="کاور">
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($prod->rejection_reason)
                                                    <div class="detail-row">
                                                        <div class="detail-label">دلیل رد</div>
                                                        <div class="detail-value"
                                                            style="color:#f87171;font-weight:500;">
                                                            {{ $prod->rejection_reason }}</div>
                                                    </div>
                                                @endif
                                                @if (!empty($prod->meta['admin_message']))
                                                    <div class="detail-row">
                                                        <div class="detail-label">پیام ادمین</div>
                                                        <div class="detail-value">{{ $prod->meta['admin_message'] }}
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="detail-row">
                                                    <div class="detail-label">وضعیت</div>
                                                    <div class="detail-value">
                                                        <span class="badge-custom badge-{{ $prod->status }}">
                                                            @if ($prod->status === 'pending')
                                                                در انتظار
                                                            @elseif($prod->status === 'approved')
                                                                تایید شده
                                                            @elseif($prod->status === 'rejected')
                                                                رد شده
                                                            @else
                                                                {{ $prod->status }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="detail-row">
                                                    <div class="detail-label">تاریخ ثبت</div>
                                                    <div class="detail-value">
                                                        {{ $prod->created_at->format('Y/m/d H:i') }}</div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn-sm btn-secondary"
                                                    data-bs-dismiss="modal">بستن</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- مودال بزرگنمایی کاور -->
                                @if ($prod->cover)
                                    <div class="modal fade" id="coverModal{{ $prod->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content" style="background:transparent;border:none;">
                                                <div class="modal-header"
                                                    style="border-bottom:none;padding-bottom:0;">
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body" style="text-align:center;padding:0;">
                                                    <img src="{{ asset('storage/' . $prod->cover) }}"
                                                        style="max-width:100%;max-height:80vh;border-radius:14px;border:1px solid var(--border);">
                                                </div>
                                                <div class="modal-footer"
                                                    style="border-top:none;justify-content:center;">
                                                    <button type="button" class="btn-sm btn-secondary"
                                                        data-bs-dismiss="modal">بستن</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- مودال بزرگنمایی هر رسانه -->
                                @foreach ($prod->media as $media)
                                    @php
                                        $isImage = in_array($media->file_type, [
                                            'image/jpeg',
                                            'image/png',
                                            'image/gif',
                                            'image/webp',
                                            'image/jpg',
                                        ]);
                                    @endphp
                                    <div class="modal fade" id="mediaModal{{ $media->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content" style="background:transparent;border:none;">
                                                <div class="modal-header"
                                                    style="border-bottom:none;padding-bottom:0;">
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body" style="text-align:center;padding:0;">
                                                    @if ($isImage)
                                                        <img src="{{ asset('storage/' . $media->file_path) }}"
                                                            style="max-width:100%;max-height:80vh;border-radius:14px;border:1px solid var(--border);">
                                                    @else
                                                        <video controls
                                                            style="max-width:100%;max-height:80vh;border-radius:14px;border:1px solid var(--border);">
                                                            <source src="{{ asset('storage/' . $media->file_path) }}"
                                                                type="{{ $media->file_type }}">
                                                            مرورگر شما از پخش ویدیو پشتیبانی نمی‌کند.
                                                        </video>
                                                    @endif
                                                </div>
                                                <div class="modal-footer"
                                                    style="border-top:none;justify-content:center;">
                                                    <button type="button" class="btn-sm btn-secondary"
                                                        data-bs-dismiss="modal">بستن</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- مودال رد محصول -->
                                @if ($prod->status === 'pending')
                                    <div class="modal fade" id="rejectProductModal{{ $prod->id }}"
                                        tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.products.reject', $prod) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">رد آگهی</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p style="color:var(--muted);">لطفاً دلیل رد آگهی را وارد کنید.
                                                        </p>
                                                        <div class="form-group">
                                                            <label style="color:var(--muted);font-weight:500;">دلیل رد
                                                                <span style="color:var(--danger);">*</span></label>
                                                            <textarea name="rejection_reason" class="form-control"
                                                                style="width:100%;background:#0b1220;border:1px solid var(--border);border-radius:10px;padding:12px;color:var(--text);font-family:inherit;"
                                                                rows="4" required></textarea>
                                                        </div>
                                                        <div class="form-group" style="margin-top:15px;">
                                                            <label style="color:var(--muted);font-weight:500;">پیام
                                                                اضافی (اختیاری)</label>
                                                            <input type="text" name="admin_message"
                                                                class="form-control"
                                                                style="width:100%;background:#0b1220;border:1px solid var(--border);border-radius:10px;padding:12px;color:var(--text);font-family:inherit;"
                                                                placeholder="پیام تکمیلی به کاربر...">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn-sm btn-secondary"
                                                            data-bs-dismiss="modal">انصراف</button>
                                                        <button type="submit" class="btn-sm btn-danger">
                                                            <i class="fas fa-times"></i> رد آگهی
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="6" style="text-align:center;padding:40px;color:var(--muted);">
                                    <i class="fas fa-inbox"
                                        style="font-size:32px;display:block;margin-bottom:10px;opacity:0.3;"></i>
                                    هیچ کاربری درخواست فروشندگی ثبت نکرده است.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($users->hasPages())
            <div class="pagination-wrapper">{{ $users->links() }}</div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // پخش خودکار ویدیو در مودال
        document.querySelectorAll('.media-item video').forEach(video => {
            video.addEventListener('click', function(e) {
                e.stopPropagation();
                const parent = this.closest('.media-item');
                if (parent) {
                    const modalId = parent.getAttribute('data-bs-target');
                    if (modalId) {
                        const modal = document.querySelector(modalId);
                        if (modal) {
                            const videoEl = modal.querySelector('video');
                            if (videoEl) {
                                setTimeout(() => videoEl.play(), 300);
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>

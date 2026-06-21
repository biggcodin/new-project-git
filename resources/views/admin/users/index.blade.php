<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت کاربران</title>
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

        /* Filter Card */
        .filter-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 20px;
            margin-bottom: 25px;
            backdrop-filter: blur(6px);
        }

        .filter-form {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr auto;
            gap: 15px;
            align-items: end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .filter-label {
            color: var(--muted);
            font-size: 12px;
            font-weight: 500;
        }

        .filter-input,
        .filter-select {
            appearance: none;
            border: 1px solid var(--border);
            background: #0b1220;
            color: var(--text);
            border-radius: 10px;
            padding: 10px 12px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            font-family: inherit;
            font-size: 14px;
            width: 100%;
        }

        .filter-input:focus,
        .filter-select:focus {
            border-color: rgba(34, 211, 238, 0.6);
            box-shadow: 0 0 0 3px rgba(34, 211, 238, 0.15);
        }

        .filter-buttons {
            display: flex;
            gap: 10px;
        }

        /* Buttons */
        .btn-custom {
            padding: 10px 20px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            font-family: inherit;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--accent-2), #8b5cf6);
            color: white;
            box-shadow: 0 4px 15px -3px rgba(167, 139, 250, 0.4);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px -3px rgba(167, 139, 250, 0.6);
        }

        .btn-secondary-custom {
            background: linear-gradient(180deg, #101827, #0b1220);
            color: var(--text);
            border: 1px solid var(--border);
        }

        .btn-secondary-custom:hover {
            transform: translateY(-2px);
            border-color: var(--muted);
        }

        .btn-warning-custom {
            background: rgba(245, 158, 11, 0.15);
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .btn-warning-custom:hover {
            background: rgba(245, 158, 11, 0.25);
            transform: translateY(-2px);
        }

        .btn-danger-custom {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .btn-danger-custom:hover {
            background: rgba(239, 68, 68, 0.25);
            transform: translateY(-2px);
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
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

        /* Cell Styles */
        .cell-name {
            font-weight: 600;
            color: var(--text);
        }

        .cell-username {
            color: var(--accent);
            font-family: monospace;
            direction: ltr;
            text-align: right;
        }

        .cell-email {
            color: var(--muted);
            font-size: 13px;
            direction: ltr;
            text-align: right;
        }

        .cell-phone {
            color: var(--muted);
            direction: ltr;
            text-align: right;
        }

        .cell-date {
            color: var(--muted);
            font-size: 12px;
            direction: ltr;
            text-align: right;
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

        .role-badge {
            background: rgba(167, 139, 250, 0.12);
            color: #c4b5fd;
            border: 1px solid rgba(167, 139, 250, 0.35);
        }

        .status-approved {
            background: rgba(16, 185, 129, 0.12);
            color: #d1fae5;
            border: 1px solid rgba(16, 185, 129, 0.35);
        }

        .status-approved::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--success);
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

        .status-rejected {
            background: rgba(239, 68, 68, 0.12);
            color: #fee2e2;
            border: 1px solid rgba(239, 68, 68, 0.35);
        }

        .status-rejected::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--danger);
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

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }

        /* Pagination */
        .pagination-wrapper {
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

        .pagination-wrapper .disabled .page-link {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .filter-form {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .filter-form {
                grid-template-columns: 1fr;
            }

            .filter-buttons {
                flex-direction: column;
            }

            .filter-buttons .btn-custom {
                width: 100%;
                justify-content: center;
            }

            .action-buttons {
                flex-direction: column;
            }

            .action-buttons .btn-custom {
                width: 100%;
                justify-content: center;
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

<body>
    <div class="container">
        <div class="page-header">
            <h2>مدیریت کاربران</h2>
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

        <div class="filter-card">
            <form method="GET" class="filter-form">
                <div class="filter-group">
                    <label class="filter-label">جستجو</label>
                    <input type="text" name="search" class="filter-input" placeholder="جستجوی نام/ایمیل/کاربر"
                        value="{{ request('search') }}">
                </div>
                <div class="filter-group">
                    <label class="filter-label">وضعیت</label>
                    <select name="status" class="filter-select">
                        <option value="">همه وضعیت‌ها</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>تایید شده
                        </option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>در انتظار
                        </option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>رد شده</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">نقش</label>
                    <select name="role" class="filter-select">
                        <option value="">همه نقش‌ها</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role }}" {{ request('role') == $role ? 'selected' : '' }}>
                                {{ match ($role) {
                                    'super_admin' => 'سوپر ادمین',
                                    'admin' => 'ادمین',
                                    'seller' => 'فروشنده',
                                    'buyer' => 'خریدار',
                                    'user' => 'کاربر عادی',
                                    default => $role,
                                } }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-buttons">
                    <button type="submit" class="btn-custom btn-primary-custom">
                        <i class="fas fa-search"></i>
                        جستجو
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn-custom btn-secondary-custom">
                        <i class="fas fa-redo"></i>
                        ریست
                    </a>
                </div>
            </form>
        </div>

        @if ($users->count())
            <div class="table-wrapper">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام</th>
                                <th>نام کاربری</th>
                                <th>ایمیل</th>
                                <th>تلفن</th>
                                <th>نقش</th>
                                <th>وضعیت</th>
                                <th>تاریخ ثبت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td style="color: var(--muted);">{{ $user->id }}</td>
                                    <td class="cell-name">{{ $user->name }}</td>
                                    <td class="cell-username">{{ $user->username }}</td>
                                    <td class="cell-email">{{ $user->email }}</td>
                                    <td class="cell-phone">{{ $user->phone ?? '---' }}</td>
                                    <td>
                                        <span class="badge-custom role-badge">
                                            <i
                                                class="fas {{ match ($user->role) {
                                                    'super_admin' => 'fa-crown',
                                                    'admin' => 'fa-user-shield',
                                                    'seller' => 'fa-store',
                                                    'buyer' => 'fa-shopping-bag',
                                                    'user' => 'fa-user',
                                                    default => 'fa-user',
                                                } }}"></i>
                                            {{ match ($user->role) {
                                                'super_admin' => 'سوپر ادمین',
                                                'admin' => 'ادمین',
                                                'seller' => 'فروشنده',
                                                'buyer' => 'خریدار',
                                                'user' => 'کاربر عادی',
                                                default => $user->role,
                                            } }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($user->status == 'approved')
                                            <span class="badge-custom status-approved">تایید شده</span>
                                        @elseif($user->status == 'pending')
                                            <span class="badge-custom status-pending">در انتظار</span>
                                        @else
                                            <span class="badge-custom status-rejected">رد شده</span>
                                        @endif
                                    </td>
                                    <td class="cell-date">{{ $user->created_at->format('Y/m/d H:i') }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.users.edit', $user) }}"
                                                class="btn-custom btn-warning-custom btn-sm">
                                                <i class="fas fa-edit"></i>
                                                ویرایش
                                            </a>
                                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-custom btn-danger-custom btn-sm"
                                                    onclick="return confirm('آیا مطمئنید می‌خواهید این کاربر را حذف کنید؟')">
                                                    <i class="fas fa-trash"></i>
                                                    حذف
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
                {{ $users->links() }}
            </div>
        @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle" style="font-size: 24px; margin-bottom: 10px; display: block;"></i>
                <p style="margin: 0;">کاربری یافت نشد.</p>
            </div>
        @endif
    </div>
</body>

</html>

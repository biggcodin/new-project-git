```html
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت برچسب‌ها</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border);
        }

        .page-header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -0.02em;
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
        }

        .btn-success-custom {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .btn-success-custom:hover {
            background: rgba(16, 185, 129, 0.25);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px -5px rgba(16, 185, 129, 0.4);
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

        .btn-secondary-custom {
            background: linear-gradient(180deg, #101827, #0b1220);
            color: var(--text);
            border: 1px solid var(--border);
        }

        .btn-secondary-custom:hover {
            transform: translateY(-2px);
            border-color: var(--muted);
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
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            min-width: 800px;
        }

        thead th {
            background: linear-gradient(180deg, #0e1626, #0d1524);
            color: var(--muted);
            font-weight: 600;
            font-size: 13px;
            text-align: center;
            padding: 15px;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }

        tbody td {
            padding: 15px;
            border-bottom: 1px solid var(--border);
            color: var(--text);
            vertical-align: middle;
            text-align: center;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background: rgba(167, 139, 250, 0.05);
        }

        /* Tag Name */
        .tag-name {
            font-weight: 600;
            color: var(--accent);
        }

        /* Slug */
        .tag-slug {
            color: var(--muted);
            font-size: 12px;
            direction: ltr;
            font-family: monospace;
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

        .status-active {
            background: rgba(16, 185, 129, 0.12);
            color: #d1fae5;
            border: 1px solid rgba(16, 185, 129, 0.35);
        }

        .status-active::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--success);
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

        /* Date */
        .date-cell {
            color: var(--muted);
            font-size: 12px;
            direction: ltr;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 5px;
            justify-content: center;
            flex-wrap: wrap;
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

        .pagination-wrapper .disabled .page-link {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Modal Styles */
        .modal-content {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            color: var(--text);
        }

        .modal-header {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.03), rgba(255, 255, 255, 0.0));
            border-bottom: 1px solid var(--border);
            padding: 20px;
        }

        .modal-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text);
        }

        .modal-body {
            padding: 20px;
        }

        .modal-footer {
            background: linear-gradient(180deg, #0d1524, #0b1220);
            border-top: 1px solid var(--border);
            padding: 15px 20px;
        }

        .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        /* Form Controls in Modal */
        .form-label {
            color: var(--muted);
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 6px;
            display: block;
        }

        .form-control {
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

        .form-control:focus {
            border-color: rgba(34, 211, 238, 0.6);
            box-shadow: 0 0 0 3px rgba(34, 211, 238, 0.15);
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
            <h1>مدیریت برچسب‌ها</h1>
        </div>

        <!-- دکمه افزودن برچسب -->
        <div style="text-align: left; margin-bottom: 20px;">
            <button class="btn-custom btn-success-custom" data-bs-toggle="modal" data-bs-target="#addTagModal">
                <i class="fas fa-plus"></i>
                افزودن برچسب جدید
            </button>
        </div>

        <!-- جدول برچسب‌ها -->
        <div class="table-wrapper">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>شناسه</th>
                            <th>نام برچسب</th>
                            <th>اسلاگ</th>
                            <th>وضعیت</th>
                            <th>تاریخ ایجاد</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            <tr>
                                <td>{{ $tag->id }}</td>
                                <td class="tag-name">{{ $tag->name }}</td>
                                <td class="tag-slug">{{ $tag->slug }}</td>
                                <td>
                                    <span class="status-badge status-active">فعال</span>
                                </td>
                                <td class="date-cell">{{ $tag->created_at->format('Y/m/d') }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <!-- دکمه ویرایش -->
                                        <button class="btn-custom btn-warning-custom btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editTagModal{{ $tag->id }}">
                                            <i class="fas fa-edit"></i>
                                            ویرایش
                                        </button>
                                        <!-- دکمه حذف -->
                                        <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST"
                                            id="delete-form-{{ $tag->id }}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <button type="button" class="btn-custom btn-danger-custom btn-sm"
                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $tag->id }}').submit();">
                                            <i class="fas fa-trash"></i> حذف
                                        </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- مدال ویرایش برچسب -->
                            <div class="modal fade" id="editTagModal{{ $tag->id }}" tabindex="-1"
                                aria-labelledby="editTagModalLabel{{ $tag->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.tags.update', $tag->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editTagModalLabel{{ $tag->id }}">
                                                    ویرایش برچسب
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="بستن"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">نام برچسب</label>
                                                    <input type="text" name="name" class="form-control"
                                                        value="{{ $tag->name }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn-custom btn-primary-custom">
                                                    ذخیره تغییرات
                                                </button>
                                                <button type="button" class="btn-custom btn-secondary-custom"
                                                    data-bs-dismiss="modal">
                                                    بستن
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- صفحه‌بندی -->
        <div class="pagination-wrapper">
            {{ $tags->links() }}
        </div>
    </div>

    <!-- مدال افزودن برچسب -->
    <div class="modal fade" id="addTagModal" tabindex="-1" aria-labelledby="addTagModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.tags.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTagModalLabel">افزودن برچسب جدید</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">نام برچسب</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn-custom btn-success-custom">
                            ثبت برچسب
                        </button>
                        <button type="button" class="btn-custom btn-secondary-custom" data-bs-dismiss="modal">
                            بستن
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
```

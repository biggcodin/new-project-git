```html
<!doctype html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت ویدیوها</title>
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

        /* Alert */
        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid;
            position: relative;
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

        .alert-danger ul {
            margin: 0;
            padding-right: 20px;
        }

        .alert-info {
            background: rgba(34, 211, 238, 0.1);
            color: var(--accent);
            border-color: rgba(34, 211, 238, 0.3);
        }

        .alert-dismissible {
            padding-left: 50px;
        }

        .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
            position: absolute;
            top: 15px;
            left: 15px;
        }

        /* Card */
        .card-custom {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
        }

        .card-header-custom {
            padding: 20px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.03), rgba(255, 255, 255, 0.0));
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .card-body-custom {
            padding: 20px;
        }

        /* Search Form */
        .search-form {
            display: flex;
            gap: 10px;
            flex: 1;
        }

        .search-input {
            flex: 1;
            appearance: none;
            border: 1px solid var(--border);
            background: #0b1220;
            color: var(--text);
            border-radius: 10px;
            padding: 10px 15px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            font-family: inherit;
            font-size: 14px;
        }

        .search-input:focus {
            border-color: rgba(34, 211, 238, 0.6);
            box-shadow: 0 0 0 3px rgba(34, 211, 238, 0.15);
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
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            min-width: 900px;
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
        .cell-title {
            font-weight: 600;
            color: var(--text);
        }

        .cell-link {
            color: var(--accent);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .cell-link:hover {
            color: var(--accent-2);
        }

        .cell-description {
            color: var(--muted);
            font-size: 13px;
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .cell-empty {
            color: var(--muted);
        }

        /* Empty State */
        .empty-state {
            padding: 40px;
            text-align: center;
            color: var(--muted);
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

        textarea.form-control {
            resize: vertical;
            min-height: 80px;
        }

        .form-text {
            color: var(--muted);
            font-size: 12px;
            margin-top: 5px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .card-header-custom {
                flex-direction: column;
                align-items: stretch;
            }

            .search-form {
                flex-direction: column;
            }

            .btn-custom {
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
            <h1>مدیریت ویدیوها</h1>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- نمایش خطاها --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card-custom">
            <div class="card-header-custom">
                <form method="GET" action="{{ route('videos.index') }}" class="search-form">
                    <input type="text" name="search" class="search-input" placeholder="جستجوی عنوان..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn-custom btn-primary-custom">
                        <i class="fas fa-search"></i>
                        جستجو
                    </button>
                </form>
                <button class="btn-custom btn-success-custom" data-bs-toggle="modal" data-bs-target="#addVideoModal">
                    <i class="fas fa-plus"></i>
                    افزودن ویدیو
                </button>
            </div>

            <div class="card-body-custom">
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان</th>
                                <th>مسیر فایل</th>
                                <th>لینک خارجی</th>
                                <th>توضیحات</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($videos as $video)
                                <tr>
                                    <td style="color: var(--muted);">
                                        {{ $loop->iteration + ($videos->currentPage() - 1) * $videos->perPage() }}</td>
                                    <td class="cell-title">{{ $video->title }}</td>
                                    <td>
                                        @if ($video->path)
                                            <a href="{{ asset($video->path) }}" target="_blank" class="cell-link">
                                                <i class="fas fa-eye"></i> مشاهده
                                            </a>
                                        @else
                                            <span class="cell-empty">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($video->url)
                                            <a href="{{ $video->url }}" target="_blank" class="cell-link">
                                                <i class="fas fa-external-link-alt"></i> لینک
                                            </a>
                                        @else
                                            <span class="cell-empty">-</span>
                                        @endif
                                    </td>
                                    <td class="cell-description">{{ $video->description ?? '-' }}</td>
                                    <td>
                                        <form action="{{ route('videos.destroy', $video->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-custom btn-danger-custom btn-sm"
                                                onclick="return confirm('آیا مطمئن هستید؟')">
                                                <i class="fas fa-trash"></i>
                                                حذف
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="empty-state">
                                        <i class="fas fa-video-slash"
                                            style="font-size: 48px; margin-bottom: 15px; opacity: 0.3;"></i>
                                        <div>هیچ ویدیویی یافت نشد</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($videos->hasPages())
                    <div class="pagination-wrapper">
                        {{ $videos->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal افزودن ویدیو -->
    <div class="modal fade" id="addVideoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">افزودن ویدیو جدید</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">عنوان ویدیو *</label>
                            <input type="text" id="title" name="title" class="form-control" required
                                value="{{ old('title') }}">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">توضیحات</label>
                            <textarea id="description" name="description" class="form-control" rows="2">{{ old('description') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="video" class="form-label">آپلود فایل ویدیو</label>
                            <input type="file" id="video" name="video" class="form-control"
                                accept="video/*">
                            <div class="form-text">حداکثر حجم: 50 مگابایت</div>
                        </div>
                        <div class="mb-3">
                            <label for="video_url" class="form-label">یا لینک ویدیو</label>
                            <input type="url" id="video_url" name="video_url" class="form-control"
                                placeholder="https://example.com/video.mp4" value="{{ old('video_url') }}">
                        </div>
                        <div class="alert alert-info small">
                            <i class="fas fa-info-circle"></i>
                            <strong>توجه:</strong> آپلود فایل یا وارد کردن لینک ویدیو الزامی است.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-custom btn-secondary-custom" data-bs-dismiss="modal">
                            انصراف
                        </button>
                        <button type="submit" class="btn-custom btn-primary-custom">
                            <i class="fas fa-save"></i>
                            ذخیره ویدیو
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // فعال کردن توستر برای پیام‌ها
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.querySelector('.alert');
            if (alert) {
                setTimeout(() => {
                    alert.classList.add('fade');
                    setTimeout(() => alert.remove(), 150);
                }, 5000);
            }
        });
    </script>
</body>

</html>
```

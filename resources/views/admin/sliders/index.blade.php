<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت اسلایدرها</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Custom Styles -->
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

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
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

        /* Search Form */
        .search-form {
            margin-bottom: 30px;
        }

        .search-input-group {
            display: flex;
            gap: 10px;
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
            min-width: 1200px;
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

        .status-inactive {
            background: rgba(239, 68, 68, 0.12);
            color: #fee2e2;
            border: 1px solid rgba(239, 68, 68, 0.35);
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

        /* Images */
        .table-image {
            width: 100px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid var(--border);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .table-image:hover {
            transform: scale(1.1);
            border-color: var(--accent);
        }

        .no-image {
            color: var(--muted);
            font-size: 12px;
        }

        /* Links */
        .link-cell {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .link-cell a {
            color: var(--accent);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .link-cell a:hover {
            color: var(--accent-2);
        }

        /* Description */
        .description-cell {
            color: var(--muted);
            font-size: 12px;
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 5px;
            justify-content: center;
            flex-wrap: wrap;
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

        textarea.form-control {
            resize: vertical;
            min-height: 80px;
        }

        .img-preview {
            max-height: 100px;
            margin-top: 10px;
            border-radius: 8px;
            border: 2px solid var(--border);
        }

        /* Image Modal */
        .modal-image {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            border: 2px solid var(--border);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .search-input-group {
                flex-direction: column;
            }

            .action-buttons {
                flex-direction: column;
            }

            .action-buttons .btn-custom {
                width: 100%;
                justify-content: center;
            }

            .modal-lg {
                max-width: 98vw !important;
                margin: 0 auto;
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
            <h2>مدیریت اسلایدرها</h2>
        </div>

        <!-- دکمه افزودن اسلایدر -->
        <div style="margin-bottom: 20px;">
            <button class="btn-custom btn-success-custom" data-bs-toggle="modal" data-bs-target="#addSliderModal">
                <i class="fas fa-plus"></i>
                افزودن اسلایدر
            </button>
        </div>

        <!-- پیام موفقیت -->
        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- فرم جستجو -->
        <form method="GET" action="{{ route('admin.sliders.index') }}" class="search-form">
            <div class="search-input-group">
                <input type="text" name="search" value="{{ request('search') }}" class="search-input"
                    placeholder="جستجو...">
                <button class="btn-custom btn-primary-custom" type="submit">
                    <i class="fas fa-search"></i>
                    جستجو
                </button>
            </div>
        </form>

        <!-- جدول نمایش اسلایدرها -->
        <div class="table-wrapper">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>عنوان</th>
                            <th>زیرعنوان</th>
                            <th>متن قیمت</th>
                            <th>مقدار قیمت</th>
                            <th>واحد قیمت</th>
                            <th>لینک</th>
                            <th>تصویر</th>
                            <th>توضیحات</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($slides as $slide)
                            <tr>
                                <td style="font-weight: 600;">{{ $slide->title }}</td>
                                <td>{{ $slide->subtitle }}</td>
                                <td>{{ $slide->price_text }}</td>
                                <td>{{ $slide->price_value }}</td>
                                <td>{{ $slide->price_unit }}</td>
                                <td class="link-cell">
                                    @if ($slide->link)
                                        <a href="{{ $slide->link }}" target="_blank">
                                            <i class="fas fa-external-link-alt"></i>
                                            {{ $slide->link }}
                                        </a>
                                    @else
                                        <span class="no-image">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($slide->image)
                                        <img src="{{ asset('storage/' . $slide->image) }}" class="table-image"
                                            data-bs-toggle="modal" data-bs-target="#imageModal{{ $slide->id }}">
                                    @else
                                        <span class="no-image">بدون تصویر</span>
                                    @endif
                                </td>
                                <td class="description-cell">{{ Str::limit($slide->description, 50) }}</td>
                                <td>
                                    <span class="status-badge status-active">فعال</span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <!-- دکمه ویرایش -->
                                        <button class="btn-custom btn-warning-custom btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editSliderModal{{ $slide->id }}">
                                            <i class="fas fa-edit"></i>
                                            ویرایش
                                        </button>
                                        <!-- فرم حذف -->
                                        <form action="{{ route('sliders.destroy', $slide->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-custom btn-danger-custom btn-sm"
                                                onclick="return confirm('آیا مطمئن هستید؟')">
                                                <i class="fas fa-trash"></i>
                                                حذف
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            <!-- مودال نمایش تصویر -->
                            <div class="modal fade" id="imageModal{{ $slide->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">تصویر اسلایدر</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="بستن"></button>
                                        </div>
                                        <div class="modal-body" style="text-align: center;">
                                            <img src="{{ asset('storage/' . $slide->image) }}" class="modal-image"
                                                alt="تصویر اسلایدر">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- مودال ویرایش -->
                            <div class="modal fade" id="editSliderModal{{ $slide->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">ویرایش اسلایدر</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="بستن"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('sliders.update', $slide->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">عنوان</label>
                                                        <input type="text" name="title" class="form-control"
                                                            value="{{ $slide->title }}" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">زیرعنوان</label>
                                                        <input type="text" name="subtitle" class="form-control"
                                                            value="{{ $slide->subtitle }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">متن قیمت</label>
                                                        <input type="text" name="price_text" class="form-control"
                                                            value="{{ $slide->price_text }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">مقدار قیمت</label>
                                                        <input type="text" name="price_value" class="form-control"
                                                            value="{{ $slide->price_value }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">واحد قیمت</label>
                                                        <input type="text" name="price_unit" class="form-control"
                                                            value="{{ $slide->price_unit }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">لینک</label>
                                                        <input type="url" name="link" class="form-control"
                                                            value="{{ $slide->link }}">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="form-label">توضیحات</label>
                                                        <textarea name="description" rows="3" class="form-control">{{ $slide->description }}</textarea>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="form-label">تصویر</label>
                                                        <input type="file" name="image" class="form-control">
                                                        @if ($slide->image)
                                                            <img src="{{ asset('storage/' . $slide->image) }}"
                                                                class="img-preview">
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer"
                                                    style="padding: 15px 0 0 0; border-top: none;">
                                                    <button type="submit" class="btn-custom btn-primary-custom">
                                                        <i class="fas fa-save"></i>
                                                        ذخیره تغییرات
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- مودال افزودن -->
        <div class="modal fade" id="addSliderModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">افزودن اسلایدر</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">عنوان</label>
                                    <input type="text" name="title" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">زیرعنوان</label>
                                    <input type="text" name="subtitle" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">متن قیمت</label>
                                    <input type="text" name="price_text" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">مقدار قیمت</label>
                                    <input type="text" name="price_value" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">واحد قیمت</label>
                                    <input type="text" name="price_unit" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">لینک</label>
                                    <input type="url" name="link" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">توضیحات</label>
                                    <textarea name="description" rows="3" class="form-control"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">تصویر</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer" style="padding: 15px 0 0 0; border-top: none;">
                                <button type="submit" class="btn-custom btn-success-custom">
                                    <i class="fas fa-plus"></i>
                                    افزودن
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

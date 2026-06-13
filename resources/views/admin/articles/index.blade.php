<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>مدیریت مقالات</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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

        html, body {
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

        .btn-info-custom {
            background: rgba(34, 211, 238, 0.15);
            color: var(--accent);
            border: 1px solid rgba(34, 211, 238, 0.3);
        }

        .btn-info-custom:hover {
            background: rgba(34, 211, 238, 0.25);
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
            min-width: 1000px;
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

        /* Article Image */
        .article-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid var(--border);
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

        .status-published {
            background: rgba(16, 185, 129, 0.12);
            color: #d1fae5;
            border: 1px solid rgba(16, 185, 129, 0.35);
        }

        .status-draft {
            background: rgba(148, 163, 184, 0.12);
            color: #cbd5e1;
            border: 1px solid rgba(148, 163, 184, 0.35);
        }

        /* Tags */
        .tag-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            background: rgba(34, 211, 238, 0.12);
            color: var(--accent);
            border: 1px solid rgba(34, 211, 238, 0.3);
            margin-left: 5px;
            margin-bottom: 5px;
        }

        /* Action Buttons in Table */
        .action-buttons {
            display: flex;
            gap: 5px;
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
            background: linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0.0));
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
            max-height: 65vh;
            overflow-y: auto;
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

        .form-control,
        .form-select {
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

        .form-control:focus,
        .form-select:focus {
            border-color: rgba(34, 211, 238, 0.6);
            box-shadow: 0 0 0 3px rgba(34, 211, 238, 0.15);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        /* Alert */
        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid;
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

        /* Attachment List */
        .attachment-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .attachment-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid var(--border);
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .attachment-preview img,
        .attachment-preview video {
            max-width: 80px;
            max-height: 80px;
            border-radius: 6px;
            border: 2px solid var(--border);
        }

        /* Select2 Customization */
        .select2-container--default .select2-selection--multiple {
            background: #0b1220 !important;
            border: 1px solid var(--border) !important;
            border-radius: 10px !important;
            min-height: 42px !important;
            padding: 5px !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background: rgba(34, 211, 238, 0.15) !important;
            border: 1px solid rgba(34, 211, 238, 0.3) !important;
            color: var(--accent) !important;
            border-radius: 6px !important;
            padding: 3px 8px !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: var(--accent) !important;
            margin-left: 5px !important;
        }

        .select2-dropdown {
            background: var(--card) !important;
            border: 1px solid var(--border) !important;
            border-radius: 10px !important;
        }

        .select2-results__option {
            color: var(--text) !important;
            padding: 8px 12px !important;
        }

        .select2-results__option--highlighted {
            background: rgba(167, 139, 250, 0.2) !important;
        }

        .select2-container--default .select2-search--inline .select2-search__field {
            color: var(--text) !important;
        }

        /* CKEditor Customization */
        .ck.ck-editor {
            border-radius: 10px !important;
            overflow: hidden;
        }

        .ck.ck-editor__main > .ck-editor__editable {
            background: #0b1220 !important;
            color: var(--text) !important;
            border: 1px solid var(--border) !important;
            min-height: 200px !important;
        }

        .ck.ck-editor__main > .ck-editor__editable.ck-focused {
            border-color: rgba(34, 211, 238, 0.6) !important;
            box-shadow: 0 0 0 3px rgba(34, 211, 238, 0.15) !important;
        }

        .ck.ck-toolbar {
            background: linear-gradient(180deg, #0e1626, #0d1524) !important;
            border: 1px solid var(--border) !important;
        }

        .ck.ck-button {
            color: var(--text) !important;
        }

        .ck.ck-button:hover {
            background: rgba(167, 139, 250, 0.1) !important;
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

            .modal-lg,
            .modal-dialog {
                max-width: 98vw !important;
                margin: 0 auto;
            }

            .modal-body {
                max-height: 55vh;
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
            <h1>مدیریت مقالات</h1>
            <button class="btn-custom btn-success-custom" data-bs-toggle="modal" data-bs-target="#addArticleModal">
                <i class="fas fa-plus"></i>
                افزودن مقاله جدید
            </button>
        </div>
        <div class="page-header">
            <h1>مدیریت محصولات</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn-custom btn-secondary-custom">
    <i class="fas fa-tachometer-alt"></i>
    بازگشت به داشبورد
</a>
        </div>

        <!-- فرم جستجو -->
        <form action="{{ route('admin.articles.index') }}" method="GET" class="search-form">
            <div class="search-input-group">
                <input type="text" name="search" class="search-input" placeholder="جستجوی مقاله..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn-custom btn-primary-custom">جستجو</button>
            </div>
        </form>

        <!-- جدول مقالات -->
        <div class="table-wrapper">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>شناسه</th>
                            <th>عنوان</th>
                            <th>تصویر</th>
                            <th>وضعیت</th>
                            <th>برچسب‌ها</th>
                            <th>ضمیمه‌ها</th>
                            <th>تاریخ ایجاد</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articles as $article)
                            <tr>
                                <td>{{ $article->id }}</td>
                                <td>{{ $article->title }}</td>
                                <td>
                                    @if ($article->image)
                                        <img src="{{ asset('storage/' . $article->image) }}" alt="عکس مقاله"
                                            class="article-image">
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <span class="status-badge status-{{ $article->status == 'published' ? 'published' : 'draft' }}">
                                        {{ $article->status == 'published' ? 'منتشر شده' : 'پیش‌نویس' }}
                                    </span>
                                </td>
                                <td>
                                    @foreach ($article->tags as $tag)
                                        <span class="tag-badge">{{ $tag->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @if ($article->attachments->count() > 0)
                                        <button class="btn-custom btn-info-custom btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#viewAttachmentsModal{{ $article->id }}">
                                            مشاهده ضمیمه‌ها
                                        </button>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $article->created_at->format('Y/m/d') }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-custom btn-warning-custom btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editArticleModal{{ $article->id }}">
                                            ویرایش
                                        </button>
                                        <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('آیا مطمئن هستید که می‌خواهید حذف کنید؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-custom btn-danger-custom btn-sm">
                                                حذف
                                            </button>
                                        </form>
                                        <button class="btn-custom btn-info-custom btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#viewContentModal{{ $article->id }}">
                                            مشاهده متن
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal ویرایش مقاله -->
                            <div class="modal fade" id="editArticleModal{{ $article->id }}" tabindex="-1"
                                aria-labelledby="editArticleModalLabel{{ $article->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.articles.update', $article->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            @if ($errors->any() && session('editing_article_id') == $article->id)
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editArticleModalLabel{{ $article->id }}">
                                                    ویرایش مقاله</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="بستن"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">عنوان مقاله</label>
                                                    <input type="text" name="title" class="form-control"
                                                        value="{{ old('title', $article->title) }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">متن مقاله</label>
                                                    <textarea name="content" id="editorEdit{{ $article->id }}" class="form-control" rows="6">{{ old('content', $article->content) }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">وضعیت</label>
                                                    <select name="status" class="form-select">
                                                        <option value="draft"
                                                            {{ $article->status == 'draft' ? 'selected' : '' }}>پیش‌نویس
                                                        </option>
                                                        <option value="published"
                                                            {{ $article->status == 'published' ? 'selected' : '' }}>منتشر
                                                            شده</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">برچسب‌ها</label>
                                                    <select name="tags[]" multiple class="form-select select2-tags"
                                                        id="tagsEdit{{ $article->id }}" style="width: 100%">
                                                        @foreach ($allTags as $tag)
                                                            <option value="{{ $tag->id }}"
                                                                {{ in_array($tag->id, old('tags', $article->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                                {{ $tag->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">تصویر مقاله</label>
                                                    <input type="file" name="image" class="form-control">
                                                    @if ($article->image)
                                                        <div class="mt-2">
                                                            <img src="{{ asset('storage/' . $article->image) }}"
                                                                alt="عکس مقاله" width="80" style="border-radius: 8px; border: 2px solid var(--border);">
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">ضمیمه‌ها</label>
                                                    @if ($article->attachments->count() > 0)
                                                        <ul class="attachment-list">
                                                            @foreach ($article->attachments as $attachment)
                                                                <li class="attachment-item">
                                                                    <div class="attachment-preview">
                                                                        @if (strpos($attachment->file_type, 'video/') === 0)
                                                                            <video controls>
                                                                                <source
                                                                                    src="{{ asset('storage/' . $attachment->file_path) }}"
                                                                                    type="{{ $attachment->file_type }}">
                                                                                مرورگر شما از پخش ویدیو پشتیبانی نمی‌کند.
                                                                            </video>
                                                                        @else
                                                                            <img src="{{ asset('storage/' . $attachment->file_path) }}"
                                                                                alt="{{ $attachment->file_name }}">
                                                                        @endif
                                                                    </div>
                                                                    <button type="button"
                                                                        class="btn-custom btn-danger-custom btn-sm"
                                                                        onclick="if(confirm('آیا مطمئن هستید که می‌خواهید این ضمیمه را حذف کنید؟')){ document.getElementById('delete-attachment-{{ $attachment->id }}').submit(); }">
                                                                        حذف
                                                                    </button>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <p style="color: var(--muted);">ضمیمه‌ای وجود ندارد</p>
                                                    @endif
                                                    <input type="file" name="attachments[]" class="form-control"
                                                        multiple style="margin-top: 10px;">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn-custom btn-primary-custom">ذخیره</button>
                                                <button type="button" class="btn-custom btn-secondary-custom"
                                                    data-bs-dismiss="modal">بستن</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal مشاهده متن مقاله -->
                            <div class="modal fade" id="viewContentModal{{ $article->id }}" tabindex="-1"
                                aria-labelledby="viewContentModalLabel{{ $article->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewContentModalLabel{{ $article->id }}">
                                                متن مقاله: {{ $article->title }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="بستن"></button>
                                        </div>
                                        <div class="modal-body">
                                            <textarea id="viewEditor{{ $article->id }}" class="d-none">{{ $article->content }}</textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn-custom btn-secondary-custom"
                                                data-bs-dismiss="modal">بستن</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal مشاهده ضمیمه‌ها -->
                            <div class="modal fade" id="viewAttachmentsModal{{ $article->id }}" tabindex="-1"
                                aria-labelledby="viewAttachmentsModalLabel{{ $article->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewAttachmentsModalLabel{{ $article->id }}">
                                                ضمیمه‌های مقاله: {{ $article->title }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="بستن"></button>
                                        </div>
                                        <div class="modal-body">
                                            <ul class="attachment-list">
                                                @foreach ($article->attachments as $attachment)
                                                    <li class="attachment-item">
                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#viewAttachmentDetailsModal{{ $attachment->id }}"
                                                            style="text-decoration: none;">
                                                            <div class="attachment-preview">
                                                                @if (strpos($attachment->file_type, 'image/') === 0)
                                                                    <img src="{{ asset('storage/' . $attachment->file_path) }}"
                                                                        alt="{{ $attachment->file_name }}">
                                                                @elseif (strpos($attachment->file_type, 'video/') === 0)
                                                                    <video controls>
                                                                        <source
                                                                            src="{{ asset('storage/' . $attachment->file_path) }}"
                                                                            type="{{ $attachment->file_type }}">
                                                                        مرورگر شما از پخش ویدیو پشتیبانی نمی‌کند.
                                                                    </video>
                                                                @else
                                                                    <span class="tag-badge">{{ $attachment->file_name }}</span>
                                                                @endif
                                                            </div>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn-custom btn-secondary-custom"
                                                data-bs-dismiss="modal">بستن</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal جزئیات ضمیمه -->
                            @foreach ($article->attachments as $attachment)
                                <div class="modal fade" id="viewAttachmentDetailsModal{{ $attachment->id }}"
                                    tabindex="-1" aria-labelledby="viewAttachmentDetailsModalLabel{{ $attachment->id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="viewAttachmentDetailsModalLabel{{ $attachment->id }}">
                                                    جزئیات ضمیمه: {{ $attachment->file_name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="بستن"></button>
                                            </div>
                                            <div class="modal-body" style="text-align: center;">
                                                @if (strpos($attachment->file_type, 'image/') === 0)
                                                    <img src="{{ asset('storage/' . $attachment->file_path) }}"
                                                        alt="{{ $attachment->file_name }}" style="width: 100%; height: auto; border-radius: 10px;">
                                                @elseif (strpos($attachment->file_type, 'video/') === 0)
                                                    <video controls style="width: 100%; border-radius: 10px;">
                                                        <source src="{{ asset('storage/' . $attachment->file_path) }}"
                                                            type="{{ $attachment->file_type }}">
                                                        مرورگر شما از پخش ویدیو پشتیبانی نمی‌کند.
                                                    </video>
                                                @else
                                                    <a href="{{ asset('storage/' . $attachment->file_path) }}"
                                                        target="_blank" class="btn-custom btn-primary-custom">
                                                        دانلود فایل: {{ $attachment->file_name }}
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn-custom btn-secondary-custom"
                                                    data-bs-dismiss="modal">بستن</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- صفحه‌بندی -->
        <div class="pagination-wrapper">
            {{ $articles->links() }}
        </div>
    </div>

    <!-- Modal افزودن مقاله -->
    <div class="modal fade" id="addArticleModal" tabindex="-1" aria-labelledby="addArticleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addArticleModalLabel">افزودن مقاله جدید</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">عنوان مقاله</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">متن مقاله</label>
                            <textarea name="content" id="editorAdd" class="form-control" rows="6">{{ old('content', '') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">وضعیت</label>
                            <select name="status" class="form-select">
                                <option value="draft">پیش‌نویس</option>
                                <option value="published">منتشر شده</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">برچسب‌ها</label>
                            <select name="tags[]" multiple class="form-select select2-tags" id="tagsAdd"
                                style="width: 100%">
                                @foreach ($allTags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">تصویر مقاله</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ضمیمه‌ها</label>
                            <input type="file" name="attachments[]" class="form-control" multiple>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn-custom btn-success-custom">ثبت مقاله</button>
                        <button type="button" class="btn-custom btn-secondary-custom" data-bs-dismiss="modal">بستن</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if ($errors->any() && session('editing_article_id'))
        <script>
            $(document).ready(function() {
                $('#editArticleModal{{ session('editing_article_id') }}').modal('show');
            });
        </script>
    @endif

    {{-- فرم‌های حذف ضمیمه در انتهای صفحه --}}
    @foreach ($articles as $article)
        @foreach ($article->attachments as $attachment)
            <form id="delete-attachment-{{ $attachment->id }}" method="POST"
                action="{{ route('admin.attachments.destroy', $attachment->id) }}" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        @endforeach
    @endforeach

    <!-- Bootstrap, jQuery, Select2, CKEditor 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        // ذخیره instanceهای CKEditor
        window.editors = {};

        $(document).ready(function() {
            // CKEditor برای فرم افزودن
            if (document.getElementById('editorAdd')) {
                ClassicEditor.create(document.getElementById('editorAdd'), {
                    language: {
                        ui: 'fa',
                        content: 'fa'
                    },
                }).catch(error => console.error(error));
            }

            // Select2 برای فرم افزودن
            if (document.getElementById('tagsAdd')) {
                $('#tagsAdd').select2({
                    placeholder: "برچسب‌ها را انتخاب کنید",
                    allowClear: true,
                    width: '100%',
                    dir: 'rtl',
                    dropdownParent: $('#addArticleModal'),
                });
            }

            // ویرایش مقاله برای هر modal
            @foreach ($articles as $article)
                $('#editArticleModal{{ $article->id }}').on('shown.bs.modal', function() {
                    // Select2 فقط اگر قبلاً فعال نشده
                    if (!$('#tagsEdit{{ $article->id }}').hasClass("select2-hidden-accessible")) {
                        $('#tagsEdit{{ $article->id }}').select2({
                            placeholder: "برچسب‌ها را انتخاب کنید",
                            allowClear: true,
                            width: '100%',
                            dir: 'rtl',
                            dropdownParent: $('#editArticleModal{{ $article->id }}'),
                        });
                    }

                    // CKEditor فقط اگر قبلاً فعال نشده
                    if (!$('#editorEdit{{ $article->id }}').next('.ck-editor').length) {
                        ClassicEditor.create(document.getElementById('editorEdit{{ $article->id }}'), {
                            language: {
                                ui: 'fa',
                                content: 'fa'
                            },
                        }).then(editor => {
                            window.editors['editorEdit{{ $article->id }}'] = editor;
                        }).catch(error => console.error(error));
                    }
                });
            @endforeach

            // نمایش متن مقاله با CKEditor فقط خواندنی
            @foreach ($articles as $article)
                $('#viewContentModal{{ $article->id }}').on('shown.bs.modal', function() {
                    if (!$('#viewEditor{{ $article->id }}').next('.ck-editor').length) {
                        ClassicEditor.create(document.getElementById('viewEditor{{ $article->id }}'), {
                            language: {
                                ui: 'fa',
                                content: 'fa'
                            },
                            readOnly: true,
                        }).catch(error => console.error(error));
                    }
                });
            @endforeach
        });

        // قبل از ارسال هر فرم، مقدار CKEditor را sync کن
        $('form').on('submit', function() {
            for (const key in window.editors) {
                if (window.editors.hasOwnProperty(key)) {
                    const editor = window.editors[key];
                    const textarea = document.getElementById(key);
                    if (textarea) {
                        textarea.value = editor.getData();
                    }
                }
            }
        });
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت دسته‌ها</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
            max-width: 1200px;
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

        /* Action Buttons */
        .action-buttons-group {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

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

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--accent-2), #8b5cf6);
            color: white;
            box-shadow: 0 4px 15px -3px rgba(167, 139, 250, 0.4);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px -3px rgba(167, 139, 250, 0.6);
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }

        /* Accordion */
        .accordion {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .accordion-item {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
            transition: border-color 0.2s ease;
        }

        .accordion-item:hover {
            border-color: rgba(167, 139, 250, 0.3);
        }

        .accordion-button {
            background: linear-gradient(180deg, rgba(255,255,255,0.03), rgba(255,255,255,0.0));
            color: var(--text);
            border: none;
            padding: 15px 20px;
            font-size: 16px;
            font-weight: 600;
            box-shadow: none;
        }

        .accordion-button:not(.collapsed) {
            background: linear-gradient(180deg, rgba(34, 211, 238, 0.05), rgba(167, 139, 250, 0.05));
            color: var(--accent);
        }

        .accordion-button:focus {
            box-shadow: none;
            border: none;
        }

        .accordion-button::after {
            filter: invert(1) brightness(2);
        }

        .accordion-body {
            padding: 20px;
            background: rgba(0, 0, 0, 0.2);
        }

        /* Category Hierarchy */
        .category-actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            margin-bottom: 20px;
        }

        .subcategory-box {
            background: rgba(167, 139, 250, 0.05);
            border: 1px solid rgba(167, 139, 250, 0.2);
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            margin-right: 20px;
            transition: all 0.2s ease;
        }

        .subcategory-box:hover {
            border-color: rgba(167, 139, 250, 0.4);
            background: rgba(167, 139, 250, 0.08);
        }

        .subcategory-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .subcategory-header h5 {
            margin: 0;
            font-size: 15px;
            font-weight: 600;
            color: var(--accent-2);
        }

        .sub-subcategory-box {
            background: rgba(34, 211, 238, 0.05);
            border: 1px solid rgba(34, 211, 238, 0.2);
            border-radius: 8px;
            padding: 12px;
            margin-top: 10px;
            margin-right: 20px;
            transition: all 0.2s ease;
        }

        .sub-subcategory-box:hover {
            border-color: rgba(34, 211, 238, 0.4);
            background: rgba(34, 211, 238, 0.08);
        }

        .sub-subcategory-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .sub-subcategory-header h6 {
            margin: 0;
            font-size: 14px;
            font-weight: 600;
            color: var(--accent);
        }

        .actions {
            display: flex;
            gap: 8px;
            margin-top: 10px;
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 10px;
            border-radius: 999px;
            font-size: 11px;
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

        select option {
            background: var(--card);
            color: var(--text);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .action-buttons-group {
                flex-direction: column;
            }

            .action-buttons-group .btn-custom {
                width: 100%;
                justify-content: center;
            }

            .subcategory-box,
            .sub-subcategory-box {
                margin-right: 0;
            }

            .category-actions {
                flex-direction: column;
            }

            .category-actions .btn-custom {
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
            <h2>مدیریت دسته‌ها، زیردسته‌ها و زیردسته دوم‌ها</h2>
        </div>

        <a href="{{ route('admin.dashboard') }}" class="btn-custom btn-secondary-custom">
    <i class="fas fa-tachometer-alt"></i>
    بازگشت به داشبورد
</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- دکمه‌های مدیریت -->
        <div class="action-buttons-group">
            <button class="btn-custom btn-success-custom" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                <i class="fas fa-plus"></i>
                افزودن دسته
            </button>
            <button class="btn-custom btn-success-custom" data-bs-toggle="modal" data-bs-target="#addSubcategoryModal">
                <i class="fas fa-plus"></i>
                افزودن زیردسته اول
            </button>
            <button class="btn-custom btn-success-custom" data-bs-toggle="modal" data-bs-target="#addSubSubcategoryModal">
                <i class="fas fa-plus"></i>
                افزودن زیردسته دوم
            </button>
        </div>

        <!-- لیست دسته‌ها -->
        <div class="accordion" id="categoryAccordion">
            @foreach ($categories as $cat)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $cat->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $cat->id }}" aria-expanded="false"
                            aria-controls="collapse{{ $cat->id }}">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <span>{{ $cat->name }}</span>
                                <span class="status-badge status-active">فعال</span>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse{{ $cat->id }}" class="accordion-collapse collapse"
                        aria-labelledby="heading{{ $cat->id }}" data-bs-parent="#categoryAccordion">
                        <div class="accordion-body">
                            <div class="category-actions">
                                <button class="btn-custom btn-warning-custom btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editCategoryModal{{ $cat->id }}">
                                    <i class="fas fa-edit"></i>
                                    ویرایش
                                </button>
                                <form
                                    action="{{ route('admin.categories.destroy', ['type' => 'category', 'id' => $cat->id]) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-custom btn-danger-custom btn-sm"
                                        onclick="return confirm('آیا از حذف این دسته اطمینان دارید؟')">
                                        <i class="fas fa-trash"></i>
                                        حذف
                                    </button>
                                </form>
                            </div>

                            @foreach ($cat->subcategories as $sub)
                                <div class="subcategory-box">
                                    <div class="subcategory-header">
                                        <h5>{{ $sub->name }}</h5>
                                        <span class="status-badge status-active">فعال</span>
                                    </div>
                                    <div class="actions">
                                        <button class="btn-custom btn-warning-custom btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editSubcategoryModal{{ $sub->id }}">
                                            <i class="fas fa-edit"></i>
                                            ویرایش
                                        </button>
                                        <form
                                            action="{{ route('admin.categories.destroy', ['type' => 'subcategory', 'id' => $sub->id]) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-custom btn-danger-custom btn-sm"
                                                onclick="return confirm('آیا از حذف این زیردسته اول اطمینان دارید؟')">
                                                <i class="fas fa-trash"></i>
                                                حذف
                                            </button>
                                        </form>
                                    </div>

                                    @foreach ($sub->subSubcategories as $subSub)
                                        <div class="sub-subcategory-box">
                                            <div class="sub-subcategory-header">
                                                <h6>{{ $subSub->name }}</h6>
                                                <span class="status-badge status-active">فعال</span>
                                            </div>
                                            <div class="actions">
                                                <button class="btn-custom btn-warning-custom btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#editSubSubcategoryModal{{ $subSub->id }}">
                                                    <i class="fas fa-edit"></i>
                                                    ویرایش
                                                </button>
                                                <form
                                                    action="{{ route('admin.categories.destroy', ['type' => 'sub_subcategory', 'id' => $subSub->id]) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-custom btn-danger-custom btn-sm"
                                                        onclick="return confirm('آیا از حذف این زیردسته دوم اطمینان دارید؟')">
                                                        <i class="fas fa-trash"></i>
                                                        حذف
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Modal ویرایش زیردسته دوم -->
        @foreach ($categories as $cat)
            @foreach ($cat->subcategories as $sub)
                @foreach ($sub->subSubcategories as $subSub)
                    <div class="modal fade" id="editSubSubcategoryModal{{ $subSub->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <form method="POST"
                                action="{{ route('admin.categories.update', ['type' => 'sub_subcategory', 'id' => $subSub->id]) }}">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">ویرایش زیردسته دوم</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">نام زیردسته دوم</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $subSub->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">زیردسته اول والد</label>
                                            <select name="subcategory_id" class="form-select" required>
                                                @foreach ($categories as $category)
                                                    @foreach ($category->subcategories as $s)
                                                        <option value="{{ $s->id }}"
                                                            {{ $s->id == $subSub->subcategory_id ? 'selected' : '' }}>
                                                            {{ $category->name }} → {{ $s->name }}
                                                        </option>
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn-custom btn-primary-custom">ذخیره</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endforeach
        @endforeach

        <!-- Modal ویرایش زیردسته اول -->
        @foreach ($categories as $cat)
            @foreach ($cat->subcategories as $sub)
                <div class="modal fade" id="editSubcategoryModal{{ $sub->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form method="POST"
                            action="{{ route('admin.categories.update', ['type' => 'subcategory', 'id' => $sub->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">ویرایش زیردسته اول</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">نام زیردسته اول</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $sub->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">دسته والد</label>
                                        <select name="category_id" class="form-select" required>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $category->id == $sub->category_id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn-custom btn-primary-custom">ذخیره</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        @endforeach

        <!-- Modal ویرایش دسته -->
        @foreach ($categories as $cat)
            <div class="modal fade" id="editCategoryModal{{ $cat->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form method="POST"
                        action="{{ route('admin.categories.update', ['type' => 'category', 'id' => $cat->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">ویرایش دسته</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">نام دسته</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ $cat->name }}" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn-custom btn-primary-custom">ذخیره</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach

        <!-- Modal افزودن دسته -->
        <div class="modal fade" id="addCategoryModal" tabindex="-1">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('admin.categories.store') }}">
                    @csrf
                    <input type="hidden" name="type" value="category">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">افزودن دسته</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">نام دسته</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn-custom btn-success-custom">ثبت</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal افزودن زیردسته اول -->
        <div class="modal fade" id="addSubcategoryModal" tabindex="-1">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('admin.categories.store') }}">
                    @csrf
                    <input type="hidden" name="type" value="subcategory">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">افزودن زیردسته اول</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">نام زیردسته اول</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">دسته والد</label>
                                <select name="category_id" class="form-select" required>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn-custom btn-success-custom">ثبت زیردسته اول</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal افزودن زیردسته دوم -->
        <div class="modal fade" id="addSubSubcategoryModal" tabindex="-1">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('admin.categories.store') }}">
                    @csrf
                    <input type="hidden" name="type" value="sub_subcategory">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">افزودن زیردسته دوم</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">نام زیردسته دوم</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">زیردسته اول والد</label>
                                <select name="subcategory_id" class="form-select" required>
                                    @foreach ($categories as $cat)
                                        @foreach ($cat->subcategories as $sub)
                                            <option value="{{ $sub->id }}">{{ $cat->name }} →
                                                {{ $sub->name }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn-custom btn-success-custom">ثبت زیردسته دوم</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

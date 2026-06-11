<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت فیلد‌های اختصاصی</title>
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

        /* Table */
        .table-wrapper {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
            margin-bottom: 30px;
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
        }

        /* Action Buttons in Table */
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
            <h2>مدیریت فیلد‌های اختصاصی</h2>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- دکمه افزودن -->
        <div style="margin-bottom: 30px;">
            <a href="#addFieldModal" data-bs-toggle="modal" class="btn-custom btn-success-custom">
                <i class="fas fa-plus"></i>
                افزودن فیلد
            </a>
        </div>

        <!-- جدول لیست فیلد‌ها -->
        <div class="table-wrapper">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>زیردسته اول</th>
                            <th>زیردسته دوم</th>
                            <th>نام فیلد (key)</th>
                            <th>برچسب (label)</th>
                            <th>نوع فیلد</th>
                            <th>گزینه‌ها</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customFields as $field)
                            <tr>
                                <td>{{ $field->subcategory->name ?? '-' }}</td>
                                <td>{{ $field->subSubcategory->name ?? '-' }}</td>
                                <td style="color: var(--accent); font-weight: 500;">{{ $field->key }}</td>
                                <td>{{ $field->label }}</td>
                                <td>
                                    <span style="background: rgba(167, 139, 250, 0.1); padding: 4px 10px; border-radius: 6px; font-size: 12px;">
                                        {{ $field->type }}
                                    </span>
                                </td>
                                <td>
                                    @if ($field->options)
                                        <span style="color: var(--muted); font-size: 12px;">
                                            {{ implode(', ', json_decode($field->options, true)) }}
                                        </span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <span class="status-badge status-active">فعال</span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-custom btn-warning-custom btn-sm"
                                            onclick="openEditModal({{ $field->id }})">
                                            <i class="fas fa-edit"></i>
                                            ویرایش
                                        </button>
                                        <form action="{{ route('admin.custom-fields.destroy', $field->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-custom btn-danger-custom btn-sm"
                                                onclick="return confirm('آیا از حذف این فیلد اطمینان دارید؟')">
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

        <!-- صفحه‌بندی -->
        <div class="pagination-wrapper">
            {{ $customFields->links() }}
        </div>

        <!-- Modal افزودن فیلد -->
        <div class="modal fade" id="addFieldModal" tabindex="-1">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('admin.custom-fields.store') }}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">افزودن فیلد</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">زیردسته اول</label>
                                <select name="subcategory_id" id="addSubcategorySelect" class="form-select" required
                                    onchange="toggleSubSubcategory(this)">
                                    @foreach ($subcategories as $sub)
                                        <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">زیردسته دوم</label>
                                <select name="sub_subcategory_id" id="addSubSubcategorySelect" class="form-select">
                                    <option value="">بدون زیردسته دوم</option>
                                    @foreach ($subSubcategories as $subSub)
                                        <option value="{{ $subSub->id }}"
                                            data-subcategory="{{ $subSub->subcategory_id }}">
                                            {{ $subSub->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">نام فیلد (key)</label>
                                <input type="text" name="key" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">برچسب (label)</label>
                                <input type="text" name="label" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">نوع فیلد</label>
                                <select name="type" class="form-select" onchange="toggleOptions(this)" required>
                                    <option value="text">متن</option>
                                    <option value="number">عدد</option>
                                    <option value="date">تاریخ</option>
                                    <option value="select">انتخابی</option>
                                </select>
                            </div>
                            <div class="mb-3 d-none" id="optionsField">
                                <label class="form-label">گزینه‌ها (با کاما جدا کنید)</label>
                                <input type="text" name="options" class="form-control"
                                    placeholder="Gold V, Platinum III, Legend">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn-custom btn-success-custom">ثبت فیلد</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal ویرایش فیلد -->
        <div class="modal fade" id="editFieldModal" tabindex="-1">
            <div class="modal-dialog">
                <form id="editFieldForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">ویرایش فیلد</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" id="editFieldBody">
                            <!-- فیلد‌ها با Ajax پر میشن -->
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn-custom btn-primary-custom">ذخیره</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // 🔧 تابع loadDynamicFields برای فرم افزودن
        function loadDynamicFields() {
            const subcategoryId = document.getElementById('addSubcategorySelect').value;
            const subSubcategoryId = document.getElementById('addSubSubcategorySelect')?.value;
            const container = document.getElementById('custom-fields');
            if (!container) return;

            fetch(`/admin/product-fields?subcategory_id=${subcategoryId}&sub_subcategory_id=${subSubcategoryId}`)
                .then(res => res.json())
                .then(fields => {
                    container.innerHTML = '';
                    for (let key in fields) {
                        let field = fields[key];
                        container.innerHTML += `
                        <div class="mb-3">
                            <label class="form-label">${field.label}</label>
                            ${field.type === 'select' ? `
                                        <select name="attributes[${key}]" class="form-control">
                                            ${field.options.map(opt => `<option>${opt}</option>`).join('')}
                                        </select>
                                    ` : `
                                        <input type="${field.type}" name="attributes[${key}]" class="form-control" value="">
                                    `}
                        </div>`;
                    }
                })
                .catch(() => {
                    container.innerHTML = '<div class="text-muted">فیلدی یافت نشد.</div>';
                });
        }

        // ✅ مهم: اطمینان از فراخوانی صحیح
        document.getElementById('addSubcategorySelect')?.addEventListener('change', function() {
            toggleSubSubcategory(this);
            loadDynamicFields();
        });

        document.getElementById('addSubSubcategorySelect')?.addEventListener('change', function() {
            loadDynamicFields();
        });

        // 🔧 باز کردن Modal ویرایش با Ajax
        function openEditModal(fieldId) {
            fetch(`/admin/custom-fields/${fieldId}/edit`)
                .then(res => res.json())
                .then(data => {
                    const field = data.field;
                    const form = document.getElementById('editFieldForm');
                    form.setAttribute('action', `/admin/custom-fields/${field.id}`);
                    const body = document.getElementById('editFieldBody');
                    body.innerHTML = `
                    <input type="hidden" name="id" value="${field.id}">
                    <div class="mb-3">
                        <label class="form-label">زیردسته اول</label>
                        <select name="subcategory_id" id="editSubcategorySelect" class="form-select"
                                onchange="loadSubSubcategoryInEdit(this)">
                            @foreach ($subcategories as $sub)
                                <option value="{{ $sub->id }}" data-category="{{ $sub->category_id }}">
                                    {{ $sub->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">زیردسته دوم</label>
                        <select name="sub_subcategory_id" id="editSubSubcategorySelect" class="form-select">
                            <option value="">بدون زیردسته دوم</option>
                            @foreach ($subSubcategories as $subSub)
                                <option value="{{ $subSub->id }}" data-subcategory="{{ $subSub->subcategory_id }}">
                                    {{ $subSub->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">نام فیلد (key)</label>
                        <input type="text" name="key" class="form-control" value="${field.key}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">برچسب (label)</label>
                        <input type="text" name="label" class="form-control" value="${field.label}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">نوع فیلد</label>
                        <select name="type" class="form-select" onchange="toggleEditTypeOptions(this)">
                            <option value="text" ${field.type === 'text' ? 'selected' : ''}>متن</option>
                            <option value="number" ${field.type === 'number' ? 'selected' : ''}>عدد</option>
                            <option value="date" ${field.type === 'date' ? 'selected' : ''}>تاریخ</option>
                            <option value="select" ${field.type === 'select' ? 'selected' : ''}>انتخابی</option>
                        </select>
                    </div>
                    <div class="mb-3" id="editOptionsField"
                         style="display: ${field.type === 'select' ? 'block' : 'none'};">
                        <label class="form-label">گزینه‌ها (با کاما جدا کنید)</label>
                        <input type="text" name="options" class="form-control"
                               value="${field.options ? Object.values(JSON.parse(field.options)).join(',') : ''}">
                    </div>
                `;

                    // ست کردن زیردسته اول
                    const editSubcategorySelect = document.getElementById('editSubcategorySelect');
                    if (editSubcategorySelect && field.subcategory_id) {
                        editSubcategorySelect.value = field.subcategory_id;
                        loadSubSubcategoryInEdit(editSubcategorySelect);
                    }

                    // ست کردن زیردسته دوم
                    const editSubSubcategorySelect = document.getElementById('editSubSubcategorySelect');
                    if (editSubSubcategorySelect && field.sub_subcategory_id) {
                        editSubSubcategorySelect.value = field.sub_subcategory_id;
                    }

                    // نمایش/پنهان کردن گزینه‌ها
                    toggleEditTypeOptions(document.querySelector('#editFieldBody select[name="type"]'));

                    new bootstrap.Modal(document.getElementById('editFieldModal')).show();
                })
                .catch(err => {
                    console.error("خطا در بارگذاری فیلد:", err);
                });
        }

        // ✨ فیلتر زیردسته دوم وقتی زیردسته اول عوض شد
        function loadSubSubcategoryInEdit(subcategorySelect) {
            const subSubcategorySelect = document.getElementById('editSubSubcategorySelect');
            if (!subSubcategorySelect) return;

            const selectedSubcategoryId = subcategorySelect.value;
            const allOptions = subSubcategorySelect.querySelectorAll('option');
            allOptions.forEach(option => {
                const relatedSubcategory = option.dataset.subcategory;
                option.style.display = (!relatedSubcategory || relatedSubcategory == selectedSubcategoryId) ?
                    'block' : 'none';
            });

            // حفظ مقدار قبلی زیردسته دوم
            const currentSubSubcategory = subSubcategorySelect.getAttribute('data-current');
            if (currentSubSubcategory) {
                subSubcategorySelect.value = currentSubSubcategory;
            } else {
                subSubcategorySelect.value = '';
            }
        }

        // ✨ نمایش/پنهان کردن فیلد گزینه‌ای در Modal ویرایش
        function toggleEditTypeOptions(select) {
            const optionsField = document.getElementById('editOptionsField');
            if (!optionsField) return;

            if (select && select.value === 'select') {
                optionsField.style.display = 'block';
            } else {
                optionsField.style.display = 'none';
            }
        }

        // ✨ نمایش/پنهان کردن فیلد گزینه‌ای در Modal افزودن
        function toggleOptions(select) {
            const optionsField = document.getElementById('optionsField');
            if (!optionsField) return;

            if (select.value === 'select') {
                optionsField.classList.remove('d-none');
            } else {
                optionsField.classList.add('d-none');
            }
        }

        // ✨ فیلتر زیردسته دوم در فرم افزودن
        function toggleSubSubcategory(subcategorySelect) {
            const subSubcategorySelect = document.getElementById('addSubSubcategorySelect');
            const allOptions = subSubcategorySelect.querySelectorAll('option');
            const selectedSubcategoryId = subcategorySelect.value;

            allOptions.forEach(option => {
                const relatedSubcategory = option.dataset.subcategory;
                option.style.display = (!relatedSubcategory || relatedSubcategory == selectedSubcategoryId) ?
                    'block' :
                    'none';
            });

            subSubcategorySelect.value = '';
        }
    </script>
</body>

</html>
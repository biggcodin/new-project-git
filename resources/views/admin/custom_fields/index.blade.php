<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>مدیریت فیلد‌های اختصاصی</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1e1433;
            color: white;
        }

        .modal-content {
            background-color: #2b1d4f;
        }

        select option,
        input[type="text"],
        input[type="number"] {
            color: black;
        }

        .table {
            font-size: 0.9rem;
        }

        .status-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
        }

        .status-active {
            background-color: rgba(25, 135, 84, 0.2);
            color: #198754;
        }

        .status-inactive {
            background-color: rgba(220, 53, 69, 0.2);
            color: #dc3545;
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <h2 class="mb-4">مدیریت فیلد‌های اختصاصی</h2>
        @if (session('success'))
            <div class="alert alert-success mb-3">{{ session('success') }}</div>
        @endif

        <!-- دکمه افزودن -->
        <a href="#addFieldModal" data-bs-toggle="modal" class="btn btn-success mb-3">افزودن فیلد</a>

        <!-- جدول لیست فیلد‌ها -->
        <table class="table table-bordered table-hover" style="background-color: #2b1d4f; color: white;">
            <thead style="background-color: #3a2670;">
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
                        <td>{{ $field->key }}</td>
                        <td>{{ $field->label }}</td>
                        <td>{{ $field->type }}</td>
                        <td>
                            @if ($field->options)
                                {{ implode(', ', json_decode($field->options, true)) }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <span class="status-badge status-active">فعال</span>
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm me-2"
                                onclick="openEditModal({{ $field->id }})">ویرایش</button>
                            <form action="{{ route('custom-fields.destroy', $field->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('آیا از حذف این فیلد اطمینان دارید؟')">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $customFields->links() }}

        <!-- Modal افزودن فیلد -->
        <div class="modal fade" id="addFieldModal" tabindex="-1">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('custom-fields.store') }}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">افزودن فیلد</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>زیردسته اول</label>
                                <select name="subcategory_id" id="addSubcategorySelect" class="form-control" required
                                    onchange="toggleSubSubcategory(this)">
                                    @foreach ($subcategories as $sub)
                                        <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>زیردسته دوم</label>
                                <select name="sub_subcategory_id" id="addSubSubcategorySelect" class="form-control">
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
                                <label>نام فیلد (key)</label>
                                <input type="text" name="key" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>برچسب (label)</label>
                                <input type="text" name="label" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>نوع فیلد</label>
                                <select name="type" class="form-control" onchange="toggleOptions(this)" required>
                                    <option value="text">متن</option>
                                    <option value="number">عدد</option>
                                    <option value="date">تاریخ</option>
                                    <option value="select">انتخابی</option>
                                </select>
                            </div>
                            <div class="mb-3 d-none" id="optionsField">
                                <label>گزینه‌ها (با کاما جدا کنید)</label>
                                <input type="text" name="options" class="form-control"
                                    placeholder="Gold V, Platinum III, Legend">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success">ثبت فیلد</button>
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
                            <button class="btn btn-primary">ذخیره</button>
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
                        <label>زیردسته اول</label>
                        <select name="subcategory_id" id="editSubcategorySelect" class="form-control"
                                onchange="loadSubSubcategoryInEdit(this)">
                            @foreach ($subcategories as $sub)
                                <option value="{{ $sub->id }}" data-category="{{ $sub->category_id }}">
                                    {{ $sub->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>زیردسته دوم</label>
                        <select name="sub_subcategory_id" id="editSubSubcategorySelect" class="form-control">
                            <option value="">بدون زیردسته دوم</option>
                            @foreach ($subSubcategories as $subSub)
                                <option value="{{ $subSub->id }}" data-subcategory="{{ $subSub->subcategory_id }}">
                                    {{ $subSub->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>نام فیلد (key)</label>
                        <input type="text" name="key" class="form-control" value="${field.key}" required>
                    </div>
                    <div class="mb-3">
                        <label>برچسب (label)</label>
                        <input type="text" name="label" class="form-control" value="${field.label}" required>
                    </div>
                    <div class="mb-3">
                        <label>نوع فیلد</label>
                        <select name="type" class="form-control" onchange="toggleEditTypeOptions(this)">
                            <option value="text" ${field.type === 'text' ? 'selected' : ''}>متن</option>
                            <option value="number" ${field.type === 'number' ? 'selected' : ''}>عدد</option>
                            <option value="date" ${field.type === 'date' ? 'selected' : ''}>تاریخ</option>
                            <option value="select" ${field.type === 'select' ? 'selected' : ''}>انتخابی</option>
                        </select>
                    </div>
                    <div class="mb-3" id="editOptionsField"
                         style="display: ${field.type === 'select' ? 'block' : 'none'};">
                        <label>گزینه‌ها (با کاما جدا کنید)</label>
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

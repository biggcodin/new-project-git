<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>افزودن محصول جدید</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* ==== استایل‌های شما، بدون هیچ تغییری ==== */
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
            background: linear-gradient(135deg, #0b1220 0%, #0f172a 100%);
            color: var(--text);
            font-family: 'Vazirmatn', sans-serif;
            font-size: 14px;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 20px;
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
            color: var(--text);
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
        }

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

        .form-layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .main-column {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .sidebar-column {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
        }

        .card-header {
            padding: 15px 20px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.03), rgba(255, 255, 255, 0.0));
            border-bottom: 1px solid var(--border);
        }

        .card-header h5 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-header h5::before {
            content: '';
            width: 4px;
            height: 18px;
            background: linear-gradient(180deg, var(--accent), var(--accent-2));
            border-radius: 2px;
        }

        .card-body {
            padding: 20px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .form-grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        label {
            color: var(--muted);
            font-size: 13px;
            font-weight: 500;
        }

        label .required {
            color: var(--danger);
            margin-right: 2px;
        }

        input,
        select,
        textarea {
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

        input:focus,
        select:focus,
        textarea:focus {
            border-color: rgba(34, 211, 238, 0.6);
            box-shadow: 0 0 0 3px rgba(34, 211, 238, 0.15);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        select[multiple] {
            min-height: 150px;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 0;
        }

        input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--accent-2);
        }

        .checkbox-label {
            color: var(--text);
            cursor: pointer;
            font-size: 14px;
        }

        .helper-text {
            color: var(--muted);
            font-size: 12px;
            margin-top: 5px;
        }

        input[type="file"] {
            padding: 8px;
            cursor: pointer;
        }

        input[type="file"]::file-selector-button {
            background: linear-gradient(180deg, #101827, #0b1220);
            color: var(--text);
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 6px 12px;
            margin-left: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        input[type="file"]::file-selector-button:hover {
            border-color: var(--accent-2);
            transform: translateY(-1px);
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            padding: 20px 0;
        }

        .btn {
            padding: 12px 24px;
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

        .btn-cancel {
            background: linear-gradient(180deg, #101827, #0b1220);
            color: var(--text);
            border: 1px solid var(--border);
        }

        .btn-cancel:hover {
            transform: translateY(-2px);
            border-color: var(--muted);
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--accent-2), #8b5cf6);
            color: white;
            box-shadow: 0 4px 15px -3px rgba(167, 139, 250, 0.4);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px -3px rgba(167, 139, 250, 0.6);
        }

        @media (max-width:1024px) {
            .form-layout {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width:768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .form-grid,
            .form-grid-3 {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h2>افزودن محصول جدید</h2>
            <a href="{{ route('admin.products.index') }}" class="btn-back"><span>بازگشت به لیست</span></a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" id="mainForm">
            @csrf
            <div class="form-layout">
                <div class="main-column">
                    <!-- اطلاعات اصلی -->
                    <div class="card">
                        <div class="card-header">
                            <h5>اطلاعات اصلی محصول</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="name">نام محصول <span class="required">*</span></label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="sku">کد محصول (SKU)</label>
                                    <input type="text" name="sku" id="sku" value="{{ old('sku') }}">
                                </div>
                                <div class="form-group">
                                    <label for="price">قیمت (تومان) <span class="required">*</span></label>
                                    <input type="number" name="price" id="price" value="{{ old('price') }}"
                                        min="0" step="1000" required>
                                </div>
                                <div class="form-group">
                                    <label for="discount_price">قیمت با تخفیف (تومان)</label>
                                    <input type="number" name="discount_price" id="discount_price"
                                        value="{{ old('discount_price') }}" min="0" step="1000">
                                </div>
                                <div class="form-group">
                                    <label for="quantity">موجودی</label>
                                    <input type="number" name="quantity" id="quantity"
                                        value="{{ old('quantity', 0) }}" min="0">
                                </div>
                                <div class="form-group">
                                    <label for="order">ترتیب نمایش</label>
                                    <input type="number" name="order" id="order" value="{{ old('order', 0) }}"
                                        min="0">
                                </div>
                                <div class="form-group full-width">
                                    <label for="description">توضیحات محصول</label>
                                    <textarea name="description" id="description" rows="4">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- دسته‌بندی -->
                    <div class="card">
                        <div class="card-header">
                            <h5>دسته‌بندی</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-grid-3">
                                <div class="form-group">
                                    <label for="category_id">دسته اصلی <span class="required">*</span></label>
                                    <select name="category_id" id="category_id" required>
                                        <option value="">انتخاب کنید</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="subcategory_id">زیردسته اول <span class="required">*</span></label>
                                    <select name="subcategory_id" id="subcategory_id" required disabled>
                                        <option value="">ابتدا دسته اصلی را انتخاب کنید</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="sub_subcategory_id">زیردسته دوم</label>
                                    <select name="sub_subcategory_id" id="sub_subcategory_id" disabled>
                                        <option value="">ابتدا زیردسته اول را انتخاب کنید</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ویژگی‌های اختصاصی -->
                    <div class="card">
                        <div class="card-header">
                            <h5>ویژگی‌های اختصاصی محصول</h5>
                        </div>
                        <div class="card-body" id="custom-fields-container">
                            <!-- فیلدها به صورت داینامیک بارگذاری می‌شوند -->
                        </div>
                    </div>

                    <!-- SEO -->
                    <div class="card">
                        <div class="card-header">
                            <h5>تنظیمات SEO</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="meta_title">عنوان متا</label>
                                    <input type="text" name="meta_title" id="meta_title"
                                        value="{{ old('meta_title') }}">
                                </div>
                                <div class="form-group">
                                    <label for="slug">نامک (Slug)</label>
                                    <input type="text" name="slug" id="slug"
                                        value="{{ old('slug') }}">
                                </div>
                                <div class="form-group full-width">
                                    <label for="meta_description">توضیحات متا</label>
                                    <textarea name="meta_description" id="meta_description" rows="3">{{ old('meta_description') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ستون کناری -->
                <div class="sidebar-column">
                    <!-- وضعیت -->
                    <div class="card">
                        <div class="card-header">
                            <h5>وضعیت و تنظیمات</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group" style="margin-bottom:15px;">
                                <label for="status">وضعیت</label>
                                <select name="status" id="status">
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>در
                                        انتظار تایید</option>
                                    <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>تایید
                                        شده</option>
                                    <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>رد
                                        شده</option>
                                </select>
                            </div>
                            <div class="checkbox-wrapper">
                                <input type="checkbox" name="featured" id="featured" value="1"
                                    {{ old('featured') ? 'checked' : '' }}>
                                <label for="featured" class="checkbox-label">محصول ویژه</label>
                            </div>
                            <div class="form-group">
                                <label for="published_at">تاریخ انتشار</label>
                                <input type="datetime-local" name="published_at" id="published_at"
                                    value="{{ old('published_at') }}">
                            </div>
                        </div>
                    </div>

                    <!-- تصویر اصلی -->
                    <div class="card">
                        <div class="card-header">
                            <h5>تصویر اصلی</h5>
                        </div>
                        <div class="card-body">
                            <input type="file" name="cover" id="cover" accept="image/*">
                        </div>
                    </div>

                    <!-- تصاویر اضافی -->
                    <div class="card">
                        <div class="card-header">
                            <h5>تصاویر اضافی</h5>
                        </div>
                        <div class="card-body">
                            <input type="file" name="images[]" id="images" accept="image/*,video/*" multiple>
                            <p class="helper-text">می‌توانید چندین فایل انتخاب کنید</p>
                        </div>
                    </div>

                    <!-- تگ‌ها -->
                    <div class="card">
                        <div class="card-header">
                            <h5>تگ‌ها</h5>
                        </div>
                        <div class="card-body">
                            <select name="tags[]" id="tags" multiple size="8">
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}"
                                        {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>
                                        {{ $tag->name }}</option>
                                @endforeach
                            </select>
                            <p class="helper-text">برای انتخاب چندین تگ، کلید Ctrl را نگه دارید</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.products.index') }}" class="btn btn-cancel">انصراف</a>
                <button type="submit" class="btn btn-submit">ذخیره محصول</button>
            </div>
        </form>
    </div>

    <script>
        // --------------------------------------------------------------
        // 1. فیلتر کردن زیردسته اول بر اساس دسته اصلی
        // --------------------------------------------------------------
        const categorySelect = document.getElementById('category_id');
        const subcategorySelect = document.getElementById('subcategory_id');
        const subSubcategorySelect = document.getElementById('sub_subcategory_id');

        categorySelect.addEventListener('change', function() {
            const categoryId = this.value;
            if (!categoryId) {
                subcategorySelect.innerHTML = '<option value="">ابتدا دسته اصلی را انتخاب کنید</option>';
                subSubcategorySelect.innerHTML = '<option value="">ابتدا زیردسته اول را انتخاب کنید</option>';
                subcategorySelect.disabled = true;
                subSubcategorySelect.disabled = true;
                return;
            }

            fetch(`/get-subcategories/${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    subcategorySelect.innerHTML = '<option value="">انتخاب کنید</option>';
                    data.forEach(sub => {
                        const option = document.createElement('option');
                        option.value = sub.id;
                        option.textContent = sub.name;
                        subcategorySelect.appendChild(option);
                    });
                    subcategorySelect.disabled = false;
                    subSubcategorySelect.innerHTML =
                        '<option value="">ابتدا زیردسته اول را انتخاب کنید</option>';
                    subSubcategorySelect.disabled = true;
                })
                .catch(err => console.error('خطا در بارگذاری زیردسته‌ها:', err));
        });

        // --------------------------------------------------------------
        // 2. فیلتر کردن زیردسته دوم بر اساس زیردسته اول
        // --------------------------------------------------------------
        subcategorySelect.addEventListener('change', function() {
            const subcategoryId = this.value;
            if (!subcategoryId) {
                subSubcategorySelect.innerHTML = '<option value="">ابتدا زیردسته اول را انتخاب کنید</option>';
                subSubcategorySelect.disabled = true;
                return;
            }

            fetch(`/get-subsubcategories/${subcategoryId}`)
                .then(response => response.json())
                .then(data => {
                    subSubcategorySelect.innerHTML = '<option value="">انتخاب کنید</option>';
                    data.forEach(subsub => {
                        const option = document.createElement('option');
                        option.value = subsub.id;
                        option.textContent = subsub.name;
                        subSubcategorySelect.appendChild(option);
                    });
                    subSubcategorySelect.disabled = false;
                })
                .catch(err => console.error('خطا در بارگذاری زیردسته دوم:', err));
        });

        // --------------------------------------------------------------
        // 3. بارگذاری فیلدهای اختصاصی (Custom Fields)
        // --------------------------------------------------------------
        function loadCustomFields() {
            const subcategoryId = subcategorySelect.value;
            const subSubcategoryId = subSubcategorySelect.value;

            if (!subcategoryId) {
                document.getElementById('custom-fields-container').innerHTML = '';
                return;
            }

            let url = `/product-fields?subcategory_id=${subcategoryId}`;
            if (subSubcategoryId) {
                url += `&sub_subcategory_id=${subSubcategoryId}`;
            }

            fetch(url)
                .then(response => response.json())
                .then(fields => {
                    const container = document.getElementById('custom-fields-container');
                    container.innerHTML = '';

                    for (const [key, field] of Object.entries(fields)) {
                        const wrapper = document.createElement('div');
                        wrapper.className = 'form-group';

                        const label = document.createElement('label');
                        label.htmlFor = `attr_${key}`;
                        label.textContent = field.label;

                        let input;
                        if (field.type === 'select') {
                            input = document.createElement('select');
                            input.name = `attributes[${key}]`;
                            input.className = 'form-control';
                            input.id = `attr_${key}`;
                            const defaultOption = document.createElement('option');
                            defaultOption.value = '';
                            defaultOption.textContent = 'انتخاب کنید';
                            input.appendChild(defaultOption);
                            field.options.forEach(opt => {
                                const option = document.createElement('option');
                                option.value = opt;
                                option.textContent = opt;
                                input.appendChild(option);
                            });
                        } else {
                            input = document.createElement('input');
                            input.type = field.type;
                            input.name = `attributes[${key}]`;
                            input.className = 'form-control';
                            input.id = `attr_${key}`;
                            if (field.type !== 'date') input.placeholder = field.label;
                        }

                        wrapper.appendChild(label);
                        wrapper.appendChild(input);
                        container.appendChild(wrapper);
                    }
                })
                .catch(err => console.error('خطا در بارگذاری فیلدها:', err));
        }

        subcategorySelect.addEventListener('change', loadCustomFields);
        subSubcategorySelect.addEventListener('change', loadCustomFields);

        // --------------------------------------------------------------
        // 4. تولید خودکار slug
        // --------------------------------------------------------------
        document.getElementById('name').addEventListener('input', function() {
            let slug = this.value.toLowerCase()
                .replace(/[^\u0600-\u06FF\w\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim('-');
            document.getElementById('slug').value = slug;
        });

        // --------------------------------------------------------------
        // 5. رفع مشکل ارسال فرم (جلوگیری از تداخل رویدادها)
        // --------------------------------------------------------------
        const form = document.getElementById('mainForm');
        const submitBtn = document.querySelector('.btn-submit');

        // حذف هرگونه رویداد قبلی روی دکمه که ممکن است مانع ارسال شود
        submitBtn.removeEventListener('click', () => {});
        // اضافه کردن رویداد جدید که فقط فرم را ارسال کند (بدون preventDefault اضافی)
        submitBtn.addEventListener('click', function(e) {
            // اجازه می‌دهیم رویداد پیش‌فرض دکمه (که ارسال فرم است) اجرا شود
            // اما مطمئن می‌شویم که فرم واقعاً ارسال شود
            if (form) {
                // اگر دکمه از نوع submit نبود، می‌توانیم دستی صدا بزنیم
                // اما در اینجا از نوع submit است، پس نیازی به کار اضافه نیست
                // فقط در صورتی که فرم به هر دلیلی ارسال نشود، دستی ارسال می‌کنیم
                setTimeout(() => {
                    if (!form.submitted) {
                        form.submit();
                    }
                }, 100);
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ویرایش محصول</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />

    <style>
        /* ==== CSS شما (بدون تغییر) ==== */
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
            font-family: 'Vazirmatn', ui-sans-serif, system-ui, sans-serif;
            font-size: 14px;
            line-height: 1.6;
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
            box-shadow: 0 5px 15px -5px rgba(167, 139, 250, 0.3);
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

        .alert-danger ul {
            margin: 0;
            padding-right: 20px;
        }

        .form-layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .main-column,
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
            transition: border-color 0.2s ease;
        }

        .card:hover {
            border-color: rgba(167, 139, 250, 0.3);
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
            color: var(--text);
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
            cursor: pointer;
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

        .current-image-wrapper {
            margin-bottom: 15px;
        }

        .current-image-label {
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 8px;
            display: block;
        }

        .current-image {
            max-width: 150px;
            max-height: 150px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid var(--border);
        }

        .media-section {
            margin-bottom: 15px;
        }

        .media-section-label {
            color: var(--muted);
            font-size: 12px;
            margin-bottom: 10px;
            display: block;
        }

        .media-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .media-item {
            position: relative;
            display: inline-block;
        }

        .media-item img,
        .media-item video {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid var(--border);
        }

        .remove-media {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--danger);
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        .remove-media:hover {
            transform: scale(1.1);
            background: #dc2626;
        }

        .attribute-row {
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            gap: 10px;
            margin-bottom: 10px;
            align-items: end;
        }

        .btn-remove-attribute {
            padding: 10px 15px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s ease;
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .btn-remove-attribute:hover {
            background: rgba(239, 68, 68, 0.25);
            transform: translateY(-2px);
        }

        .btn-add-attribute {
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-family: inherit;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s ease;
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.3);
            margin-top: 10px;
        }

        .btn-add-attribute:hover {
            background: rgba(16, 185, 129, 0.25);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px -5px rgba(16, 185, 129, 0.4);
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
            text-decoration: none;
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

            .attribute-row {
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
            <h2>ویرایش محصول: {{ $product->name }}</h2>
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

        <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data"
            id="editForm">
            @csrf
            @method('PUT')

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
                                    <input type="text" name="name" id="name"
                                        value="{{ old('name', $product->name) }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="sku">کد محصول (SKU)</label>
                                    <input type="text" name="sku" id="sku"
                                        value="{{ old('sku', $product->sku) }}">
                                </div>
                                <div class="form-group">
                                    <label for="price">قیمت (تومان) <span class="required">*</span></label>
                                    <input type="number" name="price" id="price"
                                        value="{{ old('price', $product->price) }}" min="0" step="1000"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="discount_price">قیمت با تخفیف (تومان)</label>
                                    <input type="number" name="discount_price" id="discount_price"
                                        value="{{ old('discount_price', $product->discount_price) }}" min="0"
                                        step="1000">
                                </div>
                                <div class="form-group">
                                    <label for="quantity">موجودی</label>
                                    <input type="number" name="quantity" id="quantity"
                                        value="{{ old('quantity', $product->quantity) }}" min="0">
                                </div>
                                <div class="form-group">
                                    <label for="order">ترتیب نمایش</label>
                                    <input type="number" name="order" id="order"
                                        value="{{ old('order', $product->order) }}" min="0">
                                </div>
                                <div class="form-group full-width">
                                    <label for="description">توضیحات محصول</label>
                                    <textarea name="description" id="description" rows="4">{{ old('description', $product->description) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- دسته‌بندی با AJAX -->
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
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="subcategory_id">زیردسته اول <span class="required">*</span></label>
                                    <select name="subcategory_id" id="subcategory_id" required>
                                        <option value="">ابتدا دسته اصلی را انتخاب کنید</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="sub_subcategory_id">زیردسته دوم</label>
                                    <select name="sub_subcategory_id" id="sub_subcategory_id">
                                        <option value="">ابتدا زیردسته اول را انتخاب کنید</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ویژگی‌های اختصاصی (Custom Fields) و ویژگی‌های اضافی -->
                    <div class="card">
                        <div class="card-header">
                            <h5>ویژگی‌های اختصاصی محصول</h5>
                        </div>
                        <div class="card-body" id="custom-fields-container">
                            <!-- فیلدهای اختصاصی از دیتابیس custom_fields بارگذاری می‌شوند -->
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5>ویژگی‌های اضافی (دستی)</h5>
                        </div>
                        <div class="card-body">
                            <div id="dynamicAttributesContainer">
                                <!-- ویژگی‌های دستی که به صورت key-value اضافه می‌شوند -->
                            </div>
                            <button type="button" class="btn-add-attribute" onclick="addManualAttribute()">
                                <i class="fas fa-plus"></i> افزودن ویژگی
                            </button>
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
                                        value="{{ old('meta_title', $product->meta_title) }}">
                                </div>
                                <div class="form-group">
                                    <label for="slug">نامک (Slug)</label>
                                    <input type="text" name="slug" id="slug"
                                        value="{{ old('slug', $product->slug) }}">
                                </div>
                                <div class="form-group full-width">
                                    <label for="meta_description">توضیحات متا</label>
                                    <textarea name="meta_description" id="meta_description" rows="3">{{ old('meta_description', $product->meta_description) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="sidebar-column">
                    <!-- وضعیت و تنظیمات -->
                    <div class="card">
                        <div class="card-header">
                            <h5>وضعیت و تنظیمات</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group" style="margin-bottom:15px;">
                                <label for="status">وضعیت</label>
                                <select name="status" id="status">
                                    <option value="pending"
                                        {{ old('status', $product->status) == 'pending' ? 'selected' : '' }}>در انتظار
                                        تایید</option>
                                    <option value="approved"
                                        {{ old('status', $product->status) == 'approved' ? 'selected' : '' }}>تایید شده
                                    </option>
                                    <option value="rejected"
                                        {{ old('status', $product->status) == 'rejected' ? 'selected' : '' }}>رد شده
                                    </option>
                                </select>
                            </div>
                            <div class="checkbox-wrapper">
                                <input type="checkbox" name="featured" id="featured" value="1"
                                    {{ old('featured', $product->featured) ? 'checked' : '' }}>
                                <label for="featured" class="checkbox-label">محصول ویژه</label>
                            </div>
                            <div class="form-group">
                                <label for="published_at">تاریخ انتشار</label>
                                <input type="datetime-local" name="published_at" id="published_at"
                                    value="{{ old('published_at', $product->published_at ? $product->published_at->format('Y-m-d\TH:i') : '') }}">
                            </div>
                        </div>
                    </div>

                    <!-- تصویر اصلی -->
                    <div class="card">
                        <div class="card-header">
                            <h5>تصویر اصلی</h5>
                        </div>
                        <div class="card-body">
                            @if ($product->cover)
                                <div class="current-image-wrapper">
                                    <label class="current-image-label">تصویر فعلی:</label>
                                    <img src="{{ asset('storage/' . $product->cover) }}" alt="{{ $product->name }}"
                                        class="current-image">
                                </div>
                            @endif
                            <input type="file" name="cover" id="cover" accept="image/*">
                        </div>
                    </div>

                    <!-- تصاویر اضافی -->
                    <div class="card">
                        <div class="card-header">
                            <h5>تصاویر اضافی</h5>
                        </div>
                        <div class="card-body">
                            @if ($product->media->isNotEmpty())
                                <div class="media-section">
                                    <label class="media-section-label">فایل‌های فعلی:</label>
                                    <div class="media-wrapper" id="mediaWrapper">
                                        @foreach ($product->media as $media)
                                            <div class="media-item" data-media-id="{{ $media->id }}">
                                                @if (Str::startsWith($media->file_type, 'image/'))
                                                    <img src="{{ asset('storage/' . $media->file_path) }}"
                                                        alt="{{ $media->file_name }}">
                                                @elseif(Str::startsWith($media->file_type, 'video/'))
                                                    <video controls>
                                                        <source src="{{ asset('storage/' . $media->file_path) }}"
                                                            type="{{ $media->file_type }}">
                                                    </video>
                                                @endif
                                                <button type="button" class="remove-media"
                                                    onclick="removeMedia({{ $media->id }})">×</button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
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
                                        {{ in_array($tag->id, old('tags', $product->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
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
                <button type="submit" class="btn btn-submit">ذخیره تغییرات</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // 1. بارگذاری زیردسته اول و دوم با AJAX (مانند صفحه create)
        const categorySelect = document.getElementById('category_id');
        const subcatSelect = document.getElementById('subcategory_id');
        const subsubcatSelect = document.getElementById('sub_subcategory_id');

        async function loadSubcategories(categoryId, selectedSubcatId = null) {
            if (!categoryId) {
                subcatSelect.innerHTML = '<option value="">ابتدا دسته اصلی را انتخاب کنید</option>';
                subcatSelect.disabled = true;
                subsubcatSelect.innerHTML = '<option value="">ابتدا زیردسته اول را انتخاب کنید</option>';
                subsubcatSelect.disabled = true;
                return;
            }
            const res = await fetch(`/get-subcategories/${categoryId}`);
            const data = await res.json();
            subcatSelect.innerHTML = '<option value="">انتخاب کنید</option>';
            data.forEach(sub => {
                const opt = document.createElement('option');
                opt.value = sub.id;
                opt.textContent = sub.name;
                if (selectedSubcatId && selectedSubcatId == sub.id) opt.selected = true;
                subcatSelect.appendChild(opt);
            });
            subcatSelect.disabled = false;
            // ریست زیردسته دوم
            subsubcatSelect.innerHTML = '<option value="">ابتدا زیردسته اول را انتخاب کنید</option>';
            subsubcatSelect.disabled = true;
            // بعد از بارگذاری زیردسته اول، اگر مقدار انتخاب شده دارد، زیردسته دوم را بارگذاری کن
            if (selectedSubcatId) {
                loadSubSubcategories(selectedSubcatId, '{{ $product->sub_subcategory_id }}');
            }
        }

        async function loadSubSubcategories(subcategoryId, selectedSubSubId = null) {
            if (!subcategoryId) {
                subsubcatSelect.innerHTML = '<option value="">ابتدا زیردسته اول را انتخاب کنید</option>';
                subsubcatSelect.disabled = true;
                return;
            }
            const res = await fetch(`/get-subsubcategories/${subcategoryId}`);
            const data = await res.json();
            subsubcatSelect.innerHTML = '<option value="">انتخاب کنید</option>';
            data.forEach(subsub => {
                const opt = document.createElement('option');
                opt.value = subsub.id;
                opt.textContent = subsub.name;
                if (selectedSubSubId && selectedSubSubId == subsub.id) opt.selected = true;
                subsubcatSelect.appendChild(opt);
            });
            subsubcatSelect.disabled = false;
        }

        categorySelect.addEventListener('change', function() {
            loadSubcategories(this.value, null);
            // بعد از تغییر دسته، فیلدهای اختصاصی را دوباره بارگذاری کن (زیردسته اول هنوز انتخاب نشده)
            loadCustomFields();
        });
        subcatSelect.addEventListener('change', function() {
            loadSubSubcategories(this.value, null);
            loadCustomFields(); // بارگذاری فیلدهای اختصاصی با زیردسته جدید
        });
        subsubcatSelect.addEventListener('change', loadCustomFields);

        // بارگذاری اولیه با مقادیر فعلی محصول
        const initialCategoryId = '{{ $product->category_id }}';
        const initialSubcatId = '{{ $product->subcategory_id }}';
        const initialSubSubId = '{{ $product->sub_subcategory_id }}';
        if (initialCategoryId) {
            loadSubcategories(initialCategoryId, initialSubcatId);
        }
        if (initialSubcatId) {
            loadSubSubcategories(initialSubcatId, initialSubSubId);
        }

        // 2. بارگذاری فیلدهای اختصاصی (Custom Fields) و پر کردن مقادیر ذخیره شده در attributes
        async function loadCustomFields() {
            const subcategoryId = subcatSelect.value;
            const subSubcategoryId = subsubcatSelect.value;
            const container = document.getElementById('custom-fields-container');
            if (!subcategoryId) {
                container.innerHTML = '';
                return;
            }
            let url = `/product-fields?subcategory_id=${subcategoryId}`;
            if (subSubcategoryId) url += `&sub_subcategory_id=${subSubcategoryId}`;
            try {
                const res = await fetch(url);
                const fields = await res.json();
                // مقادیر موجود در attributes محصول (ذخیره شده در product_attributes)
                const existingAttrs = @json($product->attributes->pluck('value', 'key'));
                container.innerHTML = '';
                for (const [key, field] of Object.entries(fields)) {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'form-group';
                    const label = document.createElement('label');
                    label.textContent = field.label;
                    let input;
                    const existingValue = existingAttrs[key] || '';
                    if (field.type === 'select') {
                        input = document.createElement('select');
                        input.name = `attributes[${key}]`;
                        input.className = 'form-control';
                        const defaultOpt = document.createElement('option');
                        defaultOpt.value = '';
                        defaultOpt.textContent = 'انتخاب کنید';
                        input.appendChild(defaultOpt);
                        field.options.forEach(opt => {
                            const option = document.createElement('option');
                            option.value = opt;
                            option.textContent = opt;
                            if (existingValue == opt) option.selected = true;
                            input.appendChild(option);
                        });
                    } else {
                        input = document.createElement('input');
                        input.type = field.type;
                        input.name = `attributes[${key}]`;
                        input.className = 'form-control';
                        input.value = existingValue;
                        if (field.type !== 'date') input.placeholder = field.label;
                    }
                    wrapper.appendChild(label);
                    wrapper.appendChild(input);
                    container.appendChild(wrapper);
                }
            } catch (err) {
                console.error('خطا در بارگذاری فیلدهای اختصاصی:', err);
            }
        }

        // 3. ویژگی‌های دستی (Dynamic Attributes) – ابتدا ویژگی‌های موجود را نمایش بده
        const manualContainer = document.getElementById('dynamicAttributesContainer');

        function addManualAttribute(key = '', value = '') {
            const row = document.createElement('div');
            row.className = 'attribute-row';
            row.innerHTML = `
                <input type="text" name="attribute_keys[]" placeholder="نام ویژگی" value="${escapeHtml(key)}" required>
                <input type="text" name="attribute_values[]" placeholder="مقدار ویژگی" value="${escapeHtml(value)}" required>
                <button type="button" class="btn-remove-attribute">حذف</button>
            `;
            manualContainer.appendChild(row);
        }

        function escapeHtml(str) {
            return str.replace(/[&<>]/g, function(m) {
                if (m === '&') return '&amp;';
                if (m === '<') return '&lt;';
                if (m === '>') return '&gt;';
                return m;
            });
        }
        // ویژگی‌های دستی موجود (آنهایی که در attributes هستند ولی در فیلدهای اختصاصی نیستند)
        const existingAttrsManual = @json(
            $product->attributes->filter(function ($attr) {
                    // سعی کنیم فیلدهایی که در custom fields نیستند را دستی نمایش دهیم (برای سادگی همه را نمایش می‌دهیم)
                    return true;
                })->pluck('value', 'key'));
        for (const [k, v] of Object.entries(existingAttrsManual)) {
            addManualAttribute(k, v);
        }
        // اگر هیچ ویژگی دستی نبود، یک ردیف خالی پیش‌فرض اضافه کن
        if (manualContainer.children.length === 0) {
            addManualAttribute('', '');
        }

        // حذف ردیف ویژگی دستی
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-remove-attribute')) {
                e.target.closest('.attribute-row').remove();
            }
        });

        // 4. تولید slug تنها در صورتی که فیلد slug خالی باشد (با کلیک یا خارج شدن از focus)
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');
        nameInput.addEventListener('blur', function() {
            if (!slugInput.value.trim()) {
                let slug = this.value.toLowerCase()
                    .replace(/[^\u0600-\u06FF\w\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .trim('-');
                slugInput.value = slug;
            }
        });

        // 5. حذف فایل رسانه با AJAX
        async function removeMedia(mediaId) {
            if (!confirm('آیا از حذف این فایل مطمئن هستید؟')) return;
            try {
                const res = await fetch(`/admin/products/media/${mediaId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        'Accept': 'application/json'
                    }
                });
                const result = await res.json();
                if (result.success) {
                    const mediaItem = document.querySelector(`.media-item[data-media-id="${mediaId}"]`);
                    if (mediaItem) mediaItem.remove();
                    alert('فایل با موفقیت حذف شد.');
                } else {
                    alert('خطا در حذف فایل: ' + (result.message || 'نامشخص'));
                }
            } catch (err) {
                alert('خطا در ارتباط با سرور');
            }
        }
    </script>
</body>

</html>

```html
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت اکانت بازی</title>
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
            max-width: 1000px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        /* Header */
        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-header h3 {
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
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: #34d399;
            border-color: rgba(16, 185, 129, 0.3);
        }

        /* Form Section */
        .form-section {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 30px;
            margin-bottom: 25px;
            position: relative;
            overflow: hidden;
        }

        .form-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, var(--accent), var(--accent-2));
            opacity: 0.7;
        }

        .form-section h4 {
            margin: 0 0 25px 0;
            font-size: 18px;
            font-weight: 600;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-section h4::before {
            content: '';
            width: 4px;
            height: 20px;
            background: linear-gradient(180deg, var(--accent), var(--accent-2));
            border-radius: 2px;
        }

        /* Form Grid */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-grid-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 20px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        /* Labels */
        .form-label {
            color: var(--muted);
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 6px;
            display: block;
        }

        /* Inputs */
        input[type="text"],
        input[type="number"],
        input[type="file"],
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

        input[type="text"]:focus,
        input[type="number"]:focus,
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

        /* File Input */
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
            font-family: inherit;
            transition: all 0.2s ease;
        }

        input[type="file"]::file-selector-button:hover {
            border-color: var(--accent-2);
            transform: translateY(-1px);
        }

        /* Error Messages */
        .invalid-feedback {
            color: #f87171;
            font-size: 12px;
            margin-top: 5px;
        }

        .is-invalid {
            border-color: rgba(239, 68, 68, 0.5) !important;
        }

        .is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15) !important;
        }

        /* Custom Fields */
        #custom-fields {
            min-height: 50px;
        }

        #custom-fields p {
            margin: 0;
            padding: 15px;
            border-radius: 8px;
            font-size: 13px;
        }

        #custom-fields .text-info {
            background: rgba(34, 211, 238, 0.1);
            color: var(--accent);
            border: 1px solid rgba(34, 211, 238, 0.3);
        }

        #custom-fields .text-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        /* Buttons */
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
            justify-content: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-2), #8b5cf6);
            color: white;
            box-shadow: 0 4px 15px -3px rgba(167, 139, 250, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px -3px rgba(167, 139, 250, 0.6);
        }

        .btn-secondary {
            background: linear-gradient(180deg, #101827, #0b1220);
            color: var(--text);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            border-color: var(--muted);
        }

        /* Action Buttons */
        .form-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 30px;
        }

        /* Responsive */
        @media (max-width: 768px) {

            .form-grid,
            .form-grid-3 {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
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
            <h3>ثبت اکانت بازی</h3>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('user.account.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-section">
                <h4>اطلاعات اصلی</h4>

                <div class="form-group">
                    <label for="title" class="form-label">عنوان اکانت</label>
                    <input type="text" id="title" name="title" class="@error('title') is-invalid @enderror"
                        value="{{ old('title') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sub_subcategory_id" class="form-label">زیردسته دوم</label>
                    <select id="sub_subcategory_id" name="sub_subcategory_id"
                        class="@error('sub_subcategory_id') is-invalid @enderror" required>
                        <option value="">انتخاب کنید</option>
                        @foreach ($subSubcategories as $subSub)
                            <option value="{{ $subSub->id }}"
                                {{ old('sub_subcategory_id') == $subSub->id ? 'selected' : '' }}>
                                {{ $subSub->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('sub_subcategory_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">توضیحات محصول</label>
                    <textarea name="description" id="description" rows="3">{{ old('description') }}</textarea>
                </div>

                <div class="form-grid-3">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label for="price" class="form-label">قیمت (تومان)</label>
                        <input type="number" id="price" name="price" class="@error('price') is-invalid @enderror"
                            value="{{ old('price') }}" min="0" required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group" style="margin-bottom: 0;">
                        <label for="discount" class="form-label">تخفیف (%)</label>
                        <input type="number" name="discount" id="discount" min="0" max="100"
                            step="0.01" value="{{ old('discount', 0) }}">
                    </div>

                    <div class="form-group" style="margin-bottom: 0;">
                        <label for="stock_status" class="form-label">وضعیت موجودی</label>
                        <select name="stock_status" id="stock_status">
                            <option value="in_stock"
                                {{ old('stock_status', 'in_stock') == 'in_stock' ? 'selected' : '' }}>موجود
                            </option>
                            <option value="out_of_stock" {{ old('stock_status') == 'out_of_stock' ? 'selected' : '' }}>
                                ناموجود</option>
                            <option value="pre_order" {{ old('stock_status') == 'pre_order' ? 'selected' : '' }}>
                                پیش‌فروش</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h4>فیلدهای اختصاصی</h4>
                <div id="custom-fields"></div>
            </div>

            <div class="form-section">
                <h4>رسانه‌ها</h4>

                <div class="form-group">
                    <label for="cover" class="form-label">عکس اصلی</label>
                    <input type="file" name="cover" id="cover" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="media" class="form-label">عکس‌ها و فیلم‌ها</label>
                    <input type="file" id="media" name="media[]" multiple accept="image/*,video/*">
                    @error('media')
                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                    @enderror
                    @error('media.*')
                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-section">
                <h4>تگ‌ها</h4>
                <div class="form-group">
                    <label for="tags" class="form-label">تگ‌های محصول</label>
                    <select name="tags[]" id="tags" multiple>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    ثبت اکانت
                </button>
                <a href="{{ route('home') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-right"></i>
                    بازگشت به صفحه اصلی
                </a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const getFieldsUrl = "{{ route('products.getFields') }}";
        const subcategoryId = {{ $subcategory->id }};
        const oldSubSubcategoryId = "{{ old('sub_subcategory_id') }}";

        $(document).ready(function() {
            function loadCustomFields(subSubcategoryId) {
                if (!subSubcategoryId) {
                    $('#custom-fields').empty();
                    return;
                }

                $.ajax({
                    url: getFieldsUrl,
                    method: 'GET',
                    data: {
                        subcategory_id: subcategoryId,
                        sub_subcategory_id: subSubcategoryId
                    },
                    success: function(fields) {
                        $('#custom-fields').empty();
                        if (Object.keys(fields).length === 0) {
                            $('#custom-fields').html(
                                '<p class="text-info">فیلدهای اختصاصی یافت نشد.</p>');
                            return;
                        }

                        Object.entries(fields).forEach(([key, field]) => {
                            let inputHtml = '';
                            if (field.type === 'select') {
                                inputHtml =
                                    `<select name="attributes[${key}]" required>`;
                                field.options.forEach(opt => {
                                    inputHtml +=
                                        `<option value="${opt}">${opt}</option>`;
                                });
                                inputHtml += `</select>`;
                            } else {
                                inputHtml =
                                    `<input type="${field.type}" name="attributes[${key}]" placeholder="${field.label}" required>`;
                            }
                            $('#custom-fields').append(`
                                <div class="form-group">
                                    <label class="form-label">${field.label}</label>
                                    ${inputHtml}
                                </div>
                            `);
                        });
                    },
                    error: function() {
                        $('#custom-fields').html('<p class="text-danger">خطا در دریافت فیلدها!</p>');
                    }
                });
            }

            $('#sub_subcategory_id').change(function() {
                loadCustomFields($(this).val());
            });

            if (oldSubSubcategoryId) {
                $('#sub_subcategory_id').val(oldSubSubcategoryId).trigger('change');
            }
        });
    </script>
</body>

</html>
```

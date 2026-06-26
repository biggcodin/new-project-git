<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ویرایش آگهی</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/persian-datepicker/1.0.0/css/persian-datepicker.min.css"
        rel="stylesheet" />

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

        body {
            background: linear-gradient(135deg, #0b1220 0%, #0f172a 100%);
            color: var(--text);
            font-family: 'Vazirmatn', sans-serif;
            margin: 0;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
        }

        .back-to-panel {
            position: absolute;
            top: 0;
            left: 20px;
            z-index: 10;
        }

        .back-to-panel .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 10px;
            text-decoration: none;
            color: var(--text);
            background: var(--card);
            border: 1px solid var(--border);
            transition: all 0.2s ease;
            font-weight: 500;
            font-size: 13px;
        }

        .back-to-panel .btn-back:hover {
            transform: translateY(-2px);
            border-color: var(--accent-2);
        }

        .page-header {
            text-align: center;
            margin-bottom: 30px;
            padding-top: 10px;
        }

        .page-header h2 {
            margin: 0 0 5px 0;
            font-size: 24px;
            font-weight: 700;
        }

        .page-header p {
            color: var(--muted);
            font-size: 14px;
        }

        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 30px;
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            color: var(--muted);
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-input,
        .form-select {
            width: 100%;
            background: #0b1220;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 12px 15px;
            color: var(--text);
            font-family: inherit;
            font-size: 14px;
            outline: none;
            transition: all 0.2s ease;
        }

        .form-input:focus,
        .form-select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(34, 211, 238, 0.15);
        }

        .row {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .col-md-6 {
            flex: 1;
            min-width: 200px;
        }

        .section-title {
            color: var(--accent);
            font-size: 16px;
            font-weight: 600;
            margin: 25px 0 15px 0;
            border-right: 3px solid var(--accent);
            padding-right: 10px;
        }

        .file-upload-box {
            border: 2px dashed var(--border);
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease;
            background: rgba(255, 255, 255, 0.02);
        }

        .file-upload-box:hover {
            border-color: var(--accent-2);
            background: rgba(167, 139, 250, 0.05);
        }

        .file-upload-box i {
            font-size: 32px;
            color: var(--accent-2);
            margin-bottom: 10px;
        }

        .file-name-display {
            font-size: 13px;
            color: var(--muted);
        }

        .current-image-wrapper {
            margin-bottom: 10px;
        }

        .current-image {
            max-width: 150px;
            max-height: 150px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid var(--border);
        }

        .media-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 15px;
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

        .tag-container {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            padding: 10px 0;
        }

        .tag-item {
            background: rgba(167, 139, 250, 0.15);
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 13px;
            border: 1px solid rgba(167, 139, 250, 0.3);
            cursor: pointer;
            transition: 0.2s;
            color: var(--text);
        }

        .tag-item.selected {
            background: var(--accent-2);
            color: white;
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

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: #34d399;
            border-color: rgba(16, 185, 129, 0.3);
        }

        .alert-info {
            background: rgba(34, 211, 238, 0.05);
            color: var(--accent);
            border-color: rgba(34, 211, 238, 0.2);
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
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
            background: transparent;
            color: var(--muted);
            border: 1px solid var(--border);
        }

        .btn-cancel:hover {
            background: rgba(255, 255, 255, 0.05);
            color: var(--text);
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--success), #059669);
            color: white;
            box-shadow: 0 4px 15px -3px rgba(16, 185, 129, 0.4);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px -3px rgba(16, 185, 129, 0.6);
        }

        @media (max-width: 768px) {
            .form-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .back-to-panel {
                position: static;
                text-align: left;
                margin-bottom: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="back-to-panel">
            <a href="{{ route('user.ads') }}" class="btn-back">
                <i class="fas fa-arrow-right"></i> بازگشت به آگهی‌های من
            </a>
        </div>

        <div class="page-header">
            <h2>✏️ ویرایش آگهی</h2>
            <p>اطلاعات آگهی خود را ویرایش و مجدداً ارسال کنید</p>
        </div>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin:0; padding-right:20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($product->rejection_reason)
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <strong>دلیل رد آگهی توسط ادمین:</strong> {{ $product->rejection_reason }}
                <br>لطفاً بر اساس دلیل رد، اطلاعات را اصلاح و مجدداً ارسال کنید.
            </div>
        @endif

        <form action="{{ route('user.product-application.update', $product) }}" method="POST"
            enctype="multipart/form-data" id="editForm">
            @csrf
            @method('PUT')

            <div class="card">
                <h3 class="section-title" style="margin-top:0;">اطلاعات اکانت</h3>

                <div class="form-group">
                    <label class="form-label">نوع بازی (زیرزیردسته) <span style="color:var(--danger);">*</span></label>
                    <select name="sub_subcategory_id" id="sub_subcategory_id" class="form-select" required>
                        <option value="">انتخاب کنید...</option>
                        @foreach ($gameTypes as $game)
                            <option value="{{ $game->id }}"
                                {{ $product->sub_subcategory_id == $game->id ? 'selected' : '' }}>
                                {{ $game->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div id="dynamic-fields-container">
                    @if ($product->attributes->count() > 0)
                        @foreach ($product->attributes as $attr)
                            <div class="form-group">
                                <label class="form-label">{{ $attr->key }}</label>
                                <input type="text" name="attributes[{{ $attr->key }}]" class="form-input"
                                    value="{{ $attr->value }}">
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> هیچ فیلد اختصاصی برای این بازی تعریف نشده است.
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label class="form-label">عنوان اکانت / نام محصول <span
                            style="color:var(--danger);">*</span></label>
                    <input type="text" name="name" class="form-input" value="{{ old('name', $product->name) }}"
                        required>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label class="form-label">قیمت (تومان) <span style="color:var(--danger);">*</span></label>
                        <input type="number" name="price" class="form-input" min="0"
                            value="{{ old('price', $product->price) }}" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="form-label">موجودی <span style="color:var(--danger);">*</span></label>
                        <input type="number" name="quantity" class="form-input" min="0"
                            value="{{ old('quantity', $product->quantity) }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">توضیحات (اختیاری)</label>
                    <textarea name="description" class="form-input" rows="3">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">تصویر کاور <span style="color:var(--danger);">*</span></label>

                    @if ($product->cover)
                        <div class="current-image-wrapper">
                            <label class="form-label" style="font-weight:400;color:var(--muted);">تصویر فعلی:</label>
                            <img src="{{ asset('storage/' . $product->cover) }}" class="current-image" alt="کاور">
                            <div style="margin-top:8px;">
                                <label style="color:var(--danger);font-weight:500;cursor:pointer;">
                                    <input type="checkbox" name="remove_cover" value="1" style="margin-left:5px;">
                                    حذف تصویر کاور فعلی
                                </label>
                            </div>
                        </div>
                    @endif

                    <div class="file-upload-box" onclick="document.getElementById('cover').click()">
                        <input type="file" id="cover" name="cover" accept="image/*" style="display:none;"
                            onchange="updateFileName(this, 'file-name-cover')">
                        <i class="fas fa-image"></i>
                        <div id="file-name-cover" class="file-name-display">برای آپلود تصویر جدید کلیک کنید</div>
                        <small style="color: var(--muted);">فرمت‌های مجاز: JPG, PNG, WEBP (حداکثر ۲ مگابایت)</small>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">مدیا (تصاویر و فیلم‌های اضافی - اختیاری)</label>
                    @if ($product->media->count() > 0)
                        <div class="media-wrapper">
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
                    @endif
                    <div class="file-upload-box" onclick="document.getElementById('media').click()">
                        <input type="file" id="media" name="media[]" accept="image/*,video/*" multiple
                            style="display:none;" onchange="updateFileName(this, 'file-name-media')">
                        <i class="fas fa-photo-video"></i>
                        <div id="file-name-media" class="file-name-display">برای آپلود فایل‌های جدید کلیک کنید</div>
                        <small style="color: var(--muted);">فرمت‌های مجاز: JPG, PNG, WEBP, MP4, AVI (حداکثر ۲۰ مگابایت
                            هر فایل)</small>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">برچسب‌ها (تگ‌ها - اختیاری)</label>
                    <div class="tag-container">
                        @php
                            $selectedTagIds = $product->tags->pluck('id')->toArray();
                        @endphp
                        @foreach ($tags as $tag)
                            <span class="tag-item {{ in_array($tag->id, $selectedTagIds) ? 'selected' : '' }}"
                                data-id="{{ $tag->id }}" onclick="toggleTag(this)">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                    <input type="hidden" name="tags" id="selected-tags"
                        value="{{ json_encode($selectedTagIds) }}">
                </div>

                <div class="form-actions">
                    <a href="{{ route('user.ads') }}" class="btn btn-cancel">انصراف</a>
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-paper-plane"></i> ارسال مجدد برای بررسی
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // بارگذاری فیلدهای اختصاصی هنگام تغییر نوع بازی
            $('#sub_subcategory_id').on('change', function() {
                loadCustomFields($(this).val());
            });

            // در صورت تغییر نوع بازی، فیلدهای اختصاصی را دوباره بارگذاری کن
            var initialGame = $('#sub_subcategory_id').val();
            if (initialGame) {
                loadCustomFields(initialGame);
            }
        });

        function loadCustomFields(subSubcategoryId) {
            const container = document.getElementById('dynamic-fields-container');
            if (!subSubcategoryId) {
                container.innerHTML = `<div class="alert alert-info">لطفاً نوع بازی را انتخاب کنید.</div>`;
                return;
            }
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            $.ajax({
                url: '{{ route('seller.product.request.getFields') }}',
                type: 'GET',
                data: {
                    sub_subcategory_id: subSubcategoryId
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    let html = '';
                    if (response.fields && response.fields.length > 0) {
                        // مقادیر فعلی attributes را از دیتابیس بگیریم
                        const existingAttrs = @json($product->attributes->pluck('value', 'key'));
                        response.fields.forEach(field => {
                            let value = existingAttrs[field.key] || '';
                            let inputHtml = '';
                            if (field.type === 'text' || field.type === 'number') {
                                inputHtml =
                                    `<input type="${field.type}" name="attributes[${field.key}]" class="form-input" value="${value}" placeholder="${field.label}" ${field.required ? 'required' : ''}>`;
                            } else if (field.type === 'date') {
                                inputHtml =
                                    `<input type="text" name="attributes[${field.key}]" class="form-input" value="${value}" placeholder="${field.label}" ${field.required ? 'required' : ''}>`;
                            } else if (field.type === 'select') {
                                let options = JSON.parse(field.options || '[]');
                                let opts = options.map(opt =>
                                    `<option value="${opt}" ${value == opt ? 'selected' : ''}>${opt}</option>`
                                ).join('');
                                inputHtml =
                                    `<select name="attributes[${field.key}]" class="form-select" ${field.required ? 'required' : ''}><option value="">انتخاب کنید...</option>${opts}</select>`;
                            }
                            html +=
                                `<div class="form-group"><label class="form-label">${field.label} ${field.required ? '<span style="color:var(--danger);">*</span>' : ''}</label>${inputHtml}</div>`;
                        });
                    } else {
                        html =
                            `<div class="alert alert-info">هیچ فیلد اختصاصی برای این بازی تعریف نشده است.</div>`;
                    }
                    container.innerHTML = html;
                },
                error: function() {
                    container.innerHTML =
                        `<div class="alert alert-danger">خطا در بارگذاری فیلدهای اختصاصی.</div>`;
                }
            });
        }

        function updateFileName(input, displayId) {
            const display = document.getElementById(displayId);
            if (input.files && input.files.length > 0) {
                if (input.files.length === 1) {
                    display.innerText = input.files[0].name;
                } else {
                    display.innerText = `${input.files.length} فایل انتخاب شد`;
                }
                display.style.color = 'var(--success)';
            }
        }

        function toggleTag(el) {
            el.classList.toggle('selected');
            updateSelectedTags();
        }

        function updateSelectedTags() {
            const selected = document.querySelectorAll('.tag-item.selected');
            const ids = Array.from(selected).map(el => el.dataset.id);
            document.getElementById('selected-tags').value = JSON.stringify(ids);
        }

        function removeMedia(mediaId) {
            if (!confirm('آیا از حذف این فایل مطمئن هستید؟')) return;

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            if (!csrfToken) {
                alert('توکن CSRF یافت نشد.');
                return;
            }

            fetch(`/user/media/${mediaId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const item = document.querySelector(`.media-item[data-media-id="${mediaId}"]`);
                        if (item) {
                            item.remove();
                            alert('فایل با موفقیت حذف شد.');
                        }
                    } else {
                        alert('خطا در حذف فایل: ' + (data.message || 'نامشخص'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('خطا در ارتباط با سرور');
                });
        }
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ثبت آگهی جدید</title>
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

        .wizard-header {
            text-align: center;
            margin-bottom: 30px;
            padding-top: 10px;
        }

        .wizard-header h2 {
            margin: 0 0 5px 0;
            font-size: 24px;
            font-weight: 700;
        }

        .wizard-header p {
            color: var(--muted);
            font-size: 14px;
        }

        .wizard-steps {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
            position: relative;
        }

        .step-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 1;
            width: 120px;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--card);
            border: 2px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--muted);
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }

        .step-title {
            font-size: 12px;
            color: var(--muted);
            transition: all 0.3s ease;
            text-align: center;
        }

        .step-line {
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--border);
            z-index: 0;
            width: 70%;
            margin: 0 auto;
        }

        .step-item.active .step-circle {
            border-color: var(--accent-2);
            background: rgba(167, 139, 250, 0.1);
            color: var(--accent-2);
            box-shadow: 0 0 15px rgba(167, 139, 250, 0.3);
        }

        .step-item.active .step-title {
            color: var(--text);
            font-weight: 600;
        }

        .step-item.completed .step-circle {
            background: var(--success);
            border-color: var(--success);
            color: white;
        }

        .step-item.completed .step-title {
            color: var(--success);
        }

        .wizard-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 30px;
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
            min-height: 400px;
        }

        .step-content {
            display: none;
            animation: fadeIn 0.4s ease;
        }

        .step-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
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

        .radio-group {
            display: flex;
            gap: 15px;
        }

        .radio-option {
            flex: 1;
            position: relative;
        }

        .radio-option input {
            position: absolute;
            opacity: 0;
        }

        .radio-tile {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px;
            background: #0b1220;
            border: 1px solid var(--border);
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s ease;
            color: var(--muted);
        }

        .radio-option input:checked+.radio-tile {
            background: rgba(16, 185, 129, 0.1);
            border-color: var(--success);
            color: var(--success);
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

        .review-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        .review-table td {
            padding: 12px 15px;
            border-bottom: 1px solid var(--border);
        }

        .review-table td:first-child {
            color: var(--muted);
            width: 40%;
            font-weight: 500;
        }

        .review-table td:last-child {
            color: var(--text);
            font-weight: 600;
            text-align: left;
        }

        .section-title {
            color: var(--accent);
            font-size: 16px;
            font-weight: 600;
            margin: 25px 0 15px 0;
            border-right: 3px solid var(--accent);
            padding-right: 10px;
        }

        .wizard-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
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

        .btn-prev {
            background: transparent;
            color: var(--muted);
            border: 1px solid var(--border);
        }

        .btn-prev:hover {
            background: rgba(255, 255, 255, 0.05);
            color: var(--text);
        }

        .btn-next {
            background: linear-gradient(135deg, var(--accent-2), #8b5cf6);
            color: white;
            box-shadow: 0 4px 15px -3px rgba(167, 139, 250, 0.4);
        }

        .btn-next:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px -3px rgba(167, 139, 250, 0.6);
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

        @media (max-width: 768px) {
            .wizard-actions {
                flex-direction: column-reverse;
                gap: 10px;
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

            .step-item {
                width: 80px;
            }

            .step-title {
                font-size: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="back-to-panel">
            <a href="{{ route('user.panel') }}" class="btn-back">
                <i class="fas fa-arrow-right"></i> بازگشت به پنل
            </a>
        </div>

        <div class="wizard-header">
            <h2>📢 ثبت آگهی جدید</h2>
            <p>لطفاً مشخصات اکانت خود را وارد کنید</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin:0; padding-right:20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif

        @php
            $user = auth()->user();
            // اگر کاربر فروشنده است، هویت را تأیید شده در نظر بگیر
            $identityApproved = $identityApproved ?? $user->hasApprovedIdentity() || $user->isSeller();
            $identityRejected = $identityRejected ?? false;
            $identityData = $identityData ?? null;

            $totalSteps = $identityApproved ? 2 : 3;
        @endphp

        <!-- استپ‌ها -->
        <div class="wizard-steps">
            <div class="step-line"></div>

            {{-- فقط در صورتی که هویت تأیید نشده باشد و کاربر فروشنده نباشد، مرحله اول نمایش داده شود --}}
            @if (!$identityApproved && !auth()->user()->isSeller())
                <div class="step-item active" id="step-indicator-1">
                    <div class="step-circle">1</div>
                    <div class="step-title">احراز هویت</div>
                </div>
            @endif

            <div class="step-item {{ $identityApproved ? 'active' : '' }}" id="step-indicator-2">
                <div class="step-circle">{{ $identityApproved ? '1' : '2' }}</div>
                <div class="step-title">اطلاعات اکانت</div>
            </div>

            <div class="step-item" id="step-indicator-3">
                <div class="step-circle">{{ $identityApproved ? '2' : '3' }}</div>
                <div class="step-title">مرور و تایید</div>
            </div>
        </div>

        <form action="{{ route('seller.product.request.store') }}" method="POST" enctype="multipart/form-data"
            id="wizardForm">
            @csrf
            <input type="hidden" name="identity_not_approved"
                value="{{ $identityApproved || auth()->user()->isSeller() ? 0 : 1 }}">

            <div class="wizard-card">

                <!-- ============ مرحله 1 (فقط در صورت عدم تأیید هویت و فروشنده نبودن) ============ -->
                @if (!$identityApproved && !auth()->user()->isSeller())
                    <div class="step-content active" id="step-1">
                        <h3 class="section-title" style="margin-top:0;">مرحله اول: احراز هویت فروشنده</h3>
                        <p style="color: var(--muted); margin-bottom:20px;">این اطلاعات فقط یک بار برای تأیید هویت شما
                            استفاده می‌شود.</p>

                        @if ($identityRejected && $identityData)
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-circle"></i>
                                درخواست هویت شما قبلاً رد شده است. دلیل: {{ $identityData->rejection_reason }}
                                <br>لطفاً اطلاعات خود را ویرایش و مجدداً ارسال کنید.
                            </div>
                        @endif

                        <div class="form-group">
                            <label class="form-label">آیا بالای ۱۸ سال هستید؟</label>
                            <div class="radio-group">
                                <label class="radio-option">
                                    <input type="radio" name="is_adult" value="yes"
                                        {{ old('is_adult', $identityData->is_over_18 ?? true ? 'yes' : '') == 'yes' ? 'checked' : '' }}>
                                    <span class="radio-tile"><i class="fas fa-check"></i> بله</span>
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="is_adult" value="no"
                                        {{ old('is_adult', $identityData->is_over_18 ?? true ? '' : 'no') == 'no' ? 'checked' : '' }}>
                                    <span class="radio-tile"><i class="fas fa-times"></i> خیر</span>
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="form-label">نام</label>
                                <input type="text" name="first_name" class="form-input"
                                    value="{{ old('first_name', $identityData->first_name ?? '') }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="form-label">نام خانوادگی</label>
                                <input type="text" name="last_name" class="form-input"
                                    value="{{ old('last_name', $identityData->last_name ?? '') }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="form-label">کد ملی (۱۰ رقم)</label>
                                <input type="text" name="national_code" class="form-input" maxlength="10"
                                    value="{{ old('national_code', $identityData->national_code ?? '') }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label class="form-label">تاریخ تولد (شمسی)</label>
                                <input type="text" name="birth_date" id="birth_date" class="form-input"
                                    placeholder="مثال: ۱۳۸۰/۰۱/۰۱"
                                    value="{{ old('birth_date', $identityData->birth_date ?? '') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">شماره موبایل (به نام صاحب کارت)</label>
                            <input type="tel" name="phone" class="form-input"
                                value="{{ old('phone', $identityData->phone ?? '') }}" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">شماره کارت بانکی (۱۶ رقم)</label>
                            <input type="text" name="card_number" class="form-input" maxlength="16"
                                value="{{ old('card_number', $identityData->bank_card_number ?? '') }}" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">تصویر کارت ملی یا صفحه اول شناسنامه</label>
                            <div class="file-upload-box" onclick="document.getElementById('id_card').click()">
                                <input type="file" id="id_card" name="id_card_image" accept="image/*"
                                    style="display:none;" onchange="updateFileName(this, 'file-name-identity')">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <div id="file-name-identity" class="file-name-display">
                                    @if ($identityData && $identityData->national_card_image)
                                        {{ basename($identityData->national_card_image) }}
                                    @else
                                        برای آپلود کلیک کنید
                                    @endif
                                </div>
                                <small style="color: var(--muted);">فرمت‌های مجاز: JPG, PNG (حداکثر ۲
                                    مگابایت)</small>
                            </div>
                            @if ($identityData && $identityData->national_card_image)
                                <div style="margin-top:5px;font-size:12px;color:var(--muted);">
                                    <i class="fas fa-image"></i> فایل فعلی:
                                    {{ basename($identityData->national_card_image) }}
                                </div>
                            @endif
                        </div>

                        <div class="wizard-actions" style="border-top: none; margin-top: 10px;">
                            <div></div>
                            <button type="button" class="btn btn-next" onclick="changeStep(1)">
                                مرحله بعد <i class="fas fa-arrow-left"></i>
                            </button>
                        </div>
                    </div>
                @endif

                <!-- ============ مرحله 2: اطلاعات اکانت ============ -->
                <div class="step-content {{ $identityApproved ? 'active' : '' }}" id="step-2">
                    <h3 class="section-title" style="margin-top:0;">مرحله {{ $identityApproved ? 'اول' : 'دوم' }}:
                        اطلاعات اکانت</h3>
                    <p style="color: var(--muted); margin-bottom:20px;">مشخصات اکانت یا محصولی که می‌خواهید بفروشید را
                        وارد کنید.</p>

                    <div class="form-group">
                        <label class="form-label">نوع بازی (زیرزیردسته) <span
                                style="color:var(--danger);">*</span></label>
                        <select name="sub_subcategory_id" id="sub_subcategory_id" class="form-select" required>
                            <option value="">انتخاب کنید...</option>
                            @foreach ($gameTypes as $game)
                                <option value="{{ $game->id }}">{{ $game->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="dynamic-fields-container">
                        <div class="alert alert-info"
                            style="background:rgba(34,211,238,0.05); border-color:rgba(34,211,238,0.2);">
                            <i class="fas fa-info-circle"></i> لطفاً ابتدا نوع بازی را انتخاب کنید تا فیلدهای اختصاصی
                            نمایش داده شوند.
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">عنوان اکانت / نام محصول <span
                                style="color:var(--danger);">*</span></label>
                        <input type="text" name="name" class="form-input" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="form-label">قیمت (تومان) <span style="color:var(--danger);">*</span></label>
                            <input type="number" name="price" class="form-input" min="0" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="form-label">موجودی <span style="color:var(--danger);">*</span></label>
                            <input type="number" name="quantity" class="form-input" min="0" value="1"
                                required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">توضیحات (اختیاری)</label>
                        <textarea name="description" class="form-input" rows="3" placeholder="توضیحات تکمیلی درباره اکانت..."></textarea>
                    </div>

                    <div class="form-group">
                        <label class="form-label">تصویر کاور <span style="color:var(--danger);">*</span></label>
                        <div class="file-upload-box" onclick="document.getElementById('cover').click()">
                            <input type="file" id="cover" name="cover" accept="image/*"
                                style="display:none;" onchange="updateFileName(this, 'file-name-cover')" required>
                            <i class="fas fa-image"></i>
                            <div id="file-name-cover" class="file-name-display">برای آپلود کلیک کنید</div>
                            <small style="color: var(--muted);">فرمت‌های مجاز: JPG, PNG, WEBP (حداکثر ۲
                                مگابایت)</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">مدیا (تصاویر و فیلم‌های اضافی - اختیاری)</label>
                        <div class="file-upload-box" onclick="document.getElementById('media').click()">
                            <input type="file" id="media" name="media[]" accept="image/*,video/*" multiple
                                style="display:none;" onchange="updateFileName(this, 'file-name-media')">
                            <i class="fas fa-photo-video"></i>
                            <div id="file-name-media" class="file-name-display">برای آپلود کلیک کنید (چند فایل)</div>
                            <small style="color: var(--muted);">فرمت‌های مجاز: JPG, PNG, WEBP, MP4, AVI (حداکثر ۲۰
                                مگابایت هر فایل)</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">برچسب‌ها (تگ‌ها - اختیاری)</label>
                        <div class="tag-container">
                            @foreach ($tags as $tag)
                                <span class="tag-item" data-id="{{ $tag->id }}" onclick="toggleTag(this)">
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                        <input type="hidden" name="tags" id="selected-tags" value="">
                    </div>

                    <div class="wizard-actions">
                        @if (!$identityApproved && !auth()->user()->isSeller())
                            <button type="button" class="btn btn-prev" onclick="changeStep(-1)">
                                <i class="fas fa-arrow-right"></i> مرحله قبل
                            </button>
                        @else
                            <div></div>
                        @endif
                        <button type="button" class="btn btn-next" onclick="changeStep(1)">
                            مرحله بعد <i class="fas fa-arrow-left"></i>
                        </button>
                    </div>
                </div>

                <!-- ============ مرحله 3: مرور و تایید ============ -->
                <div class="step-content" id="step-3">
                    <h3 class="section-title" style="margin-top:0;">مرحله {{ $identityApproved ? 'دوم' : 'سوم' }}:
                        مرور و تایید نهایی</h3>
                    <p style="color: var(--muted); margin-bottom:20px;">لطفاً صحت تمام اطلاعات وارد شده را بررسی کنید.
                        پس از ارسال، درخواست شما برای ادمین ارسال می‌شود.</p>

                    <div class="section-title">اطلاعات هویتی</div>
                    <table class="review-table">
                        <tr>
                            <td>نام و نام خانوادگی</td>
                            <td>
                                @if ($identityApproved && $identityData)
                                    {{ $identityData->first_name }} {{ $identityData->last_name }}
                                @else
                                    <span id="review-name">-</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>کد ملی</td>
                            <td>
                                @if ($identityApproved && $identityData)
                                    {{ $identityData->national_code }}
                                @else
                                    <span id="review-national-code">-</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>شماره موبایل</td>
                            <td>
                                @if ($identityApproved && $identityData)
                                    {{ $identityData->phone }}
                                @else
                                    <span id="review-phone">-</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>شماره کارت</td>
                            <td>
                                @if ($identityApproved && $identityData)
                                    {{ $identityData->bank_card_number }}
                                @else
                                    <span id="review-card">-</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>سن قانونی</td>
                            <td>
                                @if ($identityApproved && $identityData)
                                    {{ $identityData->is_over_18 ? 'بله' : 'خیر' }}
                                @else
                                    <span id="review-adult">-</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>تصویر کارت ملی</td>
                            <td>
                                @if ($identityApproved && $identityData && $identityData->national_card_image)
                                    <span style="color:var(--success);"><i class="fas fa-check-circle"></i> آپلود
                                        شده</span>
                                @else
                                    <span id="review-id-card"><span style="color:var(--muted);">انتخاب
                                            نشده</span></span>
                                @endif
                            </td>
                        </tr>
                    </table>

                    <div class="section-title">اطلاعات اکانت</div>
                    <table class="review-table">
                        <tr>
                            <td>نوع بازی</td>
                            <td id="review-game">-</td>
                        </tr>
                        <tr>
                            <td>عنوان اکانت</td>
                            <td id="review-product-name">-</td>
                        </tr>
                        <tr>
                            <td>قیمت</td>
                            <td id="review-price">-</td>
                        </tr>
                        <tr>
                            <td>موجودی</td>
                            <td id="review-quantity">-</td>
                        </tr>
                        <tr>
                            <td>توضیحات</td>
                            <td id="review-description">-</td>
                        </tr>
                        <tr>
                            <td>تگ‌ها</td>
                            <td id="review-tags">-</td>
                        </tr>
                    </table>

                    <div id="review-custom-fields-container"></div>

                    <div id="review-media-section" style="display:none;">
                        <div class="section-title" style="margin-top:20px;">تصاویر و رسانه‌ها</div>
                        <div id="review-media-content" style="margin-bottom:20px;"></div>
                    </div>

                    <div class="wizard-actions">
                        <button type="button" class="btn btn-prev" onclick="changeStep(-1)">
                            <i class="fas fa-arrow-right"></i> مرحله قبل
                        </button>
                        <button type="submit" class="btn btn-submit">
                            <i class="fas fa-paper-plane"></i> ارسال درخواست
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/persian-date/1.1.0/persian-date.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/persian-datepicker/1.0.0/js/persian-datepicker.min.js"></script>

    <script>
        $(document).ready(function() {
            if (typeof persianDate !== 'undefined' && $.fn.persianDatepicker) {
                $('#birth_date').persianDatepicker({
                    format: 'YYYY/MM/DD',
                    autoClose: true,
                    initialValue: false,
                    calendar: {
                        persian: {
                            locale: 'fa'
                        }
                    }
                });
            }
            $('#sub_subcategory_id').on('change', function() {
                loadCustomFields($(this).val());
            });
            var selectedGame = $('#sub_subcategory_id').val();
            if (selectedGame) {
                loadCustomFields(selectedGame);
            }
        });

        // ===== مدیریت استپ‌ها =====
        let currentStep = {{ $identityApproved ? 2 : 1 }};
        const totalSteps = {{ $identityApproved ? 2 : 3 }};

        function changeStep(direction) {
            if (direction === 1 && !validateStep(currentStep)) return;

            document.getElementById(`step-${currentStep}`).classList.remove('active');
            document.getElementById(`step-indicator-${currentStep}`).classList.remove('active');

            if (direction === 1) {
                document.getElementById(`step-indicator-${currentStep}`).classList.add('completed');
                document.getElementById(`step-indicator-${currentStep}`).querySelector('.step-circle').innerHTML =
                    '<i class="fas fa-check"></i>';
            } else {
                document.getElementById(`step-indicator-${currentStep}`).classList.remove('completed');
                document.getElementById(`step-indicator-${currentStep}`).querySelector('.step-circle').innerHTML =
                    currentStep;
            }

            currentStep += direction;

            document.getElementById(`step-${currentStep}`).classList.add('active');
            document.getElementById(`step-indicator-${currentStep}`).classList.add('active');

            var prevBtn = document.getElementById('prevBtn');
            if (prevBtn) {
                prevBtn.style.visibility = currentStep === 1 ? 'hidden' : 'visible';
            }

            if (currentStep === totalSteps) {
                populateReviewData();
            }
        }

        function validateStep(step) {
            const el = document.getElementById(`step-${step}`);
            const inputs = el.querySelectorAll('input[required]:not([style*="display:none"]), select[required]');
            let valid = true;

            inputs.forEach(input => {
                if (input.type === 'file') {
                    if (input.id === 'id_card') {
                        const hasExisting =
                            {{ $identityData && $identityData->national_card_image ? 'true' : 'false' }};
                        if (input.files.length === 0 && !hasExisting) {
                            valid = false;
                            const display = el.querySelector('.file-name-display');
                            if (display) {
                                display.innerHTML = '⚠️ لطفاً یک فایل انتخاب کنید';
                                display.style.color = 'var(--danger)';
                            }
                            return;
                        }
                    } else if (input.files.length === 0) {
                        valid = false;
                        const display = el.querySelector('.file-name-display');
                        if (display) {
                            display.innerHTML = '⚠️ لطفاً یک فایل انتخاب کنید';
                            display.style.color = 'var(--danger)';
                        }
                        return;
                    }
                } else if (!input.value.trim()) {
                    valid = false;
                    input.style.borderColor = 'var(--danger)';
                    input.onfocus = () => input.style.borderColor = 'var(--border)';
                }
            });

            const nc = el.querySelector('input[name="national_code"]');
            if (nc && nc.value.replace(/\D/g, '').length !== 10 && nc.value !== '') {
                alert('کد ملی باید دقیقاً ۱۰ رقم باشد.');
                nc.style.borderColor = 'var(--danger)';
                valid = false;
            }

            if (!valid) {
                alert('لطفاً تمام فیلدهای الزامی (با علامت *) را به درستی پر کنید.');
            }
            return valid;
        }

        // ===== توابع کمکی =====
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

        // ===== بارگذاری فیلدهای اختصاصی (AJAX) =====
        function loadCustomFields(subSubcategoryId) {
            const container = document.getElementById('dynamic-fields-container');
            if (!container) {
                console.warn('⚠️ Container not found.');
                return;
            }
            if (!subSubcategoryId) {
                container.innerHTML = `
                    <div class="alert alert-info" style="background:rgba(34,211,238,0.05); border-color:rgba(34,211,238,0.2);">
                        <i class="fas fa-info-circle"></i> لطفاً ابتدا نوع بازی را انتخاب کنید.
                    </div>
                `;
                return;
            }

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            if (!csrfToken) {
                container.innerHTML = `<div class="alert alert-danger">توکن CSRF یافت نشد.</div>`;
                return;
            }

            container.innerHTML = `
                <div style="text-align:center;padding:20px;color:var(--muted);">
                    <i class="fas fa-spinner fa-spin" style="font-size:24px;"></i>
                    <div style="margin-top:10px;">در حال بارگذاری فیلدهای اختصاصی...</div>
                </div>
            `;

            const url = '{{ route('seller.product.request.getFields') }}' + '?sub_subcategory_id=' + encodeURIComponent(
                subSubcategoryId);

            fetch(url, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('HTTP ' + response.status);
                    return response.json();
                })
                .then(data => {
                    let html = '';
                    if (data.fields && data.fields.length > 0) {
                        data.fields.forEach(field => {
                            let inputHtml = '';
                            if (field.type === 'text' || field.type === 'number') {
                                inputHtml =
                                    `<input type="${field.type}" name="attributes[${field.key}]" class="form-input" placeholder="${field.label}" ${field.required ? 'required' : ''}>`;
                            } else if (field.type === 'date') {
                                inputHtml =
                                    `<input type="text" name="attributes[${field.key}]" class="form-input datepicker-custom" placeholder="${field.label}" ${field.required ? 'required' : ''}>`;
                            } else if (field.type === 'select') {
                                let options = [];
                                try {
                                    options = JSON.parse(field.options || '[]');
                                } catch (e) {
                                    options = [];
                                }
                                let opts = options.map(opt => `<option value="${opt}">${opt}</option>`).join(
                                    '');
                                inputHtml =
                                    `<select name="attributes[${field.key}]" class="form-select" ${field.required ? 'required' : ''}><option value="">انتخاب کنید...</option>${opts}</select>`;
                            }
                            html += `
                            <div class="form-group">
                                <label class="form-label">${field.label} ${field.required ? '<span style="color:var(--danger);">*</span>' : ''}</label>
                                ${inputHtml}
                            </div>
                        `;
                        });
                    } else {
                        html =
                            `<div class="alert alert-info" style="background:rgba(34,211,238,0.05); border-color:rgba(34,211,238,0.2);">هیچ فیلد اختصاصی برای این بازی تعریف نشده است.</div>`;
                    }
                    container.innerHTML = html;

                    if (typeof persianDate !== 'undefined' && $.fn.persianDatepicker) {
                        $('.datepicker-custom').persianDatepicker({
                            format: 'YYYY/MM/DD',
                            autoClose: true,
                            calendar: {
                                persian: {
                                    locale: 'fa'
                                }
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error('❌ Fetch Error:', error);
                    container.innerHTML = `
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i> خطا در بارگذاری فیلدهای اختصاصی.
                        <br><small style="color:var(--muted);">${error.message}</small>
                    </div>
                `;
                });
        }

        // ===== پر کردن داده‌های مرحله مرور =====
        function populateReviewData() {
            const form = document.getElementById('wizardForm');
            if (!form) return;
            const data = new FormData(form);

            // اگر هویت قبلاً تأیید نشده، مقادیر را از فرم بخوان
            const identityApproved = {{ $identityApproved ? 'true' : 'false' }};
            if (!identityApproved) {
                document.getElementById('review-name').innerText =
                    `${data.get('first_name') || ''} ${data.get('last_name') || ''}`.trim() || '-';
                document.getElementById('review-national-code').innerText = data.get('national_code') || '-';
                document.getElementById('review-phone').innerText = data.get('phone') || '-';
                document.getElementById('review-card').innerText = data.get('card_number') || '-';
                document.getElementById('review-adult').innerText = data.get('is_adult') === 'yes' ? 'بله' : 'خیر';
            }

            // اطلاعات اکانت (همیشه از فرم)
            const gameSelect = document.getElementById('sub_subcategory_id');
            const gameText = gameSelect?.options[gameSelect.selectedIndex]?.text || '-';
            document.getElementById('review-game').innerText = gameText;
            document.getElementById('review-product-name').innerText = data.get('name') || '-';
            const price = data.get('price');
            document.getElementById('review-price').innerText = price ? Number(price).toLocaleString() + ' تومان' : '-';
            document.getElementById('review-quantity').innerText = data.get('quantity') || '-';
            document.getElementById('review-description').innerText = data.get('description') || 'ندارد';

            // تگ‌ها
            const selectedTags = document.querySelectorAll('.tag-item.selected');
            const tagNames = Array.from(selectedTags).map(el => el.innerText.trim());
            document.getElementById('review-tags').innerText = tagNames.length ? tagNames.join('، ') : 'ندارد';

            // فیلدهای اختصاصی
            const customFieldsContainer = document.getElementById('dynamic-fields-container');
            const customFields = customFieldsContainer?.querySelectorAll('.form-group') || [];
            let customHtml = '';
            if (customFields.length > 0) {
                customFields.forEach(group => {
                    const label = group.querySelector('.form-label')?.innerText?.trim() || '';
                    const input = group.querySelector('input, select, textarea');
                    let value = '-';
                    if (input) {
                        if (input.tagName === 'SELECT') {
                            value = input.options[input.selectedIndex]?.text || '-';
                        } else if (input.type === 'file') {
                            value = input.files.length > 0 ? input.files[0].name : 'هیچ فایلی انتخاب نشده';
                        } else {
                            value = input.value || '-';
                        }
                    }
                    const cleanLabel = label.replace(/\s*\*$/, '').trim();
                    customHtml += `<tr><td>${cleanLabel}</td><td>${value}</td></tr>`;
                });
            }

            const existingCustomTable = document.getElementById('review-custom-fields-table');
            if (existingCustomTable) existingCustomTable.remove();

            if (customHtml) {
                const container = document.getElementById('review-custom-fields-container');
                const table = document.createElement('table');
                table.id = 'review-custom-fields-table';
                table.className = 'review-table';
                table.innerHTML = `
                    <thead>
                        <tr>
                            <th style="color:var(--muted);font-weight:600;padding:8px 15px;border-bottom:1px solid var(--border);text-align:right;">فیلد اختصاصی</th>
                            <th style="color:var(--muted);font-weight:600;padding:8px 15px;border-bottom:1px solid var(--border);text-align:left;">مقدار</th>
                        </tr>
                    </thead>
                    <tbody>${customHtml}</tbody>
                `;
                container.appendChild(table);
            }

            // تصاویر و رسانه‌ها
            const coverInput = document.getElementById('cover');
            const mediaInput = document.getElementById('media');
            let mediaHtml = '';

            if (coverInput?.files?.length > 0) {
                mediaHtml += `<div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:8px;">
                    <span style="background:rgba(16,185,129,0.1);padding:5px 14px;border-radius:6px;border:1px solid rgba(16,185,129,0.2);">
                        <i class="fas fa-image" style="color:var(--success);"></i> کاور: ${coverInput.files[0].name}
                    </span>
                </div>`;
            }

            if (mediaInput?.files?.length > 0) {
                let mediaNames = Array.from(mediaInput.files).map(f => f.name).join('، ');
                mediaHtml += `<div style="display:flex;gap:10px;flex-wrap:wrap;">
                    <span style="background:rgba(167,139,250,0.1);padding:5px 14px;border-radius:6px;border:1px solid rgba(167,139,250,0.2);">
                        <i class="fas fa-photo-video" style="color:var(--accent-2);"></i> مدیا (${mediaInput.files.length} فایل): ${mediaNames}
                    </span>
                </div>`;
            }

            const mediaSection = document.getElementById('review-media-section');
            const mediaContent = document.getElementById('review-media-content');
            if (mediaHtml) {
                mediaSection.style.display = 'block';
                mediaContent.innerHTML = mediaHtml;
            } else {
                mediaSection.style.display = 'none';
            }
        }
    </script>
</body>

</html>

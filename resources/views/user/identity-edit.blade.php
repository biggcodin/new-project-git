<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ویرایش اطلاعات هویتی</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/persian-datepicker/1.0.0/css/persian-datepicker.min.css"
        rel="stylesheet" />

    <style>
        /* استایل‌های مشابه ویزارد (برای اختصار حذف شده، اما می‌توانید از استایل‌های قبلی استفاده کنید) */
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
            max-width: 800px;
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
            <a href="{{ route('user.panel') }}" class="btn-back">
                <i class="fas fa-arrow-right"></i> بازگشت به پنل
            </a>
        </div>

        <div class="page-header">
            <h2>✏️ ویرایش اطلاعات هویتی</h2>
            <p>درخواست هویت شما رد شده است. لطفاً اطلاعات را ویرایش و مجدداً ارسال کنید.</p>
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

        @if ($identity->rejection_reason)
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <strong>دلیل رد توسط ادمین:</strong> {{ $identity->rejection_reason }}
            </div>
        @endif

        <form action="{{ route('user.identity.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="card">
                <div class="form-group">
                    <label class="form-label">آیا بالای ۱۸ سال هستید؟</label>
                    <div class="radio-group">
                        <label class="radio-option">
                            <input type="radio" name="is_adult" value="yes"
                                {{ old('is_adult', $identity->is_over_18 ? 'yes' : '') == 'yes' ? 'checked' : '' }}>
                            <span class="radio-tile"><i class="fas fa-check"></i> بله</span>
                        </label>
                        <label class="radio-option">
                            <input type="radio" name="is_adult" value="no"
                                {{ old('is_adult', $identity->is_over_18 ? '' : 'no') == 'no' ? 'checked' : '' }}>
                            <span class="radio-tile"><i class="fas fa-times"></i> خیر</span>
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label class="form-label">نام</label>
                        <input type="text" name="first_name" class="form-input"
                            value="{{ old('first_name', $identity->first_name) }}" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="form-label">نام خانوادگی</label>
                        <input type="text" name="last_name" class="form-input"
                            value="{{ old('last_name', $identity->last_name) }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label class="form-label">کد ملی (۱۰ رقم)</label>
                        <input type="text" name="national_code" class="form-input" maxlength="10"
                            value="{{ old('national_code', $identity->national_code) }}" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="form-label">تاریخ تولد (شمسی)</label>
                        <input type="text" name="birth_date" id="birth_date" class="form-input"
                            placeholder="مثال: ۱۳۸۰/۰۱/۰۱" value="{{ old('birth_date', $identity->birth_date) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">شماره موبایل (به نام صاحب کارت)</label>
                    <input type="tel" name="phone" class="form-input"
                        value="{{ old('phone', $identity->phone) }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">شماره کارت بانکی (۱۶ رقم)</label>
                    <input type="text" name="card_number" class="form-input" maxlength="16"
                        value="{{ old('card_number', $identity->bank_card_number) }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">تصویر کارت ملی یا صفحه اول شناسنامه</label>
                    @if ($identity->national_card_image)
                        <div style="margin-bottom:10px;">
                            <label style="color:var(--muted);font-size:12px;">تصویر فعلی:</label>
                            <img src="{{ asset('storage/' . $identity->national_card_image) }}"
                                style="max-width:150px;border-radius:8px;border:1px solid var(--border);display:block;margin-top:5px;">
                        </div>
                    @endif
                    <div class="file-upload-box" onclick="document.getElementById('id_card').click()">
                        <input type="file" id="id_card" name="id_card_image" accept="image/*" style="display:none;"
                            onchange="updateFileName(this, 'file-name-identity')">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <div id="file-name-identity" class="file-name-display">
                            @if ($identity->national_card_image)
                                {{ basename($identity->national_card_image) }}
                            @else
                                برای آپلود کلیک کنید
                            @endif
                        </div>
                        <small style="color: var(--muted);">فرمت‌های مجاز: JPG, PNG (حداکثر ۲ مگابایت)</small>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('user.panel') }}" class="btn btn-cancel">انصراف</a>
                    <button type="submit" class="btn btn-submit">
                        <i class="fas fa-paper-plane"></i> ارسال مجدد برای بررسی
                    </button>
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
        });

        function updateFileName(input, displayId) {
            const display = document.getElementById(displayId);
            if (input.files && input.files.length > 0) {
                display.innerText = input.files[0].name;
                display.style.color = 'var(--success)';
            }
        }
    </script>
</body>

</html>

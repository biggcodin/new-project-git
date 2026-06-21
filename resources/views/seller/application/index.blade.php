<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- اضافه شد -->
    <title>درخواست ثبت محصول (اکانت بازی)</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        /* ... (همان استایل‌های قبلی، بدون تغییر) ... */
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
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }

        /* Wizard Header */
        .wizard-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .wizard-header h2 {
            margin: 0 0 10px 0;
            font-size: 24px;
            font-weight: 700;
            color: var(--text);
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
            width: 100px;
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
        }

        .step-line {
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--border);
            z-index: 0;
            width: 60%;
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
            cursor: pointer;
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

        #custom-fields-container {
            margin-top: 20px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.02);
            border-radius: 10px;
            border: 1px solid var(--border);
            display: none;
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
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="wizard-header">
            <h2>ثبت درخواست فروش اکانت</h2>
            <p style="color: var(--muted);">لطفاً مراحل زیر را با دقت تکمیل کنید</p>
        </div>

        <!-- Steps Indicator -->
        <div class="wizard-steps">
            <div class="step-line"></div>
            <div class="step-item active" id="step-indicator-1">
                <div class="step-circle">1</div>
                <div class="step-title">اطلاعات هویتی</div>
            </div>
            <div class="step-item" id="step-indicator-2">
                <div class="step-circle">2</div>
                <div class="step-title">مشخصات محصول</div>
            </div>
            <div class="step-item" id="step-indicator-3">
                <div class="step-circle">3</div>
                <div class="step-title">تایید نهایی</div>
            </div>
        </div>

        <form action="{{ route('seller.product.request.store') }}" method="POST" enctype="multipart/form-data"
            id="wizardForm">
            @csrf
            <div class="wizard-card">

                <!-- Step 1: Identity Info -->
                <div class="step-content active" id="step-1">
                    <h3 class="section-title" style="margin-top: 0;">اطلاعات احراز هویت فروشنده</h3>

                    <div class="form-group">
                        <label class="form-label">آیا بالای 18 سال هستید؟</label>
                        <div class="radio-group">
                            <label class="radio-option">
                                <input type="radio" name="is_adult" value="yes" required checked>
                                <span class="radio-tile"><i class="fas fa-check me-2"></i> بله</span>
                            </label>
                            <label class="radio-option">
                                <input type="radio" name="is_adult" value="no">
                                <span class="radio-tile"><i class="fas fa-times me-2"></i> خیر</span>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="form-label">نام</label>
                            <input type="text" name="first_name" class="form-input" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="form-label">نام خانوادگی</label>
                            <input type="text" name="last_name" class="form-input" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="form-label">کد ملی</label>
                            <input type="number" name="national_code" class="form-input" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="form-label">تاریخ تولد</label>
                            <input type="text" name="birth_date" class="form-input" placeholder="مثال: 1380/01/01"
                                required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">شماره موبایل (به نام صاحب کارت بانکی)</label>
                        <input type="tel" name="phone" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">شماره کارت بانکی</label>
                        <input type="number" name="card_number" class="form-input" placeholder="شماره کارت 16 رقمی"
                            required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">تصویر کارت ملی یا صفحه اول شناسنامه</label>
                        <div class="file-upload-box" onclick="document.getElementById('id_card').click()">
                            <input type="file" id="id_card" name="id_card_image" accept="image/*"
                                style="display: none;" onchange="updateFileName(this)" required>
                            <i class="fas fa-cloud-upload-alt"></i>
                            <div id="file-name-display">برای آپلود کلیک کنید</div>
                            <small style="color: var(--muted);">فرمت‌های مجاز: JPG, PNG</small>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Product Details -->
                <div class="step-content" id="step-2">
                    <h3 class="section-title" style="margin-top: 0;">مشخصات اکانت بازی</h3>

                    <!-- Hidden Inputs for Fixed Categories -->
                    <input type="hidden" name="category_id" value="{{ $gameCategoryId ?? 1 }}">
                    <input type="hidden" name="subcategory_id" value="{{ $accountSubcategoryId ?? 5 }}">

                    <div class="form-group">
                        <label class="form-label">نوع بازی را انتخاب کنید</label>
                        <select name="sub_subcategory_id" id="game_type_select" class="form-select" required
                            onchange="loadCustomFields(this.value)">
                            <option value="">انتخاب کنید...</option>
                            @foreach ($gameTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                        <small style="color: var(--muted);">دسته "بازی" و زیردسته "اکانت" به صورت خودکار انتخاب
                            شده‌اند.</small>
                    </div>

                    <!-- Dynamic Custom Fields Container -->
                    <div id="custom-fields-container">
                        <h4 style="font-size: 14px; color: var(--accent); margin-bottom: 15px;">اطلاعات اختصاصی اکانت
                        </h4>
                        <div id="dynamic-fields-wrapper">
                            <!-- Fields will be loaded here via AJAX -->
                        </div>
                    </div>
                </div>

                <!-- Step 3: Review -->
                <div class="step-content" id="step-3">
                    <h3 class="section-title" style="margin-top: 0;">بررسی و تایید اطلاعات</h3>
                    <p style="color: var(--muted); margin-bottom: 20px;">لطفاً صحت اطلاعات وارد شده را بررسی کنید. پس
                        از تایید، درخواست شما برای ادمین ارسال می‌شود.</p>

                    <div class="section-title">اطلاعات هویتی</div>
                    <table class="review-table">
                        <tr>
                            <td>نام و نام خانوادگی</td>
                            <td id="review-name">-</td>
                        </tr>
                        <tr>
                            <td>کد ملی</td>
                            <td id="review-national-code">-</td>
                        </tr>
                        <tr>
                            <td>شماره موبایل</td>
                            <td id="review-phone">-</td>
                        </tr>
                        <tr>
                            <td>شماره کارت</td>
                            <td id="review-card">-</td>
                        </tr>
                        <tr>
                            <td>سن قانونی</td>
                            <td id="review-adult">-</td>
                        </tr>
                    </table>

                    <div class="section-title">اطلاعات محصول</div>
                    <table class="review-table">
                        <tr>
                            <td>دسته بندی</td>
                            <td>بازی > اکانت</td>
                        </tr>
                        <tr>
                            <td>نوع بازی</td>
                            <td id="review-game-type">-</td>
                        </tr>
                        <tr>
                            <td>فایل پیوست</td>
                            <td><span style="color: var(--success);"><i class="fas fa-check"></i> آپلود شده</span>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Navigation Buttons -->
                <div class="wizard-actions">
                    <button type="button" class="btn btn-prev" id="prevBtn" onclick="changeStep(-1)"
                        style="visibility: hidden;">
                        <i class="fas fa-arrow-right"></i> مرحله قبل
                    </button>
                    <button type="button" class="btn btn-next" id="nextBtn" onclick="changeStep(1)">
                        مرحله بعد <i class="fas fa-arrow-left"></i>
                    </button>
                    <button type="submit" class="btn btn-submit" id="submitBtn" style="display: none;">
                        <i class="fas fa-paper-plane"></i> ارسال درخواست
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let currentStep = 1;
        const totalSteps = 3;

        function changeStep(direction) {
            if (direction === 1 && !validateStep(currentStep)) {
                return;
            }

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

            document.getElementById('prevBtn').style.visibility = currentStep === 1 ? 'hidden' : 'visible';

            if (currentStep === totalSteps) {
                document.getElementById('nextBtn').style.display = 'none';
                document.getElementById('submitBtn').style.display = 'inline-flex';
                populateReviewData();
            } else {
                document.getElementById('nextBtn').style.display = 'inline-flex';
                document.getElementById('submitBtn').style.display = 'none';
            }
        }

        function validateStep(step) {
            const currentStepEl = document.getElementById(`step-${step}`);
            const inputs = currentStepEl.querySelectorAll('input[required], select[required]');
            let isValid = true;

            inputs.forEach(input => {
                if (!input.value) {
                    isValid = false;
                    input.style.borderColor = 'var(--danger)';
                    input.onfocus = function() {
                        this.style.borderColor = 'var(--border)';
                    };
                }
            });

            if (!isValid) {
                alert('لطفاً تمام فیلدهای الزامی را پر کنید.');
            }
            return isValid;
        }

        function updateFileName(input) {
            if (input.files && input.files[0]) {
                document.getElementById('file-name-display').innerText = input.files[0].name;
                document.getElementById('file-name-display').style.color = 'var(--success)';
            }
        }

        // ===== اصلاح شده: استفاده از route helper و هدر CSRF =====
        function loadCustomFields(subSubId) {
            const container = document.getElementById('custom-fields-container');
            const wrapper = document.getElementById('dynamic-fields-wrapper');

            if (!subSubId) {
                container.style.display = 'none';
                return;
            }

            container.style.display = 'block';
            wrapper.innerHTML =
                '<div style="text-align:center; color:var(--muted);"><i class="fas fa-spinner fa-spin"></i> در حال بارگذاری فیلدها...</div>';

            $.ajax({
                url: '{{ route('seller.product.request.getFields') }}', // مسیر صحیح
                type: 'GET',
                data: {
                    sub_subcategory_id: subSubId
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    wrapper.innerHTML = '';
                    if (response.fields && response.fields.length > 0) {
                        response.fields.forEach(field => {
                            let inputHtml = '';
                            if (field.type === 'text') {
                                inputHtml =
                                    `<input type="text" name="attributes[${field.key}]" class="form-input" required>`;
                            } else if (field.type === 'number') {
                                inputHtml =
                                    `<input type="number" name="attributes[${field.key}]" class="form-input" required>`;
                            } else if (field.type === 'select') {
                                inputHtml =
                                    `<select name="attributes[${field.key}]" class="form-select" required><option value="">انتخاب کنید</option>`;
                                const options = field.options ? field.options.split(',') : [];
                                options.forEach(opt => {
                                    inputHtml +=
                                        `<option value="${opt.trim()}">${opt.trim()}</option>`;
                                });
                                inputHtml += `</select>`;
                            }

                            wrapper.innerHTML += `
                                <div class="form-group">
                                    <label class="form-label">${field.label}</label>
                                    ${inputHtml}
                                </div>
                            `;
                        });
                    } else {
                        wrapper.innerHTML =
                            '<p style="color:var(--muted);">فیلد اختصاصی برای این بازی یافت نشد.</p>';
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    wrapper.innerHTML = '<p style="color:var(--danger);">خطا در دریافت اطلاعات.</p>';
                }
            });
        }

        function populateReviewData() {
            const formData = new FormData(document.getElementById('wizardForm'));

            document.getElementById('review-name').innerText = `${formData.get('first_name')} ${formData.get('last_name')}`;
            document.getElementById('review-national-code').innerText = formData.get('national_code');
            document.getElementById('review-phone').innerText = formData.get('phone');
            document.getElementById('review-card').innerText = formData.get('card_number');
            document.getElementById('review-adult').innerText = formData.get('is_adult') === 'yes' ? 'بله' : 'خیر';

            const gameSelect = document.getElementById('game_type_select');
            document.getElementById('review-game-type').innerText = gameSelect.options[gameSelect.selectedIndex].text;
        }
    </script>
</body>

</html>

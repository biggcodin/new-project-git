<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>جزئیات درخواست فروشندگی</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
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

        .detail-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 30px;
            margin-bottom: 25px;
            position: relative;
        }

        .detail-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, var(--accent), var(--accent-2));
            opacity: 0.7;
            border-radius: 14px 0 0 14px;
        }

        .detail-row {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid var(--border);
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            width: 40%;
            color: var(--muted);
            font-weight: 500;
        }

        .detail-value {
            width: 60%;
            color: var(--text);
            font-weight: 600;
        }

        .detail-value img {
            max-width: 150px;
            border-radius: 10px;
            border: 1px solid var(--border);
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .detail-value img:hover {
            transform: scale(1.05);
        }

        .badge-custom {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 14px;
            font-weight: 600;
        }

        .badge-pending {
            background: rgba(245, 158, 11, 0.12);
            color: #fef3c7;
            border: 1px solid rgba(245, 158, 11, 0.35);
        }

        .badge-approved {
            background: rgba(16, 185, 129, 0.12);
            color: #d1fae5;
            border: 1px solid rgba(16, 185, 129, 0.35);
        }

        .badge-rejected {
            background: rgba(239, 68, 68, 0.12);
            color: #fee2e2;
            border: 1px solid rgba(239, 68, 68, 0.35);
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
            text-decoration: none;
        }

        .btn-success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            box-shadow: 0 4px 15px -3px rgba(16, 185, 129, 0.4);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px -3px rgba(16, 185, 129, 0.6);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            box-shadow: 0 4px 15px -3px rgba(239, 68, 68, 0.4);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px -3px rgba(239, 68, 68, 0.6);
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

        .form-control {
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

        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(34, 211, 238, 0.15);
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

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #f87171;
            border-color: rgba(239, 68, 68, 0.3);
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        /* ===== مودال برای نمایش تصویر ===== */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.85);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            padding: 20px;
            cursor: pointer;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-content {
            max-width: 90%;
            max-height: 90%;
            background: transparent;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.8);
        }

        .modal-content img {
            width: auto;
            height: auto;
            max-width: 100%;
            max-height: 90vh;
            border-radius: 10px;
            border: 2px solid var(--border);
        }

        .modal-close {
            position: absolute;
            top: 20px;
            right: 30px;
            color: white;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            z-index: 10000;
            background: rgba(0, 0, 0, 0.5);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
        }

        .modal-close:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: rotate(90deg);
        }

        @media (max-width: 768px) {
            .detail-row {
                flex-direction: column;
                gap: 5px;
            }

            .detail-label {
                width: 100%;
            }

            .detail-value {
                width: 100%;
            }

            .action-buttons {
                flex-direction: column;
            }

            .action-buttons .btn {
                width: 100%;
                justify-content: center;
            }

            .modal-close {
                top: 10px;
                right: 20px;
                font-size: 30px;
                width: 40px;
                height: 40px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="page-header">
            <h2>جزئیات درخواست فروشندگی</h2>
            <a href="{{ route('admin.seller.applications.index') }}" class="btn-back">
                <i class="fas fa-arrow-right"></i> بازگشت به لیست
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        <div class="detail-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h4 style="margin: 0; color: var(--text);">اطلاعات درخواست</h4>
                <span class="badge-custom badge-{{ $application->status }}">
                    {{ $application->getStatusText() }}
                </span>
            </div>

            <div class="detail-row">
                <div class="detail-label">نام و نام خانوادگی</div>
                <div class="detail-value">{{ $application->first_name }} {{ $application->last_name }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">کد ملی</div>
                <div class="detail-value">{{ $application->national_code }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">شماره موبایل</div>
                <div class="detail-value">{{ $application->phone }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">تاریخ تولد</div>
                <div class="detail-value">{{ $application->birth_date }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">شماره کارت بانکی</div>
                <div class="detail-value">{{ $application->bank_card_number }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">بالای ۱۸ سال</div>
                <div class="detail-value">{{ $application->is_over_18 ? 'بله' : 'خیر' }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">نوع بازی</div>
                <div class="detail-value">{{ $application->subSubcategory->name ?? 'نامشخص' }}</div>
            </div>

            @if (!empty($application->custom_fields_data))
                <div class="detail-row" style="flex-direction: column; align-items: stretch; gap: 5px;">
                    <div class="detail-label" style="width: 100%;">فیلدهای اختصاصی</div>
                    <div class="detail-value" style="width: 100%;">
                        <ul style="margin: 0; padding-right: 20px;">
                            @foreach ($application->custom_fields_data as $key => $value)
                                <li><strong>{{ $key }}</strong>: {{ $value }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="detail-row">
                <div class="detail-label">تصویر کارت ملی/شناسنامه</div>
                <div class="detail-value">
                    @if ($application->national_card_image)
                        <img src="{{ asset('storage/' . $application->national_card_image) }}" alt="کارت ملی"
                            onclick="openModal(this.src)"
                            style="cursor: pointer; max-width: 150px; border-radius: 10px; border: 1px solid var(--border); transition: transform 0.2s;">
                        <br>
                        <small style="color: var(--muted);">(برای بزرگ‌نمایی کلیک کنید)</small>
                    @else
                        <span style="color: var(--muted);">تصویری آپلود نشده است.</span>
                    @endif
                </div>
            </div>

            @if ($application->admin_message)
                <div class="detail-row">
                    <div class="detail-label">پیام ادمین</div>
                    <div class="detail-value">{{ $application->admin_message }}</div>
                </div>
            @endif

            <div class="detail-row">
                <div class="detail-label">تاریخ ثبت</div>
                <div class="detail-value">{{ $application->created_at->format('Y/m/d H:i') }}</div>
            </div>
            @if ($application->reviewed_at)
                <div class="detail-row">
                    <div class="detail-label">تاریخ بررسی</div>
                    <div class="detail-value">{{ $application->reviewed_at->format('Y/m/d H:i') }}</div>
                </div>
            @endif
        </div>

        @if ($application->status == 'pending')
            <div class="detail-card">
                <h4 style="margin-top: 0; color: var(--text);">اقدامات ادمین</h4>
                <form action="{{ route('admin.seller.applications.approve', $application) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">پیام تأیید (اختیاری)</label>
                        <input type="text" name="admin_message" class="form-control"
                            placeholder="پیام شما به کاربر ...">
                    </div>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check"></i> تأیید درخواست
                    </button>
                </form>

                <hr style="border-color: var(--border); margin: 25px 0;">

                <form action="{{ route('admin.seller.applications.reject', $application) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">دلیل رد <span style="color: var(--danger);">*</span></label>
                        <input type="text" name="admin_message" class="form-control"
                            placeholder="دلیل رد را وارد کنید..." required>
                    </div>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-times"></i> رد درخواست
                    </button>
                </form>
            </div>
        @endif

        <div class="action-buttons">
            <a href="{{ route('admin.seller.applications.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-right"></i> بازگشت به لیست
            </a>
        </div>
    </div>

    <!-- ===== مودال برای نمایش تصویر ===== -->
    <div class="modal-overlay" id="imageModal" onclick="closeModal()">
        <div class="modal-content" onclick="event.stopPropagation();">
            <img id="modalImage" src="" alt="تصویر کارت ملی">
        </div>
        <span class="modal-close" onclick="closeModal()">&times;</span>
    </div>

    <script>
        function openModal(src) {
            const modal = document.getElementById('imageModal');
            const img = document.getElementById('modalImage');
            img.src = src;
            modal.classList.add('active');
            document.body.style.overflow = 'hidden'; // جلوگیری از اسکرول
        }

        function closeModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }

        // بستن مودال با کلید Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>

</html>

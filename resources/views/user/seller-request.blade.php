<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>درخواست فروشندگی</title>
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
            max-width: 800px;
            margin: 0 auto;
            padding: 60px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Card Style */
        .request-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            width: 100%;
            overflow: hidden;
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.5);
            position: relative;
        }

        .request-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, var(--accent), var(--accent-2));
            opacity: 0.7;
        }

        .card-header {
            padding: 25px 30px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.03), rgba(255, 255, 255, 0.0));
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .card-header-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: rgba(167, 139, 250, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: var(--accent-2);
        }

        .card-header h3 {
            margin: 0;
            font-size: 20px;
            font-weight: 700;
            color: var(--text);
        }

        .card-body {
            padding: 30px;
        }

        /* Alert */
        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid;
            display: flex;
            align-items: center;
            gap: 10px;
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

        /* Description Text */
        .description-text {
            color: var(--muted);
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 30px;
            background: rgba(255, 255, 255, 0.02);
            padding: 20px;
            border-radius: 10px;
            border: 1px dashed var(--border);
        }

        /* Button */
        .btn-submit {
            width: 100%;
            padding: 15px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            font-family: inherit;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--accent-2), #8b5cf6);
            color: white;
            box-shadow: 0 4px 15px -3px rgba(167, 139, 250, 0.4);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px -3px rgba(167, 139, 250, 0.6);
        }

        .btn-submit i {
            font-size: 18px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .card-header {
                padding: 20px;
            }

            .card-body {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="request-card">
            <div class="card-header">
                <div class="card-header-icon">
                    <i class="fas fa-store"></i>
                </div>
                <h3>درخواست فروشندگی</h3>
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ session('error') }}
                    </div>
                @endif

                <div class="description-text">
                    <i class="fas fa-info-circle" style="color: var(--accent); margin-left: 8px;"></i>
                    برای تبدیل شدن به فروشنده و ثبت محصول، درخواست خود را ثبت کنید. پس از تایید ادمین، نقش شما به
                    فروشنده تغییر می‌کند و دسترسی‌های لازم برای پنل فروشندگان فعال خواهد شد.
                </div>

                <form method="POST" action="{{ route('seller.request.store') }}">
                    @csrf
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-paper-plane"></i>
                        ثبت درخواست
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>شبیه‌سازی درگاه پرداخت</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            --danger: #ef4444;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            background: linear-gradient(135deg, #0b1220 0%, #0f172a 100%);
            color: var(--text);
            font-family: 'Vazirmatn', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .container { max-width: 500px; width: 100%; padding: 20px; }
        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 30px;
            text-align: center;
        }
        .card h3 { margin: 0 0 20px 0; font-size: 22px; }
        .card .price { font-size: 28px; font-weight: 700; color: var(--accent); }
        .btn-group {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 25px;
        }
        .btn {
            padding: 12px 20px;
            border-radius: 10px;
            border: none;
            font-family: inherit;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }
        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }
        .btn-success:hover { transform: translateY(-2px); box-shadow: 0 4px 15px -3px rgba(16,185,129,0.4); }
        .btn-danger:hover { transform: translateY(-2px); box-shadow: 0 4px 15px -3px rgba(239,68,68,0.4); }
        .order-info { color: var(--muted); font-size: 14px; margin: 15px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h3>شبیه‌سازی درگاه پرداخت</h3>
            <p class="order-info">شماره سفارش: <strong>{{ $order->order_number }}</strong></p>
            <p class="order-info">مبلغ: <span class="price">{{ number_format($order->total_amount) }} تومان</span></p>
            <p style="color: var(--muted); margin: 20px 0;">برای شبیه‌سازی، یکی از گزینه‌های زیر را انتخاب کنید:</p>
            <div class="btn-group">
                <a href="{{ route('gateway.callback', ['order_id' => $order->id, 'status' => 'success']) }}" class="btn btn-success">
                    <i class="fas fa-check-circle"></i> پرداخت موفق
                </a>
                <a href="{{ route('gateway.callback', ['order_id' => $order->id, 'status' => 'failed']) }}" class="btn btn-danger">
                    <i class="fas fa-times-circle"></i> پرداخت ناموفق
                </a>
            </div>
        </div>
    </div>
</body>
</html>
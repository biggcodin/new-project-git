<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>شارژ کیف پول</title>
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
            max-width: 600px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        /* Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
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
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            color: var(--muted);
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border);
            transition: all 0.2s ease;
            font-size: 13px;
        }

        .btn-back:hover {
            color: var(--text);
            border-color: var(--accent-2);
            background: rgba(167, 139, 250, 0.1);
        }

        /* Current Balance Card */
        .balance-card {
            background: linear-gradient(135deg, rgba(34, 211, 238, 0.1), rgba(167, 139, 250, 0.1));
            border: 1px solid rgba(34, 211, 238, 0.3);
            border-radius: 14px;
            padding: 25px;
            text-align: center;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }

        .balance-label {
            color: var(--muted);
            font-size: 14px;
            margin-bottom: 10px;
        }

        .balance-amount {
            font-size: 32px;
            font-weight: 700;
            color: var(--text);
            letter-spacing: -0.02em;
        }

        .balance-currency {
            font-size: 16px;
            color: var(--accent);
            margin-right: 5px;
        }

        /* Form Card */
        .charge-form-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            color: var(--muted);
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .form-input {
            width: 100%;
            background: #0b1220;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 12px 15px;
            color: var(--text);
            font-family: inherit;
            font-size: 16px;
            outline: none;
            transition: all 0.2s ease;
        }

        .form-input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(34, 211, 238, 0.15);
        }

        .input-suffix {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: 13px;
            pointer-events: none;
        }

        /* Quick Amount Buttons */
        .quick-amounts {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-top: 15px;
        }

        .amount-btn {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 10px;
            color: var(--text);
            font-family: inherit;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .amount-btn:hover {
            background: rgba(167, 139, 250, 0.1);
            border-color: var(--accent-2);
            color: var(--accent-2);
        }

        .amount-btn.active {
            background: rgba(167, 139, 250, 0.2);
            border-color: var(--accent-2);
            color: var(--accent-2);
        }

        /* Submit Button */
        .btn-submit {
            width: 100%;
            padding: 14px;
            border-radius: 10px;
            border: none;
            background: linear-gradient(135deg, var(--accent-2), #8b5cf6);
            color: white;
            font-family: inherit;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 4px 15px -3px rgba(167, 139, 250, 0.4);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px -3px rgba(167, 139, 250, 0.6);
        }

        /* Info Text */
        .info-text {
            margin-top: 20px;
            padding: 15px;
            background: rgba(34, 211, 238, 0.05);
            border-radius: 8px;
            border: 1px solid rgba(34, 211, 238, 0.1);
            color: var(--muted);
            font-size: 12px;
            display: flex;
            align-items: start;
            gap: 10px;
        }

        .info-text i {
            color: var(--accent);
            margin-top: 2px;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .quick-amounts {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="page-header">
            <h2>شارژ کیف پول</h2>
            <a href="{{ route('user.panel') }}" class="btn-back">
                <i class="fas fa-arrow-right"></i>
                بازگشت
            </a>
        </div>

        <!-- Current Balance -->
        <div class="balance-card">
            <div class="balance-label">موجودی فعلی شما</div>
            <div class="balance-amount">
                {{ number_format(Auth::user()->balance ?? 0) }}
                <span class="balance-currency">تومان</span>
            </div>
        </div>

        <!-- Charge Form -->
        <div class="charge-form-card">
            <form action="{{ route('wallet.charge.submit') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="form-label">مبلغ شارژ را وارد کنید</label>
                    <div class="input-wrapper">
                        <input type="number" name="amount" id="amountInput" class="form-input"
                            placeholder="مثلا 100000" min="10000" required>
                        <span class="input-suffix">تومان</span>
                    </div>

                    <!-- Quick Amounts -->
                    <div class="quick-amounts">
                        <button type="button" class="amount-btn" onclick="setAmount(50000)">۵۰,۰۰۰</button>
                        <button type="button" class="amount-btn" onclick="setAmount(100000)">۱۰۰,۰۰۰</button>
                        <button type="button" class="amount-btn" onclick="setAmount(200000)">۲۰۰,۰۰۰</button>
                        <button type="button" class="amount-btn" onclick="setAmount(500000)">۵۰۰,۰۰۰</button>
                        <button type="button" class="amount-btn" onclick="setAmount(1000000)">۱,۰۰۰,۰۰۰</button>
                        <button type="button" class="amount-btn" onclick="setAmount(2000000)">۲,۰۰۰,۰۰۰</button>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fas fa-credit-card"></i>
                    پرداخت و شارژ حساب
                </button>

                <div class="info-text">
                    <i class="fas fa-info-circle"></i>
                    <span>حداقل مبلغ شارژ ۱۰,۰۰۰ تومان می‌باشد. پس از کلیک روی دکمه پرداخت، به درگاه بانکی منتقل خواهید
                        شد.</span>
                </div>
            </form>
        </div>
    </div>

    <script>
        function setAmount(amount) {
            const input = document.getElementById('amountInput');
            input.value = amount;

            // Highlight active button
            document.querySelectorAll('.amount-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
        }

        // Remove active class when typing manually
        document.getElementById('amountInput').addEventListener('input', function() {
            document.querySelectorAll('.amount-btn').forEach(btn => {
                btn.classList.remove('active');
            });
        });
    </script>
</body>

</html>

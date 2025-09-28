<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت VGStore</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #1b1b2f;
            color: #eee;
            font-family: 'Vazirmatn', sans-serif;
        }

        .table {
            background-color: #2a2a40;
            color: #fff;
        }

        .table th {
            background-color: #3a3a5c;
        }

        .modal-content {
            background-color: #2a2a40;
            color: #fff;
        }

        .btn-success,
        .btn-primary {
            background-color: #6c5ce7;
            border-color: #6c5ce7;
        }

        .btn-success:hover,
        .btn-primary:hover {
            background-color: #5a4dd1;
        }

        .form-control {
            background-color: #1f1f38;
            color: #fff;
            border: 1px solid #444;
        }

        .form-control::placeholder {
            color: #bbb;
        }

        .toast-container {
            position: fixed;
            bottom: 20px;
            left: 20px;
            z-index: 9999;
        }

        .toast {
            background-color: #222;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="py-3">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Toast -->
    @if (session('success'))
        <div class="toast-container">
            <div class="toast show" role="alert">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif
</body>

</html>

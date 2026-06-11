<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت محصولات</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        /* ==== CSS شما، بدون هیچ تغییری ==== */
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

        .container-fluid {
            max-width: 1600px;
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
            letter-spacing: -0.02em;
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

        .btn-custom {
            padding: 10px 20px;
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

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--accent-2), #8b5cf6);
            color: white;
            box-shadow: 0 4px 15px -3px rgba(167, 139, 250, 0.4);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px -3px rgba(167, 139, 250, 0.6);
        }

        .btn-success-custom {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .btn-success-custom:hover {
            background: rgba(16, 185, 129, 0.25);
            transform: translateY(-2px);
        }

        .btn-warning-custom {
            background: rgba(245, 158, 11, 0.15);
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .btn-warning-custom:hover {
            background: rgba(245, 158, 11, 0.25);
            transform: translateY(-2px);
        }

        .btn-danger-custom {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .btn-danger-custom:hover {
            background: rgba(239, 68, 68, 0.25);
            transform: translateY(-2px);
        }

        .btn-info-custom {
            background: rgba(34, 211, 238, 0.15);
            color: var(--accent);
            border: 1px solid rgba(34, 211, 238, 0.3);
        }

        .btn-info-custom:hover {
            background: rgba(34, 211, 238, 0.25);
            transform: translateY(-2px);
        }

        .btn-secondary-custom {
            background: linear-gradient(180deg, #101827, #0b1220);
            color: var(--text);
            border: 1px solid var(--border);
        }

        .btn-secondary-custom:hover {
            transform: translateY(-2px);
            border-color: var(--muted);
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }

        .filter-card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .filter-form {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr auto;
            gap: 15px;
            align-items: end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .filter-label {
            color: var(--muted);
            font-size: 12px;
            font-weight: 500;
        }

        .filter-input,
        .filter-select {
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

        .filter-input:focus,
        .filter-select:focus {
            border-color: rgba(34, 211, 238, 0.6);
            box-shadow: 0 0 0 3px rgba(34, 211, 238, 0.15);
        }

        .filter-buttons {
            display: flex;
            gap: 10px;
        }

        .table-wrapper {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            min-width: 1400px;
        }

        thead th {
            background: linear-gradient(180deg, #0e1626, #0d1524);
            color: var(--muted);
            font-weight: 600;
            font-size: 13px;
            text-align: center;
            padding: 15px;
            border-bottom: 1px solid var(--border);
            white-space: nowrap;
        }

        tbody td {
            padding: 15px;
            border-bottom: 1px solid var(--border);
            color: var(--text);
            vertical-align: middle;
            text-align: center;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:hover {
            background: rgba(167, 139, 250, 0.05);
        }

        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid var(--border);
        }

        .no-image {
            color: var(--muted);
            font-size: 12px;
        }

        .product-name {
            font-weight: 600;
            color: var(--text);
            margin-bottom: 5px;
        }

        .badge-custom {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 500;
            margin: 2px;
        }

        .badge-featured {
            background: rgba(245, 158, 11, 0.15);
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .badge-success {
            background: rgba(16, 185, 129, 0.15);
            color: #34d399;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .badge-warning {
            background: rgba(245, 158, 11, 0.15);
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .badge-danger {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .badge-info {
            background: rgba(34, 211, 238, 0.15);
            color: var(--accent);
            border: 1px solid rgba(34, 211, 238, 0.3);
        }

        .badge-secondary {
            background: rgba(148, 163, 184, 0.15);
            color: var(--muted);
            border: 1px solid rgba(148, 163, 184, 0.3);
        }

        .category-info {
            font-size: 12px;
            color: var(--text);
        }

        .subcategory-info {
            font-size: 11px;
            color: var(--muted);
            margin-top: 3px;
        }

        .price-main {
            font-weight: 600;
            color: var(--text);
        }

        .price-discount {
            font-size: 11px;
            color: var(--success);
            margin-top: 3px;
        }

        .attribute-item {
            font-size: 11px;
            margin-bottom: 3px;
        }

        .attribute-key {
            color: var(--accent);
            font-weight: 500;
        }

        .more-attributes {
            font-size: 10px;
            color: var(--muted);
        }

        .date-main {
            font-size: 12px;
            color: var(--text);
        }

        .date-time {
            font-size: 11px;
            color: var(--muted);
            direction: ltr;
            text-align: center;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
            justify-content: center;
        }

        .dropdown-menu {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 5px;
        }

        .dropdown-item {
            color: var(--text);
            padding: 8px 12px;
            border-radius: 6px;
            transition: background 0.2s ease;
            font-size: 13px;
        }

        .dropdown-item:hover {
            background: rgba(167, 139, 250, 0.1);
        }

        .dropdown-item.text-danger {
            color: #f87171 !important;
        }

        .dropdown-divider {
            border-color: var(--border);
            margin: 5px 0;
        }

        .empty-state {
            padding: 40px;
            text-align: center;
            color: var(--muted);
        }

        .pagination-wrapper {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .pagination-wrapper nav {
            width: 100%;
        }

        .pagination-wrapper nav>div:first-child {
            display: flex !important;
            width: 100%;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 15px;
        }

        .pagination-wrapper nav>div:first-child>span,
        .pagination-wrapper nav>div:first-child>a {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 10px 18px !important;
            border-radius: 10px !important;
            border: 1px solid var(--border) !important;
            background: #0b1220 !important;
            color: var(--text) !important;
            text-decoration: none !important;
            transition: all 0.2s ease !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            line-height: 1 !important;
            flex: 1;
            box-shadow: none !important;
        }

        .pagination-wrapper nav>div:first-child>a:hover {
            background: rgba(167, 139, 250, 0.1) !important;
            border-color: var(--accent-2) !important;
            transform: translateY(-1px);
        }

        .pagination-wrapper nav>div:first-child>span {
            opacity: 0.5 !important;
            cursor: not-allowed !important;
        }

        .pagination-wrapper nav>div:last-child>div:first-child p {
            color: var(--muted) !important;
            font-size: 13px !important;
            margin: 0 !important;
            line-height: 1.5 !important;
        }

        .pagination-wrapper nav>div:last-child>div:first-child .font-medium {
            color: var(--text) !important;
            font-weight: 600 !important;
        }

        .pagination-wrapper nav .z-0,
        .pagination-wrapper nav [class*="z-0"] {
            display: inline-flex !important;
            gap: 5px !important;
            border-radius: 8px !important;
            box-shadow: none !important;
            flex-wrap: wrap;
        }

        .pagination-wrapper nav .z-0>span,
        .pagination-wrapper nav [class*="z-0"]>span {
            display: inline-flex !important;
        }

        .pagination-wrapper nav .z-0 a,
        .pagination-wrapper nav .z-0 span[aria-disabled="true"]>span,
        .pagination-wrapper nav .z-0 span[aria-current="page"]>span,
        .pagination-wrapper nav [class*="z-0"] a,
        .pagination-wrapper nav [class*="z-0"] span[aria-disabled="true"]>span,
        .pagination-wrapper nav [class*="z-0"] span[aria-current="page"]>span {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 8px 14px !important;
            min-width: 38px !important;
            height: 38px !important;
            border-radius: 8px !important;
            border: 1px solid var(--border) !important;
            background: #0b1220 !important;
            color: var(--text) !important;
            text-decoration: none !important;
            transition: all 0.2s ease !important;
            font-size: 14px !important;
            font-weight: 500 !important;
            line-height: 1 !important;
            margin: 0 !important;
            box-shadow: none !important;
            cursor: pointer;
        }

        .pagination-wrapper nav .z-0 a:hover,
        .pagination-wrapper nav [class*="z-0"] a:hover {
            background: rgba(167, 139, 250, 0.15) !important;
            border-color: var(--accent-2) !important;
            color: var(--text) !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px -4px rgba(167, 139, 250, 0.4) !important;
        }

        .pagination-wrapper nav .z-0 span[aria-disabled="true"]>span,
        .pagination-wrapper nav [class*="z-0"] span[aria-disabled="true"]>span {
            opacity: 0.4 !important;
            cursor: not-allowed !important;
            background: #0b1220 !important;
            color: var(--muted) !important;
            transform: none !important;
            box-shadow: none !important;
        }

        .pagination-wrapper nav .z-0 span[aria-current="page"]>span,
        .pagination-wrapper nav [class*="z-0"] span[aria-current="page"]>span {
            background: linear-gradient(135deg, var(--accent-2), #8b5cf6) !important;
            border-color: var(--accent-2) !important;
            color: white !important;
            cursor: default !important;
            font-weight: 700 !important;
            box-shadow: 0 4px 15px -3px rgba(167, 139, 250, 0.5) !important;
            transform: none !important;
        }

        .pagination-wrapper nav .z-0 svg,
        .pagination-wrapper nav [class*="z-0"] svg {
            width: 16px !important;
            height: 16px !important;
            fill: currentColor !important;
            margin: 0 !important;
        }

        .pagination-wrapper nav .-ml-px,
        .pagination-wrapper nav [class*="-ml-px"] {
            margin-left: 0 !important;
        }

        .pagination-wrapper nav .shadow-sm,
        .pagination-wrapper nav [class*="shadow-sm"] {
            box-shadow: none !important;
        }

        .pagination-wrapper nav .rounded-md,
        .pagination-wrapper nav [class*="rounded-md"] {
            border-radius: 8px !important;
        }

        .pagination-wrapper nav .rounded-l-md,
        .pagination-wrapper nav [class*="rounded-l-md"] {
            border-radius: 8px 0 0 8px !important;
        }

        .pagination-wrapper nav .rounded-r-md,
        .pagination-wrapper nav [class*="rounded-r-md"] {
            border-radius: 0 8px 8px 0 !important;
        }

        .pagination-wrapper nav .text-gray-500,
        .pagination-wrapper nav [class*="text-gray-500"] {
            color: var(--muted) !important;
        }

        .pagination-wrapper nav .text-gray-700,
        .pagination-wrapper nav [class*="text-gray-700"] {
            color: var(--text) !important;
        }

        .pagination-wrapper nav .bg-white,
        .pagination-wrapper nav [class*="bg-white"] {
            background: #0b1220 !important;
        }

        .pagination-wrapper nav .border-gray-300,
        .pagination-wrapper nav [class*="border-gray-300"] {
            border-color: var(--border) !important;
        }

        .pagination-wrapper nav .bg-indigo-600,
        .pagination-wrapper nav [class*="bg-indigo"] {
            background: linear-gradient(135deg, var(--accent-2), #8b5cf6) !important;
        }

        .pagination-wrapper nav .border-indigo-600,
        .pagination-wrapper nav [class*="border-indigo"] {
            border-color: var(--accent-2) !important;
        }

        .pagination-wrapper nav .text-white,
        .pagination-wrapper nav [class*="text-white"] {
            color: white !important;
        }

        @media (max-width: 640px) {
            .pagination-wrapper nav>div:last-child {
                display: none !important;
            }

            .pagination-wrapper nav>div:first-child {
                display: flex !important;
            }
        }

        @media (min-width: 641px) {
            .pagination-wrapper nav>div:first-child {
                display: none !important;
            }

            .pagination-wrapper nav>div:last-child {
                display: flex !important;
                align-items: center !important;
                justify-content: space-between !important;
                width: 100%;
                gap: 20px;
            }
        }

        @media (max-width: 1200px) {
            .filter-form {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .filter-form {
                grid-template-columns: 1fr;
            }

            .filter-buttons {
                flex-direction: column;
            }

            .action-buttons {
                flex-direction: column;
            }
        }

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
    @php use Illuminate\Support\Str; @endphp

    <div class="container-fluid">
        <div class="page-header">
            <h2>مدیریت محصولات</h2>
            <a href="{{ route('admin.products.create') }}" class="btn-custom btn-primary-custom">
                <i class="fas fa-plus"></i>
                افزودن محصول جدید
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- فرم فیلتر و جستجو (اصلاح شده - بدون بخش تکراری) -->
        <div class="filter-card">
            <form method="GET" action="{{ route('admin.products.index') }}" class="filter-form">
                <div class="filter-group">
                    <label class="filter-label">جستجو</label>
                    <input type="text" name="search" class="filter-input" placeholder="جستجو در نام، SKU"
                        value="{{ request('search') }}">
                </div>
                <div class="filter-group">
                    <label class="filter-label">دسته اصلی</label>
                    <select name="category" id="categorySelect" class="filter-select">
                        <option value="">همه دسته‌ها</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">زیردسته اول</label>
                    <select name="subcategory" id="subcategorySelect" class="filter-select">
                        <option value="">همه زیردسته‌ها</option>
                        @foreach ($subcategories as $sub)
                            <option value="{{ $sub->id }}" data-category="{{ $sub->category_id }}"
                                {{ request('subcategory') == $sub->id ? 'selected' : '' }}>
                                {{ $sub->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">زیردسته دوم</label>
                    <select name="sub_subcategory" id="subSubcategorySelect" class="filter-select">
                        <option value="">همه زیردسته دوم</option>
                        @foreach ($subSubcategories as $subSub)
                            <option value="{{ $subSub->id }}" data-subcategory="{{ $subSub->subcategory_id }}"
                                {{ request('sub_subcategory') == $subSub->id ? 'selected' : '' }}>
                                {{ $subSub->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">تعداد نمایش</label>
                    <select name="per" class="filter-select">
                        <option value="10" {{ request('per') == 10 ? 'selected' : '' }}>10 آیتم</option>
                        <option value="25" {{ request('per') == 25 ? 'selected' : '' }}>25 آیتم</option>
                        <option value="50" {{ request('per') == 50 ? 'selected' : '' }}>50 آیتم</option>
                    </select>
                </div>
                <div class="filter-buttons">
                    <button type="submit" class="btn-custom btn-primary-custom"><i class="fas fa-search"></i> جستجو</button>
                    <a href="{{ route('admin.products.index') }}" class="btn-custom btn-secondary-custom"><i class="fas fa-times"></i> پاک کردن</a>
                </div>
            </form>
        </div>

        <!-- جدول محصولات (اصلاح شده - حذف ستون ویژگی تکراری) -->
        <div class="table-wrapper">
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>شناسه</th>
                            <th>تصویر</th>
                            <th>نام محصول</th>
                            <th>SKU</th>
                            <th>دسته‌بندی</th>
                            <th>قیمت</th>
                            <th>تخفیف</th>
                            <th>موجودی</th>
                            <th>وضعیت</th>
                            <th>ویژگی</th>
                            <th>تگ‌ها</th>
                            <th>تاریخ ایجاد</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    @if ($product->cover)
                                        <img src="{{ asset('storage/' . $product->cover) }}" alt="{{ $product->name }}"
                                            class="product-image"
                                            onclick="showImageModal('{{ asset('storage/' . $product->cover) }}')"
                                            style="cursor: pointer;">
                                    @elseif($product->media->isNotEmpty())
                                        <img src="{{ asset('storage/' . $product->media->first()->file_path) }}"
                                            alt="{{ $product->name }}" class="product-image"
                                            onclick="showImageModal('{{ asset('storage/' . $product->media->first()->file_path) }}')"
                                            style="cursor: pointer;">
                                    @else
                                        <span class="no-image">بدون تصویر</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="product-name">{{ $product->name }}</div>
                                    @if ($product->featured)
                                        <span class="badge-custom badge-featured">
                                            <i class="fas fa-star"></i> ویژه
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $product->sku ?? '-' }}</td>
                                <td>
                                    <div class="category-info">{{ $product->category->name ?? '-' }}</div>
                                    @if ($product->subcategory || $product->subSubcategory)
                                        <div class="subcategory-info">
                                            {{ $product->subcategory->name ?? '' }}
                                            @if ($product->subSubcategory)
                                                > {{ $product->subSubcategory->name }}
                                            @endif
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="price-main">{{ number_format($product->price) }} تومان</div>
                                    @if ($product->discount_price)
                                        <div class="price-discount">
                                            {{ number_format($product->final_price) }} تومان
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if ($product->discount_price)
                                        <span class="badge-custom badge-success">
                                            {{ $product->discount_percentage }}%
                                        </span>
                                    @else
                                        <span class="no-image">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($product->is_in_stock)
                                        <span class="badge-custom badge-success">موجود</span>
                                    @else
                                        <span class="badge-custom badge-danger">ناموجود</span>
                                    @endif
                                    <div class="subcategory-info">{{ $product->quantity }} عدد</div>
                                </td>
                                <td>
                                    @if ($product->status === 'approved')
                                        <span class="badge-custom badge-success">{{ $product->status_text }}</span>
                                    @elseif($product->status === 'pending')
                                        <span class="badge-custom badge-warning">{{ $product->status_text }}</span>
                                    @else
                                        <span class="badge-custom badge-danger">{{ $product->status_text }}</span>
                                    @endif
                                </td>
                                <!-- ستون ویژگی (یک بار) -->
                                <td>
                                    @if ($product->attributes->isNotEmpty())
                                        <div>
                                            @foreach ($product->attributes->take(2) as $attr)
                                                <div class="attribute-item">
                                                    <span class="attribute-key">{{ $attr->key }}:</span>
                                                    {{ is_array($attr->value) ? implode(', ', $attr->value) : $attr->value }}
                                                </div>
                                            @endforeach
                                            @if ($product->attributes->count() > 2)
                                                <div class="more-attributes">+{{ $product->attributes->count() - 2 }} بیشتر</div>
                                            @endif
                                        </div>
                                    @else
                                        <span class="no-image">-</span>
                                    @endif
                                </td>
                                <!-- ستون تگ‌ها -->
                                <td>
                                    @if ($product->tags->isNotEmpty())
                                        <div>
                                            @foreach ($product->tags->take(3) as $tag)
                                                <span class="badge-custom badge-secondary"
                                                    style="background-color: {{ $tag->color }} !important; border-color: {{ $tag->color }}40 !important;">
                                                    {{ $tag->name }}
                                                </span>
                                            @endforeach
                                            @if ($product->tags->count() > 3)
                                                <div class="more-attributes">+{{ $product->tags->count() - 3 }} بیشتر</div>
                                            @endif
                                        </div>
                                    @else
                                        <span class="no-image">-</span>
                                    @endif
                                </td>
                                <!-- تاریخ ایجاد -->
                                <td>
                                    <div class="date-main">{{ $product->created_at->format('Y/m/d') }}</div>
                                    <div class="date-time">{{ $product->created_at->format('H:i') }}</div>
                                </td>
                                <!-- عملیات -->
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.products.edit', $product) }}"
                                            class="btn-custom btn-warning-custom btn-sm">
                                            <i class="fas fa-edit"></i> ویرایش
                                        </a>
                                        <div class="dropdown">
                                            <button type="button"
                                                class="btn-custom btn-info-custom btn-sm dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="#"
                                                        onclick="toggleFeatured({{ $product->id }}); return false;">
                                                        <i class="fas fa-star"></i>
                                                        {{ $product->featured ? 'حذف از ویژه' : 'افزودن به ویژه' }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#"
                                                        onclick="incrementViews({{ $product->id }}); return false;">
                                                        <i class="fas fa-eye"></i> افزایش بازدید
                                                    </a>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <form action="{{ route('admin.products.destroy', $product) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('آیا از حذف این محصول مطمئن هستید؟');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="fas fa-trash"></i> حذف
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13" class="empty-state">
                                    <i class="fas fa-box-open" style="font-size: 48px; margin-bottom: 15px; opacity: 0.3;"></i>
                                    <div>هیچ محصولی یافت نشد.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- صفحه‌بندی -->
        @if ($products->hasPages())
            <div class="pagination-wrapper">
                {{ $products->appends(request()->query())->links() }}
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('categorySelect');
            const subcategorySelect = document.getElementById('subcategorySelect');
            const subSubcategorySelect = document.getElementById('subSubcategorySelect');

            if (categorySelect) {
                categorySelect.addEventListener('change', function() {
                    const categoryId = this.value;
                    subcategorySelect.innerHTML = '<option value="">همه زیردسته‌ها</option>';
                    subSubcategorySelect.innerHTML = '<option value="">همه زیردسته دوم</option>';
                    if (!categoryId) return;
                    fetch(`/get-subcategories/${categoryId}`)
                        .then(res => res.json())
                        .then(data => {
                            data.forEach(sub => {
                                const option = document.createElement('option');
                                option.value = sub.id;
                                option.textContent = sub.name;
                                subcategorySelect.appendChild(option);
                            });
                        })
                        .catch(err => console.error('خطا در بارگذاری زیردسته‌ها:', err));
                });
            }

            if (subcategorySelect) {
                subcategorySelect.addEventListener('change', function() {
                    const subcategoryId = this.value;
                    subSubcategorySelect.innerHTML = '<option value="">همه زیردسته دوم</option>';
                    if (!subcategoryId) return;
                    fetch(`/get-subsubcategories/${subcategoryId}`)
                        .then(res => res.json())
                        .then(data => {
                            data.forEach(subsub => {
                                const option = document.createElement('option');
                                option.value = subsub.id;
                                option.textContent = subsub.name;
                                subSubcategorySelect.appendChild(option);
                            });
                        })
                        .catch(err => console.error('خطا در بارگذاری زیردسته دوم:', err));
                });
            }
        });

        function toggleFeatured(productId) {
            alert('تغییر وضعیت ویژه برای محصول ' + productId);
        }

        function incrementViews(productId) {
            alert('افزایش بازدید برای محصول ' + productId);
        }

        function showImageModal(src) {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');
            if (modal && modalImg) {
                modalImg.src = src;
                modal.style.display = 'flex';
            }
        }

        const modal = document.getElementById('imageModal');
        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.style.display = 'none';
                }
            });
        }
    </script>
</body>

</html>
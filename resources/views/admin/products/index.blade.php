<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <title>مدیریت محصولات</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #1a1a2e;
            color: white;
        }

        .btn-purple {
            background-color: #6a0dad;
            color: white;
        }

        .btn-purple:hover {
            background-color: #5800a3;
        }

        table {
            background-color: #2a2a40;
        }

        th,
        td {
            color: white;
        }

        .pagination {
            font-size: 0.85rem;
            margin-bottom: 0;
        }

        .pagination .page-link {
            padding: 0.3rem 0.7rem;
        }

        .status-badge {
            font-size: 0.75rem;
        }

        .product-image {
            max-width: 60px;
            max-height: 60px;
            object-fit: cover;
        }
    </style>
</head>

<body class="p-4">
    @php use Illuminate\Support\Str; @endphp
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>مدیریت محصولات</h2>
            <a href="{{ route('products.create') }}" class="btn btn-purple">افزودن محصول جدید</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- فرم فیلتر و جستجو -->
        <div class="card bg-dark mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('products.index') }}" class="row g-3">
                    <div class="col-md-3">
                        <input type="text" name="search" class="form-control" placeholder="جستجو در نام، SKU یا توضیحات"
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <select name="category" id="categorySelect" class="form-select" onchange="filterSubcategories()">
                            <option value="">همه دسته‌ها</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="subcategory" id="subcategorySelect" class="form-select">
                            <option value="">همه زیردسته‌ها</option>
                            @foreach ($subcategories as $sub)
                                <option value="{{ $sub->id }}" data-category="{{ $sub->category_id }}"
                                    {{ request('subcategory') == $sub->id ? 'selected' : '' }}>{{ $sub->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="per" class="form-select">
                            <option value="10" {{ request('per') == 10 ? 'selected' : '' }}>10 آیتم</option>
                            <option value="25" {{ request('per') == 25 ? 'selected' : '' }}>25 آیتم</option>
                            <option value="50" {{ request('per') == 50 ? 'selected' : '' }}>50 آیتم</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-purple me-2">جستجو</button>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-light">پاک کردن</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- جدول محصولات -->
        <div class="card bg-dark">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover text-center align-middle">
                        <thead class="table-dark">
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
                                            <img src="{{ asset('storage/' . $product->cover) }}" 
                                                 alt="{{ $product->name }}" 
                                                 class="product-image rounded">
                                        @elseif($product->media->isNotEmpty())
                                            <img src="{{ asset('storage/' . $product->media->first()->file_path) }}" 
                                                 alt="{{ $product->name }}" 
                                                 class="product-image rounded">
                                        @else
                                            <span class="text-muted">بدون تصویر</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ $product->name }}</div>
                                        @if($product->featured)
                                            <span class="badge bg-warning status-badge">ویژه</span>
                                        @endif
                                    </td>
                                    <td>{{ $product->sku ?? '-' }}</td>
                                    <td>
                                        <div>{{ $product->category->name ?? '-' }}</div>
                                        <small class="text-muted">
                                            {{ $product->subcategory->name ?? '' }}
                                            @if($product->subSubcategory)
                                                > {{ $product->subSubcategory->name }}
                                            @endif
                                        </small>
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ number_format($product->price) }} تومان</div>
                                        @if($product->discount_price)
                                            <small class="text-success">
                                                {{ number_format($product->final_price) }} تومان
                                            </small>
                                        @endif
                                    </td>
                                    <td>
                                        @if($product->discount_price)
                                            <span class="badge bg-success">
                                                {{ $product->discount_percentage }}%
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($product->is_in_stock)
                                            <span class="badge bg-success">موجود</span>
                                        @else
                                            <span class="badge bg-danger">ناموجود</span>
                                        @endif
                                        <div class="small">{{ $product->quantity }} عدد</div>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $product->status === 'approved' ? 'success' : ($product->status === 'pending' ? 'warning' : 'danger') }}">
                                            {{ $product->status_text }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($product->attributes->isNotEmpty())
                                            <div class="small">
                                                @foreach($product->attributes->take(2) as $attr)
                                                    <div><strong>{{ $attr->key }}:</strong> {{ $attr->value }}</div>
                                                @endforeach
                                                @if($product->attributes->count() > 2)
                                                    <small class="text-muted">+{{ $product->attributes->count() - 2 }} بیشتر</small>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($product->tags->isNotEmpty())
                                            @foreach($product->tags->take(3) as $tag)
                                                <span class="badge bg-secondary status-badge" 
                                                      style="background-color: {{ $tag->color }} !important;">
                                                    {{ $tag->name }}
                                                </span>
                                            @endforeach
                                            @if($product->tags->count() > 3)
                                                <small class="text-muted">+{{ $product->tags->count() - 3 }} بیشتر</small>
                                            @endif
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="small">{{ $product->created_at->format('Y/m/d') }}</div>
                                        <div class="small text-muted">{{ $product->created_at->format('H:i') }}</div>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('products.edit', $product) }}" 
                                               class="btn btn-warning btn-sm">ویرایش</a>
                                            <button type="button" class="btn btn-info btn-sm dropdown-toggle dropdown-toggle-split" 
                                                    data-bs-toggle="dropdown">
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#" 
                                                       onclick="toggleFeatured({{ $product->id }})">
                                                    {{ $product->featured ? 'حذف از ویژه' : 'افزودن به ویژه' }}
                                                </a></li>
                                                <li><a class="dropdown-item" href="#" 
                                                       onclick="incrementViews({{ $product->id }})">
                                                    افزایش بازدید
                                                </a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <form action="{{ route('products.destroy', $product) }}" 
                                                          method="POST" class="d-inline"
                                                          onsubmit="return confirm('آیا از حذف این محصول مطمئن هستید؟');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">حذف</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="13" class="text-center py-4">
                                        <div class="text-muted">هیچ محصولی یافت نشد.</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- صفحه‌بندی -->
                @if($products->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function filterSubcategories() {
            const categorySelect = document.getElementById('categorySelect');
            const subcategorySelect = document.getElementById('subcategorySelect');
            const selectedCategoryId = categorySelect.value;
            
            // پاک کردن گزینه‌های فعلی
            subcategorySelect.innerHTML = '<option value="">همه زیردسته‌ها</option>';
            
            if (selectedCategoryId) {
                // اضافه کردن زیردسته‌های مربوط به دسته انتخاب شده
                const options = subcategorySelect.querySelectorAll('option[data-category]');
                options.forEach(option => {
                    if (option.getAttribute('data-category') === selectedCategoryId) {
                        subcategorySelect.appendChild(option.cloneNode(true));
                    }
                });
            }
        }

        function toggleFeatured(productId) {
            // اینجا می‌توانید AJAX call برای تغییر وضعیت ویژه اضافه کنید
            alert('تغییر وضعیت ویژه برای محصول ' + productId);
        }

        function incrementViews(productId) {
            // اینجا می‌توانید AJAX call برای افزایش بازدید اضافه کنید
            alert('افزایش بازدید برای محصول ' + productId);
        }
    </script>
</body>

</html>

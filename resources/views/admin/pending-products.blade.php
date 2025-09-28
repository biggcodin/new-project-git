<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <title>درخواست‌های تایید نشده</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }

        .product-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .product-image {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
        }

        .product-price {
            font-size: 1.2rem;
            font-weight: bold;
            color: #6a0dad;
        }

        .product-original-price {
            text-decoration: line-through;
            color: #6c757d;
            font-size: 1rem;
        }

        .stock-status {
            font-size: 0.8rem;
            padding: 3px 8px;
            border-radius: 4px;
            display: inline-block;
        }

        .stock-status.in-stock {
            background-color: rgba(0, 255, 136, 0.2);
            color: #00ff88;
        }

        .stock-status.out-of-stock {
            background-color: rgba(255, 59, 48, 0.2);
            color: #ff3b30;
        }

        .stock-status.pre-order {
            background-color: rgba(255, 204, 0, 0.2);
            color: #ffcc00;
        }

        .status-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
        }

        .status-pending {
            background-color: rgba(255, 204, 0, 0.2);
            color: #ffcc00;
        }
    </style>
</head>

<body>
    @php use Illuminate\Support\Str; @endphp
    <div class="container">
        <h2 class="mb-4">درخواست‌های ثبت محصول کاربران (در انتظار تایید)</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($pendingProducts->count())
            <div class="row">
                @foreach ($pendingProducts as $product)
                    <div class="col-md-6 col-lg-4">
                        <div class="card product-card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        @if ($product->cover)
                                            <img src="{{ asset('storage/' . $product->cover) }}"
                                                alt="{{ $product->title }}" class="product-image">
                                        @else
                                            <div
                                                class="product-image d-flex align-items-center justify-content-center bg-light">
                                                <i class="fas fa-image fa-3x text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-8">
                                        <h5 class="card-title">{{ $product->title }}</h5>
                                        <p class="text-muted mb-1">
                                            کاربر: {{ $product->user->name ?? '---' }}
                                        </p>
                                        <p class="text-muted mb-1">
                                            زیردسته: {{ $product->subSubcategory->name ?? '---' }}
                                        </p>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div>
                                                @if ($product->discount > 0)
                                                    <span
                                                        class="product-original-price">{{ number_format($product->price) }}
                                                        تومان</span>
                                                    <span
                                                        class="product-price">{{ number_format($product->final_price) }}
                                                        تومان</span>
                                                @else
                                                    <span class="product-price">{{ number_format($product->price) }}
                                                        تومان</span>
                                                @endif
                                            </div>
                                        </div>
                                        <span
                                            class="stock-status {{ $product->stock_status }}">{{ $product->stock_status_text }}</span>
                                        <span class="status-badge status-pending ms-2">در انتظار تایید</span>
                                        <p class="text-muted mt-2">
                                            <small>{{ $product->created_at->format('Y/m/d H:i') }}</small>
                                        </p>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <h6>فایل‌های ارسالی:</h6>
                                        @if ($product->media && $product->media->count())
                                            <div class="d-flex flex-wrap">
                                                @foreach ($product->media as $media)
                                                    @if (Str::startsWith($media->file_type, 'image/'))
                                                        <img src="{{ asset('storage/' . $media->file_path) }}"
                                                            width="60" class="rounded me-1 mb-1"
                                                            style="border:1px solid #888;">
                                                    @elseif(Str::startsWith($media->file_type, 'video/'))
                                                        <video width="90" controls class="me-1 mb-1"
                                                            style="vertical-align: middle;">
                                                            <source src="{{ asset('storage/' . $media->file_path) }}"
                                                                type="{{ $media->file_type }}">
                                                            ویدئو پشتیبانی نمی‌شود.
                                                        </video>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <div class="d-flex gap-2">
                                            <form method="POST"
                                                action="{{ route('pending.products.approve', $product) }}"
                                                class="flex-grow-1">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm w-100"
                                                    onclick="return confirm('آیا مطمئنید می‌خواهید این محصول را تایید کنید؟')">
                                                    <i class="fas fa-check me-1"></i>تایید
                                                </button>
                                            </form>
                                            <form method="POST"
                                                action="{{ route('pending.products.reject', $product) }}"
                                                class="flex-grow-1">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm w-100"
                                                    onclick="return confirm('آیا مطمئنید می‌خواهید این محصول را رد کنید؟')">
                                                    <i class="fas fa-times me-1"></i>رد
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">
                درخواستی برای تایید وجود ندارد.
            </div>
        @endif
    </div>
</body>

</html>

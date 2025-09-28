<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <title>ویرایش محصول</title>
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

        .card {
            background-color: #2a2a40;
            border: 1px solid #3a3a50;
        }

        .form-control, .form-select {
            background-color: #3a3a50;
            border: 1px solid #4a4a60;
            color: white;
        }

        .form-control:focus, .form-select:focus {
            background-color: #3a3a50;
            border-color: #6a0dad;
            color: white;
            box-shadow: 0 0 0 0.2rem rgba(106, 13, 173, 0.25);
        }

        .current-image {
            max-width: 150px;
            max-height: 150px;
            object-fit: cover;
            border-radius: 0.375rem;
        }

        .media-item {
            display: inline-block;
            margin: 5px;
            position: relative;
        }

        .media-item img, .media-item video {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
            border-radius: 0.375rem;
        }

        .remove-media {
            position: absolute;
            top: -5px;
            right: -5px;
            background: red;
            color: white;
            border: none;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            cursor: pointer;
        }
    </style>
</head>

<body class="p-4">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>ویرایش محصول: {{ $product->name }}</h2>
            <a href="{{ route('products.index') }}" class="btn btn-outline-light">بازگشت به لیست</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <!-- اطلاعات اصلی -->
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">اطلاعات اصلی محصول</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">نام محصول *</label>
                                    <input type="text" name="name" id="name" class="form-control" 
                                           value="{{ old('name', $product->name) }}" required>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="sku" class="form-label">کد محصول (SKU)</label>
                                    <input type="text" name="sku" id="sku" class="form-control" 
                                           value="{{ old('sku', $product->sku) }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="price" class="form-label">قیمت (تومان) *</label>
                                    <input type="number" name="price" id="price" class="form-control" 
                                           value="{{ old('price', $product->price) }}" min="0" step="1000" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="discount_price" class="form-label">قیمت با تخفیف (تومان)</label>
                                    <input type="number" name="discount_price" id="discount_price" class="form-control" 
                                           value="{{ old('discount_price', $product->discount_price) }}" min="0" step="1000">
                                </div>

                                <div class="col-md-6">
                                    <label for="quantity" class="form-label">موجودی</label>
                                    <input type="number" name="quantity" id="quantity" class="form-control" 
                                           value="{{ old('quantity', $product->quantity) }}" min="0">
                                </div>

                                <div class="col-md-6">
                                    <label for="order" class="form-label">ترتیب نمایش</label>
                                    <input type="number" name="order" id="order" class="form-control" 
                                           value="{{ old('order', $product->order) }}" min="0">
                                </div>

                                <div class="col-12">
                                    <label for="description" class="form-label">توضیحات محصول</label>
                                    <textarea name="description" id="description" class="form-control" 
                                              rows="4">{{ old('description', $product->description) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- دسته‌بندی -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">دسته‌بندی</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="category_id" class="form-label">دسته اصلی *</label>
                                    <select name="category_id" id="category_id" class="form-select" required>
                                        <option value="">انتخاب کنید</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="subcategory_id" class="form-label">زیردسته اول *</label>
                                    <select name="subcategory_id" id="subcategory_id" class="form-select" required>
                                        <option value="">انتخاب کنید</option>
                                        @foreach ($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}" 
                                                    data-category="{{ $subcategory->category_id }}"
                                                    {{ old('subcategory_id', $product->subcategory_id) == $subcategory->id ? 'selected' : '' }}>
                                                {{ $subcategory->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="sub_subcategory_id" class="form-label">زیردسته دوم</label>
                                    <select name="sub_subcategory_id" id="sub_subcategory_id" class="form-select">
                                        <option value="">انتخاب کنید</option>
                                        @foreach ($subSubcategories as $subSubcategory)
                                            <option value="{{ $subSubcategory->id }}" 
                                                    data-subcategory="{{ $subSubcategory->subcategory_id }}"
                                                    {{ old('sub_subcategory_id', $product->sub_subcategory_id) == $subSubcategory->id ? 'selected' : '' }}>
                                                {{ $subSubcategory->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ویژگی‌ها -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">ویژگی‌های محصول</h5>
                        </div>
                        <div class="card-body">
                            <div id="attributesContainer">
                                @if($attributes && count($attributes) > 0)
                                    @foreach($attributes as $key => $value)
                                        <div class="row g-2 mb-2 attribute-row">
                                            <div class="col-md-5">
                                                <input type="text" name="attribute_keys[]" class="form-control" 
                                                       placeholder="نام ویژگی" value="{{ $key }}" required>
                                            </div>
                                            <div class="col-md-5">
                                                <input type="text" name="attribute_values[]" class="form-control" 
                                                       placeholder="مقدار ویژگی" value="{{ $value }}" required>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger btn-sm remove-attribute">حذف</button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="row g-2 mb-2 attribute-row">
                                        <div class="col-md-5">
                                            <input type="text" name="attribute_keys[]" class="form-control" 
                                                   placeholder="نام ویژگی" required>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" name="attribute_values[]" class="form-control" 
                                                   placeholder="مقدار ویژگی" required>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-danger btn-sm remove-attribute">حذف</button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <button type="button" class="btn btn-success btn-sm" onclick="addAttribute()">افزودن ویژگی</button>
                        </div>
                    </div>
                </div>

                <!-- تنظیمات جانبی -->
                <div class="col-lg-4">
                    <!-- وضعیت و تنظیمات -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">وضعیت و تنظیمات</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="status" class="form-label">وضعیت</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="pending" {{ old('status', $product->status) == 'pending' ? 'selected' : '' }}>در انتظار تایید</option>
                                    <option value="approved" {{ old('status', $product->status) == 'approved' ? 'selected' : '' }}>تایید شده</option>
                                    <option value="rejected" {{ old('status', $product->status) == 'rejected' ? 'selected' : '' }}>رد شده</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" name="featured" id="featured" class="form-check-input" 
                                           value="1" {{ old('featured', $product->featured) ? 'checked' : '' }}>
                                    <label for="featured" class="form-check-label">محصول ویژه</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="published_at" class="form-label">تاریخ انتشار</label>
                                <input type="datetime-local" name="published_at" id="published_at" class="form-control" 
                                       value="{{ old('published_at', $product->published_at ? $product->published_at->format('Y-m-d\TH:i') : '') }}">
                            </div>
                        </div>
                    </div>

                    <!-- تصویر اصلی -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">تصویر اصلی</h5>
                        </div>
                        <div class="card-body">
                            @if($product->cover)
                                <div class="mb-3">
                                    <label class="form-label">تصویر فعلی:</label>
                                    <img src="{{ asset('storage/' . $product->cover) }}" 
                                         alt="{{ $product->name }}" class="current-image d-block">
                                </div>
                            @endif
                            <input type="file" name="cover" id="cover" class="form-control" accept="image/*">
                        </div>
                    </div>

                    <!-- تصاویر اضافی -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">تصاویر اضافی</h5>
                        </div>
                        <div class="card-body">
                            @if($product->media->isNotEmpty())
                                <div class="mb-3">
                                    <label class="form-label">فایل‌های فعلی:</label>
                                    <div class="d-flex flex-wrap">
                                        @foreach($product->media as $media)
                                            <div class="media-item">
                                                @if(Str::startsWith($media->file_type, 'image/'))
                                                    <img src="{{ asset('storage/' . $media->file_path) }}" 
                                                         alt="{{ $media->file_name }}">
                                                @elseif(Str::startsWith($media->file_type, 'video/'))
                                                    <video controls>
                                                        <source src="{{ asset('storage/' . $media->file_path) }}" 
                                                                type="{{ $media->file_type }}">
                                                    </video>
                                                @endif
                                                <button type="button" class="remove-media" 
                                                        onclick="removeMedia({{ $media->id }})">×</button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <input type="file" name="images[]" id="images" class="form-control" accept="image/*,video/*" multiple>
                        </div>
                    </div>

                    <!-- تگ‌ها -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">تگ‌ها</h5>
                        </div>
                        <div class="card-body">
                            <select name="tags[]" id="tags" class="form-select" multiple size="8">
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}" 
                                            {{ in_array($tag->id, old('tags', $product->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                                        {{ $tag->name }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">برای انتخاب چندین تگ، کلید Ctrl را نگه دارید.</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">تنظیمات SEO</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="meta_title" class="form-label">عنوان متا</label>
                            <input type="text" name="meta_title" id="meta_title" class="form-control" 
                                   value="{{ old('meta_title', $product->meta_title) }}">
                        </div>
                        <div class="col-md-6">
                            <label for="slug" class="form-label">نامک (Slug)</label>
                            <input type="text" name="slug" id="slug" class="form-control" 
                                   value="{{ old('slug', $product->slug) }}">
                        </div>
                        <div class="col-12">
                            <label for="meta_description" class="form-label">توضیحات متا</label>
                            <textarea name="meta_description" id="meta_description" class="form-control" 
                                      rows="3">{{ old('meta_description', $product->meta_description) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- دکمه‌های عملیات -->
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('products.index') }}" class="btn btn-outline-light">انصراف</a>
                <button type="submit" class="btn btn-purple">ذخیره تغییرات</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // فیلتر کردن زیردسته‌ها بر اساس دسته اصلی
        document.getElementById('category_id').addEventListener('change', function() {
            const categoryId = this.value;
            const subcategorySelect = document.getElementById('subcategory_id');
            const subSubcategorySelect = document.getElementById('sub_subcategory_id');
            
            // پاک کردن گزینه‌ها
            subcategorySelect.innerHTML = '<option value="">انتخاب کنید</option>';
            subSubcategorySelect.innerHTML = '<option value="">انتخاب کنید</option>';
            
            if (categoryId) {
                // نمایش زیردسته‌های مربوط به دسته انتخاب شده
                Array.from(subcategorySelect.querySelectorAll('option[data-category]')).forEach(option => {
                    if (option.getAttribute('data-category') === categoryId) {
                        subcategorySelect.appendChild(option.cloneNode(true));
                    }
                });
            }
        });

        // فیلتر کردن زیردسته‌های دوم بر اساس زیردسته اول
        document.getElementById('subcategory_id').addEventListener('change', function() {
            const subcategoryId = this.value;
            const subSubcategorySelect = document.getElementById('sub_subcategory_id');
            
            subSubcategorySelect.innerHTML = '<option value="">انتخاب کنید</option>';
            
            if (subcategoryId) {
                // نمایش زیردسته‌های دوم مربوط به زیردسته انتخاب شده
                Array.from(subSubcategorySelect.querySelectorAll('option[data-subcategory]')).forEach(option => {
                    if (option.getAttribute('data-subcategory') === subcategoryId) {
                        subSubcategorySelect.appendChild(option.cloneNode(true));
                    }
                });
            }
        });

        // تولید خودکار نامک
        document.getElementById('name').addEventListener('input', function() {
            const slug = this.value
                .toLowerCase()
                .replace(/[^\u0600-\u06FF\w\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim('-');
            document.getElementById('slug').value = slug;
        });

        // افزودن ویژگی جدید
        function addAttribute() {
            const container = document.getElementById('attributesContainer');
            const newRow = document.createElement('div');
            newRow.className = 'row g-2 mb-2 attribute-row';
            newRow.innerHTML = `
                <div class="col-md-5">
                    <input type="text" name="attribute_keys[]" class="form-control" placeholder="نام ویژگی" required>
                </div>
                <div class="col-md-5">
                    <input type="text" name="attribute_values[]" class="form-control" placeholder="مقدار ویژگی" required>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger btn-sm remove-attribute">حذف</button>
                </div>
            `;
            container.appendChild(newRow);
        }

        // حذف ویژگی
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-attribute')) {
                e.target.closest('.attribute-row').remove();
            }
        });

        // حذف فایل مدیا
        function removeMedia(mediaId) {
            if (confirm('آیا از حذف این فایل مطمئن هستید؟')) {
                // اینجا می‌توانید AJAX call برای حذف فایل اضافه کنید
                alert('حذف فایل با شناسه: ' + mediaId);
            }
        }
    </script>
</body>

</html>

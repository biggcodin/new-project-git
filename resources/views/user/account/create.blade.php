<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <title>ثبت اکانت بازی</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-section {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #6a0dad;
            border-color: #6a0dad;
        }

        .btn-primary:hover {
            background-color: #5800a3;
            border-color: #5800a3;
        }
    </style>
</head>

<body class="bg-light p-4">
    <div class="container">
        <h3 class="mb-4 text-center">ثبت اکانت بازی</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-10">
                <form method="POST" action="{{ route('user.account.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-section">
                        <h4 class="mb-3">اطلاعات اصلی</h4>

                        <div class="mb-3">
                            <label for="title" class="form-label">عنوان اکانت</label>
                            <input type="text" id="title" name="title"
                                class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}"
                                required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="sub_subcategory_id" class="form-label">زیردسته دوم</label>
                            <select id="sub_subcategory_id" name="sub_subcategory_id"
                                class="form-select @error('sub_subcategory_id') is-invalid @enderror" required>
                                <option value="">انتخاب کنید</option>
                                @foreach ($subSubcategories as $subSub)
                                    <option value="{{ $subSub->id }}"
                                        {{ old('sub_subcategory_id') == $subSub->id ? 'selected' : '' }}>
                                        {{ $subSub->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sub_subcategory_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">توضیحات محصول</label>
                            <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">قیمت (تومان)</label>
                                <input type="number" id="price" name="price"
                                    class="form-control @error('price') is-invalid @enderror"
                                    value="{{ old('price') }}" min="0" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="discount" class="form-label">تخفیف (%)</label>
                                <input type="number" name="discount" id="discount" class="form-control" min="0"
                                    max="100" step="0.01" value="{{ old('discount', 0) }}">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="stock_status" class="form-label">وضعیت موجودی</label>
                                <select name="stock_status" id="stock_status" class="form-control">
                                    <option value="in_stock"
                                        {{ old('stock_status', 'in_stock') == 'in_stock' ? 'selected' : '' }}>موجود
                                    </option>
                                    <option value="out_of_stock"
                                        {{ old('stock_status') == 'out_of_stock' ? 'selected' : '' }}>ناموجود</option>
                                    <option value="pre_order"
                                        {{ old('stock_status') == 'pre_order' ? 'selected' : '' }}>پیش‌فروش</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <h4 class="mb-3">فیلدهای اختصاصی</h4>
                        <div id="custom-fields" class="mb-3"></div>
                    </div>

                    <div class="form-section">
                        <h4 class="mb-3">رسانه‌ها</h4>

                        <div class="mb-3">
                            <label for="cover" class="form-label">عکس اصلی</label>
                            <input type="file" name="cover" id="cover" class="form-control" accept="image/*">
                        </div>

                        <div class="mb-3">
                            <label for="media" class="form-label">عکس‌ها و فیلم‌ها</label>
                            <input type="file" id="media" name="media[]" class="form-control" multiple
                                accept="image/*,video/*">
                            @error('media')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            @error('media.*')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-section">
                        <h4 class="mb-3">تگ‌ها</h4>
                        <div class="mb-3">
                            <label for="tags" class="form-label">تگ‌های محصول</label>
                            <select name="tags[]" id="tags" class="form-control" multiple>
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">ثبت اکانت</button>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary">بازگشت به صفحه اصلی</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const getFieldsUrl = "{{ route('products.getFields') }}";
        const subcategoryId = {{ $subcategory->id }};
        const oldSubSubcategoryId = "{{ old('sub_subcategory_id') }}";

        $(document).ready(function() {
            function loadCustomFields(subSubcategoryId) {
                if (!subSubcategoryId) {
                    $('#custom-fields').empty();
                    return;
                }

                $.ajax({
                    url: getFieldsUrl,
                    method: 'GET',
                    data: {
                        subcategory_id: subcategoryId,
                        sub_subcategory_id: subSubcategoryId
                    },
                    success: function(fields) {
                        $('#custom-fields').empty();
                        if (Object.keys(fields).length === 0) {
                            $('#custom-fields').html(
                                '<p class="text-info">فیلدهای اختصاصی یافت نشد.</p>');
                            return;
                        }

                        Object.entries(fields).forEach(([key, field]) => {
                            let inputHtml = '';
                            if (field.type === 'select') {
                                inputHtml =
                                    `<select name="attributes[${key}]" class="form-select" required>`;
                                field.options.forEach(opt => {
                                    inputHtml +=
                                        `<option value="${opt}">${opt}</option>`;
                                });
                                inputHtml += `</select>`;
                            } else {
                                inputHtml =
                                    `<input type="${field.type}" name="attributes[${key}]" class="form-control" placeholder="${field.label}" required>`;
                            }
                            $('#custom-fields').append(`
                                <div class="mb-3">
                                    <label class="form-label">${field.label}</label>
                                    ${inputHtml}
                                </div>
                            `);
                        });
                    },
                    error: function() {
                        $('#custom-fields').html('<p class="text-danger">خطا در دریافت فیلدها!</p>');
                    }
                });
            }

            $('#sub_subcategory_id').change(function() {
                loadCustomFields($(this).val());
            });

            if (oldSubSubcategoryId) {
                $('#sub_subcategory_id').val(oldSubSubcategoryId).trigger('change');
            }
        });
    </script>
</body>

</html>

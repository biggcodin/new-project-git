<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <title>مدیریت دسته‌ها</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1e1433;
            color: white;
        }

        .modal-content {
            background-color: #2b1d4f;
        }

        select option,
        input[type="text"] {
            color: black;
        }

        /* سبک بهتر برای لیست */
        .category-box {
            border-right: 4px solid #6c5ce7;
            padding: 10px;
            margin-bottom: 15px;
            background-color: #2b1d4f;
            border-radius: 5px;
        }

        .subcategory-box {
            margin-left: 20px;
            padding: 10px;
            background-color: #3a2670;
            border-radius: 4px;
        }

        .sub-subcategory-box {
            margin-left: 40px;
            padding: 10px;
            background-color: #4b3289;
            border-radius: 3px;
        }

        .actions {
            margin-top: 10px;
        }

        .status-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
        }

        .status-active {
            background-color: rgba(25, 135, 84, 0.2);
            color: #198754;
        }

        .status-inactive {
            background-color: rgba(220, 53, 69, 0.2);
            color: #dc3545;
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <h2 class="mb-4">مدیریت دسته‌ها، زیردسته‌ها و زیردسته دوم‌ها</h2>
        @if (session('success'))
            <div class="alert alert-success mb-3">{{ session('success') }}</div>
        @endif

        <!-- دکمه‌های مدیریت -->
        <div class="mb-4">
            <button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#addCategoryModal">افزودن
                دسته</button>
            <button class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#addSubcategoryModal">افزودن
                زیردسته اول</button>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSubSubcategoryModal">افزودن
                زیردسته دوم</button>
        </div>

        <!-- لیست دسته‌ها -->
        <div class="accordion" id="categoryAccordion">
            @foreach ($categories as $cat)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $cat->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $cat->id }}" aria-expanded="false"
                            aria-controls="collapse{{ $cat->id }}">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <span>{{ $cat->name }}</span>
                                <span class="status-badge status-active">فعال</span>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse{{ $cat->id }}" class="accordion-collapse collapse"
                        aria-labelledby="heading{{ $cat->id }}" data-bs-parent="#categoryAccordion">
                        <div class="accordion-body">
                            <div class="d-flex justify-content-end mb-3">
                                <button class="btn btn-warning btn-sm me-2" data-bs-toggle="modal"
                                    data-bs-target="#editCategoryModal{{ $cat->id }}">ویرایش</button>
                                <form
                                    action="{{ route('categories.destroy', ['type' => 'category', 'id' => $cat->id]) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('آیا از حذف این دسته اطمینان دارید؟')">حذف</button>
                                </form>
                            </div>

                            @foreach ($cat->subcategories as $sub)
                                <div class="subcategory-box">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5>{{ $sub->name }}</h5>
                                        <span class="status-badge status-active">فعال</span>
                                    </div>
                                    <div class="actions">
                                        <button class="btn btn-warning btn-sm me-2" data-bs-toggle="modal"
                                            data-bs-target="#editSubcategoryModal{{ $sub->id }}">ویرایش</button>
                                        <form
                                            action="{{ route('categories.destroy', ['type' => 'subcategory', 'id' => $sub->id]) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('آیا از حذف این زیردسته اول اطمینان دارید؟')">حذف</button>
                                        </form>
                                    </div>

                                    @foreach ($sub->subSubcategories as $subSub)
                                        <div class="sub-subcategory-box">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6>{{ $subSub->name }}</h6>
                                                <span class="status-badge status-active">فعال</span>
                                            </div>
                                            <div class="actions">
                                                <button class="btn btn-warning btn-sm me-2" data-bs-toggle="modal"
                                                    data-bs-target="#editSubSubcategoryModal{{ $subSub->id }}">ویرایش</button>
                                                <form
                                                    action="{{ route('categories.destroy', ['type' => 'sub_subcategory', 'id' => $subSub->id]) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('آیا از حذف این زیردسته دوم اطمینان دارید؟')">حذف</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Modal ویرایش زیردسته دوم -->
        @foreach ($categories as $cat)
            @foreach ($cat->subcategories as $sub)
                @foreach ($sub->subSubcategories as $subSub)
                    <div class="modal fade" id="editSubSubcategoryModal{{ $subSub->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <form method="POST"
                                action="{{ route('categories.update', ['type' => 'sub_subcategory', 'id' => $subSub->id]) }}">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">ویرایش زیردسته دوم</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label>نام زیردسته دوم</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $subSub->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>زیردسته اول والد</label>
                                            <select name="subcategory_id" class="form-control" required>
                                                @foreach ($categories as $category)
                                                    @foreach ($category->subcategories as $s)
                                                        <option value="{{ $s->id }}"
                                                            {{ $s->id == $subSub->subcategory_id ? 'selected' : '' }}>
                                                            {{ $category->name }} → {{ $s->name }}
                                                        </option>
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary">ذخیره</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endforeach
        @endforeach

        <!-- Modal ویرایش زیردسته اول -->
        @foreach ($categories as $cat)
            @foreach ($cat->subcategories as $sub)
                <div class="modal fade" id="editSubcategoryModal{{ $sub->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form method="POST"
                            action="{{ route('categories.update', ['type' => 'subcategory', 'id' => $sub->id]) }}">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">ویرایش زیردسته اول</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>نام زیردسته اول</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $sub->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>دسته والد</label>
                                        <select name="category_id" class="form-control" required>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $category->id == $sub->category_id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary">ذخیره</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        @endforeach

        <!-- Modal ویرایش دسته -->
        @foreach ($categories as $cat)
            <div class="modal fade" id="editCategoryModal{{ $cat->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form method="POST"
                        action="{{ route('categories.update', ['type' => 'category', 'id' => $cat->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">ویرایش دسته</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>نام دسته</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ $cat->name }}" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary">ذخیره</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach

        <!-- Modal افزودن دسته -->
        <div class="modal fade" id="addCategoryModal" tabindex="-1">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <input type="hidden" name="type" value="category">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">افزودن دسته</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>نام دسته</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success">ثبت</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal افزودن زیردسته اول -->
        <div class="modal fade" id="addSubcategoryModal" tabindex="-1">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <input type="hidden" name="type" value="subcategory">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">افزودن زیردسته اول</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>نام زیردسته اول</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>دسته والد</label>
                                <select name="category_id" class="form-control" required>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success">ثبت زیردسته اول</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal افزودن زیردسته دوم -->
        <div class="modal fade" id="addSubSubcategoryModal" tabindex="-1">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <input type="hidden" name="type" value="sub_subcategory">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">افزودن زیردسته دوم</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>نام زیردسته دوم</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>زیردسته اول والد</label>
                                <select name="subcategory_id" class="form-control" required>
                                    @foreach ($categories as $cat)
                                        @foreach ($cat->subcategories as $sub)
                                            <option value="{{ $sub->id }}">{{ $cat->name }} →
                                                {{ $sub->name }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success">ثبت زیردسته دوم</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

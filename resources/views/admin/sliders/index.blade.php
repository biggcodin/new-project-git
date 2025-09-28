<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدیریت اسلایدرها</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f8f9fa;
            direction: rtl;
        }

        .container {
            margin-top: 20px;
        }

        .table th,
        .table td {
            text-align: center;
        }

        .modal-lg {
            max-width: 900px;
        }

        .form-label {
            font-weight: bold;
        }

        .img-preview {
            max-height: 100px;
            margin-top: 10px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .table img {
            border-radius: 8px;
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .table img:hover {
            transform: scale(1.1);
        }

        .modal-image {
            max-width: 100%;
            height: auto;
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
    <div class="container">
        <h2 class="mb-4">مدیریت اسلایدرها</h2>

        <!-- دکمه افزودن اسلایدر -->
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addSliderModal">
            <i class="fas fa-plus"></i> افزودن اسلایدر
        </button>

        <!-- پیام موفقیت -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- فرم جستجو -->
        <form method="GET" action="{{ route('admin.sliders.index') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                    placeholder="جستجو...">
                <button class="btn btn-primary" type="submit">جستجو</button>
            </div>
        </form>

        <!-- جدول نمایش اسلایدرها -->
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>عنوان</th>
                    <th>زیرعنوان</th>
                    <th>متن قیمت</th>
                    <th>مقدار قیمت</th>
                    <th>واحد قیمت</th>
                    <th>لینک</th>
                    <th>تصویر</th>
                    <th>توضیحات</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($slides as $slide)
                    <tr>
                        <td>{{ $slide->title }}</td>
                        <td>{{ $slide->subtitle }}</td>
                        <td>{{ $slide->price_text }}</td>
                        <td>{{ $slide->price_value }}</td>
                        <td>{{ $slide->price_unit }}</td>
                        <td><a href="{{ $slide->link }}" target="_blank">{{ $slide->link }}</a></td>
                        <td>
                            @if ($slide->image)
                                <img src="{{ asset('storage/' . $slide->image) }}" width="100" class="img-thumbnail"
                                    data-bs-toggle="modal" data-bs-target="#imageModal{{ $slide->id }}">
                            @else
                                بدون تصویر
                            @endif
                        </td>
                        <td>{{ Str::limit($slide->description, 50) }}</td>
                        <td>
                            <span class="status-badge status-active">فعال</span>
                        </td>
                        <td>
                            <!-- دکمه ویرایش -->
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editSliderModal{{ $slide->id }}">
                                <i class="fas fa-edit"></i> ویرایش
                            </button>
                            <!-- فرم حذف -->
                            <form action="{{ route('sliders.destroy', $slide->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('آیا مطمئن هستید؟')">
                                    <i class="fas fa-trash"></i> حذف
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- مودال نمایش تصویر -->
                    <div class="modal fade" id="imageModal{{ $slide->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">تصویر اسلایدر</h5>
                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset('storage/' . $slide->image) }}" class="modal-image"
                                        alt="تصویر اسلایدر">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- مودال ویرایش -->
                    <div class="modal fade" id="editSliderModal{{ $slide->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">ویرایش اسلایدر</h5>
                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('sliders.update', $slide->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">عنوان</label>
                                                <input type="text" name="title" class="form-control"
                                                    value="{{ $slide->title }}" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">زیرعنوان</label>
                                                <input type="text" name="subtitle" class="form-control"
                                                    value="{{ $slide->subtitle }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">متن قیمت</label>
                                                <input type="text" name="price_text" class="form-control"
                                                    value="{{ $slide->price_text }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">مقدار قیمت</label>
                                                <input type="text" name="price_value" class="form-control"
                                                    value="{{ $slide->price_value }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">واحد قیمت</label>
                                                <input type="text" name="price_unit" class="form-control"
                                                    value="{{ $slide->price_unit }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">لینک</label>
                                                <input type="url" name="link" class="form-control"
                                                    value="{{ $slide->link }}">
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">توضیحات</label>
                                                <textarea name="description" rows="3" class="form-control">{{ $slide->description }}</textarea>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">تصویر</label>
                                                <input type="file" name="image" class="form-control">
                                                @if ($slide->image)
                                                    <img src="{{ asset('storage/' . $slide->image) }}"
                                                        class="img-preview">
                                                @endif
                                            </div>
                                        </div>
                                        <button class="btn btn-primary">
                                            <i class="fas fa-save"></i> ذخیره تغییرات
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

        <!-- مودال افزودن -->
        <div class="modal fade" id="addSliderModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">افزودن اسلایدر</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">عنوان</label>
                                    <input type="text" name="title" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">زیرعنوان</label>
                                    <input type="text" name="subtitle" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">متن قیمت</label>
                                    <input type="text" name="price_text" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">مقدار قیمت</label>
                                    <input type="text" name="price_value" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">واحد قیمت</label>
                                    <input type="text" name="price_unit" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">لینک</label>
                                    <input type="url" name="link" class="form-control">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">توضیحات</label>
                                    <textarea name="description" rows="3" class="form-control"></textarea>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">تصویر</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>
                            <button class="btn btn-success">
                                <i class="fas fa-plus"></i> افزودن
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

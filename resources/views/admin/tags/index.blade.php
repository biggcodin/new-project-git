<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>مدیریت برچسب‌ها</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
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
    </style>
</head>

<body>
    <div class="container py-5">
        <h1 class="mb-4 text-center">مدیریت برچسب‌ها</h1>

        <!-- دکمه افزودن برچسب -->
        <div class="text-end mb-3">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addTagModal">افزودن برچسب
                جدید</button>
        </div>

        <!-- جدول برچسب‌ها -->
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>شناسه</th>
                        <th>نام برچسب</th>
                        <th>اسلاگ</th>
                        <th>وضعیت</th>
                        <th>تاریخ ایجاد</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                        <tr>
                            <td>{{ $tag->id }}</td>
                            <td>{{ $tag->name }}</td>
                            <td>{{ $tag->slug }}</td>
                            <td>
                                <span class="status-badge status-active">فعال</span>
                            </td>
                            <td>{{ $tag->created_at->format('Y/m/d') }}</td>
                            <td>
                                <!-- دکمه ویرایش -->
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editTagModal{{ $tag->id }}">ویرایش</button>
                                <!-- دکمه حذف -->
                                <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('آیا مطمئن هستید که می‌خواهید حذف کنید؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                                </form>
                            </td>
                        </tr>

                        <!-- مدال ویرایش برچسب -->
                        <div class="modal fade" id="editTagModal{{ $tag->id }}" tabindex="-1"
                            aria-labelledby="editTagModalLabel{{ $tag->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('tags.update', $tag->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editTagModalLabel{{ $tag->id }}">ویرایش
                                                برچسب</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="بستن"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">نام برچسب</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ $tag->name }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">بستن</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- صفحه‌بندی -->
        <div class="mt-4">
            {{ $tags->links() }}
        </div>
    </div>

    <!-- مدال افزودن برچسب -->
    <div class="modal fade" id="addTagModal" tabindex="-1" aria-labelledby="addTagModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('tags.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTagModalLabel">افزودن برچسب جدید</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">نام برچسب</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">ثبت برچسب</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

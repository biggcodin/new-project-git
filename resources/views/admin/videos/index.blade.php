<!doctype html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>مدیریت ویدیوها</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Tanha', sans-serif;
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <h1 class="mb-4 text-center">مدیریت ویدیوها</h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- نمایش خطاها --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <form method="GET" action="{{ route('videos.index') }}" class="d-flex">
                    <input type="text" name="search" class="form-control me-2" placeholder="جستجوی عنوان..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-primary">جستجو</button>
                </form>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addVideoModal">
                    <i class="fas fa-plus"></i> افزودن ویدیو
                </button>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>عنوان</th>
                                <th>مسیر فایل</th>
                                <th>لینک خارجی</th>
                                <th>توضیحات</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($videos as $video)
                                <tr>
                                    <td>{{ $loop->iteration + ($videos->currentPage() - 1) * $videos->perPage() }}
                                    </td>
                                    <td>{{ $video->title }}</td>
                                    <td>
                                        @if ($video->path)
                                            <a href="{{ asset($video->path) }}" target="_blank">مشاهده</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($video->url)
                                            <a href="{{ $video->url }}" target="_blank">لینک</a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $video->description ?? '-' }}</td>
                                    <td>
                                        <form action="{{ route('videos.destroy', $video->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('آیا مطمئن هستید؟')">
                                                حذف
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">هیچ ویدیویی یافت نشد</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($videos->hasPages())
                    <div class="d-flex justify-content-center mt-3">
                        {{ $videos->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal افزودن ویدیو -->
    <div class="modal fade" id="addVideoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">افزودن ویدیو جدید</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">عنوان ویدیو *</label>
                            <input type="text" id="title" name="title" class="form-control" required
                                value="{{ old('title') }}">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">توضیحات</label>
                            <textarea id="description" name="description" class="form-control" rows="2">{{ old('description') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="video" class="form-label">آپلود فایل ویدیو</label>
                            <input type="file" id="video" name="video" class="form-control" accept="video/*">
                            <div class="form-text">حداکثر حجم: 50 مگابایت</div>
                        </div>
                        <div class="mb-3">
                            <label for="video_url" class="form-label">یا لینک ویدیو</label>
                            <input type="url" id="video_url" name="video_url" class="form-control"
                                placeholder="https://example.com/video.mp4" value="{{ old('video_url') }}">
                        </div>
                        <div class="alert alert-info small">
                            <strong>توجه:</strong> آپلود فایل یا وارد کردن لینک ویدیو الزامی است.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">انصراف</button>
                        <button type="submit" class="btn btn-primary">ذخیره ویدیو</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // فعال کردن توستر برای پیام‌ها
        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.querySelector('.alert');
            if (alert) {
                setTimeout(() => {
                    alert.classList.add('fade');
                    setTimeout(() => alert.remove(), 150);
                }, 5000);
            }
        });
    </script>
</body>

</html>

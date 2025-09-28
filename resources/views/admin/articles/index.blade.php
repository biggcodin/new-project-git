<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>مدیریت مقالات</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        html,
        body {
            height: 100%;
        }

        .modal-dialog-scrollable .modal-content {
            max-height: 90vh;
        }

        .modal-body {
            overflow-y: auto;
            max-height: 65vh;
        }

        video {
            max-width: 300px;
            height: auto;
        }

        @media (max-width: 767px) {

            .modal-lg,
            .modal-dialog {
                max-width: 98vw !important;
                margin: 0 auto;
            }

            .modal-body {
                max-height: 55vh;
            }
        }

        .article-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        .status-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
        }

        .status-published {
            background-color: rgba(25, 135, 84, 0.2);
            color: #198754;
        }

        .status-draft {
            background-color: rgba(108, 117, 125, 0.2);
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <h1 class="text-center mb-4">مدیریت مقالات</h1>

        <!-- دکمه افزودن مقاله -->
        <div class="text-end mb-4">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addArticleModal">
                افزودن مقاله جدید
            </button>
        </div>

        <!-- فرم جستجو -->
        <form action="{{ route('articles.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="جستجوی مقاله..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">جستجو</button>
            </div>
        </form>

        <!-- جدول مقالات -->
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>شناسه</th>
                        <th>عنوان</th>
                        <th>تصویر</th>
                        <th>وضعیت</th>
                        <th>برچسب‌ها</th>
                        <th>ضمیمه‌ها</th>
                        <th>تاریخ ایجاد</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                        <tr>
                            <td>{{ $article->id }}</td>
                            <td>{{ $article->title }}</td>
                            <td>
                                @if ($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="عکس مقاله"
                                        class="article-image">
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <span
                                    class="status-badge status-{{ $article->status == 'published' ? 'published' : 'draft' }}">
                                    {{ $article->status == 'published' ? 'منتشر شده' : 'پیش‌نویس' }}
                                </span>
                            </td>
                            <td>
                                @foreach ($article->tags as $tag)
                                    <span class="badge bg-info">{{ $tag->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @if ($article->attachments->count() > 0)
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#viewAttachmentsModal{{ $article->id }}">مشاهده
                                        ضمیمه‌ها</button>
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $article->created_at->format('Y/m/d') }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editArticleModal{{ $article->id }}">ویرایش</button>
                                <form action="{{ route('articles.destroy', $article->id) }}" method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('آیا مطمئن هستید که می‌خواهید حذف کنید؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                                </form>
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#viewContentModal{{ $article->id }}">مشاهده متن</button>
                            </td>
                        </tr>

                        <!-- Modal ویرایش مقاله -->
                        <div class="modal fade" id="editArticleModal{{ $article->id }}" tabindex="-1"
                            aria-labelledby="editArticleModalLabel{{ $article->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <form action="{{ route('articles.update', $article->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        @if ($errors->any() && session('editing_article_id') == $article->id)
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editArticleModalLabel{{ $article->id }}">
                                                ویرایش مقاله</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="بستن"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">عنوان مقاله</label>
                                                <input type="text" name="title" class="form-control"
                                                    value="{{ old('title', $article->title) }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">متن مقاله</label>
                                                <textarea name="content" id="editorEdit{{ $article->id }}" class="form-control" rows="6">{{ old('content', $article->content) }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">وضعیت</label>
                                                <select name="status" class="form-select">
                                                    <option value="draft"
                                                        {{ $article->status == 'draft' ? 'selected' : '' }}>پیش‌نویس
                                                    </option>
                                                    <option value="published"
                                                        {{ $article->status == 'published' ? 'selected' : '' }}>منتشر
                                                        شده</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">برچسب‌ها</label>
                                                <select name="tags[]" multiple class="form-select select2-tags"
                                                    id="tagsEdit{{ $article->id }}" style="width: 100%">
                                                    @foreach ($allTags as $tag)
                                                        <option value="{{ $tag->id }}"
                                                            {{ in_array($tag->id, old('tags', $article->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                            {{ $tag->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!-- نمایش تصویر اصلی -->
                                            <div class="mb-3">
                                                <label class="form-label">تصویر مقاله</label>
                                                <input type="file" name="image" class="form-control">
                                                @if ($article->image)
                                                    <div class="mt-2 d-flex align-items-center">
                                                        <img src="{{ asset('storage/' . $article->image) }}"
                                                            alt="عکس مقاله" width="80" class="me-2">
                                                    </div>
                                                @endif
                                            </div>
                                            <!-- نمایش ضمیمه‌ها با امکان حذف جداگانه -->
                                            <div class="mb-3">
                                                <label class="form-label">ضمیمه‌ها</label>
                                                @if ($article->attachments->count() > 0)
                                                    <ul class="list-unstyled">
                                                        @foreach ($article->attachments as $attachment)
                                                            <li
                                                                class="d-flex align-items-center justify-content-between mb-2">
                                                                <div>
                                                                    @if (strpos($attachment->file_type, 'video/') === 0)
                                                                        <video controls>
                                                                            <source
                                                                                src="{{ asset('storage/' . $attachment->file_path) }}"
                                                                                type="{{ $attachment->file_type }}">
                                                                            مرورگر شما از پخش ویدیو پشتیبانی نمی‌کند.
                                                                        </video>
                                                                    @else
                                                                        <img src="{{ asset('storage/' . $attachment->file_path) }}"
                                                                            alt="{{ $attachment->file_name }}"
                                                                            style="max-width:80px; max-height:80px;">
                                                                    @endif
                                                                </div>
                                                                <button type="button"
                                                                    class="btn btn-danger btn-sm ms-2"
                                                                    onclick="if(confirm('آیا مطمئن هستید که می‌خواهید این ضمیمه را حذف کنید؟')){ document.getElementById('delete-attachment-{{ $attachment->id }}').submit(); }">حذف</button>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <p>-</p>
                                                @endif
                                                <!-- آپلود ضمیمه‌های جدید -->
                                                <input type="file" name="attachments[]" class="form-control"
                                                    multiple>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">ذخیره</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">بستن</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal مشاهده متن مقاله -->
                        <div class="modal fade" id="viewContentModal{{ $article->id }}" tabindex="-1"
                            aria-labelledby="viewContentModalLabel{{ $article->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewContentModalLabel{{ $article->id }}">
                                            متن مقاله: {{ $article->title }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="بستن"></button>
                                    </div>
                                    <div class="modal-body">
                                        <textarea id="viewEditor{{ $article->id }}" class="d-none">{{ $article->content }}</textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">بستن</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal مشاهده ضمیمه‌ها -->
                        <div class="modal fade" id="viewAttachmentsModal{{ $article->id }}" tabindex="-1"
                            aria-labelledby="viewAttachmentsModalLabel{{ $article->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewAttachmentsModalLabel{{ $article->id }}">
                                            ضمیمه‌های مقاله: {{ $article->title }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="بستن"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-unstyled">
                                            @foreach ($article->attachments as $attachment)
                                                <li class="mb-3">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#viewAttachmentDetailsModal{{ $attachment->id }}">
                                                        @if (strpos($attachment->file_type, 'image/') === 0)
                                                            <img src="{{ asset('storage/' . $attachment->file_path) }}"
                                                                alt="{{ $attachment->file_name }}"
                                                                style="max-width:80px; max-height:80px;">
                                                        @elseif (strpos($attachment->file_type, 'video/') === 0)
                                                            <video controls style="max-width:80px; max-height:80px;">
                                                                <source
                                                                    src="{{ asset('storage/' . $attachment->file_path) }}"
                                                                    type="{{ $attachment->file_type }}">
                                                                مرورگر شما از پخش ویدیو پشتیبانی نمی‌کند.
                                                            </video>
                                                        @else
                                                            <span
                                                                class="badge bg-primary">{{ $attachment->file_name }}</span>
                                                        @endif
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">بستن</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal جزئیات ضمیمه -->
                        @foreach ($article->attachments as $attachment)
                            <div class="modal fade" id="viewAttachmentDetailsModal{{ $attachment->id }}"
                                tabindex="-1" aria-labelledby="viewAttachmentDetailsModalLabel{{ $attachment->id }}"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"
                                                id="viewAttachmentDetailsModalLabel{{ $attachment->id }}">
                                                جزئیات ضمیمه: {{ $attachment->file_name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="بستن"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            @if (strpos($attachment->file_type, 'image/') === 0)
                                                <img src="{{ asset('storage/' . $attachment->file_path) }}"
                                                    alt="{{ $attachment->file_name }}" class="w-100 h-auto">
                                            @elseif (strpos($attachment->file_type, 'video/') === 0)
                                                <video controls class="w-100">
                                                    <source src="{{ asset('storage/' . $attachment->file_path) }}"
                                                        type="{{ $attachment->file_type }}">
                                                    مرورگر شما از پخش ویدیو پشتیبانی نمی‌کند.
                                                </video>
                                            @else
                                                <a href="{{ asset('storage/' . $attachment->file_path) }}"
                                                    target="_blank" class="btn btn-primary">
                                                    دانلود فایل: {{ $attachment->file_name }}
                                                </a>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">بستن</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- صفحه‌بندی -->
        <div class="mt-4">
            {{ $articles->links() }}
        </div>
    </div>

    <!-- Modal افزودن مقاله -->
    <div class="modal fade" id="addArticleModal" tabindex="-1" aria-labelledby="addArticleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addArticleModalLabel">افزودن مقاله جدید</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="بستن"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">عنوان مقاله</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">متن مقاله</label>
                            <textarea name="content" id="editorAdd" class="form-control" rows="6">{{ old('content', '') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">وضعیت</label>
                            <select name="status" class="form-select">
                                <option value="draft">پیش‌نویس</option>
                                <option value="published">منتشر شده</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">برچسب‌ها</label>
                            <select name="tags[]" multiple class="form-select select2-tags" id="tagsAdd"
                                style="width: 100%">
                                @foreach ($allTags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">تصویر مقاله</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ضمیمه‌ها</label>
                            <input type="file" name="attachments[]" class="form-control" multiple>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">ثبت مقاله</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if ($errors->any() && session('editing_article_id'))
        <script>
            $(document).ready(function() {
                $('#editArticleModal{{ session('editing_article_id') }}').modal('show');
            });
        </script>
    @endif

    {{-- فرم‌های حذف ضمیمه در انتهای صفحه --}}
    @foreach ($articles as $article)
        @foreach ($article->attachments as $attachment)
            <form id="delete-attachment-{{ $attachment->id }}" method="POST"
                action="{{ route('attachments.destroy', $attachment->id) }}" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        @endforeach
    @endforeach

    <!-- Bootstrap, jQuery, Select2, CKEditor 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        // ذخیره instanceهای CKEditor
        window.editors = {};

        $(document).ready(function() {
            // CKEditor برای فرم افزودن
            if (document.getElementById('editorAdd')) {
                ClassicEditor.create(document.getElementById('editorAdd'), {
                    language: {
                        ui: 'fa',
                        content: 'fa'
                    },
                }).catch(error => console.error(error));
            }

            // Select2 برای فرم افزودن
            if (document.getElementById('tagsAdd')) {
                $('#tagsAdd').select2({
                    placeholder: "برچسب‌ها را انتخاب کنید",
                    allowClear: true,
                    width: '100%',
                    dir: 'rtl',
                    dropdownParent: $('#addArticleModal'),
                });
            }

            // ویرایش مقاله برای هر modal
            @foreach ($articles as $article)
                $('#editArticleModal{{ $article->id }}').on('shown.bs.modal', function() {
                    // Select2 فقط اگر قبلاً فعال نشده
                    if (!$('#tagsEdit{{ $article->id }}').hasClass("select2-hidden-accessible")) {
                        $('#tagsEdit{{ $article->id }}').select2({
                            placeholder: "برچسب‌ها را انتخاب کنید",
                            allowClear: true,
                            width: '100%',
                            dir: 'rtl',
                            dropdownParent: $('#editArticleModal{{ $article->id }}'),
                        });
                    }

                    // CKEditor فقط اگر قبلاً فعال نشده
                    if (!$('#editorEdit{{ $article->id }}').next('.ck-editor').length) {
                        ClassicEditor.create(document.getElementById('editorEdit{{ $article->id }}'), {
                            language: {
                                ui: 'fa',
                                content: 'fa'
                            },
                        }).then(editor => {
                            window.editors['editorEdit{{ $article->id }}'] = editor;
                        }).catch(error => console.error(error));
                    }
                });
            @endforeach

            // نمایش متن مقاله با CKEditor فقط خواندنی
            @foreach ($articles as $article)
                $('#viewContentModal{{ $article->id }}').on('shown.bs.modal', function() {
                    if (!$('#viewEditor{{ $article->id }}').next('.ck-editor').length) {
                        ClassicEditor.create(document.getElementById('viewEditor{{ $article->id }}'), {
                            language: {
                                ui: 'fa',
                                content: 'fa'
                            },
                            readOnly: true,
                        }).catch(error => console.error(error));
                    }
                });
            @endforeach
        });

        // قبل از ارسال هر فرم، مقدار CKEditor را sync کن
        $('form').on('submit', function() {
            for (const key in window.editors) {
                if (window.editors.hasOwnProperty(key)) {
                    const editor = window.editors[key];
                    const textarea = document.getElementById(key);
                    if (textarea) {
                        textarea.value = editor.getData();
                    }
                }
            }
        });
    </script>
</body>

</html>

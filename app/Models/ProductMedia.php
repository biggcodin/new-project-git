<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\HasStatusText;

class ProductMedia extends Model
{
    use HasFactory, SoftDeletes, HasStatusText;

    protected $fillable = [
        'product_id',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
        'status',
        'order'
    ];

    protected $attributes = [
        'status' => true,
        'file_size' => 0,
        'order' => 0
    ];

    protected $casts = [
        'status' => 'boolean',
        'file_size' => 'integer',
        'order' => 'integer'
    ];

    // رابطه با محصول
    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault();
    }

    // اکسسور برای نمایش URL فایل
    public function getUrlAttribute()
    {
        return $this->file_path ? asset('storage/' . $this->file_path) : null;
    }

    // اکسسور برای نمایش حجم فایل به صورت خوانا
    public function getFileSizeFormattedAttribute()
    {
        $bytes = $this->file_size;
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            return $bytes . ' bytes';
        } else {
            return '0 bytes';
        }
    }

    // اکسسور برای نمایش آیکون بر اساس نوع فایل
    public function getFileIconAttribute()
    {
        $extension = pathinfo($this->file_name, PATHINFO_EXTENSION);
        
        $icons = [
            'pdf' => 'fa-file-pdf',
            'doc' => 'fa-file-word',
            'docx' => 'fa-file-word',
            'xls' => 'fa-file-excel',
            'xlsx' => 'fa-file-excel',
            'ppt' => 'fa-file-powerpoint',
            'pptx' => 'fa-file-powerpoint',
            'jpg' => 'fa-file-image',
            'jpeg' => 'fa-file-image',
            'png' => 'fa-file-image',
            'gif' => 'fa-file-image',
            'mp4' => 'fa-file-video',
            'avi' => 'fa-file-video',
            'mov' => 'fa-file-video',
            'mp3' => 'fa-file-audio',
            'wav' => 'fa-file-audio',
            'zip' => 'fa-file-archive',
            'rar' => 'fa-file-archive',
            'txt' => 'fa-file-alt',
        ];

        return $icons[$extension] ?? 'fa-file';
    }

    // اسکوپ‌های کاربردی
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function scopeImages($query)
    {
        return $query->whereIn('file_type', ['image/jpeg', 'image/png', 'image/gif', 'image/webp']);
    }

    public function scopeVideos($query)
    {
        return $query->whereIn('file_type', ['video/mp4', 'video/avi', 'video/quicktime']);
    }

    public function scopeDocuments($query)
    {
        return $query->whereNotIn('file_type', ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'video/mp4', 'video/avi', 'video/quicktime']);
    }

    // متد برای بررسی نوع فایل
    public function isImage()
    {
        return strpos($this->file_type, 'image/') === 0;
    }

    public function isVideo()
    {
        return strpos($this->file_type, 'video/') === 0;
    }

    public function isDocument()
    {
        return !$this->isImage() && !$this->isVideo();
    }
}
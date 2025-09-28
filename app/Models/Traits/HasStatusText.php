<?php
namespace App\Models\Traits;

trait HasStatusText
{
    public function getStatusTextAttribute()
    {
        // بررسی وجود فیلد status
        if (!isset($this->status)) {
            return 'تعریف نشده';
        }
        
        // اگر وضعیت null است
        if (is_null($this->status)) {
            return 'تعریف نشده';
        }
        
        // اگر وضعیت از نوع boolean است (tinyint)
        if (is_bool($this->status) || $this->status === 1 || $this->status === 0 || $this->status === '1' || $this->status === '0') {
            return ($this->status || $this->status === 1 || $this->status === '1') ? 'فعال' : 'غیرفعال';
        }
        
        // اگر وضعیت از نوع رشته/enum است
        $statuses = [
            'pending' => 'در انتظار',
            'approved' => 'تایید شده',
            'rejected' => 'رد شده',
            'published' => 'منتشر شده',
            'draft' => 'پیش‌نویس',
            'archived' => 'بایگانی شده',
            'active' => 'فعال',
            'inactive' => 'غیرفعال',
            'true' => 'فعال',
            'false' => 'غیرفعال',
            '1' => 'فعال',
            '0' => 'غیرفعال',
            'yes' => 'بله',
            'no' => 'خیر',
            'on' => 'فعال',
            'off' => 'غیرفعال'
        ];
        
        // تبدیل به string برای مقایسه
        $statusString = (string) $this->status;
        
        return $statuses[$statusString] ?? $statusString;
    }
}
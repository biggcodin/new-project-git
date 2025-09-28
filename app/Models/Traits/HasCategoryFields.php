<?php
namespace App\Models\Traits;

trait HasCategoryFields
{
    public function getStatusTextAttribute()
    {
        // اگر وضعیت خالی است
        if (empty($this->status)) {
            return 'تعریف نشده';
        }
        
        // اگر وضعیت از نوع boolean است (tinyint)
        if (is_bool($this->status) || $this->status === 1 || $this->status === 0 || $this->status === '1' || $this->status === '0') {
            return $this->status ? 'فعال' : 'غیرفعال';
        }
        
        // اگر وضعیت از نوع رشته است
        $statuses = [
            'active' => 'فعال',
            'inactive' => 'غیرفعال'
        ];
        
        return $statuses[$this->status] ?? $this->status;
    }
}
<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Traits\HasStatusText;

class HasStatusTextTest extends TestCase
{
    public function test_boolean_status()
    {
        $model = new class {
            use HasStatusText;
            public $status = true;
        };
        
        $this->assertEquals('فعال', $model->status_text);
    }
    
    public function test_boolean_status_false()
    {
        $model = new class {
            use HasStatusText;
            public $status = false;
        };
        
        $this->assertEquals('غیرفعال', $model->status_text);
    }
    
    public function test_string_status_pending()
    {
        $model = new class {
            use HasStatusText;
            public $status = 'pending';
        };
        
        $this->assertEquals('در انتظار', $model->status_text);
    }
    
    public function test_string_status_approved()
    {
        $model = new class {
            use HasStatusText;
            public $status = 'approved';
        };
        
        $this->assertEquals('تایید شده', $model->status_text);
    }
    
    public function test_null_status()
    {
        $model = new class {
            use HasStatusText;
            public $status = null;
        };
        
        $this->assertEquals('تعریف نشده', $model->status_text);
    }
    
    public function test_integer_status()
    {
        $model = new class {
            use HasStatusText;
            public $status = 1;
        };
        
        $this->assertEquals('فعال', $model->status_text);
    }
    
    public function test_integer_status_zero()
    {
        $model = new class {
            use HasStatusText;
            public $status = 0;
        };
        
        $this->assertEquals('غیرفعال', $model->status_text);
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable= ['name','image','gcash_mobile','gcash_screenshot_mobile', 'p_cod', 'p_gcash', 'p_bank', 'logo_content', 'contact_content', 'contact_number'];

    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    public static $status = [
        self::STATUS_ENABLE => 'Enable',
        self::STATUS_DISABLE => 'Disable',
    ];
}

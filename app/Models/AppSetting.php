<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'banner_ad_enable',
        'banner_ad',
        'header_background',
        'header_title',
        'header_categoory',
        'header_hide_button',
        'maintenance_mode',
        'min_version',
    ];
}

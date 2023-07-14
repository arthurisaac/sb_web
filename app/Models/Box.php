<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;
    protected $fillable = [
        'category',
        'partner',
        'user',
        'name',
        'notation',
        'notation_count',
        'price',
        'discount',
        'discount_code',
        'min_person',
        'max_person',
        'start_time',
        'end_time',
        'validity',
        'description',
        'must_know',
        'is_inside',
        'country',
        'enable',
        'image',
    ];

    public function images() {
        return $this->hasMany(ImagesBox::class, 'box');
    }
}

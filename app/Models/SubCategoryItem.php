<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoryItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'sub_category',
        'box',
    ];

    public function Box()
    {
        return $this->belongsTo(Box::class, 'box')->with('images');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'category',
        'title',
        'description',
        'image',
    ];

    public function Items()
    {
        return $this->hasMany(SubCategoryItem::class, 'sub_category')->with("Box");
    }
}

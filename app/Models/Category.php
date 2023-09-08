<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'isVisible',
        'image',
        'order',
    ];

    public function SubCategory() {
        return $this->belongsTo(SubCategory::class, "category")->with("Items");
    }

    public function SubCategories() {
        return $this->hasMany(SubCategory::class, "category")->with("Items");
    }
}

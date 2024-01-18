<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'user',
        'category',
        'solde',
        'target',
    ];

    public function Category() {
        return $this->belongsTo(Category::class, 'category');
    }
}

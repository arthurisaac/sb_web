<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $fillable = [
        'user',
        'box',
    ];

    public function Box() {
        return $this->belongsTo(Box::class, 'box')->with('images');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'section',
        'box'
    ];

    public function Box() {
        return $this->belongsTo(Box::class, 'box')->with("images");
    }
}

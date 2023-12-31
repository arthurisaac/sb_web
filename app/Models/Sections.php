<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sections extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
    ];

    public function Boxes() {
        return $this->hasMany(SectionItem::class, 'section')->with("Box");
    }
}

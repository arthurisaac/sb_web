<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'experience',
        'box',
    ];
}

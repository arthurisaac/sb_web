<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderMainPage extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'type_id',
        'image',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'box',
        'user',
        'order',
        'status',
        'reservation',
    ];

    public function Box() {
        return $this->belongsTo(Box::class, 'box')->with("images");
    }
    public function User() {
        return $this->belongsTo(User::class, 'user');
    }
    public function Order() {
        return $this->belongsTo(Order::class, 'order');
    }
}

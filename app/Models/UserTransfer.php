<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTransfer extends Model
{
    use HasFactory;
    protected $fillable = [
        'user',
        'created_by',
        'amount',
        'before_amount',
        'after_amount',
        'method',
    ];

    public function User() {
        return $this->belongsTo(User::class, 'user');
    }

    public function CreatedBy() {
        return $this->belongsTo(User::class, 'created_by');
    }
}

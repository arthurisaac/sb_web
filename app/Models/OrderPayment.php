<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'order',
        'payment_method',
        'phone_number',
        'opt_code',
        'description',
        'amount',
        'status',
        'confirmation',
    ];
}

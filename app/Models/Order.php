<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user',
        'box',
        'delivery',
        'delivery_place',
        'nom_client',
        'prenom_client',
        'ville_client',
        'pays_client',
        'telephone_client',
        'mail_client',
        'promo_code',
        'total',
        'payment_method',
        'trique',
        'order_confirmation',
        'delivrey_confirmation',
        'trique'
    ];

    public function Box() {
        return $this->belongsTo(Box::class, 'box')->with("images");
    }
    public function User() {
        return $this->belongsTo(User::class, 'user');
    }
    public function Payments() {
        return $this->hasMany(OrderPayment::class, 'order');
    }
}

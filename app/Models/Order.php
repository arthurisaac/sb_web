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
        'order_confirmation',
        'delivrey_confirmation',
    ];
}

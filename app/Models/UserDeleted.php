<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDeleted extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'nom',
        'prenom',
        'email',
        'mobile',
        'country',
        'countryCode',
        'active',
        'password',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user',
        'amount',
        'subAccount',
    ];

    public function User() {
        return $this->belongsTo(User::class, 'user');
    }

    public function SubAccounts() {
        return $this->belongsTo(UserSubAccount::class, 'subAccount')->with('Category');
    }
}

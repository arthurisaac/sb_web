<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupTransfer extends Model
{
    use HasFactory;
    protected $fillable = [
        'group',
        'group-turn',
        'user',
        'amount',
        'method',
    ];

    public function User() {
        return $this->belongsTo(User::class, 'user');
    }

    public function Group() {
        return $this->belongsTo(Group::class, 'group');
    }

    public function GroupTurn() {
        return $this->belongsTo(GroupTurn::class, 'group-turn');
    }
}

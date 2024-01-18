<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'solde',
        'target',
        'subscription',
        'rate',
        'total_allowed',
        'cron',
        'description',
    ];

    public function GroupUsers()
    {
        return $this->hasMany(GroupUser::class, 'group')->with('User');
    }

    public function GroupTurn()
    {
        return $this->hasMany(GroupTurn::class, 'group');
    }

}

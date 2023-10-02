<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as AuthUser;

class User extends AuthUser
{
    use HasFactory;

    protected $guarded = 'id';

    public function pengumuman()
    {
        return  $this->hasMany(Pengumuman::class, 'user_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    // protected $guarded = 'id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function galeri()
    {
        return $this->hasMany(Galeri::class);
    }
}

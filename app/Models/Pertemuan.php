<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertemuan extends Model
{
    use HasFactory;

    protected $guarded = 'id';

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function pertemuan_materi()
    {
        return $this->hasMany(PertemuanMateri::class);
    }
}

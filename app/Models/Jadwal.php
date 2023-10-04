<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $guarded = 'id';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // isi atlet dalam suatu jadwal
    public function jadwal_isi()
    {
        return $this->hasMany(JadwalIsi::class);
    }

    public function pertemuan()
    {
        return $this->hasMany(Pertemuan::class);
    }
}

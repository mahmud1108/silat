<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as AuthAtlet;

class Atlet extends AuthAtlet
{
    use HasFactory;

    protected $guarded = 'id';

    public function kelas_usia()
    {
        return $this->belongsTo(KelasUsia::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function jadwal_isi()
    {
        return $this->hasMany(JadwalIsi::class);
    }

    public function absen()
    {
        return $this->hasMany(Absen::class);
    }
}

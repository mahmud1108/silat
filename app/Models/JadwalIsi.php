<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalIsi extends Model
{
    use HasFactory;

    protected $guarded = 'id';

    public function atlet()
    {
        return $this->belongsTo(Atlet::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }
}

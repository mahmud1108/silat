<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    protected $guarded = 'id';

    public function pertemuan()
    {
        return $this->belongsTo(Pertemuan::class);
    }


    public function atlet()
    {
        return $this->belongsTo(Atlet::class);
    }
}

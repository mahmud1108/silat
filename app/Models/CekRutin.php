<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CekRutin extends Model
{
    use HasFactory;

    public function atlet()
    {
        return  $this->belongsTo(Atlet::class);
    }
}

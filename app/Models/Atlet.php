<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atlet extends Model
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
}

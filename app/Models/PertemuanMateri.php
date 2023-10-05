<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PertemuanMateri extends Model
{
    use HasFactory;

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
}

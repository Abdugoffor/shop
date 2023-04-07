<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zakaz extends Model
{
    use HasFactory;
    public function tavar()
    {
        return $this->belongsTo(Tavar::class);

    }
}

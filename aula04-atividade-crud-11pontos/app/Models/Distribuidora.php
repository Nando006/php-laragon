<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Distribuidora extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'telefone',
    ];

    public function produtos(): HasMany {
        return $this->hasMany;
    }
}

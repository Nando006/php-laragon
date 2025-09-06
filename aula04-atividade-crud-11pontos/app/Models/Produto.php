<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'preco',
        'quantidade',
        'distribuidora_id',
        'categoria_id',
        'created_by',
    ];

    public function distribuidora(): BelongsTo {
        return $this->belongsTo(Distribuidora::class);
    }

    public function categoria(): BelongsTo {
        return $this->belongsTo(Categoria::class);
    }
    
    public function createdBy(): BelongsTo {
        return $this->belongsTo(User::class, 'created_by');
    }
}

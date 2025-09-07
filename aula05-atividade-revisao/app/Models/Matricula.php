<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Matricula extends Model
{
    use HasFactory;

    protected $fillable = [
        'curso_id',
        'aluno_id'
    ];

    // Relacionamento: Uma matricula pertence a um curso
    public function curso(): BelongsTo {
        return $this->belongsTo(Curso::class);
    }

    // Relacionamento: Uma matricula pertence a um aluno
    public function aluno(): BelongsTo {
        return $this->belongsTo(Aluno::class);
    }
}

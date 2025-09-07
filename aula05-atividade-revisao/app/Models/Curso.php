<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao'
    ];

    // Relacionamento: Um curso pode ter muitas matrículas
    public function matriculas(): BelongsToMany {
        return $this->belongsToMany(Aluno::class, 'matriculas')->withTimestamps();
    }

    // Relacionamento: Um cursor pode ter muitos alunos matriculados
    public function alunos(): BelongsToMany {
        return $this->belongsToMany(Aluno::class, 'matriculas')->withTimestamps();
    }
}

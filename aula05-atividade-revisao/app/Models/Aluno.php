<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Aluno extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'email',
        'dataNascimento'
    ];

    protected $casts = [
        'dataNascimento' => 'date'
    ];

    // Relacionamento: Um aluno pode ter muitas matrículas
    public function matriculas(): BelongsToMany {
        return $this->belongsToMany(Curso::class, 'matriculas')->withTimestamps();
    }

    // Relacionamento: Um aluno pode estar matriculado em muitos cursos
    public function cursos(): BelongsToMany {
        return $this->belongsToMany(Curso::class, 'matriculas')->withTimestamps();
    }

    // Buscar alunos por nome
    public function scopePorNome($query, $nome) {
        return $query->where('nome', 'LIKE', "%{$nome}%");
    }

    // Buscar alunos por email
    public function scopePorEmail($query, $email) {
        return $query->where('email', 'LIKE', "%{$email}%");
    }
}

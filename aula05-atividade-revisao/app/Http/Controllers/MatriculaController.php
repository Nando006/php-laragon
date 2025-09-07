<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Matricula::with(['aluno','curso'])->get();

        return [
            'status' => 200,
            'message' => 'Todas as matrículas listadas',
            'data' => $data
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validando = $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'aluno_id' => 'required|exists:alunos,id',
        ]);

        // Verifica se já existe matrícula para este aluno neste curso
        $matriculaExistente = Matricula::where('curso_id', $validando['curso_id'])->where('aluno_id', $validando['aluno_id'])->first();

        if($matriculaExistente) {
            return [
                'status' => 422,
                'message' => 'Este aluno já está matriculado'
            ];
        }

        $data = Matricula::create($validando);

        return [
            'status' => 200,
            'message' => 'Matrícula criada com sucesso',
            'data' => $data
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Matricula $matricula)
    {
        return [
            'status' => 200,
            'message' => 'Matricula encontrada!',
            'data' => $matricula->load(['aluno', 'curso']),
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Matricula $matricula)
    {
        $validando = $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'aluno_id' => 'required|exists:alunos,id'
        ]);

        // Verifica se a atualização já existe
        if(isset($validando['curso_id']) && isset($validando['aluno_id'])) {
            $matriculaExistente = Matricula::where('curso_id', $validando['curso_id'])->where('aluno_id', $validando['aluno_id'])->where('id', '!=', $matricula->id)->firts();

            if($matriculaExistente) {
                return [
                    'status' => 422,
                    'message' => 'Matricula já existe',
                ];
            }

            $matricula->update($validando);

            return [
                'status' => 200,
                'message' => 'Matrícula atualizada',
                'data' => $matricula->load(['aluno', 'curso']),
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Matricula $matricula)
    {
        return [
            'status' => 200,
            'message' => 'Matrícula deletada com sucesso',
            'data' => $matricula->delete()
        ];
    }
}

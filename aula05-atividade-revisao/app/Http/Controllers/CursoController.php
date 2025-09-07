<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return [
            'status' => 200,
            'message' => 'Todos os cursos listados com sucesso',
            'data' => Curso::with('alunos')->get()
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validando = $request->validate([
            'titulo' => 'required|string',
            'descricao' => 'nullable|string'
        ]);

        return [
            'status' => 200,
            'message' => 'Curso criado com sucesso',
            'data' => Curso::create($validando),
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Curso $curso)
    {
        return [
            'status' => 200,
            'message' => 'Curso encontrado!',
            'data' => $curso->load('alunos'),
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Curso $curso)
    {
        $validando = $request->validate([
            'titulo' => 'required|string',
            'descricao' => 'nullable|string'
        ]);

        return [
            'status' => 200,
            'message' => 'Curso atualizado com sucesso!',
            'data' => $curso->update($validando)
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curso $curso)
    {
        return [
            'status' => 200,
            'message' => 'Curso deletado com sucesso',
            'data' => $curso->delete(),
        ];
    }
}

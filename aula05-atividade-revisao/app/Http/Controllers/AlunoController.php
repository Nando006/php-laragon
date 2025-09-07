<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $consultando = Aluno::query();

        if($request->has('nome')) {
            $consultando->porNome($request->nome);
        }

        if($request->has('email')) {
            $consultando->porEmail($request->email);
        }

        $data = $consultando->with('cursos')->get();

        return [
            'status' => 200,
            'message' => 'Lista de alunos',
            'data' => $data
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validando = $request->validate([
            'nome' => 'required|string',
            'email' => 'required|string|unique:alunos,email',
            'dataNascimento' => 'nullable|string',
        ]);

        $data = Aluno::create($validando);

        return [
            'status' => 200,
            'message' => 'Aluno criado com sucesso',
            'data' => $data
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Aluno $aluno)
    {
        return [
            'status' => 200,
            'message' => 'Aluno encontrado',
            'data' => $aluno->load('cursos')
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aluno $aluno)
    {
        $validando = $request->validate([
            'nome' => 'required|string',
            'email' => 'required|string',
            'dataNascimento' => 'nullable|string'
        ]);

        return [
            'status' => 200,
            'message' => 'Aluno atualizado com sucesso',
            'data' => $aluno->update($validando)
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aluno $aluno)
    {
        return [
            'status' => 200,
            'message' => 'Aluno deletado com sucesso',
            'data' => $aluno->delete()
        ];
    }

    public function buscarPorNome(Request $request) {
        $request->validate([
            'nome' => 'requred|string'
        ]);

        $data = Aluno::porNome($request->nome)->with('cursos')->get();

        return [
            'status' => 200,
            'message' => 'Alunos encontrados por nome',
            'data' => $data
        ];
    }

    public function buscarPorEmail(Request $request) {
        $request->validate([
            'email' => 'required|email'
        ]);

        $data = Aluno::porEmail($request->email)->with('cursos')->get();

        return [
            'status' => 200,
            'message' => 'Alunos encontrados por e-mail',
            'data' => $data
        ];
    }
}

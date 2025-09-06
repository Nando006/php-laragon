<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Listar Usuário
     * @return void
     */
    public function index()
    {
        /**
         * User::all() = SELECT * FROM users;
         * User::get() = SELECT * FROM users;
         * User::paginate(5) = SELECT * FROM users LIMIT 5;
         */
        $users = User::paginate(30);

        return [
            'status' => 200,
            'message' => 'Usuários encontrados!',
            'user' => $users
        ];
    }

    /**
     * Cadastrando Usuário
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $data = $request->all();

        /**
         * INSERT INTO users ('name', 'email', 'password') VALUES ()
         */
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return [
            'status' => 200,
            'message' => 'Usuário cadastrado com sucesso!',
            'user' => $user
        ];
    }

    public function update(Request $request, $id)
    {
        /**
         * SELECT * FROM users WHERE id = ?
         */
        $user = User::find($id);

        if(!$user){
            return [
                'status' => 401,
                'message' => 'Usuário não encontrado!'
            ];
        }

        $data = $request->only(['name', 'email']);

        if($request->filled('password')){
            $data['password'] = bcrypt($request->password);
        }

        /**
         * UPDATE INTO users SET coluna01 = valor WHERE id = ?
         */
        $user->update($data);

        return [
            'status' => 200,
            'message' => 'Usuário atualizado com sucesso!',
            'user' => $user
        ];
    }

    public function destroy($id)
    {
        /**
         * SELECT * FROM users WHERE id = ?
         */
        $user = User::find($id);

        if(!$user){
            return [
                'status' => 401,
                'message' => 'Usuário não encontrado!'
            ];
        }

        $user->delete();

        return [
            'status' => 200,
            'message' => 'Usuário deletado com sucesso!'
        ];
    }
}

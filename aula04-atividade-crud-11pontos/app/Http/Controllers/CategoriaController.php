<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index() {
        return Categoria::all();
    }

    public function store(Request $request) {
        return Categoria::create($request->all());
    }

    public function show(Categoria $categoria) {
        return $categoria;
    }

    public function update(Request $request, Categoria $categoria) {
        $categoria->update($request->all());

        return $categoria;
    }

    public function destrou(Categoria $categoria) {
        $categoria->delete();
        
        return response() ->noContent();
    }
}

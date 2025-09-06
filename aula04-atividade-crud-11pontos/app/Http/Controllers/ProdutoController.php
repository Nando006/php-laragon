<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index() {
        return Produto::with(['categoria', 'distribuidora'])->get();
    }

    public function store(Request $request) {
        return Produto::create($request->all());
    }

    public function show(Produto $produto) {
        return $produto->load(['categoria', 'distribuidora']);
    }

    public function update(Request $request, Produto $produto) {
        $produto->update($request->all());

        return $produto;
    }

    public function destroy(Produto $produto) {
        $produto->delete();
        
        return response()->noContent();
    }
}

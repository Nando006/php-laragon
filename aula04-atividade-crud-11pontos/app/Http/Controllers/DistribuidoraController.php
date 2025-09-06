<?php

namespace App\Http\Controllers;

use App\Models\Distribuidora;
use Illuminate\Http\Request;

class DistribuidoraController extends Controller
{
    public function index() {
        return Distribuidora::all();
    }

    public function store(Request $request) {
        return Distribuidora::create($request->all());
    }

    public function show(Distribuidora $distribuidora) {
        return $distribuidora;
    }

    public function update(Request $request, Distribuidora $distribuidora) {
        $distribuidora->update($request->all());

        return $distribuidora;
    }

    public function destroy(Distribuidora $distribuidora) {
        $distribuidora->delete();

        return response()->noContent();
    }
}

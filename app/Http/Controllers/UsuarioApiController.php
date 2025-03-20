<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UsuarioApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Usuario::all();
        return $todos->toJson();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nuevo = new Usuario();
        $datos = $request->all();        
        $datos['clave'] = Hash::make($datos['clave']);
        $nuevo->fill($datos);
        $nuevo->save();
        return $nuevo->toJson();
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        echo $usuario->toJson();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        $usuario->fill($request->all());
        $usuario->save();
        return $usuario->toJson();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return $usuario->toJson();
    }
}

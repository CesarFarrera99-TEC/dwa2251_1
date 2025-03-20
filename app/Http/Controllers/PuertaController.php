<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PuertaController extends Controller
{
    public function entrada(){
        return view ("puerta.login");

    }
    public function validar(Request $request){

        //tengo que checar que lo que viene en peticion sea correcto
//        echo "checar si  $request->nombre_usuario tiene $request->clave ";
        $encontrado = Usuario::where('nombre_usuario', $request->nombre_usuario)->first();
        if(is_null($encontrado)){
            echo "ni te conozco";
        }else{
          if( Hash::check($request->clave , $encontrado->clave) ){
            Auth::loginUsingId($encontrado->id);
            return redirect(route('puerta.inicio'));
          }else{
            echo "no te sabes la clave";
          }
        }
    }

    public function registro(){
        return view ("puerta.registro");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function guardar(Request $request)
    {
        $nuevo = new Usuario();
        $datos = $request->all();
        if(isset($datos['clave'])) $datos['clave'] = Hash::make($datos['clave']);
        $nuevo->fill($datos);
        $nuevo->save();
        Auth::login($nuevo);
        return redirect(route('puerta.inicio'));
    }

    public function temporal(){
      return view('bienvenido');
    }

    public function salir(){
      Auth::logout();
      return redirect('/');

    }
    

}

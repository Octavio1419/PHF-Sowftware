<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;


class EntradaController extends Controller
{
    public function login(){


        return view('auth.login');
    }

    public function validar(Request $request){
        $usuario = $request->input('correo');
        $encontrado = Usuario::where('correo', $usuario)->first();
        if(is_null($encontrado)){
          //  return "USUARIO NO EXISTE";
        return redirect()->back();
        }else{
         $clave_dieron = $request->input('clave');
         $clave_guardada = $encontrado->password;

         if(Hash::check($clave_dieron,$clave_guardada)){
            Auth::login($encontrado);

             //Dirigiendo a la pagina si es admin
             $rol = $encontrado->role()->first();
             if($rol->nombre_rol == 'administrador')
                //return "ES ADMINISTRADOR ";
                return redirect(route('admin'));

             else
                //return "es cliente";
                //return redirect(route('cliente'));
             return redirect(route('cliente'));
         }else{
             //return "LA CLAVE ES INCORRECTA";
             return redirect()->back();
         }
        }
    }
    public function salir(){
        Auth::forgetUser();
        return redirect(route('entrada'));

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calificacion;
use App\Models\Curso;

class HomeController extends Controller
{
    public function votar(Request $request)
    {
        $califiacion = new Calificacion;
        $califiacion->curso_id = $request->curso_id;
        $califiacion->puntaje = $request->puntaje;
        $califiacion->save();
        
        $curso = Curso::where('id',$request->curso_id)->with(['autor','avgCalificacion'])->first();
        return response($curso);
    }
}

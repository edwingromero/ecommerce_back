<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $curso = Curso::with(['autor','avgCalificacion'])
        ->orderBy('id','desc')->get();
        return response($curso);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $curso = new Curso;
        $curso->nombre = $request->nombre;
        $curso->resumen = $request->resumen;
        $curso->autor_id = $request->autor_id;
        $curso->imagen = '';
        

        if($request->has('imagen')){
            $archivo = $request->file('imagen');
            $explode = explode('.',$archivo->getClientOriginalName());
            $nombre = date('Ymd_His').'_'.$explode[0].'.'.$archivo->getClientOriginalExtension();
            $destination = storage_path('app/public/images');
            $archivo->move($destination, $nombre);

            $curso->imagen = $nombre;
        }
        $curso->save();


        return response($curso);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $curso = Curso::where('id',$id)->with(['autor','avgCalificacion'])->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $curso = Curso::find($id);
        $curso->nombre = $request->nombre;
        $curso->resumen = $request->resumen;
        $curso->autor_id = $request->autor_id;
        $curso->save();
        return response($curso);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $curso = Curso::find($id);
        $curso->delete();
        return response($curso);
    }
}

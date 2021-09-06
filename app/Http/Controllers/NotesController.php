<?php

namespace App\Http\Controllers;
use App\Models\Notes;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    // Mostrar tareas  recien creadas o sin terminar
    public function index()
    {
    	$notes = Notes::paginate(12);
    	return view('note', compact('notes'));
    }


    //Muestra el detalle de la nota
    public function detail($id){
        $data = Notes::findOrFail($id);
        return view('detail', compact('data'));
    }

    //Función actualizar
    public function put_update(Request $request,$id){
        $request->validate([
            'title'=>'required',
            'body'=>'required'
        ]);
        $notaActualizado=Notes::findOrFail($id);
        $notaActualizado->title=$request->title;
        $notaActualizado->body=$request->body;
        $notaActualizado->save();
        return back()->with('mensaje','Se Actualizo Correctamente La Nota. !');


    }

    //Función eliminar
    public function delete($id){
        $notaDelete=Notes::findOrFail($id);
        $notaDelete->delete();
        return back()->with('mensaje','Se Elimino Correctamente La Nota !');
    }

    //Función agregar
    public function post_add(Request $request){
        /* return $request->all(); sirve para verificar */
        $request->validate([
            'title'=>'required',
            'body'=>'required'
        ]);
        $datoNuevo=new Notes;
        $datoNuevo->title=$request->title;
        $datoNuevo->body=$request->body;
        $datoNuevo->save();
        return back()->with('mensaje','Se Agrego Correctamente La Nota. !');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Escribe;

class EscritorController extends Controller
{
    

    /* 

        se quieren listar todos los libros que han sido escritos por el mismo escritor 

        se debe mostrar el id del escritor y el nombre
        tambien el id de cada libro que ha escrito y el nombre de este mismo 

        en un array que tendra una llave llamada libros
    
    */

    public function getDatosEscritores(){
        
        // esta forma me retorna la cantidad

       /*  $escritores = User::select('id','name','genero','nacionalidad')->get()
        ->each(function($item){
            $item->libros_escritos = Escribe::from('escribes as a')
            ->select('id_libro','nombre_libro','numero_paginas','fecha_publicacion')
            ->join('libros as b','a.id_libro','b.id')
            ->where('id_escritor',$item->id)
            ->count();
        }); */

    
        // esta  forma me retorna un array con los libros
        $escritores = User::select('id','name','genero','nacionalidad')->get()
        ->each(function($item){
            $item->libros_escritos = Escribe::from('escribes as a')
            ->select('id_libro','nombre_libro','numero_paginas','fecha_publicacion')
            ->join('libros as b','a.id_libro','b.id')
            ->where('id_escritor',$item->id)->get();
        });



        return $escritores;

    }






}

<?php

namespace App\Http\Controllers;

use App\Models\Editorial;
use Illuminate\Http\Request;

class EditorialController extends Controller
{
    

    /*  mostrar toda la informacion de las editoriales 
        en las que se han publicado libro con mas de 500 paginas
        cuyo autor sea mayor de 50 años 
    */

    public function consultaEditorial(){

        $editorials = Editorial::select('editorials.id','editorials.nombre_editorial','editorials.pais_editorial','l.nombre_libro','l.numero_paginas')
        ->join('libros as l','editorials.id', '=' ,'l.id_editorial')
        ->join('categorias as c','l.id_categoria','=','c.id')
        ->join('escribes as e','l.id','=','e.id_libro')
        ->join('users as u','e.id_libro','=','u.id')
        ->where('l.numero_paginas', '>', 500)
        ->whereRaw('YEAR(CURRENT_DATE) - YEAR(u.fecha_nacimiento) > 60')
        ->get();

        return $editorials;
    }


}

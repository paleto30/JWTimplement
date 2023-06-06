<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;


class LibroController extends Controller
{


    /*  
        mostrar el nombre ,genero, nacionalidad 
        de los escritores que hayan escrito un libro entre el anio 2015
        y 2020 cuyo nombre del libro no contenga la palabra 'ri'
        en su nombre, que dicho libro no pertenezca a la categoria  
        con el id 8, 4, 6
        pero que si pertenezca a las editoriales de los paises
        Tuvalo, Mexico y Spain

        mostrar ademas el nombre y el id del libro, el id y nombre
        de la categori y tambien el id y nombre de la editorial
        ordenar alfabeticamente por el nombre del autor

    */

    
    public function obtenerEscritos(){

        $result = User::join('escribes', 'users.id','=','escribes.id_escritor')
        ->join('libros', 'escribes.id_libro', '=', 'libros.id')
        ->join('categorias', 'libros.id_categoria','=', 'categorias.id')
        ->join('editorials', 'libros.id_editorial', '=', 'editorials.id')
        ->select('users.name','users.genero','users.nacionalidad','libros.id as id_libro','libros.nombre_libro','categorias.id as id_categoria', 'categorias.nombre_categoria','editorials.id as id_editorial','editorials.nombre_editorial','escribes.anio')
        ->where('libros.nombre_libro','NOT LIKE', '%ri%')
        ->whereYear('escribes.anio', '>=',2015)
        ->whereYear('escribes.anio', '<=',2020)
        ->whereNotIn('categorias.id', [8,4,6])
        ->whereIn('editorials.pais_editorial', ['Tuvalo','Mexico','Spain'])
        ->orderBy('users.name')
        ->get();


        return ['resgistros:' =>$result];

        
    }

}
 
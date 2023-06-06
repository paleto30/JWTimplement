<?php

namespace App\Http\Controllers;

use App\Models\Escribe;
use App\Models\Libro;
use App\Models\User;
use Carbon\Carbon;
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

     /**
    *   
    *   @author Andres Galvis
    *   
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

        return response()->json(['resgistros:' =>$result],200);
        
    }





   
    /* 
        realizar un endpoint que permita agregar un nuevo libro
        a que categoria pertenece y cual fue su editorial
        se debe verificar que el libro no este ya registrado

        agregar tambien un nuevo registro de escribe
    */

     /**
    *   
    *   @author Andres Galvis
    *   
    *   @param nombre_libro
    *   @param numero_paginas
    *   @param fecha_publicacion
    *   @param id_categoria
    *   @param id_editorial 
    *   @param id_escritor
    */
    /*  
        nombre_libro | numero_paginas | fecha_publicacion | id_categoria | id_editorial
        id_escritor
    */
    public function addNewBook(Request $req)
    {
        $Book = $req->all();
        $verifyBook = Libro::where('libros.nombre_libro',$req->nombre_libro)->value('id');
        $escritor = User::find($req->id_escritor);

        if (is_null($verifyBook) && !is_null($escritor)) {
            
            $newBook = new Libro;
            $newBook->nombre_libro = $req->nombre_libro;
            $newBook->numero_paginas = $req->numero_paginas;
            $newBook->fecha_publicacion = $req->fecha_publicacion;
            $newBook->id_categoria = $req->id_categoria;
            $newBook->id_editorial = $req->id_editorial; 
            
            if ($newBook->save()) {

                $escribe = new Escribe;
                $escribe->id_libro = $newBook->id;
                $escribe->id_escritor = $escritor->id;
                $escribe->anio = Carbon::now()->format('Y-m-d');

                $escribe->save();
            } 

            return response()->json([
                'message'=> 'Successful',
                'newBook' => $Book
            ],201);
        }
        return response()->json([
            'message' => 'El libro ya existe',
            'data' => Libro::where('libros.nombre_libro',$req->nombre_libro)->get()
        ],200);
    }




    /**
    *   
    *   @author Andres Galvis
    *   
    *   @param  nombre_libro
    *
    */

    /*  
        funcion que me permite busacar un libro por polabras de su nombre
    */
    public function getOneByName(Request $req)
    {
        $book = Libro::where('nombre_libro', 'LIKE' , "%$req->nombre_libro%")->get();
        return response()->json([
            'data' => $book
        ], 200);

    }





    /* 
        crear la funcion actualizar un registro de un libro
    */
    /**
    *   
    *   @author Andres Galvis
    *   
    *   @param  id
    *   
    */

    public function updateBook(Request $req)
    {   

        $bookUp = Libro::find($req->id);
        
        if (is_null($bookUp)) {        
            return response()->json(['error'=> 'libro no encontrado'],404);
        }

        if ($req->has('nombre_libro')) {
            $bookUp->nombre_libro = $req->nombre_libro;
        }

        if ($req->has('numero_paginas')) {
            $bookUp->numero_paginas = $req->numero_paginas;
        }        

        if ($req->has('fecha_publicacion')) {
            $bookUp->fecha_publicacion = $req->fecha_publicacion;
        } 

        if ($req->has('fecha_publicacion')) {
            $bookUp->fecha_publicacion = $req->fecha_publicacion;
        }

        if ($req->has('id_categoria')) {
            $bookUp->id_categoria = $req->id_categoria;
        }

        if ($req->has('id_editorial')) {
            $bookUp->id_editorial = $req->id_editorial;
        }

        if ($bookUp->isDirty()) {
            $bookUp->save();
            return response()->json([
                'message' => 'Updated Successful',
                'dataSend' => $bookUp 
            ],201);
        }else{
            return response()->json([
                'message' => 'No has cambiado nada',
            ],200);
        }
 
        
    }



}
 
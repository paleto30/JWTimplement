<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LibroController;
use App\Http\Controllers\EditorialController;
use App\Http\Controllers\EscritorController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/* 
Route::group([
    'middleware'=>'api',
    'prefix'=> 'auth'
], function($route){
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
}); */


Route::get('libros', [LibroController::class, 'obtenerEscritos']);

Route::get('escritores',[EscritorController::class, 'getDatosEscritores']);

Route::get('editorial',[EditorialController::class, 'consultaEditorial']);
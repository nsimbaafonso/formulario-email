<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;

/*Route::get('/', function () {
    return view('welcome');
});*/

//Rotas do site
Route::get("/", [SiteController::class, "index"])->name("site.index");
Route::post("/enviar", [SiteController::class, "enviar"])->name("site.enviar");

Route::get("/form-ajax", [SiteController::class, "indexAjax"])->name("site.indexAjax");
Route::post("/enviar-ajax", [SiteController::class, "enviarAjax"])->name("site.enviarAjax");

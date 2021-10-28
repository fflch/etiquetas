<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtiquetaController;


Route::get('/etiquetas',[EtiquetaController::class,'etiquetas']);

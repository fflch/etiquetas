<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtiquetaController;

Route::get('/', [EtiquetaController::class, 'index']);
Route::post('/gera-pdf', [EtiquetaController::class, 'geraEtiqueta']);
Route::get('/download', [EtiquetaController::class, 'download']);

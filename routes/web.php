<?php

use Illuminate\Support\Facades\Route;
use App\Models\Servicio;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\ServicioPdfController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/servicios/{servicio}/pdf', ServicioPdfController::class)->name('servicios.pdf');
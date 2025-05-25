<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
use Barryvdh\DomPDF\Facade\Pdf;
class ServicioPdfController extends Controller
{
    public function __invoke(Servicio $servicio)
    {
        $pdf = Pdf::loadView('pdf.servicio', compact('servicio'));
        return $pdf->download('servicio_'.$servicio->id.'.pdf');
    }
}

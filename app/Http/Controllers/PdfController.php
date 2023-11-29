<?php

namespace App\Http\Controllers;

//use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{

    public function index()
    {
        Carbon::setLocale('es');
        $date = Carbon::now();
        $pdf = Pdf::loadView('reports/constancia_inscripcion', [
            'fecha' => $date,
        ]);
        //->month;
        return $pdf->stream("constancia_inscripcion.pdf", array("Attachment" => false));
    }
}

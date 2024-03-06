<?php

namespace App\Http\Controllers;

//use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{

    public function constancia_inscripcion()
    {
        Carbon::setLocale('es');
        $date = Carbon::now();
        $pdf = Pdf::loadView('reports/constancia_inscripcion', [
            'fecha' => $date,
        ]);
        return $pdf->stream("constancia_inscripcion.pdf", array("Attachment" => false));
    }

    public function constancia_estudios()
    {
        Carbon::setLocale('es');
        $date = Carbon::now();
        $pdf = Pdf::loadView('reports/constancia_estudios', [
            'fecha' => $date,
        ]);
        return $pdf->stream("constancia_estudios.pdf", array("Attachment" => false));
    }

    public function constancia_trabajo()
    {
        Carbon::setLocale('es');
        $date = Carbon::now();
        $pdf = Pdf::loadView('reports/constancia_trabajo', [
            'fecha' => $date,
        ]);
        return $pdf->stream("constancia_trabajo.pdf", array("Attachment" => false));
    }

    public function constancia_retiro(Request $request)
    {
        Carbon::setLocale('es');
        $date = Carbon::now();
        $pdf = Pdf::loadView('reports/constancia_retiro', [
            'fecha' => $date,
            'motivo' => $request->query('motivo'),
            'representante' => $request->query('representante'),
            'ci' => $request->query('ci'),
        ]);
        return $pdf->stream("constancia_retiro.pdf", array("Attachment" => false));
    }

    public function constancia_prosecucion(Request $request)
    {
        Carbon::setLocale('es');
        $date = Carbon::now();
        $pdf = Pdf::loadView('reports/constancia_prosecucion', [
            'fecha' => $date,
        ]);
        return $pdf->stream("constancia_prosecucion.pdf", array("Attachment" => false));
    }
}

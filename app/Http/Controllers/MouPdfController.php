<?php

namespace App\Http\Controllers;

use App\Models\Mou;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class MouPdfController extends Controller
{
    public function downloadPdf()
    {
        $mous = Mou::all();

        $pdf = Pdf::loadView('mou_template', ['mous' => $mous]);

        return $pdf->download('mou.pdf');
    }
}

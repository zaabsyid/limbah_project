<?php

namespace App\Http\Controllers;

use App\Models\Mou;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class MouPdfController extends Controller
{
    public function previewDraft($id)
    {
        // Ambil data MoU berdasarkan ID
        $mou = Mou::with(['customer', 'province', 'city'])->findOrFail($id);

        // Buat PDF dengan data MoU yang spesifik
        $pdf = Pdf::loadView('draft_mou_template', ['mou' => $mou]);

        // Tampilkan PDF di browser sebagai preview draft
        return $pdf->stream("draft_mou_{$mou->mou_number}.pdf");
    }

    public function downloadPdf($id)
    {
        // Ambil data MoU berdasarkan ID
        $mou = Mou::with(['customer', 'province', 'city'])->findOrFail($id);

        // Buat PDF dengan data MoU yang spesifik
        $pdf = Pdf::loadView('mou_template', ['mou' => $mou]);

        // Download PDF sebagai file final
        return $pdf->download("mou_{$mou->mou_number}.pdf");
    }
}

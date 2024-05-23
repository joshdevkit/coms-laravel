<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class PDFController extends Controller
{
    public function generatePdf()
    {
        $dompdf = new Dompdf();
        $html = view('admin.project-costing.pdf')->render(); // Render the PDF view
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return $dompdf->stream('document.pdf');
    }
}

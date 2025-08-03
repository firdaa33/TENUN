<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\View;

class InvoiceController extends Controller
{
    public function show(Order $order)
    {
        return view('admin.invoice-pdf', compact('order'));
    }

    public function download(Order $order)
    {
        $pdf = Pdf::loadView('admin.invoice-pdf', compact('order'));
        return $pdf->download('invoice-' . $order->invoice_number . '.pdf');
    }

   public function downloadPdf(Order $order)
{
    $order->load('items.product', 'user');

    $pdf = Pdf::loadView('invoice', compact('order'))
        ->setPaper([0, 0, 1280, 720]); // Ukuran 16:9 pixel-based (1280x720)

    return $pdf->download('invoice-' . $order->invoice_number . '.pdf');
}
}

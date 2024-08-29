<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Transaction::with('transactionDetails.menu');

        if ($startDate && $endDate) {
            $startDateTime = $startDate . ' 00:00:00';
            $endDateTime = $endDate . ' 23:59:59';

            $query->whereBetween('created_at', [$startDateTime, $endDateTime]);
        }

        $transactions = $query->paginate(10);

        return view('admin.admin_penjualan', compact('transactions', 'startDate', 'endDate'));
    }

    public function downloadPDF(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Transaction::with('transactionDetails.menu');

        if ($startDate && $endDate) {
            $startDateTime = $startDate . ' 00:00:00';
            $endDateTime = $endDate . ' 23:59:59';

            $query->whereBetween('created_at', [$startDateTime, $endDateTime]);
        }

        $transactions = $query->get();

        $pdf = PDF::loadView('pdf.admin_penjualan_pdf', compact('transactions'));
        return $pdf->download('penjualan.pdf');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Get date range from request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Transaction::query();

        // Apply date filter if provided
        if ($startDate && $endDate) {
            // Convert dates to include full day for end date
            $startDateTime = $startDate . ' 00:00:00';
            $endDateTime = $endDate . ' 23:59:59';

            $query->whereBetween('created_at', [$startDateTime, $endDateTime]);
        }

        // Filter by status 'selesai' and 'konfirmasi'
        $query->whereIn('status', ['selesai', 'konfirmasi']);

        // Apply pagination
        $transactions = $query->paginate(10);

        return view('admin.admin_fcfs', compact('transactions', 'startDate', 'endDate'));
    }

    public function downloadPdf(Request $request)
    {
        // Get date range from request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Transaction::query();

        // Apply date filter if provided
        if ($startDate && $endDate) {
            // Convert dates to include full day for end date
            $startDateTime = $startDate . ' 00:00:00';
            $endDateTime = $endDate . ' 23:59:59';

            $query->whereBetween('created_at', [$startDateTime, $endDateTime]);
        }

        // Filter by status 'selesai' and 'konfirmasi'
        $query->whereIn('status', ['selesai', 'konfirmasi']);

        $transactions = $query->get();

        // Generate PDF
        $pdf = Pdf::loadView('pdf.admin_fcfs_pdf', compact('transactions'));
        return $pdf->download('transactions.pdf');
    }
}

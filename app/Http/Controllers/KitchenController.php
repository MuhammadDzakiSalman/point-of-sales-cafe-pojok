<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KitchenController extends Controller
{
    public function index()
    {
        return view('dapur.kitchen');
    }

    public function getTransactions()
    {
        $processedTransactions = Transaction::with(['table', 'transactionDetails.menu'])
            ->where('status', 'diproses')
            ->whereHas('table', function ($query) {
                $query->where('nomor_meja', '!=', 0);
            })
            ->get();

        $takeawayTransactions = Transaction::with(['table', 'transactionDetails.menu'])
            ->where('status', 'diproses')
            ->whereHas('table', function ($query) {
                $query->where('nomor_meja', 0);
            })
            ->get();

        return response()->json([
            'processedTransactions' => $processedTransactions,
            'takeawayTransactions' => $takeawayTransactions,
        ]);
    }

    public function updateStatus(Request $request)
    {
        $transaction = Transaction::find($request->id);
        if ($transaction) {
            $transaction->status = 'selesai';
            $transaction->selesai = Carbon::now();
            $transaction->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }
}

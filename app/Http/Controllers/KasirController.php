<?php

namespace App\Http\Controllers;

use App\Models\Table;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class KasirController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_meja' => 'required|string|max:255',
            'nomor_meja' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        Table::create([
            'nama_meja' => $validated['nama_meja'],
            'nomor_meja' => $validated['nomor_meja'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('kasir.index')->with('success', 'Meja berhasil ditambahkan!');
    }
    
    public function index()
    {
        return view('kasir.kasir');
    }

    public function processTransaction(Transaction $transaction)
    {
        $transaction->status = 'diproses';
        $transaction->diproses = now(); // Menyimpan waktu proses saat ini
        $transaction->save();

        return redirect()->route('kasir.index')->with('success', 'Transaksi berhasil diproses!');
    }

    public function confirmedTransaction(Transaction $transaction)
    {
        $transaction->status = 'konfirmasi';
        $transaction->konfirmasi = now(); // Menyimpan waktu proses saat ini
        $transaction->save();

        return redirect()->route('kasir.index')->with('success', 'Transaksi berhasil diserahkan ke pelanggan!');
    }

    public function getTransactions()
    {
        $transactions = Transaction::with(['details.menu', 'table'])->where('status', 'menunggu')->get();
        $completedTransactions = Transaction::with(['details.menu', 'table'])->where('status', 'selesai')->get();

        return response()->json([
            'transactions' => $transactions,
            'completedTransactions' => $completedTransactions,
        ]);
    }
}

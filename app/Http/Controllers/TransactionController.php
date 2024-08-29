<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Table;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TransactionDetails;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TransactionController extends Controller
{
    public function index()
    {
        return view('order');
    }

    public function getMenus()
    {
        $menus = Menu::all();

        return response()->json(['menus' => $menus]);
    }

    public function getTables()
    {
        $tables = Table::all();

        return response()->json(['tables' => $tables]);
    }

    public function submitOrder(Request $request)
    {
        $validated = $request->validate([
            'table_id' => 'required|exists:tables,id',
            'payment_method' => 'required|in:tunai',
            'items' => 'required|array',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $total = 0;
        $totalPreparationTime = 0;
        $processedMenuIds = [];

        foreach ($validated['items'] as $item) {
            $menu = Menu::find($item['menu_id']);
            $total += $menu->harga * $item['quantity'];

            // Tambahkan waktu_pembuatan hanya sekali per jenis menu
            if (!in_array($item['menu_id'], $processedMenuIds)) {
                $timeParts = explode(':', $menu->waktu_pembuatan);
                $preparationTimeInSeconds = $timeParts[0] * 3600 + $timeParts[1] * 60 + $timeParts[2];
                $totalPreparationTime += $preparationTimeInSeconds;
                $processedMenuIds[] = $item['menu_id'];
            }
        }

        $estimatedTime = now()->addSeconds($totalPreparationTime);

        DB::beginTransaction();
        try {
            $transaction = Transaction::create([
                'table_id' => $validated['table_id'],
                'metode_pembayaran' => $validated['payment_method'],
                'total' => $total,
                'estimasi' => $estimatedTime,
                'status' => 'menunggu',
                'menunggu' => now(),
            ]);

            foreach ($validated['items'] as $item) {
                TransactionDetails::create([
                    'transaction_id' => $transaction->id,
                    'menu_id' => $item['menu_id'],
                    'quantity' => $item['quantity'],
                ]);
            }

            // Update status meja menjadi false, kecuali nomor_meja adalah 0
            $table = Table::find($validated['table_id']);
            if ($table->nomor_meja != 0) {
                $table->status = false;
                $table->save();
            }

            DB::commit();
            return response()->json(['message' => 'Order successfully created']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Order creation failed', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'meja_id' => 'required|exists:tables,id',
            'total' => 'required|integer',
            'order_items' => 'required|array',
            'order_items.*.menu_id' => 'required|exists:menus,id',
            'order_items.*.quantity' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|in:tunai,non-tunai',
        ]);

        $totalPreparationTime = 0;
        $processedMenuIds = [];

        foreach ($validatedData['order_items'] as $item) {
            $menu = Menu::find($item['menu_id']);
            $timeParts = explode(':', $menu->waktu_pembuatan);
            $preparationTimeInSeconds = $timeParts[0] * 3600 + $timeParts[1] * 60 + $timeParts[2];

            if (!in_array($item['menu_id'], $processedMenuIds)) {
                $totalPreparationTime += $preparationTimeInSeconds;
                $processedMenuIds[] = $item['menu_id'];
            }
        }

        $estimatedTime = now()->addSeconds($totalPreparationTime);

        DB::beginTransaction();
        try {
            $order = Transaction::create([
                'table_id' => $validatedData['meja_id'],
                'total' => $validatedData['total'],
                'metode_pembayaran' => $validatedData['metode_pembayaran'],
                'estimasi' => $estimatedTime,
                'menunggu' => now(),
            ]);

            foreach ($validatedData['order_items'] as $item) {
                TransactionDetails::create([
                    'order_id' => $order->id,
                    'menu_id' => $item['menu_id'],
                    'quantity' => $item['quantity'],
                ]);
            }

            $table = Table::find($validatedData['meja_id']);
            if ($table->nomor_meja != 0) {
                $table->status = false;
                $table->save();
            }

            DB::commit();
            return response()->json(['success' => true, 'order' => $order], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Order creation failed', 'error' => $e->getMessage()], 500);
        }
    }

    public function generateBill($id)
    {
        $transaction = Transaction::with('details.menu', 'table')->findOrFail($id);
        $qrCode = base64_encode(QrCode::format('png')->size(200)->generate(route('transaction.details', ['id' => $id])));

        $pdf = PDF::loadView('bills.bill', compact('transaction', 'qrCode'));
        return $pdf->download('bill.pdf');
    }

    public function show($id)
    {
        $transaction = Transaction::with('details.menu', 'table')->findOrFail($id);
        return view('transaction.details', compact('transaction'));
    }
}

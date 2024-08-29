<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        $tables = Table::all();
        return view('kasir.meja', compact('tables'));
    }

    public function create()
    {
        return view('kasir.tambah_meja');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_meja' => 'required|string|max:255',
            'nomor_meja' => 'required|integer',
            'status' => 'required|boolean',
        ]);

        Table::create($validated);

        return redirect()->route('meja.index')->with('success', 'Meja berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $table = Table::findOrFail($id);
        return view('kasir.edit_meja', compact('table'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_meja' => 'required|string|max:255',
            'nomor_meja' => 'required|integer',
            'status' => 'required|boolean',
        ]);

        $table = Table::findOrFail($id);
        $table->update($validated);

        return redirect()->route('meja.index')->with('success', 'Meja berhasil diupdate!');
    }

    public function destroy($id)
    {
        $table = Table::findOrFail($id);
        $table->delete();

        return redirect()->back()->with('success', 'Meja berhasil dihapus!');
    }
}

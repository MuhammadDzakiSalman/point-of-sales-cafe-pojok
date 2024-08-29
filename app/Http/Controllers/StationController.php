<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StationController extends Controller
{
    public function index()
    {
        $stations = Station::all();
        return view('admin.admin_station', compact('stations'));
    }

    public function create()
    {
        return view('admin.tambah_station');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_station' => 'required|string|max:255',
            'keterangan' => 'required',
            'jumlah_pekerja' => 'required|string|max:255',
        ]);

        Station::create($validated);

        return redirect()->route('station.index')->with('success', 'Station berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $station = Station::findOrFail($id);
        return view('admin.edit_Station', compact('station'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_station' => 'required|string|max:255',
            'keterangan' => 'required',
            'jumlah_pekerja' => 'required|string|max:255',
        ]);

        $station = Station::findOrFail($id);
        $station->update($validated);

        return redirect()->route('station.index')->with('success', 'Station berhasil diupdate!');
    }

    public function destroy($id)
    {
        $station = Station::findOrFail($id);
        $station->delete();

        return redirect()->back()->with('success', 'Station berhasil dihapus!');
    }

}

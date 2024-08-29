<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input('filter');
        $show = $request->input('show', 10);

        if ($filter) {
            $menus = Menu::where('kategori', $filter)->paginate($show);
        } else {
            $menus = Menu::paginate($show);
        }

        return view('admin.admin_menu', compact('menus', 'filter', 'show'));
    }

    public function create()
    {
        return view('admin.tambah_menu');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_menu' => 'required|string|max:255',
            'harga' => 'required|integer',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'waktu_pembuatan' => 'required',
            'kategori' => 'required|in:makanan,minuman',
            'status' => 'required|in:0,1',
        ]);

        $gambarPath = $request->file('gambar')->store('public/menu_images');
        $gambarName = basename($gambarPath);

        Menu::create([
            'nama_menu' => $validated['nama_menu'],
            'harga' => $validated['harga'],
            'gambar' => $gambarName,
            'waktu_pembuatan' => $validated['waktu_pembuatan'],
            'kategori' => $validated['kategori'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan!');
    }


    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        $menu->delete();

        return redirect()->back()->with('success', 'Menu berhasil dihapus!');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);

        return view('admin.edit_menu', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $validated = $request->validate([
            'nama_menu' => 'required|string|max:255',
            'harga' => 'required|integer',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'waktu_pembuatan' => 'required',
            'kategori' => 'required|in:makanan,minuman',
            'status' => 'required|in:0,1',
        ]);

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('public/menu_images');
            $gambarName = basename($gambarPath);
            $menu->gambar = $gambarName;
        }

        $menu->nama_menu = $validated['nama_menu'];
        $menu->harga = $validated['harga'];
        $menu->waktu_pembuatan = $validated['waktu_pembuatan'];
        $menu->kategori = $validated['kategori'];
        $menu->status = $validated['status'];

        $menu->save();

        return redirect()->route('menu.index')->with('success', 'Menu berhasil diupdate!');
    }
}

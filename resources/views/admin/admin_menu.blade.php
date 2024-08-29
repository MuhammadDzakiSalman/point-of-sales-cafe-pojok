@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center my-4 align-items-center">
            <h5 class="mb-0">Admin</h5>
        </div>
        <div class="d-flex justify-content-center my-3 align-items-center gap-2 flex-wrap">
            <a class="btn btn-outline-primary d-flex align-items-center active" href="{{ url('admin/menu') }}"
                role="button">Menu</a>
            <a class="btn btn-outline-primary d-flex align-items-center"
                href="{{ url('admin/station') }}"role="button">Station</a>
            <a class="btn btn-outline-primary d-flex align-items-center"
                href="{{ url('admin/penjualan') }}"role="button">Penjualan</a>
            <a class="btn btn-outline-primary d-flex align-items-center"
                href="{{ url('admin/fcfs') }}"role="button">FCFS</a>
        </div>
        <div class="card mb-3 shadow-none">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Menu</h5>
                    <div class="d-flex gap-2">
                        <a class="btn btn-primary btn-sm" href="{{ route('menu.create') }}" role="button">Tambah</a>
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle btn-sm" aria-expanded="false"
                                data-bs-toggle="dropdown" type="button">Filter</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                    href="{{ route('menu.index', ['filter' => 'makanan']) }}">Makanan</a>
                                <a class="dropdown-item"
                                    href="{{ route('menu.index', ['filter' => 'minuman']) }}">Minuman</a>
                                <a class="dropdown-item" href="{{ route('menu.index') }}">Semua</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="dataTable-7" class="table-responsive border-0 shadow-none table mt-2" role="grid"
                    aria-describedby="dataTable_info">
                    <table id="dataTable" class="table my-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Menu</th>
                                <th>Gambar</th>
                                <th>Kategori</th>
                                <th>Estimasi Pembuatan</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menus as $menu)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $menu->nama_menu }}</td>
                                    <td><img class="img-fluid" src="{{ asset('storage/menu_images/' . $menu->gambar) }}"
                                            width="100" /></td>
                                    <td>{{ ucfirst($menu->kategori) }}</td>
                                    <td>{{ ucfirst($menu->waktu_pembuatan) }}</td>
                                    <td>{{ number_format($menu->harga, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge {{ $menu->status ? 'bg-primary' : 'bg-danger' }}">
                                            {{ $menu->status ? 'Tersedia' : 'Kosong' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a class="btn btn-primary btn-sm" href="{{ route('menu.edit', $menu->id) }}">Edit</a>
                                            <form action="{{ route('menu.destroy', $menu->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger border border-danger" type="submit"
                                                    onclick="return confirm('Yakin ingin menghapus menu ini?')">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <nav class="float-end">
                    <ul class="pagination">
                        {{ $menus->withQueryString()->links() }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection

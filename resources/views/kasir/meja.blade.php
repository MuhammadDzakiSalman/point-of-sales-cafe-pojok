@extends('layouts.main')
@section('content')
<div class="d-flex justify-content-center py-3 align-items-center gap-2 flex-wrap">
    <a class="btn btn-outline-primary d-flex align-items-center" role="button" href="{{ url('/kasir') }}">&nbsp;Pesanan</a>
    <a class="btn btn-outline-primary d-flex align-items-center active" role="button" href="{{ url('/meja') }}">&nbsp;Meja</a>
</div>
<div class="container my-4">
    <div class="card shadow-none mb-3">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Meja</h5>
                <div class="d-flex align-items-center gap-2">
                    <a class="btn btn-sm btn-primary" href="{{ route('meja.create') }}" role="button">Tambah</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive border-0 shadow-none table mt-2" id="dataTable-7" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Meja</th>
                            <th>No. Meja</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tables as $table)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $table->nama_meja }}</td>
                                <td>{{ $table->nomor_meja }}</td>
                                <td><span class="badge {{ $table->status ? 'bg-primary' : 'bg-danger' }}">{{ $table->status ? 'Tersedia' : 'Digunakan' }}</span></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a class="btn btn-primary btn-sm" href="{{ route('meja.edit', $table->id) }}" role="button">Edit</a>
                                        <form action="{{ route('meja.destroy', $table->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm" type="submit" onclick="return confirm('Yakin ingin menghapus meja ini?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
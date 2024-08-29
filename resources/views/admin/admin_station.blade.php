@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center my-4 align-items-center">
            <h5 class="mb-0">Admin</h5>
        </div>
        <div class="d-flex justify-content-center my-3 align-items-center gap-2 flex-wrap">
            <a class="btn btn-outline-primary d-flex align-items-center" href="{{ url('admin/menu') }}" role="button">Menu</a>
            <a class="btn btn-outline-primary d-flex align-items-center active" href="{{ url('admin/station') }}"role="button">Station</a>
            <a class="btn btn-outline-primary d-flex align-items-center" href="{{ url('admin/penjualan') }}"role="button">Penjualan</a>
            <a class="btn btn-outline-primary d-flex align-items-center" href="{{ url('admin/fcfs') }}"role="button">FCFS</a>
        </div>
        <div class="card mb-3 shadow-none">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Stations</h5>
                    <div class="d-flex gap-2">
                        <a class="btn btn-primary btn-sm" href="{{ route('station.create') }}" role="button">Tambah</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="dataTable-7" class="table-responsive border-0 shadow-none table mt-2" role="grid"
                    aria-describedby="dataTable_info">
                    <table id="dataTable" class="table my-0">
                        @if (session('success'))
                            <div class="alert alert-success" id="myAlert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Station</th>
                                <th>Keterangan</th>
                                <th>Jumlah Pekerja</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stations as $station)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $station->nama_station }}</td>
                                    <td>{{ ucfirst($station->keterangan) }}</td>
                                    <td>{{ ucfirst($station->jumlah_pekerja) }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('station.edit', $station->id) }}">Edit</a>
                                            <form action="{{ route('station.destroy', $station->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger border border-danger" type="submit"
                                                    onclick="return confirm('Yakin ingin menghapus station ini?')">Hapus</button>
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
    <script>
        setTimeout(() => {
            document.getElementById('myAlert').remove();
        }, 3000);
    </script>
@endsection

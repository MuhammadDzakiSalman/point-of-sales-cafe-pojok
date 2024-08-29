@extends('layouts.main')
@section('content')
    <div class="container d-flex justify-content-center align-items-center vh-100 py-3">
        <div class="row d-flex justify-content-center w-100">
            <div class="col-lg-10 col-xl-8 col-xxl-6">
                <div class="card shadow-none">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Tambah Meja</h4>
                        <form method="POST" action="{{ route('meja.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label mb-1" for="nomor_meja">No. Meja</label>
                                <input class="form-control form-control" type="number" id="nomor_meja" name="nomor_meja"
                                    placeholder="Nomor Meja..." required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label mb-1" for="nama_meja">Nama Meja</label>
                                <input class="form-control form-control" type="text" id="nama_meja" name="nama_meja"
                                    placeholder="Nama Meja..." required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="status">Status</label>
                                <select class="form-select form-select" id="status" name="status" required>
                                    <option value="" disabled selected>Pilih...</option>
                                    <option value="1">Tersedia</option>
                                    <option value="0">Digunakan</option>
                                </select>
                            </div>
                            <div class="float-end gap-2 d-flex">
                                <a class="btn btn-light" href="{{ route('meja.index') }}" role="button">Batal</a>
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

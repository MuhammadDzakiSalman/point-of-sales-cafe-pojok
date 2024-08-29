@extends('layouts.main')
@section('content')
    <div class="container d-flex justify-content-center align-items-center vh-100 py-3">
        <div class="row d-flex justify-content-center w-100">
            <div class="col-lg-10 col-xl-8 col-xxl-6">
                <div class="card shadow-none">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Edit Station</h4>
                        <form method="POST" action="{{ route('station.update', $station->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label mb-1" for="nama_station">Nama Station</label>
                                <input class="form-control form-control" type="text" id="nama_station" name="nama_station" value="{{ $station->nama_station }}" placeholder="Nama station...">
                            </div>
                            <div class="mb-3">
                                <label class="form-label mb-1" for="jumlah_pekerja">Jumlah Pekerja</label>
                                <input class="form-control form-control" type="text" id="jumlah_pekerja" name="jumlah_pekerja" value="{{ $station->jumlah_pekerja }}" placeholder="Jumlah pekerja...">
                            </div>
                            <div class="mb-3">
                                <label class="form-label mb-1" for="keterangan">Keterangan</label>
                                <textarea class="form-control" placeholder="Tambahkan keterangan disini..." name="keterangan" id="keterangan">{{ $station->keterangan }}</textarea>
                            </div>
                            <div class="float-end gap-2 d-flex">
                                <a class="btn btn-light" href="{{ route('station.index') }}" role="button">Batal</a>
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

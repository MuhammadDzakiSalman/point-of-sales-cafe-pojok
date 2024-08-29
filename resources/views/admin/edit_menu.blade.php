@extends('layouts.main')
@section('content')
    <div class="container d-flex justify-content-center align-items-center vh-100 py-3">
        <div class="row d-flex justify-content-center w-100">
            <div class="col-lg-10 col-xl-8 col-xxl-6">
                <div class="card shadow-none">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Edit Menu</h4>
                        <form method="POST" action="{{ route('menu.update', $menu->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label mb-1" for="nama_menu">Nama Menu</label>
                                <input class="form-control form-control" type="text" id="nama_menu" name="nama_menu" value="{{ $menu->nama_menu }}" placeholder="Nama menu...">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="kategori">Kategori</label>
                                <select class="form-select form-select" id="kategori" name="kategori">
                                    <option value="" disabled {{ $menu->kategori ? '' : 'selected' }}>Pilih...</option>
                                    <option value="makanan" {{ $menu->kategori == 'makanan' ? 'selected' : '' }}>Makanan</option>
                                    <option value="minuman" {{ $menu->kategori == 'minuman' ? 'selected' : '' }}>Minuman</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label mb-1" for="harga">Harga</label>
                                <input class="form-control form-control" type="text" id="harga" name="harga" value="{{ $menu->harga }}" placeholder="Harga...">
                            </div>
                            <div class="mb-3">
                                <label class="form-label mb-1" for="estimasi_pembuatan">Estimasi Waktu Pembuatan</label>
                                <div class="row">
                                    <div class="">
                                        <input class="form-control form-control" type="time" id="estimasi_pembuatan" name="waktu_pembuatan" value="{{ $menu->waktu_pembuatan }}" placeholder="Estimasi pembuatan...">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label mb-1" for="status">Status</label>
                                <select class="form-select form-select" id="status" name="status">
                                    <option value="" disabled {{ $menu->status ? '' : 'selected' }}>Pilih...</option>
                                    <option value="1" {{ $menu->status == 1 ? 'selected' : '' }}>Tersedia</option>
                                    <option value="0" {{ $menu->status == 0 ? 'selected' : '' }}>Kosong</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label mb-1" for="gambar">Gambar</label>
                                <input class="form-control" type="file" id="gambar" name="gambar" onchange="previewImage()">
                                <img class="mt-3 rounded-2" id="gambar-preview" src="{{ asset('storage/menu_images/' . $menu->gambar) }}" alt="Preview Gambar" style="max-width: 250px; max-height: 150px; display: block;">
                                <script>
                                    function previewImage() {
                                        var preview = document.getElementById('gambar-preview');
                                        var file = document.querySelector('input[type=file]').files[0];
                                        var reader = new FileReader();

                                        reader.onloadend = function () {
                                            preview.src = reader.result;
                                            preview.style.display = 'block';
                                        }

                                        if (file) {
                                            reader.readAsDataURL(file);
                                        } else {
                                            preview.src = '';
                                            preview.style.display = 'none';
                                        }
                                    }
                                </script>
                            </div>
                            <div class="float-end gap-2 d-flex">
                                <a class="btn btn-light" href="{{ route('menu.index') }}" role="button">Batal</a>
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

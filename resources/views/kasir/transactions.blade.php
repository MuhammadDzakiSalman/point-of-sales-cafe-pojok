@foreach ($transactions as $transaction)
    <div class="card mb-2 shadow-lg">
        <div class="card-body p-1">
            <div class="table-responsive border-0 shadow-none table mt-2" role="grid">
                <table class="table table-borderless my-0">
                    <thead>
                        <tr>
                            <th>
                                <div class="text-center">
                                    <p class="mb-0">No. Meja</p><span>{{ $transaction->table->id }}</span>
                                </div>
                            </th>
                            <th>
                                <div class="text-center">
                                    <p class="mb-0">Waktu</p><span>{{ $transaction->created_at->format('H:i') }}</span>
                                </div>
                            </th>
                            <th>
                                <div class="text-center">
                                    <p class="mb-0">Makanan</p><span>Rp {{ number_format($transaction->transactionDetails->where('menu.kategori', 'makanan')->sum('menu.harga'), 0, ',', '.') }}</span>
                                </div>
                            </th>
                            <th>
                                <div class="text-center">
                                    <p class="mb-0">Minuman</p><span>Rp {{ number_format($transaction->transactionDetails->where('menu.kategori', 'minuman')->sum('menu.harga'), 0, ',', '.') }}</span>
                                </div>
                            </th>
                            <th>
                                <div class="text-center">
                                    <p class="mb-0">Total</p><span>Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                                </div>
                            </th>
                            <th class="d-flex justify-content-center border-0">
                                <form action="{{ route('kasir.processTransaction', $transaction->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-primary" type="submit">Proses</button>
                                </form>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-0">
                            <td class="h-100" colspan="3">
                                <h6 class="text-center">Pesanan Makanan</h6>
                                <div class="h-100">
                                    <div class="card shadow-none h-100">
                                        <div class="card-body">
                                            <ul class="list-unstyled">
                                                @foreach ($transaction->transactionDetails->where('menu.kategori', 'makanan') as $detail)
                                                    <li><span class="me-1">{{ $detail->quantity }}x</span>{{ $detail->menu->nama_menu }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td colspan="3">
                                <h6 class="text-center">Pesanan Minuman</h6>
                                <div>
                                    <div class="card shadow-none h-100">
                                        <div class="card-body">
                                            <ul class="list-unstyled">
                                                @foreach ($transaction->transactionDetails->where('menu.kategori', 'minuman') as $detail)
                                                    <li><span class="me-1">{{ $detail->quantity }}x</span>{{ $detail->menu->nama_menu }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endforeach

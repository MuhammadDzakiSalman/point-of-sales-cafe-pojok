@extends('layouts.main')

@section('content')
<div>
    <div class="d-flex justify-content-center py-3 align-items-center gap-2 flex-wrap">
        <a class="btn btn-outline-primary d-flex align-items-center active" role="button" href="{{ url('/kasir') }}">Pesanan</a>
        <a class="btn btn-outline-primary d-flex align-items-center" role="button" href="{{ url('/meja') }}">Meja</a>
    </div>
    <ul class="nav nav-tabs d-flex justify-content-center" role="tablist">
        <li class="nav-item" role="presentation"><a class="nav-link active" role="tab" data-bs-toggle="tab" href="#tab-1">Pesanan Masuk<span class="badge rounded-pill bg-danger ms-1" id="transactions-count"></span></a></li>
        <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-2">Pesanan Selesai<span class="badge rounded-pill bg-danger ms-1" id="completed-transactions-count"></span></a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" role="tabpanel" id="tab-1">
            <div class="container my-4" id="transactions-list">
                <!-- Transakasi masuk disini -->
            </div>
        </div>
        <div class="tab-pane" role="tabpanel" id="tab-2">
            <div class="container my-4" id="completed-transactions-list">
                <!-- Transaksi selesai disini -->
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function loadTransactions() {
        $.ajax({
            url: '{{ route("kasir.getTransactions") }}',
            method: 'GET',
            success: function(response) {
                $('#transactions-count').text(response.transactions.length);
                $('#completed-transactions-count').text(response.completedTransactions.length);

                let transactionsHtml = '';
                response.transactions.forEach(transaction => {
                    transactionsHtml += `<div class="card mb-2 shadow-lg">
                        <div class="card-body p-1">
                            <div class="table-responsive border-0 shadow-none table mt-2" role="grid" aria-describedby="dataTable_info">
                                <table class="table table-borderless my-0">
                                    <thead>
                                        <tr>
                                            <th><div class="text-center"><p class="mb-0">No. Meja</p><span>${transaction.table.nomor_meja == 0 ? 'Bungkus' : transaction.table.nomor_meja}</span></div></th>
                                            <th><div class="text-center"><p class="mb-0">Waktu</p><span>${new Date(transaction.created_at).toLocaleTimeString()}</span></div></th>
                                            <th><div class="text-center"><p class="mb-0">Makanan</p><span>Rp ${transaction.details.filter(detail => detail.menu?.kategori === 'makanan').reduce((sum, detail) => sum + detail.menu.harga * detail.quantity, 0).toLocaleString('id-ID')}</span></div></th>
                                            <th><div class="text-center"><p class="mb-0">Minuman</p><span>Rp ${transaction.details.filter(detail => detail.menu?.kategori === 'minuman').reduce((sum, detail) => sum + detail.menu.harga * detail.quantity, 0).toLocaleString('id-ID')}</span></div></th>
                                            <th><div class="text-center"><p class="mb-0">Total</p><span>Rp ${transaction.total.toLocaleString('id-ID')}</span></div></th>
                                            <th class="d-flex justify-content-center border-0">
                                                <form action="{{ url('kasir/processTransaction') }}/${transaction.id}" method="POST">
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
                                                                ${transaction.details.filter(detail => detail.menu?.kategori === 'makanan').map(detail => `<li><span class="me-1">${detail.quantity}x</span>${detail.menu.nama_menu}</li>`).join('')}
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
                                                                ${transaction.details.filter(detail => detail.menu?.kategori === 'minuman').map(detail => `<li><span class="me-1">${detail.quantity}x</span>${detail.menu.nama_menu}</li>`).join('')}
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
                    </div>`;
                });

                $('#transactions-list').html(transactionsHtml);

                let completedTransactionsHtml = '';
                response.completedTransactions.forEach(transaction => {
                    completedTransactionsHtml += `<div class="card mb-2 shadow-lg">
                        <div class="card-body p-1">
                            <div class="table-responsive border-0 shadow-none table mt-2" role="grid" aria-describedby="dataTable_info">
                                <table class="table table-borderless my-0">
                                    <thead>
                                        <tr>
                                            <th><div class="text-center"><p class="mb-0">No. Meja</p><span>${transaction.table.nomor_meja == 0 ? 'Bungkus' : transaction.table.nomor_meja}</span></div></th>
                                            <th><div class="text-center"><p class="mb-0">Waktu</p><span>${new Date(transaction.created_at).toLocaleTimeString()}</span></div></th>
                                            <th><div class="text-center"><p class="mb-0">Makanan</p><span>Rp ${transaction.details.filter(detail => detail.menu?.kategori === 'makanan').reduce((sum, detail) => sum + detail.menu.harga * detail.quantity, 0).toLocaleString('id-ID')}</span></div></th>
                                            <th><div class="text-center"><p class="mb-0">Minuman</p><span>Rp ${transaction.details.filter(detail => detail.menu?.kategori === 'minuman').reduce((sum, detail) => sum + detail.menu.harga * detail.quantity, 0).toLocaleString('id-ID')}</span></div></th>
                                            <th><div class="text-center"><p class="mb-0">Total</p><span>Rp ${transaction.total.toLocaleString('id-ID')}</span></div></th>
                                            <th class="d-flex justify-content-center border-0">
                                                <form action="{{ url('kasir/confirmedTransaction') }}/${transaction.id}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button class="btn btn-primary" type="submit">Konfirmasi</button>
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
                                                                ${transaction.details.filter(detail => detail.menu?.kategori === 'makanan').map(detail => `<li><span class="me-1">${detail.quantity}x</span>${detail.menu.nama_menu}</li>`).join('')}
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
                                                                ${transaction.details.filter(detail => detail.menu?.kategori === 'minuman').map(detail => `<li><span class="me-1">${detail.quantity}x</span>${detail.menu.nama_menu}</li>`).join('')}
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
                    </div>`;
                });

                $('#completed-transactions-list').html(completedTransactionsHtml);
            }
        });
    }

    $(document).ready(function() {
        loadTransactions();
        setInterval(loadTransactions, 10000); // Poll every 10 seconds
    });
</script>
@endsection

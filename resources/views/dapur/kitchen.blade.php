@extends('layouts.main')

@section('content')
<div>
    <ul class="nav nav-tabs d-flex justify-content-center" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" role="tab" data-bs-toggle="tab" href="#tab-1">
                Pesanan Langsung
                <span class="badge rounded-pill bg-danger ms-1" id="processed-transactions-count"></span>
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-2">
                Pesanan Bungkus
                <span class="badge rounded-pill bg-danger ms-1" id="takeaway-transactions-count"></span>
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" role="tabpanel" id="tab-1">
            <div class="container my-4" id="processed-transactions-list">
                <!-- Processed transactions will be loaded here by AJAX -->
            </div>
        </div>
        <div class="tab-pane" role="tabpanel" id="tab-2">
            <div class="container my-4" id="takeaway-transactions-list">
                <!-- Takeaway transactions will be loaded here by AJAX -->
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function loadTransactions() {
        $.ajax({
            url: '{{ route("kitchen.getTransactions") }}',
            method: 'GET',
            success: function(response) {
                $('#processed-transactions-count').text(response.processedTransactions.length);
                $('#takeaway-transactions-count').text(response.takeawayTransactions.length);

                let processedTransactionsHtml = '';
                response.processedTransactions.forEach(transaction => {
                    processedTransactionsHtml += `<div class="card mb-2 shadow-lg">
                        <div class="card-body p-1">
                            <div class="table-responsive border-0 shadow-none table mt-2" role="grid">
                                <table class="table table-borderless my-0">
                                    <thead>
                                        <tr>
                                            <th><div class="text-center"><p class="mb-0">No. Meja</p><span>${transaction.table.nomor_meja == 0 ? 'Bungkus' : transaction.table.nomor_meja}</span></div></th>
                                            <th><div class="text-center"><p class="mb-0">Waktu</p><span>${new Date(transaction.created_at).toLocaleTimeString()}</span></div></th>
                                            <th><div class="text-center"><p class="mb-0">Makanan</p><span>Rp ${transaction.transaction_details.filter(detail => detail.menu?.kategori === 'makanan').reduce((sum, detail) => sum + detail.menu.harga * detail.quantity, 0).toLocaleString('id-ID')}</span></div></th>
                                            <th><div class="text-center"><p class="mb-0">Minuman</p><span>Rp ${transaction.transaction_details.filter(detail => detail.menu?.kategori === 'minuman').reduce((sum, detail) => sum + detail.menu.harga * detail.quantity, 0).toLocaleString('id-ID')}</span></div></th>
                                            <th><div class="text-center"><p class="mb-0">Total</p><span>Rp ${transaction.total.toLocaleString('id-ID')}</span></div></th>
                                            <th class="d-flex justify-content-center border-0">
                                                <button class="btn btn-primary btn-selesai" data-id="${transaction.id}">Selesai</button>
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
                                                                ${transaction.transaction_details.filter(detail => detail.menu?.kategori === 'makanan').map(detail => `<li><span class="me-1">${detail.quantity}x</span>${detail.menu.nama_menu}</li>`).join('')}
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
                                                                ${transaction.transaction_details.filter(detail => detail.menu?.kategori === 'minuman').map(detail => `<li><span class="me-1">${detail.quantity}x</span>${detail.menu.nama_menu}</li>`).join('')}
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

                $('#processed-transactions-list').html(processedTransactionsHtml);

                let takeawayTransactionsHtml = '';
                response.takeawayTransactions.forEach(transaction => {
                    takeawayTransactionsHtml += `<div class="card mb-2 shadow-lg">
                        <div class="card-body p-1">
                            <div class="table-responsive border-0 shadow-none table mt-2" role="grid">
                                <table class="table table-borderless my-0">
                                    <thead>
                                        <tr>
                                            <th><div class="text-center"><p class="mb-0">No. Meja</p><span>${transaction.table.nomor_meja == 0 ? 'Bungkus' : transaction.table.nomor_meja}</span></div></th>
                                            <th><div class="text-center"><p class="mb-0">Waktu</p><span>${new Date(transaction.created_at).toLocaleTimeString()}</span></div></th>
                                            <th><div class="text-center"><p class="mb-0">Makanan</p><span>Rp ${transaction.transaction_details.filter(detail => detail.menu?.kategori === 'makanan').reduce((sum, detail) => sum + detail.menu.harga * detail.quantity, 0).toLocaleString('id-ID')}</span></div></th>
                                            <th><div class="text-center"><p class="mb-0">Minuman</p><span>Rp ${transaction.transaction_details.filter(detail => detail.menu?.kategori === 'minuman').reduce((sum, detail) => sum + detail.menu.harga * detail.quantity, 0).toLocaleString('id-ID')}</span></div></th>
                                            <th><div class="text-center"><p class="mb-0">Total</p><span>Rp ${transaction.total.toLocaleString('id-ID')}</span></div></th>
                                            <th class="d-flex justify-content-center border-0">
                                                <button class="btn btn-primary btn-selesai" data-id="${transaction.id}">Selesai</button>
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
                                                                ${transaction.transaction_details.filter(detail => detail.menu?.kategori === 'makanan').map(detail => `<li><span class="me-1">${detail.quantity}x</span>${detail.menu.nama_menu}</li>`).join('')}
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td colspan="3">
                                                <h6 class="text-center">Pesanan Minuman</h6>
                                                <div class="h-100">
                                                    <div class="card shadow-none h-100">
                                                        <div class="card-body">
                                                            <ul class="list-unstyled">
                                                                ${transaction.transaction_details.filter(detail => detail.menu?.kategori === 'minuman').map(detail => `<li><span class="me-1">${detail.quantity}x</span>${detail.menu.nama_menu}</li>`).join('')}
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

                $('#takeaway-transactions-list').html(takeawayTransactionsHtml);
            }
        });
    }

    $(document).ready(function() {
        loadTransactions();
        setInterval(loadTransactions, 10000); // Poll every 10 seconds

        $(document).on('click', '.btn-selesai', function() {
            var transactionId = $(this).data('id');
            $.ajax({
                url: '{{ route("kitchen.updateStatus") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: transactionId
                },
                success: function(response) {
                    if (response.success) {
                        loadTransactions(); // Refresh data setelah status diperbarui
                    } else {
                        alert('Gagal memperbarui status.');
                    }
                }
            });
        });
    });
</script>
@endsection

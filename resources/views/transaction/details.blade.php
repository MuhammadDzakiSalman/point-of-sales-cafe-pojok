<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Cafe Pojok | Detail Bill</title>
        <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&amp;display=swap">
        <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    </head>
<body class="vh-100">
    <div class="container d-flex justify-content-center align-items-center h-100">
            <div class="row d-flex justify-content-center align-items-center w-100 h-100">
            <div class="col-md-10 col-lg-9 col-xl-8 col-xxl-7">
                <div class="card shadow-none">
                    <div class="card-body">
                        <p><strong>Nomor Meja:</strong> {{ $transaction->table->nama_meja }}</p>
                        <p><strong>Metode Pembayaran:</strong> {{ $transaction->metode_pembayaran }}</p>
                        <p><strong>Estimasi:</strong> {{ $transaction->estimasi }}</p>
                        <div id="dataTable-1" class="table-responsive border-0 shadow-none table mt-2" role="grid" aria-describedby="dataTable_info">
                            <table id="dataTable" class="table my-0">
                                <thead>
                                    <tr>
                                        <th>Menu</th>
                                        <th>Jumlah</th>
                                        <th>Harga Satuan</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                @foreach($transaction->details as $detail)
                    <tr>
                        <td>{{ $detail->menu->nama_menu }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ number_format($detail->menu->harga, 0, ',', '.') }}</td>
                        <td>{{ number_format($detail->menu->harga * $detail->quantity, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                                <tfoot>
                                    <tr>
                                        <td class="table-secondary border-0">
                                            <p class="mb-0 fw-semibold">Total</p>
                                        </td>
                                        <td class="table-secondary border-0"></td>
                                        <td class="table-secondary border-0"></td>
                                        <td class="table-secondary border-0">
                                            <p class="mb-0 fw-semibold">{{ number_format($transaction->total, 0, ',', '.') }}</p>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="fw-semibold d-flex justify-content-between"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill - Cafe Name</title>
    <link rel="stylesheet" href="style.css">
<style>
body {
    font-family: sans-serif;
}

.bill-container {
    width: 600px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
}

.bill-header {
    text-align: center;
}

.menu-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.menu-table th,
.menu-table td {
    border: 1px solid #ccc;
    padding: 5px;
    text-align: left;
}

.total-container {
    text-align: right;
    margin-top: 20px;
}

.bill-footer {
    text-align: center;
    margin-top: 20px;
}

</style>
</head>
<body>
    <div class="bill-container">
        <header class="bill-header">
            <h1>Pojok Cafe</h1>
            <p>No. Meja: {{ $transaction->table->nama_meja }}</p>
            <p style="text-transform: capitalize">Metode Pembayaran: {{ $transaction->metode_pembayaran }}</p>
            <p>Waktu Pemesanan: {{ $transaction->created_at }}</p>
        </header>

        <table class="menu-table">
            <thead>
                <tr>
                    <th>Nama Menu</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaction->details as $detail)
                <tr>
                    <td>{{ $detail->menu->nama_menu }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ number_format($detail->menu->harga, 0, ',', '.') }}</td>
                    <td>{{ number_format($detail->menu->harga * $detail->quantity, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-container">
            <p style="font-weight: bold">Total Pesanan: Rp.{{ number_format($transaction->total, 0, ',', '.') }}</p>
            <img style="height: 100px" src="data:image/png;base64,{{ base64_encode(QrCode::format('png')->size(200)->generate(route('transaction.details', ['id' => $transaction->id]))) }}" alt="QR Code">
        </div>
    </div>
</body>
</html>

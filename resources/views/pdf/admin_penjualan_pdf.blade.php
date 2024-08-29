<!DOCTYPE html>
<html>
<head>
    <title>Data Penjualan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Data Penjualan</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Penjualan</th>
                <th>Menu</th>
                <th>Terjual</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                @foreach($transaction->transactionDetails as $detail)
                    <tr>
                        <td>{{ $loop->parent->iteration }}</td>
                        <td>{{ $detail->created_at }}</td>
                        <td>{{ $detail->menu->nama_menu }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ number_format($detail->menu->harga * $detail->quantity, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Transactions PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h3>Data FCFS</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Waktu Pemesanan</th>
                <th>Estimasi Pembuatan</th>
                <th>Waktu Selesai</th>
                <th>TAT</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaction->created_at->format('H:i:s') }}</td>
                    <td>{{ $transaction->estimasi ? $transaction->estimasi->format('H:i:s') : 'N/A' }}</td>
                    <td>{{ $transaction->selesai ? $transaction->selesai->format('H:i:s') : 'N/A' }}</td>
                    <td>
                        @if($transaction->selesai && $transaction->created_at)
                            {{ number_format($transaction->created_at->diffInSeconds($transaction->selesai) / 60, 2) }}
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-center my-4 align-items-center">
            <h5 class="mb-0">Admin</h5>
        </div>
        <div class="d-flex justify-content-center my-3 align-items-center gap-2 flex-wrap">
            <a class="btn btn-outline-primary d-flex align-items-center" href="{{ url('admin/menu') }}" role="button">Menu</a>
            <a class="btn btn-outline-primary d-flex align-items-center" href="{{ url('admin/station') }}"role="button">Station</a>
            <a class="btn btn-outline-primary d-flex align-items-center active" href="{{ url('admin/penjualan') }}"role="button">Penjualan</a>
            <a class="btn btn-outline-primary d-flex align-items-center" href="{{ url('admin/fcfs') }}"role="button">FCFS</a>
        </div>
        <div class="card mb-3 shadow-none">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h5 class="mb-0">Penjualan</h5>
                    <div class="d-flex gap-2">
                        <form method="GET" action="{{ url('admin/penjualan/download') }}">
                            <input type="hidden" name="start_date" value="{{ $startDate }}">
                            <input type="hidden" name="end_date" value="{{ $endDate }}">
                            <button class="btn btn-primary btn-sm" type="submit">Download</button>
                        </form>
                    </div>
                </div>
                <div class="row d-flex justify-content-end">
                    <div class="col col-12 col-md-6">
                        <form method="GET" action="{{ url('admin/penjualan') }}"
                            class="d-flex align-items-center justify-content-between mb-2 gap-1">
                            <input type="date" name="start_date" class="form-control form-control-sm" value="{{ $startDate }}">
                            <span>-</span>
                            <input type="date" name="end_date" class="form-control form-control-sm" value="{{ $endDate }}">
                            <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive border-0 shadow-none table mt-2" id="dataTable-7" role="grid"
                    aria-describedby="dataTable_info">
                    <table class="table my-0" id="dataTable">
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
                            @foreach ($transactions as $transaction)
                                @foreach ($transaction->transactionDetails as $detail)
                                    <tr>
                                        <td>{{ ($transactions->currentPage() - 1) * $transactions->perPage() + $loop->parent->iteration }}
                                        </td>
                                        <td>{{ $detail->created_at }}</td>
                                        <td>{{ $detail->menu ? $detail->menu->nama_menu : 'Menu tidak ditemukan' }}</td>
                                        <td>{{ $detail->quantity }}</td>
                                        <td>{{ $detail->menu ? number_format($detail->menu->harga * $detail->quantity, 0, ',', '.') : 'N/A' }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
@endsection

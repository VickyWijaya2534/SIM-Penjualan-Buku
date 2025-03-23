@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">💰 Daftar Transaksi</h2>

    <!-- Tombol Tambah Transaksi -->
    <div class="mb-3">
        <a href="{{ route('transactions.create') }}" class="btn btn-primary">➕ Tambah Transaksi</a>
    </div>

    <!-- Tabel Data -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">💳 Data Transaksi</h3>
        </div>
        <div class="card-body">
        <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pelanggan</th>
                        <th>Buku</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $index => $transaction)
                    <tr>
                        <td>{{ $transactions->firstItem() + $loop->index }}</td>
                        <td>{{ $transaction->customer->name }}</td>
                        <td>{{ $transaction->book->title }}</td>
                        <td>{{ $transaction->quantity }}</td>
                        <td>Rp{{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                {{ $transactions->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection

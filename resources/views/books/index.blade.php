@extends('layouts.admin')

@section('title', 'Daftar Buku')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">📚 Daftar Buku</h2>

    <!-- Tombol Tambah Buku -->
    <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">➕ Tambah Buku</a>

    <!-- Pencarian -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method="GET" action="{{ route('books.index') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari judul atau penulis..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Data Buku -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">📖 Data Buku</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($books as $index => $book)
                    <tr>
                        <td>{{ $books->firstItem() + $index }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>Rp{{ number_format($book->price, 0, ',', '.') }}</td>
                        <td>{{ $book->stock }}</td>
                        <td>
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">🗑️ Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">❌ Tidak ada buku ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-3">
        {{ $books->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection

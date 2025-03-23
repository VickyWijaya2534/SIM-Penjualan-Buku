@extends('layouts.admin')

@section('title', 'Tambah Transaksi')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Tambah Transaksi</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="customer_id" class="form-label">Pilih Pelanggan</label>
                    <select name="customer_id" class="form-control" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="book_id" class="form-label">Pilih Buku</label>
                    <select name="book_id" class="form-control" required id="bookSelect">
                        <option value="">-- Pilih Buku --</option>
                        @foreach($books as $book)
                            <option value="{{ $book->id }}" data-price="{{ $book->price }}">
                                {{ $book->title }} - Rp{{ number_format($book->price, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label">Jumlah</label>
                    <input type="number" name="quantity" class="form-control" min="1" required id="quantityInput">
                </div>

                <div class="mb-3">
                    <label for="total_price" class="form-label">Total Harga</label>
                    <input type="number" name="total_price" class="form-control" min="0" readonly id="totalPriceInput">
                </div>

                <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    let bookSelect = document.getElementById("bookSelect");
    let quantityInput = document.getElementById("quantityInput");
    let totalPriceInput = document.getElementById("totalPriceInput");

    function updateTotalPrice() {
        let selectedOption = bookSelect.options[bookSelect.selectedIndex];
        let bookPrice = selectedOption.getAttribute("data-price") || 0;
        let quantity = quantityInput.value || 1;
        totalPriceInput.value = bookPrice * quantity;
    }

    bookSelect.addEventListener("change", updateTotalPrice);
    quantityInput.addEventListener("input", updateTotalPrice);
});
</script>

@endsection

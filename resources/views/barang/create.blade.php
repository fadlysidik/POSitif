@extends('layout.admin')

@section('content')
<div class="container mt-4">
    <h2>{{ isset($barang) ? 'Edit Barang' : 'Tambah Barang' }}</h2>

    <a href="{{ route('barang.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($barang) ? route('barang.update', $barang->id) : route('barang.store') }}" method="POST">
        @csrf
        @if(isset($barang))
            @method('POST')
        @endif

        <div class="mb-3">
            <label for="kode_barang" class="form-label">Kode Barang</label>
            <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="{{ old('kode_barang', $barang->kode_barang ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="produk_id" class="form-label">Produk</label>
            <select class="form-control" id="produk_id" name="produk_id" required>
                <option value="">Pilih Produk</option>
                @foreach ($produk as $item)
                    <option value="{{ $item->id }}" {{ old('produk_id', $barang->produk_id ?? '') == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_produk }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ old('nama_barang', $barang->nama_barang ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="satuan" class="form-label">Satuan</label>
            <input type="text" class="form-control" id="satuan" name="satuan" value="{{ old('satuan', $barang->satuan ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="harga_jual" class="form-label">Harga Jual</label>
            <input type="number" step="0.01" class="form-control" id="harga_jual" name="harga_jual" value="{{ old('harga_jual', $barang->harga_jual ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stok" name="stok" value="{{ old('stok', $barang->stok ?? '') }}" required>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="ditarik" id="ditarik" value="1" {{ isset($barang) && $barang->ditarik ? 'checked' : '' }}>
            <label class="form-check-label" for="ditarik">Ditarik</label>
        </div>

        <button type="submit" class="btn btn-success">{{ isset($barang) ? 'Update' : 'Simpan' }}</button>
    </form>
</div>
@endsection

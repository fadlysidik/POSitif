@extends('layout.admin')

@section('content')
    <div class="container mt-4">
        <h2>{{ isset($pemasok) ? 'Edit Pemasok' : 'Tambah Pemasok' }}</h2>
        <a href="{{ route('pemasok.index') }}" class="btn btn-secondary mb-3">Kembali</a>
        
        <div class="card">
            <div class="card-body">
                <form action="{{ isset($pemasok) ? route('pemasok.update', $pemasok->id) : route('pemasok.store') }}" method="POST">
                    @csrf
                    @if(isset($pemasok))
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label for="nama_pemasok" class="form-label">Nama Pemasok</label>
                        <input type="text" name="nama_pemasok" id="nama_pemasok" class="form-control" value="{{ old('nama_pemasok', $pemasok->nama_pemasok ?? '') }}" required>
                    </div>

                    <button type="submit" class="btn btn-success">{{ isset($pemasok) ? 'Update' : 'Simpan' }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection

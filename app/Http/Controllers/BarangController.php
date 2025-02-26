<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Produk;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::with('produk')->get();
        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        $produk = Produk::all();
        return view('barang.create', compact('produk'));
    }

    public function store(Request $request)
{
    $request->validate([
        'kode_barang' => 'required|unique:barang,kode_barang|max:50',
        'produk_id' => 'required|exists:produk,id',
        'nama_barang' => 'required|max:100',
        'satuan' => 'required|max:10',
        'harga_jual' => 'required|numeric',
        'stok' => 'required|integer',
        'ditarik' => 'in:0,1',
    ]);

    Barang::create([
        'kode_barang' => $request->kode_barang,
        'produk_id' => $request->produk_id,
        'nama_barang' => $request->nama_barang,
        'satuan' => $request->satuan,
        'harga_jual' => $request->harga_jual,
        'stok' => $request->stok,
        'ditarik' => $request->ditarik,
        'user_id' => auth()->id(),
    ]);

    return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
}


    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $produk = Produk::all();
        return view('barang.create', compact('barang', 'produk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_barang' => "required|max:50|unique:barang,kode_barang,$id",
            'produk_id' => 'required|exists:produk,id',
            'nama_barang' => 'required|max:100',
            'satuan' => 'required|max:10',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer',
            'ditarik' => 'in:0,1',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update($request->all());

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}

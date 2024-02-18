<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductsM;
use App\Models\LogM;
use PDF;

use Illuminate\Support\Facades\Auth;


class ProductsC extends Controller
{
    public function index()
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Produk'
        ]);

        $subtitle = "Daftar Produk";
        $productsM = ProductsM::all();
        // Melihat Semua
        // $productsM = ProductsM::withTrashed()->get();
        // Melihat yg di hapus saja
        // $productsM = ProductsM::onlyTrashed()->get();
        return view('products.products_index', compact('subtitle', 'productsM'));
    }

    public function create()
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Berada Di Halaman Tambah Produk'
        ]);

        $subtitle = "Tambah Produk";
        return view('products.products_create', compact('subtitle'));
    }

    public function store(Request $request)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Proses Tambah Produk'
        ]);

        $request->validate([
            'nama_produk' => 'required',
            'harga_produk' => 'required',
            'kategori' => 'required',
        ]);

        // productsM::create($request->post());

        $products = new ProductsM;
        $products->nama_produk = $request->input('nama_produk');
        $products->harga_produk = $request->input('harga_produk');
        $products->kategori = $request->input('kategori');
        $products->save();

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Berada Di Halaman Edit Produk'
        ]);

        $subtitle = "Edit Produk";
        $products = ProductsM::find($id);
        return view('products.products_edit', compact('subtitle', 'products'));
    }

    public function update(Request $request, $id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Proses Edit Produk'
        ]);

        $request->validate([
            'nama_produk' => 'required',
            'harga_produk' => 'required',
            'kategori' => 'required',
        ]);

        //  $data = request()->except(['_token', '_method', 'submit']);

        //  productsM::where('id', $id)->update($data);

        $products = ProductsM::find($id);
        $products->nama_produk = $request->input('nama_produk');
        $products->harga_produk = $request->input('harga_produk');
        $products->kategori = $request->input('kategori');
        $products->save();

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbaharui');
    }

    public function destroy($id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Menghapus Halaman Produk'
        ]);
        productsM::where('id', $id)->delete();
        // productsM::where('id', $id)->forcedelete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus');
    }

    public function pdf()
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Membuat Laporan Produk'
        ]);

        $productsM = ProductsM::all();

        $pdf = 'PDF'::loadview('products.products_pdf', ['productsM' => $productsM]);
        return $pdf->stream('products.pdf');
    }

}

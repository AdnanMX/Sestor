<?php

namespace App\Http\Controllers;

use App\Models\TransactionsM;
use App\Models\TransactionsItemM;
use App\Models\ProductsM;
use App\Models\LogM;
use PDF;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TransactionsC extends Controller
{
    public function index()
    {
        $transactionsM = TransactionsM::all();
        // Melihat Semua
        // $transactionsM = TransactionsM::withTrashed()->get();
        // Melihat yg di hapus saja
        // $transactionsM = TransactionsM::onlyTrashed()->get();

        $subtitle = "Daftar Transaksi";
        return view('transactions.transactions_index', compact('transactionsM', 'subtitle'));
    }

    public function create()
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Di Halaman Tambah Transaksi'
        ]);
        $subtitle = "Tambah Transaksi";
        $productsM = ProductsM::all();
        return view('transactions.transactions_create', compact('productsM', 'subtitle'));
    }

    public function store(Request $request)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Proses Tambah Transaksi'
        ]);
        $transactions = new TransactionsM();
        $transactions->nomor_unik = $request->input('nomor_unik');
        $transactions->nama_pelanggan = $request->input('nama_pelanggan');
        $no_polisi = $request->input('no_polisi');
        if (strlen($no_polisi) > 10) {
            return back()->withErrors([
                'no_polisi' => 'No Polisi tidak valid, maksimal 10 karakter'
            ]);
        } else {
            $transactions->no_polisi = $no_polisi;
        }
        $transactions->type = $request->input('type');
        $transactions->uang_bayar = $request->input('uang_bayar');
        $transactions->total_harga = $request->input('total_harga');
        $transactions->uang_kembali = $request->input('uang_bayar') - $transactions->total_harga;
        if ($transactions->uang_bayar < $transactions->total_harga) {
            return \back()->with('kurang', 'Uang bayar tidak cukup, pembayaran tidak dapat dilakukan');
        }
        if (!$request->has('id_products')) {
            return redirect()->back()->with('kosong', 'Anda belum memilih item untuk transaksi. Harap pilih setidaknya satu item.');
        }
        $transactions->save();
        foreach ($request->get('id_products') as $index => $id_products) {
            $products = ProductsM::findOrfail($id_products);
            $transactions_item = new TransactionsItemM();
            $transactions_item->fill([
                "id_transactions" => $transactions->id,
                "id_products" => $id_products,
                "nama_produk" => $products->nama_produk,
                "harga_produk" => $products->harga_produk,
                "quantity" => $request->get('quantity')[$index]
            ]);
            $transactions_item->save();
        }
        return redirect()->route('transactions.index')->with('success', 'Transaksi Berhasil Ditambah');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Di Halaman Edit Transaksi'
        ]);
        $subtitle = "Edit Transaksi";
        $transactions = TransactionsM::findOrFail($id);
        $productsM = ProductsM::all();
        return view('transactions.transactions_edit', compact('transactions', 'productsM', 'subtitle'));
    }

    public function update(Request $request, $id)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Proses Edit Transaksi'
        ]);

        $transactions = TransactionsM::findOrFail($id);
        $transactions->nomor_unik = $request->input('nomor_unik');
        $no_polisi = $request->input('no_polisi');
        if (strlen($no_polisi) > 10) {
            return back()->withErrors([
                'no_polisi' => 'No Polisi tidak valid, maksimal 10 karakter'
            ]);
        } else {
            $transactions->no_polisi = $no_polisi;
        }
        $transactions->type = $request->input('type');
        $transactions->uang_bayar = $request->input('uang_bayar');
        $transactions->total_harga = $request->input('total_harga');
        $transactions->nama_pelanggan = $request->input('nama_pelanggan');
        $transactions->uang_kembali = $request->input('uang_bayar') - $transactions->total_harga;
        if ($transactions->uang_bayar < $transactions->total_harga) {
            return \back()->with('kurang', 'Uang bayar tidak cukup, pembayaran tidak dapat dilakukan');
        }
        if (!$request->has('id_products')) {
            return redirect()->back()->with('kosong', 'Anda belum memilih item untuk transaksi. Harap pilih setidaknya satu item.');
        }
        $transactions->save();

        // Hapus semua item transaksi terkait
        $transactions->items()->delete();


        // Tambahkan item transaksi yang baru
        foreach ($request->get('id_products') as $index => $id_products) {
            $products = ProductsM::findOrFail($id_products);
            $transactions_item = new TransactionsItemM();
            $transactions_item->fill([
                "id_transactions" => $transactions->id,
                "id_products" => $id_products,
                "nama_produk" => $products->nama_produk,
                "harga_produk" => $products->harga_produk,
                "quantity" => $request->get('quantity')[$index]
            ]);
            $transactions_item->save();
        }

        return redirect()->route('transactions.index')->with('success', 'Transaksi Berhasil Diperbarui');
    }


    public function destroy($id)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Hapus Transaksi'
        ]);

        TransactionsM::where('id', $id)->delete();
        // TransactionsM::where('id', $id)->forcedelete();

        return redirect()->route('transactions.index')->with('success', 'Transaksi Berhasil Dihapus');
    }

    public function cetak($id)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mencetak Struk Transaksi'
        ]);
        $transactionsM = TransactionsM::with('items')->find($id);

        if (!$transactionsM) {
            return redirect()->route('transactions.index')->with('error', 'Transaksi tidak ditemukan');
        }
        $pdf = 'PDF'::loadview('transactions.transactions_cetak', ['transactionsM' => $transactionsM])->setPaper([0, 0, 300, 400], 'custom');
        return $pdf->stream('transactions.pdf');
    }

    public function pdfFilter(Request $request)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Membuat Laporan Transaksi'
        ]);

        // Ambil tanggal awal dan akhir dari request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Jika kedua tanggal kosong, atur tanggal dari transaksi terakhir dan terbaru
        if (empty($startDate) && empty($endDate)) {
            $startDate = TransactionsM::orderBy('created_at', 'asc')->first()->created_at->format('Y-m-d');
            $endDate = now()->format('Y-m-d');
        }

        // Query untuk mengambil data transaksi berdasarkan rentang tanggal
        $transactionsM = TransactionsM::with('items')
            ->whereBetween('created_at', [$startDate, $endDate . ' 23:59:59'])
            ->get();

        // Load view dan buat PDF
        $pdf = 'PDF'::loadview('transactions.transactions_pdf', compact('transactionsM'));

        // Jika tidak ada data dalam rentang tanggal, set PDF ke mode tolerant
        if ($transactionsM->isEmpty()) {
            $pdf->getDomPDF()->set_option("isHtml5ParserEnabled", true);
            $pdf->getDomPDF()->set_option("isPhpEnabled", true);
        }

        // Kembalikan response PDF
        return $pdf->stream('transactions.pdfFilter');
    }




}

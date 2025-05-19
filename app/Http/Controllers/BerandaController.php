<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use App\Models\Pembelian;

class BerandaController extends Controller
{
    public function index()
    {
        $skr = date("Y-m-d");
        $barang = Barang::where('stok', '<=', 5)->get();
        $rupiahhariini = DetailPenjualan::whereDate('created_at', $skr)->sum('total_harga');
        $baranghariini = DetailPenjualan::whereDate('created_at', $skr)->sum('jumlah');
        $barangmasuk = Pembelian::where('tanggal', $skr)->sum('jumlah');
        $jumlahtransaksi = Penjualan::where('tanggal_pesan', $skr)->get()->count();
        return view('beranda', compact('barang','rupiahhariini','baranghariini','barangmasuk','jumlahtransaksi'));
    }
}

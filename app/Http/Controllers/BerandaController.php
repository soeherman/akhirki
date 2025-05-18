<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BerandaController extends Controller
{
    public function index()
    {
        $barang = Barang::where('stok', '<=', 5)->get();
        return view('beranda', compact('barang'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Barang;
use App\Models\Pembeli;
use App\Models\DetailPenjualan;
use Session;
use Validator;
use DB;
use Barryvdh\DomPDF\Facade\Pdf;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $r)
    {
        if(empty($r->tgl_awal) && empty($r->tgl_akhir)){
            $penjualan = Penjualan::paginate(10);
        }else{
            $tgl1 = $r->tgl_awal;
            $tgl2 = $r->tgl_akhir;
            $penjualan = Penjualan::wherebetween('tanggal_pesan', [$tgl1, $tgl2])->paginate(10);
        }
        
        return view('penjualan.show', compact('penjualan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barang = Barang::where('stok','>', 1)->get();
        $pembeli = Pembeli::all();
        return view('penjualan.add', compact('barang', 'pembeli'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $penjualan = new Penjualan();
            $penjualan->pembeli_id = $request->pembeli_id;
            $penjualan->kasir_id = session('idyangmasuk');
            $penjualan->tanggal_pesan = date("Y-m-d");
            $penjualan->save();

            $idpenjualan = $penjualan->id;
            foreach ($request->barang_idnya as $barang=>$barangnya) {
                $penjualanbarang = new DetailPenjualan();
                $penjualanbarang->penjualan_id = $idpenjualan;
                $penjualanbarang->barang_id = $barangnya;
                $penjualanbarang->jumlah = $request->jumlahdibeli[$barang];
                $penjualanbarang->total_harga = $request->totaldibeli[$barang];
                $penjualanbarang->save();

                $updatebarang = Barang::find($barangnya);
                $updatebarang->stok = $updatebarang->stok - $request->jumlahdibeli[$barang];
                $updatebarang->save();
            }
            DB::commit();
            Session::flash('pesan', 'Data penjualan berhasil ditambahkan');
            Session::flash('alert-class', 'alert-success');
            return redirect('penjualan');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            Session::flash('pesan', 'Data penjualan gagal ditambahkan');
            Session::flash('alert-class', 'alert-danger');
            return redirect('penjualan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $penjualan = Penjualan::find($id);
        $detail = DetailPenjualan::where('penjualan_id',$penjualan->id)->get();
        return view('penjualan.detail', compact('penjualan','detail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penjualan = Penjualan::find($id);
        $detailpenjualan = DetailPenjualan::where('penjualan_id', $id)->get();
        foreach ($detailpenjualan as $d) {
            $barang = Barang::find($d->barang_id);
            $barang->stok = $barang->stok + $d->jumlah;
            $barang->save();
            $d->delete();
        }
        $penjualan->delete();
        Session::flash('pesan', 'Data penjualan berhasil dihapus'); 
        Session::flash('alert-class', 'alert-success');
        return redirect('penjualan');

    }

    public function cetak(Request $r){
        $penjualan = Penjualan::all();
        $pdf = PDF::loadView('penjualan.cetakpenjualan', compact('penjualan'));
        $pdf->setOptions(['dpi' => 150]);
        return $pdf->stream('penjualan.pdf');
    }

    public function cetakdetail($id){
        $penjualan = Penjualan::find($id);
        $detail = DetailPenjualan::where('penjualan_id',$penjualan->id)->get();
        $pdf = PDF::loadView('penjualan.cetakdetailpenjualan', compact('penjualan','detail'));
        $pdf->setOptions(['dpi' => 150]);
        return $pdf->stream('detailpenjualan.pdf');
    }
}

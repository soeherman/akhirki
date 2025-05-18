<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use Session;
use App\Models\Supplier;
use App\Models\Barang;
use Validator;
use DB;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembelian = Pembelian::paginate(10);
        return view('pembelian.show', compact('pembelian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $barang = Barang::all();
        $supplier = Supplier::all();
        return view('pembelian.add', compact('barang', 'supplier'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'barang_id' => 'required',
                'supplier_id' => 'required',
                'jumlah' => 'required',
                'tanggal' => 'required',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $barang = Barang::find($request->barang_id);
            
            $pembelian = new Pembelian;
            $pembelian->barang_id = $request->barang_id;
            $pembelian->supplier_id = $request->supplier_id;
            $pembelian->jumlah = $request->jumlah;
            $pembelian->tanggal = $request->tanggal;
            $pembelian->save();
    
            $barang->stok = $barang->stok + $request->jumlah;
            $barang->save();
            DB::commit();
            Session::flash('pesan', 'Data berhasil disimpan');
            Session::flash('alert-class', 'alert-success');
            return redirect('pembelian');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            Session::flash('pesan', 'Terjadi kesalahan saat menyimpan data');
            Session::flash('alert-class', 'alert-danger');
            return redirect('pembelian');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pembelian = Pembelian::find($id);
        $barang = Barang::all();
        $supplier = Supplier::all();
        return view('pembelian.edit', compact('pembelian','barang','supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'barang_id' => 'required',
                'supplier_id' => 'required',
                'jumlah' => 'required',
                'tanggal' => 'required',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $barang = Barang::find($request->barang_id);
            
            $pembelian = Pembelian::find($id);
            $restoklama = $pembelian->jumlah;
            $pembelian->barang_id = $request->barang_id;
            $pembelian->supplier_id = $request->supplier_id;
            $pembelian->jumlah = $request->jumlah;
            $pembelian->tanggal = $request->tanggal;
            $pembelian->save();
    
            $barang->stok = ($barang->stok - $restoklama) + $request->jumlah;
            $barang->save();
            DB::commit();
            Session::flash('pesan', 'Data berhasil disimpan');
            Session::flash('alert-class', 'alert-success');
            return redirect('pembelian');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            Session::flash('pesan', $th->getMessage());
            Session::flash('alert-class', 'alert-danger');
            return redirect('pembelian');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            DB::beginTransaction();
            $data = Pembelian::find($id);
            $stoklama = $data->jumlah;

            $barang = Barang::find($data->barang_id);
            $barang->stok = $barang->stok - $stoklama;
            $barang->save();

            $data->delete();
            DB::commit();
            Session::flash('pesan', 'Data berhasil dihapus');
            Session::flash('alert-class', 'alert-success');
            return redirect('pembelian');
        }catch(\Throwable $th){
            //throw $th;
            DB::rollback();
            Session::flash('pesan', 'Terjadi kesalahan saat menghapus data');
            Session::flash('alert-class', 'alert-danger');
            return redirect('pembelian');
        }
        
    }
}

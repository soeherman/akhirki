<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
use Session;
use Validator;
use Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $r)
    {
        if(empty($r)){
            $barang = Barang::paginate(10);
        }else{
            $nama = $r->nama_barang;
            $barang = Barang::where('nama','like','%'.$nama.'%')->paginate(10);
        }
        
        return view('barang.show', compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('barang.add', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori' => 'required',
            'nama' => 'required|string|min:3',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric',
            'gambar' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
 
        if ($validator->fails()) {
            return redirect('barang/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        if($request->file('gambar')) {
            $file = $request->file('gambar')->store('imgbarang','public');
            $s = new Barang();
            $s->kategori_id = $request->kategori;
            $s->nama = $request->nama;
            $s->stok = $request->stok;
            $s->harga = $request->harga;
            $s->gambar = $file;
            $s->save();
            Session::flash('pesan', 'Satu Barang berhasil ditambah');
            Session::flash('alert-class', 'alert-success');
            return redirect('barang');
        }else{
            Session::flash('pesan', 'Terjadi kesalahan pada upload File Gambar Barang');
            Session::flash('alert-class', 'alert-danger');
            return redirect('barang');
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
    public function edit($id)
    {
        $kategori = Kategori::all();
        $barang = Barang::find($id);
        return view('barang.edit', compact('barang', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'kategori' => 'required',
            'nama' => 'required|string|min:3',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric',
            'gambar' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
 
        if ($validator->fails()) {
            return redirect('barang/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }
        $s = Barang::find($id);

        if($request->file('gambar')) {
            $file = $request->file('gambar')->store('imgbarang','public');
            Storage::delete('public/'.$s->gambar);
            $s->kategori_id = $request->kategori;
            $s->nama = $request->nama;
            $s->stok = $request->stok;
            $s->harga = $request->harga;
            $s->gambar = $file;
        }else{
            $s->kategori_id = $request->kategori;
            $s->nama = $request->nama;
            $s->stok = $request->stok;
            $s->harga = $request->harga;
        }

        $s->save();
        Session::flash('pesan', 'Satu Barang berhasil diubah');
        Session::flash('alert-class', 'alert-success');
        return redirect('barang');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $h = Barang::find($id);
        Storage::delete('public/'.$h->gambar);
        $h->delete();
        Session::flash('pesan', 'Satu Barang berhasil dihapus');
        Session::flash('alert-class', 'alert-success');
        return redirect('barang');
    }
}

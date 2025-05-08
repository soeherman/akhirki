<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Session;
use Validator;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::paginate(10);
        return view('kategori.show', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategori.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|min:3',
        ]);
 
        if ($validator->fails()) {
            return redirect('kategori/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $s = new Kategori();
        $s->nama = $request->nama;
        $s->save();
        Session::flash('pesan', 'Satu Kategori berhasil ditambah');
        Session::flash('alert-class', 'alert-success');
        return redirect('kategori');
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
        $kategori = Kategori::find($id);
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|min:3',
        ]);
 
        if ($validator->fails()) {
            return redirect('kategori/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $s = Kategori::find($id);
        $s->nama = $request->nama;
        $s->save();
        Session::flash('pesan', 'Satu Kategori berhasil diubah');
        Session::flash('alert-class', 'alert-success');
        return redirect('kategori');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Kategori::destroy($id);
        Session::flash('pesan', 'Satu Kategori berhasil dihapus');
        Session::flash('alert-class', 'alert-success');
        return redirect('kategori');
    }
}

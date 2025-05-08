<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembeli;
use Session;
use Validator;

class PembeliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembeli = Pembeli::paginate(10);
        return view('pembeli.show', compact('pembeli'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pembeli.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|min:3',
            'jenis_kelamin' => 'required',
            'nohp' => 'required|numeric',
            'alamat' => 'required|string|min:5',
        ]);

        if ($validator->fails()) {
            return redirect('pembeli/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $s = new Pembeli();
        $s->nama = $request->nama;
        $s->jenis_kelamin = $request->jenis_kelamin;
        $s->nohp = $request->nohp;
        $s->alamat = $request->alamat;
        $s->save();
        Session::flash('pesan', 'Satu Pembeli berhasil ditambah');
        Session::flash('alert-class', 'alert-success'); 
        return redirect('pembeli');
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
        $pembeli = Pembeli::find($id);
        return view('pembeli.edit', compact('pembeli'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|min:3',
            'jenis_kelamin' => 'required',
            'nohp' => 'required|numeric',
            'alamat' => 'required|string|min:5',
        ]);

        if ($validator->fails()) {
            return redirect('pembeli/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $s = Pembeli::find($id);
        $s->nama = $request->nama;
        $s->jenis_kelamin = $request->jenis_kelamin;
        $s->nohp = $request->nohp;
        $s->alamat = $request->alamat;
        $s->save();
        Session::flash('pesan', 'Satu Pembeli berhasil diubah');
        Session::flash('alert-class', 'alert-success');
        return redirect('pembeli');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $h = Pembeli::find($id);
        $h->delete();
        Session::flash('pesan', 'Satu Pembeli berhasil dihapus');
        Session::flash('alert-class', 'alert-success');
        return redirect('pembeli');
    }
}

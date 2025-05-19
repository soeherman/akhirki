<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Session;
use Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $r)
    {
        if(empty($r)){
            $supplier = Supplier::paginate(10);
        }else{
            $nama = $r->nama_sup;
            $supplier = Supplier::where('nama','like','%'.$nama.'%')->paginate(10);
        }
        return view('supplier.show', compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|min:3',
            'kodepos' => 'required|string|min:3',
            'alamat' => 'required|string|min:5',
        ]);

        if ($validator->fails()) {
            return redirect('supplier/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $s = new Supplier();
        $s->nama = $request->nama;
        $s->kodepos = $request->kodepos;
        $s->alamat = $request->alamat;
        $s->save();
        Session::flash('pesan', 'Satu Supplier berhasil ditambah');
        Session::flash('alert-class', 'alert-success');
        return redirect('supplier');
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
        $supplier = Supplier::find($id);
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|min:3',
            'kodepos' => 'required|string|min:3',
            'alamat' => 'required|string|min:5',
        ]);

        if ($validator->fails()) {
            return redirect('supplier/'.$id.'/edit')
                        ->withErrors($validator)
                        ->withInput();
        }

        $s = Supplier::find($id);
        $s->nama = $request->nama;
        $s->kodepos = $request->kodepos;
        $s->alamat = $request->alamat;
        $s->save();
        Session::flash('pesan', 'Satu Supplier berhasil diubah');
        Session::flash('alert-class', 'alert-success');
        return redirect('supplier');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $h = Supplier::find($id);
        $h->delete();
        Session::flash('pesan', 'Satu Supplier berhasil dihapus');
        Session::flash('alert-class', 'alert-success'); 
        return redirect('supplier');
    }
}

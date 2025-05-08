@extends('index')
@section('konten')
    <div class="card mt-4">
        <div class="card-header">
            <div class="d-flex bd-highlight">
                <div class="p-2 bd-highlight">
                    <h5>Form tambah barang</h5>
                </div>
                <div class="ms-auto p-2 bd-highlight">
                    <a class="btn btn-outline-secondary btn-sm" href="{{url('barang')}}"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{url('barang')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" id="" class="form-select" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($kategori as $r)
                            <option value="{{$r->id}}">{{$r->nama}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" name="nama" required value="{{old('nama')}}">
                    @error('nama')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="text" class="form-control" name="stok" required value="{{old('stok')}}">
                    @error('stok')
                        <small class="text-danger">
                            {{ $message }}
                        </small>    
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="text" class="form-control" name="harga" required value="{{old('harga')}}">
                    @error('harga')
                        <small class="text-danger">
                            {{ $message }}
                        </small>    
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar</label>
                    <input type="file" class="form-control" name="gambar" required>
                    @error('gambar')
                        <small class="text-danger">
                            {{ $message }}
                        </small>    
                    @enderror
                </div>
                <input type="submit" class="btn btn-primary" value="Simpan">
            </form>
        </div>
        
    </div>
    
@endsection
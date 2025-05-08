@extends('index')
@section('konten')
    <div class="card mt-4">
        <div class="card-header">
            <div class="d-flex bd-highlight">
                <div class="p-2 bd-highlight">
                    <h5>Ubah data barang</h5>
                </div>
                <div class="ms-auto p-2 bd-highlight">
                    <a class="btn btn-outline-secondary btn-sm" href="{{url('pembeli')}}"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{url('pembeli/'.$pembeli->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" required value="{{$pembeli->nama}}">
                    @error('nama')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Kelamin</label>
                    <select name="jenis_kelamin" id="" class="form-select" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L" {{$pembeli->jenis_kelamin=='L'?'selected':''}}>Laki-laki</option>
                        <option value="P" {{$pembeli->jenis_kelamin=='P'?'selected':''}}>Perempuan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">No HP</label>
                    <input type="text" class="form-control" name="nohp" required value="{{$pembeli->nohp}}">
                    @error('nohp')
                        <small class="text-danger">
                            {{ $message }}
                        </small>    
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" required>{{$pembeli->alamat}}</textarea>
                    @error('alamat')
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
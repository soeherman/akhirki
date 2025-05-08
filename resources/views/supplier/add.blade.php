@extends('index')
@section('konten')
    <div class="card mt-4">
        <div class="card-header">
            <div class="d-flex bd-highlight">
                <div class="p-2 bd-highlight">
                    <h5>Form tambah supplier</h5>
                </div>
                <div class="ms-auto p-2 bd-highlight">
                    <a class="btn btn-outline-secondary btn-sm" href="{{url('supplier')}}"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{url('supplier')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" required value="{{old('nama')}}">
                    @error('nama')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Kode POS</label>
                    <input type="text" class="form-control" name="kodepos" required value="{{old('kodepos')}}">
                    @error('kodepos')
                        <small class="text-danger">
                            {{ $message }}
                        </small>    
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" required>{{old('alamat')}}</textarea>
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
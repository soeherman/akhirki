@extends('index')
@section('konten')
    <div class="card mt-4">
        <div class="card-header">
            <div class="d-flex bd-highlight">
                <div class="p-2 bd-highlight">
                    <h5>Form ubah pembelian</h5>
                </div>
                <div class="ms-auto p-2 bd-highlight">
                    <a class="btn btn-outline-secondary btn-sm" href="{{url('pembelian')}}"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{url('pembelian/'.$pembelian->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Nama Barang</label>
                    <select name="barang_id" id="" class="form-select" required>
                        @foreach ($barang as $b)
                            <option value="{{$b->id}}" {{$b->id == $pembelian->barang_id ? 'selected' : ''}}>{{$b->nama}}</option>
                        @endforeach
                    </select>
                    @error('barang_id')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Supplier</label>
                    <select name="supplier_id" id="" class="form-select" required>
                        @foreach ($supplier as $s)
                            <option value="{{$s->id}}" {{$s->id == $pembelian->supplier_id ? 'selected' : ''}}>{{$s->nama}}</option>
                        @endforeach
                    </select>
                    @error('supplier_id')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number" class="form-control" name="jumlah" required value="{{$pembelian->jumlah}}">
                    @error('jumlah')
                        <small class="text-danger">
                            {{ $message }}
                        </small>    
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <input type="date" name="tanggal" class="form-control" required value="{{$pembelian->tanggal}}">
                    @error('tanggal')
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
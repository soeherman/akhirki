@extends('index')
@section('konten')
    @include('message.message')
    <div class="card mt-4">
        <div class="card-header">
            <div class="d-flex bd-highlight">
                <div class="p-2 bd-highlight">
                    <h5>Daftar Barang</h5>
                </div>
                <div class="ms-auto p-2 bd-highlight">
                    <a class="btn btn-primary btn-sm" href="{{url('barang/create')}}"><i class="fa fa-plus"></i> Tambah Barang</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-condensed table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kategori</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($barang->isEmpty())
                        <tr>
                            <td colspan="7" align="center">Tidak ada data!</td>
                        </tr>
                    @else
                        @foreach($barang as $d=>$r)
                            <tr>
                                <td>{{$d+1}}</td>
                                <td>{{$r->kategori->nama}}</td>
                                <td>{{$r->nama}}</td>
                                <td>Rp. {{number_format($r->harga, 0, '.', '.')}}</td>
                                <td>{{$r->stok}}</td>
                                <td>
                                    <img src="{{asset('storage/'.$r->gambar)}}" alt="Gambar Barang" width="100px" height="100px" class="img-fluid">
                                </td>
                                <td>
                                    <form action="{{url('barang/'.$r->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{url('barang/'.$r->id.'/edit')}}" class="btn btn-primary btn-sm">Edit</a>
                                        <input onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')" type="submit" class="btn btn-danger btn-sm" value="Hapus">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $barang->links() }}
        </div>
    </div>
    
@endsection
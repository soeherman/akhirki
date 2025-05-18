@extends('index')
@section('konten')
    @include('message.message')
    <div class="card mt-4">
        <div class="card-header">
            <div class="d-flex bd-highlight">
                <div class="p-2 bd-highlight">
                    <h5>Daftar Penjualan Barang</h5>
                </div>
                <div class="ms-auto p-2 bd-highlight">
                    <a class="btn btn-primary btn-sm" href="{{url('penjualan/create')}}"><i class="fa fa-plus"></i> Tambah Penjualan</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-condensed table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Kasir</th>
                        <th>Pembeli</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($penjualan->isEmpty())
                        <tr>
                            <td colspan="5" align="center">Tidak ada data!</td>
                        </tr>
                    @else
                        @foreach($penjualan as $d=>$r)
                            <tr>
                                <td>{{$d+1}}</td>
                                <td>{{$r->kasir->username}}</td>
                                <td>{{$r->pembeli->nama}}</td>
                                <td>{{$r->tanggal_pesan}}</td>
                                <td>
                                    <form action="{{url('penjualan/'.$r->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
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
            {{ $penjualan->links() }}
        </div>
        
    </div>
    
@endsection
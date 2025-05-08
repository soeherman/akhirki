@extends('index')
@section('konten')
    @include('message.message')
    <div class="card mt-4">
        <div class="card-header">
            <div class="d-flex bd-highlight">
                <div class="p-2 bd-highlight">
                    <h5>Daftar Supplier</h5>
                </div>
                <div class="ms-auto p-2 bd-highlight">
                    <a class="btn btn-primary btn-sm" href="{{url('supplier/create')}}"><i class="fa fa-plus"></i> Tambah Supplier</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-condensed table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Kode POS</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($supplier->isEmpty())
                        <tr>
                            <td colspan="5" align="center">Tidak ada data!</td>
                        </tr>
                    @else
                        @foreach($supplier as $d=>$r)
                            <tr>
                                <td>{{$d+1}}</td>
                                <td>{{$r->nama}}</td>
                                <td>{{$r->kodepos}}</td>
                                <td>{{$r->alamat}}</td>
                                <td>
                                    <form action="{{url('supplier/'.$r->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{url('supplier/'.$r->id.'/edit')}}" class="btn btn-primary btn-sm">Edit</a>
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
            {{ $supplier->links() }}
        </div>
        
    </div>
    
@endsection

    <div class="card mt-4">
        <div class="card-header">
            <div class="d-flex bd-highlight">
                <div class="p-2 bd-highlight">
                    <h5>Daftar Penjualan Barang</h5>
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
                            </tr>
                        @endforeach
                    @endif
                    
                </tbody>
            </table>
        </div>
    </div>
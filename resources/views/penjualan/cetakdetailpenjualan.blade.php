<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Detail Penjualan</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                <div class="card-header">
                    <div class="d-flex bd-highlight">
                        <div class="p-2 bd-highlight">
                            <h5>Detail Penjualan</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td width="15%"><b>Nomor Transaksi</b></td>
                            <td width="1%">:</td>
                            <td>{{$penjualan->id}}</td>
                        </tr>
                        <tr>
                            <td width="15%"><b>Kasir</b></td>
                            <td width="1%">:</td>
                            <td>{{$penjualan->kasir->username}}</td>
                        </tr>
                        <tr>
                            <td width="15%"><b>Pembeli</b></td>
                            <td width="1%">:</td>
                            <td>{{$penjualan->pembeli->nama}}</td>
                        </tr>
                        <tr>
                            <td width="15%"><b>Nomor Transaksi</b></td>
                            <td width="1%">:</td>
                            <td>{{$penjualan->tanggal_pesan}}</td>
                        </tr>
                    </table>
                    <h5>Daftar Barang</h5>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $tot = 0;   
                                @endphp
                                @foreach ($detail as $d=>$dd)
                                <tr>
                                    <td>{{$d+1}}</td>
                                    <td>{{$dd->barang->nama}}</td>
                                    <td>{{$dd->jumlah}}</td>
                                    <td>Rp. {{number_format($dd->barang->harga,0,'.','.')}}</td>
                                    <td>Rp. {{number_format($dd->total_harga,0,'.','.')}}</td>
                                    @php
                                        $tot += $dd->total_harga;
                                    @endphp
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" align="right"><b>Total :</b></td>
                                    <td><b>Rp. {{number_format($tot, 0,'.','.')}}</b></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card-footer p-2">
                    <div class="text-center">
                        Toko Madura {{date('Y')}}
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</body>
</html>
    

@extends('index')
@section('konten')
<div class="row mt-4">
    <div class="col-md-12">
        <h5>Selamat datang kembali, {{session('yangmasuk')}}</h5>
        <p>Selamat datang di Warung Madura, kami akan membantu anda dengan pengaturan barang yang dibutuhkan.</p>
    </div>
    <div class="col-md-3">
        <div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-4 d-flex flex-grow-1 justify-content-center align-items-center">
                <h1 class="display-3" style="color: #6a994e !important; opacity: 0.8;">
                    <i class="fa-solid fa-sack-dollar"></i>
                </h1>
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h4 class="card-title" style="color: #386641 !important;">Rp. 2.000.000</h4>
                  <p class="card-text"><small class="text-muted">Transaksi hari ini</small></p>
                </div>
              </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-4 d-flex flex-grow-1 justify-content-center align-items-center">
                <h1 class="display-3" style="color: #168aad !important; opacity: 0.8;">
                    <i class="fa-solid fa-cart-shopping"></i>
                </h1>
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h4 class="card-title" style="color: #1e6091 !important;">30</h4>
                  <p class="card-text"><small class="text-muted">Barang terjual</small></p>
                </div>
              </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-4 d-flex flex-grow-1 justify-content-center align-items-center">
                <h1 class="display-3" style="color: #9d4edd !important; opacity: 0.8;">
                    <i class="fa-solid fa-inbox"></i>
                </h1>
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h4 class="card-title" style="color: #3c096c !important;">20</h4>
                  <p class="card-text"><small class="text-muted">Barang masuk</small></p>
                </div>
              </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-4 d-flex flex-grow-1 justify-content-center align-items-center">
                <h1 class="display-3" style="color: #8b5e34 !important; opacity: 0.8;">
                    <i class="fa-solid fa-dolly"></i>
                </h1>
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h4 class="card-title" style="color: #603808 !important;">20</h4>
                  <p class="card-text"><small class="text-muted">Jumlah transaksi</small></p>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>   
<div class="row">
    <div class="col-md-12">
        <div class="card mt-4">
            <div class="card-header">
                <div class="d-flex bd-highlight">
                    <div class="p-2 bd-highlight">
                        <h5>Daftar Barang Stok minim</h5>
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
                                </tr>
                            @endforeach
                        @endif
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

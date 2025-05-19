<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas Akhir</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('fa/css/all.min.css')}}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand" href="{{url('')}}">Warung Madura</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Manajemen Barang
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="{{url('kategori')}}">Kategori</a></li>
                    <li><a class="dropdown-item" href="{{url('barang')}}">Barang</a></li>
                </ul>
            </li>
            <li>
              <a class="nav-link" href="{{url('pembeli')}}">Pembeli</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Kulakan Barang
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="{{url('supplier')}}">Supplier</a></li>
                    <li><a class="dropdown-item" href="{{url('pembelian')}}">Restok Barang</a></li>
                </ul>
            </li>
              
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Penjualan
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="{{url('penjualan')}}">Penjualan</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa-solid fa-user"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><h6 class="dropdown-header">{{session('namayangmasuk')}}</h6></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="{{url('/logout')}}">Keluar</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
    </nav>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          @yield('konten')
        </div>
      </div>
    </div>
</body>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
</html>
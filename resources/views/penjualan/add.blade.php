@extends('index')
@section('konten')
<form action="{{url('penjualan')}}" method="POST" enctype="multipart/form-data">
    <div class="card mt-4">
        <div class="card-header">
            <div class="d-flex bd-highlight">
                <div class="p-2 bd-highlight">
                    <h5>1. Pilih pembeli</h5>
                </div>
                <div class="ms-auto p-2 bd-highlight">
                    <a class="btn btn-outline-secondary btn-sm" href="{{url('penjualan')}}"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
        <div class="card-body">
                @csrf
                <div class="mb-3">
                    <select name="pembeli_id" id="" class="form-select" required>
                        <option value="">Pilih Pembeli</option>
                        @foreach ($pembeli as $s)
                            <option value="{{$s->id}}">{{$s->nama}}</option>
                        @endforeach
                    </select>
                    @error('pembeli_id')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex bd-highlight">
                        <div class="p-2 bd-highlight">
                            <h5>2. Pilih barang yang mau dibeli</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <select name="barang_id" id="barang_id" class="form-select barang_id" required>
                                <option value="">Pilih Barang</option>
                                @foreach ($barang as $b)
                                    <option value="{{$b->id}}">{{$b->nama}}</option>
                                @endforeach
                            </select>
                            @error('barang_id')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <input type="number" class="form-control jumlahdibeli" name="jumlahdibeli" id="jumlahdibeli" required placeholder="Jumlah dibeli">
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-secondary addbarang" type="button"><i class="fa-solid fa-plus"></i> Tambah</button>
                        </div>
                        
                    </div>
                    <div class="table-responsive">
                        <table class="table table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="innerBarang">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="d-flex bd-highlight">
                        <div class="p-2 bd-highlight">
                            <h5>3. Pembayaran</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h6>Total Harga</h6>
                    <input type="hidden" class="totalharga" value="0" id="totalharga">
                    <input type="hidden" class="jmlbarangdibeli" value="0" id="jmlbarangdibeli">
                    <h3 class="text-success" id="vtotalharga">Rp. 0</h3>
                    <h6>Bayar</h6>
                    <input type="number" class="form-control bayar" name="bayar" required>
                    <hr>
                    <h6>Kembalian</h6>
                    <h3 class="text-secondary" id="vkembalian">Rp. 0</h3>
                    <input type="submit" class="btn btn-primary w-100 mt-2" value="Simpan">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="{{ asset('rupiah2.js') }}"></script>
<script>
    $(document).on('click', ".addbarang", function() {
        var idbarang = $('.barang_id').val();
        var jmldibeli = $('.jumlahdibeli').val();
        var totalharga = $('.totalharga').val();
        var jmlbarangdibeli = $('.jmlbarangdibeli').val();
        var totjmlbarangdibeli = Number(jmlbarangdibeli) + 1;
        $.ajax({
            url: '/api/barang/' + idbarang,
            type: "GET",
            dataType: 'json',
            cache: false,
            data: '',
            success: function(response) {
                $("#innerBarang").append('<tr class="databrg"><td><input readonly name="barang_idnya[]" type="text" class="border-0" value="' +
                    response.id +
                    '"/></td><td><input readonly name="namabarang[]" type="text" class="border-0" value="' +
                    response.nama +
                    '"/></td><td><input readonly name="jumlahdibeli[]" type="text" class="border-0" value="' +
                    jmldibeli +
                    '"/></td><td><input type="number" name="hargabarang[]" class="border-0" value="' +
                    response.harga +
                    '"/></td><td><input type="number" name="totaldibeli[]" class="border-0" value="' +
                    jmldibeli * response.harga +
                    '"/></td><td><button type="button" class="btn btn-danger hapusbarang" value="'+totjmlbarangdibeli+'" data-harga="'+jmldibeli*response.harga+'">Hapus</button></td></tr>')
                document.getElementById("vtotalharga").innerHTML = 'Rp. '+formatRupiah(Number(totalharga) + (jmldibeli * response.harga))
                $("#totalharga").val(Number(totalharga) + (jmldibeli * response.harga))
                $('#jmlbarangdibeli').val(totjmlbarangdibeli)
                
            },
            error: function(x, e) {
                alert(e)
            }
        });
    });

    $(document).on("click", ".hapusbarang", function() {
        var jmlbarangdibeli = $('#jmlbarangdibeli').val();
        var harga = $(this).data('harga');
        var hargasebelumnya = $('#totalharga').val();
        var totalharga = Number(hargasebelumnya) - Number(harga);
        var barangke = $(this).val() - 1;
        var parent = document.getElementById("innerBarang");
        var child = parent.getElementsByClassName("databrg")[barangke]
        parent.removeChild(child)
        $('#jmlbarangdibeli').val(Number(jmlbarangdibeli) - 1)
        document.getElementById("vtotalharga").innerHTML = 'Rp. '+formatRupiah(Number(totalharga))
        $("#totalharga").val(totalharga)
    });

    $(document).on('change keydown paste input', ".bayar", function() {
        var bayar = $(this).val();
        var totalharga = $('#totalharga').val();
        var kembalian = Number(bayar) - Number(totalharga);
        document.getElementById("vkembalian").innerHTML = 'Rp. '+formatRupiah(kembalian)
    });
</script>
@extends('template.main')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="page-header">
                <h4 class="page-title" style="width: 14rem">Laporan Pembelian</h4>
                <ul class="breadcrumbs" style="font-weight: bold; width: 49rem">
                    <li class="nav-home">
                        <a href="#" >
                            <i class="fa fa-book" aria-hidden="true"></i>
                        </a>    
                    </li>
                    <li class="separator">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Laporan Pembelian</a>
                    </li>
                </ul>
            </div>
            <hr>
            <table class="table table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>Nomer Pembelian</th>
                        <th>Tanggal</th>
                        <th>Nama Produk</th>
                        <th>Jumlah Produk</th>
                        <th>Grantotal</th>
                    </tr>
                </thead>
                <tbody class="rinci">
                    @foreach ($pembelian as $ireng)
                        <tr>
                            <td>
                                <a style="text-decoration: none" href="{{ route('laporan.pembelian-show', $ireng->id) }}">{{ $ireng->nomer_pembelian }}</a>
                            </td>
                            <td>{{ date('Y/m/d', strtotime($ireng->tanggal)) }}</td>
                            <td class="produk">
                                @foreach ($ireng->pembelianRinci as $item)
                                    {{ $item->produk->produk_nama }},
                                @endforeach
                            </td>
                            <td class="qty">
                                @foreach ($ireng->pembelianRinci as $item)
                                {{ $item->produk->produk_nama }} ({{ $item->qty }}) + 
                                @endforeach
                            </td>
                            <td class="harga">
                                Rp{{ number_format($ireng->grantotal, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="page-header">
                <h4>Total Pengeluaran</h4>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <label for="">Pilih Bulan</label>
                    <input type="month" id="bulan" value="{{ date('Y-m') }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="">Total</label>
                    <input type="text" id="grantotal" class="form-control" readonly style="color: black">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable({
                ordering: false,
                pageLength: 50
            });

            $('.qty').each(function(){
                let text = $(this).text()

                text = text.replace(/\s*\+\s*$/, '');
                $(this).text(text);
            })

            $('.produk').each(function(){
                let text = $(this).text()

                text = text.replace(/\s*\,\s*$/, '');
                $(this).text(text);
            })

            $('.harga').each(function(){
                let text = $(this).text()

                text = text.replace(/\s*\,\s*$/, '');
                $(this).text(text);
            })

            function hitungGrantotal(tanggal) {
                var totalGrantotal = 0;

                // Loop melalui setiap baris laporan penjualan di dalam tbody dengan class "rinci"
                $(".rinci tr").each(function() {
                    // Ambil nilai tanggal dari kolom kedua (index 1)
                    var rowTanggal = $(this).find("td:eq(1)").text();
                    
                    // Konversi format rowTanggal dan hilangkan tanggal hari
                    var formattedRowTanggal = rowTanggal.replace(/\//g, '-').slice(0, 7); // mengganti '/' dengan '-' dan mengambil 7 karakter pertama (YYYY-MM)
                    console.log(formattedRowTanggal);
                    
                    // Jika tanggal sesuai dengan yang dipilih, tambahkan grantotal ke totalGrantotal
                    if (formattedRowTanggal == tanggal) {
                        // Ambil nilai grantotal dari kolom kelima (index 4)
                        var rowGrantotal = $(this).find("td:eq(4)").text().replace('Rp', '').replace('.', '').replace(',', '').trim();
                        totalGrantotal += parseInt(rowGrantotal);
                    }
                });

                // Set nilai grantotal pada elemen input grantotal
                $("#grantotal").val("Rp" + totalGrantotal.toLocaleString('id-ID'));
            }

            // Panggil fungsi hitungGrantotal saat halaman dimuat
            hitungGrantotal($("#bulan").val());

            // Event listener untuk perubahan nilai pada input bulan
            $("#bulan").change(function() {
                var selectedBulan = $(this).val();
                hitungGrantotal(selectedBulan);
            });
        });
    </script>
@endsection
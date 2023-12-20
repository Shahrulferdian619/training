@extends('template.main')

@section('content')
<style>
    #invoice{
        box-shadow: 0 0 1in -0.25in rgb(0, 0, 0.5);
        padding: 2mm;
        margin: 0 auto;
        width: 58mm;
        background: #fff;
        overflow: hidden;
    }
</style>
    @if (session('sukses'))
        <div class="row" id="sukses">
            <div class="col-md-12">
                <div class="card" style="background: rgb(0, 74, 165)">
                    <div class="card-body">
                        <h5 style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; color: white">{{ session('sukses') }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <script>
            setTimeout(function() {
                var successDiv = document.getElementById('sukses');
                if (successDiv) {
                    successDiv.style.display = 'none';
                }
            }, 3000);
        </script>
    @endif      

    <div class="card">
        <div class="card-body">
            <div class="page-header">
                <h2 style="width: 50%">Detail Pembelian</h2>
                <div style="text-align: right; width: 50%">
                    <a href="#" data-toggle="modal" data-target="#exampleModalCenter" style="text-decoration: none"><i class="fa fa-print" aria-hidden="true"></i> Cetak</a>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">                    
                    <table>
                        <tr>
                            <td style="width: 200px">Nomer Pembelian</td>
                            <td>: {{$data->nomer_penjualan}}</td>
                        </tr>
                        <tr>
                            <td style="width: 200px">Tanggal</td>
                            <td>: {{ date('Y/m/d', strtotime($data->tanggal)) }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table>
                        <tr>
                            <td style="width: 200px">Metode Pembayaran</td>
                            <td>: @if ($data->metode_pembayaran == 1) Cash @elseif($data->metode_pembayaran == 2) Bank @else Rekening @endif</td>        
                        </tr>
                        <tr>
                            <td style="width: 200px">Keterangan</td>
                            <td>: {{ $data->keterangan }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="page-header">
                Rincian Produk
            </div>
            <hr>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Diskon</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data->penjualanRinci as $ireng)
                        <tr>
                            <td>{{ $ireng->produk->produk_nama }}</td>
                            <td>{{ $ireng->harga_jual }}</td>
                            <td>{{ $ireng->qty }}</td>
                            <td>{{ $ireng->diskon }}</td>
                            <td>{{ $ireng->subtotal }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Grantotal</th>
                        <th>{{ $data->grantotal }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Kuitansi Pembelian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="button" class="form-control print-kuitansi" style="background: rgb(41, 41, 255); margin-bottom: 10px;" value="Print">
                    <div id="invoice" style="margin-bottom: 10px">
                        <div>
                            <center>
                                <div class="logo"></div>
                                <div class="info"></div>
                                <h2 style="color: black; font-weight: bold;">POS</h2>
                            </center>
                        </div>
                
                        <div class="mid">
                            <div class="info">
                                <h2 style="font-size: 18px; color: black;">Contact Us</h2>
                                <table style="font-size: 13px; color: black; font-size: 12px; margin-top: -10px;">
                                    <tr>
                                        <td>Alamat</td>
                                        <td>: Jabon</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>: jabon@gmail.com</td>
                                    </tr>
                                    <tr>
                                        <td>No Hp</td>
                                        <td>: 1234567890</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                
                        <div style="text-align: center; color: #919191;">=======</div>
                
                        <div style="color: black;">
                            <table style="font-size: 12px;">
                                <tr>
                                    <td style="width: 50%">No Pembelian</td>
                                    <td>: {{ $data->nomer_penjualan }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td>: {{ date('Y/m/d', strtotime($data->tanggal)) }}</td>
                                </tr>
                                <tr>
                                    <td>Meotde Pembayaran</td>
                                    <td>: @if ($data->metode_pembayaran == 1) Cash @elseif($data->metode_pembayaran == 2) Bank @else Rekening @endif</td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>: {{ $data->keterangan }}</td>
                                </tr>
                            </table>
                        </div>
                
                        <table class="" style="color: black;width: 100%">
                            <thead style="width: 100%; border-collapse: collapse;">
                                <tr style="font-size: 10px; background: #b8b8b8;">
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Diskon</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 10px">
                                @foreach ($data->penjualanRinci as $ireng)
                                    <tr>
                                        <td>{{ $ireng->produk->produk_nama }}</td>
                                        <td>{{ $ireng->harga_jual }}</td>
                                        <td>{{ $ireng->qty }}</td>
                                        <td style="text-align: center;">{{ $ireng->diskon }}</td>
                                        <td style="text-align: right;">{{ $ireng->subtotal }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <thead>
                                <tr style="font-size: 10px; background: #b8b8b8;">
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Grantotal</th>
                                    <th style="text-align: right;">{{ $data->grantotal }}</th>
                                </tr>
                            </thead>
                        </table>
                
                        <div style="margin-top: 12px;">
                            <h2 style="font-size: 15px; color: #747474;">Thank you for visiting</h2>
                            <p style="font-size: 10px; color: #9f9f9f; margin-top: -10px;">Lorem, ipsum dolor sit amet consectetur</p>
                        </div>        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <a href="{{ route('penjualan.produk-create') }}" class="btn btn-outline-danger">Batal</a>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Add click event listener to print-kuitansi button
            $('.print-kuitansi').on('click', function() {
                // Create a new window or iframe
                var printWindow = window.open('', '_blank', 'width=400,height=400,top=' + (screen.height / 2 - 200) + ',left=' + (screen.width / 2 - 200));

                // Write the content of #invoice to the new window or iframe
                printWindow.document.write('<style>body { width: 58mm; margin: 0 auto; }</style>');
                printWindow.document.write('<html><head><title>POS</title></head><body>');
                printWindow.document.write($('#invoice').html());
                printWindow.document.write('</body></html>');

                // Trigger the print functionality on the new window or iframe
                printWindow.print();
            });
        });
    </script>
@endsection
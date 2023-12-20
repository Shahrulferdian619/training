@extends('template.main')

@section('content')
    <style>
        table.custom-table td, table.custom-table th {
        padding-bottom: 20px;
    }
    </style>
    <div class="card">
        <div class="card-body">
            <div class="page-header">
                <h4 class="page-title" style="width: 13rem">Laporan Penjualan</h4>
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
                        <a href="#">Laporan Penjualan</a>
                    </li>
                    <li class="separator">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Detail</a>
                    </li>
                </ul>
            </div>
            <hr>
            <table class="custom-table" style="font-size: 13px">
                <tr>
                    <th style="width: 300px">Nomer Penjualan</th>
                    <td>: {{ $penjualan->nomer_penjualan }}</td>
                </tr>
                <tr>
                    <th style="width: 300px">Tanggal Penjualan</th>
                    <td>: {{ date('Y/m/d', strtotime($penjualan->tanggal)) }}</td>
                </tr>
                <tr>
                    <th style="width: 300px">Metode Pembayaran</th>
                    <td>: @if ($penjualan->metode_pembayaran == 1) Cash @elseif($penjualan->metode_pembayaran == 2) Bank Transfer @else Rekening @endif</td>              
                </tr>
                <tr>
                    <th style="width: 300px">Keterangan</th>
                    <td>: {{ $penjualan->keterangan }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="card-header">
                <h4>Rincian Penjualan</h4>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Jumlah Terjual</th>
                        <th>Harga Jual</th>
                        <th>Diskon</th>
                        <th style="text-align: right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penjualan->penjualanRinci as $item)
                        <tr>
                            <td>{{ $item->produk->produk_nama }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>Rp{{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                            <td>{{ $item->diskon }}</td>
                            <td style="text-align: right">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Grantotal</th>
                        <th style="text-align: right">Rp{{ number_format($penjualan->grantotal, 0, ',', '.') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <a href="{{ route('laporan.penjualan-index') }}" class="btn btn-outline-danger">Kembali</a>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready( function () {

        });
    </script>
@endsection
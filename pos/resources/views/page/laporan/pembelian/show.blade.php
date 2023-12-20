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
                    <th style="width: 300px">Nomer Pembelian</th>
                    <td>: {{ $pembelian->nomer_pembelian }}</td>
                </tr>
                <tr>
                    <th style="width: 300px">Tanggal Pembelian</th>
                    <td>: {{ date('Y/m/d', strtotime($pembelian->tanggal)) }}</td>
                </tr>
                <tr>
                    <th style="width: 300px">Keterangan</th>
                    <td>: {{ $pembelian->keterangan }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="card-header">
                <h4>Rincian Pembelian</h4>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Jumlah Kuantitas</th>
                        <th>Harga Beli</th>
                        <th>Diskon</th>
                        <th style="text-align: right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pembelian->pembelianRinci as $item)
                        <tr>
                            <td>{{ $item->produk->produk_nama }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>Rp{{ number_format($item->beli, 0, ',', '.') }}</td>
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
                        <th style="text-align: right">Rp{{ number_format($pembelian->grantotal, 0, ',', '.') }}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <a href="{{ route('laporan.pembelian-index') }}" class="btn btn-outline-danger">Kembali</a>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready( function () {

        });
    </script>
@endsection
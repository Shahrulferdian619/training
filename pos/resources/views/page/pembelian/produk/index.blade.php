@extends('template.main')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="page-header">
                <h4 class="page-title" style="width: 13rem">Pembelian Produk</h4>
                <ul class="breadcrumbs" style="font-weight: bold; width: 49rem">
                    <li class="nav-home">
                        <a href="#" >
                            <i class="fa fa-truck" aria-hidden="true"></i>
                        </a>    
                    </li>
                    <li class="separator">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Pembelian Produk</a>
                    </li>
                </ul>
                <a href="{{ route('pembelian.produk-create') }}" style="font-size: 25px;text-decoration: none">
                    <i style="color: rgb(51, 140, 200)" class="fa fa-plus-circle" aria-hidden="true"></i> 
                </a>
            </div>
            <hr>
            <table class="table table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>Nomer Pembelian</th>
                        <th>Produk</th>
                        <th>Harga Beli</th>
                        <th>Tanggal</th>
                        <th>Qty</th>
                        <th>Grantotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $produk)
                        <tr>
                            <td>
                                <a style="text-decoration: none" href="{{ route('pembelian.produk-edit', $produk->id) }}">{{ $produk->nomer_pembelian }}</a>
                            </td>
                            <td>
                                @foreach ($produk->pembelianRinci as $item)
                                    {{ $item->produk->produk_nama }},
                                @endforeach
                            </td>
                            <td>
                                @foreach ($produk->pembelianRinci as $item)
                                    Rp{{ number_format($item->harga_beli, 0, ',', '.') }}
                                @endforeach
                            </td>
                            <td>{{ date('Y/m/d', strtotime($produk->tanggal)) }}</td>
                            <td>
                                @foreach ($produk->pembelianRinci as $item)
                                    {{ $item->qty }}
                                @endforeach
                            </td>
                            <td>{{ $produk->grantotal }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready( function () {
            $('#myTable').DataTable({
                ordering: false
            });
        } );
    </script>
@endsection
@extends('template.main')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="page-header">
                <h4 class="page-title" style="width: 16rem">Pembelian Kebutuhan</h4>
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
                        <a href="#">Pembelian Kebutuhan</a>
                    </li>
                </ul>
                <a href="{{ route('pembelian.lainnya-create') }}" style="font-size: 25px;text-decoration: none">
                    <i style="color: rgb(51, 140, 200)" class="fa fa-plus-circle" aria-hidden="true"></i> 
                </a>
            </div>
            <hr>
            <table class="table table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>Nomer Pembelian</th>
                        <th>Nama Barang</th>
                        <th>Harga Beli</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $ireng)
                        <tr>
                            <td>
                                <a style="text-decoration: none" href="{{ route('pembelian.lainnya-edit', $ireng->id) }}">{{ $ireng->nomer_pembelian }}</a>
                            </td>
                            <td class="produk">
                                @foreach ($ireng->kebutuhanRinci as $item)
                                    {{ $item->nama_barang }},
                                @endforeach
                            </td>
                            <td>
                                @foreach ($ireng->kebutuhanRinci as $item)
                                    Rp{{ number_format($item->harga, 0, ',','.') }}
                                @endforeach
                            </td>
                            <td>{{ $ireng->tanggal }}</td>
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

            $('.produk').each(function(){
                let text = $(this).text()

                text = text.replace(/\s*\,\s*$/, '');
                $(this).text(text);
            })
        });
    </script>
@endsection
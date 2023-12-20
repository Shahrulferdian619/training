@extends('template.main')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="page-header">
                <h4 class="page-title" style="width: 12rem">Produk Jual</h4>
                <ul class="breadcrumbs" style="font-weight: bold; width: 49rem">
                    <li class="nav-home">
                        <a href="#" >
                            <i class="fa fa-cubes" aria-hidden="true"></i>
                        </a>    
                    </li>
                    <li class="separator">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Produk Jual</a>
                    </li>
                </ul>
                <a href="{{ route('persediaan.jual-create') }}" style="font-size: 25px;text-decoration: none">
                    <i style="color: rgb(51, 140, 200)" class="fa fa-plus-circle" aria-hidden="true"></i> 
                </a>
            </div>
            <hr>
            <table class="table table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>
                                <a href="{{ route('persediaan.jual-edit', $item->id) }}" style="text-decoration: none">{{ $item->nama_produk }}</a>
                            </td>
                            <td>{{ $item->kategori->nama_kategori }}</td>
                            <td>{{ $item->harga_jual }}</td>
                            <td>{{ $item->stok }}</td>
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
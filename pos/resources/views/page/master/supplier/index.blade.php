@extends('template.main')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="page-header">
                <h4 class="page-title">Supplier</h4>
                <ul class="breadcrumbs" style="font-weight: bold; width: 55rem">
                    <li class="nav-home">
                        <a href="#" >
                            <i class="fa fa-th" aria-hidden="true"></i>
                        </a>    
                    </li>
                    <li class="separator">
                        <i class="fa fa-angle-right" aria-hidden="true"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Supplier</a>
                    </li>
                </ul>
                <a href="{{ route('master.supplier-create') }}" style="font-size: 25px;text-decoration: none">
                    <i style="color: rgb(51, 140, 200)" class="fa fa-plus-circle" aria-hidden="true"></i> 
                </a>
            </div>
            <hr>
            <table class="table table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>Nama Supplier</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>No Handphone</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>
                                <a href="{{ route('master.supplier-edit', $item->id) }}" style="text-decoration: none">{{ $item->nama_supp }}</a>
                            </td>
                            <td>{{ $item->alamat }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->no_hp }}</td>
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
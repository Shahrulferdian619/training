@extends('template.main')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="page-header">
                <h4 class="page-title" style="width: 7rem">User</h4>
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
                        <a href="#">User</a>
                    </li>
                </ul>
                <a href="{{ route('master.user-create') }}" style="font-size: 25px;text-decoration: none">
                    <i style="color: rgb(51, 140, 200)" class="fa fa-plus-circle" aria-hidden="true"></i>
                </a>
            </div>
            <hr>
            <table class="table table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Role</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>
                                <a href="{{ route('master.user-edit', $item->id) }}" style="text-decoration: none">{{ $item->name }}</a>
                            </td>
                            <td>
                                @if ($item->level == 2)
                                    Supplier
                                @elseif($item->level == 0)
                                    Kasir
                                @endif
                            </td>
                            <td>{{ $item->email }}</td>
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
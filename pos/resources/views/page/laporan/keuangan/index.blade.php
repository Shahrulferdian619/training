@extends('template.main')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="page-header">
                <h4 class="page-title" style="width: 14rem">Laporan Keuangan</h4>
                <ul class="breadcrumbs" style="font-weight: bold; width: 49rem">
                    <li class="nav-home">
                        {{ date('Y/m/d', strtotime($tanggal_awal)) }} s/d {{ date('Y/m/d', strtotime($tanggal_akhir)) }}
                    </li>
                </ul>
            </div>
            <hr>
            <button onclick="updatePeriode()" class="btn btn-success btn-sm">Ubah Periode</button>
            <a href="{{ route('laporan.keuangan-exportPDF', [$tanggal_awal, $tanggal_akhir]) }}" target="_blank" class="btn btn-info btn-sm">Export PDF</a>
            <table id="myTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th> 
                        <th>Tanggal</th>
                        <th>Penjualan</th>
                        <th>Pembelian</th>
                        <th>Pengeluaran</th>
                        <th>Pendapatan</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background: rgb(0, 0, 43)" >
                <form action="{{ route('laporan.keuangan-ubahPeriode') }}" method="get">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Periode Laporan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
    
                    <div class="modal-body">
                        <label for="">Tanggal Awal</label>
                        <input type="text" name="tanggal_awal" class="form-control datepicker" id="tanggal_awal" value="{{ request('tanggal_awal') }}">

                        <label for="">Tanggal Akhir</label>
                        <input type="text" name="tanggal_akhir" class="form-control datepicker" id="tanggal_akhir" value="{{ request('tanggal_akhir') }}">
                    </div>
    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            table = $('#myTable').DataTable({
                processing: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('laporan.keuangan-data', ['awal' => $tanggal_awal, 'akhir' => $tanggal_akhir]) }}',
                },
                columns: [
                    {data: 'DT_RowIndex', searchable: false, shortable: false},
                    {data: 'tanggal'},
                    {data: 'penjualan'},
                    {data: 'pembelian'},
                    {data: 'pengeluaran'},
                    {data: 'pendapatan'},
                ],
                dom: 'Brt',
                bSort: false,
                bPaginate: false
            });

            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
        });

        function updatePeriode(){
            $('#exampleModal').modal('show')
        }
    </script>
@endsection
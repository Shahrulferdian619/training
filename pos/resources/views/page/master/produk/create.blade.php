@extends('template.main')

@section('content')
    <form action="{{ route('master.produk-store') }}" method="POST">
        @csrf
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

        @if ($errors->any())
            @error('kategori.*.nama_kategori')
                <div class="row" id="nama_kategori">
                    <div class="col-md-12">
                        <div class="card" style="background: rgb(255, 0, 0)">
                            <div class="card-body">
                                <h5 style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; color: rgb(255, 255, 255)">{{ $message }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    setTimeout(function() {
                        var errorDiv = document.getElementById('nama_kategori');
                        if (errorDiv) {
                            errorDiv.style.display = 'none';
                        }
                    }, 3000);
                </script>
            @enderror
        @endif
        <div class="card">
            <div class="card-body">
                <div class="page-header">
                    <h4 class="page-title" style="width: 12rem">Produk Kategori</h4>
                    <ul class="breadcrumbs" style="font-weight: bold; width: 49rem">
                        <li class="nav-home">
                            <a href="#" >
                                <i class="fa fa-th" aria-hidden="true"></i>
                            </a>    
                        </li>
                        <li class="separator">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Produk Kategori</a>
                        </li>
                        <li class="separator">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Buat</a>
                        </li>
                    </ul>
                </div>
                <hr>
                <div class="row">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="background: ">Nama Kategori</th>
                                <th>Keterangan</th>
                                <th style="text-align: center;">
                                    <button type="button" class="btn btn-outline-success tambah">
                                        <i class="fa fa-plus-square" aria-hidden="true"></i>
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="kategori-body">
                            @if (old('kategori'))
                                @foreach (old('kategori') as $key => $item)
                                    <tr class="kategori-{{$key}}">
                                        <td style="height: 110%;">
                                            <input type="text" class="form-control" style="width: 110%;" name="kategori[{{$key}}][nama_kategori]" value="{{ $item['nama_kategori'] }}">
                                        </td>
                                        <td style="height: 110%;">
                                            <input type="text" class="form-control" name="kategori[{{$key}}][keterangan]" value="{{ $item['keterangan'] }}">
                                        </td>
                                        <td style="text-align: center">
                                            <button type="button" class="btn btn-outline-danger kurang">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>   
                                @endforeach
                            @else
                                <tr class="kategori-0">
                                    <td style="height: 110%;">
                                        <input type="text" class="form-control" style="width: 110%;" name="kategori[0][nama_kategori]">
                                    </td>
                                    <td style="height: 110%;">
                                        <input type="text" class="form-control" name="kategori[0][keterangan]">
                                    </td>
                                    <td style="text-align: center">
                                        <button type="button" class="btn btn-outline-danger kurang">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                </tr>                                
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <button class="btn btn-outline-success" type="submit">Simpan</button>
                <a href="{{ route('master.produk-index') }}" class="btn btn-outline-danger">Batal</a>
            </div>
        </div>
    </form>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            const bodykat = $('.kategori-body')
            let rowBody = $('.kategori-body')[0].rows.length

            $(document).on('click', '.tambah', function(){
                let tr = `
                    <tr class="kategori-${rowBody}">
                        <td style="height: 110%;">
                            <input type="text" class="form-control" style="width: 110%" name="kategori[${rowBody}][nama_kategori]">
                        </td>
                        <td style="height: 110%;">
                            <input type="text" class="form-control" name="kategori[${rowBody}][keterangan]">
                        </td>
                        <td style="text-align: center">
                            <button type="button" class="btn btn-outline-danger kurang">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                `
                bodykat.append(tr)
                rowBody++
                removeBtn()
            })

            $(document).on('click', '.kurang', function(){
                $(this).closest('tr').remove()
                removeBtn()
            })

            function removeBtn (){
                if ($('.kategori-body')[0].rows.length == 1) {
                    $('.kurang')[0].disabled = true
                }else{
                    $('.kurang')[0].disabled = false
                }
            }

            removeBtn()
        });
    </script>
@endsection
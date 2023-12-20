@extends('template.main')

@section('content')
    <form action="{{ route('persediaan.jual-store') }}" method="POST">
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
            @error('produck.*.produk_nama')
                <div class="row" id="produk_nama">
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
                        var errorDiv = document.getElementById('produk_nama');
                        if (errorDiv) {
                            errorDiv.style.display = 'none';
                        }
                    }, 3000);
                </script>
            @enderror
            @error('produck.*.kategori_produk_id')
                <div class="row" id="kategori_produk_id">
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
                        var errorDiv = document.getElementById('kategori_produk_id');
                        if (errorDiv) {
                            errorDiv.style.display = 'none';
                        }
                    }, 3000);
                </script>
            @enderror
            @error('produck.*.harga_jual')
                <div class="row" id="harga_jual">
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
                        var errorDiv = document.getElementById('harga_jual');
                        if (errorDiv) {
                            errorDiv.style.display = 'none';
                        }
                    }, 3000);
                </script>
            @enderror
            @error('produck.*.stok')
                <div class="row" id="stok">
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
                        var errorDiv = document.getElementById('stok');
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
                    <h4 class="page-title" style="width: 12rem">Daftar Produk</h4>
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
                            <a href="#">Daftar Produk</a>
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
                                <th style="background: ">Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                                <th style="text-align: center;">
                                    <button type="button" class="btn btn-outline-success tambah">
                                        <i class="fa fa-plus-square" aria-hidden="true"></i>
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="produk-body">
                            @if (old('produck'))
                                @foreach (old('produck') as $key => $item)
                                    <tr class="produk-{{$key}}">
                                        <td style="height: 110%;">
                                            <input type="text" class="form-control" style="width: 120%;" name="produck[{{$key}}][produk_nama]" value="{{ $item['produk_nama'] }}">
                                        </td>
                                        <td style="height: 110%;">
                                            <select name="produck[{{$key}}][kategori_produk_id]" id="" class="form-control" style="width: 128%">
                                                <option value="">Pilih Kategori</option>
                                                @foreach ($data as $kategori)
                                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                                @endforeach
                                            </select>    
                                        </td>       
                                        <td style="height: 110%;">
                                            <input type="text" class="form-control harga" style="width: 120%;" name="produck[{{$key}}][harga_jual]" value="{{ $item['harga_jual'] }}">
                                        </td>                                 
                                        <td style="height: 110%;">
                                            <input type="text" class="form-control" style="color: black" name="produck[{{$key}}][stok]" value="0" readonly>
                                        </td>                                 
                                        <td style="text-align: center">
                                            <button type="button" class="btn btn-outline-danger kurang">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>   
                                @endforeach
                            @else
                                <tr class="produk-0">
                                    <td style="height: 110%;">
                                        <input type="text" class="form-control" style="width: 120%;" name="produck[0][produk_nama]">
                                    </td>
                                    <td style="height: 110%;">
                                        <select name="produck[0][kategori_produk_id]" id="" class="form-control" style="width: 128%;">
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($data as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                            @endforeach
                                        </select>    
                                    </td>  
                                    <td style="height: 110%;">
                                        <input type="text" class="form-control harga" style="width: 120%;" name="produck[0][harga_jual]" value="0">
                                    </td>
                                    <td style="height: 110%;">
                                        <input type="number" class="form-control" style="color: black;" name="produck[0][stok]" value="0" readonly>
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
                <a href="{{ route('persediaan.jual-index') }}" class="btn btn-outline-danger">Batal</a>
            </div>
        </div>
    </form>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            const bodykat = $('.produk-body')
            let rowBody = $('.produk-body')[0].rows.length

            $(document).on('click', '.tambah', function(){
                let tr = `
                    <tr class="produk-${rowBody}">
                        <td style="height: 110%;">
                            <input type="text" class="form-control" style="width: 120%;" name="produck[${rowBody}][produk_nama]">
                        </td>
                        <td style="height: 110%;">
                            <select name="produck[${rowBody}][kategori_produk_id]" id="" class="form-control" style="width: 128%;">
                                <option value="">Pilih Kategori</option>
                                @foreach ($data as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                @endforeach
                            </select>    
                        </td>  
                        <td style="height: 110%;">
                            <input type="text" class="form-control harga" style="width: 120%;" name="produck[${rowBody}][harga_jual]">
                        </td>
                        <td style="height: 110%;">
                            <input type="number" class="form-control" style="color: black;" name="produck[${rowBody}][stok]" value="0" readonly>
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
                if ($('.produk-body')[0].rows.length == 1) {
                    $('.kurang')[0].disabled = true
                }else{
                    $('.kurang')[0].disabled = false
                }
            }

            removeBtn()

            $(document).on('input', '.harga', function(){
                let data = $(this).val();
                let angka = data.replace(/\D/g, ''); // Hapus semua karakter selain angka
                $(this).val(rupiah(angka));
            });

            function rupiah(angka) {
                let formatted = angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                return 'Rp' + formatted;
            }
        });
    </script>
@endsection
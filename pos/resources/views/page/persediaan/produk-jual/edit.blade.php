@extends('template.main')

@section('content')
    <form action="{{ route('persediaan.jual-update',$data->id) }}" method="POST">
        @csrf
        @method('patch')
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
            @error('produk_nama')
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
            @error('kategori_produk_id')
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
            @error('harga_jual')
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
            @error('stok')
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
                            <a href="#">Edit</a>
                        </li>
                    </ul>
                </div>
                <hr>
                {{-- @dump(old()) --}}
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Nama Produk</label>
                        <input type="text" name="produk_nama" class="form-control" value="{{ old('produk_nama', $data->produk_nama) }}">
                        <br>
                        <label for="">Kategori</label>
                        <select name="kategori_produk_id" id="" class="form-control">
                            <option value="{{ $data->kategori_produk_id }}">{{ $data->kategori->nama_kategori }}</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="">Harga Jual</label>
                        {{-- <input type="text" name="harga_jual" class="form-control harga" value="Rp{{ number_format(preg_replace('/[^\d]/', '', old('harga_jual', $data->harga_jual)), 0, ',', '.') }}"> --}}
                        <input type="text" name="harga_jual" class="form-control harga" value="Rp{{ number_format($data->harga_jual, 0, ',', '.') }}">
                        <br>
                        <label for="">Stok</label>
                        <input type="number" name="stok" id="" class="form-control" value="{{ old('stok', $data->stok) }}" readonly style="color: black">
                    </div>
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
@extends('template.main')

@section('content')
    <form action="{{ route('pembelian.produk-update', $pembelian->id) }}" method="POST">
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
        @if (session('error'))
            <div class="row" id="error">
                <div class="col-md-12">
                    <div class="card" style="background: rgb(0, 74, 165)">
                        <div class="card-body">
                            <h5 style="font-family: Arial, Helvetica, sans-serif; font-weight: bold; color: white">{{ session('error') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        @endif    

        @if ($errors->any())
            @error('nomer_pembelian')
                <div class="row" id="nomer_pembelian">
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
                        var errorDiv = document.getElementById('nomer_pembelian');
                        if (errorDiv) {
                            errorDiv.style.display = 'none';
                        }
                    }, 3000);
                </script>
            @enderror
            @error('pembelian.*.nama_barang')
                <div class="row" id="nama_barang">
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
                        var errorDiv = document.getElementById('nama_barang');
                        if (errorDiv) {
                            errorDiv.style.display = 'none';
                        }
                    }, 3000);
                </script>
            @enderror
            @error('pembelian.*.qty')
                <div class="row" id="qty">
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
                        var errorDiv = document.getElementById('qty');
                        if (errorDiv) {
                            errorDiv.style.display = 'none';
                        }
                    }, 3000);
                </script>
            @enderror
            @error('pembelian.*.harga_beli')
                <div class="row" id="harga_beli">
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
                        var errorDiv = document.getElementById('harga_beli');
                        if (errorDiv) {
                            errorDiv.style.display = 'none';
                        }
                    }, 3000);
                </script>
            @enderror
            @error('pembelian.*.diskon')
                <div class="row" id="diskon">
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
                        var errorDiv = document.getElementById('diskon');
                        if (errorDiv) {
                            errorDiv.style.display = 'none';
                        }
                    }, 3000);
                </script>
            @enderror
            @error('pembelian.*.subtotal')
                <div class="row" id="subtotal">
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
                        var errorDiv = document.getElementById('subtotal');
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
                    <h4 class="page-title" style="width: 16rem">Pembelian Kebutuhan</h4>
                    <ul class="breadcrumbs" style="font-weight: bold; width: 30rem">
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
                        <li class="separator">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Edit</a>
                        </li>
                    </ul>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Nomer Pembelian</label>
                        <input type="text" name="nomer_pembelian" class="form-control" value="{{ old('nomer_pembelian', $pembelian->nomer_pembelian) }}">

                        <label for="">Supplier</label>
                        <select name="supplier_id" id="" class="form-control">
                            <option value="{{ $pembelian->supplier_id }}">{{ $pembelian->supplier->nama_supp }}</option>
                            @foreach ($supplier as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_supp }}</option>
                            @endforeach
                        </select>

                        <label for="">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d', strtotime($pembelian->tanggal)) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="">Keterangan</label>
                        <textarea type="text" name="keterangan" class="form-control" rows="7">{{ old('keterangan', $pembelian->keterangan) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="page-header">
                    <h3>Rincian Pembelian</h3>
                </div>
                <hr>
                <div class="row">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 18%">Produk</th>
                                <th>Harga Beli</th>
                                <th style="width: 15%; background: ">Qty</th>
                                <th>Diskon</th>
                                <th>Subtotal</th>
                                <th style="text-align: center;">
                                    <button type="button" class="btn btn-outline-success tambah">
                                        <i class="fa fa-plus-square" aria-hidden="true"></i>
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="produk-body">
                            @if (old('pembelian'))
                                @foreach (old('pembelian') as $key => $item)
                                    <tr class="produk-{{$key}}">
                                        <td style="height: 110%;">
                                            <select name="pembelian[{{$key}}][daftar_produk_id]" id="" class="form-control" style="width: 130%">                                            
                                                @foreach ($data as $produk)
                                                    <option value="{{ $produk->id }}" @if ($item['daftar_produk_id'] == $produk->id)
                                                        selected
                                                    @endif>{{ $produk->produk_nama }}</option>
                                                @endforeach
                                            </select>    
                                        </td>       
                                        <td style="height: 110%;">
                                            <input type="text" class="form-control harga" style="width: 128%;" name="pembelian[{{$key}}][harga_beli]" value="{{ $item['harga_beli'] }}">
                                        </td>                                 
                                        <td style="height: 110%;">
                                            <input type="text" class="form-control qty" style="width: 140%;" name="pembelian[{{$key}}][qty]" value="{{ $item['qty'] }}">
                                        </td>                                 
                                        <td style="height: 110%;">
                                            <input type="text" class="form-control diskon" style="width: 127%" name="pembelian[{{$key}}][diskon]" value="{{ $item['diskon'] }}">
                                        </td>      
                                        <td style="height: 110%;">
                                            <input type="text" class="form-control subtotal" style="width: 120%;color: black; text-align: right" name="pembelian[{{$key}}][subtotal]" value="{{ $item['subtotal'] }}" readonly>
                                        </td>                                                         
                                        <td style="text-align: center">
                                            <button type="button" class="btn btn-outline-danger kurang">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>   
                                @endforeach
                            @else
                                @foreach ($pembelian->pembelianRinci as $key => $item)
                                    <tr class="produk-{{$key}}">
                                        <td style="height: 110%;">
                                            <select name="pembelian[{{$key}}][daftar_produk_id]" id="" class="form-control" style="width: 130%;">
                                                <option value="{{ $item->daftar_produk_id }}">{{ $item->produk->produk_nama }}</option>
                                                @foreach ($data as $produk)
                                                    <option value="{{ $produk->id }}">{{ $produk->produk_nama }}</option>
                                                @endforeach
                                            </select>    
                                        </td>  
                                        <td style="height: 110%;">
                                            <input type="text" class="form-control harga" style="width: 128%;" name="pembelian[{{$key}}][harga_beli]" value="{{ $item['harga_beli'] }}">
                                        </td>
                                        <td style="height: 110%;">
                                            <input type="number" class="form-control qty" style="width: 140%" name="pembelian[{{$key}}][qty]" value="{{ $item['qty'] }}">
                                        </td>
                                        <td style="height: 110%;">
                                            <input type="number" class="form-control diskon" style="width: 127%" name="pembelian[{{$key}}][diskon]" value="{{ $item['diskon'] }}">
                                        </td>
                                        <td style="height: 110%;">
                                            <input type="text" class="form-control subtotal" style="width: 120%; color: black; text-align: right" name="pembelian[{{$key}}][subtotal]" readonly value="{{ $item['subtotal'] }}">
                                        </td>    
                                        <td style="text-align: center">
                                            <button type="button" class="btn btn-outline-danger kurang">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr> 
                                @endforeach                               
                            @endif
                        </tbody>
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Grantotal</th>
                                <th>
                                    <input type="text" class="form-control grantotal" style="width: 120%; color: black; text-align: right" name="grantotal" readonly value="{{ $pembelian['grantotal'] }}">
                                </th>
                            </tr>
                        </thead>
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
                            <select name="pembelian[${rowBody}][daftar_produk_id]" id="" class="form-control" style="width: 130%;">
                                <option value="">Pilih Produk</option>
                                @foreach ($data as $produk)
                                    <option value="{{ $produk->id }}">{{ $produk->produk_nama }}</option>
                                @endforeach
                            </select>    
                        </td>  
                        <td style="height: 110%;">
                            <input type="text" class="form-control harga" style="width: 128%;" name="pembelian[${rowBody}][harga_beli]" value="0">
                        </td>
                        <td style="height: 110%;">
                            <input type="number" class="form-control qty" style="width: 140%" name="pembelian[${rowBody}][qty]" value="0">
                        </td>
                        <td style="height: 110%;">
                            <input type="number" class="form-control diskon" style="width: 127%" name="pembelian[${rowBody}][diskon]" value="0">
                        </td>
                        <td style="height: 110%;">
                            <input type="text" class="form-control subtotal" style="width: 120%; text-align: right; color: black" name="pembelian[${rowBody}][subtotal]" readonly value="0">
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

            function rupiah(angka) {
                let formatted = angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                return 'Rp' + formatted;
            }

            $(document).on('input', '.harga', function(){
                subtotal()
            })

            $(document).on('input', '.qty', function(){
                subtotal()
            })

            $(document).on('input', '.diskon', function(){
                subtotal()
            })

            function subtotal (){
                let grantotal = 0
                bodykat.find('tr').each(function(){
                    const row = $(this)
                    const harga = row.find('.harga').val()
                    const qty = row.find('.qty').val()
                    const diskon = row.find('.diskon').val()
                    const hitungDiskon = harga * diskon / 100
                    const subtotal = (harga - hitungDiskon) * qty

                    row.find('.subtotal').val(rupiah(subtotal))

                    grantotal += subtotal
                })

                $('.grantotal').val(rupiah(grantotal))
            }
        });
    </script>
@endsection
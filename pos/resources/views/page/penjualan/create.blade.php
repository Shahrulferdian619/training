@extends('template.main')

@section('content')
    <style>
        #invoice{
            box-shadow: 0 0 1in -0.25in rgb(0, 0, 0.5);
            padding: 2mm;
            margin: 0 auto;
            width: 63mm;
            background: #fff;
            overflow: hidden;
        }

        .radio-label {
        display: block;
        margin-bottom: 10px;
        cursor: pointer;
        }

        .radio-label input[type="radio"] {
        display: none;
        }

        .radio-custom {
        position: relative;
        padding-left: 30px;
        }

        .radio-custom:before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        width: 20px;
        height: 20px;
        border: 1px solid #ccc;
        background-color: #fff;
        border-radius: 50%;
        }

        .radio-custom:after {
        content: "";
        position: absolute;
        left: 5px;
        top: 5px;
        width: 10px;
        height: 10px;
        background: #007bff;
        border-radius: 50%;
        opacity: 0;
        transform: scale(0);
        transition: all 0.2s;
        }

        .radio-label input[type="radio"]:checked + .radio-custom:before {
        border: 1px solid #007bff;
        }

        .radio-label input[type="radio"]:checked + .radio-custom:after {
        opacity: 1;
        transform: scale(1);
        }
    </style>
    <form action="{{ route('penjualan.produk-store') }}" method="POST">
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
            @error('nomer_penjualan')
                <div class="row" id="nomer_penjualan">
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
                        var errorDiv = document.getElementById('nomer_penjualan');
                        if (errorDiv) {
                            errorDiv.style.display = 'none';
                        }
                    }, 3000);
                </script>
            @enderror
            @error('metode_pembayaran')
                <div class="row" id="metode_pembayaran">
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
                        var errorDiv = document.getElementById('metode_pembayaran');
                        if (errorDiv) {
                            errorDiv.style.display = 'none';
                        }
                    }, 3000);
                </script>
            @enderror
            @error('penjualan.*.daftar_produk_id')
                <div class="row" id="daftar_produk_id">
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
                        var errorDiv = document.getElementById('daftar_produk_id');
                        if (errorDiv) {
                            errorDiv.style.display = 'none';
                        }
                    }, 3000);
                </script>
            @enderror
            @error('penjualan.*.qty')
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
            @error('penjualan.*.harga_jual')
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
            @error('penjualan.*.diskon')
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
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="page-header">
                            <h4 class="page-title" style="width: 13rem">Order Produk</h4>
                            <ul class="breadcrumbs" style="font-weight: bold; width: 15rem">
                                <li class="nav-home">
                                    <a href="#" >
                                        <i class="fa fa-desktop" aria-hidden="true"></i>
                                    </a>    
                                </li>
                                <li class="separator">
                                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="#">Order Produk</a>
                                </li>
                            </ul>
                        </div>
                        <hr>
                        <label for="">Nomer Pesanan</label>
                        <input type="text" name="nomer_penjualan" class="form-control noJual" value="" readonly>

                        <label for="">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control tanggal" value="{{ date('Y-m-d') }}">

                        <label for="">Keterangan</label>
                        <textarea type="text" name="keterangan" class="form-control keterangan" rows="4">{{ old('keterangan') }}</textarea>
                    </div>
                </div>
            </div>
    
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <label for="">Metode Pembayaran</label>
                        <div style="margin-top: 5px">
                            <label for="aktif"><i class="fa fa-money" aria-hidden="true"></i> Cash</label>
                            <input style="margin-right: 50px" class="cash" type="radio" name="metode_pembayaran" value="1">
    
                            <label for="aktif"><i class="fa fa-university" aria-hidden="true"></i> Bank Transfer</label>
                            <input style="margin-right: 50px" class="bank" type="radio" name="metode_pembayaran" value="2">
    
                            <label for="non-aktif"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Kartu Debit</label>
                            <input type="radio" class="kartu" name="metode_pembayaran" value="3">
                        </div>
                    </div>
                </div>

                <div class="card" id="cash" style="margin-top: -4%;">
                    <div class="card-body">
                        <div>
                            <div class="page-header">
                                <label for="">Pembayaran Cash</label>
                            </div>
                            <hr>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nominal Bayar</th>
                                        <th>Grantotal</th>
                                    </tr>
                                </thead>
                                <tbody class="body-cash">
                                    <tr>
                                        <td style="height: 110%;">
                                            <input type="text" class="form-control nominal">
                                        </td>
                                        <td style="height: 110%">
                                            <input type="text" class="form-control grantotal" style="width: 100%; color: black; text-align: right" readonly value="0">
                                        </td>
                                    </tr>
                                </tbody>
                                <thead>
                                    <tr>
                                        <th style="text-align: right">Kembalian</th>
                                        <th style="height: 110%;">
                                            <input type="text" class="form-control kembalian" style="width: 100%; color: black; text-align: right" readonly value="0">                                            
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="page-header">
                    <h5 style="width: 15%; background: ">Rincian Order</h5>
                </div>
                <hr>
                <div class="row">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 18%">Produk</th>
                                <th>Harga Jual</th>
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
                                <tr class="produk-0" data-row-id="0">
                                    <td style="height: 110%;">
                                        <select name="penjualan[0][daftar_produk_id]" id="" class="form-control select-produk" style="width: 130%;">
                                            <option value="">Pilih Produk</option>
                                            @foreach ($produk as $set)
                                                <option data-produk="{{ $set->produk_nama }}" data-price="{{ $set->harga_jual }}" value="{{ $set->id }}">{{ $set->produk_nama }}</option>
                                            @endforeach
                                        </select>    
                                    </td>  
                                    <td style="height: 110%;">
                                        <input type="text" class="form-control harga" style="width: 128%; color: black" name="penjualan[0][harga_jual]" value="0" readonly>
                                    </td>
                                    <td style="height: 110%;">
                                        <input type="number" class="form-control qty" style="width: 140%" name="penjualan[0][qty]">
                                    </td>
                                    <td style="height: 110%;">
                                        <input type="number" class="form-control diskon" style="width: 127%" name="penjualan[0][diskon]" value="0">
                                    </td>
                                    <td style="height: 110%;">
                                        <input type="text" class="form-control subtotal" style="width: 120%; color: black; text-align: right" name="penjualan[0][subtotal]" readonly value="0">
                                    </td>    
                                    <td style="text-align: center">
                                        <button type="button" class="btn btn-outline-danger kurang">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                </tr>                                
                        </tbody>
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Grantotal</th>
                                <th>
                                    <input type="text" class="form-control grantotal" style="width: 120%; color: black; text-align: right" name="grantotal" readonly value="0">
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
            </div>
        </div>
    </form>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#cash').hide()
            const bodykat = $('.produk-body')
            let rowBody = $('.produk-body')[0].rows.length

            $(document).on('click', '.tambah', function(){
                let tr = `
                    <tr class="produk-${rowBody}" data-row-id="${rowBody}">
                        <td style="height: 110%;">
                            <select name="penjualan[${rowBody}][daftar_produk_id]" id="" class="form-control select-produk" style="width: 130%;">
                                <option value="">Pilih Produk</option>
                                @foreach ($produk as $set)
                                    <option data-price="{{ $set->harga_jual }}" value="{{ $set->id }}">{{ $set->produk_nama }}</option>
                                @endforeach
                            </select>    
                        </td>  
                        <td style="height: 110%;">
                            <input type="text" class="form-control harga" style="width: 128%; color: black" name="penjualan[${rowBody}][harga_jual]" value="0" readonly>
                        </td>
                        <td style="height: 110%;">
                            <input type="number" class="form-control qty" style="width: 140%" name="penjualan[${rowBody}][qty]">
                        </td>
                        <td style="height: 110%;">
                            <input type="number" class="form-control diskon" style="width: 127%" name="penjualan[${rowBody}][diskon]" value="0">
                        </td>
                        <td style="height: 110%;">
                            <input type="text" class="form-control subtotal" style="width: 120%; color: black; text-align: right" name="penjualan[${rowBody}][subtotal]" readonly value="0">
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

            $(document).on('input', '.qty', function(){
                subtotal()
            })

            $(document).on('input', '.diskon', function(){
                subtotal()
            })

            $(document).on('input', '.harga', function(){
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

                let nominal = $('.nominal').val()

                let hasil = nominal - grantotal
                $('.kembalian').val(rupiah(hasil))
            }

            $(document).on('change', '.select-produk', function(){
                const tr = $(this).parent().parent()
                let harga = tr.find('.select-produk option:selected').attr('data-price')
                tr.find('.harga').val(harga)
            })

            $(document).on('input', '.cash', function(){
                let value = $(this).val()
                $('#cash').fadeIn()
            })

            $(document).on('input', '.bank', function(){
                let value = $(this).val()
                $('#cash').fadeOut()
            })

            $(document).on('input', '.kartu', function(){
                let value = $(this).val()
                $('#cash').fadeOut()
            })

            $(document).on('input', '.nominal', function(){
                subtotal()
            })    
        });
    </script>
@endsection
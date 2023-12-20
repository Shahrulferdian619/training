@extends('template.main')

@section('content')
    <form action="{{ route('master.supplier-store') }}" method="POST">
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
            @error('nama_supp')
                <div class="row" id="nama_supp">
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
                        var errorDiv = document.getElementById('nama_supp');
                        if (errorDiv) {
                            errorDiv.style.display = 'none';
                        }
                    }, 3000);
                </script>
            @enderror
            @error('email')
                <div class="row" id="email">
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
                        var errorDiv = document.getElementById('email');
                        if (errorDiv) {
                            errorDiv.style.display = 'none';
                        }
                    }, 3000);
                </script>
            @enderror
            @error('no_hp')
                <div class="row" id="no_hp">
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
                        var errorDiv = document.getElementById('no_hp');
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
                    <div class="col-md-6">
                        <div class="form-group form-floating-label">
                            <input id="inputFloatingLabel" type="text" class="form-control input-border-bottom" required="" name="nama_supp" value="{{ old('nama_supp') }}">
                            <label for="inputFloatingLabel" class="placeholder">Nama Supplier</label>
                        </div>
                        <div class="form-group form-floating-label">
                            <input id="inputFloatingLabel" type="email" class="form-control input-border-bottom" required="" name="email" value="{{ old('email') }}">
                            <label for="inputFloatingLabel" class="placeholder">Email</label>
                        </div>
                        <div class="form-group form-floating-label">
                            <input id="inputFloatingLabel" type="number" class="form-control input-border-bottom" required="" name="no_hp" value="{{ old('no_hp') }}">
                            <label for="inputFloatingLabel" class="placeholder">Nomer Hp</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="">Alamat</label>
                        <textarea class="form-control" name="alamat" id="" cols="30" rows="7">{{ old('alamat') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <button class="btn btn-outline-success" type="submit">Simpan</button>
                <a href="{{ route('master.supplier-index') }}" class="btn btn-outline-danger">Batal</a>
            </div>
        </div>
    </form>
@endsection
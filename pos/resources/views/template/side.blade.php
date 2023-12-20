<div class="sidebar sidebar-style-2" data-background-color="dark2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset("assets/img/profile.jpg") }}" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ auth()->user()->name }}
                            @if (auth()->user()->level == 1)
                                <span class="user-level">Admin</span>
                            @else
                                <span class="user-level">Kasir</span>
                            @endif
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#edit">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings">
                                    <span class="link-collapse">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- main --}}
            <ul class="nav nav-primary">
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Main Component</h4>
                </li>

                {{-- pembelian --}}
                <li class="nav-item {{ (request()->is('pembelian*')) ? 'active':'' }}">
                    <a data-toggle="collapse" href="#pembelian">
                        <i class="fa fa-truck" aria-hidden="true"></i>
                        <p>Pembelian</p>
                        <span class="caret"></span>
                    </a>
                    <div class="{{ (request()->is('pembelian*')) ? '':'collapse' }}" id="pembelian">
                        <ul class="nav nav-collapse">

                            {{-- produk --}}
                            <li class="{{ (request()->is('pembelian/produk*')) ? 'active':'' }}">
                                <a href="{{ route('pembelian.produk-index') }}">
                                    <span class="sub-item">Produk</span>
                                </a>
                            </li>

                            <li class="{{ (request()->is('pembelian/lainnya*')) ? 'active':'' }}">
                                <a href="{{ route('pembelian.lainnya-index') }}">
                                    <span class="sub-item">Lainnya</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>	

                {{-- kasir --}}
                <li class="nav-item {{ (request()->is('penjualan*')) ? 'active':'' }}">
                    <a data-toggle="collapse" href="#penjualan">
                        <i class="fa fa-desktop" aria-hidden="true"></i>
                        <p>Kasir</p>
                        <span class="caret"></span>
                    </a>
                    <div class="{{ (request()->is('penjualan*')) ? '':'collapse' }}" id="penjualan">
                        <ul class="nav nav-collapse">

                            {{-- order produk --}}
                            <li class="{{ (request()->is('penjualan/produk*')) ? 'active':'' }}">
                                <a href="{{ route('penjualan.produk-create') }}">
                                    <span class="sub-item">Order Produk</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>	
                
                {{-- laporan --}}
                <li class="nav-item {{ (request()->is('laporan*')) ? 'active':'' }}">
                    <a data-toggle="collapse" href="#laporan">
                        <i class="fa fa-book" aria-hidden="true"></i>
                        <p>Laporan</p>
                        <span class="caret"></span>
                    </a>
                    <div class="{{ (request()->is('laporan*')) ? '':'collapse' }}" id="laporan">
                        <ul class="nav nav-collapse">

                            {{-- penjualan --}}
                            <li class="{{ (request()->is('laporan/penjualan*')) ? 'active':'' }}">
                                <a href="{{ route('laporan.penjualan-index') }}">
                                    <span class="sub-item">Penjualan</span>
                                </a>
                            </li>

                            {{-- pembelian --}}
                            <li class="{{ (request()->is('laporan/pembelian*')) ? 'active':'' }}">
                                <a href="{{ route('laporan.pembelian-index') }}">
                                    <span class="sub-item">Pembelian</span>
                                </a>
                            </li>

                            {{-- keuangan --}}
                            <li class="{{ (request()->is('laporan/keuangan*')) ? 'active':'' }}">
                                <a href="{{ route('laporan.keuangan-index') }}">
                                    <span class="sub-item">Keuangan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>	

                {{-- master --}}
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Master</h4>
                </li>

                {{-- kategori --}}
                <li class="nav-item {{ (request()->is('master*')) ? 'active':'' }}">
                    <a data-toggle="collapse" href="#base">
                        <i class="fa fa-th" aria-hidden="true"></i>
                        <p>Kategori</p>
                        <span class="caret"></span>
                    </a>
                    <div class="{{ (request()->is('master*')) ? '':'collapse' }}" id="base">
                        <ul class="nav nav-collapse">

                            {{-- supplier --}}
                            @if (auth()->user()->level == 1)
                                <li class="{{ (request()->is('master/supplier*')) ? 'active':'' }}">
                                    <a href="{{ route('master.supplier-index') }}">
                                        <span class="sub-item">Supplier</span>
                                    </a>
                                </li>
                            @endif

                            {{-- produk --}}
                            <li class="{{ (request()->is('master/produk*')) ? 'active':'' }}">
                                <a href="{{ route('master.produk-index') }}">
                                    <span class="sub-item">Produk</span>
                                </a>
                            </li>

                            {{-- user --}}
                            @if (auth()->user()->level == 1)
                                <li class="{{ (request()->is('master/user*')) ? 'active':'' }}"> 
                                    <a href="{{ route('master.user-index') }}">
                                        <span class="sub-item">User</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li>	

                {{-- persediaan --}}
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Persediaan</h4>
                </li>

                {{-- stok produk --}}
                <li class="nav-item {{ (request()->is('persediaan*')) ? 'active':'' }}">
                    <a data-toggle="collapse" href="#perse">
                        <i class="fa fa-cubes" aria-hidden="true"></i>
                        <p>Stok Produk</p>
                        <span class="caret"></span>
                    </a>
                    <div class="{{ (request()->is('persediaan*')) ? '':'collapse' }}" id="perse">
                        <ul class="nav nav-collapse">

                            {{-- daftar produk --}}
                            <li class="{{ (request()->is('persediaan/jual*')) ? 'active':'' }}">
                                <a href="{{ route('persediaan.jual-index') }}">
                                    <span class="sub-item">Daftar Produk</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>											
            </ul>
        </div>
    </div>
</div>
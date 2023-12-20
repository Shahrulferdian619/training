<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use App\Models\Kebutuhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianKebutuhanController extends Controller
{
    public function index ()
    {
        $data = Kebutuhan::with('kebutuhanRinci')->orderBy('tanggal', 'desc')->get();
        return view('page.pembelian.kebutuhan.index', compact('data'));
    }

    public function create ()
    {
        return view('page.pembelian.kebutuhan.create');
    }

    public function edit ($id)
    {
        $data = Kebutuhan::find($id);
        return view('page.pembelian.kebutuhan.edit', compact('data'));
    }

    private function converter($value)
    {
        $Rp = str_replace('Rp', '', $value);
        $titik = str_replace('.', '', $Rp);
        return $titik;
    }

    public function store (Request $req)
    {
        $pembelian = $req->input('pembelian');
        foreach ($pembelian as $key => $value) {
            $pembelian[$key]['subtotal'] = $this->converter($value['subtotal']);
        }

        // dd($pembelian);

        $req->merge([
            'grantotal'=>$this->converter($req->input('grantotal')),
            'pembelian'=>$pembelian
        ]);

        $req->validate([
            'nomer_pembelian'=>'unique:pembelian,nomer_pembelian',
            'pembelian.*.nama_barang'=>'required',
            'pembelian.*.qty'=>'required|numeric',
            'pembelian.*.harga'=>'required|numeric',
            'pembelian.*.diskon'=>'required|numeric',
        ],[
            'nomer_pembelian.required'=>'Nomer pembelian harus diisi',
            'nomer_pembelian.unique'=>'Nomer pembelian sudah ada',
            'pembelian.*.nama_barang.required'=>'barang harus diisi',
            'pembelian.*.qty.required'=>'Qty produk harus diisi',
            'pembelian.*.harga.required'=>'Harga beli produk harus diisi',
            'pembelian.*.diskon.required'=>'Diskon produk harus diisi minimal 0',
        ]);

        try {
            DB::beginTransaction();

            DB::commit();
            try {
                DB::beginTransaction();

                $nomerPenjualan = '32' . substr(uniqid(), -3);
                $data = Kebutuhan::create([
                    'nomer_pembelian'=>$nomerPenjualan,
                    'tanggal'=>$req->tanggal,
                    'keterangan'=>$req->keterangan,
                    'grantotal'=>$req->grantotal
                ]);
    
                if (!$data) {
                    DB::rollBack();
                    return back()->with('error', 'Gagal membuat pembelian produk');
                }
    
                foreach ($req->input('pembelian') as $value) {
                    $pembelian = $data->kebutuhanRinci()->create([
                        'nama_barang'=>$value['nama_barang'],
                        'qty'=>$value['qty'],
                        'diskon'=>$value['diskon'],
                        'subtotal'=>$value['subtotal'],
                        'harga'=>$value['harga'],
                    ]);
    
                    if (!$pembelian) {
                        DB::rollBack();
                        return back()->with('error', 'Gagal membuat rincian pembelian');
                    }
                }
    
                DB::commit();
                return back()->with('sukses', 'Data pembelian dengan nomer pembelian : '.$data->nomer_pembelian.' berhasil dibuat');
            } catch (\Throwable $th) {
                DB::rollBack();
                return back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}

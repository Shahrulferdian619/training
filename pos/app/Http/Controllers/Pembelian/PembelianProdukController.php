<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use App\Models\DaftarProduk;
use App\Models\Pembelian;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pembelian::with('supplier')->with('pembelianRinci.produk')->get();
        return view('page.pembelian.produk.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = DaftarProduk::all();
        $supplier = Supplier::all();
        return view('page.pembelian.produk.create', compact('data', 'supplier'));
    }

    private function converter($value)
    {
        $Rp = str_replace('Rp', '', $value);
        $titik = str_replace('.', '', $Rp);
        return $titik;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pembelian = $request->input('pembelian');
        foreach ($pembelian as $key => $value) {
            $pembelian[$key]['subtotal'] = $this->converter($value['subtotal']);
        }

        // dd($pembelian);

        $request->merge([
            'grantotal'=>$this->converter($request->input('grantotal')),
            'pembelian'=>$pembelian
        ]);

        $request->validate([
            'nomer_pembelian'=>'required|unique:pembelian,nomer_pembelian',
            'supplier_id'=>'required',
            'pembelian.*.daftar_produk_id'=>'required',
            'pembelian.*.qty'=>'required|numeric',
            'pembelian.*.harga_beli'=>'required|numeric',
            'pembelian.*.diskon'=>'required|numeric',
        ],[
            'nomer_pembelian.required'=>'Nomer pembelian harus diisi',
            'nomer_pembelian.unique'=>'Nomer pembelian sudah ada',
            'supplier_id.required'=>'Supplier harus diisi',
            'pembelian.*.daftar_produk_id.required'=>'Nama produk harus diisi',
            'pembelian.*.qty.required'=>'Qty produk harus diisi',
            'pembelian.*.harga_beli.required'=>'Harga beli produk harus diisi',
            'pembelian.*.diskon.required'=>'Diskon produk harus diisi minimal 0',
        ]);

        try {
            DB::beginTransaction();
            $data = Pembelian::create([
                'nomer_pembelian'=>$request->nomer_pembelian,
                'supplier_id'=>$request->supplier_id,
                'tanggal'=>$request->tanggal,
                'keterangan'=>$request->keterangan,
                'grantotal'=>$request->grantotal
            ]);

            if (!$data) {
                DB::rollBack();
                return back()->with('error', 'Gagal membuat pembelian produk');
            }

            foreach ($request->input('pembelian') as $value) {
                $pembelian = $data->pembelianRinci()->create([
                    'daftar_produk_id'=>$value['daftar_produk_id'],
                    'qty'=>$value['qty'],
                    'diskon'=>$value['diskon'],
                    'subtotal'=>$value['subtotal'],
                    'harga_beli'=>$value['harga_beli'],
                ]);

                if (!$pembelian) {
                    DB::rollBack();
                    return back()->with('error', 'Gagal membuat rincian pembelian');
                }

                $produk = DaftarProduk::find($value['daftar_produk_id']);
                $produk->stok += $value['qty'];
                $produk->save();
            }

            DB::commit();
            return back()->with('sukses', 'Data pembelian produk dengan nomer pembelian : '.$data->nomer_pembelian.' berhasil dibuat');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pembelian = Pembelian::find($id);
        $supplier = Supplier::all();
        $data = DaftarProduk::all();
        return view('page.pembelian.produk.edit', compact('supplier', 'data', 'pembelian'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pembelian = $request->input('pembelian');
        foreach ($pembelian as $key => $value) {
            $pembelian[$key]['subtotal'] = $this->converter($value['subtotal']);
        }

        // dd($pembelian);

        $request->merge([
            'grantotal'=>$this->converter($request->input('grantotal')),
            'pembelian'=>$pembelian
        ]);

        $request->validate([
            'nomer_pembelian'=>'required|unique:pembelian,nomer_pembelian,'.$id,
            'supplier_id'=>'required',
            'pembelian.*.daftar_produk_id'=>'required',
            'pembelian.*.qty'=>'required|numeric',
            'pembelian.*.harga_beli'=>'required|numeric',
            'pembelian.*.diskon'=>'required|numeric',
        ],[
            'nomer_pembelian.required'=>'Nomer pembelian harus diisi',
            'nomer_pembelian.unique'=>'Nomer pembelian sudah ada',
            'supplier_id.required'=>'Supplier harus diisi',
            'pembelian.*.daftar_produk_id.required'=>'Nama produk harus diisi',
            'pembelian.*.qty.required'=>'Qty produk harus diisi',
            'pembelian.*.harga_beli.required'=>'Harga beli produk harus diisi',
            'pembelian.*.diskon.required'=>'Diskon produk harus diisi minimal 0',
        ]);

        try {
            DB::beginTransaction();

            $data = Pembelian::find($id);
            $data->update([
                'nomer_pembelian'=>$request->nomer_pembelian,
                'supplier_id'=>$request->supplier_id,
                'tanggal'=>$request->tanggal,
                'keterangan'=>$request->keterangan,
                'grantotal'=>$request->grantotal
            ]);

            if (!$data) {
                DB::rollBack();
                return back()->with('error', 'Gagal membuat pembelian produk');
            }

            foreach ($data->pembelianRinci as $value) {
                $produk = DaftarProduk::find($value['daftar_produk_id']);
                $produk->stok -= $value['qty'];
                $produk->save();
            }

            $data->pembelianRinci()->delete();

            foreach ($request->input('pembelian') as $value) {
                $pembelian = $data->pembelianRinci()->create([
                    'daftar_produk_id'=>$value['daftar_produk_id'],
                    'qty'=>$value['qty'],
                    'diskon'=>$value['diskon'],
                    'subtotal'=>$value['subtotal'],
                    'harga_beli'=>$value['harga_beli'],
                ]);

                if (!$pembelian) {
                    DB::rollBack();
                    return back()->with('error', 'Gagal membuat rincian pembelian');
                }

                $produk = DaftarProduk::find($value['daftar_produk_id']);
                $produk->stok += $value['qty'];
                $produk->save();
            }

            DB::commit();
            return back()->with('sukses', 'Data pembelian produk dengan nomer pembelian : '.$data->nomer_pembelian.' berhasil dirubah');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

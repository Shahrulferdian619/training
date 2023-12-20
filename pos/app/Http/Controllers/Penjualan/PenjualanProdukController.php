<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use App\Models\DaftarProduk;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('page.penjualan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produk = DaftarProduk::where('stok', '>', '0')->get();
        // dd($produk);
        return view('page.penjualan.create', compact('produk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $penjualan = $request->input('penjualan');
        foreach ($penjualan as $key => $value) {
            $penjualan[$key]['subtotal'] = $this->converter($value['subtotal']);
        }

        // dd($penjualan);

        $request->merge([
            'grantotal'=>$this->converter($request->input('grantotal')),
            'penjualan'=>$penjualan
        ]);

        $request->validate([
            'nomer_penjualan'=>'unique:penjualan,nomer_penjualan',
            'metode_pembayaran'=>'required',
            'penjualan.*.daftar_produk_id'=>'required',
            'penjualan.*.harga_jual'=>'required|numeric',
            'penjualan.*.qty'=>'required|numeric',
            'penjualan.*.diskon'=>'required|numeric',
        ],[
            'nomer_penjualan.required'=>'Nomer penjualan harus diisi',
            'metode_pembayaran.required'=>'Metode pembayaran harus diisi',
            'nomer_penjualan.unique'=>'Nomer penjualan sudah ada',
            'penjualan.*.daftar_produk_id.required'=>'Produk harus diisi',
            'penjualan.*.harga_jual.required'=>'Produk harus diisi',
            'penjualan.*.qty.required'=>'Qty harus diisi minimal 1',
            'penjualan.*.diskon.required'=>'Diskon harus diisi minimal 0',
        ]);

        try {
            DB::beginTransaction();

            $nomerPenjualan = '32' . substr(uniqid(), -3);

            $data = Penjualan::create([
                'nomer_penjualan'=>$nomerPenjualan,
                'tanggal'=>$request->tanggal,
                'keterangan'=>$request->keterangan,
                'metode_pembayaran'=>$request->metode_pembayaran,
                'grantotal'=>$request->grantotal,
            ]);

            foreach ($request->input('penjualan') as $value) {
                $data->penjualanRinci()->create([
                    'daftar_produk_id'=>$value['daftar_produk_id'],
                    'harga_jual'=>$value['harga_jual'],
                    'qty'=>$value['qty'],
                    'diskon'=>$value['diskon'],
                    'subtotal'=>$value['subtotal'],
                ]);

                $produk = DaftarProduk::find($value['daftar_produk_id']);
                if ($produk->stok < $value['qty']) {
                    DB::rollBack();
                    return back()->with('error', 'Stok '.$produk->produk_nama.' kurang');
                }
                $produk->stok -= $value['qty'];
                $produk->save();
            }

            DB::commit();
            return redirect()->route('penjualan.produk-show', $data->id)->with('sukses', 'Pembayaran berhasil');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    private function converter($value){
        $rp = str_replace('Rp', '', $value);
        $titik = str_replace('.', '', $rp);
        return $titik;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Penjualan::find($id);
        return view('page.penjualan.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function getProduk (Request $request)
    {
        $produk = DaftarProduk::find($request->input('produk_id'));
        return response()->json($produk);
    }
}

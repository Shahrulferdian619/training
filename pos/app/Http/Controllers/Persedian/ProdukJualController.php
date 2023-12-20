<?php

namespace App\Http\Controllers\Persedian;

use App\Http\Controllers\Controller;
use App\Models\DaftarProduk;
use App\Models\KategoriProduk;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukJualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DaftarProduk::with('kategori')->get();
        return view('page.persediaan.produk-jual.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = KategoriProduk::all();
        // dd($data);
        return view('page.persediaan.produk-jual.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $produk = $request->input('produck');
        foreach($produk as $key => $value){
            $produk[$key]['harga_jual'] = $this->replace($value['harga_jual']);
        }

        $request->merge([
            'produck'=>$produk
        ]);

        $request->validate([
            'produck.*.produk_nama' => 'required|unique:daftar_produk,produk_nama',
            'produck.*.kategori_produk_id' => 'required',
            'produck.*.harga_jual' => 'required|numeric',
            'produck.*.stok' => 'required|numeric',
        ], [
            'produck.*.produk_nama.required' => 'Nama produk harus diisi',
            'produck.*.produk_nama.unique' => 'Nama produk sudah ada',
            'produck.*.kategori_produk_id.required' => 'Kategori produk harus diisi',
            'produck.*.harga_jual.required' => 'Harga jual harus diisi',
            'produck.*.harga_jual.numeric' => 'Harga jual harus berupa angka',
            'produck.*.stok.required' => 'Stok harus diisi',
            'produck.*.stok.numeric' => 'Stok harus berupa angka',
        ]);

        try {
            DB::beginTransaction();

            foreach($request->input('produck') as $value){
                DaftarProduk::create([
                    'produk_nama'=>$value['produk_nama'],
                    'kategori_produk_id'=>$value['kategori_produk_id'],
                    'harga_jual'=>$value['harga_jual'],
                    'stok'=>$value['stok'],
                ]);
            }

            DB::commit();
            return back()->with('sukses', 'PRODUK BERHASIL DIBUAT');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Unknown error '.$th->getMessage());
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
        $data = DaftarProduk::find($id);
        $kategori = KategoriProduk::all();
        // dd($data);
        return view('page.persediaan.produk-jual.edit', compact('data','kategori'));
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
        $request->merge([
            'harga_jual'=>$this->replace($request->input('harga_jual'))
        ]);

        $request->validate([
            'produk_nama' => 'required|unique:daftar_produk,produk_nama,'.$id,
            'kategori_produk_id' => 'required',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|numeric',
        ], [
            'produk_nama.required' => 'Nama produk harus diisi',
            'produk_nama.unique' => 'Nama produk sudah ada',
            'kategori_produk_id.required' => 'Kategori produk harus diisi',
            'harga_jual.required' => 'Harga jual harus diisi',
            'harga_jual.numeric' => 'Harga jual harus berupa angka',
            'stok.required' => 'Stok harus diisi',
            'stok.numeric' => 'Stok harus berupa angka',
        ]);

        try {
            DB::beginTransaction();

            $data = DaftarProduk::find($id);
            $data->update([
                'produk_nama'=>$request->produk_nama,
                'kategori_produk_id'=>$request->kategori_produk_id,
                'harga_jual'=>$request->harga_jual,
                'stok'=>$request->stok,
            ]);

            DB::commit();
            return back()->with('sukses', 'PRODUK BERHASIL DIUPDATE');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Unknown error '.$th->getMessage());
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

    public function replace($nominal){
        return str_replace(['Rp', '.'], '', $nominal);
    }    
}

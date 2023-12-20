<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->level == 0) {
            abort('403', 'ACCESS DENIED');
        }
        $data = KategoriProduk::all();
        return view('page.master.produk.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->level == 0) {
            abort('403', 'ACCESS DENIED');
        }
        return view('page.master.produk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->level == 0) {
            abort('403', 'ACCESS DENIED');
        }
        $request->validate([
            'kategori.*.nama_kategori'=>'required|unique:kategori_produk,nama_kategori',
        ],[
            'kategori.*.nama_kategori.required'=>'Nama kategori harus diisi',
            'kategori.*.nama_kategori.unique'=>'Nama kategori tidak boleh sama',
        ]);

        try {
            DB::beginTransaction();

            foreach ($request->input('kategori') as $value) {
                $data = KategoriProduk::create([
                    'nama_kategori'=>$value['nama_kategori'],
                    'keterangan'=>$value['keterangan']
                ]);
            }

            DB::commit();
            return redirect()->route('master.produk-edit', $data->id)->with('sukses', 'KATEGORI BERHASIL DIBUAT');
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
        if (auth()->user()->level == 0) {
            abort('403', 'ACCESS DENIED');
        }
        $data = KategoriProduk::find($id);
        return view('page.master.produk.edit', compact('data'));
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
        if (auth()->user()->level == 0) {
            abort('403', 'ACCESS DENIED');
        }
        $request->validate([
            'nama_kategori'=>'required|unique:kategori_produk,nama_kategori,'.$id,
        ],[
            'nama_kategori.required'=>'Nama kategori harus diisi',
            'nama_kategori.unique'=>'Nama kategori tidak boleh sama',
        ]);

        try {
            DB::beginTransaction();

            $data = KategoriProduk::find($id);
            $data->update([
                'nama_kategori'=>$request->nama_kategori,
                'keterangan'=>$request->keterangan,
            ]);

            DB::commit();
            return back()->with('sukses', 'KATEGORI BERHASIL DIUPDATE');
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
}

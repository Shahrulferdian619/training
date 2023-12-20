<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
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
        $data = Supplier::all();
        return view('page.master.supplier.index', compact('data'));
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
        return view('page.master.supplier.create');
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
            'nama_supp'=>'required',
            'email'=>'required|email',
            'no_hp'=>'required',
        ],[
            'nama_supp.required'=>'Nama supplier harus diisi',
            'email.required'=>'Email Harus diisi',
            'no_hp.required'=>'Nomer handphone harus diisi'
        ]);

        try {
            DB::beginTransaction();

            $data = Supplier::create([
                'nama_supp'=>$request->nama_supp,
                'email'=>$request->email,
                'no_hp'=>$request->no_hp,
                'alamat'=>$request->alamat,
            ]);

            DB::commit();
            return redirect()->route('master.supplier-edit', $data->id)->with('sukses', 'DATA SUPPLIER BERHASIL DIBUAT');
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
        $data = Supplier::find($id);
        return view('page.master.supplier.edit', compact('data'));
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
            'nama_supp'=>'required',
            'email'=>'required|email',
            'no_hp'=>'required',
        ],[
            'nama_supp.required'=>'Nama supplier harus diisi',
            'email.required'=>'Email Harus diisi',
            'no_hp.required'=>'Nomer handphone harus diisi'
        ]);

        try {
            DB::beginTransaction();

            $data = Supplier::find($id);

            $data->update([
                'nama_supp'=>$request->nama_supp,
                'email'=>$request->email,
                'no_hp'=>$request->no_hp,
                'alamat'=>$request->alamat,
            ]);

            DB::commit();
            return back()->with('sukses', 'DATA SUPPLIER BERHASIL DIUPDATE');
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

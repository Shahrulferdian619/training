<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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

        $data = User::where('level', '!=', '1')->get();
        // dd($data);
        return view('page.master.user.index', compact('data'));
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
        return view('page.master.user.create');
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
            'name'=>'required|unique:users,name',
            'email'=>'required|email',
            'level'=>'required',
            'password'=>'required|min:9'
        ],[
            'level.required'=>'Level user harus diisi',
            'name.required'=>'Nama user harus diisi',
            'email.required'=>'Email user harus diisi',
            'password.required'=>'Password user harus diisi',
            'name.unique'=>'Nama user sudah ada',
            'email.email'=>'Email user harus berupa Email',
        ]);

        try {
            DB::beginTransaction();

            User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'level'=>$request->level,
                'password' => Hash::make($request->password),
            ]);

            DB::commit();
            return back()->with('sukses', 'AKUN USER BERHASIL DIUPDATE');
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
        $data = User::find($id);
        return view('page.master.user.edit', compact('data'));
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
            'name'=>'required|unique:users,name,'.$id,
            'email'=>'required|email',
            'level'=>'required',
            'password'=>'required|min:9'
        ],[
            'level.required'=>'Level user harus diisi',
            'name.required'=>'Nama user harus diisi',
            'email.required'=>'Email user harus diisi',
            'password.required'=>'Password user harus diisi',
            'name.unique'=>'Nama user sudah ada',
            'email.email'=>'Email user harus berupa Email',
        ]);

        try {
            DB::beginTransaction();

            $data = User::find($id);

            $data->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'level'=>$request->level,
                'password' => Hash::make($request->password),
            ]);

            DB::commit();
            return back()->with('sukses', 'AKUN USER BERHASIL DIUPDATE');
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

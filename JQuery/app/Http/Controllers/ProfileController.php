<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function getData(){
        $data = Profile::all();
        // dd($data);
        return response()->json($data);
    }

    public function storeData(Request $req){
        Profile::create([
            'nama'=>$req->nama,
            'alamat'=>$req->alamat
        ]);

        return response()->json(['message'=>'Berhasil Input']);
    }

    public function getDataId($id){
        $dataId = Profile::find($id);
        return response()->json($dataId);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Tugas;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TugasController extends Controller
{
    public function tampil($id_user)
    {
        $tugas =  Tugas::where('id_user',$id_user)->get();

        if(!is_null($tugas)){
            return response([
                'message' => 'Berhasil',
                'data' => $tugas
            ],200);
        }
    }
    public function tampiltugas($id)
    {
        $tugas =  Tugas::where('id_user',$id)->get();
        if(!is_null($tugas)){
            return response([
                'message' => 'Berhasil',
                'data' => $tugas
            ],200);
        }
    }
    public function selesai(Request $request ,$id){
        $inputdata = $request->all();
        $tugas = Tugas::find($id);
        $tugas->status = "Selesai";
        $tugas->save();
    }
    public function tambah(Request $request)
    {
        $inputdata = $request->all();
        $validate = Validator::make($inputdata,[

            'nama_tugas' => 'required',
            
        ]);

        if($validate->fails())
        {
            return response(['message' => $validate->errors()],400);
        }
        $tugas = Tugas::create($inputdata);
        return response([
            'message' => 'Tambah tugas Berhasil',
            'data' => $tugas,
        ],200);
    }

    public function hapus($id)
    {
        $tugas = Tugas::find($id);

        if(is_null($tugas)){
            return response([
                'message' => 'tugas tidak ditemukan',
                'data' => null
            ],404);
        }

        $tugas->hapus = 0;
        if($tugas->save()){
            return response([
                'message' => 'Hapus tugas Berhasil',
                'data' => $tugas,
            ],200);
        };
    }

    public function update(Request $request, $id)
    {
        $tugas = Tugas::find($id);
        if(is_null($tugas)){
            return response([
                'message' => 'ttugas tidak ditemukan',
                'data' => null
            ], 404);
        }

        $updatedata = $request->all();
        $validate = Validator::make($updatedata, [
            'nama_tugas' => '',
            'status' => '',
          
        ]);

        if($validate->fails()){
            return response(['message' => $validate->errors()],400);
        }

        $tugas->nama_tugas = $updatedata['nama_tugas'];
        $tugas->status = $updatedata['status'];
       
        
        if($tugas->save()){
            return response([
                'message' => 'Update tugas Berhasil',
                'data' => $tugas,
            ],200);
        }

        return response([
            'message' => 'Update tugas Gagal',
            'data' => null
        ],400);
    }
}

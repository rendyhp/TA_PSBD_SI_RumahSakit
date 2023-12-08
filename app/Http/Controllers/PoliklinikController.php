<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//redirect
use Illuminate\Http\RedirectResponse;
//database
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PoliklinikController extends Controller
{
    public function tambah_poliklinik(){
        return view('admin.tambah_poliklinik');
    }

    public function store_poliklinik(Request $request){

        $request->validate([

            'id_poli' => 'required',
            'nama_poli' => 'required|string',
            'gedung' => 'required',

            ]);

        $save = DB::insert(
                'INSERT INTO tb_poliklinik(id_poli, nama_poli, gedung) VALUES (:id_poli, :nama_poli, :gedung)',
                [
                    'id_poli' => $request->id_poli,
                    'nama_poli' => $request->nama_poli,
                    'gedung' => $request->gedung,

                ]
            );

            if($save){
                return redirect('/data_poliklinik')->with('sukses', 'Data berhasil ditambahkan');
            }
    }

    public function hapus_poliklinik(Request $request){
        $id_poli = $request->id_poli;

        DB::table('tb_poliklinik')->where('id_poli', $id_poli)->update([
            'deleted_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect('/data_poliklinik')->with('hapus', 'Data poliklinik behasil dihapus');
    }

    public function hapus_poliklinik_permanen(Request $request){
        $id_poli = $request->id_poli;

        DB::delete('DELETE FROM tb_poliklinik WHERE id_poli = :id_poli', ['id_poli' => $id_poli]);

        return redirect('/data_poliklinik')->with('hapus', 'Data poliklinik berhasil dihapus selamanya');
    }

    public function restore_poliklinik(Request $request){
        $id_poli = $request->id_poli;

        DB::table('tb_poliklinik')->where('id_poli', $id_poli)->update([
            'deleted_at' => null,
        ]);

        return redirect('/data_restore_poliklinik')->with('update', 'Data poliklinik behasil dikembalikan');
    }

    public function edit_poliklinik($id){
        $data = DB::table('tb_poliklinik')->where('id_poli', $id)->first();
        return view('admin.edit_poliklinik', ['data' => $data]);
    }

    public function update_poliklinik(Request $request){
        $request->validate([
            'nama_poli' => 'required|string',
            'gedung' => 'required',
        ]);

        $poliklinik = DB::table('tb_poliklinik')->where('id_poli', $request->id_poli)->first();

        if ($poliklinik) {
            DB::table('tb_poliklinik')->where('id_poli', $poliklinik->id_poli)->update([
                
                'nama_poli' => $request->nama_poli,
                'gedung' => $request->gedung,
            ]);

            return redirect('/data_poliklinik')->with('update', 'Data poliklinik berhasil diperbarui');
        } else {
            // Handle jika data poliklinik tidak ditemukan
            return redirect('/data_poliklinik')->with('error', 'Data poliklinik tidak ditemukan');
        }
    }


    public function cari_poliklinik(Request $request){
        $pegawai = DB::table('tb_poliklinik')->where('deleted_at', null)->where('nama_poli', 'like', "%$request->keyword%")->get();
        return view('admin.cari_poliklinik', ['tb_poliklinik' => $pegawai, 'keyword' => $request->keyword]);
    }

    public function cari_restore_poliklinik(Request $request){
        $pegawai = DB::table('tb_poliklinik')->where('deleted_at', '!=', null)->where('nama_poli', 'like', "%$request->keyword%")->get();
        return view('admin.cari_restore_poliklinik', ['tb_poliklinik' => $pegawai, 'keyword' => $request->keyword]);
    }
}

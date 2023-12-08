<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//redirect
use Illuminate\Http\RedirectResponse;
//database
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DokterController extends Controller
{
    public function tambah_dokter(){
        return view('admin.tambah_dokter');
    }

    public function store_dokter(Request $request){

        $request->validate([

            'id_dokter' => 'required',
            'nama_dokter' => 'required|string',
            'spesialis' => 'required',
            'alamat' => 'required|string',
            'no_telp' => 'required|max:15',

            ]);

        $save = DB::insert(
                'INSERT INTO tb_dokter(id_dokter, nama_dokter, spesialis, alamat, no_telp) VALUES (:id_dokter, :nama_dokter, :spesialis, :alamat, :no_telp)',
                [
                    'id_dokter' => $request->id_dokter,
                    'nama_dokter' => $request->nama_dokter,
                    'spesialis' => $request->spesialis,
                    'alamat' => $request->alamat,
                    'no_telp' => $request->no_telp,

                ]
            );

            if($save){
                return redirect('/data_dokter')->with('sukses', 'Data berhasil ditambahkan');
            }
    }

    public function hapus_dokter(Request $request){
        $id_dokter = $request->id_dokter;

        DB::table('tb_dokter')->where('id_dokter', $id_dokter)->update([
            'deleted_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect('/data_dokter')->with('hapus', 'Data dokter behasil dihapus');
    }

    public function hapus_dokter_permanen(Request $request){
        $id_dokter = $request->id_dokter;

        DB::delete('DELETE FROM tb_dokter WHERE id_dokter = :id_dokter', ['id_dokter' => $id_dokter]);

        return redirect('/data_dokter')->with('hapus', 'Data dokter berhasil dihapus selamanya');
    }

    public function restore_dokter(Request $request){
        $id_dokter = $request->id_dokter;

        DB::table('tb_dokter')->where('id_dokter', $id_dokter)->update([
            'deleted_at' => null,
        ]);

        return redirect('/data_restore_dokter')->with('update', 'Data dokter behasil dikembalikan');
    }

    public function edit_dokter($id){
        $data = DB::table('tb_dokter')->where('id_dokter', $id)->first();
        return view('admin.edit_dokter', ['data' => $data]);
    }

    public function update_dokter(Request $request){
        $request->validate([
            'nama_dokter' => 'required|string',
            'spesialis' => 'required',
            'alamat' => 'required|string',
            'no_telp' => 'required|max:15',
        ]);

        $dokter = DB::table('tb_dokter')->where('id_dokter', $request->id_dokter)->first();

        if ($dokter) {
            DB::table('tb_dokter')->where('id_dokter', $dokter->id_dokter)->update([
                'nama_dokter' => $request->nama_dokter,
                'spesialis' => $request->spesialis,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
            ]);

            return redirect('/data_dokter')->with('update', 'Data dokter berhasil diperbarui');
        } else {
            // Handle jika data dokter tidak ditemukan
            return redirect('/data_dokter')->with('error', 'Data dokter tidak ditemukan');
        }
    }


    public function cari_dokter(Request $request){
        $pegawai = DB::table('tb_dokter')->where('deleted_at', null)->where('nama_dokter', 'like', "%$request->keyword%")->get();
        return view('admin.cari_dokter', ['tb_dokter' => $pegawai, 'keyword' => $request->keyword]);
    }

    public function cari_restore_dokter(Request $request){
        $pegawai = DB::table('tb_dokter')->where('deleted_at', '!=', null)->where('nama_dokter', 'like', "%$request->keyword%")->get();
        return view('admin.cari_restore_dokter', ['tb_dokter' => $pegawai, 'keyword' => $request->keyword]);
    }
}

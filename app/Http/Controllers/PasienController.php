<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//redirect
use Illuminate\Http\RedirectResponse;
//database
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PasienController extends Controller
{
    public function tambah_pasien(){
        return view('admin.tambah_pasien');
    }

    public function store_pasien(Request $request){

        $request->validate([

            'id_pasien' => 'required',
            'nomor_identitas'=> 'required',
            'nama_pasien' => 'required|string',
            'jenis_kelamin' => 'required',
            'alamat' => 'required|string',
            'no_telp' => 'required|max:15',

            ]);

        $save = DB::insert(
                'INSERT INTO tb_pasien(id_pasien, nomor_identitas, nama_pasien, jenis_kelamin, alamat, no_telp) VALUES (:id_pasien, :nomor_identitas, :nama_pasien, :jenis_kelamin, :alamat, :no_telp)',
                [
                    'id_pasien' => $request->id_pasien,
                    'nomor_identitas' => $request->nomor_identitas,
                    'nama_pasien' => $request->nama_pasien,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'alamat' => $request->alamat,
                    'no_telp' => $request->no_telp,

                ]
            );

            if($save){
                return redirect('/data_pasien')->with('sukses', 'Data berhasil ditambahkan');
            }
    }

    public function hapus_pasien(Request $request){
        $id_pasien = $request->id_pasien;

        DB::table('tb_pasien')->where('id_pasien', $id_pasien)->update([
            'deleted_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect('/data_pasien')->with('hapus', 'Data pasien berhasil dihapus');
    }

    public function hapus_pasien_permanen(Request $request){
        $id_pasien = $request->id_pasien;

        DB::delete('DELETE FROM tb_pasien WHERE id_pasien = :id_pasien', ['id_pasien' => $id_pasien]);

        return redirect('/data_pasien')->with('hapus', 'Data pasien berhasil dihapus');
    }

    public function restore_pasien(Request $request){
        $id_pasien = $request->id_pasien;

        DB::table('tb_pasien')->where('id_pasien', $id_pasien)->update([
            'deleted_at' => null,
        ]);

        return redirect('/data_restore_pasien')->with('update', 'Data pasien berhasil dikembalikan');
    }

    public function edit_pasien($id){
        $data = DB::table('tb_pasien')->where('id_pasien', $id)->first();
        return view('admin.edit_pasien', ['data' => $data]);
    }

    public function update_pasien(Request $request){

        $request->validate([

            'nomor_identitas' => 'required',
            'nama_pasien' => 'required|string',
            'jenis_kelamin' => 'required',
            'alamat' => 'required|string',
            'no_telp' => 'required|max:15',
        ]);

        $pasien = DB::table('tb_pasien')->where('id_pasien', $request->id_pasien)->first();

        if ($pasien) {
            DB::table('tb_pasien')->where('id_pasien', $pasien->id_pasien)->update([

                    'nomor_identitas' => $request->nomor_identitas,
                    'nama_pasien' => $request->nama_pasien,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'alamat' => $request->alamat,
                    'no_telp' => $request->no_telp,
            ]);

            return redirect('/data_pasien')->with('update', 'Data dokter berhasil diperbarui');
        } else {
            // Handle jika data dokter tidak ditemukan
            return redirect('/data_pasien')->with('error', 'Data dokter tidak ditemukan');
        }
    }

    public function cari_pasien(Request $request){
        $pasien = DB::table('tb_pasien')->where('deleted_at', null)->where('nama_pasien', 'like', "%$request->keyword%")->get();
        return view('admin.cari_pasien', ['tb_pasien' => $pasien, 'keyword' => $request->keyword]);
    }

    public function cari_restore_pasien(Request $request){
        $pasien = DB::table('tb_pasien')->where('deleted_at', '!=', null)->where('nama_pasien', 'like', "%$request->keyword%")->get();
        return view('admin.cari_restore_pasien', ['tb_pasien' => $pasien, 'keyword' => $request->keyword]);
    }

}

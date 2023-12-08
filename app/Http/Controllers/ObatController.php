<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//redirect
use Illuminate\Http\RedirectResponse;
//database
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ObatController extends Controller
{
    public function tambah_obat(){
        return view('admin.tambah_obat');
    }

    public function store_obat(Request $request){

        $request->validate([

            'id_obat' => 'required',
            'nama_obat' => 'required|string',
            'keterangan' => 'required',

            ]);

        $save = DB::insert(
                'INSERT INTO tb_obat(id_obat, nama_obat, keterangan) VALUES (:id_obat, :nama_obat, :keterangan)',
                [
                    'id_obat' => $request->id_obat,
                    'nama_obat' => $request->nama_obat,
                    'keterangan' => $request->keterangan,
                ]
            );

            if($save){
                return redirect('/data_obat')->with('sukses', 'Data berhasil ditambahkan');
            }
    }

    public function hapus_obat(Request $request){
        $id_obat = $request->id_obat;

        DB::table('tb_obat')->where('id_obat', $id_obat)->update([
            'deleted_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect('/data_obat')->with('hapus', 'Data obat behasil dihapus');
    }

    public function hapus_obat_permanen(Request $request){
        $id_obat = $request->id_obat;

        DB::delete('DELETE FROM tb_obat WHERE id_obat = :id_obat', ['id_obat' => $id_obat]);

        return redirect('/data_obat')->with('hapus', 'Data obat berhasil dihapus selamanya');
    }

    public function restore_obat(Request $request){
        $id_obat = $request->id_obat;

        DB::table('tb_obat')->where('id_obat', $id_obat)->update([
            'deleted_at' => null,
        ]);

        return redirect('/data_restore_obat')->with('update', 'Data obat behasil dikembalikan');
    }

    public function edit_obat($id){
        $data = DB::table('tb_obat')->where('id_obat', $id)->first();
        return view('admin.edit_obat', ['data' => $data]);
    }

    public function update_obat(Request $request){
        $request->validate([
            'nama_obat' => 'required|string',
            'keterangan' => 'required',
        ]);

        $obat = DB::table('tb_obat')->where('id_obat', $request->id_obat)->first();

        if ($obat) {
            DB::table('tb_obat')->where('id_obat', $obat->id_obat)->update([
                'nama_obat' => $request->nama_obat,
                'keterangan' => $request->keterangan,
            ]);

            return redirect('/data_obat')->with('update', 'Data obat berhasil diperbarui');
        } else {
            // Handle jika data obat tidak ditemukan
            return redirect('/data_obat')->with('error', 'Data obat tidak ditemukan');
        }
    }


    public function cari_obat(Request $request){
        $pegawai = DB::table('tb_obat')->where('deleted_at', null)->where('nama_obat', 'like', "%$request->keyword%")->get();
        return view('admin.cari_obat', ['tb_obat' => $pegawai, 'keyword' => $request->keyword]);
    }

    public function cari_restore_obat(Request $request){
        $pegawai = DB::table('tb_obat')->where('deleted_at', '!=', null)->where('nama_obat', 'like', "%$request->keyword%")->get();
        return view('admin.cari_restore_obat', ['tb_obat' => $pegawai, 'keyword' => $request->keyword]);
    }
}

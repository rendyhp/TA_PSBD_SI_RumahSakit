<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//redirect
use Illuminate\Http\RedirectResponse;
//database
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RekammedisController extends Controller
{
    public function tambah_rekammedis(){
        
        $datas = DB::Select("SELECT * FROM tb_pasien");
        $datasDokter = DB::Select("SELECT * FROM tb_dokter");
        $datasPoliklinik = DB::Select("SELECT * FROM tb_poliklinik");
        $datasObat = DB::Select("SELECT * FROM tb_obat");
        $datasRMObat = DB::Select("SELECT * FROM tb_rm_obat");

        $selectedObats = DB::table('tb_obat')
            ->pluck('id_obat')
            ->toArray();

    return view('admin.tambah_rekammedis',
        ['datas' => $datas,
        'selectedObats' => $selectedObats,
        'datasDokter' => $datasDokter,
        'datasPoliklinik' => $datasPoliklinik,
        'datasObat' => $datasObat,
        'datasRMObat' => $datasRMObat,
        ]);
    }

    public function store_rekammedis(Request $request){

        $request->validate([

            'id_rm' => 'required',
            'tgl_periksa' => 'required',
            'id_pasien' =>'required',
            'keluhan' => 'required',
            'id_dokter' => 'required',
            'diagnosa' => 'required',
            'id_obat' => 'required',
            'id_poli' => 'required',

            ]);

        
        $save = DB::insert(
                'INSERT INTO tb_rekammedis(id_rm, tgl_periksa, id_pasien, keluhan, id_dokter, diagnosa, id_poli) VALUES (:id_rm, :tgl_periksa, :id_pasien, :keluhan, :id_dokter, :diagnosa, :id_poli)',
                [
                    'id_rm' => $request->id_rm,
                    'tgl_periksa' => $request->tgl_periksa,
                    'id_pasien' => $request->id_pasien,
                    'keluhan' => $request->keluhan,
                    'id_dokter' => $request->id_dokter,
                    'diagnosa' => $request->diagnosa,
                    'id_poli' => $request->id_poli,
                ]
            );
            // Simpan data obat
        foreach ($request->id_obat as $obatId) {
            $saveObat = DB::insert(
                'INSERT INTO tb_rm_obat(id_rm_obat, id_rm, id_obat) VALUES (:id_rm_obat, :id_rm, :id_obat)',
                [
                    'id_rm_obat' => $request->id_rm_obat,
                    'id_rm' => $request->id_rm,
                    'id_obat' => $obatId,
                ]
            );
        }


            

            if($save && $saveObat){
                return redirect('/data_rekammedis')->with('sukses', 'Data berhasil ditambahkan');
            }
    }

    public function hapus_rekammedis(Request $request){
        $id_rm = $request->id_rm;

        DB::table('tb_rekammedis')->where('id_rm', $id_rm)->update([
            'deleted_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect('/data_rekammedis')->with('hapus', 'Data Rekam Medis behasil dihapus');
    }

    public function hapus_rekammedis_permanen(Request $request){
        $id_rm = $request->id_rm;

        DB::delete('DELETE FROM tb_rm_obat WHERE id_rm_obat = :id_rm', ['id_rm' => $id_rm]);
        DB::delete('DELETE FROM tb_rekammedis WHERE id_rm = :id_rm', ['id_rm' => $id_rm]);

        return redirect('/data_rekammedis')->with('hapus', 'Data Rekam Medis berhasil dihapus selamanya');
    }

    public function restore_rekammedis(Request $request){
        $id_rm = $request->id_rm;

        DB::table('tb_rekammedis')->where('id_rm', $id_rm)->update([
            'deleted_at' => null,
        ]);

        return redirect('/data_restore_rekammedis')->with('update', 'Data Rekam Medis behasil dikembalikan');
    }

    public function edit_rekammedis($id){
        $data = DB::table('tb_rekammedis')->where('id_rm', $id)->first();


        $datas = DB::Select("SELECT * FROM tb_pasien");
        $datasDokter = DB::Select("SELECT * FROM tb_dokter");
        $datasPoliklinik = DB::Select("SELECT * FROM tb_poliklinik");
        $datasObat = DB::Select("SELECT * FROM tb_obat");
        $datasRMObat = DB::Select("SELECT * FROM tb_rm_obat");

        $selectedObats = DB::table('tb_rm_obat')
        ->pluck('id_obat')
        ->toArray();
        
        return view('admin.edit_rekammedis', [
            'selectedObats' => $selectedObats,
            'data' => $data,
            'datas' => $datas,
            'datasDokter' => $datasDokter,
            'datasPoliklinik' => $datasPoliklinik,
            'datasObat' => $datasObat,
            'datasRMObat' => $datasRMObat,]);
    }

    public function update_rekammedis(Request $request){

        $request->validate([
            'tgl_periksa' => 'required',
            'id_pasien' =>'required',
            'keluhan' => 'required',
            'id_dokter' => 'required',
            'diagnosa' => 'required',
            'id_obat' => 'required',
            'id_poli' => 'required',
        ]);

        $rekammedis = DB::table('tb_rekammedis')->where('id_rm', $request->id_rm)->first();

        if ($rekammedis) {
            DB::table('tb_rekammedis')->where('id_rm', $rekammedis->id_rm)->update([

                'tgl_periksa' => $request->tgl_periksa,
                'id_pasien' => $request->id_pasien,
                'keluhan' => $request->keluhan,
                'id_dokter' => $request->id_dokter,
                'diagnosa' => $request->diagnosa,
                'id_poli' => $request->id_poli,
            ]);

            // Hapus data obat terkait
        DB::table('tb_rm_obat')->where('id_rm', $rekammedis->id_rm)->delete();

        // Simpan kembali data obat
        foreach ($request->id_obat as $obatId) {
            DB::table('tb_rm_obat')->insert([
                'id_rm_obat' => $request->id_rm_obat,
                'id_rm' => $request->id_rm,
                'id_obat' => $obatId,
            ]);
        }

            return redirect('/data_rekammedis')->with('update', 'Data Rekam Medis berhasil diperbarui');
        } else {
            // Handle jika data rekammedis tidak ditemukan
            return redirect('/data_rekammedis')->with('error', 'Data Rekam Medis tidak ditemukan');
        }
    }

        

        public function cari_rekammedis(Request $request){
            $datas = DB::table('tb_rekammedis as A')
            ->join('tb_dokter as B', 'A.id_dokter', '=', 'B.id_dokter')
            ->join('tb_pasien as C', 'A.id_pasien', '=', 'C.id_pasien')
            ->join('tb_poliklinik as D', 'A.id_poli', '=', 'D.id_poli')
            ->where('A.deleted_at', null)->where('nama_pasien', 'like', "%$request->keyword%")->get()
            ;
    
            
        $datasObat = DB::Select("SELECT * FROM tb_rm_obat");
        $medicine = DB::Select("SELECT * FROM tb_obat");
    
        return view('admin.cari_rekammedis', [
            'tb_rekammedis' => $datas,
            'datasObat' => $datasObat,
            'medicine' => $medicine,
            'keyword' => $request->keyword,
        ]);

        }
    
        public function cari_restore_rekammedis(Request $request){
            $datas = DB::table('tb_rekammedis as A')
            ->join('tb_dokter as B', 'A.id_dokter', '=', 'B.id_dokter')
            ->join('tb_pasien as C', 'A.id_pasien', '=', 'C.id_pasien')
            ->join('tb_poliklinik as D', 'A.id_poli', '=', 'D.id_poli')
            ->where('A.deleted_at', '!=', null)->where('nama_pasien', 'like', "%$request->keyword%")->get()
            ;
    
            
        $datasObat = DB::Select("SELECT * FROM tb_rm_obat");
        $medicine = DB::Select("SELECT * FROM tb_obat");
    
        return view('admin.cari_restore_rekammedis', [
            'tb_rekammedis' => $datas,
            'datasObat' => $datasObat,
            'medicine' => $medicine,
            'keyword' => $request->keyword,
        ]);
        }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function index(){
        $datas = DB::Select("SELECT * FROM tb_user");
       return view('admin.dashboard', ['tb_user' => $datas]);
    }

    public function data_dokter(){
        $dokter = DB::table('tb_dokter')->where('deleted_at', null)->paginate(10);
        return view('admin.data_dokter', ['tb_dokter' => $dokter]);
    }

    public function data_restore_dokter(){
        $dokter = DB::table('tb_dokter')->where('deleted_at', '!=', null)->paginate(10);
        return view('admin.data_restore_dokter', ['tb_dokter' => $dokter]);
    }

    public function data_obat(){
        $obat = DB::table('tb_obat')->where('deleted_at', null)->paginate(10);
        return view('admin.data_obat', ['tb_obat' => $obat]);
    }

    public function data_restore_obat(){
        $obat = DB::table('tb_obat')->where('deleted_at', '!=', null)->paginate(10);
        return view('admin.data_restore_obat', ['tb_obat' => $obat]);
    }

    public function data_poliklinik(){
        $poliklinik = DB::table('tb_poliklinik')->where('deleted_at', null)->paginate(10);
        return view('admin.data_poliklinik', ['tb_poliklinik' => $poliklinik]);
    }

    public function data_restore_poliklinik(){
        $poliklinik = DB::table('tb_poliklinik')->where('deleted_at', '!=', null)->paginate(10);
        return view('admin.data_restore_poliklinik', ['tb_poliklinik' => $poliklinik]);
    }


    public function data_pasien(){
        $pasien = DB::table('tb_pasien')->where('deleted_at', null)->paginate(10);
        return view('admin.data_pasien', ['tb_pasien' => $pasien]);
    }

    public function data_restore_pasien(){
        $pasien = DB::table('tb_pasien')->where('deleted_at', '!=', null)->paginate(10);
        return view('admin.data_restore_pasien', ['tb_pasien' => $pasien]);
    }

    public function data_rekammedis(){
        $datas = DB::table('tb_rekammedis as A')
            ->join('tb_dokter as B', 'A.id_dokter', '=', 'B.id_dokter')
            ->join('tb_pasien as C', 'A.id_pasien', '=', 'C.id_pasien')
            ->join('tb_poliklinik as D', 'A.id_poli', '=', 'D.id_poli')
            ->where('A.deleted_at', null)
            ->paginate(10);

        $datasObat = DB::Select("SELECT * FROM tb_rm_obat");
        $medicine = DB::Select("SELECT * FROM tb_obat");
    
        return view('admin.data_rekammedis', [
            'tb_rekammedis' => $datas,
            'datasObat' => $datasObat,
            'medicine' => $medicine,
        
        ]);
    }
    
    

    public function data_restore_rekammedis(){
        $datas = DB::table('tb_rekammedis as A')
        ->join('tb_dokter as B', 'A.id_dokter', '=', 'B.id_dokter')
        ->join('tb_pasien as C', 'A.id_pasien', '=', 'C.id_pasien')
        ->join('tb_poliklinik as D', 'A.id_poli', '=', 'D.id_poli')
        ->where('A.deleted_at', '!=', null)
        ->paginate(10);

        
    $datasObat = DB::Select("SELECT * FROM tb_rm_obat");
    $medicine = DB::Select("SELECT * FROM tb_obat");

    return view('admin.data_restore_rekammedis', [
        'tb_rekammedis' => $datas,
        'datasObat' => $datasObat,
        'medicine' => $medicine,
    
    ]);
    }
    
}

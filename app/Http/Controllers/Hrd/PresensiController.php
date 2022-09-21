<?php

namespace App\Http\Controllers\Hrd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Presensi;
use App\Models\Karyawan;

class PresensiController extends Controller
{
    function tampilPresensi(){
        $data = Karyawan::all();
        return view('hrd.presensi.presensi', [
            'karyawan' => $data
        ]);
    }

    function detailPresensi($id){
        $data = Presensi::join('karyawan', 'karyawan.id_karyawan', '=', 'presensi.id_karyawan')->where('presensi.id_karyawan', $id)->get();    

        $hari_kerja = Presensi::where('id_karyawan', $id)
        ->where('status', 1)
        ->whereTime('masuk', '<=', '9:00:00')
        ->count();
        
        return view('hrd.presensi.detailPresensi', [
            'presensi' => $data,
            'jhk' => $hari_kerja,
        ]);
    }
}

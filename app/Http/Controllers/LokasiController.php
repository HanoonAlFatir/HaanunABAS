<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class LokasiController extends Controller
{
    public function lokasisekolah()
    {
        $lok_sekolah = DB::table('koordinat_sekolahs')->where('id_koordinat_sekolah', 1)->first();
        $waktu = DB::table('waktu__absens')->where('id_waktu_absen', 1)->first();
        // $lok = explode(",", $lok_sekolah->lokasi_sekolah);
        // $latitudesekolah = $lok[0];
        // $longitudesekolah = $lok[1];
        return view('operator.lokasi', compact('lok_sekolah', 'waktu'));
    }

    public function updatelokasisekolah(Request $request)
    {
        $lokasi_sekolah = $request->input('titik_koordinat');
        $radius = $request->input('jarak');
        
        $update = DB::table('koordinat_sekolahs')
            ->where('id_koordinat_sekolah', 1)
            ->update([
                'titik_koordinat' => $lokasi_sekolah,
                'jarak' => $radius
            ]);

        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diupdate']);
        }
    }

    public function updatewaktu(Request $request)
    {
        $jam_masuk = $request->input('jam_masuk');
        $jam_pulang = $request->input('jam_pulang');
        $batas_jam_masuk = $request->input('batas_jam_masuk');
        $batas_jam_pulang = $request->input('batas_jam_pulang');

        $update = DB::table('waktu__absens')
            ->where('id_waktu_absen', 1)
            ->update([
                'jam_masuk' => $jam_masuk,
                'jam_pulang' => $jam_pulang,
                'batas_jam_masuk' => $batas_jam_masuk,
                'batas_jam_pulang' => $batas_jam_pulang
            ]);

        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Diupdate']);
        }
    }
}

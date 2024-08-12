<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AbsenSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $nis = $user->siswa->nis;
        $hariini = date("Y-m-d");
        $cek = DB::table('absensis')->where('date', $hariini)->where('nis', $nis)->first();

        if ($cek) {
            $statusAbsen = $cek->jam_masuk ? 'Hadir' : 'Belum Absen';

            if ($cek->jam_masuk && ($cek->photo_out || $cek->titik_koordinat_pulang)) {
                $statusAbsen = 'Sudah Pulang';
            } elseif ($cek->jam_masuk) {
                $statusAbsen = 'Hadir';
            }
        } else {
            $statusAbsen = 'Belum Absen';
        }

        $waktu = DB::table('waktu__absens')->where('id_waktu_absen', 1)->first();
        $lok_sekolah = DB::table('koordinat_sekolahs')->where('id_koordinat_sekolah', 1)->first();
        $presensi_hari_ini = DB::table('absensis')->where('nis', $nis)->where('jam_masuk');
        $siswa = Siswa::with('user')->get();
        return view('siswa.dashboardsiswa', [
            'waktu' => $waktu,
            'cek' => $cek ? 1 : 0,
            'statusAbsen' => $statusAbsen,
            'lok_sekolah' => $lok_sekolah,
            'siswa' => $siswa
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

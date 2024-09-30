<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Siswa;
use App\Models\Wali_Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WaliSiswaController extends Controller
{
    public function index(){
        $walisiswa = wali_siswa::where('id_user', Auth::user()->id)->with('user')->first();
        $siswa = siswa::with('user', 'kelas')->where('nik', $walisiswa->nik)->get();
        $int = 0;
        $siswa = $siswa->toArray();
        foreach ($siswa as $s) {
            $nama[] = strtoLower($s["user"]["name"]);
            $semua = Absensi::where('nis', $s["nis"])->get();
            $ini = Absensi::whereYear('date', date('Y'))
                ->where('nis', $s["nis"])
                ->whereMonth('date', date('m'))->get();
            $lalu = Absensi::whereYear('date', date('Y'))
                ->where('nis', $s["nis"])
                ->whereMonth('date', date('m', strtotime('first day of previous month')))->get();

            $jumlah[] = [
                // SEMUA
                'semua' => $semua->count(),
                'hadirSemua' => $semua->where('status', "Hadir")->count(),
                'sakitSemua' => $semua->where('status', "Sakit")->count(),
                'izinSemua' => $semua->where('status', "Izin")->count(),
                'terlambatSemua' => $semua->where('status', "Terlambat")->count(),
                'alfaSemua' => $semua->where('status', "Alfa")->count(),
                'tapSemua' => $semua->where('status', "TAP")->count(),

                // BULAN INI
                'ini' => $ini->count(),
                'hadirIni' => $ini->where('status', "Hadir")->count(),
                'sakitIni' => $ini->where('status', "Sakit")->count(),
                'izinIni' => $ini->where('status', "Izin")->count(),
                'terlambatIni' => $ini->where('status', "Terlambat")->count(),
                'alfaIni' => $ini->where('status', "Alfa")->count(),
                'tapIni' => $ini->where('status', "TAP")->count(),

                // BULAN LALU
                'lalu' => $lalu->count(),
                'hadirLalu' => $lalu->where('status', "Hadir")->count(),
                'sakitLalu' => $lalu->where('status', "Sakit")->count(),
                'izinLalu' => $lalu->where('status', "Izin")->count(),
                'terlambatLalu' => $lalu->where('status', "Terlambat")->count(),
                'alfaLalu' => $lalu->where('status', "Alfa")->count(),
                'tapLalu' => $lalu->where('status', "TAP")->count(),
            ];
            $persentase[] = [
                'semua' => $jumlah["$int"]['hadirSemua'] > 0 ? round(($jumlah["$int"]['hadirSemua'] / $jumlah["$int"]['semua']) * 100, 1) :0,
                'ini' => $jumlah["$int"]['hadirIni'] > 0 ? round(($jumlah["$int"]['hadirIni'] / $jumlah["$int"]['ini']) * 100, 1) : 0,
                'lalu' => $jumlah["$int"]['hadirLalu'] > 0 ? round(($jumlah["$int"]['hadirLalu'] / $jumlah["$int"]['lalu']) * 100, 1) : 0
            ];

            $int = $int + 1;
        }
        return view('walisiswa.dashboardwalisiswa', compact('walisiswa', 'siswa', 'ini', 'lalu', 'jumlah', 'persentase'));
    }
}

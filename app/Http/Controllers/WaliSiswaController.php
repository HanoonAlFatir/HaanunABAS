<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Wali_Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class WaliSiswaController extends Controller
{
    public function index()
    {
        // Get the logged-in user's Wali_Siswa
        $walisiswa = Wali_Siswa::where('id_user', Auth::id())->first();

        // Fetch the students (siswa) related to the logged-in wali siswa
        $siswas = $walisiswa->siswa()->with('kelas')->get(); // Load 'kelas' relationship

        foreach ($siswas as $siswa) {
            $nis = $siswa->nis;

            // Initialize arrays to hold the attendance data
            $dataBulanIni = [];
            $dataBulanSebelumnya = [];

            // Get attendance data for the current month
            $dataBulanIni = Absensi::whereYear('date', date('Y'))
                ->where('nis', $nis)
                ->whereMonth('date', date('m'))
                ->select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->pluck('total', 'status')
                ->toArray();

            // Get attendance data for the previous month
            $dataBulanSebelumnya = Absensi::whereYear('date', date('Y'))
                ->where('nis', $nis)
                ->whereMonth('date', date('m', strtotime('first day of previous month')))
                ->select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->pluck('total', 'status')
                ->toArray();

            // Combine 'Sakit' and 'Izin' into one category for both months
            $dataBulanIni['Sakit/Izin'] = ($dataBulanIni['Sakit'] ?? 0) + ($dataBulanIni['Izin'] ?? 0);
            unset($dataBulanIni['Sakit'], $dataBulanIni['Izin']);

            $dataBulanSebelumnya['Sakit/Izin'] = ($dataBulanSebelumnya['Sakit'] ?? 0) + ($dataBulanSebelumnya['Izin'] ?? 0);
            unset($dataBulanSebelumnya['Sakit'], $dataBulanSebelumnya['Izin']);

            // Status that should be displayed
            $statuses = ['Hadir', 'Sakit/Izin', 'Alfa', 'Terlambat', 'TAP'];
            foreach ($statuses as $status) {
                if (!array_key_exists($status, $dataBulanIni)) {
                    $dataBulanIni[$status] = 0;
                }
                if (!array_key_exists($status, $dataBulanSebelumnya)) {
                    $dataBulanSebelumnya[$status] = 0;
                }
            }

            // Calculate totals and percentages for the current month
            $totalAbsenBulanIni = array_sum($dataBulanIni);
            $siswa->persentaseHadirBulanIni = $totalAbsenBulanIni > 0 ? round(($dataBulanIni['Hadir'] / $totalAbsenBulanIni) * 100) : 0;
            $siswa->persentaseSakitIzinBulanIni = $totalAbsenBulanIni > 0 ? round(($dataBulanIni['Sakit/Izin'] / $totalAbsenBulanIni) * 100) : 0;
            $siswa->persentaseAlfaBulanIni = $totalAbsenBulanIni > 0 ? round(($dataBulanIni['Alfa'] / $totalAbsenBulanIni) * 100) : 0;
            $siswa->persentaseTerlambatBulanIni = $totalAbsenBulanIni > 0 ? round(($dataBulanIni['Terlambat'] / $totalAbsenBulanIni) * 100) : 0;
            $siswa->persentaseTAPBulanIni = $totalAbsenBulanIni > 0 ? round(($dataBulanIni['TAP'] / $totalAbsenBulanIni) * 100) : 0;

            // Calculate totals and percentages for the previous month
            $totalAbsenBulanSebelumnya = array_sum($dataBulanSebelumnya);
            $siswa->persentaseHadirBulanSebelumnya = $totalAbsenBulanSebelumnya > 0 ? round(($dataBulanSebelumnya['Hadir'] / $totalAbsenBulanSebelumnya) * 100) : 0;
            $siswa->persentaseSakitIzinBulanSebelumnya = $totalAbsenBulanSebelumnya > 0 ? round(($dataBulanSebelumnya['Sakit/Izin'] / $totalAbsenBulanSebelumnya) * 100) : 0;
            $siswa->persentaseAlfaBulanSebelumnya = $totalAbsenBulanSebelumnya > 0 ? round(($dataBulanSebelumnya['Alfa'] / $totalAbsenBulanSebelumnya) * 100) : 0;
            $siswa->persentaseTerlambatBulanSebelumnya = $totalAbsenBulanSebelumnya > 0 ? round(($dataBulanSebelumnya['Terlambat'] / $totalAbsenBulanSebelumnya) * 100) : 0;
            $siswa->persentaseTAPBulanSebelumnya = $totalAbsenBulanSebelumnya > 0 ? round(($dataBulanSebelumnya['TAP'] / $totalAbsenBulanSebelumnya) * 100) : 0;

            // Attach the data to the student object
            $siswa->dataBulanIni = $dataBulanIni;
            $siswa->dataBulanSebelumnya = $dataBulanSebelumnya;
        }

        return view('walisiswa.dashboardwalisiswa', compact('siswas'));
    }
    public function profil()
    {
        $walisiswa = Wali_Siswa::where('id_user', Auth::user()->id)->with('user')->first();
        $siswa = Siswa::with('user', 'kelas')->where('nik', $walisiswa->nik)->first();

        return view('walisiswa.profilewali', compact('walisiswa', 'siswa'));
    }
    public function editprofil(request $request)
    {
        $f = false;
        $p = false;

        //password
        $count = strlen($request->password);
        if ($count > 0) {
            $p = User::where('id', $request->id)->update([
                'password' => password_hash($request->password, PASSWORD_DEFAULT)
            ]);
        }
        if ($request->password != $request->kPassword) {
            return redirect()->back()->with('failed', 'Password Berbeda');
        }

        //foto
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');

            $folderPath = "public/user_avatar/";

            $extension = $foto->getClientOriginalExtension();
            $fileName = $request->nis . '.' . $extension;
            $file = $folderPath . $fileName;

            Storage::put($file, file_get_contents($foto));

            $f = User::where('id', $request->id)->update([
                'foto' => $fileName
            ]);
        }

        // email
        $u = User::where('id', $request->id)->update([
            'email' => $request->email,
        ]);

        //redirecting
        if ($u || $f || $p) {
            return redirect()->back()->with('success', "Data Berhasil di Update");
        } else {
            return redirect()->back()->with('failed', "Data Gagal di Update");
        }
    }


}

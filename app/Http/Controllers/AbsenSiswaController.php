<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Koordinat_Sekolah;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
                $statusAbsen = $cek->status;
            }
        } else {
            $statusAbsen = 'Belum Absen';
        }

        $dataBulanIni = Absensi::whereYear('date', date('Y'))
            ->where('nis', $nis)
            ->whereMonth('date', date('m'))
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $dataBulanSebelumnya = Absensi::whereYear('date', date('Y'))
            ->where('nis', $nis)
            ->whereMonth('date', date('m', strtotime('first day of previous month')))
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        $statuses = ['Hadir', 'Sakit', 'Izin', 'Alfa', 'Terlambat', 'TAP'];
        foreach ($statuses as $status) {
            if (!array_key_exists($status, $dataBulanIni)) {
                $dataBulanIni[$status] = 0;
            }
            if (!array_key_exists($status, $dataBulanSebelumnya)) {
                $dataBulanSebelumnya[$status] = 0;
            }
        }

        $totalAbsenBulanIni = array_sum($dataBulanIni);
        $persentaseHadirBulanIni = $totalAbsenBulanIni > 0 ? round(($dataBulanIni['Hadir'] / $totalAbsenBulanIni) * 100) : 0;

        // Menghitung persentase hadir bulan sebelumnya
        $totalAbsenBulanSebelumnya = array_sum($dataBulanSebelumnya);
        $persentaseHadirBulanSebelumnya = $totalAbsenBulanSebelumnya > 0 ? round(($dataBulanSebelumnya['Hadir'] / $totalAbsenBulanSebelumnya) * 100) : 0;

        // $batas_absen_pulang = '23:10';
        // $jam_absen = '07:00';
        $jam = date("H:i:s");
        $waktu = DB::table('waktu__absens')->where('id_waktu_absen', 1)->first();
        $lok_sekolah = DB::table('koordinat_sekolahs')->where('id_koordinat_sekolah', 1)->first();
        $presensi_hari_ini = DB::table('absensis')->where('nis', $nis)->where('jam_masuk');
        $siswa = Siswa::with('kelas')->where('id_user', $user->id)->first();
        if ($siswa) {
            $kelas = $siswa->kelas;
            $tingkat = $kelas->tingkat;
            $nama_jurusan = $kelas->jurusan->id_jurusan;
            $nomor_kelas = $kelas->nomor_kelas;
        } else {
            $tingkat = 'Tingkat tidak ditemukan';
            $nama_jurusan = 'Jurusan tidak ditemukan';
            $nomor_kelas = 'Nomor kelas tidak ditemukan';
        }
        return view('siswa.dashboardsiswa', [
            'waktu' => $waktu,
            'cek' => $cek ? 1 : 0,
            'statusAbsen' => $statusAbsen,
            'lok_sekolah' => $lok_sekolah,
            'siswa' => $siswa,
            'jam' => $jam,
            'jam_absen' => $waktu->jam_masuk,
            'batas_absen_pulang' => $waktu->batas_jam_pulang,
            // 'tingkat' => $kelas->tingkat,
            // 'nama_jurusan' => $kelas->nama_jurusan,
            // 'nomor_kelas' => $kelas->nomor_kelas
            'user' => $user,
            'tingkat' => $tingkat,
            'nama_jurusan' => $nama_jurusan,
            'nomor_kelas' => $nomor_kelas,
            'dataBulanIni' => $dataBulanIni,
            'dataBulanSebelumnya' => $dataBulanSebelumnya,
            'persentaseHadirBulanIni' => $persentaseHadirBulanIni,
            'persentaseHadirBulanSebelumnya' => $persentaseHadirBulanSebelumnya,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function absen()
    {
        $user = Auth::user();
        $nis = $user->siswa->nis;
        $hariini = date("Y-m-d");
        $cek = DB::table('absensis')->where('date', $hariini)->where('nis', $nis)->count();
        $lok_sekolah = DB::table('koordinat_sekolahs')->where('id_koordinat_sekolah', 1)->first();
        $waktu = DB::table('waktu__absens')->where('id_waktu_absen', 1)->first();
        $siswa = Siswa::with('kelas')->where('id_user', $user->id)->first();
        if ($siswa) {
            $kelas = $siswa->kelas;
            $tingkat = $kelas->tingkat;
            $nama_jurusan = $kelas->jurusan->id_jurusan;
            $nomor_kelas = $kelas->nomor_kelas;
        } else {
            $tingkat = 'Tingkat tidak ditemukan';
            $nama_jurusan = 'Jurusan tidak ditemukan';
            $nomor_kelas = 'Nomor kelas tidak ditemukan';
        }
        $absensi = Absensi::where('nis', $nis)->where('date', $hariini)->paginate(7);
        return view('siswa.absen', compact('lok_sekolah', 'waktu', 'cek', 'user', 'siswa', 'tingkat', 'nama_jurusan', 'nomor_kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $nis = $user->siswa->nis;
        $status = 'Hadir';
        $date = date("Y-m-d");
        $jam = date("H:i:s");

        $lokasiSiswa = $request->lokasi;
        $lokasiuser = explode(",", $lokasiSiswa);
        $latitudeuser = $lokasiuser[0];
        $longitudeuser = $lokasiuser[1];
        $lok_sekolah = Koordinat_Sekolah::first();
        $radiussekolah = $lok_sekolah->jarak;
        $lok = explode(",", $lok_sekolah->titik_koordinat);
        $latitudesekolah = $lok[0];
        $longitudesekolah = $lok[1];
        $jarak = $this->distance($latitudesekolah, $longitudesekolah, $latitudeuser, $longitudeuser);
        $radius = round($jarak["meters"]);

        $image = $request->image;
        $folderPath = "public/uploads/absensi/";
        $formatName = $nis . "-" . $date;
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";
        $file = $folderPath . $fileName;

        // Get face confidence
        $faceConfidence = $request->faceConfidence;

        $batasMasuk = DB::table('waktu__absens')->value('batas_jam_masuk');

        // Determine status

        if ($jam > $batasMasuk) {
            $status = 'Terlambat';
        } else {
            $status = 'Hadir';
        }

        $cek = DB::table('absensis')->where('date', $date)->where('nis', $nis)->count();
        if ($radius > $radiussekolah) {
            echo "error|Anda Berada Diluar Radius, Jarak Anda " . $radius . " meter dari Sekolah|";
        }
        if ($faceConfidence < 0.85) { // Confidence threshold
            echo "error|Wajah Tidak Terdeteksi dengan Kepastian 90%|";
        } else {
            if ($cek > 0) {
                $data_pulang = [
                    'photo_out' => $fileName,
                    'jam_pulang' => $jam,
                    'titik_koordinat_pulang' => $lokasiSiswa,
                ];
                $update = DB::table('absensis')->where('date', $date)->where('nis', $nis)->update($data_pulang);
                if ($update) {
                    echo "success|Terimakasih, Hati-Hati Dijalan!|out";
                    Storage::put($file, $image_base64);
                } else {
                    echo "error|Absen Gagal|out";
                }
            } else {
                $data = [
                    'nis' => $nis,
                    'status' => $status,
                    'photo_in' => $fileName,
                    'date' => $date,
                    'jam_masuk' => $jam,
                    'titik_koordinat_masuk' => $lokasiSiswa,
                ];

                $simpan = DB::table('absensis')->insert($data);

                if ($simpan) {
                    echo "success|Terimakasih, Selamat Belajar!|in";
                    Storage::put($file, $image_base64);
                } else {
                    echo "error|Absen Gagal|in";
                }
            }
        }
    }

    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5200;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }

    public function sakit()
    {
        $user = Auth::user();
        $nis = $user->siswa->nis;
        $hariini = date("Y-m-d");
        $cek = DB::table('absensis')->where('date', $hariini)->where('nis', $nis)->count();
        $lok_sekolah = DB::table('koordinat_sekolahs')->where('id_koordinat_sekolah', 1)->first();
        $waktu = DB::table('waktu__absens')->where('id_waktu_absen', 1)->first();
        $siswa = Siswa::with('kelas')->where('id_user', $user->id)->first();
        if ($siswa) {
            $kelas = $siswa->kelas;
            $tingkat = $kelas->tingkat;
            $nama_jurusan = $kelas->jurusan->id_jurusan;
            $nomor_kelas = $kelas->nomor_kelas;
        } else {
            $tingkat = 'Tingkat tidak ditemukan';
            $nama_jurusan = 'Jurusan tidak ditemukan';
            $nomor_kelas = 'Nomor kelas tidak ditemukan';
        }
        return view('siswa.sakit', compact('lok_sekolah', 'waktu', 'cek', 'user', 'siswa', 'tingkat', 'nama_jurusan', 'nomor_kelas'));
    }

    public function sakitstore(Request $request)
    {
        $request->validate([
            'photo_in' => 'required|mimes:jpeg,png,jpg,pdf|max:10000',
            'keterangan' => 'required|string|max:255',
        ]);

        $status = $request->input('status', 'Sakit');

        if ($request->hasFile('photo_in')) {
            $user = Auth::user();
            $nis = $user->siswa->nis;
            $date = date("Y-m-d");
            $keterangan = $request->input('keterangan');
            $jam = date("H:i:s");

            $lokasiSiswa = $request->lokasi;
            $foto = $request->file('photo_in');

            $extension = $foto->getClientOriginalExtension();
            $folderPath = "public/uploads/absensi/";
            $fileName = $nis . "-" . $date . "-" . $status . "." . $extension;
            $file = $folderPath . $fileName;


            $data = [
                'nis' => $nis,
                'status' => $status,
                'photo_in' => $fileName,
                'keterangan' => $keterangan,
                'date' => $date,
                'jam_masuk' => $jam,
                'titik_koordinat_masuk' => $lokasiSiswa,
            ];

            $simpan = DB::table('absensis')->insert($data);
            if ($simpan) {
                Storage::put($file, file_get_contents($foto));
                return redirect()->route('siswa.dashboard')->with('success', 'Absensi berhasil disimpan!');
            } else {
                return redirect()->route('form.sakit')->with('error', 'Gagal');
            }
        }
    }

    public function izin()
    {
        $user = Auth::user();
        $nis = $user->siswa->nis;
        $hariini = date("Y-m-d");
        $cek = DB::table('absensis')->where('date', $hariini)->where('nis', $nis)->count();
        $lok_sekolah = DB::table('koordinat_sekolahs')->where('id_koordinat_sekolah', 1)->first();
        $waktu = DB::table('waktu__absens')->where('id_waktu_absen', 1)->first();
        $siswa = Siswa::with('kelas')->where('id_user', $user->id)->first();
        if ($siswa) {
            $kelas = $siswa->kelas;
            $tingkat = $kelas->tingkat;
            $nama_jurusan = $kelas->jurusan->id_jurusan;
            $nomor_kelas = $kelas->nomor_kelas;
        } else {
            $tingkat = 'Tingkat tidak ditemukan';
            $nama_jurusan = 'Jurusan tidak ditemukan';
            $nomor_kelas = 'Nomor kelas tidak ditemukan';
        }
        return view('siswa.izin', compact('lok_sekolah', 'waktu', 'cek', 'user', 'siswa', 'tingkat', 'nama_jurusan', 'nomor_kelas'));
    }

    public function izinstore(Request $request)
    {
        $request->validate([
            'photo_in' => 'required|mimes:jpeg,png,jpg,pdf|max:10000',
            'keterangan' => 'required|string|max:255',
        ]);

        $status = $request->input('status', 'Izin');

        if ($request->hasFile('photo_in')) {
            $user = Auth::user();
            $nis = $user->siswa->nis;
            $date = date("Y-m-d");
            $keterangan = $request->input('keterangan');
            $jam = date("H:i:s");

            $lokasiSiswa = $request->lokasi;
            $foto = $request->file('photo_in');

            $extension = $foto->getClientOriginalExtension();
            $folderPath = "public/uploads/absensi/";
            $fileName = $nis . "-" . $date . "-" . $status . "." . $extension;
            $file = $folderPath . $fileName;


            $data = [
                'nis' => $nis,
                'status' => $status,
                'photo_in' => $fileName,
                'keterangan' => $keterangan,
                'date' => $date,
                'jam_masuk' => $jam,
                'titik_koordinat_masuk' => $lokasiSiswa,
            ];

            $simpan = DB::table('absensis')->insert($data);
            if ($simpan) {
                Storage::put($file, file_get_contents($foto));
                return redirect()->route('siswa.dashboard')->with('success', 'Absensi berhasil disimpan!');
            } else {
                return redirect()->route('form.izin')->with('error', 'Gagal');
            }
        }
    }

    public function editprofile()
    {
        $user = Auth::user();
        $nis = $user->siswa->nis;
        $hariini = date("Y-m-d");
        $cek = DB::table('absensis')->where('date', $hariini)->where('nis', $nis)->count();
        $lok_sekolah = DB::table('koordinat_sekolahs')->where('id_koordinat_sekolah', 1)->first();
        $waktu = DB::table('waktu__absens')->where('id_waktu_absen', 1)->first();
        $siswa = Siswa::with('kelas')->where('id_user', $user->id)->first();
        if ($siswa) {
            $kelas = $siswa->kelas;
            $tingkat = $kelas->tingkat;
            $nama_jurusan = $kelas->jurusan->id_jurusan;
            $nomor_kelas = $kelas->nomor_kelas;
        } else {
            $tingkat = 'Tingkat tidak ditemukan';
            $nama_jurusan = 'Jurusan tidak ditemukan';
            $nomor_kelas = 'Nomor kelas tidak ditemukan';
        }
        return view('siswa.profile', compact('user', 'lok_sekolah', 'waktu', 'cek', 'siswa', 'tingkat', 'nama_jurusan', 'nomor_kelas'));
    }

    public function profilesubmit(Request $request)
    {
        $f = false;
        $p = false;

        //password
        if ($request->password != $request->kPassword) {
            return redirect()->back()->with('failed', 'Password Berbeda');
        }
        $count = strlen($request->password);
        if ($count > 0) {
            $p = User::where('id', $request->id)->update([
                'password' => password_hash($request->password, PASSWORD_DEFAULT)
            ]);
        }

        //foto
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');

            $folderPath = "public/user_avatar/";

            $extension = $foto->getClientOriginalExtension();
            $fileName = $request->nis . '.' . $extension;
            $file = $folderPath . $fileName;

            Storage::put($file, file_get_contents($foto));

            User::where('id', $request->id)->update([
                'foto' => $fileName
            ]);
        }

        $u = User::where('id', $request->id)->update([
            'email' => $request->email,
        ]);

        if ($u || $f || $p) {
            return redirect()->back()->with('success', "Data Berhasil di Update");
        } else {
            return redirect()->back()->with('failed', "Data Gagal di Update");
        }
    }

    public function rekap(Request $request)
    {
        $user = Auth::user();
        $nis = $user->siswa->nis;
        $lok_sekolah = DB::table('koordinat_sekolahs')->where('id_koordinat_sekolah', 1)->first();
        $waktu = DB::table('waktu__absens')->where('id_waktu_absen', 1)->first();

        // Default start_date dan end_date jika tidak ada input dari request
        $start_date = $request->input('start_date', date('Y-m-d'));
        $end_date = $request->input('end_date', date('Y-m-d'));

        // Ambil filter status dari request (array checkbox)
        $status_filter = $request->input('status_filter', []); // Default array kosong

        // Query untuk menghitung persentase kehadiran tanpa filter status
        $allAbsensiQuery = Absensi::where('nis', $nis)
            ->whereBetween('date', [$start_date, $end_date]);

        // Eksekusi query untuk mendapatkan semua absensi tanpa filter status (tanpa pagination)
        $allAbsensi = $allAbsensiQuery->get();

        // Hitung statistik absensi (persentase kehadiran, dsb.)
        $stats = $this->filterRekap($allAbsensi);

        // Query untuk menampilkan absensi di tabel dengan filter status
        $absensiQuery = Absensi::where('nis', $nis)
            ->whereBetween('date', [$start_date, $end_date]);

        // Jika ada status yang difilter, tambahkan kondisi whereIn
        if (!empty($status_filter)) {
            $absensiQuery->whereIn('status', $status_filter);
        }

        // Paginate hasil absensi yang sudah difilter (untuk tabel)
        $absensi = $absensiQuery->paginate(5)->appends($request->only(['start_date', 'end_date', 'status_filter']));

        // Ambil informasi siswa
        $siswa = Siswa::with('kelas')->where('id_user', $user->id)->first();
        if ($siswa) {
            $kelas = $siswa->kelas;
            $tingkat = $kelas->tingkat;
            $nama_jurusan = $kelas->jurusan->id_jurusan;
            $nomor_kelas = $kelas->nomor_kelas;
        } else {
            $tingkat = 'Tingkat tidak ditemukan';
            $nama_jurusan = 'Jurusan tidak ditemukan';
            $nomor_kelas = 'Nomor kelas tidak ditemukan';
        }

        return view('siswa.rekap', array_merge(
            compact('user', 'lok_sekolah', 'waktu', 'siswa', 'tingkat', 'nama_jurusan', 'nomor_kelas', 'absensi', 'start_date', 'end_date', 'status_filter'),
            $stats
        ));
    }



    private function filterRekap($absensi)
    {
        $jumlahHadir = $absensi->where('status', 'Hadir')->count();
        $jumlahIzin = $absensi->whereIn('status', ['Sakit', 'Izin'])->count();
        $jumlahTerlambat = $absensi->where('status', 'Terlambat')->count();
        $jumlahAlfa = $absensi->where('status', 'Alfa')->count();
        $jumlahTap = $absensi->where('status', 'TAP')->count();
        $totalKeterlambatan = $absensi->sum('menit_keterlambatan');

        $totalAbsensi = $absensi->count();
        $persentaseHadir = $totalAbsensi > 0 ? round(($jumlahHadir / $totalAbsensi) * 100) : 0;

        return compact(
            'jumlahHadir',
            'jumlahIzin',
            'jumlahTerlambat',
            'jumlahAlfa',
            'jumlahTap',
            'totalKeterlambatan',
            'persentaseHadir'
        );
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

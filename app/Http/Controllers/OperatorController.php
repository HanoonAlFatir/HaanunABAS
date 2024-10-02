<?php

namespace App\Http\Controllers;

use App\Imports\KelasImport;
use App\Imports\WaliImport;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Wali_Kelas;
use App\Models\Wali_Siswa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wali = Wali_Kelas::with('user')->get();
        $user = User::all();
        return view('operator.daftarwalikelas', compact('wali', 'user'));
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
        // $request->validate([
        //     'nuptk' => 'required|unique:wali__kelas',
        //     'id_user' => 'required',
        //     'nama' => 'required',
        //     'jenis_kelamin' => 'required',
        //     'nip' => 'required',
        // ]);

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'wali_kelas',
        ]);

        Wali_Kelas::create([
            'nuptk' => $request->nuptk,
            'id_user' => $user->id,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nip' => $request->nip,
        ]);

        // Wali_Kelas::create($request->all());
        return redirect()->route('walikelas')->with('success', 'Wali Kelas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        DB::table('wali__kelas')->where('id_user', $request->id)->update([
            'nuptk' => $request->nuptk,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nip' => $request->nip,
        ]);

        DB::table('users')->where('id', $request->id)->update([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('walikelas')->with('success', 'Data wali kelas berhasil diupdate.');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($nuptk)
    {
        $wali = Wali_Kelas::where('nuptk', $nuptk)->first();

        if (!$wali) {
            return redirect()->route('walikelas')->with('error', 'Data not found');
        }

        $user = User::find($wali->id_user);
        $wali->delete();

        if ($user) {
            $user->delete();
        }

        return redirect()->route('walikelas')->with('success', 'Data berhasil dihapus');
    }

    public function importWali(Request $request)
    {
        $request->validate([
            'import_file' => [
                'required',
                'file'
            ],
        ]);

        Excel::import(new WaliImport, $request->file('import_file'));

        return redirect()->back()->with('success', 'Data Berhasil Diimport!');
    }

    public function walisiswa()
    {
        $walisiswa =  Wali_Siswa::with('user')->get();

        return view('operator.daftarwalisiswa', compact('walisiswa'));
    }

    public function tambahwalisiswa(request $request)
    {
        if (strlen($request->password) > 0) {
            $u = User::create([
                'name' => $request->name,
                'password' => password_hash($request->password, PASSWORD_DEFAULT),
                'email' => $request->email,
                'role' => 'wali siswa'
            ]);
        } else {
            $u = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'wali siswa'
            ]);
        }


        $w = Wali_Siswa::insert([
            'nik' => $request->nik,
            'id_user' => $u->id,
            'jenis_kelamin' => $request->jenis_kelamin
        ]);

        if ($u && $w) {
            return redirect()->back()->with('success', 'Data Berhasil Ditambahkan');
        } else {
            return redirect()->back()->with('warning', 'Gagal Menambahkan Data');
        }
    }

    public function waliDestroy(string $nik)
    {
        // Cari data wali siswa berdasarkan NIK
        $walisiswa = Wali_Siswa::where('nik', $nik)->first();

        if (!$walisiswa) {
            return redirect()->route('daftarwalisiswa')->with('error', 'Wali Siswa tidak ditemukan');
        }

        // Hapus data user yang terkait
        $user = User::find($walisiswa->user_id); // Sesuaikan foreign key 'user_id' jika berbeda
        if ($user) {
            $user->delete(); // Hapus data dari tabel users
        }

        // Hapus data dari tabel wali_siswa
        $walisiswa->delete();

        return redirect()->route('daftarwalisiswa')->with('success', 'Data Wali Siswa dan User berhasil dihapus');
    }


    public function jurusan()
    {
        $jurusan = Jurusan::all();
        return view('operator.daftarjurusan', compact('jurusan'));
    }

    public function jurusanStore(Request $request)
    {
        $request->validate([
            'id_jurusan' => 'required|unique:jurusans,id_jurusan',
            'nama_jurusan' => 'required',
        ]);

        $jurusan = new Jurusan();
        $jurusan->id_jurusan = $request->input('id_jurusan');
        $jurusan->nama_jurusan = $request->input('nama_jurusan');
        $jurusan->save();

        return redirect()->route('jurusan')->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function jurusanUpdate(Request $request, string $id)
    {
        DB::table('jurusans')->where('id_jurusan', $request->id_jurusan)->update([
            'nama_jurusan' => $request->nama_jurusan
        ]);

        return redirect()->route('jurusan')->with('success', 'Jurusan berhasil diupdate');
    }

    public function jurusanDestroy(string $id)
    {
        $jurusan = Jurusan::find($id);

        if (!$jurusan) {
            return redirect()->route('jurusan')->with('error', 'Jurusan tidak ditemukan');
        }

        // Hapus jurusan
        $jurusan->delete();

        return redirect()->route('jurusan')->with('success', 'Jurusan berhasil dihapus');
    }

    public function kelas()
    {
        $kelas = Kelas::withCount('siswa')->with('jurusan', 'walikelas')->get();
        $jurusan = Jurusan::all();
        $walikelas = Wali_Kelas::with('user')->get();

        // dd($walikelas);
        return view('operator.daftarkelas', compact('kelas', 'walikelas', 'jurusan'));
    }

    public function importKelas(Request $request)
    {
        $request->validate([
            'import_file' => [
                'required',
                'file'
            ],
        ]);

        Excel::import(new KelasImport, $request->file('import_file'));

        return redirect()->back()->with('success', 'Data Berhasil Diimport!');
    }

    public function kelasStore(Request $request)
    {
        $request->validate([
            'id_jurusan' => 'required|exists:jurusans,id_jurusan',
            'nuptk' => 'required|exists:wali__kelas,nuptk',
            'nomor_kelas' => 'required',
            'tingkat' => 'required',
        ]);

        $kelas = new Kelas();
        $kelas->id_jurusan = $request->input('id_jurusan');
        $kelas->nuptk = $request->input('nuptk');
        $kelas->nomor_kelas = $request->input('nomor_kelas');
        $kelas->tingkat = $request->input('tingkat');
        $kelas->jumlah_siswa = Siswa::where('id_kelas', $kelas->id_kelas)->count();
        $kelas->save();

        return redirect()->route('kelas')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function kelasUpdate(Request $request, string $id)
    {
        DB::table('kelas')->where('id_kelas', $request->id_kelas)->update([
            'id_jurusan' => $request->id_jurusan,
            'nuptk' => $request->nuptk,
            'nomor_kelas' => $request->nomor_kelas,
            'tingkat' => $request->tingkat,
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->id_jurusan = $request->input('id_jurusan');
        $kelas->nuptk = $request->input('nuptk');
        $kelas->nomor_kelas = $request->input('nomor_kelas');
        $kelas->tingkat = $request->input('tingkat');
        $kelas->jumlah_siswa = Siswa::where('id_kelas', $kelas->id_kelas)->count();
        $kelas->save();

        return redirect()->route('kelas')->with('success', 'Kelas berhasil diupdate');
    }

    public function kelasDestroy(string $id)
    {
        Kelas::destroy($id);
        return redirect()->route('kelas')->with('success', 'Kelas berhasil dihapus');
    }

    public function kesiswaan()
    {
        $kesiswaan = User::where('role', 'kesiswaan')->get();
        return view('operator.daftarkesiswaan', compact('kesiswaan'));
    }

    public function kesiswaanStore(Request $request)
    {
        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
            'role' => 'kesiswaan',
        ]);

        return redirect()->back()->with('success', 'Keiswaan berhasil ditambahkan!');
    }

    public function kesiswaanUpdate(Request $request, string $id)
    {
        DB::table('users')->where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
        ]);

        return redirect()->route('daftarkesiswaan')->with('Success', 'Kesiswaan berhasil di update');
    }

    public function kesiswaanDestroy($id)
    {
        $kesiswaan = User::where('id', $id)->first();

        if ($kesiswaan) {
            $kesiswaan->delete();

            // Redirect ke halaman sebelumnya dengan pesan sukses
            return redirect()->route('daftarkesiswaan')->with('success', 'Data kesiswaan berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Data kesiswaan tidak ditemukan.');
    }

    public function siswa($id_kelas)
    {
        $siswa = Siswa::where('id_kelas', $id_kelas)->get();
        $kelas = Kelas::findOrFail($id_kelas);
        $walisiswa = Wali_Siswa::all();
        $user = User::all();

        // Tampilkan view dengan data siswa
        return view('operator.daftarsiswa', compact('siswa', 'id_kelas', 'kelas', 'user', 'walisiswa'));
    }

    public function siswaStore(Request $request)
    {
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
        ]);

        Siswa::create([
            'nis' => $request->nis,
            'id_user' => $user->id,
            'id_kelas' => $request->id_kelas,
            'nik' => $request->nik,
            'nisn' => $request->nisn,
        ]);

        return redirect()->route('daftarsiswa', ['id_kelas' => $request->id_kelas])->with('success', 'Siswa berhasil ditambahkan');
    }

    public function siswaUpdate(Request $request, string $id)
    {
        DB::table('siswas')->where('nis', $request->nis)->update([
            'nis' => $request->nis,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nik' => $request->nik,
            'nisn' => $request->nisn,
        ]);

        DB::table('users')->where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
        ]);

        $id_kelas = $request->input('id_kelas');

        return redirect()->route('daftarsiswa', ['id_kelas' => $id_kelas])->with('success', 'Siswa berhasil diupdate');
    }

    public function siswaDestroy($nis)
    {
        $siswa = Siswa::where('nis', $nis)->first();

        if (!$siswa) {
            return redirect()->back()->with('error', 'Siswa tidak ditemukan.');
        }

        $user = User::find($siswa->id_user);
        $id_kelas = $siswa->id_kelas;
        $siswa->delete();

        if ($user) {
            $user->delete();
        }

        return redirect()->route('daftarsiswa', ['id_kelas' => $id_kelas])->with('success', 'Siswa berhasil dihapus.');
    }
}

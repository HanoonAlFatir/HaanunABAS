<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use App\Models\Wali_Siswa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id_kelas)
    {
        $siswa = Siswa::where('id_kelas', $id_kelas)->get();
        $kelas = Kelas::findOrFail($id_kelas);
        $walisiswa = Wali_Siswa::all();
        $user = User::all();

        // Tampilkan view dengan data siswa
        return view('operator.daftarsiswa', compact('siswa', 'id_kelas', 'kelas', 'user', 'walisiswa'));
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($nis)
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

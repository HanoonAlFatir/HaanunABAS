<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id_kelas)
    {
        $siswa = Siswa::where('id_kelas', $id_kelas)->get();
        $kelas = Kelas::findOrFail($id_kelas);
        // return $kelas;
        $users = User::all();

        // Tampilkan view dengan data siswa
        return view('operator.daftarsiswa', compact('siswa', 'id_kelas', 'kelas', 'users'));
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
        DB::table('siswas')->where('nis', $request->nis)->update([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nik' => $request->nik,
            'nisn' => $request->nisn,
        ]);

        $id_kelas = $request->input('id_kelas');

        return redirect()->route('daftarsiswa', ['id_kelas' => $id_kelas])->with('success', 'Siswa berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

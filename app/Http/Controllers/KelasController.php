<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Wali_Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::with('jurusan', 'walikelas')->get();
        $jurusan = Jurusan::all();
        $walikelas = Wali_Kelas::all();
        return view('operator.daftarkelas', compact('kelas', 'walikelas', 'jurusan'));
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
        $request->validate([
            'id_jurusan' => 'required|exists:jurusans,id_jurusan',
            'nuptk' => 'required|exists:wali__kelas,nuptk',
            'nomor_kelas' => 'required',
            'tingkat' => 'required',
            'jumlah_siswa' => 'required|integer',
        ]);

        $kelas = new Kelas();
        $kelas->id_jurusan = $request->input('id_jurusan');
        $kelas->nuptk = $request->input('nuptk');
        $kelas->nomor_kelas = $request->input('nomor_kelas');
        $kelas->tingkat = $request->input('tingkat');
        $kelas->jumlah_siswa = $request->input('jumlah_siswa');
        $kelas->save();

        return redirect()->route('kelas')->with('success', 'Kelas berhasil ditambahkan.');
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
        DB::table('kelas')->where('id_kelas', $request->id_kelas)->update([
            'id_jurusan' => $request->id_jurusan,
            'nuptk' => $request->nuptk,
            'nomor_kelas' => $request->nomor_kelas,
            'tingkat' => $request->tingkat,
            'jumlah_siswa' => $request->jumlah_siswa,
        ]);

        return redirect()->route('kelas')->with('success', 'Kelas berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Kelas::destroy($id);
        return redirect()->route('kelas')->with('success', 'Kelas berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurusan = Jurusan::all();
        return view('operator.daftarjurusan', compact('jurusan'));
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
            'id_jurusan' => 'required|unique:jurusans,id_jurusan',
            'nama_jurusan' => 'required',
        ]);

        $jurusan = new Jurusan();
        $jurusan->id_jurusan = $request->input('id_jurusan');
        $jurusan->nama_jurusan = $request->input('nama_jurusan');
        $jurusan->save();

        return redirect()->route('jurusan')->with('success', 'Jurusan berhasil ditambahkan.');
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
        DB::table('jurusans')->where('id_jurusan', $request->id_jurusan)->update([
            'nama_jurusan' => $request->nama_jurusan
        ]);

        return redirect()->route('jurusan')->with('success', 'Jurusan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jurusan = Jurusan::find($id);

        if (!$jurusan) {
            return redirect()->route('jurusan')->with('error', 'Jurusan tidak ditemukan');
        }

        // Hapus jurusan
        $jurusan->delete();

        return redirect()->route('jurusan')->with('success', 'Jurusan berhasil dihapus');
    }
}

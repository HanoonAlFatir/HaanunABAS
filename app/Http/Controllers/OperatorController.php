<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wali_Kelas;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wali = Wali_Kelas::with('user')->get();
        return view('operator.daftarwalikelas', compact('wali'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function lokasi()
    {
        return view('operator.lokasi');
    }
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
            'nuptk' => 'required|unique:wali__kelas',
            'id_user' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'nip' => 'required',
            'nik' => 'required',
        ]);

        Wali_Kelas::create($request->all());
        return redirect()->route('walikelas')->with('success', 'Wali Kelas berhasil ditambahkan.');
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
    public function edit($nuptk)
    {
        $wali = Wali_Kelas::where('nuptk', $nuptk)->first();
        if (!$wali) {
            return redirect()->route('operator.index')->with('error', 'Data not found');
        }
        return view('operator.editwalikelas', compact('wali'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $nuptk)
    {
        $wali = Wali_Kelas::where('nuptk', $nuptk)->first();
        $wali->nama = $request->input('nama');
        $wali->jenis_kelamin = $request->input('jenis_kelamin'); // Update for gender enum
        $wali->nip = $request->input('nip');
        $wali->nik = $request->input('nik');
        $wali->save();

        return redirect()->route('walikelas')->with('success', 'Data updated successfully');
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

        $wali->delete();

        return redirect()->route('walikelas')->with('success', 'Data deleted successfully');
    }
}

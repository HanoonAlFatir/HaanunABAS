<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wali_Kelas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'nik' => $request->nik,
        ]);

        DB::table('users')->where('id', $request->id)->update([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password) ,
        ]);

        return redirect()->route('walikelas')->with('success', 'Data wali kelas berhasil diperbarui.');
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

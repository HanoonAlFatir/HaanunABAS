<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaftarKesiswaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kesiswaan = User::where('role', 'kesiswaan')->get();
        return view('operator.daftarkesiswaan', compact('kesiswaan'));
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
        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
            'role' => 'kesiswaan',
        ]);

    return redirect()->back()->with('success', 'Keiswaan berhasil ditambahkan!');
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
        DB::table('users')->where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
        ]);

        return redirect()->route('daftarkesiswaan')->with('Success', 'Kesiswaan berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kesiswaan = User::where('id', $id)->first();

        if ($kesiswaan) {
            $kesiswaan->delete();

            // Redirect ke halaman sebelumnya dengan pesan sukses
            return redirect()->route('daftarkesiswaan')->with('success', 'Data kesiswaan berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Data kesiswaan tidak ditemukan.');

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\PemilikHewan;
use App\Models\Pegawai;
use App\Models\Hewan;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendaftarans = Pendaftaran::with(['pemilikHewan', 'pegawai'])
            ->orderBy('tanggal_daftar', 'desc')
            ->paginate(10);
        return view('pendaftaran.index', compact('pendaftarans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pemilikHewans = PemilikHewan::all();
        $pegawais = Pegawai::all();
        return view('pendaftaran.create', compact('pemilikHewans', 'pegawais'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pendaftaran' => 'required|string|max:8|unique:pendaftaran,id_pendaftaran',
            'id_pemilik_hewan' => 'required|exists:pemilik_hewan,id_pemilik_hewan',
            'id_pegawai' => 'required|exists:pegawai,id_pegawai',
            'tanggal_daftar' => 'required|date',
            'status' => 'required|string|max:10',
            'keluhan' => 'nullable|string'
        ]);

        Pendaftaran::create($validated);

        return redirect()->route('pendaftaran.index')
            ->with('success', 'Pendaftaran berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pendaftaran = Pendaftaran::with(['pemilikHewan', 'pegawai', 'pemeriksaan'])
            ->findOrFail($id);
        return view('pendaftaran.show', compact('pendaftaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pemilikHewans = PemilikHewan::all();
        $pegawais = Pegawai::all();
        return view('pendaftaran.edit', compact('pendaftaran', 'pemilikHewans', 'pegawais'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        $validated = $request->validate([
            'id_pemilik_hewan' => 'required|exists:pemilik_hewan,id_pemilik_hewan',
            'id_pegawai' => 'required|exists:pegawai,id_pegawai',
            'tanggal_daftar' => 'required|date',
            'status' => 'required|string|max:10',
            'keluhan' => 'nullable|string'
        ]);

        $pendaftaran->update($validated);

        return redirect()->route('pendaftaran.index')
            ->with('success', 'Pendaftaran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->delete();

        return redirect()->route('pendaftaran.index')
            ->with('success', 'Pendaftaran berhasil dihapus');
    }

    /**
     * Get hewan by pemilik (AJAX endpoint)
     */
    public function getHewanByPemilik($id_pemilik_hewan)
    {
        $hewans = Hewan::where('id_pemilik_hewan', $id_pemilik_hewan)->get();
        return response()->json($hewans);
    }
}

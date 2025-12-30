<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use App\Models\Pendaftaran;
use App\Models\DokterHewan;
use Illuminate\Http\Request;

class PemeriksaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemeriksaans = Pemeriksaan::with(['pendaftaran.pemilikHewan', 'dokterHewan'])
            ->orderBy('tanggal_periksa', 'desc')
            ->paginate(10);
        return view('pemeriksaan.index', compact('pemeriksaans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pendaftarans = Pendaftaran::whereDoesntHave('pemeriksaan')
            ->with('pemilikHewan')
            ->where('status', 'menunggu')
            ->get();
        $dokterHewans = DokterHewan::all();
        return view('pemeriksaan.create', compact('pendaftarans', 'dokterHewans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_pemeriksaan' => 'required|string|max:8|unique:pemeriksaan,id_pemeriksaan',
            'id_pendaftaran' => 'required|exists:pendaftaran,id_pendaftaran',
            'id_dokter_hewan' => 'required|exists:dokter_hewan,id_dokter_hewan',
            'tanggal_periksa' => 'required|date',
            'diagnosa' => 'nullable|string',
            'tindakan' => 'nullable|string'
        ]);

        Pemeriksaan::create($validated);

        // Update status pendaftaran menjadi selesai
        $pendaftaran = Pendaftaran::find($request->id_pendaftaran);
        $pendaftaran->update(['status' => 'selesai']);

        return redirect()->route('pemeriksaan.index')
            ->with('success', 'Data pemeriksaan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pemeriksaan = Pemeriksaan::with(['pendaftaran.pemilikHewan', 'dokterHewan', 'pembayaran'])
            ->findOrFail($id);
        return view('pemeriksaan.show', compact('pemeriksaan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pemeriksaan = Pemeriksaan::findOrFail($id);
        $pendaftarans = Pendaftaran::with('pemilikHewan')->get();
        $dokterHewans = DokterHewan::all();
        return view('pemeriksaan.edit', compact('pemeriksaan', 'pendaftarans', 'dokterHewans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pemeriksaan = Pemeriksaan::findOrFail($id);

        $validated = $request->validate([
            'id_pendaftaran' => 'required|exists:pendaftaran,id_pendaftaran',
            'id_dokter_hewan' => 'required|exists:dokter_hewan,id_dokter_hewan',
            'tanggal_periksa' => 'required|date',
            'diagnosa' => 'nullable|string',
            'tindakan' => 'nullable|string'
        ]);

        $pemeriksaan->update($validated);

        return redirect()->route('pemeriksaan.index')
            ->with('success', 'Data pemeriksaan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pemeriksaan = Pemeriksaan::findOrFail($id);
        $pemeriksaan->delete();

        return redirect()->route('pemeriksaan.index')
            ->with('success', 'Data pemeriksaan berhasil dihapus');
    }
}

@extends('layouts.app')

@section('title', 'Riwayat Pemeriksaan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-clock-history"></i> Riwayat Pemeriksaan</h2>
    <a href="{{ route('pemeriksaan.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Tunggu
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($pemeriksaans->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID Pemeriksaan</th>
                            <th>Tanggal Periksa</th>
                            <th>Pemilik Hewan</th>
                            <th>Nama Hewan</th>
                            <th>Diagnosa</th>
                            <th>Dokter</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemeriksaans as $pemeriksaan)
                            <tr>
                                <td>{{ $pemeriksaan->id_pemeriksaan }}</td>
                                <td>{{ $pemeriksaan->tanggal_periksa->format('d/m/Y') }}</td>
                                <td>{{ $pemeriksaan->pendaftaran->pemilikHewan->nama_pemilik ?? '-' }}</td>
                                <td>{{ $pemeriksaan->pendaftaran->hewan->nama_hewan ?? '-' }}</td>
                                <td>{{ Str::limit($pemeriksaan->diagnosa ?? '-', 50) }}</td>
                                <td>{{ $pemeriksaan->dokterHewan->nama_dokter ?? '-' }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('pemeriksaan.show', $pemeriksaan->id_pemeriksaan) }}" 
                                           class="btn btn-info" 
                                           title="Lihat Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        @if(auth()->user()->role === 'dokter' && $pemeriksaan->dokterHewan->nama_dokter === auth()->user()->name || auth()->user()->role === 'admin')
                                            <a href="{{ route('pemeriksaan.edit', $pemeriksaan->id_pemeriksaan) }}" 
                                               class="btn btn-warning" 
                                               title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('pemeriksaan.destroy', $pemeriksaan->id_pemeriksaan) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus data pemeriksaan ini? Status pendaftaran akan dikembalikan ke menunggu.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-inbox fs-1 text-muted"></i>
                <p class="text-muted mt-3">Belum ada riwayat pemeriksaan</p>
            </div>
        @endif
    </div>
</div>

<div class="mt-3">
    {{ $pemeriksaans->links() }}
</div>
@endsection

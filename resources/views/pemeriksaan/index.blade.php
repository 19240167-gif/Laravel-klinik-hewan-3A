@extends('layouts.app')

@section('title', 'Data Pemeriksaan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-clipboard2-pulse"></i> Data Pemeriksaan</h2>
    @if(auth()->user()->role != 'pegawai')
        <a href="{{ route('pemeriksaan.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Pemeriksaan
        </a>
    @endif
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Pasien (Pemilik)</th>
                        <th>Dokter</th>
                        <th>Diagnosa</th>
                        <th>Tindakan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pemeriksaans as $pemeriksaan)
                        <tr>
                            <td>{{ $pemeriksaan->id_pemeriksaan }}</td>
                            <td>{{ $pemeriksaan->tanggal_periksa->format('d/m/Y') }}</td>
                            <td>{{ $pemeriksaan->pendaftaran->pemilikHewan->nama_pemilik ?? '-' }}</td>
                            <td>{{ $pemeriksaan->dokterHewan->nama_dokter ?? '-' }}</td>
                            <td>{{ Str::limit($pemeriksaan->diagnosa ?? '-', 30) }}</td>
                            <td>{{ Str::limit($pemeriksaan->tindakan ?? '-', 30) }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('pemeriksaan.show', $pemeriksaan->id_pemeriksaan) }}" 
                                       class="btn btn-info" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    @if(in_array(auth()->user()->role, ['admin', 'dokter']))
                                        <a href="{{ route('pemeriksaan.edit', $pemeriksaan->id_pemeriksaan) }}" 
                                           class="btn btn-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('pemeriksaan.destroy', $pemeriksaan->id_pemeriksaan) }}" 
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="bi bi-inbox fs-1 text-muted"></i>
                                <p class="text-muted">Belum ada data pemeriksaan</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $pemeriksaans->links() }}
</div>
@endsection

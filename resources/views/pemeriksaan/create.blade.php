@extends('layouts.app')

@section('title', 'Tambah Pemeriksaan')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-plus-circle"></i> Tambah Pemeriksaan</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('pemeriksaan.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="id_pemeriksaan" class="form-label">ID Pemeriksaan <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('id_pemeriksaan') is-invalid @enderror" 
                               id="id_pemeriksaan" 
                               name="id_pemeriksaan" 
                               value="{{ old('id_pemeriksaan') }}"
                               maxlength="8"
                               required>
                        <small class="text-muted">Maksimal 8 karakter</small>
                        @error('id_pemeriksaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="id_pendaftaran" class="form-label">Pendaftaran <span class="text-danger">*</span></label>
                        <select class="form-select select2-pendaftaran @error('id_pendaftaran') is-invalid @enderror" 
                                id="id_pendaftaran" 
                                name="id_pendaftaran" 
                                required>
                            <option value="">-- Pilih Pendaftaran (Menunggu) --</option>
                            @foreach($pendaftarans as $pendaftaran)
                                <option value="{{ $pendaftaran->id_pendaftaran }}" 
                                        {{ old('id_pendaftaran') == $pendaftaran->id_pendaftaran ? 'selected' : '' }}>
                                    {{ $pendaftaran->id_pendaftaran }} - {{ $pendaftaran->pemilikHewan->nama_pemilik ?? '-' }} 
                                    ({{ $pendaftaran->tanggal_daftar->format('d/m/Y') }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_pendaftaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">
                            <i class="bi bi-info-circle"></i> Ketik untuk mencari pendaftaran
                        </small>
                    </div>

                    <div class="mb-3">
                        <label for="id_dokter_hewan" class="form-label">Dokter Hewan <span class="text-danger">*</span></label>
                        <select class="form-select select2-dokter @error('id_dokter_hewan') is-invalid @enderror" 
                                id="id_dokter_hewan" 
                                name="id_dokter_hewan" 
                                required>
                            <option value="">-- Pilih Dokter Hewan --</option>
                            @foreach($dokterHewans as $dokter)
                                <option value="{{ $dokter->id_dokter_hewan }}" 
                                        {{ old('id_dokter_hewan') == $dokter->id_dokter_hewan ? 'selected' : '' }}>
                                    {{ $dokter->nama_dokter }} (SIP: {{ $dokter->no_sip }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_dokter_hewan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">
                            <i class="bi bi-info-circle"></i> Ketik untuk mencari dokter berdasarkan nama atau SIP
                        </small>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_periksa" class="form-label">Tanggal Periksa <span class="text-danger">*</span></label>
                        <input type="date" 
                               class="form-control @error('tanggal_periksa') is-invalid @enderror" 
                               id="tanggal_periksa" 
                               name="tanggal_periksa" 
                               value="{{ old('tanggal_periksa', date('Y-m-d')) }}"
                               required>
                        @error('tanggal_periksa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="diagnosa" class="form-label">Diagnosa</label>
                        <textarea class="form-control @error('diagnosa') is-invalid @enderror" 
                                  id="diagnosa" 
                                  name="diagnosa" 
                                  rows="3">{{ old('diagnosa') }}</textarea>
                        @error('diagnosa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tindakan" class="form-label">Tindakan</label>
                        <textarea class="form-control @error('tindakan') is-invalid @enderror" 
                                  id="tindakan" 
                                  name="tindakan" 
                                  rows="3">{{ old('tindakan') }}</textarea>
                        @error('tindakan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('pemeriksaan.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize Select2 untuk pendaftaran
    $('.select2-pendaftaran').select2({
        theme: 'bootstrap-5',
        placeholder: '-- Pilih Pendaftaran --',
        allowClear: true,
        width: '100%'
    });

    // Initialize Select2 untuk dokter hewan
    $('.select2-dokter').select2({
        theme: 'bootstrap-5',
        placeholder: '-- Pilih Dokter Hewan --',
        allowClear: true,
        width: '100%'
    });
});
</script>
@endpush

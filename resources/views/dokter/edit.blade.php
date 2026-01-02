@extends('layouts.app')

@section('title', 'Edit Dokter Hewan')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-warning">
                <h5 class="mb-0"><i class="bi bi-pencil"></i> Edit Data Dokter Hewan</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('dokter-hewan.update', $dokter->id_dokter_hewan) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="id_dokter_hewan" class="form-label">ID Dokter Hewan</label>
                        <input type="text" 
                               class="form-control" 
                               id="id_dokter_hewan" 
                               value="{{ $dokter->id_dokter_hewan }}"
                               disabled>
                        <small class="text-muted">ID tidak dapat diubah</small>
                    </div>

                    <div class="mb-3">
                        <label for="nama_dokter" class="form-label">Nama Dokter <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('nama_dokter') is-invalid @enderror" 
                               id="nama_dokter" 
                               name="nama_dokter" 
                               value="{{ old('nama_dokter', $dokter->nama_dokter) }}"
                               maxlength="25"
                               required>
                        @error('nama_dokter')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="no_sip" class="form-label">No. SIP (Surat Izin Praktik)</label>
                        <input type="text" 
                               class="form-control @error('no_sip') is-invalid @enderror" 
                               id="no_sip" 
                               name="no_sip" 
                               value="{{ old('no_sip', $dokter->no_sip) }}"
                               maxlength="20"
                               placeholder="Contoh: SIP-DRH-2024-001">
                        @error('no_sip')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="biaya_periksa" class="form-label">Biaya Pemeriksaan <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" 
                                   class="form-control @error('biaya_periksa') is-invalid @enderror" 
                                   id="biaya_periksa" 
                                   name="biaya_periksa" 
                                   value="{{ old('biaya_periksa', $dokter->biaya_periksa) }}"
                                   min="0"
                                   step="1000"
                                   required>
                            @error('biaya_periksa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <small class="text-muted">Tarif konsultasi/pemeriksaan dokter</small>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('dokter-hewan.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-save"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

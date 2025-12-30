@extends('layouts.app')

@section('title', 'Edit Pendaftaran')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-warning">
                <h5 class="mb-0"><i class="bi bi-pencil"></i> Edit Pendaftaran</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('pendaftaran.update', $pendaftaran->id_pendaftaran) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="id_pendaftaran" class="form-label">ID Pendaftaran</label>
                        <input type="text" 
                               class="form-control" 
                               id="id_pendaftaran" 
                               value="{{ $pendaftaran->id_pendaftaran }}"
                               disabled>
                        <small class="text-muted">ID tidak dapat diubah</small>
                    </div>

                    <div class="mb-3">
                        <label for="id_pemilik_hewan" class="form-label">Pemilik Hewan <span class="text-danger">*</span></label>
                        <select class="form-select @error('id_pemilik_hewan') is-invalid @enderror" 
                                id="id_pemilik_hewan" 
                                name="id_pemilik_hewan" 
                                required>
                            <option value="">-- Pilih Pemilik Hewan --</option>
                            @foreach($pemilikHewans as $pemilik)
                                <option value="{{ $pemilik->id_pemilik_hewan }}" 
                                        {{ old('id_pemilik_hewan', $pendaftaran->id_pemilik_hewan) == $pemilik->id_pemilik_hewan ? 'selected' : '' }}>
                                    {{ $pemilik->id_pemilik_hewan }} - {{ $pemilik->nama_pemilik }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_pemilik_hewan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="id_pegawai" class="form-label">Pegawai <span class="text-danger">*</span></label>
                        <select class="form-select @error('id_pegawai') is-invalid @enderror" 
                                id="id_pegawai" 
                                name="id_pegawai" 
                                required>
                            <option value="">-- Pilih Pegawai --</option>
                            @foreach($pegawais as $pegawai)
                                <option value="{{ $pegawai->id_pegawai }}" 
                                        {{ old('id_pegawai', $pendaftaran->id_pegawai) == $pegawai->id_pegawai ? 'selected' : '' }}>
                                    {{ $pegawai->id_pegawai }} - {{ $pegawai->nama_pegawai }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_pegawai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_daftar" class="form-label">Tanggal Daftar <span class="text-danger">*</span></label>
                        <input type="date" 
                               class="form-control @error('tanggal_daftar') is-invalid @enderror" 
                               id="tanggal_daftar" 
                               name="tanggal_daftar" 
                               value="{{ old('tanggal_daftar', $pendaftaran->tanggal_daftar->format('Y-m-d')) }}"
                               required>
                        @error('tanggal_daftar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" 
                                id="status" 
                                name="status" 
                                required>
                            <option value="">-- Pilih Status --</option>
                            <option value="menunggu" {{ old('status', $pendaftaran->status) == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="selesai" {{ old('status', $pendaftaran->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="keluhan" class="form-label">Keluhan</label>
                        <textarea class="form-control @error('keluhan') is-invalid @enderror" 
                                  id="keluhan" 
                                  name="keluhan" 
                                  rows="3">{{ old('keluhan', $pendaftaran->keluhan) }}</textarea>
                        @error('keluhan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('pendaftaran.index') }}" class="btn btn-secondary">
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

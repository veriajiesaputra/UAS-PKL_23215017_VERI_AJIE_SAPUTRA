@props([
    'gejala' => null,
])

<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label">Kode Gejala <span class="text-danger">*</span></label>
        <input type="text" name="kode_gejala" id="kodeGejalaInput"
            class="form-control @error('kode_gejala') is-invalid @enderror"
            value="{{ old('kode_gejala', $gejala?->kode_gejala) }}"
            placeholder="contoh: G01" required>
        <div class="form-text">Format: G01, G02, dst.</div>
        @error('kode_gejala') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-8">
        <label class="form-label">Nama Gejala <span class="text-danger">*</span></label>
        <input type="text" name="nama_gejala"
            class="form-control @error('nama_gejala') is-invalid @enderror"
            value="{{ old('nama_gejala', $gejala?->nama_gejala) }}"
            placeholder="contoh: Daun menguning di tepi" required>
        @error('nama_gejala') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>

@props([
    'penyakit' => null,
])

<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label">Kode Penyakit <span class="text-danger">*</span></label>
        <input type="text" name="kode_penyakit"
            class="form-control @error('kode_penyakit') is-invalid @enderror"
            value="{{ old('kode_penyakit', $penyakit?->kode_penyakit) }}"
            placeholder="contoh: P01" required>
        @error('kode_penyakit') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-8">
        <label class="form-label">Nama Penyakit <span class="text-danger">*</span></label>
        <input type="text" name="nama_penyakit"
            class="form-control @error('nama_penyakit') is-invalid @enderror"
            value="{{ old('nama_penyakit', $penyakit?->nama_penyakit) }}"
            placeholder="contoh: Blas Daun" required>
        @error('nama_penyakit') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-12">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" rows="4"
            class="form-control @error('deskripsi') is-invalid @enderror"
            placeholder="Penjelasan singkat penyakit...">{{ old('deskripsi', $penyakit?->deskripsi) }}</textarea>
        @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-12">
        <label class="form-label">Solusi / Penanganan</label>
        <textarea name="solusi" rows="4"
            class="form-control @error('solusi') is-invalid @enderror"
            placeholder="Langkah penanganan dan pengendalian...">{{ old('solusi', $penyakit?->solusi) }}</textarea>
        @error('solusi') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-12">
        <label class="form-label">Foto Penyakit</label>
        @if ($penyakit?->gambar)
            <div class="mb-2">
                <img src="{{ $penyakit->gambar_url }}" alt="{{ $penyakit->nama_penyakit }}" class="rounded border" style="max-height:120px">
            </div>
        @endif
        <input type="file" name="gambar" accept="image/*"
            class="form-control @error('gambar') is-invalid @enderror">
        @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
        <small class="text-muted">Format JPG/PNG, maks. 2 MB. Digunakan pada halaman deteksi.</small>
    </div>
</div>

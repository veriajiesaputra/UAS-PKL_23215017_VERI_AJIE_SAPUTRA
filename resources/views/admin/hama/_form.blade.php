@props([
    'hama' => null,
])

<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label">Kode Hama <span class="text-danger">*</span></label>
        <input type="text" name="kode_hama"
            class="form-control @error('kode_hama') is-invalid @enderror"
            value="{{ old('kode_hama', $hama?->kode_hama) }}"
            placeholder="contoh: H01" required>
        @error('kode_hama') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-8">
        <label class="form-label">Nama Hama <span class="text-danger">*</span></label>
        <input type="text" name="nama_hama"
            class="form-control @error('nama_hama') is-invalid @enderror"
            value="{{ old('nama_hama', $hama?->nama_hama) }}"
            placeholder="contoh: Wereng Cokelat" required>
        @error('nama_hama') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-12">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" rows="4"
            class="form-control @error('deskripsi') is-invalid @enderror"
            placeholder="Penjelasan singkat hama...">{{ old('deskripsi', $hama?->deskripsi) }}</textarea>
        @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-12">
        <label class="form-label">Solusi / Penanganan</label>
        <textarea name="solusi" rows="4"
            class="form-control @error('solusi') is-invalid @enderror"
            placeholder="Langkah pengendalian hama...">{{ old('solusi', $hama?->solusi) }}</textarea>
        @error('solusi') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-12">
        <label class="form-label">Foto Hama</label>
        @if ($hama?->gambar)
            <div class="mb-2">
                <img src="{{ $hama->gambar_url }}" alt="{{ $hama->nama_hama }}" class="rounded border" style="max-height:120px">
            </div>
        @endif
        <input type="file" name="gambar" accept="image/*"
            class="form-control @error('gambar') is-invalid @enderror">
        @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
        <small class="text-muted">Format JPG/PNG, maks. 2 MB. Digunakan pada halaman deteksi.</small>
    </div>
</div>

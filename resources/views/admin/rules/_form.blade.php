@props([
    'rule' => null,
    'gejalaList',
    'penyakitList',
    'hamaList',
    'selectedGejala' => [],
])

@php
    $jenisValue = old('jenis', $rule?->jenis ?? 'penyakit');
    $targetValue = old('target_id', $rule?->target_id);
    $oldGejala = old('gejala');
    $selectedMap = collect($selectedGejala)->keyBy('id');
@endphp

<div class="row g-3 align-items-end">
    <div class="col-md-6 col-lg-3">
        <label class="form-label" for="jenisSelect">Jenis Diagnosa <span class="text-danger">*</span></label>
        <select name="jenis" id="jenisSelect"
            class="form-select @error('jenis') is-invalid @enderror" required>
            <option value="penyakit" @selected($jenisValue === 'penyakit')>Penyakit</option>
            <option value="hama" @selected($jenisValue === 'hama')>Hama</option>
        </select>
        @error('jenis') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-12 col-lg-9">
        <label class="form-label" for="targetSelect">Target <span class="text-danger">*</span></label>
        <select name="target_id" id="targetSelect"
            class="form-select @error('target_id') is-invalid @enderror" required>
            <option value="">— Pilih target —</option>

            <optgroup label="Penyakit" data-jenis="penyakit">
                @foreach ($penyakitList as $p)
                    <option value="{{ $p->id }}"
                        data-jenis="penyakit"
                        @selected($jenisValue === 'penyakit' && (int) $targetValue === $p->id)>
                        {{ $p->kode_penyakit }} — {{ $p->nama_penyakit }}
                    </option>
                @endforeach
            </optgroup>

            <optgroup label="Hama" data-jenis="hama">
                @foreach ($hamaList as $h)
                    <option value="{{ $h->id }}"
                        data-jenis="hama"
                        @selected($jenisValue === 'hama' && (int) $targetValue === $h->id)>
                        {{ $h->kode_hama }} — {{ $h->nama_hama }}
                    </option>
                @endforeach
            </optgroup>
        </select>
        @error('target_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <div>
                <label class="form-label mb-0 fw-semibold">
                    Pilih Gejala &amp; Nilai CF <span class="text-danger">*</span>
                </label>
                <div class="small text-muted">
                    Centang gejala yang relevan dan isi nilai CF antara <strong>0</strong> sampai <strong>1</strong>.
                    Gejala yang sama boleh dipakai rule lain — bobot CF ditentukan per penyakit/hama di sini.
                </div>
            </div>
            @error('gejala') <span class="text-danger small">{{ $message }}</span> @enderror
        </div>

        <div class="card border">
            <div class="card-header bg-light d-flex flex-wrap gap-2 align-items-center px-3 py-2">
                <div class="input-group input-group-sm" style="max-width: 320px;">
                    <span class="input-group-text bg-white"><i class="ti ti-search"></i></span>
                    <input type="text" id="gejalaSearch" class="form-control" placeholder="Cari kode / nama gejala...">
                </div>
                <span class="badge bg-primary-subtle text-primary ms-auto">
                    Dipilih: <span id="selectedCount">0</span>
                </span>
            </div>
            <div class="table-responsive table-responsive-scroll-y">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="bg-white sticky-top">
                        <tr>
                            <th style="width: 60px;" class="ps-3">Pilih</th>
                            <th style="width: 110px;">Kode</th>
                            <th>Nama Gejala</th>
                            <th style="width: 180px;" class="pe-3">Nilai CF (0-1)</th>
                        </tr>
                    </thead>
                    <tbody id="gejalaTable">
                        @forelse ($gejalaList as $g)
                            @php
                                $checked = false;
                                $cf = '';
                                if (is_array($oldGejala)) {
                                    foreach ($oldGejala as $row) {
                                        if ((int) ($row['id'] ?? 0) === $g->id) {
                                            $checked = true;
                                            $cf = $row['nilai_cf'] ?? '';
                                            break;
                                        }
                                    }
                                } elseif ($selectedMap->has($g->id)) {
                                    $checked = true;
                                    $cf = number_format((float) $selectedMap[$g->id]['nilai_cf'], 2);
                                }
                            @endphp
                            <tr data-search="{{ strtolower($g->kode_gejala . ' ' . $g->nama_gejala) }}">
                                <td class="ps-3">
                                    <input type="checkbox"
                                        class="form-check-input gejala-check"
                                        name="gejala[{{ $g->id }}][id]"
                                        value="{{ $g->id }}"
                                        data-id="{{ $g->id }}"
                                        @checked($checked)>
                                </td>
                                <td><span class="badge bg-primary-subtle text-primary">{{ $g->kode_gejala }}</span></td>
                                <td>{{ $g->nama_gejala }}</td>
                                <td class="pe-3">
                                    <input type="number"
                                        name="gejala[{{ $g->id }}][nilai_cf]"
                                        class="form-control form-control-sm cf-input"
                                        data-id="{{ $g->id }}"
                                        min="0" max="1" step="0.01"
                                        placeholder="0.00"
                                        value="{{ $cf }}"
                                        @disabled(! $checked)>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">
                                    Belum ada data gejala.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        (function () {
            const jenisSelect = document.getElementById('jenisSelect');
            const targetSelect = document.getElementById('targetSelect');
            const search = document.getElementById('gejalaSearch');
            const tbody = document.getElementById('gejalaTable');
            const counter = document.getElementById('selectedCount');

            function filterTarget() {
                const jenis = jenisSelect.value;
                let currentStillValid = false;
                Array.from(targetSelect.options).forEach((opt) => {
                    if (!opt.value) return;
                    const match = opt.dataset.jenis === jenis;
                    opt.hidden = !match;
                    opt.disabled = !match;
                    if (match && opt.selected) currentStillValid = true;
                });
                if (!currentStillValid) {
                    targetSelect.value = '';
                }
            }

            function updateCount() {
                if (!tbody || !counter) return;
                const total = tbody.querySelectorAll('.gejala-check:checked').length;
                counter.textContent = total;
            }

            if (tbody) {
                tbody.addEventListener('change', (e) => {
                    if (e.target.classList.contains('gejala-check')) {
                        const id = e.target.dataset.id;
                        const cfInput = tbody.querySelector(`.cf-input[data-id="${id}"]`);
                        if (cfInput) {
                            cfInput.disabled = !e.target.checked;
                            if (!e.target.checked) {
                                cfInput.value = '';
                            } else if (!cfInput.value) {
                                cfInput.focus();
                            }
                        }
                        updateCount();
                    }
                });
            }

            if (search && tbody) {
                search.addEventListener('input', () => {
                    const q = search.value.toLowerCase().trim();
                    tbody.querySelectorAll('tr[data-search]').forEach((row) => {
                        row.style.display = !q || row.dataset.search.includes(q) ? '' : 'none';
                    });
                });
            }

            if (jenisSelect) {
                jenisSelect.addEventListener('change', filterTarget);
                filterTarget();
            }
            updateCount();
        })();
    </script>
@endpush

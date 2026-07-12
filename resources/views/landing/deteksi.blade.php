@extends('layouts.landing')

@section('title', 'Deteksi Penyakit & Hama Bawang Merah')

@section('content')
    <section class="deteksi-section lp-photo-soft">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-9">
                    <div class="deteksi-card" id="deteksiApp">
                        <div class="deteksi-header">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h2 class="h4 fw-bold mb-1">
                                        <i class="ti ti-stethoscope me-2"></i>Deteksi Bawang Merah
                                    </h2>
                                    <p class="mb-0 opacity-75 small" id="stepLabel">
                                        <i class="ti ti-list-check me-1"></i>Langkah 1 — Pilih penyakit atau hama yang Anda curigai
                                    </p>
                                </div>
                                @guest
                                    <span class="badge bg-white text-success"><i class="ti ti-user me-1"></i>Mode Tamu</span>
                                @elseif(auth()->user()->isPengguna())
                                    <span class="badge bg-white text-success"><i class="ti ti-user-check me-1"></i>{{ auth()->user()->name }}</span>
                                @else
                                    <span class="badge bg-white text-success"><i class="ti ti-shield-check me-1"></i>{{ auth()->user()->name }}</span>
                                @endguest
                            </div>
                            <div class="progress-steps mt-3" id="progressSteps">
                                <div class="progress-step active"></div>
                                <div class="progress-step"></div>
                                <div class="progress-step"></div>
                            </div>
                        </div>

                        <div class="selected-target-banner d-none" id="selectedTargetBanner"></div>
                        <div class="selected-tags d-none" id="selectedTags"></div>

                        <div id="mainArea">
                            <div class="loading-spinner">
                                <div class="spinner-border" role="status"></div>
                                <p class="mt-3 mb-0"><i class="ti ti-loader me-1"></i>Memuat data...</p>
                            </div>
                        </div>

                        <div id="resultArea" class="d-none"></div>

                        <div class="deteksi-actions" id="actionBar">
                            <button type="button" class="btn btn-outline-secondary rounded-pill d-none" id="btnBack">
                                <i class="ti ti-arrow-left me-1"></i> Kembali
                            </button>
                            <button type="button" class="btn btn-outline-secondary rounded-pill" id="btnReset" disabled>
                                <i class="ti ti-refresh me-1"></i> Ulangi
                            </button>
                            <button type="button" class="btn btn-success rounded-pill d-none" id="btnFinish">
                                <i class="ti ti-check me-1"></i> Lihat Hasil
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Modal Tingkat Keyakinan --}}
    <div class="modal fade" id="cfModal" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold"><i class="ti ti-adjustments me-2 text-success"></i>Tingkat Keyakinan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="cf-modal-gejala mb-4">
                        <span id="cfModalNama" class="fw-semibold">Nama gejala</span>
                    </div>
                    <p class="text-muted small mb-3">
                        <i class="ti ti-info-circle me-1"></i>
                        Seberapa yakin gejala ini muncul pada tanaman? Pilih salah satu tingkat keyakinan:
                    </p>
                    <div class="cf-level-grid" id="cfLevelGrid"></div>
                    <div class="text-center mt-3">
                        <div class="cf-value-display py-3 px-4">
                            <span class="cf-value-label" id="cfValueLabel">Sangat Yakin</span>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="button" class="btn btn-success rounded-pill w-100" id="btnConfirmCf">
                            <i class="ti ti-check me-1"></i> Konfirmasi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @guest
    <div class="modal fade" id="guestNameModal" tabindex="-1" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0">
                <div class="modal-body p-4 text-center">
                    <div class="feature-icon mx-auto mb-3"><i class="ti ti-user"></i></div>
                    <h5 class="fw-bold">Simpan Riwayat Deteksi</h5>
                    <p class="text-muted small">Masukkan nama (opsional) sebelum melihat hasil.</p>
                    <input type="text" class="form-control rounded-pill text-center mb-3" id="guestName" placeholder="Nama Anda (opsional)" maxlength="100">
                    <button type="button" class="btn btn-success rounded-pill px-4" id="btnGuestContinue">
                        <i class="ti ti-arrow-right me-1"></i> Lanjutkan
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endguest
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof bootstrap === 'undefined') {
                document.getElementById('mainArea').innerHTML =
                    '<div class="alert alert-danger m-4"><i class="ti ti-alert-circle me-1"></i>Bootstrap JS gagal dimuat. Silakan refresh halaman.</div>';
                return;
            }

            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            const isGuest = {{ auth()->guest() ? 'true' : 'false' }};
            const apiBase = '{{ url('/deteksi') }}';

            let currentStep = 1;
            let selectedTarget = null;
            let selectedSymptoms = [];
            let pendingSymptom = null;
            let targetFilter = 'all';
            let cfModalInstance = null;

            const mainArea = document.getElementById('mainArea');
            const resultArea = document.getElementById('resultArea');
            const selectedTags = document.getElementById('selectedTags');
            const selectedTargetBanner = document.getElementById('selectedTargetBanner');
            const stepLabel = document.getElementById('stepLabel');
            const btnReset = document.getElementById('btnReset');
            const btnBack = document.getElementById('btnBack');
            const btnFinish = document.getElementById('btnFinish');
            const progressSteps = document.querySelectorAll('.progress-step');

            let selectedCf = 1;
            let selectedCfLabel = 'Sangat Yakin';

            const CF_LEVELS = [
                { value: 0, label: 'Tidak', icon: 'ti-x' },
                { value: 0.2, label: 'Tidak Yakin', icon: 'ti-mood-confused' },
                { value: 0.4, label: 'Kurang Yakin', icon: 'ti-mood-empty' },
                { value: 0.6, label: 'Cukup Yakin', icon: 'ti-mood-neutral' },
                { value: 0.8, label: 'Yakin', icon: 'ti-mood-smile' },
                { value: 1, label: 'Sangat Yakin', icon: 'ti-mood-happy' },
            ];

            const cfLevelGrid = document.getElementById('cfLevelGrid');
            const cfValueLabel = document.getElementById('cfValueLabel');

            function getCfLabel(value) {
                const v = parseFloat(value);
                if (Math.abs(v - 0.1) < 0.001) {
                    return 'Tidak';
                }
                const level = CF_LEVELS.find(l => Math.abs(l.value - v) < 0.001);
                return level ? level.label : 'Sangat Yakin';
            }

            function formatSolusi(text) {
                if (!text) {
                    return '-';
                }
                const div = document.createElement('div');
                div.textContent = text;
                return div.innerHTML;
            }

            function renderCfLevels(activeValue = 1) {
                selectedCf = parseFloat(activeValue);
                selectedCfLabel = getCfLabel(selectedCf);
                cfValueLabel.textContent = selectedCfLabel;

                cfLevelGrid.innerHTML = CF_LEVELS.map(level => `
                    <button type="button" class="cf-level-btn ${Math.abs(level.value - selectedCf) < 0.001 ? 'active' : ''}"
                        data-value="${level.value}" data-label="${level.label}">
                        <i class="ti ${level.icon}"></i>
                        <span class="cf-level-label">${level.label}</span>
                    </button>
                `).join('');

                cfLevelGrid.querySelectorAll('.cf-level-btn').forEach(btn => {
                    btn.addEventListener('click', () => {
                        selectedCf = parseFloat(btn.dataset.value);
                        selectedCfLabel = btn.dataset.label;
                        renderCfLevels(selectedCf);
                    });
                });
            }

            renderCfLevels(1);

            function getCfModal() {
                if (!cfModalInstance) {
                    cfModalInstance = bootstrap.Modal.getOrCreateInstance(document.getElementById('cfModal'));
                }
                return cfModalInstance;
            }

            function getSymptomsPayload() {
                return selectedSymptoms.map(s => ({ id: s.id, user_cf: s.user_cf }));
            }

            async function apiFetch(url, body) {
                const res = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(body),
                });
                if (!res.ok) {
                    const err = await res.json().catch(() => ({}));
                    throw new Error(err.message || 'Request gagal');
                }
                return res.json();
            }

            function updateProgress(step) {
                progressSteps.forEach((el, i) => el.classList.toggle('active', i < step));
            }

            function jenisBadge(jenis) {
                const isPenyakit = jenis === 'penyakit';
                return `<span class="badge bg-${isPenyakit ? 'danger' : 'warning'}-subtle text-${isPenyakit ? 'danger' : 'warning'} text-capitalize">
                    <i class="ti ti-${isPenyakit ? 'virus' : 'bug'} me-1"></i>${jenis}
                </span>`;
            }

            function renderTargetBanner() {
                if (!selectedTarget) {
                    selectedTargetBanner.classList.add('d-none');
                    selectedTargetBanner.innerHTML = '';
                    return;
                }

                selectedTargetBanner.classList.remove('d-none');
                selectedTargetBanner.innerHTML = `
                    <div class="d-flex align-items-center gap-3">
                        <img src="${selectedTarget.gambar}" alt="${selectedTarget.nama}" class="target-banner-img">
                        <div>
                            ${jenisBadge(selectedTarget.jenis)}
                            <h6 class="fw-bold mb-0 mt-1">${selectedTarget.nama}</h6>
                            <small class="text-muted"><i class="ti ti-list-check me-1"></i>${selectedTarget.jumlah_gejala} gejala</small>
                        </div>
                    </div>`;
            }

            function renderSelectedTags() {
                if (selectedSymptoms.length === 0) {
                    selectedTags.classList.add('d-none');
                    selectedTags.innerHTML = '';
                    return;
                }

                selectedTags.classList.remove('d-none');
                selectedTags.innerHTML = `
                    <div class="selected-tags-header small text-muted mb-2 px-2">
                        <i class="ti ti-list-details me-1"></i> Gejala terpilih & tingkat keyakinan:
                    </div>
                ` + selectedSymptoms.map(s => `
                    <span class="selected-tag">
                        <i class="ti ti-stethoscope"></i>
                        ${s.nama}
                        <span class="cf-badge" title="Klik untuk ubah keyakinan" data-id="${s.id}">
                            <i class="ti ti-adjustments"></i> ${s.cf_label || getCfLabel(s.user_cf)}
                        </span>
                        <i class="ti ti-x remove-tag" data-id="${s.id}"></i>
                    </span>
                `).join('');

                selectedTags.querySelectorAll('.remove-tag').forEach(btn => {
                    btn.addEventListener('click', () => {
                        selectedSymptoms = selectedSymptoms.filter(s => s.id !== parseInt(btn.dataset.id));
                        renderSelectedTags();
                        renderSymptoms(currentSymptoms);
                        btnFinish.classList.toggle('d-none', selectedSymptoms.length === 0);
                    });
                });

                selectedTags.querySelectorAll('.cf-badge').forEach(badge => {
                    badge.addEventListener('click', () => {
                        const item = selectedSymptoms.find(s => s.id === parseInt(badge.dataset.id));
                        if (item) openCfModal(item, true);
                    });
                });
            }

            function openCfModal(symptom, isEdit = false) {
                pendingSymptom = { ...symptom, isEdit };
                document.getElementById('cfModalNama').textContent = symptom.nama;
                renderCfLevels(symptom.user_cf ?? 1);
                getCfModal().show();
            }

            document.getElementById('btnConfirmCf').addEventListener('click', () => {
                const cf = selectedCf;
                const cfLabel = selectedCfLabel;

                if (pendingSymptom) {
                    const existing = selectedSymptoms.find(s => s.id === pendingSymptom.id);
                    if (existing) {
                        existing.user_cf = cf;
                        existing.cf_label = cfLabel;
                    } else {
                        selectedSymptoms.push({
                            id: pendingSymptom.id,
                            kode: pendingSymptom.kode,
                            nama: pendingSymptom.nama,
                            user_cf: cf,
                            cf_label: cfLabel,
                        });
                    }

                    renderSelectedTags();
                    renderSymptoms(currentSymptoms);
                    btnFinish.classList.remove('d-none');
                }

                pendingSymptom = null;
                getCfModal().hide();
            });

            let currentSymptoms = [];

            function renderSymptoms(symptoms) {
                currentSymptoms = symptoms || [];

                if (!symptoms || symptoms.length === 0) {
                    mainArea.innerHTML = `
                        <div class="text-center py-5 px-4">
                            <i class="ti ti-alert-circle text-warning" style="font-size:3rem"></i>
                            <p class="mt-3 text-muted">Belum ada gejala untuk penyakit/hama ini.</p>
                        </div>`;
                    return;
                }

                mainArea.innerHTML = `
                    <div class="symptom-step-intro px-4 pt-3 pb-1">
                        <p class="text-muted small mb-0">
                            <i class="ti ti-info-circle me-1"></i>
                            Pilih gejala yang Anda amati pada tanaman, lalu tentukan tingkat keyakinan masing-masing.
                        </p>
                    </div>
                    <div class="symptom-grid">${symptoms.map(s => {
                        const isSelected = selectedSymptoms.some(x => x.id === s.id);
                        return `
                            <button type="button" class="symptom-btn ${isSelected ? 'selected' : ''}" data-id="${s.id}">
                                <span class="symptom-icon"><i class="ti ti-${isSelected ? 'circle-check' : 'circle-plus'}"></i></span>
                                <div>
                                    <span class="symptom-name d-block">${s.nama}</span>
                                </div>
                            </button>`;
                    }).join('')}</div>`;

                mainArea.querySelectorAll('.symptom-btn').forEach(btn => {
                    btn.addEventListener('click', () => {
                        const s = currentSymptoms.find(x => x.id === parseInt(btn.dataset.id));
                        if (!s) return;

                        const existing = selectedSymptoms.find(x => x.id === s.id);
                        if (existing) {
                            openCfModal(existing, true);
                        } else {
                            openCfModal({ id: s.id, nama: s.nama, kode: s.kode });
                        }
                    });
                });
            }

            function renderTargets(targets) {
                const filtered = targets.filter(t => targetFilter === 'all' || t.jenis === targetFilter);

                mainArea.innerHTML = `
                    <div class="target-filter px-4 pt-3">
                        <div class="btn-group target-filter-tabs" role="group">
                            <button type="button" class="btn btn-sm ${targetFilter === 'all' ? 'btn-success' : 'btn-outline-success'} rounded-pill" data-filter="all">Semua</button>
                            <button type="button" class="btn btn-sm ${targetFilter === 'penyakit' ? 'btn-success' : 'btn-outline-success'} rounded-pill" data-filter="penyakit">
                                <i class="ti ti-virus me-1"></i>Penyakit
                            </button>
                            <button type="button" class="btn btn-sm ${targetFilter === 'hama' ? 'btn-success' : 'btn-outline-success'} rounded-pill" data-filter="hama">
                                <i class="ti ti-bug me-1"></i>Hama
                            </button>
                        </div>
                    </div>
                    <div class="target-grid">
                        ${filtered.length === 0 ? `
                            <div class="text-center py-5 text-muted col-12">
                                <i class="ti ti-search-off" style="font-size:2.5rem"></i>
                                <p class="mt-2 mb-0">Tidak ada data untuk filter ini.</p>
                            </div>
                        ` : filtered.map(t => `
                            <button type="button" class="target-card" data-jenis="${t.jenis}" data-id="${t.target_id}">
                                <div class="target-card-img">
                                    <img src="${t.gambar}" alt="${t.nama}" loading="lazy">
                                    ${jenisBadge(t.jenis)}
                                </div>
                                <div class="target-card-body">
                                    <h6 class="target-name">${t.nama}</h6>
                                    <p class="target-desc">${t.deskripsi || 'Klik untuk melihat gejala dan konfirmasi diagnosa.'}</p>
                                    <span class="target-meta"><i class="ti ti-list-check me-1"></i>${t.jumlah_gejala} gejala</span>
                                </div>
                            </button>
                        `).join('')}
                    </div>`;

                mainArea.querySelectorAll('[data-filter]').forEach(btn => {
                    btn.addEventListener('click', () => {
                        targetFilter = btn.dataset.filter;
                        renderTargets(targets);
                    });
                });

                mainArea.querySelectorAll('.target-card').forEach(card => {
                    card.addEventListener('click', () => selectTarget(
                        targets.find(t => t.jenis === card.dataset.jenis && t.target_id === parseInt(card.dataset.id))
                    ));
                });
            }

            async function loadTargets() {
                currentStep = 1;
                selectedTarget = null;
                selectedSymptoms = [];
                targetFilter = 'all';
                updateProgress(1);
                stepLabel.innerHTML = '<i class="ti ti-list-check me-1"></i>Langkah 1 — Pilih penyakit atau hama yang Anda curigai';
                renderTargetBanner();
                renderSelectedTags();
                resultArea.classList.add('d-none');
                mainArea.classList.remove('d-none');
                btnFinish.classList.add('d-none');
                btnBack.classList.add('d-none');
                btnReset.disabled = true;

                mainArea.innerHTML = `<div class="loading-spinner"><div class="spinner-border"></div><p class="mt-3 mb-0"><i class="ti ti-loader me-1"></i>Memuat penyakit & hama...</p></div>`;

                try {
                    const res = await fetch(apiBase + '/targets', { headers: { 'Accept': 'application/json' } });
                    if (!res.ok) throw new Error('HTTP ' + res.status);
                    const data = await res.json();
                    renderTargets(data.targets || []);
                } catch (e) {
                    mainArea.innerHTML = `<div class="alert alert-danger m-4"><i class="ti ti-alert-circle me-1"></i>Gagal memuat data. Silakan refresh halaman.</div>`;
                }
            }

            async function selectTarget(target) {
                if (!target) return;

                selectedTarget = target;
                selectedSymptoms = [];
                currentStep = 2;
                updateProgress(2);
                stepLabel.innerHTML = '<i class="ti ti-list-check me-1"></i>Langkah 2 — Pilih gejala yang muncul pada tanaman';
                renderTargetBanner();
                renderSelectedTags();
                resultArea.classList.add('d-none');
                mainArea.classList.remove('d-none');
                btnFinish.classList.add('d-none');
                btnBack.classList.remove('d-none');
                btnReset.disabled = false;

                mainArea.innerHTML = `<div class="loading-spinner"><div class="spinner-border"></div><p class="mt-3 mb-0"><i class="ti ti-loader me-1"></i>Memuat gejala...</p></div>`;

                try {
                    const url = apiBase + '/target/' + target.jenis + '/' + target.target_id + '/gejala';
                    const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
                    if (!res.ok) throw new Error('HTTP ' + res.status);
                    const data = await res.json();
                    if (data.target) selectedTarget = data.target;
                    renderTargetBanner();
                    renderSymptoms(data.symptoms || []);
                } catch (e) {
                    mainArea.innerHTML = `<div class="alert alert-danger m-4"><i class="ti ti-alert-circle me-1"></i>Gagal memuat gejala.</div>`;
                }
            }

            async function showResults(guestName) {
                mainArea.classList.add('d-none');
                resultArea.classList.remove('d-none');
                btnFinish.classList.add('d-none');
                resultArea.innerHTML = `<div class="loading-spinner"><div class="spinner-border"></div><p class="mt-3 mb-0"><i class="ti ti-loader me-1"></i>Menghitung hasil diagnosa...</p></div>`;

                try {
                    const payload = {
                        jenis: selectedTarget.jenis,
                        target_id: selectedTarget.target_id,
                        symptoms: getSymptomsPayload(),
                    };

                    const calcData = await apiFetch(apiBase + '/hitung', payload);
                    await apiFetch(apiBase + '/simpan', { ...payload, nama_pengguna: guestName || null });

                    const top = calcData.result;

                    resultArea.innerHTML = `
                        <div class="result-card result-card-hero">
                            <div class="result-hero-banner" style="background-image: url('${top.gambar}')">
                                <div class="result-hero-overlay">
                                    <div class="result-hero-content">
                                        <div class="result-hero-badges">
                                            ${jenisBadge(top.jenis)}
                                            <span class="result-hero-cf"><i class="ti ti-chart-donut me-1"></i>${top.persentase}% CF</span>
                                        </div>
                                        <h3 class="result-hero-title">${top.nama}</h3>
                                        <p class="result-hero-meta mb-0">
                                            <i class="ti ti-list-check me-1"></i>Gejala cocok: ${top.gejala_cocok}/${top.total_gejala_rule}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="result-hero-body">
                                <div class="result-section">
                                    <h6 class="fw-bold"><i class="ti ti-info-circle me-1 text-success"></i> Deskripsi</h6>
                                    <p class="text-muted small mb-0">${top.deskripsi || '-'}</p>
                                </div>
                                <div class="result-section">
                                    <h6 class="fw-bold"><i class="ti ti-first-aid-kit me-1 text-success"></i> Solusi / Pengendalian</h6>
                                    <p class="text-muted small solusi-text mb-0">${formatSolusi(top.solusi)}</p>
                                </div>
                                <div class="result-section">
                                    <h6 class="fw-bold mb-2"><i class="ti ti-stethoscope me-1"></i> Gejala Terpilih</h6>
                                    <div class="d-flex flex-wrap gap-2">
                                        ${selectedSymptoms.map(s => `
                                            <span class="selected-tag">
                                                <i class="ti ti-point-filled"></i>
                                                ${s.nama}
                                                <span class="cf-badge"><i class="ti ti-adjustments"></i> ${s.cf_label || getCfLabel(s.user_cf)}</span>
                                            </span>
                                        `).join('')}
                                    </div>
                                </div>
                                <div class="alert alert-success-subtle border-0 rounded-3 mb-0 small">
                                    <i class="ti ti-circle-check me-1"></i> Riwayat deteksi berhasil disimpan.
                                </div>
                            </div>
                        </div>`;

                    currentStep = 3;
                    updateProgress(3);
                    stepLabel.innerHTML = '<i class="ti ti-circle-check me-1"></i>Selesai — Hasil diagnosa';
                } catch (e) {
                    resultArea.innerHTML = `<div class="alert alert-danger m-4"><i class="ti ti-alert-circle me-1"></i>${e.message || 'Gagal menghitung diagnosa.'}</div>`;
                }
            }

            btnFinish.addEventListener('click', () => {
                if (!selectedTarget || selectedSymptoms.length === 0) return;
                if (isGuest) {
                    bootstrap.Modal.getOrCreateInstance(document.getElementById('guestNameModal')).show();
                } else {
                    showResults(null);
                }
            });

            @guest
            document.getElementById('btnGuestContinue').addEventListener('click', () => {
                const name = document.getElementById('guestName').value.trim();
                bootstrap.Modal.getInstance(document.getElementById('guestNameModal')).hide();
                showResults(name || null);
            });
            @endguest

            btnBack.addEventListener('click', loadTargets);
            btnReset.addEventListener('click', loadTargets);
            loadTargets();
        });
    </script>
@endpush

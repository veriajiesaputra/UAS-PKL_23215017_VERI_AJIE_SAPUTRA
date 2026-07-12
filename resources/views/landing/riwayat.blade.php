@extends('layouts.landing')

@section('title', 'Riwayat Deteksi')

@section('content')
    <section class="deteksi-section lp-photo-soft">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="deteksi-card">
                        <div class="deteksi-header">
                            <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                                <div>
                                    <h2 class="h4 fw-bold mb-1">
                                        <i class="ti ti-history me-2"></i>Riwayat Deteksi Saya
                                    </h2>
                                    <p class="mb-0 opacity-75 small">
                                        Daftar hasil diagnosa yang pernah Anda lakukan
                                    </p>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('deteksi') }}" class="btn btn-light btn-sm rounded-pill">
                                        <i class="ti ti-stethoscope me-1"></i> Deteksi Baru
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="p-4">


                            @forelse ($riwayat as $item)
                                <div class="riwayat-item mb-3">
                                    <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
                                        <div class="flex-grow-1">
                                            <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">

                                                <span class="badge bg-{{ $item->jenis_hasil === 'penyakit' ? 'danger' : 'warning' }}-subtle text-{{ $item->jenis_hasil === 'penyakit' ? 'danger' : 'warning' }} text-capitalize">
                                                    <i class="ti ti-{{ $item->jenis_hasil === 'penyakit' ? 'virus' : 'bug' }} me-1"></i>
                                                    {{ $item->jenis_hasil }}
                                                </span>
                                                <span class="badge bg-success-subtle text-success">
                                                    CF {{ $item->persentase_cf }}%
                                                </span>
                                                <small class="text-muted">
                                                    <i class="ti ti-calendar me-1"></i>{{ $item->created_at?->translatedFormat('d M Y, H:i') }}
                                                </small>
                                            </div>
                                            <h5 class="fw-bold mb-1">{{ $item->nama_target }}</h5>
                                            <p class="text-muted small mb-2">
                                                <i class="ti ti-barcode me-1"></i>Kode: {{ $item->kode_target ?? '-' }}
                                            </p>
                                            @if(is_array($item->gejala_terpilih) && count($item->gejala_terpilih))
                                                <div class="d-flex flex-wrap gap-2">
                                                    @foreach($item->gejala_terpilih as $gejala)
                                                        <span class="selected-tag">
                                                            <i class="ti ti-stethoscope"></i>
                                                            {{ $gejala['kode'] ?? '' }}: {{ $gejala['nama'] ?? '' }}
                                                            @if(isset($gejala['cf_label']))
                                                                <span class="cf-badge">{{ $gejala['cf_label'] }}</span>
                                                            @endif
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <div class="text-end">
                                            <div class="riwayat-cf-badge">{{ $item->persentase_cf }}%</div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5">
                                    <i class="ti ti-clipboard-off text-muted" style="font-size:3rem;"></i>
                                    <h5 class="mt-3 fw-semibold">Belum Ada Riwayat</h5>
                                    <p class="text-muted small mb-4">Anda belum melakukan deteksi penyakit. Mulai diagnosa sekarang!</p>
                                    <a href="{{ route('deteksi') }}" class="btn btn-success rounded-pill px-4">
                                        <i class="ti ti-stethoscope me-1"></i> Mulai Deteksi
                                    </a>
                                </div>
                            @endforelse

                            @if($riwayat->hasPages())
                                <div class="mt-4 d-flex justify-content-center">
                                    {{ $riwayat->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

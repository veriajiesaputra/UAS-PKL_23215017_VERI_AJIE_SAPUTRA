@extends('template_backend.layout')

@section('title', 'Dashboard')

@section('content')
    <x-page-header
        title="Dashboard"
        subtitle="Ringkasan SIPATAN — Sistem Pakar Diagnosa Bawang Merah">
    </x-page-header>

    <div class="row g-3 mb-4">
        <div class="col-lg-3 col-md-6 col-12">
            <x-stat-card
                title="Total Gejala"
                :value="number_format($stats['gejala'])"
                icon="fa-solid fa-clipboard-list"
                color="primary"
                subtitle="Data gejala terdaftar" />
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <x-stat-card
                title="Total Penyakit"
                :value="number_format($stats['penyakit'])"
                icon="fa-solid fa-virus"
                color="danger"
                subtitle="Penyakit terdata" />
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <x-stat-card
                title="Total Hama"
                :value="number_format($stats['hama'])"
                icon="fa-solid fa-bug"
                color="warning"
                subtitle="Hama terdata" />
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <x-stat-card
                title="Total Deteksi"
                :value="number_format($stats['deteksi'])"
                icon="fa-solid fa-magnifying-glass-chart"
                color="success"
                subtitle="Riwayat deteksi pengguna" />
        </div>
    </div>

    {{-- Grafik Riwayat Deteksi --}}
    <div class="row g-3 mb-3">
        <div class="col-12 col-xl-8">
            <div class="card h-100">
                <div class="card-header bg-white px-4 py-3">
                    <h4 class="mb-0 h5">Tren Deteksi per Bulan</h4>
                    <small class="text-muted">Jumlah deteksi penyakit/hama dari landing page</small>
                </div>
                <div class="card-body p-4">
                    <div id="deteksiBulanChart" style="min-height: 340px;"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4">
            <div class="card h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center px-4 py-3">
                    <div>
                        <h4 class="mb-0 h5">Hasil Deteksi</h4>
                        <small class="text-muted">Distribusi per target</small>
                    </div>
                    <div class="btn-group btn-group-sm" role="group" id="deteksiChartToggle">
                        <button type="button" class="btn btn-outline-primary active" data-target="deteksi_penyakit">Penyakit</button>
                        <button type="button" class="btn btn-outline-primary" data-target="deteksi_hama">Hama</button>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div id="deteksiTargetChart" style="min-height: 340px;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-12 col-xl-8">
            <div class="card h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center px-4 py-3">
                    <div>
                        <h4 class="mb-0 h5">Distribusi Rule per Target</h4>
                        <small class="text-muted">Jumlah aturan diagnosa yang terhubung ke tiap penyakit dan hama</small>
                    </div>
                    <div class="btn-group btn-group-sm" role="group" id="ruleChartToggle">
                        <button type="button" class="btn btn-outline-primary active" data-target="penyakit">Penyakit</button>
                        <button type="button" class="btn btn-outline-primary" data-target="hama">Hama</button>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div id="ruleDistributionChart" style="min-height: 340px;"></div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4">
            <div class="card h-100">
                <div class="card-header bg-white px-4 py-3">
                    <h4 class="mb-0 h5">Ringkasan Data</h4>
                    <small class="text-muted">Total entitas pada knowledge base</small>
                </div>
                <div class="card-body p-4">
                    <div id="overviewChart" style="min-height: 340px;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-7">
            <div class="card h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center px-4 py-3">
                    <h4 class="mb-0 h5">Riwayat Deteksi Terbaru</h4>
                    <a href="{{ route('home') }}" class="small text-primary text-decoration-underline" target="_blank">Landing Page</a>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Pengguna</th>
                                <th>Hasil</th>
                                <th>CF</th>
                                <th class="pe-4">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latestDeteksi as $deteksi)
                                <tr>
                                    <td class="ps-4">
                                        <span class="fw-semibold">{{ $deteksi->pengguna_label }}</span>
                                        @if (!$deteksi->user_id)
                                            <span class="badge bg-secondary-subtle text-secondary ms-1">Tamu</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $deteksi->jenis_hasil === 'penyakit' ? 'danger' : 'warning' }}-subtle text-{{ $deteksi->jenis_hasil === 'penyakit' ? 'danger' : 'warning' }} text-capitalize me-1">
                                            {{ $deteksi->jenis_hasil }}
                                        </span>
                                        {{ $deteksi->nama_target }}
                                    </td>
                                    <td><span class="badge bg-success-subtle text-success">{{ $deteksi->persentase_cf }}%</span></td>
                                    <td class="pe-4 small text-muted">{{ $deteksi->created_at?->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">Belum ada riwayat deteksi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center px-4 py-3">
                    <h4 class="mb-0 h5">Gejala Terbaru</h4>
                    <a href="{{ route('gejala.index') }}" class="small text-primary text-decoration-underline">Lihat semua</a>
                </div>
                <ul class="list-group list-group-flush">
                    @forelse ($latestGejala as $gejala)
                        <li class="list-group-item d-flex align-items-center gap-3 px-4">
                            <div class="icon-shape icon-sm bg-primary-subtle text-primary rounded-2">
                                <i class="ti ti-stethoscope"></i>
                            </div>
                            <div class="flex-grow-1">
                                <p class="mb-1 fw-semibold">{{ $gejala->nama_gejala }}</p>
                                <small class="text-muted">{{ $gejala->kode_gejala }}</small>
                            </div>
                            <small class="text-muted">{{ $gejala->created_at?->diffForHumans() }}</small>
                        </li>
                    @empty
                        <li class="list-group-item text-center text-muted py-4">Belum ada gejala.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/apexcharts.min.js') }}" defer></script>
    <script>
        (function () {
            const chartData = @json($chartData);

            function waitForApex(cb, tries = 50) {
                if (typeof window.ApexCharts !== 'undefined') return cb();
                if (tries <= 0) return console.warn('ApexCharts gagal dimuat.');
                setTimeout(() => waitForApex(cb, tries - 1), 100);
            }

            waitForApex(function () {
                const baseFont = { fontFamily: 'Poppins, sans-serif' };

                // ---------- Rule distribution (Bar Chart) ----------
                const ruleEl = document.querySelector('#ruleDistributionChart');
                let currentTarget = 'penyakit';

                function buildRuleOptions(target) {
                    const data = chartData[target];
                    const isEmpty = !data.series || data.series.length === 0;
                    return {
                        chart: {
                            type: 'bar',
                            height: 340,
                            toolbar: { show: false },
                            ...baseFont,
                        },
                        series: [{
                            name: target === 'penyakit' ? 'Rule Penyakit' : 'Rule Hama',
                            data: isEmpty ? [0] : data.series,
                        }],
                        colors: [target === 'penyakit' ? '#16A34A' : '#22C55E'],
                        plotOptions: {
                            bar: {
                                borderRadius: 6,
                                borderRadiusApplication: 'end',
                                columnWidth: '55%',
                                distributed: false,
                                dataLabels: { position: 'top' },
                            },
                        },
                        dataLabels: {
                            enabled: true,
                            offsetY: -22,
                            style: { fontSize: '12px', colors: ['#404040'], fontWeight: 600 },
                            formatter: (v) => v,
                        },
                        xaxis: {
                            categories: isEmpty ? ['—'] : data.categories,
                            labels: { style: { colors: '#525252', fontSize: '12px' } },
                            axisBorder: { show: false },
                            axisTicks: { show: false },
                        },
                        yaxis: {
                            title: { text: 'Jumlah Rule', style: { color: '#525252', fontWeight: 500 } },
                            labels: { style: { colors: '#525252' }, formatter: (v) => Math.floor(v) },
                            forceNiceScale: true,
                        },
                        grid: { borderColor: '#e5e5e5', strokeDashArray: 4 },
                        tooltip: {
                            y: {
                                title: { formatter: () => 'Rule' },
                                formatter: (val, ctx) => {
                                    const label = data.labels?.[ctx.dataPointIndex];
                                    return val + (label ? ' — ' + label : '');
                                },
                            },
                        },
                        legend: { show: false },
                        noData: { text: 'Belum ada data', style: { color: '#737373' } },
                    };
                }

                const ruleChart = new ApexCharts(ruleEl, buildRuleOptions(currentTarget));
                ruleChart.render();

                document.querySelectorAll('#ruleChartToggle [data-target]').forEach((btn) => {
                    btn.addEventListener('click', () => {
                        document.querySelectorAll('#ruleChartToggle [data-target]').forEach((b) => b.classList.remove('active'));
                        btn.classList.add('active');
                        currentTarget = btn.dataset.target;
                        ruleChart.updateOptions(buildRuleOptions(currentTarget), false, true);
                    });
                });

                // ---------- Overview (Donut) ----------
                const overviewEl = document.querySelector('#overviewChart');
                const overviewChart = new ApexCharts(overviewEl, {
                    chart: { type: 'donut', height: 340, ...baseFont },
                    series: chartData.overview.series,
                    labels: chartData.overview.categories,
                    colors: ['#16A34A', '#FB2C36', '#F0B100', '#059669'],
                    legend: { position: 'bottom', fontSize: '13px' },
                    dataLabels: { enabled: true, style: { fontSize: '12px', fontWeight: 600 } },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '65%',
                                labels: {
                                    show: true,
                                    total: {
                                        show: true,
                                        label: 'Total Entitas',
                                        color: '#404040',
                                        formatter: (w) => w.globals.seriesTotals.reduce((a, b) => a + b, 0),
                                    },
                                },
                            },
                        },
                    },
                    stroke: { width: 2, colors: ['#fff'] },
                    tooltip: { y: { formatter: (v) => v + ' item' } },
                    noData: { text: 'Belum ada data', style: { color: '#737373' } },
                });
                overviewChart.render();

                // ---------- Deteksi per Bulan (Bar Chart) ----------
                const deteksiBulanEl = document.querySelector('#deteksiBulanChart');
                if (deteksiBulanEl) {
                    const bulanData = chartData.deteksi_bulan;
                    const isEmptyBulan = !bulanData.series || bulanData.series.length === 0;

                    new ApexCharts(deteksiBulanEl, {
                        chart: { type: 'bar', height: 340, toolbar: { show: false }, ...baseFont },
                        series: [{ name: 'Deteksi', data: isEmptyBulan ? [0] : bulanData.series }],
                        colors: ['#16A34A'],
                        plotOptions: {
                            bar: {
                                borderRadius: 6,
                                borderRadiusApplication: 'end',
                                columnWidth: '55%',
                                dataLabels: { position: 'top' },
                            },
                        },
                        dataLabels: {
                            enabled: true,
                            offsetY: -22,
                            style: { fontSize: '12px', colors: ['#404040'], fontWeight: 600 },
                            formatter: (v) => v,
                        },
                        xaxis: {
                            categories: isEmptyBulan ? ['—'] : bulanData.categories,
                            labels: { style: { colors: '#525252', fontSize: '12px' } },
                            axisBorder: { show: false },
                            axisTicks: { show: false },
                        },
                        yaxis: {
                            title: { text: 'Jumlah Deteksi', style: { color: '#525252', fontWeight: 500 } },
                            labels: { formatter: (v) => Math.floor(v), style: { colors: '#525252' } },
                            forceNiceScale: true,
                        },
                        grid: { borderColor: '#e5e5e5', strokeDashArray: 4 },
                        tooltip: { y: { formatter: (v) => v + ' deteksi' } },
                        legend: { show: false },
                        noData: { text: 'Belum ada riwayat deteksi', style: { color: '#737373' } },
                    }).render();
                }

                // ---------- Deteksi per Target (Donut) ----------
                const deteksiTargetEl = document.querySelector('#deteksiTargetChart');
                if (deteksiTargetEl) {
                    let currentDeteksiTarget = 'deteksi_penyakit';

                    function buildDeteksiTargetOptions(key) {
                        const data = chartData[key];
                        const isEmpty = !data.series || data.series.length === 0;
                        return {
                            chart: { type: 'donut', height: 340, ...baseFont },
                            series: isEmpty ? [1] : data.series,
                            labels: isEmpty ? ['Belum ada data'] : data.categories,
                            colors: ['#16A34A', '#22C55E', '#4ADE80', '#86EFAC', '#BBF7D0', '#15803D'],
                            legend: { position: 'bottom', fontSize: '11px' },
                            dataLabels: { enabled: !isEmpty, style: { fontSize: '11px' } },
                            plotOptions: {
                                pie: {
                                    donut: {
                                        size: '60%',
                                        labels: {
                                            show: true,
                                            total: {
                                                show: true,
                                                label: 'Total',
                                                formatter: (w) => isEmpty ? 0 : w.globals.seriesTotals.reduce((a, b) => a + b, 0),
                                            },
                                        },
                                    },
                                },
                            },
                            noData: { text: 'Belum ada data', style: { color: '#737373' } },
                        };
                    }

                    const deteksiTargetChart = new ApexCharts(deteksiTargetEl, buildDeteksiTargetOptions(currentDeteksiTarget));
                    deteksiTargetChart.render();

                    document.querySelectorAll('#deteksiChartToggle [data-target]').forEach((btn) => {
                        btn.addEventListener('click', () => {
                            document.querySelectorAll('#deteksiChartToggle [data-target]').forEach((b) => b.classList.remove('active'));
                            btn.classList.add('active');
                            currentDeteksiTarget = btn.dataset.target;
                            deteksiTargetChart.updateOptions(buildDeteksiTargetOptions(currentDeteksiTarget), true, true);
                        });
                    });
                }
            });
        })();
    </script>
@endpush

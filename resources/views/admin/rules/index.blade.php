@extends('template_backend.layout')

@section('title', 'Data Rules')

@section('content')
    <x-page-header
        title="Rules &amp; Certainty Factor"
        subtitle="Kelola aturan diagnosa beserta nilai CF setiap gejala"
        :breadcrumbs="['Dashboard' => route('dashboard'), 'Rules' => '#']">
        <x-slot:actions>
            <a href="{{ route('rules.export', array_filter(['jenis' => $jenis ?? null])) }}"
                class="btn btn-outline-success">
                <i class="ti ti-file-spreadsheet me-1"></i> Export Excel
            </a>
            <a href="{{ route('rules.create') }}" class="btn btn-primary">
                <i class="ti ti-plus me-1"></i> Tambah Rule
            </a>
        </x-slot:actions>
    </x-page-header>

    <div class="card">
        <div class="card-header bg-white px-4 py-3">
            <form method="GET" action="{{ route('rules.index') }}" class="d-flex gap-2 flex-wrap align-items-center">
                <label class="small text-muted mb-0">Filter jenis:</label>
                <select name="jenis" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                    <option value="">Semua</option>
                    <option value="penyakit" @selected($jenis === 'penyakit')>Penyakit</option>
                    <option value="hama" @selected($jenis === 'hama')>Hama</option>
                </select>
                @if ($jenis)
                    <x-action-btn type="reset" :href="route('rules.index')" title="Reset filter" />
                @endif
            </form>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4" style="width: 70px;">#</th>
                        <th style="width: 130px;">Jenis</th>
                        <th>Target Diagnosa</th>
                        <th>Gejala &amp; CF</th>
                        <th class="text-end pe-4" style="width: 160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rules as $rule)
                        <tr>
                            <td class="ps-4">{{ $loop->iteration + ($rules->currentPage() - 1) * $rules->perPage() }}</td>
                            <td>
                                <span class="badge bg-{{ $rule->jenis === 'penyakit' ? 'danger' : 'warning' }}-subtle text-{{ $rule->jenis === 'penyakit' ? 'danger' : 'warning' }} text-capitalize">
                                    {{ $rule->jenis }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $rule->target_name ?? '— target dihapus —' }}</div>
                                <small class="text-muted">{{ $rule->target_code }}</small>
                            </td>
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    @foreach ($rule->details as $detail)
                                        <span class="badge bg-light text-dark border">
                                            {{ $detail->gejala?->kode_gejala ?? '?' }}
                                            <span class="text-primary ms-1">{{ number_format((float) $detail->nilai_cf, 2) }}</span>
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-inline-flex table-action-group">
                                    <x-action-btn type="edit" :href="route('rules.edit', $rule)" />
                                    <x-action-btn type="delete" :form-action="route('rules.destroy', $rule)"
                                        confirm="Yakin menghapus rule ini?" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                <i class="ti ti-database-off fs-1 d-block mb-2"></i>
                                Belum ada rule terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($rules->hasPages())
            <div class="card-footer bg-white px-4 py-3">
                {{ $rules->links() }}
            </div>
        @endif
    </div>
@endsection

@extends('template_backend.layout')

@section('title', 'Edit Gejala')

@section('content')
    <x-page-header
        title="Edit Gejala"
        subtitle="Perbarui data gejala {{ $gejala->kode_gejala }}"
        :breadcrumbs="[
            'Dashboard' => route('dashboard'),
            'Gejala' => route('gejala.index'),
            'Edit' => '#',
        ]" />

    <div class="card mb-3">
        <div class="card-body p-4">
            <form action="{{ route('gejala.update', $gejala) }}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.gejala._form', ['gejala' => $gejala])

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('gejala.index') }}" class="btn btn-light">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy me-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if ($gejala->rules->isNotEmpty())
        <div class="card">
            <div class="card-header bg-white px-4 py-3">
                <h6 class="mb-0 fw-semibold"><i class="ti ti-link me-1"></i> Penyakit / Hama yang Memakai Gejala Ini</h6>
                <p class="small text-muted mb-0 mt-1">Gejala yang sama dapat dipakai beberapa target; bobot CF berbeda per rule.</p>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">Jenis</th>
                            <th>Kode</th>
                            <th>Nama Target</th>
                            <th class="pe-4 text-end">Bobot CF</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gejala->rules as $rule)
                            @php
                                $target = $rule->jenis === 'penyakit' ? $rule->penyakit : $rule->hama;
                            @endphp
                            <tr>
                                <td class="ps-4">
                                    <span class="badge {{ $rule->jenis === 'penyakit' ? 'bg-danger-subtle text-danger' : 'bg-warning-subtle text-warning' }}">
                                        {{ ucfirst($rule->jenis) }}
                                    </span>
                                </td>
                                <td>{{ $rule->jenis === 'penyakit' ? $target?->kode_penyakit : $target?->kode_hama }}</td>
                                <td>{{ $rule->jenis === 'penyakit' ? $target?->nama_penyakit : $target?->nama_hama }}</td>
                                <td class="pe-4 text-end fw-semibold text-primary">{{ number_format((float) $rule->pivot->nilai_cf, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection

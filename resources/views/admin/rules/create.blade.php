@extends('template_backend.layout')

@section('title', 'Tambah Rule')

@section('content')
    <x-page-header
        title="Tambah Rule"
        subtitle="Buat aturan diagnosa baru dengan nilai Certainty Factor"
        :breadcrumbs="[
            'Dashboard' => route('dashboard'),
            'Rules' => route('rules.index'),
            'Tambah' => '#',
        ]" />

    <div class="card">
        <div class="card-body p-4">
            <form action="{{ route('rules.store') }}" method="POST">
                @csrf
                @include('admin.rules._form', [
                    'rule' => $rule,
                    'gejalaList' => $gejalaList,
                    'penyakitList' => $penyakitList,
                    'hamaList' => $hamaList,
                    'selectedGejala' => $selectedGejala,
                    'filterAction' => route('rules.create'),
                ])

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('rules.index') }}" class="btn btn-light">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy me-1"></i> Simpan Rule
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

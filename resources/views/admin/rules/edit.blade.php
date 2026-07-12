@extends('template_backend.layout')

@section('title', 'Edit Rule')

@section('content')
    <x-page-header
        title="Edit Rule"
        subtitle="Perbarui aturan diagnosa &amp; nilai Certainty Factor"
        :breadcrumbs="[
            'Dashboard' => route('dashboard'),
            'Rules' => route('rules.index'),
            'Edit' => '#',
        ]" />

    <div class="card">
        <div class="card-body p-4">
            <form action="{{ route('rules.update', $rule) }}" method="POST">
                @csrf
                @method('PUT')
                @include('admin.rules._form', [
                    'rule' => $rule,
                    'gejalaList' => $gejalaList,
                    'penyakitList' => $penyakitList,
                    'hamaList' => $hamaList,
                    'selectedGejala' => $selectedGejala,
                    'filterAction' => route('rules.edit', $rule),
                ])

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('rules.index') }}" class="btn btn-light">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-device-floppy me-1"></i> Update Rule
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

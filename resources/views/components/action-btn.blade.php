@props([
    'type' => 'edit',
    'href' => null,
    'formAction' => null,
    'confirm' => 'Yakin ingin menghapus data ini?',
    'title' => null,
])

@php
    $config = match ($type) {
        'view' => ['icon' => 'fa-solid fa-eye', 'label' => 'Lihat detail'],
        'edit' => ['icon' => 'fa-solid fa-pen-to-square', 'label' => 'Edit'],
        'delete' => ['icon' => 'fa-solid fa-trash-can', 'label' => 'Hapus'],
        'reset' => ['icon' => 'fa-solid fa-rotate-left', 'label' => 'Reset'],
        default => ['icon' => 'fa-solid fa-pen-to-square', 'label' => 'Edit'],
    };

    $title = $title ?? $config['label'];
@endphp

@if ($type === 'delete' && $formAction)
    <form action="{{ $formAction }}" method="POST" class="d-inline"
        onsubmit="return confirm(@js($confirm));">
        @csrf
        @method('DELETE')
        <button type="submit" class="action-btn action-btn-{{ $type }}" title="{{ $title }}">
            <i class="{{ $config['icon'] }}"></i>
        </button>
    </form>
@elseif ($href)
    <a href="{{ $href }}" class="action-btn action-btn-{{ $type }}" title="{{ $title }}">
        <i class="{{ $config['icon'] }}"></i>
    </a>
@endif

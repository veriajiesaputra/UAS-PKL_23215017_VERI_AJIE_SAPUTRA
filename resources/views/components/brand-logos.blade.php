@props([
    'size' => 'md',
    'href' => null,
    'light' => false,
])

@php
    $sizes = [
        'sm' => ['dpkp' => 32, 'sipatan' => 28, 'divider' => 28],
        'md' => ['dpkp' => 44, 'sipatan' => 38, 'divider' => 36],
        'lg' => ['dpkp' => 56, 'sipatan' => 48, 'divider' => 44],
    ];
    $s = $sizes[$size] ?? $sizes['md'];
@endphp

<div {{ $attributes->merge(['class' => 'brand-logos brand-logos-' . $size . ($light ? ' brand-logos-light' : '')]) }}>
    @if ($href)
        <a href="{{ $href }}" class="brand-logos-inner text-decoration-none">
    @else
        <div class="brand-logos-inner">
    @endif
        <img src="{{ asset('assets/images/logos/logo-dpkp-brebes.png') }}"
            alt="DPKP Kabupaten Brebes"
            class="brand-logo brand-logo-dpkp"
            height="{{ $s['dpkp'] }}"
            loading="lazy">
        <span class="brand-logos-divider" style="height: {{ $s['divider'] }}px" aria-hidden="true">|</span>
        <img src="{{ asset('assets/images/logos/logo-sipatan.png') }}"
            alt="SIPATAN"
            class="brand-logo brand-logo-sipatan"
            height="{{ $s['sipatan'] }}"
            loading="lazy">
    @if ($href)
        </a>
    @else
        </div>
    @endif
</div>

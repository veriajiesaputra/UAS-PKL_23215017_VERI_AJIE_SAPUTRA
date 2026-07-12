@props([
    'title',
    'value',
    'icon' => 'fa-solid fa-chart-bar',
    'color' => 'primary',
    'subtitle' => null,
])

<div class="card stat-card-admin p-4 bg-{{ $color }} bg-opacity-10 border border-{{ $color }} border-opacity-25 rounded-3 h-100 shadow-sm">
    <div class="d-flex align-items-center gap-3">
        <div class="stat-card-icon bg-{{ $color }} text-white rounded-3 shadow-sm">
            <i class="{{ $icon }}" aria-hidden="true"></i>
        </div>
        <div class="min-w-0">
            <h2 class="mb-1 fs-6 text-muted">{{ $title }}</h2>
            <h3 class="fw-bold mb-0 lh-1">{{ $value }}</h3>
            @if ($subtitle)
                <p class="text-{{ $color }} mb-0 small mt-2">{{ $subtitle }}</p>
            @endif
        </div>
    </div>
</div>

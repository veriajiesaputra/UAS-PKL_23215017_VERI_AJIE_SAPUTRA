@props([
    'title',
    'subtitle' => null,
    'breadcrumbs' => [],
])

<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
    <div>
        <h1 class="fs-3 mb-1">{{ $title }}</h1>
        @if ($subtitle)
            <p class="mb-0 text-muted">{{ $subtitle }}</p>
        @endif
        @if (! empty($breadcrumbs))
            <nav aria-label="breadcrumb" class="mt-2">
                <ol class="breadcrumb mb-0 small">
                    @foreach ($breadcrumbs as $label => $url)
                        @if ($loop->last)
                            <li class="breadcrumb-item active" aria-current="page">{{ $label }}</li>
                        @else
                            <li class="breadcrumb-item"><a href="{{ $url }}">{{ $label }}</a></li>
                        @endif
                    @endforeach
                </ol>
            </nav>
        @endif
    </div>

    @isset($actions)
        <div class="d-flex flex-wrap gap-2">
            {{ $actions }}
        </div>
    @endisset
</div>

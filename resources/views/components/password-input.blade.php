@props([
    'id' => 'password',
    'name' => 'password',
    'label' => 'Password',
    'autocomplete' => 'current-password',
    'required' => true,
])

<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <div class="input-group password-toggle-group">
        <input id="{{ $id }}"
            type="password"
            name="{{ $name }}"
            {{ $required ? 'required' : '' }}
            autocomplete="{{ $autocomplete }}"
            {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}>
        <button type="button"
            class="btn btn-outline-secondary password-toggle-btn"
            data-password-target="{{ $id }}"
            aria-label="Tampilkan password"
            title="Tampilkan password">
            <i class="ti ti-eye password-icon-show" aria-hidden="true"></i>
            <i class="ti ti-eye-off password-icon-hide d-none" aria-hidden="true"></i>
        </button>
    </div>
    @error($name)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>

@once
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelectorAll('.password-toggle-btn').forEach(function (btn) {
                    btn.addEventListener('click', function () {
                        const input = document.getElementById(btn.dataset.passwordTarget);
                        if (!input) return;

                        const showIcon = btn.querySelector('.password-icon-show');
                        const hideIcon = btn.querySelector('.password-icon-hide');
                        const isHidden = input.type === 'password';

                        input.type = isHidden ? 'text' : 'password';
                        showIcon.classList.toggle('d-none', isHidden);
                        hideIcon.classList.toggle('d-none', !isHidden);
                        btn.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Tampilkan password');
                        btn.setAttribute('title', isHidden ? 'Sembunyikan password' : 'Tampilkan password');
                    });
                });
            });
        </script>
    @endpush
@endonce

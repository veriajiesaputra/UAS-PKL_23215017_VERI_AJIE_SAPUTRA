@props([
    'user' => null,
    'isUpdate' => false,
])

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Nama <span class="text-danger">*</span></label>
        <input type="text" name="name"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $user?->name) }}" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Email <span class="text-danger">*</span></label>
        <input type="email" name="email"
            class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email', $user?->email) }}" required>
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Role <span class="text-danger">*</span></label>
        <select name="role"
            class="form-select @error('role') is-invalid @enderror" required>
            @php $roleVal = old('role', $user?->role ?? 'petugas'); @endphp
            <option value="pengguna" @selected($roleVal === 'pengguna')>Pengguna</option>
            <option value="petugas" @selected($roleVal === 'petugas')>Petugas</option>
            <option value="admin" @selected($roleVal === 'admin')>Admin</option>
        </select>
        @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">
            Password
            @if (! $isUpdate) <span class="text-danger">*</span> @endif
        </label>
        <input type="password" name="password"
            class="form-control @error('password') is-invalid @enderror"
            placeholder="{{ $isUpdate ? 'Kosongkan jika tidak diubah' : 'Minimal 8 karakter' }}"
            autocomplete="new-password"
            @if (! $isUpdate) required @endif>
        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Konfirmasi Password</label>
        <input type="password" name="password_confirmation"
            class="form-control"
            placeholder="Ulangi password"
            autocomplete="new-password">
    </div>
</div>

<x-owner-layout title="Edit Akun">

    <div class="bf-card bf-card--form">
        <div class="bf-card-header">
            <h2 class="bf-card-title">Edit Akun</h2>
            <a href="{{ route('owner.akun.index') }}" class="bf-btn bf-btn--secondary">← Kembali</a>
        </div>

        <form action="{{ route('owner.akun.update', $akun) }}" method="POST" class="bf-form">
            @csrf
            @method('PUT')

            <div class="bf-form-group">
                <label for="username" class="bf-label">Username <span class="bf-required">*</span></label>
                <input type="text" id="username" name="username"
                    value="{{ old('username', $akun->username) }}"
                    class="bf-input {{ $errors->has('username') ? 'bf-input--error' : '' }}">
                @error('username')
                    <p class="bf-input-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="bf-form-group">
                <label for="email" class="bf-label">Email <span class="bf-required">*</span></label>
                <input type="email" id="email" name="email"
                    value="{{ old('email', $akun->email) }}"
                    class="bf-input {{ $errors->has('email') ? 'bf-input--error' : '' }}">
                @error('email')
                    <p class="bf-input-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="bf-form-group">
                <label for="role" class="bf-label">Role <span class="bf-required">*</span></label>
                <select id="role" name="role" class="bf-input bf-select {{ $errors->has('role') ? 'bf-input--error' : '' }}">
                    <option value="Owner" {{ old('role', $akun->role) === 'Owner' ? 'selected' : '' }}>Owner</option>
                    <option value="Capster" {{ old('role', $akun->role) === 'Capster' ? 'selected' : '' }}>Capster</option>
                </select>
                @error('role')
                    <p class="bf-input-error">{{ $message }}</p>
                @enderror
            </div>

            <hr class="bf-form-divider">
            <p class="bf-input-hint">Kosongkan password jika tidak ingin mengubahnya.</p>

            <div class="bf-form-group">
                <label for="password" class="bf-label">Password Baru</label>
                <input type="password" id="password" name="password"
                    placeholder="Kosongkan jika tidak diubah..." class="bf-input {{ $errors->has('password') ? 'bf-input--error' : '' }}">
                @error('password')
                    <p class="bf-input-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="bf-form-group">
                <label for="password_confirmation" class="bf-label">Konfirmasi Password Baru</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    placeholder="Ulangi password baru..." class="bf-input">
            </div>

            <div class="bf-form-actions">
                <button type="submit" class="bf-btn bf-btn--primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
                    </svg>
                    Simpan Perubahan
                </button>
                <a href="{{ route('owner.akun.index') }}" class="bf-btn bf-btn--secondary">Batal</a>
            </div>
        </form>
    </div>

</x-owner-layout>

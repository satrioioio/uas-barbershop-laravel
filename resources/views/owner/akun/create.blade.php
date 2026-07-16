<x-owner-layout title="Tambah Akun">

    <div class="bf-card bf-card--form">
        <div class="bf-card-header">
            <h2 class="bf-card-title">Tambah Akun Baru</h2>
            <a href="{{ route('owner.akun.index') }}" class="bf-btn bf-btn--secondary">← Kembali</a>
        </div>

        <form action="{{ route('owner.akun.store') }}" method="POST" class="bf-form">
            @csrf

            <div class="bf-form-group">
                <label for="username" class="bf-label">Username <span class="bf-required">*</span></label>
                <input type="text" id="username" name="username" value="{{ old('username') }}"
                    placeholder="Masukkan username..." class="bf-input {{ $errors->has('username') ? 'bf-input--error' : '' }}">
                @error('username')
                    <p class="bf-input-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="bf-form-group">
                <label for="email" class="bf-label">Email <span class="bf-required">*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    placeholder="Masukkan email..." class="bf-input {{ $errors->has('email') ? 'bf-input--error' : '' }}">
                @error('email')
                    <p class="bf-input-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="bf-form-group">
                <label for="role" class="bf-label">Role <span class="bf-required">*</span></label>
                <select id="role" name="role" class="bf-input bf-select {{ $errors->has('role') ? 'bf-input--error' : '' }}">
                    <option value="">— Pilih Role —</option>
                    <option value="Owner" {{ old('role') === 'Owner' ? 'selected' : '' }}>Owner</option>
                    <option value="Capster" {{ old('role') === 'Capster' ? 'selected' : '' }}>Capster</option>
                </select>
                @error('role')
                    <p class="bf-input-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="bf-form-group">
                <label for="password" class="bf-label">Password <span class="bf-required">*</span></label>
                <input type="password" id="password" name="password"
                    placeholder="Minimal 8 karakter..." class="bf-input {{ $errors->has('password') ? 'bf-input--error' : '' }}">
                @error('password')
                    <p class="bf-input-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="bf-form-group">
                <label for="password_confirmation" class="bf-label">Konfirmasi Password <span class="bf-required">*</span></label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    placeholder="Ulangi password..." class="bf-input">
            </div>

            <div class="bf-form-actions">
                <button type="submit" class="bf-btn bf-btn--primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
                    </svg>
                    Simpan Akun
                </button>
                <a href="{{ route('owner.akun.index') }}" class="bf-btn bf-btn--secondary">Batal</a>
            </div>
        </form>
    </div>

</x-owner-layout>

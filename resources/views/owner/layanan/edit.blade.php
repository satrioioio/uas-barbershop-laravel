<x-owner-layout title="Edit Layanan">

    <div class="bf-card bf-card--form">
        <div class="bf-card-header">
            <h2 class="bf-card-title">Edit Layanan</h2>
            <a href="{{ route('owner.layanan.index') }}" class="bf-btn bf-btn--secondary">← Kembali</a>
        </div>

        <form action="{{ route('owner.layanan.update', $layanan) }}" method="POST" class="bf-form">
            @csrf
            @method('PUT')

            <div class="bf-form-group">
                <label class="bf-label">ID Layanan</label>
                <input type="text" value="{{ $layanan->id_layanan }}" class="bf-input bf-input--disabled" disabled>
                <p class="bf-input-hint">ID tidak dapat diubah</p>
            </div>

            <div class="bf-form-group">
                <label for="nama_layanan" class="bf-label">Nama Layanan <span class="bf-required">*</span></label>
                <input
                    type="text"
                    id="nama_layanan"
                    name="nama_layanan"
                    value="{{ old('nama_layanan', $layanan->nama_layanan) }}"
                    class="bf-input {{ $errors->has('nama_layanan') ? 'bf-input--error' : '' }}"
                >
                @error('nama_layanan')
                    <p class="bf-input-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="bf-form-group">
                <label for="harga" class="bf-label">Harga (Rp) <span class="bf-required">*</span></label>
                <input
                    type="number"
                    id="harga"
                    name="harga"
                    value="{{ old('harga', $layanan->harga) }}"
                    min="0"
                    class="bf-input {{ $errors->has('harga') ? 'bf-input--error' : '' }}"
                >
                @error('harga')
                    <p class="bf-input-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="bf-form-actions">
                <button type="submit" class="bf-btn bf-btn--primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
                    </svg>
                    Simpan Perubahan
                </button>
                <a href="{{ route('owner.layanan.index') }}" class="bf-btn bf-btn--secondary">Batal</a>
            </div>
        </form>
    </div>

</x-owner-layout>

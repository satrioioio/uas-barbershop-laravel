<x-capster-layout title="Input Transaksi">

    <div class="bf-capster-wrapper">
        <div class="bf-capster-form-card">

            <!-- Card Header -->
            <div class="bf-capster-form-header">
                <div class="bf-capster-form-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/>
                        <path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/>
                    </svg>
                </div>
                <div>
                    <h1 class="bf-capster-form-title">Input Transaksi</h1>
                    <p class="bf-capster-form-sub">{{ now()->format('l, d F Y') }}</p>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('capster.store') }}" method="POST" enctype="multipart/form-data" class="bf-capster-form" id="transaksi-form">
                @csrf

                <!-- Pilih Layanan -->
                <div class="bf-form-group">
                    <label for="id_layanan" class="bf-label">Pilih Layanan <span class="bf-required">*</span></label>
                    <select id="id_layanan" name="id_layanan" class="bf-input bf-select bf-capster-select {{ $errors->has('id_layanan') ? 'bf-input--error' : '' }}" required>
                        <option value="">— Pilih Layanan —</option>
                        @foreach($layanans as $layanan)
                        <option value="{{ $layanan->id_layanan }}"
                            data-harga="{{ $layanan->harga }}"
                            {{ old('id_layanan') === $layanan->id_layanan ? 'selected' : '' }}>
                            {{ $layanan->nama_layanan }} — Rp {{ number_format($layanan->harga, 0, ',', '.') }}
                        </option>
                        @endforeach
                    </select>
                    @error('id_layanan')
                        <p class="bf-input-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Preview Harga -->
                <div id="harga-preview" class="bf-capster-harga-preview" style="display:none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    Harga: <strong id="harga-text">Rp 0</strong>
                </div>

                <!-- Metode Pembayaran -->
                <div class="bf-form-group">
                    <label class="bf-label">Metode Pembayaran <span class="bf-required">*</span></label>
                    <div class="bf-payment-options">
                        <label class="bf-payment-option {{ old('metode_pembayaran') === 'Tunai' ? 'bf-payment-option--selected' : '' }}" id="label-tunai">
                            <input type="radio" name="metode_pembayaran" value="Tunai"
                                {{ old('metode_pembayaran') === 'Tunai' ? 'checked' : '' }}
                                class="bf-payment-radio" onchange="handleMetode(this)">
                            <span class="bf-payment-icon">💵</span>
                            <span class="bf-payment-label">Tunai</span>
                        </label>
                        <label class="bf-payment-option {{ old('metode_pembayaran') === 'QRIS' ? 'bf-payment-option--selected' : '' }}" id="label-qris">
                            <input type="radio" name="metode_pembayaran" value="QRIS"
                                {{ old('metode_pembayaran') === 'QRIS' ? 'checked' : '' }}
                                class="bf-payment-radio" onchange="handleMetode(this)">
                            <span class="bf-payment-icon">📱</span>
                            <span class="bf-payment-label">QRIS</span>
                        </label>
                    </div>
                    @error('metode_pembayaran')
                        <p class="bf-input-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Upload Bukti QRIS (muncul hanya jika QRIS dipilih) -->
                <div id="qris-upload" class="{{ old('metode_pembayaran') === 'QRIS' ? '' : 'bf-hidden' }}">
                    <div class="bf-form-group">
                        <label for="bukti_foto_qris" class="bf-label">Bukti Foto QRIS <span class="bf-required">*</span></label>
                        <div class="bf-upload-area" id="upload-area" onclick="document.getElementById('bukti_foto_qris').click()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="18" x="3" y="3" rx="2" ry="2"/>
                                <circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>
                            </svg>
                            <p class="bf-upload-text">Klik untuk upload foto bukti QRIS</p>
                            <p class="bf-upload-hint">JPG, PNG, max 2MB</p>
                            <img id="preview-img" src="" alt="preview" class="bf-upload-preview bf-hidden">
                        </div>
                        <input type="file" id="bukti_foto_qris" name="bukti_foto_qris"
                            accept="image/*" class="bf-hidden" onchange="previewImage(this)">
                        @error('bukti_foto_qris')
                            <p class="bf-input-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit -->
                <button type="submit" class="bf-btn bf-btn--primary bf-btn--full" id="submit-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                    Simpan Transaksi
                </button>
            </form>
        </div>
    </div>

    <script>
        // Show/hide harga preview when layanan selected
        document.getElementById('id_layanan').addEventListener('change', function() {
            const selected = this.options[this.selectedIndex];
            const preview = document.getElementById('harga-preview');
            if (this.value) {
                const harga = parseInt(selected.dataset.harga);
                document.getElementById('harga-text').textContent = 'Rp ' + harga.toLocaleString('id-ID');
                preview.style.display = 'flex';
            } else {
                preview.style.display = 'none';
            }
        });

        // Show/hide QRIS upload section
        function handleMetode(radio) {
            const qrisUpload = document.getElementById('qris-upload');
            document.querySelectorAll('.bf-payment-option').forEach(el => el.classList.remove('bf-payment-option--selected'));
            radio.closest('.bf-payment-option').classList.add('bf-payment-option--selected');

            if (radio.value === 'QRIS') {
                qrisUpload.classList.remove('bf-hidden');
            } else {
                qrisUpload.classList.add('bf-hidden');
                document.getElementById('bukti_foto_qris').value = '';
                document.getElementById('preview-img').classList.add('bf-hidden');
            }
        }

        // Preview uploaded image
        function previewImage(input) {
            const preview = document.getElementById('preview-img');
            const uploadArea = document.getElementById('upload-area');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    preview.src = e.target.result;
                    preview.classList.remove('bf-hidden');
                    uploadArea.querySelector('svg').style.display = 'none';
                    uploadArea.querySelector('.bf-upload-text').style.display = 'none';
                    uploadArea.querySelector('.bf-upload-hint').style.display = 'none';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Trigger harga preview on page load if old value exists
        const layananSelect = document.getElementById('id_layanan');
        if (layananSelect.value) {
            layananSelect.dispatchEvent(new Event('change'));
        }
    </script>

</x-capster-layout>

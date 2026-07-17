<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Struk Transaksi — BarberFlow</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Courier+Prime:wght@400;700&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bf-struk-body">

    <!-- Tombol Aksi (tidak tampil saat print) -->
    <div class="bf-struk-actions bf-no-print">
        <a href="{{ route('capster.transaksi') }}" class="bf-btn bf-btn--secondary">
            ← Input Transaksi Baru
        </a>
        <button onclick="window.print()" class="bf-btn bf-btn--primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="6 9 6 2 18 2 18 9" />
                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
                <rect width="12" height="8" x="6" y="14" />
            </svg>
            Cetak Struk
        </button>
    </div>

    <!-- STRUK / RECEIPT -->
    <div class="bf-struk" id="struk-area">

        <!-- Header Struk -->
        <div class="bf-struk-header">
            <img src="{{ asset('images/logo.png') }}" alt="BarberFlow" class="bf-struk-logo">
            <h1 class="bf-struk-nama">BarberFlow</h1>
            <p class="bf-struk-tagline">Professional Barbershop</p>
            <div class="bf-struk-garis">================================</div>
        </div>

        <!-- Info Transaksi -->
        <div class="bf-struk-body">
            <div class="bf-struk-row">
                <span>No. Transaksi</span>
                <span>#{{ str_pad($transaksi->id_transaksi, 6, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="bf-struk-row">
                <span>Waktu</span>
                <span>{{ $transaksi->waktu_transaksi->format('d/m/Y H:i') }}</span>
            </div>
            <div class="bf-struk-row">
                <span>Capster</span>
                <span>{{ $transaksi->user?->username }}</span>
            </div>

            <div class="bf-struk-separator">--------------------------------</div>

            <div class="bf-struk-row">
                <span>Layanan</span>
                <span>{{ $transaksi->layanan?->nama_layanan }}</span>
            </div>
            <div class="bf-struk-row">
                <span>Harga</span>
                <span>Rp {{ number_format($transaksi->layanan?->harga ?? 0, 0, ',', '.') }}</span>
            </div>
            <div class="bf-struk-row">
                <span>Metode Bayar</span>
                <span>{{ $transaksi->metode_pembayaran }}</span>
            </div>

            @if ($transaksi->bukti_foto_qris)
                <div class="bf-struk-qris bf-no-print">
                    <p class="bf-struk-qris-label">Bukti Transaksi QRIS:</p>
                    <!-- Tombol untuk memicu Modal -->
                    <button type="button" onclick="document.getElementById('qrisModal').style.display='flex'"
                        class="bf-btn-view-qris">
                        Lihat Bukti Pembayaran
                    </button>
                </div>

                <!-- Struktur Modal Pop-up -->
                <div id="qrisModal" class="bf-modal bf-no-print" style="display: none;">
                    <div class="bf-modal-content">
                        <div class="bf-modal-header">
                            <h3>Bukti QRIS</h3>
                            <button onclick="document.getElementById('qrisModal').style.display='none'"
                                class="bf-modal-close">&times;</button>
                        </div>
                        <div class="bf-modal-body">
                            <img src="{{ Storage::url($transaksi->bukti_foto_qris) }}" alt="Bukti Pembayaran QRIS">
                        </div>
                    </div>
                </div>
            @endif

            <div class="bf-struk-separator">--------------------------------</div>

            <div class="bf-struk-row bf-struk-total">
                <span>TOTAL</span>
                <span>Rp {{ number_format($transaksi->layanan?->harga ?? 0, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Footer Struk -->
        <div class="bf-struk-footer">
            <div class="bf-struk-garis">================================</div>
            <p>Terima kasih sudah berkunjung!</p>
            <p>Sampai jumpa lagi 😊</p>
            <p class="bf-struk-powered">BarberFlow Management System</p>
        </div>

    </div>

</body>

</html>

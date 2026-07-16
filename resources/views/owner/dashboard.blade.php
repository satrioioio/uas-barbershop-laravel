<x-owner-layout title="Dashboard">

    <!-- Stat Cards -->
    <div class="bf-stats-grid">
        <div class="bf-stat-card bf-stat-card--blue">
            <div class="bf-stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20.38 3.46 16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.47a1 1 0 0 0 .99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2V9.54h2.15a1 1 0 0 0 .99-.84l.58-3.47a2 2 0 0 0-1.34-2.23z"/>
                </svg>
            </div>
            <div class="bf-stat-info">
                <p class="bf-stat-label">Total Layanan</p>
                <p class="bf-stat-value">{{ $totalLayanan }}</p>
            </div>
        </div>

        <div class="bf-stat-card bf-stat-card--teal">
            <div class="bf-stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/>
                    <path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/>
                </svg>
            </div>
            <div class="bf-stat-info">
                <p class="bf-stat-label">Total Transaksi</p>
                <p class="bf-stat-value">{{ $totalTransaksi }}</p>
            </div>
        </div>

        <div class="bf-stat-card bf-stat-card--orange">
            <div class="bf-stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                    <line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/>
                    <line x1="3" x2="21" y1="10" y2="10"/>
                    <path d="M8 14h.01"/><path d="M12 14h.01"/><path d="M16 14h.01"/>
                </svg>
            </div>
            <div class="bf-stat-info">
                <p class="bf-stat-label">Transaksi Hari Ini</p>
                <p class="bf-stat-value">{{ $transaksiHariIni }}</p>
            </div>
        </div>

        <div class="bf-stat-card bf-stat-card--green">
            <div class="bf-stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" x2="12" y1="2" y2="22"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
                </svg>
            </div>
            <div class="bf-stat-info">
                <p class="bf-stat-label">Total Pendapatan</p>
                <p class="bf-stat-value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <!-- Tables Row -->
    <div class="bf-tables-grid">

        <!-- Layanan Terbaru -->
        <div class="bf-card">
            <div class="bf-card-header">
                <h2 class="bf-card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.38 3.46 16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.47a1 1 0 0 0 .99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2V9.54h2.15a1 1 0 0 0 .99-.84l.58-3.47a2 2 0 0 0-1.34-2.23z"/>
                    </svg>
                    Layanan Terbaru
                </h2>
                <a href="{{ route('owner.layanan.index') }}" class="bf-card-link">Lihat Semua →</a>
            </div>
            <div class="bf-table-wrapper">
                <table class="bf-table">
                    <thead>
                        <tr>
                            <th>Nama Layanan</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($layananTerbaru as $layanan)
                        <tr>
                            <td>{{ $layanan->nama_layanan }}</td>
                            <td>Rp {{ number_format($layanan->harga, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="bf-table-empty">Belum ada layanan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Transaksi Terbaru -->
        <div class="bf-card">
            <div class="bf-card-header">
                <h2 class="bf-card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/>
                        <path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/>
                    </svg>
                    Transaksi Terbaru
                </h2>
                <a href="{{ route('owner.transaksi') }}" class="bf-card-link">Lihat Semua →</a>
            </div>
            <div class="bf-table-wrapper">
                <table class="bf-table">
                    <thead>
                        <tr>
                            <th>Capster</th>
                            <th>Layanan</th>
                            <th>Metode</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksiTerbaru as $trx)
                        <tr>
                            <td>{{ $trx->user?->username ?? '-' }}</td>
                            <td>{{ $trx->layanan?->nama_layanan ?? '-' }}</td>
                            <td>
                                <span class="bf-badge {{ $trx->metode_pembayaran === 'QRIS' ? 'bf-badge--blue' : 'bf-badge--green' }}">
                                    {{ $trx->metode_pembayaran }}
                                </span>
                            </td>
                            <td>{{ $trx->waktu_transaksi->format('d/m/Y H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="bf-table-empty">Belum ada transaksi</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</x-owner-layout>

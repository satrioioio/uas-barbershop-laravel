<x-owner-layout title="Data Transaksi">

    {{-- ===== AREA YANG BISA DICETAK ===== --}}
    <div id="print-area">

        {{-- Header khusus print (tidak muncul di layar) --}}
        <div class="bf-print-header">
            <h1 class="bf-print-title">BarberFlow</h1>
            <p class="bf-print-subtitle">Laporan Data Transaksi</p>
            @if(request('dari_tanggal') || request('sampai_tanggal'))
            <p class="bf-print-period">
                Periode:
                {{ request('dari_tanggal') ? \Carbon\Carbon::parse(request('dari_tanggal'))->format('d/m/Y') : '...' }}
                s/d
                {{ request('sampai_tanggal') ? \Carbon\Carbon::parse(request('sampai_tanggal'))->format('d/m/Y') : \Carbon\Carbon::now()->format('d/m/Y') }}
            </p>
            @else
            <p class="bf-print-period">Semua Transaksi (Cetak: {{ now()->format('d/m/Y H:i') }})</p>
            @endif
        </div>

        {{-- ===== FILTER & TOMBOL CETAK (layar saja) ===== --}}
        <div class="bf-no-print">
            <div class="bf-card bf-card--mb">
                <div class="bf-card-header">
                    <h2 class="bf-card-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"/></svg>
                        Filter Tanggal
                    </h2>
                    <button onclick="window.print()" class="bf-btn bf-btn--print">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/>
                            <rect width="12" height="8" x="6" y="14"/>
                        </svg>
                        Cetak / Export
                    </button>
                </div>
                <form action="{{ route('owner.transaksi') }}" method="GET" class="bf-filter-form">
                    <div class="bf-filter-group">
                        <label class="bf-label">Dari Tanggal</label>
                        <input type="date" name="dari_tanggal" value="{{ request('dari_tanggal') }}" class="bf-input">
                    </div>
                    <div class="bf-filter-group">
                        <label class="bf-label">Sampai Tanggal</label>
                        <input type="date" name="sampai_tanggal" value="{{ request('sampai_tanggal') }}" class="bf-input">
                    </div>
                    <div class="bf-filter-actions">
                        <button type="submit" class="bf-btn bf-btn--primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                            Cari
                        </button>
                        <a href="{{ route('owner.transaksi') }}" class="bf-btn bf-btn--secondary">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Ringkasan pendapatan periode --}}
        <div class="bf-summary-row">
            <div class="bf-summary-chip bf-summary-chip--blue">
                <span>Total Transaksi</span>
                <strong>{{ $totalTransaksiFilter }}</strong>
            </div>
            <div class="bf-summary-chip bf-summary-chip--green">
                <span>Total Pendapatan</span>
                <strong>Rp {{ number_format($totalPendapatanFilter, 0, ',', '.') }}</strong>
            </div>
        </div>

        {{-- ===== TABEL TRANSAKSI ===== --}}
        <div class="bf-card bf-card--mb">
            <div class="bf-card-header">
                <h2 class="bf-card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/></svg>
                    Daftar Transaksi
                </h2>
                <span class="bf-card-badge">{{ $transaksis->total() }} transaksi</span>
            </div>

            <div class="bf-table-wrapper">
                <table class="bf-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Capster</th>
                            <th>Layanan</th>
                            <th>Harga</th>
                            <th>Metode Bayar</th>
                            <th>Waktu Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksis as $index => $trx)
                        <tr>
                            <td>{{ $transaksis->firstItem() + $index }}</td>
                            <td>{{ $trx->user?->username ?? '-' }}</td>
                            <td>{{ $trx->layanan?->nama_layanan ?? '-' }}</td>
                            <td>Rp {{ number_format($trx->layanan?->harga ?? 0, 0, ',', '.') }}</td>
                            <td>
                                <span class="bf-badge {{ $trx->metode_pembayaran === 'QRIS' ? 'bf-badge--blue' : 'bf-badge--green' }}">
                                    {{ $trx->metode_pembayaran }}
                                </span>
                            </td>
                            <td>{{ $trx->waktu_transaksi->format('d/m/Y H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="bf-table-empty">Belum ada data transaksi</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($transaksis->hasPages())
            <div class="bf-pagination bf-no-print">
                {{ $transaksis->links() }}
            </div>
            @endif
        </div>

        {{-- ===== RINGKASAN PER CAPSTER ===== --}}
        @if($ringkasanPerCapster->count() > 0)
        <div class="bf-card">
            <div class="bf-card-header">
                <h2 class="bf-card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    Ringkasan per Capster
                </h2>
            </div>
            <div class="bf-table-wrapper">
                <table class="bf-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Capster</th>
                            <th>Total Customer</th>
                            <th>Total Pendapatan</th>
                            <th>Rata-rata per Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ringkasanPerCapster as $i => $capster)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>
                                <div class="bf-user-cell">
                                    <div class="bf-user-avatar-sm">{{ strtoupper(substr($capster->username, 0, 1)) }}</div>
                                    {{ $capster->username }}
                                </div>
                            </td>
                            <td><strong>{{ $capster->total_customer }}</strong> customer</td>
                            <td><strong>Rp {{ number_format($capster->total_pendapatan, 0, ',', '.') }}</strong></td>
                            <td>Rp {{ number_format($capster->total_customer > 0 ? $capster->total_pendapatan / $capster->total_customer : 0, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    {{-- GRAND TOTAL --}}
                    <tfoot>
                        <tr class="bf-table-total">
                            <td colspan="2"><strong>TOTAL KESELURUHAN</strong></td>
                            <td><strong>{{ $totalTransaksiFilter }} customer</strong></td>
                            <td><strong>Rp {{ number_format($totalPendapatanFilter, 0, ',', '.') }}</strong></td>
                            <td><strong>Rp {{ number_format($totalTransaksiFilter > 0 ? $totalPendapatanFilter / $totalTransaksiFilter : 0, 0, ',', '.') }}</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        @endif

        {{-- Footer print --}}
        <div class="bf-print-footer">
            <p>Dicetak pada: {{ now()->format('d/m/Y H:i') }} &nbsp;|&nbsp; BarberFlow Management System</p>
        </div>

    </div>{{-- end #print-area --}}

</x-owner-layout>

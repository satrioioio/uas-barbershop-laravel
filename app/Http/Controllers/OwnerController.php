<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    /**
     * Halaman Dashboard Owner.
     * Menampilkan statistik dan data terbaru.
     */
    public function dashboard()
    {
        $totalLayanan     = Layanan::count();
        $totalTransaksi   = Transaksi::count();
        $transaksiHariIni = Transaksi::whereDate('waktu_transaksi', today())->count();

        // Total pendapatan: jumlah harga layanan dari semua transaksi
        $totalPendapatan = Transaksi::join('layanans', 'transaksis.id_layanan', '=', 'layanans.id_layanan')
            ->sum('layanans.harga');

        // 5 layanan terbaru
        $layananTerbaru = Layanan::latest()->take(5)->get();

        // 5 transaksi terbaru beserta data capster dan layanan
        $transaksiTerbaru = Transaksi::with(['user', 'layanan'])
            ->latest('waktu_transaksi')
            ->take(5)
            ->get();

        return view('owner.dashboard', compact(
            'totalLayanan',
            'totalTransaksi',
            'transaksiHariIni',
            'totalPendapatan',
            'layananTerbaru',
            'transaksiTerbaru'
        ));
    }

    /**
     * Halaman Data Transaksi dengan filter tanggal.
     * Termasuk ringkasan per capster dan cetak struk.
     */
    public function transaksi(Request $request)
    {
        $baseQuery = fn() => Transaksi::join('layanans', 'transaksis.id_layanan', '=', 'layanans.id_layanan')
            ->when($request->filled('dari_tanggal'), fn($q) => $q->whereDate('waktu_transaksi', '>=', $request->dari_tanggal))
            ->when($request->filled('sampai_tanggal'), fn($q) => $q->whereDate('waktu_transaksi', '<=', $request->sampai_tanggal));

        $query = Transaksi::with(['user', 'layanan'])->latest('waktu_transaksi')
            ->when($request->filled('dari_tanggal'), fn($q) => $q->whereDate('waktu_transaksi', '>=', $request->dari_tanggal))
            ->when($request->filled('sampai_tanggal'), fn($q) => $q->whereDate('waktu_transaksi', '<=', $request->sampai_tanggal));

        $transaksis = $query->paginate(10)->withQueryString();

        // Total pendapatan keseluruhan dari hasil filter
        $totalPendapatanFilter = $baseQuery()->sum('layanans.harga');
        $totalTransaksiFilter  = $baseQuery()->count();

        // Ringkasan per capster: jumlah customer & total pendapatan
        $ringkasanPerCapster = $baseQuery()
            ->selectRaw('transaksis.id_user, users.username, COUNT(*) as total_customer, SUM(layanans.harga) as total_pendapatan')
            ->join('users', 'transaksis.id_user', '=', 'users.id_user')
            ->groupBy('transaksis.id_user', 'users.username')
            ->orderByDesc('total_pendapatan')
            ->get();

        return view('owner.transaksi', compact(
            'transaksis',
            'totalPendapatanFilter',
            'totalTransaksiFilter',
            'ringkasanPerCapster'
        ));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CapsterController extends Controller
{
    /**
     * Tampilkan form input transaksi.
     */
    public function transaksi(): View
    {
        $layanans = Layanan::orderBy('nama_layanan')->get();
        return view('capster.transaksi', compact('layanans'));
    }

    /**
     * Simpan transaksi baru dan redirect ke struk.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'id_layanan'        => ['required', 'exists:layanans,id_layanan'],
            'metode_pembayaran' => ['required', 'in:Tunai,QRIS'],
            'bukti_foto_qris'   => ['nullable', 'required_if:metode_pembayaran,QRIS', 'image', 'max:2048'],
        ], [
            'bukti_foto_qris.required_if' => 'Bukti foto QRIS wajib diupload jika memilih metode QRIS.',
        ]);

        $buktiPath = null;

        // Upload bukti QRIS jika ada
        if ($request->hasFile('bukti_foto_qris')) {
            $buktiPath = $request->file('bukti_foto_qris')->store('qris', 'public');
        }

        $transaksi = Transaksi::create([
            'id_user'           => Auth::user()->id_user,
            'id_layanan'        => $request->id_layanan,
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_foto_qris'   => $buktiPath,
            'waktu_transaksi'   => now(),
        ]);

        return redirect()->route('capster.struk', $transaksi->id_transaksi);
    }

    /**
     * Tampilkan struk transaksi.
     */
    public function struk(int $id): View
    {
        $transaksi = Transaksi::with(['layanan', 'user'])->findOrFail($id);

        // Perbaikan: Gunakan != atau paksa menjadi (int) agar tipe data string/integer tidak bentrok
        if ((int)$transaksi->id_user !== (int)Auth::user()->id_user) {
            abort(403);
        }

        return view('capster.struk', compact('transaksi'));
    }
}

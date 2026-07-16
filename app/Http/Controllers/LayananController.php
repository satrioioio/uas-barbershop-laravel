<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LayananController extends Controller
{
    /**
     * Tampilkan semua layanan.
     */
    public function index(): View
    {
        $layanans = Layanan::latest()->paginate(10);
        return view('owner.layanan.index', compact('layanans'));
    }

    /**
     * Tampilkan form tambah layanan.
     */
    public function create(): View
    {
        return view('owner.layanan.create');
    }

    /**
     * Simpan layanan baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_layanan' => ['required', 'string', 'max:50'],
            'harga'        => ['required', 'integer', 'min:0'],
        ]);

        Layanan::create([
            'id_layanan'   => Layanan::generateId(),
            'nama_layanan' => $request->nama_layanan,
            'harga'        => $request->harga,
        ]);

        return redirect()->route('owner.layanan.index')
            ->with('success', 'Layanan berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit layanan.
     */
    public function edit(Layanan $layanan): View
    {
        return view('owner.layanan.edit', compact('layanan'));
    }

    /**
     * Update layanan di database.
     */
    public function update(Request $request, Layanan $layanan): RedirectResponse
    {
        $request->validate([
            'nama_layanan' => ['required', 'string', 'max:50'],
            'harga'        => ['required', 'integer', 'min:0'],
        ]);

        $layanan->update([
            'nama_layanan' => $request->nama_layanan,
            'harga'        => $request->harga,
        ]);

        return redirect()->route('owner.layanan.index')
            ->with('success', 'Layanan berhasil diperbarui!');
    }

    /**
     * Hapus layanan dari database.
     */
    public function destroy(Layanan $layanan): RedirectResponse
    {
        // Cek apakah layanan masih dipakai di transaksi
        if ($layanan->transaksis()->count() > 0) {
            return redirect()->route('owner.layanan.index')
                ->with('error', 'Layanan tidak bisa dihapus karena masih ada transaksi terkait!');
        }

        $layanan->delete();

        return redirect()->route('owner.layanan.index')
            ->with('success', 'Layanan berhasil dihapus!');
    }
}

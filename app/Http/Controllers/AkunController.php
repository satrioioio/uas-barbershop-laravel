<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class AkunController extends Controller
{
    /**
     * Tampilkan semua akun.
     */
    public function index(): View
    {
        $akuns = User::latest()->paginate(10);
        return view('owner.akun.index', compact('akuns'));
    }

    /**
     * Tampilkan form tambah akun.
     */
    public function create(): View
    {
        return view('owner.akun.create');
    }

    /**
     * Simpan akun baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'max:50', 'unique:users'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role'     => ['required', 'in:Owner,Capster'],
        ]);

        User::create([
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('owner.akun.index')
            ->with('success', 'Akun berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit akun.
     */
    public function edit(User $akun): View
    {
        return view('owner.akun.edit', compact('akun'));
    }

    /**
     * Update akun di database.
     */
    public function update(Request $request, User $akun): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'max:50', 'unique:users,username,' . $akun->id_user . ',id_user'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $akun->id_user . ',id_user'],
            'role'     => ['required', 'in:Owner,Capster'],
        ]);

        $akun->update([
            'username' => $request->username,
            'email'    => $request->email,
            'role'     => $request->role,
        ]);

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $request->validate([
                'password' => ['confirmed', Rules\Password::defaults()],
            ]);
            $akun->update(['password' => Hash::make($request->password)]);
        }

        return redirect()->route('owner.akun.index')
            ->with('success', 'Akun berhasil diperbarui!');
    }

    /**
     * Hapus akun dari database.
     */
    public function destroy(User $akun): RedirectResponse
    {
        // Tidak bisa hapus akun sendiri
        if ($akun->id_user === Auth::user()->id_user) {
            return redirect()->route('owner.akun.index')
                ->with('error', 'Anda tidak bisa menghapus akun Anda sendiri!');
        }

        $akun->delete();

        return redirect()->route('owner.akun.index')
            ->with('success', 'Akun berhasil dihapus!');
    }
}

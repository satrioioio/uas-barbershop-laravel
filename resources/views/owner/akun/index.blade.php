<x-owner-layout title="Data Akun">

    <div class="bf-card">
        <div class="bf-card-header">
            <h2 class="bf-card-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
                Daftar Akun
            </h2>
            <a href="{{ route('owner.akun.create') }}" class="bf-btn bf-btn--primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"/><path d="M12 5v14"/>
                </svg>
                Tambah Akun
            </a>
        </div>

        <div class="bf-table-wrapper">
            <table class="bf-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($akuns as $index => $akun)
                    <tr>
                        <td>{{ $akuns->firstItem() + $index }}</td>
                        <td>
                            <div class="bf-user-cell">
                                <div class="bf-user-avatar-sm">{{ strtoupper(substr($akun->username, 0, 1)) }}</div>
                                {{ $akun->username }}
                                @if($akun->id_user === auth()->user()->id_user)
                                    <span class="bf-badge bf-badge--gray">Anda</span>
                                @endif
                            </div>
                        </td>
                        <td>{{ $akun->email }}</td>
                        <td>
                            <span class="bf-badge {{ $akun->role === 'Owner' ? 'bf-badge--blue' : 'bf-badge--green' }}">
                                {{ $akun->role }}
                            </span>
                        </td>
                        <td>{{ $akun->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="bf-action-btns">
                                <a href="{{ route('owner.akun.edit', $akun) }}" class="bf-btn-icon bf-btn-icon--edit" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                    Edit
                                </a>
                                @if($akun->id_user !== auth()->user()->id_user)
                                <form action="{{ route('owner.akun.destroy', $akun) }}" method="POST"
                                      onsubmit="return confirm('Hapus akun \'{{ $akun->username }}\'?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bf-btn-icon bf-btn-icon--delete" title="Hapus">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"/><path d="m19 6-.867 12.142A2 2 0 0 1 16.138 20H7.862a2 2 0 0 1-1.995-1.858L5 6m5 0V4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="bf-table-empty">Belum ada akun terdaftar</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($akuns->hasPages())
        <div class="bf-pagination">
            {{ $akuns->links() }}
        </div>
        @endif
    </div>

</x-owner-layout>

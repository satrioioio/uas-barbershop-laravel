<x-owner-layout title="Data Layanan">

    <div class="bf-card">
        <div class="bf-card-header">
            <h2 class="bf-card-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20.38 3.46 16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.47a1 1 0 0 0 .99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2V9.54h2.15a1 1 0 0 0 .99-.84l.58-3.47a2 2 0 0 0-1.34-2.23z"/>
                </svg>
                Daftar Layanan
            </h2>
            <a href="{{ route('owner.layanan.create') }}" class="bf-btn bf-btn--primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"/><path d="M12 5v14"/>
                </svg>
                Tambah Layanan
            </a>
        </div>

        <div class="bf-table-wrapper">
            <table class="bf-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Layanan</th>
                        <th>Harga</th>
                        <th>Dibuat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($layanans as $layanan)
                    <tr>
                        <td><span class="bf-id-badge">{{ $layanan->id_layanan }}</span></td>
                        <td>{{ $layanan->nama_layanan }}</td>
                        <td><strong>Rp {{ number_format($layanan->harga, 0, ',', '.') }}</strong></td>
                        <td>{{ $layanan->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="bf-action-btns">
                                <a href="{{ route('owner.layanan.edit', $layanan) }}" class="bf-btn-icon bf-btn-icon--edit" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('owner.layanan.destroy', $layanan) }}" method="POST"
                                      onsubmit="return confirm('Hapus layanan \'{{ $layanan->nama_layanan }}\'?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bf-btn-icon bf-btn-icon--delete" title="Hapus">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"/><path d="m19 6-.867 12.142A2 2 0 0 1 16.138 20H7.862a2 2 0 0 1-1.995-1.858L5 6m5 0V4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="bf-table-empty">
                            Belum ada layanan. <a href="{{ route('owner.layanan.create') }}">Tambah sekarang →</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($layanans->hasPages())
        <div class="bf-pagination">
            {{ $layanans->links() }}
        </div>
        @endif
    </div>

</x-owner-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Input Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, #51B7F9, #3A9FE0);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold">Selamat datang, {{ Auth::user()->username }}!</h3>
                            <p class="text-sm text-gray-500">Role: <span class="font-medium text-green-600">{{ Auth::user()->role }}</span></p>
                        </div>
                    </div>
                    <p class="text-gray-600">
                        Anda login sebagai <strong>Capster</strong>. Halaman ini akan menampilkan form input transaksi.
                    </p>
                    <p class="text-sm text-gray-400 mt-2">🔧 Form input transaksi akan dikembangkan di step berikutnya.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

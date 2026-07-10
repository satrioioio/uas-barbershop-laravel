<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Owner') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, #51B7F9, #3A9FE0);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold">Selamat datang, {{ Auth::user()->username }}!</h3>
                            <p class="text-sm text-gray-500">Role: <span class="font-medium text-blue-600">{{ Auth::user()->role }}</span></p>
                        </div>
                    </div>
                    <p class="text-gray-600">
                        Anda login sebagai <strong>Owner</strong>. Halaman dashboard ini akan menampilkan statistik dan menu kelola barbershop.
                    </p>
                    <p class="text-sm text-gray-400 mt-2">🔧 Halaman ini akan dikembangkan di step berikutnya.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

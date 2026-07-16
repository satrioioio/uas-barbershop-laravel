<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Dashboard' }} — BarberFlow</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bf-owner-body" x-data="{ sidebarOpen: true }">

    <!-- ======== SIDEBAR ======== -->
    <aside class="bf-sidebar" :class="sidebarOpen ? 'bf-sidebar--open' : 'bf-sidebar--closed'">

        <!-- Logo -->
        <div class="bf-sidebar-brand">
            <img src="{{ asset('images/logo.png') }}" alt="BarberFlow Logo" class="bf-sidebar-logo">
            <span class="bf-sidebar-brand-text">arberFlow</span>
        </div>

        <!-- User Info -->
        <div class="bf-sidebar-user">
            <div class="bf-sidebar-user-avatar">
                {{ strtoupper(substr(Auth::user()->username, 0, 1)) }}
            </div>
            <div class="bf-sidebar-user-info">
                <p class="bf-sidebar-user-name">{{ Auth::user()->username }}</p>
                <p class="bf-sidebar-user-role">{{ Auth::user()->role }}</p>
            </div>
        </div>

        <hr class="bf-sidebar-divider">

        <!-- Navigation Menu -->
        <nav class="bf-sidebar-nav">
            <a href="{{ route('owner.dashboard') }}"
               class="bf-sidebar-link {{ request()->routeIs('owner.dashboard') ? 'bf-sidebar-link--active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/>
                    <rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/>
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('owner.transaksi') }}"
               class="bf-sidebar-link {{ request()->routeIs('owner.transaksi') ? 'bf-sidebar-link--active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/>
                    <path d="M13 5v2"/><path d="M13 17v2"/><path d="M13 11v2"/>
                </svg>
                <span>Data Transaksi</span>
            </a>

            <a href="{{ route('owner.layanan.index') }}"
               class="bf-sidebar-link {{ request()->routeIs('owner.layanan.*') ? 'bf-sidebar-link--active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20.38 3.46 16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.47a1 1 0 0 0 .99.84H6v10c0 1.1.9 2 2 2h8a2 2 0 0 0 2-2V9.54h2.15a1 1 0 0 0 .99-.84l.58-3.47a2 2 0 0 0-1.34-2.23z"/>
                </svg>
                <span>Data Layanan</span>
            </a>

            <a href="{{ route('owner.akun.index') }}"
               class="bf-sidebar-link {{ request()->routeIs('owner.akun.*') ? 'bf-sidebar-link--active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
                <span>Data Akun</span>
            </a>
        </nav>

        <!-- Logout -->
        <div class="bf-sidebar-footer">
            <hr class="bf-sidebar-divider">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bf-sidebar-link bf-sidebar-logout">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/>
                    </svg>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- ======== MAIN CONTENT ======== -->
    <div class="bf-main-wrapper" :class="sidebarOpen ? 'bf-main-wrapper--shifted' : ''">

        <!-- Topbar -->
        <header class="bf-topbar">
            <!-- Hamburger Toggle -->
            <button @click="sidebarOpen = !sidebarOpen" class="bf-topbar-toggle">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/>
                </svg>
            </button>

            <!-- Page Title -->
            <h1 class="bf-topbar-title">{{ $title ?? 'Dashboard' }}</h1>

            <!-- Right Side -->
            <div class="bf-topbar-right">
                <span class="bf-topbar-greeting">Halo, <strong>{{ Auth::user()->username }}</strong> 👋</span>
            </div>
        </header>

        <!-- Page Content -->
        <main class="bf-page-content">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="bf-alert bf-alert--success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bf-alert bf-alert--error">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/><line x1="15" x2="9" y1="9" y2="15"/><line x1="9" x2="15" y1="9" y2="15"/>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            {{ $slot }}
        </main>
    </div>

</body>
</html>

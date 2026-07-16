<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Transaksi' }} — BarberFlow</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bf-capster-body">

    <!-- Topbar -->
    <header class="bf-capster-topbar">
        <div class="bf-capster-brand">
            <img src="{{ asset('images/logo.png') }}" alt="BarberFlow" class="bf-capster-logo">
            <span class="bf-capster-brand-name">BarberFlow</span>
        </div>

        <div class="bf-capster-user">
            <div class="bf-capster-avatar">{{ strtoupper(substr(Auth::user()->username, 0, 1)) }}</div>
            <div class="bf-capster-user-info">
                <span class="bf-capster-username">{{ Auth::user()->username }}</span>
                <span class="bf-capster-role">Capster</span>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="margin:0">
                @csrf
                <button type="submit" class="bf-capster-logout-btn" title="Logout">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </header>

    <!-- Page Content -->
    <main class="bf-capster-content">
        @if(session('success'))
        <div class="bf-alert bf-alert--success">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="bf-alert bf-alert--error">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" x2="9" y1="9" y2="15"/><line x1="9" x2="15" y1="9" y2="15"/></svg>
            {{ session('error') }}
        </div>
        @endif

        {{ $slot }}
    </main>

</body>
</html>

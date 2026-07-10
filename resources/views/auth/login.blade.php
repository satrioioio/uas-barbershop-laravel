<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Welcome Heading -->
    <div class="text-center mb-8 bf-stagger-1">
        <h1 class="text-2xl font-bold" style="color: #1A1A2E;">Welcome!</h1>
        <p class="text-sm mt-1" style="color: #6B7280;">Sign in to your BarberFlow account</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email / Username -->
        <div class="mb-5 bf-stagger-2">
            <label for="email" class="bf-label">{{ __('Email') }}</label>
            <div class="bf-input-group relative">
                <!-- Email Icon -->
                <div class="bf-input-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="20" height="16" x="2" y="4" rx="2"/>
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                    </svg>
                </div>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="bf-input @error('email') bf-input-error @enderror"
                    placeholder="Enter your email"
                    required
                    autofocus
                    autocomplete="username"
                >
            </div>
            <x-input-error :messages="$errors->get('email')" class="bf-error-text" />
        </div>

        <!-- Password -->
        <div class="mb-5 bf-stagger-3" x-data="{ showPassword: false }">
            <label for="password" class="bf-label">{{ __('Password') }}</label>
            <div class="bf-input-group relative">
                <!-- Lock Icon -->
                <div class="bf-input-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                </div>
                <input
                    id="password"
                    :type="showPassword ? 'text' : 'password'"
                    name="password"
                    class="bf-input @error('password') bf-input-error @enderror"
                    placeholder="Enter your password"
                    required
                    autocomplete="current-password"
                    style="padding-right: 48px;"
                >
                <!-- Toggle Password Visibility -->
                <button
                    type="button"
                    class="bf-password-toggle"
                    @click="showPassword = !showPassword"
                    tabindex="-1"
                >
                    <!-- Eye Open -->
                    <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    <!-- Eye Closed -->
                    <svg x-show="showPassword" x-cloak xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"/>
                        <path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"/>
                        <path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"/>
                        <path d="m2 2 20 20"/>
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="bf-error-text" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between mb-6 bf-stagger-4">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="bf-checkbox" name="remember">
                <span class="ms-2 text-sm" style="color: #6B7280;">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="bf-link text-sm" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <!-- Login Button -->
        <div class="bf-stagger-5">
            <button type="submit" class="bf-btn-primary">
                {{ __('Login') }}
            </button>
        </div>

        <!-- Register Link -->
        <div class="text-center mt-6 bf-stagger-6">
            <p class="text-sm" style="color: #6B7280;">
                Don't have an account?
                <a href="{{ route('register') }}" class="bf-link">Register</a>
            </p>
        </div>
    </form>
</x-guest-layout>

<x-guest-layout>
    <!-- Welcome Heading -->
    <div class="text-center mb-8 bf-stagger-1">
        <h1 class="text-2xl font-bold" style="color: #1A1A2E;">Create Account</h1>
        <p class="text-sm mt-1" style="color: #6B7280;">Join BarberFlow today</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Username -->
        <div class="mb-5 bf-stagger-2">
            <label for="username" class="bf-label">{{ __('Username') }}</label>
            <div class="bf-input-group relative">
                <div class="bf-input-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                </div>
                <input
                    id="username"
                    type="text"
                    name="username"
                    value="{{ old('username') }}"
                    class="bf-input @error('username') bf-input-error @enderror"
                    placeholder="Enter your username"
                    required
                    autofocus
                    autocomplete="username"
                >
            </div>
            <x-input-error :messages="$errors->get('username')" class="bf-error-text" />
        </div>

        <!-- Email Address -->
        <div class="mb-5 bf-stagger-3">
            <label for="email" class="bf-label">{{ __('Email') }}</label>
            <div class="bf-input-group relative">
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
                    autocomplete="email"
                >
            </div>
            <x-input-error :messages="$errors->get('email')" class="bf-error-text" />
        </div>

        <!-- Password -->
        <div class="mb-5 bf-stagger-4" x-data="{ showPassword: false }">
            <label for="password" class="bf-label">{{ __('Password') }}</label>
            <div class="bf-input-group relative">
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
                    placeholder="Create a password"
                    required
                    autocomplete="new-password"
                    style="padding-right: 48px;"
                >
                <button type="button" class="bf-password-toggle" @click="showPassword = !showPassword" tabindex="-1">
                    <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
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

        <!-- Confirm Password -->
        <div class="mb-6 bf-stagger-5" x-data="{ showPassword: false }">
            <label for="password_confirmation" class="bf-label">{{ __('Confirm Password') }}</label>
            <div class="bf-input-group relative">
                <div class="bf-input-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 17v-2"/>
                        <path d="M12 22c-4 0-8-2.5-8-5.5S8 11 12 11s8 2.5 8 5.5-4 5.5-8 5.5z" style="display:none"/>
                        <rect width="18" height="11" x="3" y="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                </div>
                <input
                    id="password_confirmation"
                    :type="showPassword ? 'text' : 'password'"
                    name="password_confirmation"
                    class="bf-input"
                    placeholder="Confirm your password"
                    required
                    autocomplete="new-password"
                    style="padding-right: 48px;"
                >
                <button type="button" class="bf-password-toggle" @click="showPassword = !showPassword" tabindex="-1">
                    <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    <svg x-show="showPassword" x-cloak xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"/>
                        <path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"/>
                        <path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"/>
                        <path d="m2 2 20 20"/>
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="bf-error-text" />
        </div>

        <!-- Register Button -->
        <div class="bf-stagger-6">
            <button type="submit" class="bf-btn-primary">
                {{ __('Register') }}
            </button>
        </div>

        <!-- Login Link -->
        <div class="text-center mt-6 bf-stagger-6">
            <p class="text-sm" style="color: #6B7280;">
                Already have an account?
                <a href="{{ route('login') }}" class="bf-link">Login</a>
            </p>
        </div>
    </form>
</x-guest-layout>

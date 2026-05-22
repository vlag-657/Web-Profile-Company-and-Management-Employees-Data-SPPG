<x-guest-layout>
    <!-- session status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!--email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <br>
        </div>

        <!--pw -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <div class="password-wrapper mt-1">
                <input id="password" 
                    type="password"
                    name="password"
                    required autocomplete="current-password"
                    class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <i class="bi bi-eye-slash" id="togglePassword"></i>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- remember me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
        </form>

    <script>
        window.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');
            if (togglePassword && password) {
                togglePassword.addEventListener('click', function(e) {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    this.classList.toggle('bi-eye');
                });
            }
        });
    </script>
</x-guest-layout>

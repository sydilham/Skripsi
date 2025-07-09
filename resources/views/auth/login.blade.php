<x-guest-layout>
    <form id="loginForm" method="POST" action="{{ route('login') }}"
        class="w-full bg-white/80 backdrop-blur-md rounded-2xl shadow-xl p-8 relative z-10">
        @csrf

        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Login</h1>

        <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="password" :value="__('Password')" />
            <div class="relative">
                <input id="password" name="password" type="password"
                    class="block mt-1 w-full pr-10 rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    required autocomplete="current-password" />
                <span class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer" onclick="togglePassword()">
                    <svg id="eyeIcon" class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </span>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center mb-4">
            <input id="remember_me" type="checkbox" name="remember"
                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" />
            <label for="remember_me" class="ml-2 block text-sm text-gray-600">Remember me</label>
        </div>

        <div class="flex justify-end">
            <x-primary-button id="loginButton" class="rounded-lg px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow-md transition duration-300">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Spinner Loading Overlay -->
    <div id="loadingOverlay"
        class="fixed inset-0 bg-white bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50 hidden">
        <svg class="animate-spin h-12 w-12 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10"
                stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
        </svg>
    </div>

    @push('styles')
        <style>
            @keyframes shake {
                0% { transform: translateX(0); }
                20% { transform: translateX(-10px); }
                40% { transform: translateX(10px); }
                60% { transform: translateX(-10px); }
                80% { transform: translateX(10px); }
                100% { transform: translateX(0); }
            }

            .shake {
                animation: shake 0.5s;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            function togglePassword() {
                const input = document.getElementById('password');
                const icon = document.getElementById('eyeIcon');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.973 9.973 0 012.232-3.592
                            m3.142-2.274A9.955 9.955 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.956 9.956 0 01-4.032 5.132M15
                            12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                    `;
                } else {
                    input.type = 'password';
                    icon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542
                            7-4.477 0-8.268-2.943-9.542-7z" />
                    `;
                }
            }

            document.addEventListener('DOMContentLoaded', () => {
                const form = document.getElementById('loginForm');
                const loadingOverlay = document.getElementById('loadingOverlay');
                const loginButton = document.getElementById('loginButton');

                const errorsExist = {{ $errors->any() ? 'true' : 'false' }};
                if (errorsExist) {
                    form.classList.add('shake');
                    document.getElementById('email').value = '';
                    document.getElementById('password').value = '';
                    setTimeout(() => form.classList.remove('shake'), 500);
                }

                form.addEventListener('submit', function () {
                    loginButton.disabled = true;
                    loadingOverlay.classList.remove('hidden');
                });
            });
        </script>
    @endpush
</x-guest-layout>

<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">

            <!-- LOGO -->
            <div class="flex flex-col items-center mb-6">
                <img src="{{ asset('images/logo.png') }}"
                     alt="Logo Desa"
                     class="h-20 mb-3">
                <h1 class="text-xl font-bold text-[#3C4A76]">
                    Login Sistem Desa
                </h1>
                <p class="text-sm text-gray-500">
                    Silakan masuk untuk melanjutkan
                </p>
            </div>

            <!-- SESSION STATUS -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- EMAIL -->
                <div>
                    <x-input-label for="email" value="Email" />
                    <x-text-input
                        id="email"
                        type="email"
                        name="email"
                        class="block mt-1 w-full rounded-lg px-4 py-3 bg-gray-700 text-white"
                        :value="old('email')"
                        required
                        autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- PASSWORD -->
                <div>
                    <x-input-label for="password" value="Kata Sandi" />

                    <div class="relative mt-1">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            required
                            class="block w-full rounded-lg border-gray-300 pr-10 px-4 py-3 focus:border-[#3C4A76] focus:ring-[#3C4A76]" />

                        <!-- ICON EYE -->
                        <button type="button"
                                onclick="togglePassword()"
                                class="absolute inset-y-0 right-3 flex items-center text-gray-500 hover:text-[#3C4A76]">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg"
                                 class="h-5 w-5"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5
                                         c4.478 0 8.268 2.943 9.542 7
                                         -1.274 4.057-5.064 7-9.542 7
                                         -4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>

                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <!-- BUTTON -->
                <div class="pt-2">
                    <button
                        type="submit"
                        class="w-full bg-[#3C4A76] hover:bg-[#2f3a63]
                               text-white py-2.5 rounded-lg font-semibold
                               transition duration-200">
                        Masuk
                    </button>
                </div>
            </form>

        </div>
    </div>

    <!-- SCRIPT TOGGLE PASSWORD -->
    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
</x-guest-layout>


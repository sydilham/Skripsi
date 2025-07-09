@push('styles')
    @include('layouts.includes.style')
@endpush

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Akun') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Edit Akun</h3>

                <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Nama -->
                    <div class="mt-4">
                        <x-input-label for="name" :value="__('name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name', $user->name)" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Role -->
                    <div class="mt-4">
                        <x-input-label for="role" :value="__('role')" />
                        <select id="role" name="role" class="block mt-1 w-full" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="kepala_sekolah"
                                {{ old('role', $user->role) == 'kepala_sekolah' ? 'selected' : '' }}>Kepala Sekolah
                            </option>
                            <option value="operator" {{ old('role', $user->role) == 'operator' ? 'selected' : '' }}>
                                Operator</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email', $user->email)" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- (Opsional) Ubah Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password (Kosongkan jika tidak diubah)')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Tombol -->
                    <div class="mt-4 flex justify-end">
                        <x-primary-button class="ml-3">
                            {{ __('Simpan') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    @push('scripts')
        @include('layouts.includes.script')
    @endpush
</x-app-layout>

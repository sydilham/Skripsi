<div x-data="{ show: false }">
    <button @click="show = true"
        class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Tambah
        User</button>

    <!-- Modal -->
    <div x-show="show" x-on:keydown.escape.window="show = false"
        class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50" style="display: none;">
        <div x-show="show" class="fixed inset-0 transform transition-all" x-on:click="show = false">
            <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
        </div>

        <div x-show="show"
            class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto">
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <div class="p-6">
                    <h3 class="font-medium text-lg text-gray-800 dark:text-gray-200">Tambah User</h3>

                    <!-- Name -->
                    <div class="mt-4">
                        <label for="name"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                        <input type="text" name="name" id="name"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                            placeholder="Nama Lengkap" required>
                        @error('name')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mt-4">
                        <label for="email"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" name="email" id="email"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                            placeholder="Email" required>
                        @error('email')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div class="mt-4">
                        <label for="role"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
                        <select id="role" name="role"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                            required>
                            <option value="">-- Pilih Role --</option>
                            <option value="operator" {{ old('role') == 'operator' ? 'selected' : '' }}>Operator</option>
                            <option value="kepala_sekolah" {{ old('role') == 'kepala_sekolah' ? 'selected' : '' }}>
                                Kepala Sekolah</option>
                        </select>
                        @error('role')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <label for="password"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                        <input type="password" name="password" id="password"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                            placeholder="Password" required>
                        @error('password')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <label for="password_confirmation"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Konfirmasi
                            Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300"
                            placeholder="Konfirmasi Password" required>
                    </div>

                    <!-- Tombol Simpan & Batal -->
                    <div class="mt-4 flex justify-end">
                        <button type="button" x-on:click="show = false" class="btn btn-secondary">Batal</button>
                        <button type="submit" class="btn btn-primary ml-3">Simpan</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

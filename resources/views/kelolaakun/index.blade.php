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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
                @include('kelolaakun.partials.modal-form-add-user')
                <table class="table table-striped table-bordered" id="userTable">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                            <tr class="text-center">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->role === 'kepala_sekolah')
                                        Kepala Sekolah
                                    @elseif ($user->role === 'operator')
                                        Operator
                                    @else
                                        {{ ucfirst($user->role) }}
                                    @endif
                                </td>
                                <td class="flex justify-center item-center gap-3">
                                    <a href="{{ route('admin.users.edit', $user) }}"><button
                                            class="btn btn-primary">Edit</button></a>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada user.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

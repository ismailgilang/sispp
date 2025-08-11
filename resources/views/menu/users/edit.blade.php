<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header Welcome -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Manajemen Pengguna</h1>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- User Table -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow-md p-6">
                <div class="flex flex-col justify-center mb-4">
                    <div class="flex justify-between items-center mb-4">
                        <form method="POST" action="{{ route('Users.update', $user->id) }}" class="p-6 w-full">
                            @csrf
                            @method('PUT') {{-- Untuk method update --}}
                            
                            <h2 class="text-lg font-medium text-gray-900">Edit Pengguna</h2>
                            
                            <div class="mt-6">
                                <x-input-label for="nis" value="NIS" />
                                <x-text-input id="nis" name="nis" type="text" 
                                    class="mt-1 block w-full" 
                                    value="{{ old('nis', $user->nis) }}" />
                                <x-input-error :messages="$errors->get('nis')" class="mt-2" />
                                <p class="text-xs text-gray-500 mt-1">Kosongkan jika admin</p>
                            </div>

                            <div class="mt-4">
                                <x-input-label for="name" value="Nama Lengkap" />
                                <x-text-input id="name" name="name" type="text" 
                                    class="mt-1 block w-full" 
                                    value="{{ old('name', $user->name) }}" required />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="username" value="Username" />
                                <x-text-input id="username" name="username" type="text" 
                                    class="mt-1 block w-full" 
                                    value="{{ old('username', $user->username) }}" required />
                                <x-input-error :messages="$errors->get('username')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="password" value="Password (opsional)" />
                                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti password.</p>
                            </div>

                            <div class="mt-4">
                                <x-input-label for="role" value="Role" />
                                <select id="role" name="role" 
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="siswa" {{ old('role', $user->role) == 'siswa' ? 'selected' : '' }}>Siswa</option>
                                </select>
                                <x-input-error :messages="$errors->get('role')" class="mt-2" />
                            </div>

                            <div class="mt-6 flex justify-end">
                                <x-secondary-button onclick="window.location='{{ route('Users.index') }}'">
                                    Batal
                                </x-secondary-button>
                                <x-primary-button class="ml-3">
                                    Update
                                </x-primary-button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
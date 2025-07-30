<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header Welcome -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Manajemen Jurusan</h1>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- User Table -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow-md p-6">
                <div class="flex flex-col justify-center mb-4">
                    <div class="flex justify-between items-center mb-4">
                        <form method="POST" action="{{ route('Jurusan.update', $user->id) }}" class="p-6 w-full">
                            @csrf
                            @method('PUT') {{-- Untuk method update --}}
                            
                            <h2 class="text-lg font-medium text-gray-900">Edit Jurusan</h2>
                            
                            <div class="mt-6">
                                <x-input-label for="kode" value="Kode Jurusan" />
                                <x-text-input id="kode" name="kode_jurusan" type="text" 
                                    class="mt-1 block w-full" 
                                    value="{{ old('kode', $user->kode_jurusan) }}" />
                                <x-input-error :messages="$errors->get('kode')" class="mt-2" />
                                <p class="text-xs text-gray-500 mt-1">Kosongkan jika admin</p>
                            </div>

                            <div class="mt-4">
                                <x-input-label for="name" value="Nama Jurusan" />
                                <x-text-input id="name" name="nama_jurusan" type="text" 
                                    class="mt-1 block w-full" 
                                    value="{{ old('name', $user->nama_jurusan) }}" required />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
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
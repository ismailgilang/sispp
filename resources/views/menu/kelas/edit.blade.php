<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header Welcome -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Manajemen Kelas</h1>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- User Table -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow-md p-6">
                <div class="flex flex-col justify-center mb-4">
                    <div class="flex justify-between items-center mb-4">
                        <form method="POST" action="{{ route('Kelas.update', $kelas->id) }}" class="w-full">
                            @csrf
                            @method('PUT')

                             <h2 class="text-lg font-medium text-gray-900">Edit Data Kelas</h2>

                            <div class="mt-6">
                                <x-input-label for="nama_kelas" value="Nama Kelas" />
                                <x-text-input 
                                    id="nama_kelas" 
                                    name="nama_kelas" 
                                    type="text" 
                                    class="mt-1 block w-full" 
                                    value="{{ old('nama_kelas', $kelas->nama_kelas) }}" 
                                    required 
                                />
                                <x-input-error :messages="$errors->get('nama_kelas')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="jurusan" value="Nama Jurusan" />
                                <select 
                                    id="jurusan" 
                                    name="jurusan" 
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                                    required
                                >
                                    <option value="">-- Pilih Jurusan --</option>
                                    @foreach ($jurusan as $item)
                                        <option 
                                            value="{{ $item->id }}" 
                                            {{ old('jurusan', $kelas->id_jurusan) == $item->id ? 'selected' : '' }}
                                        >
                                            {{ $item->nama_jurusan }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('jurusan')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="angkatan" value="Angkatan Tahun" />
                                <x-text-input 
                                    id="angkatan" 
                                    name="angkatan" 
                                    type="text" 
                                    class="mt-1 block w-full" 
                                    value="{{ old('angkatan', $kelas->angkatan) }}" 
                                    required 
                                />
                                <x-input-error :messages="$errors->get('angkatan')" class="mt-2" />
                            </div>

                            <div class="mt-6 flex justify-end">
                                <x-secondary-button type="button" onclick="window.history.back();">
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
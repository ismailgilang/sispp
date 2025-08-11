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
                        <form method="POST" action="{{ route('Update.siswa', $siswa->nis) }}" class="p-6 w-full">
                            @csrf
                            @method('PUT')

                            <h2 class="text-lg font-medium text-gray-900">Edit Data Siswa</h2>
                            
                            <div class="mt-6">
                                <x-input-label for="nis" value="NIS" />
                                <x-text-input id="nis" name="nis" type="text" class="mt-1 block w-full" 
                                    value="{{ old('nis', $siswa->nis) }}" />
                                <x-input-error :messages="$errors->get('nis')" class="mt-2" />
                            </div>

                            <div class="mt-6">
                                <x-input-label for="nama" value="Nama Lengkap" />
                                <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full" 
                                    value="{{ old('nama', $siswa->nama) }}" required />
                                <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="id_kelas" value="Nama Kelas" />
                                <select id="id_kelas" name="id_kelas" 
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach ($kelas as $item)
                                        <option value="{{ $item->id }}" 
                                            {{ old('id_kelas', $siswa->id_kelas) == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('id_kelas')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="alamat" value="Alamat" />
                                <x-text-input id="alamat" name="alamat" type="text" class="mt-1 block w-full" 
                                    value="{{ old('alamat', $siswa->alamat) }}" required />
                                <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="no_telp" value="No Handphone" />
                                <x-text-input id="no_telp" name="no_telp" type="text" class="mt-1 block w-full" 
                                    value="{{ old('no_telp', $siswa->no_telp) }}" required />
                                <x-input-error :messages="$errors->get('no_telp')" class="mt-2" />
                            </div>

                            <div class="mt-6 flex justify-end">
                                <x-secondary-button onclick="window.location='{{ route('Siswa.index') }}'">
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
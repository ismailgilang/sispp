<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header Welcome -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Manajemen Pembayaran SPP</h1>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- User Table -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow-md p-6">
                <div class="flex flex-col justify-center mb-4">
                    <div class="flex justify-between items-center mb-4">
                        <form method="POST" action="{{ route('Pembayaran.update', $data->id) }}" class="p-6 w-full" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <h2 class="text-lg font-medium text-gray-900">Edit Data Pembayaran {{$data->spp->nis}}</h2>
                            
                            <div class="mt-6">
                                <x-input-label for="tgl_bayar" value="Tanggal Pembayaran" />
                                <x-text-input 
                                    id="tgl_bayar" 
                                    name="tgl_bayar" 
                                    type="date" 
                                    class="mt-1 block w-full" 
                                    value="{{ old('tgl_bayar', $data->tgl_bayar ? \Carbon\Carbon::parse($data->tgl_bayar)->format('Y-m-d') : '') }}" 
                                />
                                <x-input-error :messages="$errors->get('tgl_bayar')" class="mt-2" />
                            </div>

                            <div class="mt-6">
                                <x-input-label for="jumlah_bayar" value="Jumlah Pembayaran" />
                                <x-text-input id="jumlah_bayar" name="jumlah_bayar" type="number" class="mt-1 block w-full" 
                                    value="{{ old('jumlah_bayar', $data->jumlah_bayar) }}" required />
                                <x-input-error :messages="$errors->get('jumlah_bayar')" class="mt-2" />
                            </div>

                           <div class="mt-4">
                                <x-input-label for="metode_pembayaran" value="Metode Pembayaran" />
                                <select id="metode_pembayaran" name="metode_pembayaran" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="cash" {{ old('metode_pembayaran', $data->metode_pembayaran) == 'cash' ? 'selected' : '' }}>Cash</option>
                                    <option value="transfer" {{ old('metode_pembayaran', $data->metode_pembayaran) == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                </select>
                                <x-input-error :messages="$errors->get('metode_pembayaran')" class="mt-2" />
                            </div>


                            <div class="mt-4">
                                <x-input-label for="keterangan" value="Bukti Pembayaran" />
                                <input 
                                    id="keterangan" 
                                    name="keterangan" 
                                    type="file" 
                                    class="mt-1 px-2 py-2 block w-full border-gray-300 rounded-md shadow-sm" 
                                    {{ $data->keterangan ? '' : 'required' }} 
                                >
                                <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />

                                {{-- Tampilkan file lama jika ada --}}
                                @if($data->keterangan)
                                    <p class="mt-2 text-sm text-gray-600">File saat ini: 
                                        <a href="{{ asset('storage/' . $data->keterangan) }}" target="_blank" class="text-blue-500 underline">
                                            Lihat Bukti
                                        </a>
                                    </p>
                                @endif
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
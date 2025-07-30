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
                        <form method="POST" action="{{ route('update.bayar', $data->id) }}" class="p-6 w-full">
                            @csrf
                            @method('PUT')

                            <h2 class="text-lg font-medium text-gray-900 mb-4">Edit Data Siswa</h2>

                            <!-- Bagian Tagihan Siswa -->
                            <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg mb-6">
                                <h3 class="text-md font-semibold text-gray-800 mb-3">Data Tagihan Siswa</h3>

                                <!-- NIS -->
                                <div class="mt-4">
                                    <x-input-label for="nis" value="NIS" />
                                    <x-text-input id="nis" name="nis" type="text" class="mt-1 block w-full"
                                        value="{{ old('nis', $data->nis) }}" readonly />
                                    <x-input-error :messages="$errors->get('nis')" class="mt-2" />
                                </div>

                                <!-- Bulan -->
                                <div class="mt-4">
                                    <x-input-label for="bulan" value="Bulan" />
                                    <x-text-input id="bulan" name="bulan" type="text" class="mt-1 block w-full"
                                        value="{{ old('bulan', $data->bulan) }}" readonly />
                                    <x-input-error :messages="$errors->get('bulan')" class="mt-2" />
                                </div>

                                <!-- Tahun -->
                                <div class="mt-4">
                                    <x-input-label for="tahun" value="Tahun" />
                                    <x-text-input id="tahun" name="tahun" type="text" class="mt-1 block w-full"
                                        value="{{ old('tahun', $data->tahun) }}" readonly />
                                    <x-input-error :messages="$errors->get('tahun')" class="mt-2" />
                                </div>

                                <!-- Nominal -->
                                <div class="mt-4">
                                    <x-input-label for="nominal" value="Nominal" />
                                    <x-text-input id="nominal" name="nominal" type="text" class="mt-1 block w-full"
                                        value="{{ old('nominal', $data->nominal) }}" readonly />
                                    <x-input-error :messages="$errors->get('nominal')" class="mt-2" />
                                </div>

                                <!-- Jatuh Tempo -->
                                <div class="mt-4">
                                    <x-input-label for="jatuh_tempo" value="Jatuh Tempo" />
                                    <x-text-input id="jatuh_tempo" name="jatuh_tempo" type="text" class="mt-1 block w-full"
                                        value="{{ old('jatuh_tempo', $data->jatuh_tempo) }}" readonly />
                                    <x-input-error :messages="$errors->get('jatuh_tempo')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Bagian Data Pembayaran -->
                            <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                <h3 class="text-md font-semibold text-gray-800 mb-3">Data Pembayaran</h3>

                                <!-- Status -->
                                <div class="mt-4">
                                    <x-input-label for="status" value="Status" />
                                    <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="belum_dibayar" {{ old('status', $data->status) == 'belum_dibayar' ? 'selected' : '' }}>Belum Dibayar</option>
                                        <option value="lunas" {{ old('status', $data->status) == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                </div>

                                <!-- Tanggal Bayar -->
                                <div class="mt-4">
                                    <x-input-label for="tanggal_bayar" value="Tanggal Bayar" />
                                    <x-text-input id="tanggal_bayar" name="tanggal_bayar" type="date" class="mt-1 block w-full"
                                        value="{{ old('tanggal_bayar', $data->tanggal_bayar) }}" />
                                    <x-input-error :messages="$errors->get('tanggal_bayar')" class="mt-2" />
                                </div>

                                <!-- Jumlah Bayar -->
                                <div class="mt-4">
                                    <x-input-label for="jumlah_bayar" value="Jumlah Bayar" />
                                    <x-text-input id="jumlah_bayar" name="jumlah_bayar" type="number" class="mt-1 block w-full"
                                        value="{{ old('jumlah_bayar', $data->jumlah_bayar) }}" placeholder="Masukkan jumlah bayar" />
                                    <x-input-error :messages="$errors->get('jumlah_bayar')" class="mt-2" />
                                </div>

                                <!-- Metode Pembayaran -->
                                <div class="mt-4">
                                    <x-input-label for="metode_pembayaran" value="Metode Pembayaran" />
                                    <select id="metode_pembayaran" name="metode_pembayaran" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="">-- Pilih Metode --</option>
                                        <option value="cash" {{ old('metode_pembayaran', $data->metode_pembayaran) == 'cash' ? 'selected' : '' }}>Cash</option>
                                        <option value="transfer" {{ old('metode_pembayaran', $data->metode_pembayaran) == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('metode_pembayaran')" class="mt-2" />
                                </div>

                                <!-- Keterangan -->
                                <div class="mt-4">
                                    <x-input-label for="keterangan" value="Keterangan" />
                                    <textarea id="keterangan" name="keterangan" rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('keterangan', $data->keterangan) }}</textarea>
                                    <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Tombol -->
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
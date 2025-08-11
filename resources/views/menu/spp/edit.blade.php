<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header Welcome -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Manajemen SPP</h1>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- User Table -->
            <div class="lg:col-span-2 bg-white rounded-lg shadow-md p-6">
                <div class="flex flex-col justify-center mb-4">
                    <div class="flex justify-between items-center mb-4">
                        <form method="POST" action="{{ route('Spp.update', $data->id) }}" class="p-6 w-full">
                            @csrf
                            @method('PUT')

                            <h2 class="text-lg font-medium text-gray-900">Edit Data SPP</h2>
                            
                            <div class="mt-6">
                                <x-input-label for="nis" value="NIS" />
                                <x-text-input id="nis" name="nis" type="text" class="mt-1 block w-full" 
                                    value="{{ old('nis', $data->nis) }}" />
                                <x-input-error :messages="$errors->get('nis')" class="mt-2" />
                            </div>

                            <div class="mt-6">
                                <x-input-label for="tahun" value="Tahun" />
                                <x-text-input id="tahun" name="tahun" type="text" class="mt-1 block w-full" 
                                    value="{{ old('tahun', $data->tahun) }}" required />
                                <x-input-error :messages="$errors->get('tahun')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="bulan" value="Bulan" />
                                <select id="bulan" name="bulan"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    required>
                                    <option value="">Pilih bulan</option>
                                    <option value="1" {{ old('bulan', $data->Januari) == 'Januari' ? 'selected' : '' }}>Januari</option>
                                    <option value="2" {{ old('bulan', $data->bulan) == 'Februari' ? 'selected' : '' }}>Februari</option>
                                    <option value="3" {{ old('bulan', $data->bulan) == 'Maret' ? 'selected' : '' }}>Maret</option>
                                    <option value="4" {{ old('bulan', $data->bulan) == 'April' ? 'selected' : '' }}>April</option>
                                    <option value="5" {{ old('bulan', $data->bulan) == 'Mei' ? 'selected' : '' }}>Mei</option>
                                    <option value="6" {{ old('bulan', $data->bulan) == 'Juni' ? 'selected' : '' }}>Juni</option>
                                    <option value="7" {{ old('bulan', $data->bulan) == 'Juli' ? 'selected' : '' }}>Juli</option>
                                    <option value="8" {{ old('bulan', $data->bulan) == 'Agustus' ? 'selected' : '' }}>Agustus</option>
                                    <option value="9" {{ old('bulan', $data->bulan) == 'September' ? 'selected' : '' }}>September</option>
                                    <option value="10" {{ old('bulan', $data->bulan) == 'Oktober' ? 'selected' : '' }}>Oktober</option>
                                    <option value="11" {{ old('bulan', $data->bulan) == 'November' ? 'selected' : '' }}>November</option>
                                    <option value="12" {{ old('bulan', $data->bulan) == 'Desember' ? 'selected' : '' }}>Desember</option>
                                </select>
                                <x-input-error :messages="$errors->get('bulan')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="nominal" value="Nominal" />
                                <x-text-input id="nominal" name="nominal" type="number" class="mt-1 block w-full" 
                                    value="{{ old('nominal', $data->nominal) }}" required />
                                <x-input-error :messages="$errors->get('nominal')" class="mt-2" />
                            </div>

                            @if(!empty($data->jatuh_tempo))
                            <div class="mt-4">
                                <x-input-label for="jatuh_tempo" value="Jatuh Tempo" />
                                <x-text-input 
                                    id="jatuh_tempo" 
                                    name="jatuh_tempo" 
                                    type="date" 
                                    class="mt-1 block w-full" 
                                    value="{{ \Carbon\Carbon::parse($data->jatuh_tempo)->format('Y-m-d') }}" 
                                    required 
                                />
                                <x-input-error :messages="$errors->get('jatuh_tempo')" class="mt-2" />
                            </div>
                            @endif

                            <div class="mt-4">
                                <x-input-label for="status" value="Status" />
                                <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="lunas" {{ old('status', $data->status) == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                    <option value="belum dibayar" {{ old('status', $data->status) == 'belum dibayar' ? 'selected' : '' }}>Belum Dibayar</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>

                            <div class="mt-6 flex justify-end">
                                 <x-secondary-button onclick="window.location='{{ route('Spp.index') }}'">
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
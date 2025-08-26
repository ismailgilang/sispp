<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">
        <!-- Header Welcome -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Manajemen SPP</h1>
            <div class="mt-2 w-20 h-1 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full"></div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- User Table -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6">
                <div class="flex flex-col justify-center mb-4">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                        <h2 class="text-lg font-semibold text-gray-800">Tabel SPP</h2>
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                            <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                                <!-- Search Input -->
                                <div class="relative w-full sm:w-64">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" id="searchInput" placeholder="Cari pengguna..." 
                                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                        onkeyup="searchTable()">
                                </div>
                                
                                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-modal2')" class="w-full sm:w-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                    Tagihan / Jurusan
                                </x-primary-button>
                                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-modal')" class="w-full sm:w-auto">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                    Tagihan / Siswa
                                </x-primary-button>
                            </div>
                        </div>
                        
                    </div>
                    
                    <!-- Search Input -->
                   
                    
                    <div class="w-full overflow-x-auto rounded-lg border border-gray-200">
                        <table class="w-full divide-y divide-gray-200" id="userTable">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bulan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nominal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jatuh Tempo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($data as $user)
                                    <tr class="user-row hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 nis">{{ $user->nis }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 bulan">{{ $user->bulan }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 tahun">{{ $user->tahun }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 nominal">Rp {{ number_format($user->nominal, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 jatuh">{{ \Carbon\Carbon::parse($user->jatuh_tempo)->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 status">
                                            @if ($user->status === 'lunas')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Lunas
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Belum Lunas
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex gap-3 items-center justify-center w-full">
                                                @if ($user->status === 'belum_dibayar')
                                                    <a href="{{ route('bayar.spp', $user->id) }}" 
                                                       class="flex items-center px-3 py-2 border border-green-500 bg-green-50 text-green-600 rounded-md text-sm hover:bg-green-100 transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        Bayar
                                                    </a>
                                                @endif
                                                <a href="{{ route('Spp.edit', $user->id) }}" 
                                                   class="flex items-center px-3 py-2 border border-yellow-500 bg-yellow-50 text-yellow-600 rounded-md text-sm hover:bg-yellow-100 transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    Edit
                                                </a>
                                                <x-danger-button 
                                                   x-data="" 
                                                   x-on:click.prevent="$dispatch('open-modal', 'confirm-delete-{{ $user->id }}')"
                                                   class="flex border-2 border-red-500 items-center px-3 py-1 text-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Hapus
                                                </x-danger-button>
                                            </div>
                                        </td>
                                    </tr>
                                    <x-modal name="confirm-delete-{{ $user->id }}" :show="false" maxWidth="sm">
                                        <div class="p-6">
                                            <h2 class="text-lg font-medium text-gray-900">Konfirmasi Hapus</h2>
                                            <p class="mt-2 text-sm text-gray-600">Apakah Anda yakin ingin menghapus SPP dengan NIS <b>{{ $user->nis }}</b>?</p>
                                            <div class="mt-6 flex justify-end space-x-3">
                                                <x-secondary-button 
                                                    type="button" 
                                                    @click="$dispatch('close-modal', 'confirm-delete-{{ $user->id }}')">
                                                    Batal
                                                </x-secondary-button>
                                                <form method="POST" action="{{ route('Spp.destroy', $user->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-danger-button type="submit">Ya, Hapus</x-danger-button>
                                                </form>
                                            </div>
                                        </div>
                                    </x-modal>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">Tidak ada data SPP</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="w-full flex justify-end mt-6">
                        <div class="flex items-center justify-center gap-2" id="paginationControls">
                            <button id="prevPage" class="p-1 border rounded-md hover:bg-indigo-500 hover:text-white disabled:opacity-50 disabled:hover:bg-white" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <div id="pageNumbers" class="flex space-x-1"></div>
                            <button id="nextPage" class="p-1 border rounded-md hover:bg-indigo-500 hover:text-white disabled:opacity-50 disabled:hover:bg-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Add User Modal -->
    <x-modal name="add-modal" focusable>
        <form method="POST" action="{{ route('Spp.store') }}" class="p-6">
            @csrf
            <h2 class="text-lg font-medium text-gray-900 mb-4">
                <span class="text-indigo-600">Buat Tagihan SPP Baru - Per Siswa</span>
                <div class="w-12 h-1 bg-indigo-500 rounded-full mt-1"></div>
            </h2>
            
            <div class="space-y-4">
                <div>
                    <x-input-label for="nis" value="Pilih Siswa" />
                    <select id="nis" name="nis" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        <option value="">-- Pilih Siswa --</option>
                        @foreach ($data3 as $item)
                            <option value="{{ $item->nis }}">{{ $item->nama }} | {{$item->nis}}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('nis')" class="mt-2" />
                </div>
                
                <div>
                    <x-input-label for="nominal" value="Nominal" />
                    <x-text-input id="nominal" name="nominal" type="number" class="mt-1 block w-full" placeholder="Masukkan nominal" />
                    <x-input-error :messages="$errors->get('nominal')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="bulan" value="Bulan" />
                    <select id="bulan" name="bulan" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option value="">Pilih bulan</option>
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                    <x-input-error :messages="$errors->get('bulan')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="tahun" value="Tahun" />
                    <x-text-input id="tahun" name="tahun" type="number" class="mt-1 block w-full" placeholder="Misalnya: 2025" />
                    <x-input-error :messages="$errors->get('tahun')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="jatuh_tempo" value="Jatuh Tempo" />
                    <x-text-input id="jatuh_tempo" name="jatuh_tempo" type="date" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('jatuh_tempo')" class="mt-2" />
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Batal
                </x-secondary-button>

                <x-primary-button class="ml-3">
                    Simpan
                </x-primary-button>
            </div>
        </form>
    </x-modal>

    <x-modal name="add-modal2" focusable>
        <form method="POST" action="{{ route('store.spp') }}" class="p-6">
            @csrf
            <h2 class="text-lg font-medium text-gray-900 mb-4">
                <span class="text-indigo-600">Buat Tagihan SPP Baru - Per Jurusan</span>
                <div class="w-12 h-1 bg-indigo-500 rounded-full mt-1"></div>
            </h2>
            
            <div class="space-y-4">
                <div>
                    <x-input-label for="id_jurusan" value="Pilih Jurusan" />
                    <select id="id_jurusan" name="id_jurusan" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                        <option value="">-- Pilih Jurusan --</option>
                        @foreach ($data2 as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_jurusan }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('id_jurusan')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="nominal" value="Nominal" />
                    <x-text-input id="nominal" name="nominal" type="number" class="mt-1 block w-full" placeholder="Masukkan nominal" />
                    <x-input-error :messages="$errors->get('nominal')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="bulan" value="Bulan" />
                    <select id="bulan" name="bulan" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option value="">Pilih bulan</option>
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                    <x-input-error :messages="$errors->get('bulan')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="tahun" value="Tahun" />
                    <x-text-input id="tahun" name="tahun" type="number" class="mt-1 block w-full" placeholder="Misalnya: 2025" />
                    <x-input-error :messages="$errors->get('tahun')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="jatuh_tempo" value="Jatuh Tempo" />
                    <x-text-input id="jatuh_tempo" name="jatuh_tempo" type="date" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('jatuh_tempo')" class="mt-2" />
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Batal
                </x-secondary-button>

                <x-primary-button class="ml-3">
                    Simpan
                </x-primary-button>
            </div>
        </form>
    </x-modal>

    <script>
        // Variabel global untuk pagination
        let currentPage = 1;
        const rowsPerPage = 5;
        let filteredRows = [];
        let allRows = Array.from(document.querySelectorAll('.user-row'));

        // Inisialisasi pagination saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            filteredRows = [...allRows];
            setupPagination();
        });

        // Fungsi untuk setup pagination
        function setupPagination() {
            const pageNumbersDiv = document.getElementById('pageNumbers');
            pageNumbersDiv.innerHTML = '';
            
            const pageCount = Math.ceil(filteredRows.length / rowsPerPage);
            
            // Tampilkan maksimal 5 nomor halaman
            let startPage = Math.max(1, currentPage - 2);
            let endPage = Math.min(pageCount, startPage + 4);
            
            if (endPage - startPage < 4) {
                startPage = Math.max(1, endPage - 4);
            }
            
            // Tombol Previous
            document.getElementById('prevPage').disabled = currentPage === 1;
            
            // Nomor halaman
            for (let i = startPage; i <= endPage; i++) {
                const pageButton = document.createElement('button');
                pageButton.textContent = i;
                pageButton.className = `px-3 py-1 border rounded-md text-sm ${currentPage === i ? 'bg-indigo-500 text-white' : 'hover:bg-gray-100'}`;
                pageButton.onclick = () => goToPage(i);
                pageNumbersDiv.appendChild(pageButton);
            }
            
            // Tombol Next
            document.getElementById('nextPage').disabled = currentPage === pageCount;
            
            // Tampilkan rows untuk halaman saat ini
            displayRowsForCurrentPage();
        }

        // Fungsi untuk menampilkan rows sesuai halaman
        function displayRowsForCurrentPage() {
            const startIndex = (currentPage - 1) * rowsPerPage;
            const endIndex = startIndex + rowsPerPage;
            
            allRows.forEach(row => row.style.display = 'none');
            
            filteredRows.slice(startIndex, endIndex).forEach(row => {
                row.style.display = '';
            });
        }

        // Fungsi untuk pindah halaman
        function goToPage(page) {
            currentPage = page;
            setupPagination();
        }

        // Event listener untuk tombol next dan previous
        document.getElementById('prevPage').addEventListener('click', () => {
            if (currentPage > 1) {
                goToPage(currentPage - 1);
            }
        });

        document.getElementById('nextPage').addEventListener('click', () => {
            const pageCount = Math.ceil(filteredRows.length / rowsPerPage);
            if (currentPage < pageCount) {
                goToPage(currentPage + 1);
            }
        });

        // Fungsi untuk search
        function searchTable() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            
            filteredRows = allRows.filter(row => {
                const nis = row.querySelector('.nis').textContent.toLowerCase();
                const bulan = row.querySelector('.bulan').textContent.toLowerCase();
                const tahun = row.querySelector('.tahun').textContent.toLowerCase();
                const nominal = row.querySelector('.nominal').textContent.toLowerCase();
                const jatuh = row.querySelector('.jatuh').textContent.toLowerCase();
                const status = row.querySelector('.status').textContent.toLowerCase();
                
                return nis.includes(searchTerm) || 
                       bulan.includes(searchTerm) || 
                       tahun.includes(searchTerm) || 
                       nominal.includes(searchTerm) ||
                       jatuh.includes(searchTerm) || 
                       status.includes(searchTerm);
            });
            
            currentPage = 1;
            setupPagination();
        }
    </script>
</x-app-layout>
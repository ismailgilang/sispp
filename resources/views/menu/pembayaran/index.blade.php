<x-app-layout>
    <div class="py-8 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">
        <!-- Header Welcome -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Manajemen Pembayaran SPP</h1>
            <div class="mt-2 w-20 h-1 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full"></div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- User Table -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm p-6">
                <div class="flex flex-col justify-center mb-4">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                        <h2 class="text-lg font-semibold text-gray-800">Tabel Pembayaran</h2>
                        <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                            <!-- Search Input -->
                            <div class="relative w-full sm:w-64">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" id="searchInput" placeholder="Cari pembayaran..." 
                                       class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                       onkeyup="searchTable()">
                            </div>
                            
                            <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-modal')" class="w-full sm:w-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Cetak Laporan
                            </x-primary-button>
                        </div>
                    </div>
                    
                    <div class="w-full overflow-x-auto rounded-lg border border-gray-200">
                        <table class="w-full divide-y divide-gray-200" id="userTable">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nis</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pembayaran</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Pembayaran</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Metode Pembayaran</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pembayar</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dibuat Pada</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($data as $user)
                                    <tr class="user-row hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 nis">{{ $user->spp->nis }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 tgl">{{ $user->tgl_bayar }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 jumlah">Rp {{ number_format($user->jumlah_bayar, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 metode">{{ $user->metode_pembayaran }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 keterangan">
                                            @if($user->keterangan)
                                                <a href="{{ asset('storage/' . $user->keterangan) }}" 
                                                target="_blank" 
                                                class="text-indigo-600 hover:text-indigo-800 hover:underline flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    Lihat File
                                                </a>
                                            @else
                                                <span class="text-gray-500 italic">Tidak ada file</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 name">{{ $user->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 created_at">{{ $user->created_at->format('d M Y, H:i') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex gap-3 items-center justify-center w-full">
                                                <a href="{{ route('Pembayaran.edit', $user->id) }}" 
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
                                            <p class="mt-2 text-sm text-gray-600">Apakah Anda yakin ingin menghapus pembayaran dengan NIS <b>{{ $user->spp->nis }}</b>?</p>
                                            <div class="mt-6 flex justify-end space-x-3">
                                                <x-secondary-button 
                                                    type="button" 
                                                    @click="$dispatch('close-modal', 'confirm-delete-{{ $user->id }}')">
                                                    Batal
                                                </x-secondary-button>
                                                <form method="POST" action="{{ route('Pembayaran.destroy', $user->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-danger-button type="submit">Ya, Hapus</x-danger-button>
                                                </form>
                                            </div>
                                        </div>
                                    </x-modal>
                                @empty
                                    <tr>
                                        <td colspan="9" class="px-6 py-4 text-center text-gray-500">Tidak ada data pembayaran</td>
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
    
    <!-- Cetak Laporan Modal -->
    <x-modal name="add-modal" focusable>
        <form method="POST" action="{{ route('cetak.pembayaran') }}" class="p-6">
            @csrf
            <h2 class="text-lg font-medium text-gray-900 mb-4">
                <span class="text-indigo-600">Cetak Laporan</span>
                <div class="w-12 h-1 bg-indigo-500 rounded-full mt-1"></div>
            </h2>
            
            <div class="space-y-4">
                <!-- Pilih Mode -->
                <div>
                    <x-input-label for="periode_type" value="Pilih Jenis Periode" />
                    <select id="periode_type" name="periode_type" class="block w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option value="month">Bulan</option>
                        <option value="year">Tahun</option>
                        <option value="periode">Periode (Tanggal)</option>
                    </select>
                </div>

                <!-- Input Periode -->
                <div id="periode_input_wrapper">
                    <x-input-label for="periode"  value="Periode" />
                    <x-text-input id="periode" name="periode" type="text" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('periode')" class="mt-2" />
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Batal
                </x-secondary-button>

                <x-primary-button class="ml-3">
                    Cetak Laporan
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
                const tgl = row.querySelector('.tgl').textContent.toLowerCase();
                const jumlah = row.querySelector('.jumlah').textContent.toLowerCase();
                const metode = row.querySelector('.metode').textContent.toLowerCase();
                const name = row.querySelector('.name').textContent.toLowerCase();
                const created_at = row.querySelector('.created_at').textContent.toLowerCase();
                
                return nis.includes(searchTerm) || 
                       tgl.includes(searchTerm) || 
                       jumlah.includes(searchTerm) || 
                       metode.includes(searchTerm) ||
                       name.includes(searchTerm) || 
                       created_at.includes(searchTerm);
            });
            
            currentPage = 1;
            setupPagination();
        }
    </script>
    
    <script>
        let flatpickrInstance = null;

        function initPicker(mode) {
            const input = document.getElementById("periode");

            // Reset input value & destroy flatpickr if exists
            if (flatpickrInstance && typeof flatpickrInstance.destroy === "function") {
                flatpickrInstance.destroy();
            }
            input.type = "text"; // ensure it's text again
            input.value = "";

            if (mode === "month") {
                flatpickrInstance = flatpickr(input, {
                    altInput: true,
                    dateFormat: "Y-m",
                    altFormat: "F Y",
                    plugins: [
                        new monthSelectPlugin({
                            shorthand: true,
                            dateFormat: "Y-m",
                            altFormat: "F Y"
                        })
                    ]
                });
            }

            else if (mode === "year") {
                const wrapper = document.getElementById("periode_input_wrapper");
                const currentYear = new Date().getFullYear();
                const years = Array.from({ length: 21 }, (_, i) => currentYear - i); // dari sekarang ke 20 tahun ke belakang
                const selectHTML = `
                    <x-input-label for="periode" value="Tahun" />
                    <select name="periode" id="periode" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option value="">Pilih Tahun</option>
                        ${years.map(year => `<option value="${year}">${year}</option>`).join('')}
                    </select>
                    <x-input-error :messages="$errors->get('periode')" class="mt-2" />
                `;
                wrapper.innerHTML = selectHTML;
                flatpickrInstance = null;
                return;
            }

            else if (mode === "periode") {
                flatpickrInstance = flatpickr(input, {
                    altInput: true,
                    mode: "range",
                    dateFormat: "Y-m-d",
                    altFormat: "d F Y"
                });
            }
        }

        document.addEventListener("DOMContentLoaded", function () {
            const select = document.getElementById("periode_type");
            initPicker(select.value);

            select.addEventListener("change", function () {
                // Reset wrapper jika sebelumnya "year" mengganti seluruhnya
                const wrapper = document.getElementById("periode_input_wrapper");
                wrapper.innerHTML = `
                    <x-input-label for="periode" value="Periode" />
                    <x-text-input id="periode" name="periode" type="text" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('periode')" class="mt-2" />
                `;
                initPicker(this.value);
            });
        });
    </script>
</x-app-layout>
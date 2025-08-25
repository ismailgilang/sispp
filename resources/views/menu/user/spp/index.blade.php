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
                    <div class="flex flex-col sm:flex-row justify-between items-center sm:items-center mb-6 gap-4">
                        <h2 class="text-lg font-semibold text-gray-800">Tabel SPP</h2>
                        <div class="relative w-full sm:w-64">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="searchInput" placeholder="Cari SPP..." 
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                onkeyup="searchTable()">
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
                                                @if ($user->status === 'belum dibayar')
                                                    <a href="{{ route('bayar.spp', $user->id) }}" 
                                                       class="flex items-center px-3 py-2 border border-green-500 bg-green-50 text-green-600 rounded-md text-sm hover:bg-green-100 transition-colors">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        Bayar
                                                    </a>
                                                @else
                                                    <span class="text-gray-500 text-sm">-</span>
                                                @endif
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
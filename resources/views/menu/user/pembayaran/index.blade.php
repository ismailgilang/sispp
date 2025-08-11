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
                        <h2 class="text-lg font-semibold text-gray-900">Tabel Pembayaran</h2>
                    </div>
                    
                    <!-- Search Input -->
                    <div class="mb-4">
                        <input type="text" id="searchInput" placeholder="Cari pengguna..." 
                               class="w-full md:w-64 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               onkeyup="searchTable()">
                    </div>
                    
                    <div class="w-full overflow-x-auto">
                        <table class="w-full" id="userTable">
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
                                    {{-- <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th> --}}
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($data as $user)
                                    <tr class="user-row">
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap nis">{{ $user->spp->nis }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap tgl">{{ $user->tgl_bayar }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap jumlah">{{ $user->jumlah_bayar }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap metode">{{ $user->metode_pembayaran }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap keterangan">
                                            @if($user->keterangan)
                                                <a href="{{ asset('storage/' . $user->keterangan) }}" 
                                                target="_blank" 
                                                class="text-blue-600 hover:underline">
                                                    Preview File
                                                </a>
                                            @else
                                                <span class="text-gray-500 italic">Tidak ada file</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap name">{{ $user->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap created_at">{{ $user->created_at }}</td>
                                        {{-- <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex gap-4 items-center justify-center w-full">
                                                <a href="{{ route('Pembayaran.edit', $user->id) }}" class="border border-yellow-500 bg-yellow-500 px-4 py-1 rounded text-white hover:bg-yellow-400 hover:border-yellow-400">Edit</a>
                                                <x-danger-button 
                                                   x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-delete-{{ $user->id }}')">
                                                    Hapus
                                                </x-danger-button>
                                            </div>
                                        </td> --}}
                                    </tr>
                                    <x-modal name="confirm-delete-{{ $user->id }}" :show="false" maxWidth="sm">
                                        <div class="p-6">
                                            <h2 class="text-lg font-medium text-gray-900">Konfirmasi Hapus</h2>
                                            <p class="mt-2 text-sm text-gray-600">Apakah Anda yakin ingin menghapus Pembayaran<b> dengan NIS {{ $user->spp->nis }}</b>?</p>
                                            <div class="mt-4 flex justify-end space-x-2">
                                                <button 
                                                    type="button" 
                                                    @click="$dispatch('close-modal', 'confirm-delete-{{ $user->id }}')"
                                                    class="px-4 py-2 border rounded-md">
                                                    Batal
                                                </button>
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
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data Pembayaran</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="w-full flex justify-end">
                        <div class="flex items-center justify-center gap-4 mt-4" id="paginationControls">
                            <button id="prevPage" class="px-4 py-2 border rounded-md hover:bg-blue-500 hover:text-white" disabled>
                                <<
                            </button>
                            <div id="pageNumbers" class="flex space-x-2"></div>
                            <button id="nextPage" class="px-4 py-2 border rounded-md hover:bg-blue-500 hover:text-white">
                                >>
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
                pageButton.className = `px-4 py-2 border rounded-md ${currentPage === i ? 'bg-blue-500 text-white' : ''}`;
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
                const name = row.querySelector('.tgl').textContent.toLowerCase();
                const username = row.querySelector('.jumlah').textContent.toLowerCase();
                const role = row.querySelector('.metode').textContent.toLowerCase();
                const nama = row.querySelector('.name').textContent.toLowerCase();
                const created_at = row.querySelector('.created_at').textContent.toLowerCase();
                
                return nis.includes(searchTerm) || 
                       name.includes(searchTerm) || 
                       username.includes(searchTerm) || 
                       role.includes(searchTerm) ||
                       name.includes(searchTerm) || 
                       created_at.includes(searchTerm);
            });
            
            currentPage = 1;
            setupPagination();
        }
    </script>
</x-app-layout>